<?php
	error_reporting(0);
	session_start();

	$title_text = "Редактирование товара";
	require_once('piece/header.php');
	
	if ($_SESSION['secure'] == true) 
	{	
		require_once('piece/edit.php');						
	}
	else
		require_once('piece/login.php');
	require_once('piece/footers.php');
?>