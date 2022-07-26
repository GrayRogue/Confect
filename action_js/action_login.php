<?php 
session_start();
require_once("../dbconnect.php");
//АВТОРИЗАЦИЯ ПОЛЬЗОВАТЕЛЯ
if (isset($_POST['login_button']))
{
	$login = (isset($_POST['login_field'])) ? mysql_real_escape_string($_POST['login_field']) : ''; //Получили логин
	$password = (isset($_POST['password_field'])) ? mysql_real_escape_string($_POST['password_field']) : ''; //Получили пароль
	$password = md5(md5($password)); //Получили хеш
	$select_result = mysql_query("SELECT id, password FROM Users WHERE login = '".$login."' LIMIT 1"); //Берем из базы хеш
	$row = mysql_fetch_assoc($select_result);
	$password_from_base = $row['password'];//Хеш пароля из базы
	$id_from_base = $row['id']; 	
	$_SESSION["login_fields"] = $login;
	//Проверка login
	if (preg_match( '/[^0-9a-zA-Zа-яА-Я\-\+=!\.,()\s]/u', $login ))  
	{
		$_SESSION["error_message"] = "В логине присутствует лишний символ";
		header("Location: ../admin_panel.php");
		exit();
	} 
	if (empty($login))  
	{
		$_SESSION["error_message"] = "Пропущен логин";
		header("Location: ../admin_panel.php");
		exit();
	} 
	if ($_POST['password_field'] == "")  
	{
		$_SESSION["error_message"] = "Пропущен пароль";
		header("Location: ../admin_panel.php");
		exit();
	} 
	//Если пароль верный
	//Хеши паролей совпали - Значит всё верно.
	if ($password_from_base == $password)
	{	
		//Обновляем данные пользователя
		$login_time = time() + (24 * 60 * 60);
		$last_login_time = date('G:i:s',$login_time);
		$last_login_ip = $_SERVER['REMOTE_ADDR'];
		mysql_query("UPDATE Users SET last_login_time = '$last_login_time', last_login_ip='$last_login_ip' WHERE login='$login'"); 

		//Итак, выше мы всё проверили, данные в БД обновили (ну интересно же, когда пользователь зашел и с какого ip)
		//Теперь записываем true в сессию и перенаправим его на личную страницу. 
		$_SESSION['secure'] = true;
		//Переадресация на персональную страницу
		header("Location: ../admin_panel.php");
	}
	else //Иначе - если пароль не верный
	{
		//Переадресация на страницу авторизации
		$_SESSION["error_message"] = "Неверный пароль";
		header("Location: ../admin_panel.php");
		exit();
	}
	header("Location: ../admin_panel.php");
}
?>