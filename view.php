<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Документ без названия</title>
</head>

<body>
<?
include_once("config.php");

$query = mysql_query("SELECT * FROM Table_Departments") or die("Could not query db");
while ($row = mysql_fetch_array($query))
{
	echo ($row[BossName]);
}
?>
</body>
</html>
