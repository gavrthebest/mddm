<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование кабинетов</title>
</head>

<body>
<?
include_once("config.php");

function RedactRoom($roomid)
{
	$sql = mysql_query("SELECT * "
					."FROM Table_Rooms "
					."WHERE RoomID = '".$roomid."'")
					or die(mysql_error());
	$row = mysql_fetch_array($sql);
	?>
    <form action="redroom.php">
    <input type="hidden" name="roomid" value="<? echo($roomid); ?>" />
	<p><label for="roomname">Кабинет</label><input type="text" name="roomname" value="<? echo($row[RoomName]); ?>"/></p>
	<input type="submit" value="Сохранить" />
</form>
    <?
}

function NewRoom()
{
	include("includes/newroom.php");
}

$sql = mysql_query("SELECT Table_Rooms.RoomID as RoomID, Table_Rooms.RoomName as RoomName "
					."FROM Table_Rooms ")
					or die(mysql_error());
?>
<table width="50%" border="1">
<tr>	
    <th>Кабинет</th>
    <th>Удалить</th>
</tr>
<?
while ($row = mysql_fetch_array($sql)) 
{
	echo("<tr>");
		
		echo("<td>");
		echo("<a href=\"listrooms.php?act=red&red=".$row[RoomID]."\">".$row[RoomName]."</a>");
		echo("</td>");
		
		echo("<td>");
		echo("<a href=\"delroom.php?roomid=".$row[RoomID]."\">x</a>");
		echo("</td>");
		
	echo("</tr>");
}
?>
</table>
<?
if (!$_REQUEST[act]) {
	?>
    <form action="listrooms.php" method="get">
    <input type="hidden" name="act" value="new" />
    <input type="submit" value="Добавить новый" />
    </form>
    <?
}

else if ($_REQUEST[act] == 'new')
{
	NewRoom();
}

else if ($_REQUEST[act] == 'red' and $_REQUEST[red])
{
	RedactRoom($_REQUEST[red]);
}
?>
</body>
</html>