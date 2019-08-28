<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php

function get_from_db($query)
{
	$link = mysql_connect("localhost", "root", "123456") or die("не хочет коннектить + ".mysql_error());
	mysql_select_db("zapret_no") or die("не хочет выбирать + ".mysql_error());
	mysql_query("SET NAMES 'utf8'");

	$info = mysql_query($query) or die("не хочет получать + ".mysql_error());
	mysql_close($link);
	return $info;
}
?>