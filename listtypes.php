<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование типов кружков</title>
</head>

<body>
<?
include_once("config.php");

function RedactType($typeid)
{
	$sql = mysql_query("SELECT * "
					."FROM Table_Type "
					."WHERE TypeID = '".$typeid."'")
					or die(mysql_error());
	$row = mysql_fetch_array($sql);
	?>
    <form action="redtype.php">
    <input type="hidden" name="typeid" value="<? echo($typeid); ?>" />
	<p><label for="typename">Тип кружка</label><input type="text" name="typename" value="<? echo($row[TypeName]); ?>"/></p>
	<input type="submit" value="Сохранить" />
</form>
    <?
}

function NewType()
{
	?>
    <form action="newtype.php" method="get">
    <p><label for="typename">Тип кружка</label><input name="typename" type="text" /></p>
    <p><input type="submit" value="Добавить" /></p>
    </form>
    <?
}

$sql = mysql_query("SELECT * FROM Table_Type")
					or die(mysql_error());
?>
<table width="50%" border="1">
<tr>	
    <th>Тип</th>
    <th>Удалить</th>
</tr>
<?
while ($row = mysql_fetch_array($sql)) 
{
	echo("<tr>");
		
		echo("<td>");
		echo("<a href=\"listtypes.php?act=red&red=".$row[TypeID]."\">".$row[TypeName]."</a>");
		echo("</td>");
		
		echo("<td>");
		echo("<a href=\"deltype.php?typeid=".$row[TypeID]."\">x</a>");
		echo("</td>");	
		
	echo("</tr>");
}
?>
</table>
<?
if (!$_REQUEST[act]) {
	?>
    <form action="listtypes.php" method="get">
    <input type="hidden" name="act" value="new" />
    <input type="submit" value="Добавить новый" />
    </form>
    <?
}

else if ($_REQUEST[act] == 'new')
{
	NewType();
}

else if ($_REQUEST[act] == 'red' and $_REQUEST[red])
{
	RedactType($_REQUEST[red]);
}
?>
</body>
</html>