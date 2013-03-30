<? include_once("../config.php");	?>
<form action="newdep.php">
<p>Добавление отдела</p>
<p><label for="depname">Название отдела</label><input type="text" name="depname" /></p>
<p><label for="depphone">Телефон</label><input type="text" name="depphone" /></p>
<p><label for="depboss">Заведующий</label><input type="text" name="depboss" /></p>
<p><label for="depbossphone">Телефон заведующего</label><input type="text" name="depbossphone" /></p>
<input type="submit" value="Добавить" />
</form>