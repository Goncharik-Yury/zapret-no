<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="style/style.css" />
<body>
<div id="home">
<a href="main.php">
	Главная
</a>
</div>
<?php
if(isset($_COOKIE['status']) and $_COOKIE['status']=='user')
{
	$link = mysql_connect("localhost", "root", "123456") or die("не хочет коннектить + ".mysql_error());
	mysql_select_db("zapret_no") or die("не хочет выбирать + ".mysql_error());
	mysql_set_charset('utf8');
	$query="SELECT * FROM users WHERE login='$_COOKIE[login]'";
	$info = mysql_query($query) or die("не хочет получать + ".mysql_error());
	mysql_close($link);
	$row = mysql_fetch_array($info);
	echo "<div style='margin-left:25%;'>";
	echo "<h1> Здравствуйте: $row[FIO]</h1>";
	echo "<br/>";
	echo "<h3>Ваш логин: $row[login]</h3>";
	echo "<h3>Ваш пароль: $row[password]</h3>";
	echo "<h5>Вы зарегистрировались: ",date('d:m:Y в G:i:s',$row['date']),"</h5>";
	echo "<br/>";
	echo "</div>";
}
else
{
	echo "<h1> Вам нельзя сюда</h1>";
}
?>