<? 
include_once("config.php");
?>
<form action="newcourse.php" method="get">
<?
foreach ($_REQUEST as $key => $value)
{
	if ($key != 'new') 
	{
		echo("<input type=\"hidden\" name=\"".$key."\" value=\"".$value."\" />");
	}
}
?>
<p>Добавление кружка</p>
<p><label for="coursename">Название</label><input name="coursename" type="text" /></p>
<p><label for="coursedep">Отдел</label><select name="coursedep">
<?
$sql = mysql_query("SELECT * FROM Table_Departments");
while ($row = mysql_fetch_array($sql))
{
	echo("<option value=\"".$row[DepartmentID]."\">".$row[DepartmentName]."</option>");
}
?></select></p>
   
<p><label for="teachername">Учитель</label><select name="teachername">
<?
$sql = mysql_query("SELECT * FROM Table_Teachers");
while ($row = mysql_fetch_array($sql))
{
	echo("<option value=\"".$row[TeacherID]."\">".$row[TeacherName]."</option>");
}
?></select></p>
    
<p><label for="courseagemin">Минимальный возраст</label><select name="courseagemin">
    <option value="0" selected>Любой</option>
   	<?
	for ($i = 1; $i < 99; $i++) {
		echo "<option value='$i'>$i</option>";
	}
	?>
</select></p>

<p><label for="courseagemax">Максимальный возраст</label><select name="courseagemax">
    <option value="99" selected>Любой</option>
   	<?
	for ($i = 1; $i < 99; $i++) {
		echo "<option value='$i'>$i</option>";
	}
	?>
</select></p>

<p><label for="coursetype">Тип</label><select name="coursetype">
<?
$sql = mysql_query("SELECT * FROM Table_Type");
while ($row = mysql_fetch_array($sql))
{
	echo("<option value=\"".$row[TypeID]."\">".$row[TypeName]."</option>");
}
?></select></p>

<p><label for="coursepayment">Стоимость</label><input name="coursepayment" type="text" /></p>

<p><label for="coursedescription">Описание</label><textarea name="coursedescription"></textarea></p>

<p><label for="orgmeeting">Орг. собрание</label><input name="orgmeeting" type="text" /></p>

<p><input type="submit" value="Добавить" /></p>

</form>