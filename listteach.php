<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование учителей</title>
</head>

<body>
<?
include_once("config.php");

function RedactTeacher($teachid)
{
	$sql = mysql_query("SELECT Table_Teachers.TeacherName as TeacherName, "
					."Table_Teachers.TeacherPhone as TeacherPhone, "
					."Table_Departments.DepartmentName as DepartmentName, "
					."Table_Departments.DepartmentID as DepartmentID "
					."FROM Table_Teachers, Table_Departments "
					."WHERE Table_Teachers.TeacherID = '".$teachid."' "
					."AND Table_Teachers.DepartmentID = Table_Departments.DepartmentID")
					or die(mysql_error());
	$row = mysql_fetch_array($sql);
	?>
    <form action="redteach.php">
    <input type="hidden" name="teachid" value="<? echo($teachid); ?>" />
	<p><label for="teachname">ФИО учителя</label><input type="text" name="teachname" value="<? echo($row[TeacherName]); ?>"/></p>
	<p><label for="teachphone">Телефон</label><input type="text" name="teachphone" value="<? echo($row[TeacherPhone]); ?>" /></p>
	<p><label for="teachdep">Отдел</label><select name="teachdep">
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
	?>
    </select></p>
	<input type="submit" value="Сохранить" />
</form>
    <?
}

$sql = mysql_query("SELECT Table_Teachers.TeacherName as TeacherName, "
					."Table_Teachers.TeacherID as TeacherID, "
					."Table_Teachers.TeacherPhone as TeacherPhone, "
					."Table_Departments.DepartmentName as DepartmentName "
					."FROM Table_Teachers, Table_Departments "
					."WHERE Table_Teachers.DepartmentID = Table_Departments.DepartmentID")
					or die(mysql_error());
?>
<table width="50%" border="1">
<tr>	
    <th>Отдел</th>
	<th>Пидогог</th>
    <th>Телефон пидогого</th>
    <th>Удалить</th>
</tr>
<?
while ($row = mysql_fetch_array($sql)) 
{
	echo("<tr>");
		
		echo("<td>");
		echo($row[DepartmentName]);
		echo("</td>");
		
		echo("<td>");
		echo("<a href=\"listteach.php?act=red&red=".$row[TeacherID]."\">".$row[TeacherName]."</a>");
		echo("</td>");		
		
		echo("<td>");
		echo($row[TeacherPhone]);
		echo("</td>");
		
		echo("<td>");
		echo("<a href=\"delteach.php?teachid=".$row[TeacherID]."\">x</a>");
		echo("</td>");
		
	echo("</tr>");
}
?>
</table>
<?
if (isset($_REQUEST['new'])) 
{
	if ($_REQUEST['new'] == 'dep')
	{
		include("includes/newdep.php");
	}
	if ($_REQUEST['new'] == 'teach')
	{
		include("includes/newteach.php");
	}
}

else 
{
	$From = $_SERVER['REQUEST_URI'];
	$From = explode("/",$From);
	
	$From = end($From);
	
	$FromPage = reset(explode("?",$From));
	
	if ($_REQUEST['frompage'] == $FromPage) 
	{
		include("includes/newteach.php");
	}
	
	else if ($_REQUEST['act'] == 'red' and $_REQUEST['red'])
	{
		RedactTeacher($_REQUEST[red]);
	}

	else if (!$_REQUEST['act']) 
	{
		if (!$_REQUEST['new']) {
		?>
    	<form action="listteach.php" method="get">
	    <input type="hidden" name="new" value="teach" />
	    <input type="submit" value="Добавить нового" />
	    </form>
	    <?
		}
	}
}
?>
</body>
</html>