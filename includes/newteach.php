<? include_once("../config.php"); ?>
	<p>Добавление учителя</p>
    <form action="newteach.php" method="get">
    <p><label for="teachname">ФИО учителя</label><input name="teachname" type="text" /></p>
    <p><label for="teachphone">Телефон учителя</label><input name="teachphone" type="text" /></p>
    <p><label for="teachdep">Отдел</label><select name="teachdep">
	<?
	$sql = mysql_query("SELECT * FROM Table_Departments");
	while ($row = mysql_fetch_array($sql))
	{
		echo("<option value=\"".$row[DepartmentID]."\">".$row[DepartmentName]."</option>");
	}
	?></select><button type="submit" name="new" value="dep">Добавить отдел</button></p>
    <p><input type="submit" value="Добавить" /></p>
    </form>
	