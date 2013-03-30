<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование кабинетов</title>
</head>

<body>
<?
header('Location: listrooms.php');
if (!$_REQUEST['roomname'] and !$_REQUEST['roomid'])
{
	echo('Something wrong');
	break;
}

include_once("config.php");

mysql_query("UPDATE Table_Rooms SET RoomName = '".$_REQUEST['roomname']."' WHERE RoomID = ".$_REQUEST['roomid']) or die(mysql_error());
?>
</body>
</html>
