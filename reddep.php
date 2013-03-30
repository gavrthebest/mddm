<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование отдела</title>
</head>

<body>
<?
header('Location: listdep.php');
if (!$_REQUEST['depname'] and !$_REQUEST['depphone'] and !$_REQUEST['depboss'] and !$_REQUEST['depid'])
{
	echo('Something wrong');
	break;
}

include_once("config.php");

mysql_query("UPDATE Table_Departments SET DepartmentName = '".$_REQUEST['depname']."', DepartmentPhone = '".$_REQUEST['depphone']."', BossName = '".$_REQUEST['depboss']."', BossPhone = '".$_REQUEST['depbossphone']."' WHERE DepartmentID = ".$_REQUEST['depid']) or die(mysql_error());
?>
</body>
</html>
