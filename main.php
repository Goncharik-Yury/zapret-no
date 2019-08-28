<html>
<head>
	<title>zapret_no</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link href="images/icon.jpg" />
	<!-- подключение css -->
	<link rel="stylesheet" href="style/style.css" />
	<script src="js/main.js"></script>
	<?php require 'DB_post_get.php';?>
</head>
<body onload="startTime()">
<div id="header">
</div>

<!-- Логинация -->
<?php if(isset($_COOKIE['status']) and $_COOKIE['status']=='admin')
{?>
<div id="reg">
<a href="admin.php">Домой</a>
<a href="logoff.php">Выход</a>
</div>

<?php }
	elseif (isset($_COOKIE['status']) and $_COOKIE['status']=='user')

	{?>
<div id="reg">
<a href="user.php">Домой</a>
<a href="logoff.php">Выход</a>
</div>
<?php }else{ ?>
<div id="reg">
	<form method="POST" name="registration" action="login.php">
		<label>Логин</label>
		<input type="text" name="login" size="8">
		<label>Пароль</label>
		<input type="password" name="password"size="8">
		<input type="submit" name="submit" value="login" style="font-size: 8pt; height: 15pt;">
	</form>
	<a href="registration.php">Регистрация</a>
</div>	 
<?php }?>



<!-- Тест див -->
<div id="test">
<?php
?>
<script>
</script>
<?php
// echo "<pre>";
// echo "</pre>";
?>
</div>

<!-- Левая колонка -->
<div id="left_bar" class="bg">
	<div id="articles">
		<div class="theme">Статьи
		</div>
		<div id="refs">
		<?php 
			$info = get_from_db('SELECT id, header FROM posts ORDER BY id DESC');

			for(;;)
			{

				if(!$row = mysql_fetch_array($info))break;
				echo "<p><a href=\"#$row[id]\">$row[header]</a></p><hr>";
			}
		?>
		</div>
	</div>
</div>

<!-- Центральная колонка -->
<div id="mid_bar">
<?php
	$info = get_from_db("SELECT * FROM posts ORDER BY id DESC");
	while($row = mysql_fetch_array($info))
	{?>
	<div class='post bg' id="<?php echo $row['id'];?>">
		<div class='theme bg'>
			<span class="post_header">
				<?php echo $row['header'];?>
			</span>
			<span class="post_date">
				<?php echo date('D:M:Y - G:i:s',$row['date']);?> 
			</span>
		</div>
		<div class="post_text"><?php echo $row['post_text'];?>
		</div>
	</div>
	<?php }?>
</div>

<?php
if(isset($_COOKIE['status']) and $_COOKIE['status']=='admin')
{?>

<!-- Поле комментов -->

<?php }?>

<!-- Футер -->
<div class="bg" id="fun_bar">
	<span id="time"></span>
	<span><a href="#header">В начало</a></span>
	<span onclick="dayTime()">Приветствие</span>
</div>
</body>
</html>