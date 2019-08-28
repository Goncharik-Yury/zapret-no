<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
	setcookie("status","");
	setcookie("login","");
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>