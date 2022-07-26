<?php
	error_reporting(0);
	session_start();

	$add_message = $_SESSION["add_message"];
	$_SESSION["add_message"] = null;

	$del_message = $_SESSION["del_message"];
	$_SESSION["del_message"] = null;

	$add_tov_message = $_SESSION["add_tov_message"];
	$_SESSION["add_tov_message"] = null;

	$edit_tov_message = $_SESSION["edit_tov_message"];
	$_SESSION["edit_tov_message"] = null;

	$title_text = "Административная панель";
	require_once('piece/header.php');
	
	if ($_SESSION['secure'] == true) 
	{	
		require_once('piece/admin.php');						
	}
	else
		require_once('piece/login.php');
	require_once('piece/footers.php');
?>