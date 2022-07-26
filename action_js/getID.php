<?php
	session_start();
	$_SESSION['id'] = null;
	$id = $_POST['id'];
	$_SESSION['id'] = $id;
?>