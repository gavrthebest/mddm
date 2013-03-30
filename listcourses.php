<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование кружков</title>
</head>

<body>
<? 
include_once("config.php");

//редактирование кружка
//запрашиваем данные по id и заполняем ими форму
function RedactCourse($courseid)
{
	$sql = mysql_query("SELECT * FROM Table_Courses WHERE CourseID=".$courseid) or die(mysql_error());
	$row = mysql_fetch_array($sql);
	?>
    <form action="redcourse.php">
    <input type="hidden" name="courseid" value="<? echo($courseid); ?>" />
	<p><label for="coursename">Название</label><input name="coursename" type="text" value="<? echo($row[CourseName]); ?>" /></p>
    <p><label for="coursedep">Отдел</label><select name="coursedep">
	<?
	$sql = mysql_query("SELECT * FROM Table_Departments");
	while ($row2 = mysql_fetch_array($sql))
	{
		if ($row2[DepartmentID] == $row[DepartmentID]) {
			echo("<option value=\"".$row2[DepartmentID]."\" selected=\"selected\">".$row2[DepartmentName]."</option>");
		}
		else 
		{
			echo("<option value=\"".$row2[DepartmentID]."\">".$row2[DepartmentName]."</option>");
		}
	}
	?></select></p>
    
    <p><label for="teachername">Учитель</label><select name="teachername">
	<?
	$sql = mysql_query("SELECT * FROM Table_Teachers");
	while ($row2 = mysql_fetch_array($sql))
	{
		if ($row[TeacherID] == $row2[TeacherID]) {
			echo("<option value=\"".$row2[TeacherID]."\" selected=\"selected\">".$row2[TeacherName]."</option>");
		}
		else {
			echo("<option value=\"".$row2[TeacherID]."\">".$row2[TeacherName]."</option>");
		}
	}
	?></select></p>
    
    <p><label for="courseagemin">Минимальный возраст</label><select name="courseagemin">
	    <option value="0" selected>Любой</option>
    	<?
		for ($i = 1; $i < 99; $i++) {
			if ($row[AgeMin] == $i) {
				echo "<option value=\"$i\" selected=\"selected\">$i</option>";
			}
			else {
				echo "<option value=\"$i\">$i</option>";
			}
		}
		?>
    </select></p>
    <p><label for="courseagemax">Максимальный возраст</label><select name="courseagemax">
	    <option value="99" selected>Любой</option>
    	<?
		for ($i = 1; $i < 99; $i++) {
			if ($row[AgeMax] == $i) {
				echo "<option value=\"$i\" selected=\"selected\">$i</option>";
			}
			else {
				echo "<option value=\"$i\">$i</option>";
			}
		}
		?>
    </select></p>
    <p><label for="coursetype">Тип</label><select name="coursetype">
	<?
	$sql = mysql_query("SELECT * FROM Table_Type");
	while ($row2 = mysql_fetch_array($sql))
	{
		if ($row2[TypeID] == $row[TypeID]) {
			echo("<option value=\"".$row2[TypeID]."\" selected=\"selected\">".$row2[TypeName]."</option>");
		}
		else {
			echo("<option value=\"".$row2[TypeID]."\">".$row2[TypeName]."</option>");
		}
	}
	?></select></p>
    <p><label for="coursepayment">Стоимость</label><input name="coursepayment" type="text" value="<? echo($row[Payment]); ?>" /></p>
    <p><label for="coursedescription">Описание</label><textarea name="coursedescription"><? echo($row[Description]); ?></textarea></p>
    <p><label for="orgmeeting">Орг. собрание</label><input name="orgmeeting" type="text" value="<? echo($row[OrgMeeting]); ?>" /></p>
    <p><input type="submit" value="Сохранить" /></p>
    </form>
    <?
}

function NewCourse()
{
	include("includes/newcourse.php");
}

$sql = mysql_query("SELECT Table_Courses.CourseID as CourseID, "
					."Table_Courses.CourseName as CourseName, "
					."Table_Courses.AgeMin as AgeMin, "
					."Table_Courses.AgeMax as AgeMax, "
					."Table_Courses.Payment as Payment, "
					."Table_Courses.Description as Description, "
					."Table_Type.TypeName as TypeName, "
					."Table_Teachers.TeacherName as TeacherName, "
					."Table_Courses.OpenRecord as OpenRecord, "
					."Table_Courses.OrgMeeting as OrgMeeting, "
					."Table_Departments.DepartmentName as DepartmentName "
				."FROM Table_Courses, Table_Type, Table_Departments, Table_Teachers "
				."WHERE Table_Courses.TypeID = Table_Type.TypeID "
					."AND Table_Courses.DepartmentID = Table_Departments.DepartmentID "
					."AND Table_Courses.TeacherID = Table_Teachers.TeacherID")
					or die(mysql_error());
?>
<table width="50%" border="1">
<tr>	
    <th>Название</th>
	<th>Отдел</th>
    <th>Педагог</th>
    <th>Минимальный возраст</th>
    <th>Максимальный возраст</th>
    <th>Тип</th>
    <th>Стоимость</th>
    <th>Описание</th>
    <th>Орг. собрание</th>
    <th>Удалить</th>
</tr>
<?
while ($row = mysql_fetch_array($sql)) 
{
	echo("<tr>");
		
		echo("<td>");
		echo("<a href=\"listcourses.php?act=red&red=".$row[CourseID]."\">".$row[CourseName]."</a>");
		echo("</td>");
		
		echo("<td>");
		echo($row[DepartmentName]);
		echo("</td>");
		
		echo("<td>");
		echo($row[TeacherName]);
		echo("</td>");
		
		echo("<td>");
		echo($row[AgeMin]);
		echo("</td>");
		
		echo("<td>");
		echo($row[AgeMax]);
		echo("</td>");
		
		echo("<td>");
		echo($row[TypeName]);
		echo("</td>");
		
		echo("<td>");
		echo($row[Payment]);
		echo("</td>");
		
		echo("<td>");
		echo($row[Description]);
		echo("</td>");
		
		echo("<td>");
		echo($row[OrgMeeting]);
		echo("</td>");
		
		echo("<td>");
		echo("<a href=\"delcourse.php?courseid=".$row[CourseID]."\">x</a>");
		echo("</td>");

	echo("</tr>");
}
?>
</table>
<?
// выводим либо форму добавления/редактирования, либо кнопку "Добавить"
if (!$_REQUEST[act]) {
	?>
    <form action="listcourses.php" method="get">
    <input type="hidden" name="act" value="new" />
    <input type="submit" value="Добавить новый" />
    </form>
    <?
}

else if ($_REQUEST[act] == 'new')
{
	NewCourse();
}

else if ($_REQUEST[act] == 'red' and $_REQUEST[red])
{
	RedactCourse($_REQUEST[red]);
}
?>
</body>
</html>
