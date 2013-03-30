<? include_once("../config.php");	?>
<p>Добавление кабинета</p>
<form action="newroom.php" method="get">
<? foreach ($_REQUEST as $key => $value)
{
	if ($key != 'new') 
	{
		echo("<input type=\"hidden\" name=\"".$key."\" value=\"".$value."\" />");
	}
}
?>
<p><label for="roomname">Кабинет</label><input name="roomname" type="text" /></p>
<p><input type="submit" value="Добавить" /></p>
</form>