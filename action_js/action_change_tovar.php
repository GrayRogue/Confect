<?php 
session_start();
require_once("../dbconnect.php");

$search_tovars_name = $_POST['tovar_name'];
$checkBox = $_POST['chb'];
$change_tovars_name = $_POST['change_tovars_name'];
$tovar_category = $_POST['tovar_category'];
$change_uploadfile = $_POST['change_uploadfile'];
$change_tovars_price = $_POST['change_tovars_price'];
$change_tovars_desc = $_POST['change_tovars_desc'];
$change_tovars_keep = $_POST['change_tovars_keep'];

if(isset($_POST['submit_change_tovar']) and !empty($search_tovars_name))
{
	$SelectTovar = mysql_query("Select * From assortiment_tovarov Where name = '$search_tovars_name'");
	$ResultSelectTovar = mysql_fetch_array($SelectTovar);
	$id = $ResultSelectTovar['id'];
	$ResultSelectTovar['name'];
	$ResultSelectTovar['tovar_category'];
	$ResultSelectTovar['picture'];
	$ResultSelectTovar['price'];
	$ResultSelectTovar['description'];
	$ResultSelectTovar['keep'];

	$N = count($checkBox);
	for($i=0; $i < $N; $i++)
    {
	  	$a = array($checkBox[$i]);
		
		if(in_array(1, $a) and !empty($change_tovars_name))
		{
			$ResultSelectTovar['name'] = $change_tovars_name;
		}

		if(in_array(2, $a) and !empty($tovar_category))
		{
			$ResultSelectTovar['tovar_category'] = $tovar_category;
		}
		
		if(in_array(3, $a) and !empty($_FILES['uploadfile']))
		{
	
			$file_name = $_FILES['uploadfile']['name'];
			$file_size = $_FILES['uploadfile']['size'];
			$file_tmp = $_FILES['uploadfile']['tmp_name'];
			$file_type = $_FILES['uploadfile']['type'];

			$Newfile_type = substr($file_type, 0, 0);

			if (!move_uploaded_file($file_tmp,'../tovarspictures/'.$_FILES['uploadfile']['name']))
			{
				header("Location: ../admin_panel.php");
			}
			$ResultSelectTovar['picture'] = $file_name.$Newfile_type;
		}
		
		if(in_array(4, $a) and !empty($change_tovars_price))
		{
			$ResultSelectTovar['price'] = $change_tovars_price;
		}
		
		if(in_array(5, $a) and !empty($change_tovars_desc))
		{
			$ResultSelectTovar['description'] = $change_tovars_desc;
		}
		
		if(in_array(6, $a) and !empty($change_tovars_keep))
		{
			$ResultSelectTovar['keep'] = $change_tovars_keep;
		}
	}
	mysql_query("Update assortiment_tovarov Set name = '".$ResultSelectTovar['name']."', tovar_category = '".$ResultSelectTovar['tovar_category']."', picture = '".$ResultSelectTovar['picture']."', price = '".$ResultSelectTovar['price']."', description = '".$ResultSelectTovar['description']."', keep = '".$ResultSelectTovar['keep']."' Where id = '$id'");
	$_SESSION["edit_tov_message"] = "Изменения успешно сохранены";
}

header("Location: ../admin_panel.php");
?>