<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="reset.css" type="text/css">
<link rel="shortcut icon" href="image/logo.png" type="image/png">
<link href="https://fonts.googleapis.com/css?family=Cuprum|Open+Sans+Condensed:300|Yanone+Kaffeesatz" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<title><?php echo $title_text;?></title>

<script>
$(function() {
  var pull    = $('#pull');
    menu    = $('#menu ul');
    menuHeight  = menu.height();
 
  $(pull).on('click', function(e) {
    e.preventDefault();
    menu.slideToggle();
  });
});
	
$(window).resize(function(){
  var w = $(window).width();
  if(w > 320 && menu.is(':hidden')) {
    menu.removeAttr('style');
  }
}); 	
	</script>
</head>
<body>
<div id="headerInner">
	<div id="header">
			<div id="logo_img">
				<a href="index.php"><img src="image/logo.png" title="Вернуться на главную"></a>				
			</div>
			<div id="header_name">
				<span id="name">Кондитерская KappaPride</span><br>
				<span id="slogan">Наша выпечка самая свежая!</span><br>				
				<span id="header_contacts"><a href="tel: +7(863)60-25-25">&#9742; +7(863)60-25-25</a><br>
					Работаем с 9:00 до 18:00</span>
			</div>
			<div id="cart">
				<a href="cart.php"><img src="image/cart.png"> 
				<div id="cart_count">
					<p id="cartCount">
					<script>
						var sum = 0;
						setTimeout(function()
						{
							if(sessionStorage.getItem('count') !== null)
							{
								sum = JSON.parse(sessionStorage.getItem('count'));
								cartCount.innerHTML = sum;
							}
							else 
								cartCount.innerHTML = 0;							
						}, 20);						
					</script>
				 </p>
				</div><span id="cart_price">К оплате:<br>
				<p id="cartPrice">
					<script>
						var price = 0;
						setTimeout(function()
						{	
							if(sessionStorage.getItem('price') !== null)
							{
								price = JSON.parse(sessionStorage.getItem('price'));
								cartPrice.innerHTML = price;
							}
							else 
								cartPrice.innerHTML = 0;
						}, 20);						
					</script>
				 </p>&nbsp;₽</span></a>
			</div>
		<div id="menu">					
				<ul class="clearfix">
					<?php					
						require_once("dbconnect.php"); 						
						$sql = mysql_query("SELECT category FROM Tovar");
						$sql_page_name = mysql_query("SELECT page_name FROM Tovar");						
						while ($result_page_name = mysql_fetch_array($sql_page_name) and $result = mysql_fetch_array($sql)) 
						{
							echo '<li><a href="' . $result_page_name["page_name"] . '">' . $result["category"] . '</a></li>';
						}						
					?>	
				</ul>
				<a href="#" id="pull">Меню</a>
			</div>
	</div>
</div>