<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование отделов</title>
</head>

<body>
<?
include_once("config.php");

$sql = mysql_query("SELECT * FROM Table_Departments") or die(mysql_error());

function RedactDepartment($depid)
{
	// выводим форму с заполненными полями
	$sql = mysql_query("SELECT * FROM Table_Departments WHERE DepartmentID=".$depid) or die(mysql_error());
	$row = mysql_fetch_array($sql);
	?>
    <form action="reddep.php">
    <input type="hidden" name="depid" value="<? echo($depid); ?>" />
	<p><label for="depname">Название отдела</label><input type="text" name="depname" value="<? echo($row[DepartmentName]); ?>"/></p>
	<p><label for="depphone">Телефон</label><input type="text" name="depphone" value="<? echo($row[DepartmentPhone]); ?>" /></p>
	<p><label for="depboss">Заведующий</label><input type="text" name="depboss" value="<?  echo($row[BossName]); ?>" /></p>
	<p><label for="depbossphone">Телефон заведующего</label><input type="text" name="depbossphone" value="<?  echo($row[BossPhone]); ?>" /></p>
	<input type="submit" value="Сохранить" />
</form>
    <?
}

function NewDepartment(){
	include("includes/newdep.php");
}
?>
<table width="50%" border="1">
<tr>	
    <th>Отдел</th>
	<th>Телефон отдела</th>
    <th>Боссло</th>
    <th>Телефон боссла</th>
    <th>Удалить</th>
</tr>
<? 

while ($row = mysql_fetch_array($sql)) {
	echo("<tr>");
		echo("<td>");
			echo("<a href=\"listdep.php?act=red&reddep=".$row[DepartmentID]."\">".$row[DepartmentName]."</a>");
		echo("</td>");
		
		echo("<td>");
			echo($row[DepartmentPhone]);
		echo("</td>");
		
		echo("<td>");
			echo($row[BossName]);
		echo("</td>");
		
		echo("<td>");
			echo($row[BossPhone]);
		echo("</td>");
		
		echo("<td>");
			echo("<a href=\"deldep.php?depid=".$row[DepartmentID]."\">x</a>");
		echo("</td>");
		
	echo("</tr>");
}
?>
</table>
<?
// или редактируем, или добавляем новый, или вывод кнопки
if (!$_REQUEST[act]) 
{
	?>
    <form action="listdep.php" method="get">
    <input type="hidden" name="act" value="new" />
    <input type="submit" value="Добавить новый отдел" />
    </form>
	<?
}

else if ($_REQUEST[act]='red' and $_REQUEST[reddep]) 
{
	RedactDepartment($_REQUEST[reddep]);
}

else if ($_REQUEST[act]='newdep') 
{
	NewDepartment();
}
?>
</body>
</html>
