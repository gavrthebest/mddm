<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование учителя</title>
</head>

<body>
<?
header('Location: listteach.php');
if (!$_REQUEST['teachname'] and !$_REQUEST['teachphone'] and !$_REQUEST['teachid'] and !$_REQUEST['teachdep'])
{
	echo('Something wrong');
	break;
}

include_once("config.php");

mysql_query("UPDATE Table_Teachers SET TeacherName = '".$_REQUEST['teachname']."', TeacherPhone = '".$_REQUEST['teachphone']."', DepartmentID = '".$_REQUEST['teachdep']."' WHERE TeacherID = ".$_REQUEST['teachid']) or die(mysql_error());
?>
</body>
</html>