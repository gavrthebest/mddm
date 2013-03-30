<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование расписания</title>
</head>

<body>
<?
header('Location: listschedules.php');
if (!$_REQUEST['scheduleid'] and !$_REQUEST['courseid'] and !$_REQUEST['day']
		and !$_REQUEST['room'] and !$_REQUEST['begintime'] 
		and !$_REQUEST['endtime'])
{
	echo('Something wrong');
	break;
}

include_once("config.php");

mysql_query("UPDATE Table_Schedules SET CourseID = '".$_REQUEST['courseid']."', "
					."DayID = '".$_REQUEST['day']."', "
					."RoomID = '".$_REQUEST['room']."', "
					."BeginTime = '".$_REQUEST['begintime']."', "
					."EndTime = '".$_REQUEST['endtime']
					."' WHERE ScheduleID = ".$_REQUEST['scheduleid']) or die(mysql_error());
?>
</body>
</html>
