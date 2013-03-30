<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление отдела</title>
</head>

<body>
<?
header('Location: listdep.php');

if (!$_REQUEST['depname'] and !$_REQUEST['depphone'] and !$_REQUEST['depboss'])
{
	echo('Something wrong');
	break;
}

include_once('config.php');

dbchecking();

function depadd(){
	$sql = mysql_query(
			"INSERT INTO Table_Departments "
			."(DepartmentName, DepartmentPhone, BossName, BossPhone) "
			."VALUES ('"
				.$_REQUEST['depname']."', '"
				.$_REQUEST['depphone']."', '"
				.$_REQUEST['depboss']."', '"
				.$_REQUEST['depbossphone']."')") 
		or die(mysql_error());
	echo($_REQUEST['depname']." added to db");
}

function dbchecking(){
	$sql = mysql_query("SELECT * FROM Table_Departments WHERE DepartmentName LIKE '%".$_REQUEST['depname']."%'") or die(mysql_error());
	
	if (mysql_num_rows($sql) == 0) {
		depadd();
	}
	else {
		echo ("Database already have record ".$_REQUEST['depname']);
	}
	
}


?>
</body>
</html>