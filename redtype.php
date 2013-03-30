<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование типов кружков</title>
</head>

<body>
<?
header('Location: listtypes.php');
if (!$_REQUEST['typename'] and !$_REQUEST['typeid'])
{
	echo('Something wrong');
	break;
}

include_once("config.php");

mysql_query("UPDATE Table_Type SET TypeName = '".$_REQUEST['typename']."' WHERE TypeID = ".$_REQUEST['typeid']) or die(mysql_error());
?>
</body>
</html>
