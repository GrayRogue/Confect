<?php 
session_start();
require_once("../dbconnect.php");

$workers_name = $_POST['new_workers_name'];
$workers_pass = $_POST['new_workers_pass'] ;

$login_verification = mysql_query("SELECT login FROM Users WHERE login = '".$workers_name."' LIMIT 1");
$result_login_verification = mysql_fetch_array($login_verification);

if(isset($_POST['submit_add_new_worker']))
{
	if(empty($workers_name))
	{
		$_SESSION["add_message"] = "Пропущено поле логин";
		header("Location: ../admin_panel.php");
		exit();
	}
	if($result_login_verification['login'])
	{
		$_SESSION["add_message"] = "Такой логин уже занят";
		header("Location: ../admin_panel.php");
		exit();
	}
	if (preg_match( '/[^0-9a-zA-Zа-яА-Я\-\+=!\.,()\s]/u', $workers_name))  
	{
		$_SESSION["add_message"] = "Логин имеет лишний символ";
		header("Location: ../admin_panel.php");
		exit();
	} 
	if (!preg_match('|^[A-Z0-9]+$|i', $workers_name))  
	{
		$_SESSION["add_message"] = "Логин должен быть на английском языке";
		header("Location: ../admin_panel.php");
		exit();
	} 
	if(empty($workers_pass))
	{
		$_SESSION["add_message"] = "Пропущено поле пароль";
		header("Location: ../admin_panel.php");
		exit();
	}
	if(isset($_POST['new_workers_name']) and isset($_POST['new_workers_pass']))
	{
		$workers_pass = md5(md5($workers_pass));
		mysql_query("Insert into Users(login, password) Values('$workers_name','$workers_pass')");
		$_SESSION["add_message"] = "Администратор успешно добавлен";
	}
}

header("Location: ../admin_panel.php");
?>