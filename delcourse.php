<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование отдела</title>
</head>

<body>
<?
header('Location: listcourses.php');
if (!$_REQUEST['courseid'])
{
	echo('Something wrong');
	die();
}

include_once("config.php");

mysql_query("DELETE FROM Table_Courses WHERE CourseID = ".$_REQUEST['courseid']) or die(mysql_error());

mysql_query("DELETE FROM Table_Schedules WHERE CourseID = ".$_REQUEST['courseid']) or die(mysql_error());
?>
</body>
</html>
