<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление кружка</title>
</head>

<body>
<?
include_once('config.php');

//типа проверка

if (!$_REQUEST['coursename'] and !$_REQUEST['coursedep'] 
		and !$_REQUEST['courseagemin'] and !$_REQUEST['courseagemax'] 
		and !$_REQUEST['coursecurrentyear'] and !$_REQUEST['coursetype']
		and !$_REQUEST['coursepayment'] and !$_REQUEST['coursedescription']
		and !$_REQUEST['teachername'] and !$_REQUEST['orgmeeting'])
{
	die('Something wrong');
}

dbchecking();

function courseadd(){
	$sql = mysql_query(
			"INSERT INTO Table_Courses "
			."(CourseName, DepartmentID, TeacherID, AgeMin, AgeMax, TypeID, Payment, Description, OrgMeeting) "
			."VALUES ('"
				.$_REQUEST['coursename']."', '"
				.$_REQUEST['coursedep']."', '"
				.$_REQUEST['teachername']."', '"
				.$_REQUEST['courseagemin']."', '"
				.$_REQUEST['courseagemax']."', '"
				.$_REQUEST['coursetype']."', '"
				.$_REQUEST['coursepayment']."', '"
				.$_REQUEST['coursedescription']."', '"
				.$_REQUEST['orgmeeting']."')") 
		or die(mysql_error());
	echo($_REQUEST['coursename']." added to db");
}

//проверка базы данных на присутствие
function dbchecking(){
	$sql = mysql_query("SELECT * FROM Table_Courses ".
						"WHERE CourseName LIKE '%".$_REQUEST['coursename']."%' "
						."AND DepartmentID = '".$_REQUEST['coursedep']."' "
						."AND TeacherID = '".$_REQUEST['teachername']."' "
						."AND AgeMin = '".$_REQUEST['courseagemin']."' "
						."AND AgeMax = '".$_REQUEST['courseagemax']."' "
						."AND TypeID = '".$_REQUEST['coursetype']."' "
						."AND Payment = '".$_REQUEST['coursepayment']."' "
						."AND OrgMeeting = '".$_REQUEST['orgmeeting']."' "
						."AND Description = '".$_REQUEST['coursedescription']."' ") or die(mysql_error());
	
	if (mysql_num_rows($sql) == 0) {
		courseadd();
	}
	else {
		echo ("Database already have record ".$_REQUEST['coursename']);
	}
	
}

// редирект, если пришли не со страницы listcourses
if ($_REQUEST['frompage']) 
{
	foreach ($_REQUEST as $key => $value)
	{
		if ($key == 'coursename' or $key == 'coursedep'
		or $key == 'courseagemin' or $key == 'courseagemax'
		or $key == 'coursecurrentyear' or $key == 'coursetype'
		or $key == 'coursepayment' or $key == 'coursedescription'
		or $key == 'teachername' or $key == 'orgmeeting'
		or $key == 'courseid') 
		{
			//relax
		}
		else
		{
			$From = $From."$key=$value&";
		}
	}
	$From = $From."courseid=".mysql_insert_id();
	echo($From."<br />");
	header("Location: ".$_REQUEST['frompage']."?".$From);
}

else
{
	header('Location: listcourses.php');
}


?>
</body>
</html>