<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование расписаний</title>
</head>

<body>
<? 
//замер времени выполнения скрипта
$time_start = microtime(1);

//подключаем базу данных
include_once("config.php");

//вывод времени в определённом формате
function ExplodeTime($time) {
	//разбиваем строку на массив с разделителем ":"
	$time = explode(":", $time);
	$result = $time[0].":".$time[1];
	return $result;
}

//редактирование расписания
function RedactSchedule($scheduleid)
{
	//запрашиваем у БД определённое расписание и заполняем форму значениями
	$sql = mysql_query("SELECT * FROM Table_Schedules WHERE ScheduleID = ".$scheduleid) or die(mysql_error());
	$row = mysql_fetch_array($sql);
	$begintime = ExplodeTime($row[BeginTime]);
	$endtime = ExplodeTime($row[EndTime]);
	?>
    <form action="redschedule.php">
    <input type="hidden" name="scheduleid" value="<? echo($scheduleid); ?>" />
    <p><label for="courseid">Название</label><select name="courseid">
	<?
	$sql = mysql_query("SELECT Table_Courses.CourseID as CourseID, Table_Courses.CourseName as CourseName FROM Table_Courses ");
	while ($row2 = mysql_fetch_array($sql))
	{
		if ($row2[CourseID] == $row[CourseID]) {
			echo("<option value=\"".$row2[CourseID]."\" selected=\"selected\">".$row2[CourseName]."</option>");
		}
		else 
		{
			echo("<option value=\"".$row2[CourseID]."\">".$row2[CourseName]."</option>");
		}
	}
	?></select></p>
    <p><label for="day">День недели</label><select name="day">
	<?
	$sql = mysql_query("SELECT * FROM Table_Days");
	while ($row2 = mysql_fetch_array($sql))
	{
		if ($row2[DayID] == $row[DayID]) {
			echo("<option value=\"".$row2[DayID]."\" selected=\"selected\">".$row2[DayName]."</option>");
		}
		else 
		{
			echo("<option value=\"".$row2[DayID]."\">".$row2[DayName]."</option>");
		}
	}
	?>
    </select></p>
    <p><label for="room">Кабинет</label><select name="room">
	<?
    $sql = mysql_query("SELECT * FROM Table_Rooms");
	while ($row2 = mysql_fetch_array($sql))
	{
		if ($row2[RoomID] == $row[RoomID]) {
			echo("<option value=\"".$row2[RoomID]."\" selected=\"selected\">".$row2[RoomName]."</option>");
		}
		else 
		{
			echo("<option value=\"".$row2[RoomID]."\">".$row2[RoomName]."</option>");
		}
	}
	?>
    </select></p>
    <p><label for="begintime">Время начала</label><input name="begintime" type="text" value="<? echo($begintime); ?>" /></p>
    <p><label for="endtime">Время окончания</label><input name="endtime" type="text" value="<? echo($endtime); ?>" /></p>
    <p><input type="submit" value="Сохранить" /></p>
    </form>
    <?
}

// составляем запрос для результатов
$SQLSelect = " Table_Schedules.ScheduleID as ScheduleID, "
					."Table_Schedules.CourseID as CourseID, "
					."Table_Courses.CourseName as CourseName, "
					."Table_Days.DayName as DayName, "
					."Table_Rooms.RoomName as RoomName, "
					."Table_Schedules.BeginTime as BeginTime, "
					."Table_Schedules.EndTime as EndTime ";
$SQLFrom = " Table_Schedules, Table_Courses, Table_Days, Table_Rooms ";
$SQLWhere = " Table_Schedules.DayID = Table_Days.DayID "
					."AND Table_Schedules.RoomID = Table_Rooms.RoomID "
					."AND Table_Schedules.CourseID = Table_Courses.CourseID "
				."ORDER BY Table_Courses.CourseName, Table_Days.DayID ";
$SQLQuery = "SELECT ".$SQLSelect
				."FROM ".$SQLFrom
				."WHERE ".$SQLWhere
				.$sqlLimit;

