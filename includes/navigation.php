<? // ----- постраничный вывод
// смотрим, сколько у нас всего результатов
$sql = mysql_query("SELECT COUNT(*) "
				."FROM Table_Schedules, Table_Courses, Table_Days, Table_Rooms "
				."WHERE Table_Schedules.DayID = Table_Days.DayID "
					."AND Table_Schedules.RoomID = Table_Rooms.RoomID "
					."AND Table_Schedules.CourseID = Table_Courses.CourseID ");

$numResults = mysql_result($sql, 0);

// выводим определённый диапазон. How do it do it? Nobody knows.
if (isset($_REQUEST['start']) and $_REQUEST['start'] != '')
{
	if ($numResults > $_REQUEST['start']) 
	{
		$Page = $_REQUEST['start'] / $ResultsPerPage;
		if (($_REQUEST['start'] + $ResultsPerPage) < $numResults) 
		{
			$Page = $_REQUEST['start'] / $ResultsPerPage;
			$sqlLimit = "LIMIT ".$_REQUEST['start'].", ".$ResultsPerPage;
		}
		else
		{
			$sqlLimit = "LIMIT ".$_REQUEST['start'].", ".$numResults;
		}
	}
	
	else 
	{
		if ($numResults > $ResultsPerPage)
		{
			$Page = $numResults / $ResultsPerPage;
			$sqlLimit = "LIMIT ".($numResults - $ResultsPerPage).", ".$ResultsPerPage;
		}
		
		else 
		{
			$Page = 0;
			$sqlLimit = "LIMIT 0, ".$numResults;
		}
	}
}

else
{
	if ($numResults > $ResultsPerPage)
	{
		$sqlLimit = "LIMIT 0, ".$ResultsPerPage;
		$Page = 0;
	}
	
	else 
	{
		$Page = 0;
		$sqlLimit = "LIMIT 0, ".$numResults;
	}
}

$NumPages = $numResults / $ResultsPerPage;

$NumPages = ceil($NumPages);
$Page = ceil($Page);

function ShowPages($Page, $NumPages, $ResultsPerPage) {
	$FirstPage = "";
	$PrevPage = "";
	$NextPage = "";
	$LastPage = "";
	
	$tmp = explode("?",$_SERVER['REQUEST_URI']);
	
	$RedirectPage = $tmp[0];
	
	$Page++;
	
	if ($Page > 2) 
	{
		$FirstPage = "<a href=\"".$RedirectPage."?start=0\">&lt;&lt;</a>&nbsp;&nbsp;";
	}
	
	if ($Page > 1)
	{
		$PrevPage = "<a href=\"".$RedirectPage."?start=".(($Page * $ResultsPerPage) - ($ResultsPerPage * 2))."\">&lt;</a>&nbsp;&nbsp;";
	}
	
	if (($NumPages - $Page) >= 2)
	{
		$NextPage = "<a href=\"".$RedirectPage."?start=".($Page * $ResultsPerPage)."\">&gt;</a>&nbsp;&nbsp;";
	}
	
	if (($NumPages - $Page) >= 2)
	{
		$LastPage = "<a href=\"".$RedirectPage."?start=".(($NumPages - 1) * $ResultsPerPage)."\">&gt;&gt;</a>&nbsp;&nbsp;";
	}
	
	if (($Page - 1) > 0) 
	{
		$Page1 = "<a href=\"".$RedirectPage."?start=".(($Page * $ResultsPerPage) - ($ResultsPerPage * 2))."\">".($Page - 1)."</a>&nbsp;&nbsp;";
	}
	
	if (($Page + 1) <= $NumPages) 
	{
		$Page2 = "<a href=\"".$RedirectPage."?start=".($Page * $ResultsPerPage)."\">".($Page + 1)."</a>&nbsp;&nbsp;";
	}
	
	echo "Страницы:&nbsp;&nbsp;".$FirstPage.$PrevPage.$Page1.$Page."&nbsp;&nbsp;".$Page2.$NextPage.$LastPage;
}
?>