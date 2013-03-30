<? 
session_start();
$db_user = "user";
$db_password = "STPZtdmsbDHpKrje";
$db_server = "localhost";
$db_select = "mddm";
//$db_connect = mysql_connect("localhost", "gavr", "joker_prod))") or die("Could not connect database".mysql_error());
$db_connect = mysql_connect($db_server, $db_user, $db_password) or die("Could not connect database".mysql_error());
mysql_select_db($db_select, $db_connect)  or die("Could not select database".mysql_error());
mysql_set_charset('utf8');
?>