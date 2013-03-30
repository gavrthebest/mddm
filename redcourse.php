<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование кружка</title>
</head>

<body>
<?
header('Location: listcourses.php');
if (!$_REQUEST['coursename'] and !$_REQUEST['coursedep'] 
		and !$_REQUEST['courseagemin'] and !$_REQUEST['courseagemax'] 
		and !$_REQUEST['coursecurrentyear'] and !$_REQUEST['coursetype']
		and !$_REQUEST['coursepayment'] and !$_REQUEST['coursedescription']
		and !$_REQUEST['teachername'] and !$_REQUEST['orgmeeting'] 
		and !$_REQUEST['courseid'])
{
	echo('Something wrong');
	break;
}

include_once("config.php");

mysql_query("UPDATE Table_Courses SET CourseName = '".$_REQUEST['coursename']."', "
					."DepartmentID = '".$_REQUEST['coursedep']."', "
					."TeacherID = '".$_REQUEST['teachername']."', "
					."AgeMin = '".$_REQUEST['courseagemin']."', "
					."AgeMax = '".$_REQUEST['courseagemax']."', "
					."TypeID = '".$_REQUEST['coursetype']."', "
					."Payment = '".$_REQUEST['coursepayment']."', "
					."Description = '".$_REQUEST['coursedescription']."', "
					."OrgMeeting = '".$_REQUEST['orgmeeting']
					."' WHERE CourseID = ".$_REQUEST['courseid']) or die(mysql_error());
?>
</body>
</html>
