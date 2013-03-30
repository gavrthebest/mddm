<? include_once("../config.php");	?>
	<p>Добавление расписания</p>
    <form action="newschedule.php">
    <input type="hidden" name="scheduleid" value="<? echo($scheduleid); ?>" />
    <p><label for="courseid">Название</label><select name="courseid">
	<?
	$sql = mysql_query("SELECT Table_Courses.CourseID as CourseID, Table_Courses.CourseName as CourseName FROM Table_Courses");
	while ($row2 = mysql_fetch_array($sql)) 
	{
		if ($row2[CourseID] == $_REQUEST['courseid']) 
		{
			echo("<option value=\"".$row2[CourseID]."\" selected=\"selected\">".$row2[CourseName]."</option>");
		}
		else 
		{
			echo("<option value=\"".$row2[CourseID]."\">".$row2[CourseName]."</option>");
		}
	}
	?></select><button name="new" value="course" type="submit">Добавить кружок</button></p>
    <p><label for="day">День недели</label><select name="day">
	<?
	$sql = mysql_query("SELECT * FROM Table_Days");
	while ($row2 = mysql_fetch_array($sql))
	{
		if ($row2[DayID] == $_REQUEST['day']) {
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
		if ($row2[RoomID] == $_REQUEST['roomid']) 
		{
			echo("<option value=\"".$row2[RoomID]."\" selected=\"selected\">".$row2[RoomName]."</option>");
		}
		else 
		{
			echo("<option value=\"".$row2[RoomID]."\">".$row2[RoomName]."</option>");
		}
	}
	?>
    </select><button name="new" value="room" type="submit">Добавить кабинет</button></p>
    <p><label for="begintime">Время начала</label><input name="begintime" type="text" value="<? echo($_REQUEST['begintime']); ?>" /></p>
    <p><label for="endtime">Время окончания</label><input name="endtime" type="text" value="<? echo($_REQUEST['endtime']); ?>" /></p>
    <p><input type="submit" value="Добавить" /></p>
    </form>