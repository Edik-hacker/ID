<?php
$host     = "localhost";
$user     = "root";
$password = "";
$bd       = "internetdevels";
$db = mysql_connect($host, $user, $password);

mysql_query ("set character_set_client='cp1251'");
mysql_query ("set character_set_results='cp1251'");
mysql_query ("set collation_connection='cp1251_general_ci'");

mysql_select_db($bd, $db);

?>