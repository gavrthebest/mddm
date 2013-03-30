<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление расписания</title>
</head>

<body>
<?
if (isset($_REQUEST['new'])) {
	$From = $_SERVER['HTTP_REFERER'];
	$From = explode("/",$From);
	
	$From = end($From);
	
	$FromPage = reset(explode("?",$From));
//	echo($FromPage);
	$From = "frompage=".$FromPage."&";
	
	foreach ($_GET as $key => $value)
	{
		$From = $From."$key=$value&";
	}
	echo($From);
	header('Location: '.$_REQUEST['frompage'].'?'.$From);
}

else
{
	header('Location: listschedules.php');

	if (!$_REQUEST['courseid'] and !$_REQUEST['day']
			and !$_REQUEST['room'] and !$_REQUEST['begintime'] 
			and !$_REQUEST['endtime'])
	{
		echo('Something wrong');
		break;
	}

	include_once('config.php');

	dbchecking();
}

function scheduleadd(){
	$sql = mysql_query(
			"INSERT INTO Table_Schedules "
			."(CourseID, DayID, RoomID, BeginTime, EndTime) "
			."VALUES ('"
				.$_REQUEST['courseid']."', '"
				.$_REQUEST['day']."', '"
				.$_REQUEST['room']."', '"
				.$_REQUEST['begintime']."', '"
				.$_REQUEST['endtime']."')") 
		or die(mysql_error());
	echo($_REQUEST['coursename']." added to db");
}

function dbchecking(){
	$sql = mysql_query("SELECT * FROM Table_Schedules ".
						"WHERE CourseID = '".$_REQUEST['courseid']."' "
						."AND DayID = '".$_REQUEST['day']."' "
						."AND RoomID = '".$_REQUEST['room']."' "
						."AND BeginTime = '".$_REQUEST['begintime']."' "
						."AND EndTime = '".$_REQUEST['endtime']."' ") or die(mysql_error());
	
	if (mysql_num_rows($sql) == 0) {
		scheduleadd();
	}
	else {
		echo ("Database already have record ".$_REQUEST['courseid']);
	}
	
}


?>
</body>
</html>