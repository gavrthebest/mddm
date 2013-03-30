<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Удаление кабинетов</title>
</head>

<body>
<?
header('Location: listrooms.php');
if (!$_REQUEST['roomid'])
{
	echo('Something wrong');
	die();
}

include_once("config.php");

mysql_query("DELETE FROM Table_Schedules WHERE RoomID = ".$_REQUEST['roomid']) or die(mysql_error());

mysql_query("DELETE FROM Table_Rooms WHERE RoomID = ".$_REQUEST['roomid']) or die(mysql_error());
?>
</body>
</html>
