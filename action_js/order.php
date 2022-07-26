<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
require_once("../dbconnect.php");

$cartData = $_POST['cart'];
$count = mysql_query('SELECT * FROM assortiment_tovarov');
$name_client = $_POST['name_client'];
$telephone = $_POST['telephone'];
$street = $_POST['street'];
$home = $_POST['home'];
$housing = $_POST['housing'];
$apartment = $_POST['apartment'];
$payment = $_POST['payment']; 
$residue = $_POST['residue'];
$deliverment = $_POST['deliverment'];
$order_token = $_POST['order_token'];

for($i = 0; $i < mysql_num_rows($count); $i++)
{
	if($cartData[$i][0] != null && $name_client != null && $telephone != null && $street != null && $home != null && $housing != null && $apartment != null && $payment != null && $residue != null && $deliverment != null)
		mysql_query('insert into Orders(first_name_client, telephone_client, street_client, home_client, housing_home_client, apartment_client, delivery_method, payment, residue, tovar_name, total_price, tovar_id, date, order_token) values("'.$name_client.'", "'.$telephone.'", "'.$street.'", "'.$home.'", "'.$housing.'", "'.$apartment.'", "'.$deliverment.'", "'.$payment.'", "'.$residue.'", "'.$cartData[$i][0].'", "'.$cartData[$i][3].'", "'.$cartData[$i][4].'", "'.date("Y-n-j").'", "'.$order_token.'")');
}
?>