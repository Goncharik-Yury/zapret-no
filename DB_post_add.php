<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
	$link = mysql_connect("localhost", "root", "123456") or die("не хочет коннектить + ".mysql_error());
	mysql_select_db("zapret_no") or die("не хочет выбирать + ".mysql_error());

	$_POST['post_text']=nl2br($_POST['post_text']);

	$dir = "photos/$_POST[id_page]/";
	for($i=0;$i<4;++$i)
	{
		$_FILES['post_photo']['name'][$i]=preg_replace("/ /", "_", $_FILES['post_photo']['name'][$i]);
		$post_photo = $dir.$_FILES['post_photo']['name'][$i];
		$j=$i+1;
		$_POST['post_text'] = preg_replace("/<img $j>/","<img src=\"$post_photo\">",$_POST['post_text']);
		move_uploaded_file($_FILES['post_photo']['tmp_name'][$i], $post_photo);
	}
	
	if(empty($_POST['header']))
	{
		$_POST['header']="Empty";
	}

	$date=date('U');
	$post = "INSERT INTO posts(";
	$post = $post."id_page, ";
	$post = $post."header, ";
	$post = $post."date, ";
	$post = $post."post_text) ";
	$post = $post."VALUES (";
	$post = $post."'$_POST[id_page]', ";
	$post = $post."'$_POST[header]', ";
	$post = $post."'$date', ";
	$post = $post."'$_POST[post_text]')";
	mysql_set_charset('utf8');

	mysql_query($post) or die("не хочет писаить + ".mysql_error());
	mysql_close($link);
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>