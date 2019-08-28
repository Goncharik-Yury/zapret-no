<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
	$link = mysql_connect("localhost", "root", "123456") or die("не хочет коннектить + ".mysql_error());
	mysql_select_db("zapret_no") or die("не хочет выбирать + ".mysql_error());
	mysql_set_charset('utf8');
	$query="SELECT password, status FROM users WHERE login='$_POST[login]'";
	$info = mysql_query($query) or die("не хочет получать + ".mysql_error());
	mysql_close($link);
	$row = mysql_fetch_array($info);
	if($row['password']==$_POST['password'])
	{
		setcookie("status",$row["status"], time()+60*60*24*14);
		setcookie("login",$_POST["login"], time()+60*60*24*14);
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>