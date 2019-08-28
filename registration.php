<html>
<head><title>country</title>
<link rel="stylesheet" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/registration.css" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<div id="header" style="position: absolute;">
</div>
<script>
function validate()
{
	var login=document.forms["login_form"]["login"].value;
	var password=document.forms["login_form"]["password"].value;
	if ((/[^\w]/.test(login) || login.length==0))
	{
		alert("Неверный формат ввода логина");
		return false;
	}
	if ((/[^\w]/.test(password) || password.length==0))
	{
		alert("Неверный формат ввода пароля");
		return false;
	}
	return true;
}
function validate_FIO()
{
	var FIO=document.forms["info_form"]["FIO"].value;
	if ((/[^\w]/.test(FIO) || FIO.length==0))
	{
		alert("Неверный формат ввода ФИО");
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div id="home">
<a href="main.php">
	Домой
</a>
</div>
<?php
// Сообщение регистрации
if(isset($_POST['step']) and $_POST['step']>=1 and $_POST['step']<=2)
	call_user_func("action".(int)$_POST["step"]);
else page1();

function setvalue($name){
	if(isset($_POST["$name"]))
		echo $_POST["$name"];
}

function setchecked($name,$value){
	if(isset($_POST["$name"]) and $_POST["$name"]==$value)
	echo "checked=checked";
}

function setselected($name,$value){
	if(isset($_POST["$name"]) and $_POST["$name"]==$value)
		echo "selected=selected";
}

function action1()
{

	if(isset($_POST["submit"]) and $_POST["submit"]=="Далее")page2();
	else page1();
}

function action2()
{
	if(isset($_POST["submit"]) and $_POST["submit"]=="Далее")page3();
	else page1();
}

function page1()
{
	?>
	<div class="main">
	<form method="POST" name="login_form" onsubmit="return validate()" action="<?php $_SERVER['PHP_SELF']; ?>">
		<input type="hidden" name="step" value="1">
		Логин:<input id="loginf" type="text" class="text" name="login" value="<?php setvalue('login') ?>"/><br/>
		Пароль:<input id="passwordf" type="text" class="text" name="password" value="<?php setvalue('password') ?>" /><br/>
		<input type="hidden" name="FIO" value="<?php setvalue('FIO') ?>"/>
		<input type="hidden" name="gender" value="<?php setvalue('gender') ?>" />
		<input type="hidden" name="country" value="<?php setvalue('country') ?>" />
		<input type="hidden" name="comment" value="<?php setvalue('comment') ?>" />
		<input class="button" type="submit" name="submit" value="Далее">
	</form>
	</div>
	<?php
}

function page2()
{
	?>
	<div class="main">
		<form method="POST" onsubmit="return validate_FIO()" name="info_form" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="step" value="2">
			<input type="hidden" name="login" value="<?php setvalue('login') ?>"/>
			<input type="hidden" name="password" value="<?php setvalue('password') ?>" />
			ФИО:<input id="FIOf" type="text" class="text" name="FIO" value="<?php setvalue('FIO') ?>"/><br/>
			Male: <input type="radio" class="radio" name="gender" value="Male" 
				<?php setchecked('gender', 'Male') ?>> <br/>
			Female: <input type="radio" class="radio" name="gender" value="Female" 
				<?php setchecked('gender', 'Female') ?>><br/>
			Страна:<br/>
			<select name="country">
				<option value="Белоруссия" <?php setselected('country', 'Белоруссия') ?>>Белоруссия</option>
				<option value="Россия" <?php setselected('country', 'Россия') ?>>Россия</option>
				<option value="Таджикистан" <?php setselected('country', 'Таджикистан') ?>>Таджикистан</option>
				<option value="Кыргызстан" <?php setselected('country', 'Кыргызстан') ?>>Кыргызстан</option>
			</select><br/>
			О себе:<br/>
			<textarea cols="25" rows="5" name="comment" value="<?php setvalue('comment') ?>"><?php setvalue('comment') ?></textarea><br/>
			<input class="button" type="submit" name="submit" value="Назад">
			<?php 		
			if(!empty($_POST['login']) and !empty($_POST['password']))
				{
					echo '<input class="button" type="submit" name="submit" value="Далее">';
				}
		?>
		</form>
	</div>

	<?php } ?>

<?php
function page3()
{
	//echo "DB.php here<br/>";
	$link = mysql_connect("localhost", "root", "123456") or die(mysql_error());
	mysql_select_db("zapret_no") or die(mysql_error());

	$date=date('U');
	$user = "INSERT INTO users(";
	$user = $user."login, ";
	$user = $user."password, ";
	$user = $user."FIO, ";
	if(isset($_POST['gender'])){
		$user = $user."gender, ";}
	$user = $user."country, ";
	$user = $user."date, ";
	$user = $user."comment) ";
	$user = $user."VALUES (";
	$user = $user."'$_POST[login]', ";
	$user = $user."'$_POST[password]', ";
	$user = $user."'$_POST[FIO]', ";
	if(isset($_POST['gender'])){
		$user = $user."'$_POST[gender]', ";}
	$user = $user."'$_POST[country]', ";
	$user = $user."'$date', ";
	$user = $user."'$_POST[comment]')";
	mysql_set_charset('utf8');

	if(!mysql_query($user))
	{
		mysql_close($link);
		?><script>alert("Логин занят");</script>	
	<form method="POST" name="last_form" action="<?php $_SERVER['PHP_SELF']; ?>">
		<input type="hidden" name="step" value="0">
		<input type="hidden" name="login" value="<?php setvalue('login') ?>"/>
		<input type="hidden" name="password" value="<?php setvalue('password') ?>" />
		<input type="hidden" name="FIO" value="<?php setvalue('FIO') ?>"/>
		<input type="hidden" name="gender" value="<?php setvalue('gender') ?>" />
		<input type="hidden" name="country" value="<?php setvalue('country') ?>"/><br/>
		<input type="hidden" name="comment" value="<?php setvalue('comment') ?>"/><br/>
	</form>
	<script>document.last_form.submit();
	</script>
	<?php
		?><div id="home">
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
				Назад
			</a>
			</div><?php
	}
	else
	{
		mysql_close($link);
		?><script>alert("Регистрация удалась");</script><?php
	}
}
?>
</body>
</html>