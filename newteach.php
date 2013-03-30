<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление учителя</title>
</head>

<body>
<?
include_once('config.php');

if (isset($_REQUEST['new'])) {
	$From = $_SERVER['HTTP_REFERER'];
	$From = explode("/",$From);
	
	$From = end($From);
	
	$FromPage = reset(explode("?",$From));

	$From = "frompage=".$FromPage."&";
	
	foreach ($_GET as $key => $value)
	{
		$From = $From."$key=$value&";
	}
	echo($From);
	header('Location: listteach.php?'.$From);
}

else 
{
	header('Location: listteach.php');
	
	if (!$_REQUEST['teachname'] and !$_REQUEST['teachphone'] and !$_REQUEST['teachdep'])
	{
		echo('Something wrong');
		break;
	}

	DBChecking();
}

function AddTeacher(){
	$sql = mysql_query(
			"INSERT INTO Table_Teachers "
			."(TeacherName, TeacherPhone, DepartmentID) "
			."VALUES ('"
				.$_REQUEST['teachname']."', '"
				.$_REQUEST['teachphone']."', '"
				.$_REQUEST['teachdep']."')") 
		or die(mysql_error());
	echo($_REQUEST['teachname']." added to db");
}

function DBChecking(){
	$sql = mysql_query("SELECT * FROM Table_Teachers WHERE TeacherName LIKE '%".$_REQUEST['teachname']."%'") or die(mysql_error());
	
	if (mysql_num_rows($sql) == 0) {
		AddTeacher();
	}
	else {
		echo ("Database already have record ".$_REQUEST['teachname']);
	}
	
}


?>
</body>
</html>