<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление кабинета</title>
</head>

<body>
<?
include_once('config.php');
if (!$_REQUEST['roomname'])
{
	echo('Something wrong');
	break;
}

dbchecking();

function roomadd(){
	$sql = mysql_query(
			"INSERT INTO Table_Rooms "
			."(RoomName) "
			."VALUES ('"
				.$_REQUEST['roomname']."')") 
		or die(mysql_error());
	echo($_REQUEST['roomname']." added to db");
}

function dbchecking(){
	$sql = mysql_query("SELECT * FROM Table_Rooms WHERE RoomName LIKE '%".$_REQUEST['roomname']."%'") or die(mysql_error());
	
	if (mysql_num_rows($sql) == 0) {
		roomadd();
	}
	else {
		echo ("Database already have record ".$_REQUEST['roomname']);
	}
	
}

if ($_REQUEST['frompage']) 
{
	foreach ($_REQUEST as $key => $value)
	{
		if ($key == 'roomname' or $key == 'roomid') 
		{
			//relax
		}
		else
		{
			$From = $From."$key=$value&";
		}
	}
	$From = $From."roomid=".mysql_insert_id();
	echo($From."<br />");
	header("Location: ".$_REQUEST['frompage']."?".$From);
}

else 
{
	header('Location: listrooms.php');
}

?>
</body>
</html>