//постраничный вывод
$ResultsPerPage = 20;
include_once("includes/navigation.php");

//запрашиваем результаты
$sql = mysql_query($SQLQuery)
					or die(mysql_error());
// и выводим их
?>
<table width="50%" border="1">
<tr>	
    <th>Название</th>
	<th>День</th>
    <th>Кабинет</th>
    <th>Время начала</th>
    <th>Время окончания</th>
    <th>Удалить</th>
</tr>
<?
while ($row = mysql_fetch_array($sql)) 
{
	echo("<tr>");
		
		// для красивого rowspan будем извращаться
		$sql2 = mysql_query("SELECT CourseNum.CourseID FROM "
					."(".$SQLQuery.")CourseNum  WHERE CourseNum.CourseID = ".$row[CourseID]);
		$row2 = mysql_num_rows($sql2);

		if ($row[CourseID] != $PrevCourseID) {
			echo("<td rowspan=\"$row2\">");
			echo($row[CourseName]);
			echo("</td>");
		}
		$PrevCourseID = $row[CourseID];
		
		echo("<td>");
		echo($row[DayName]);
		echo("</td>");
		
		echo("<td>");
		echo($row[RoomName]);
		echo("</td>");
		
		echo("<td>");
		$begintime = ExplodeTime($row[BeginTime]);
		echo("<a href=\"listschedules.php?act=red&red=".$row[ScheduleID]."&start=".$_REQUEST['start']."\">".$begintime."</a>");
		echo("</td>");
		
		echo("<td>");
		$endtime = ExplodeTime($row[EndTime]);
		echo("<a href=\"listschedules.php?act=red&red=".$row[ScheduleID]."&start=".$_REQUEST['start']."\">".$endtime."</a>");
		echo("</td>");
		
		echo("<td>");
		echo("<a href=\"delschedule.php?scheduleid=".$row[ScheduleID]."\">x</a>");
		
	echo("</tr>");
}
?>
</table>
<?

echo("Всего результатов: $numResults, из них показано $ResultsPerPage<br />");

//Функция листания страниц (см. navigation.php)
ShowPages($Page, $NumPages, $ResultsPerPage);

//смотрим, что нам выводить: 
if (isset($_REQUEST['new'])) 
{
	//	добавление нового кружка
	if ($_REQUEST['new'] == 'course')
	{
		include("includes/newcourse.php");
	}

	//	добавление нового расписания
	if ($_REQUEST['new'] == 'schedule')
	{
		include("includes/newschedule.php");
	}
	
	//	или добавление нового кабинета
	if ($_REQUEST['new'] == 'room')
	{
		include("includes/newroom.php");
	}
}

else 
{
	// либо смотрим, откуда пришёл запрос (заполняем поля, если добавлялись новый кружок или кабинет)
	$From = $_SERVER['REQUEST_URI'];
	$From = explode("/",$From);
	
	$From = end($From);
	
	$FromPage = reset(explode("?",$From));
	
	if ($_REQUEST['frompage'] == $FromPage) {
		include("includes/newschedule.php");
	}
	
	// иначе вызываем редактирование расписания
	else if ($_REQUEST[act] == 'red' and $_REQUEST[red])
	{
		RedactSchedule($_REQUEST[red]);
	}
	
	// и если ничего не подошло, то выводим кнопочку "добавить новый"
	else if (!$_REQUEST['act']) 
	{
		if (!$_REQUEST['new']) 
		{
			?>
			<form action="listschedules.php" method="get">
			<? 
			if (isset($_REQUEST['start'])) 
			{
				?><input type="hidden" name="start" value="<? echo($_REQUEST['start']); ?>" />
				<?
			}
			?>
			<input type="hidden" name="new" value="schedule" />
		    <input type="submit" value="Добавить новый" />
		    </form>
	    	<?
		}
	}
}
$time_end = microtime(1);		// Конец подсчета времени
$time = $time_end - $time_start;
echo($time);
?>
</body>
</html>
