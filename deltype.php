<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Удаление типов кружков</title>
</head>

<body>
<?
header('Location: listtypes.php');
if (!$_REQUEST['typeid'])
{
	echo('Something wrong');
	die();
}

include_once("config.php");

$sql = mysql_query("SELECT * FROM Table_Courses WHERE TypeID = ".$_REQUEST['typeid']) or die(mysql_error());

while ($row = mysql_fetch_array($sql)) 
{
	mysql_query("DELETE FROM Table_Schedules WHERE CourseID = ".$row[CourseID]) or die(mysql_error());
}

mysql_query("DELETE FROM Table_Courses WHERE TypeID = ".$_REQUEST['typeid']) or die(mysql_error());

mysql_query("DELETE FROM Table_Type WHERE TypeID = ".$_REQUEST['typeid']) or die(mysql_error());
?>
</body>
</html>
