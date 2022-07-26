<?php session_start(); ?>
<?php	
error_reporting(0);
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
	require_once("../dbconnect.php");
	$id = $_POST['id'];
	$name = $_POST['name'];
	$category = $_POST['category'];
	$photo = $_POST['photo'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$keep = $_POST['keep'];

	$FirstQuery = mysql_query('select * from assortiment_tovarov where id="'.$id.'"');
	$resultFirstQuery = mysql_fetch_array($FirstQuery);
	
	if($name != $resultFirstQuery['name'])
		$resultFirstQuery['name'] = $name;
	if($category != $resultFirstQuery['tovar_category'] && $category != "0")
		$resultFirstQuery['tovar_category'] = $category;
	if($photo != '')
		$resultFirstQuery['picture'] = $photo;
	if($price != $resultFirstQuery['price'])
		$resultFirstQuery['price'] = $price;
	if($description != $resultFirstQuery['description'])
		$resultFirstQuery['description'] = $description;
	if($keep != $resultFirstQuery['keep'])
		$resultFirstQuery['keep'] = $keep;

	mysql_query("Update assortiment_tovarov Set name = '".$resultFirstQuery['name']."', tovar_category = '".$resultFirstQuery['tovar_category']."', picture = '".$resultFirstQuery['picture']."', price = '".$resultFirstQuery['price']."', description = '".$resultFirstQuery['description']."', keep = '".$resultFirstQuery['keep']."' Where id = '$id'");

	$_SESSION["id"] = $id;
	$_SESSION["upd_message"] = "Информация успешно обновлена";	
?>