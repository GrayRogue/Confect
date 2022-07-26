<?php 
session_start();
require_once("../dbconnect.php");

$new_tovars_name = $_POST['new_tovars_name'];
$tovar_category = $_POST['tovar_category'];
$new_tovars_price = $_POST['new_tovars_price'];
$new_tovars_disc = $_POST['new_tovars_disc'];
$new_tovars_keep = $_POST['new_tovars_keep'];

if(isset($_POST['submit_add_new_tovar']))
{
	$file_name = $_FILES['new_tovars_uploadfile']['name'];
	$file_size = $_FILES['new_tovars_uploadfile']['size'];
	$file_tmp = $_FILES['new_tovars_uploadfile']['tmp_name'];
	$file_type = $_FILES['new_tovars_uploadfile']['type'];
	
	$Newfile_type = substr($file_type, 0, 0);
	
	if(empty($new_tovars_name))
	{
		$_SESSION["add_tov_message"] = "Пропущено поле наименования товара";
		header("Location: ../admin_panel.php");
		exit();
	}
	if(empty($file_name))
	{
		$_SESSION["add_tov_message"] = "Пропущен выбор изображения товара";
		header("Location: ../admin_panel.php");
		exit();
	}
	if(empty($new_tovars_price))
	{
		$_SESSION["add_tov_message"] = "Пропущено поле цены товара";
		header("Location: ../admin_panel.php");
		exit();
	}
	if(empty($new_tovars_disc))
	{
		$_SESSION["add_tov_message"] = "Пропущено поле описания товара";
		header("Location: ../admin_panel.php");
		exit();
	}
	if(empty($new_tovars_keep))
	{
		$_SESSION["add_tov_message"] = "Пропущено поле энерг. ценности товара";
		header("Location: ../admin_panel.php");
		exit();
	}
	if (!move_uploaded_file($file_tmp,'../tovarspictures/'.$_FILES['new_tovars_uploadfile']['name']))
	{
		header("Location: ../admin_panel.php");
	}
	mysql_query("Insert into assortiment_tovarov(name,tovar_category,picture,price,description,keep) Values('".$new_tovars_name."', '".$tovar_category."', '".$file_name.$Newfile_type."', '".$new_tovars_price."', '".$new_tovars_disc."', '".$new_tovars_keep."')");
	$_SESSION["add_tov_message"] = "Товар успешно добавлен";
}

header("Location: ../admin_panel.php");
?>