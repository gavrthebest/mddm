<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление типа</title>
</head>

<body>
<?
header('Location: listtypes.php');

if (!$_REQUEST['typename'])
{
	echo('Something wrong');
	break;
}

include_once('config.php');

dbchecking();

function depadd(){
	$sql = mysql_query(
			"INSERT INTO Table_Type "
			."(TypeName) "
			."VALUES ('"
				.$_REQUEST['typename']."')") 
		or die(mysql_error());
	echo($_REQUEST['typename']." added to db");
}

function dbchecking(){
	$sql = mysql_query("SELECT * FROM Table_Type WHERE TypeName LIKE '%".$_REQUEST['typename']."%'") or die(mysql_error());
	
	if (mysql_num_rows($sql) == 0) {
		depadd();
	}
	else {
		echo ("Database already have record ".$_REQUEST['typename']);
	}
	
}


?>
</body>
</html>