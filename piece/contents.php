<script src="./jquery.spinner.js"></script>
<script>
$("#spinner")
  .spinner('delay', 200) //delay in ms
  .spinner('changed', function(e, newVal, oldVal) {
    // trigger lazed, depend on delay option.
  })
  .spinner('changing', function(e, newVal, oldVal) {
    // trigger immediately
  });
</script>						

<?php
	require_once("dbconnect.php");	
	
	$sqlTovQuery = mysql_query('Select * from assortiment_tovarov where tovar_category = "'.$title_text.'"');	

	echo '<div id="wrapper">
		<div id="middle">
			<div id="content_tovars">';

			if ($resultTovQuery = mysql_fetch_array($sqlTovQuery))
			{
				$resultTovQuery["id"];
				$resultTovQuery["picture"];
				$resultTovQuery["tovar_category"];
				$resultTovQuery["name"];
				$resultTovQuery["price"];
				$resultTovQuery["description"];
				$resultTovQuery["keep"];
			}
			
			mysql_data_seek($sqlTovQuery, 0);
			while ($resultTovQuery = mysql_fetch_array($sqlTovQuery))
			{	
				echo '<div class="tovar_block">';
					$way = '"tovarspictures/';
					$wayout = '">';
					echo '<div class="tovar_pic">';
						echo '<img src=' . $way . $resultTovQuery["picture"] . $wayout . '</a>';
					echo '</div>';
					echo '<div class="tovar_info">';
						echo '<div class="tovar_title">';
							echo '<span class="item_title">'.$resultTovQuery["name"].'</span>';
						echo '</div>';
						echo '<div class="tovar_desc">';
							echo '<p>'.$resultTovQuery["description"].'</p>';
						echo '</div>';
						echo '<div class="tovar_product_info">';
							echo '<div class="product_keep">';
								echo '<p>'.$resultTovQuery["keep"].'</p>';
							echo '</div>';
							echo '<div class="product_price">';
								echo '<p>Цена: <span class="item_price">'.$resultTovQuery["price"].'</span>&#x20bd;</p>';
							echo '</div>';
						echo '</div>';
						echo '<div class="tovar_controls" data-trigger="spinner">';
							echo '<div class="cart_count">';
								echo '<div class="add_block">';									
								echo '</div>';
								echo '<div>';
									  echo '<input type="text" class="count_txt" value="1" data-max = "100" data-min = "1"  data-ruler="quantity" readonly>';
								echo '</div>';										
							echo '</div>';
							echo '<div class="btns">';
								echo '<button class="count_btn_plus"  type="button" data-spin="up"></button>';
								echo '<button class="count_btn_minus" type="button" data-spin="down"></button>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '<button class="add_to_cart" data-id="'.$resultTovQuery["id"].'">Заказать</button>';
				echo '</div>';
			}
			echo'<div id="cart_content"></div>';
		echo'</div><!-- Конец контент -->		
	</div><!-- Конец мидл -->
</div><!-- Конец врапер -->';
?>

<script type="text/javascript">
var d = document,
     itemBox = d.querySelectorAll('.tovar_block'), // блок каждого товара
		cartCont = d.getElementById('cart_content'); // блок вывода данных корзины
// Функция кроссбраузерная установка обработчика событий
function addEvent(elem, type, handler){
  if(elem.addEventListener){
    elem.addEventListener(type, handler, false);
  } else {
    elem.attachEvent('on'+type, function(){ handler.call( elem ); });
  }
  return false;
}
// Получаем данные из LocalStorage
function getCartData(){
	return JSON.parse(sessionStorage.getItem('cart'));
}
// Записываем данные в LocalStorage
function setCartData(o){
	sessionStorage.setItem('cart', JSON.stringify(o));
	return false;
}
// Добавляем товар в корзину
function addToCart(e)
	{
	this.disabled = true; // блокируем кнопку на время операции с корзиной
	var cartData = getCartData() || {}, // получаем данные корзины или создаём новый объект, если данных еще нет
			parentBox = this.parentNode, // родительский элемент кнопки &quot;Добавить в корзину&quot;
			itemId = this.getAttribute('data-id'), // ID товара
			itemTitle = parentBox.querySelector('.item_title').innerHTML, // название товара
			itemCoutBox = parentBox.querySelector('.count_txt').value, // количество товара в count_txt
			itemPic = parentBox.querySelector('.tovar_pic').innerHTML,
			itemPrice = parentBox.querySelector('.item_price').innerHTML; // стоимость товара
	if(cartData.hasOwnProperty(itemId))
	{ // если такой товар уже в корзине, то добавляем +1 к его количеству
		cartData[Number(itemId)][2] += Number(itemCoutBox);
		cartData[Number(itemId)][3] += itemPrice*Number(itemCoutBox);
	} 
		else { // если товара в корзине еще нет, то добавляем в объект
		cartData[Number(itemId)] = [itemTitle, Number(itemPrice), Number(itemCoutBox), itemPrice*Number(itemCoutBox), itemId, itemPic];
	}
		//console.log(JSON.stringify(cartData));
	// Обновляем данные в LocalStorage
	if(!setCartData(cartData))
	{ 
		this.disabled = false; // разблокируем кнопку после обновления LS
		cartCont.innerHTML = '';
		setTimeout(function()
		{
			cartCont.innerHTML = '';
		}, 1000);
		setTimeout(function()
		{
			var TotalSum, TotalPrice;
			
			TotalPrice = JSON.parse(sessionStorage.getItem('price'));
			cartPrice.innerHTML = '';
			cartPrice.innerHTML = TotalPrice;

			TotalSum = JSON.parse(sessionStorage.getItem('count'));
			cartCount.innerHTML = '';
			cartCount.innerHTML = TotalSum;
							
		}, 20);
	}
	return false;
}
// Устанавливаем обработчик события на каждую кнопку &quot;Добавить в корзину&quot;
for(var i = 0; i < itemBox.length; i++){
	addEvent(itemBox[i].querySelector('.add_to_cart'), 'click', addToCart);
	addEvent(itemBox[i].querySelector('.add_to_cart'), 'click', openCart);
	addEvent(itemBox[i].querySelector('.add_to_cart'), 'click', openCart2);
}
// Открываем корзину со списком добавленных товаров
function openCart(e){
	
	var cartData = getCartData(), // вытаскиваем все данные корзины
			totalItems = '';
	//console.log(JSON.stringify(cartData));
	// если что-то в корзине уже есть, начинаем формировать данные для вывода
	if(cartData !== null)
	{
		totalItems = '<table class="CartSum">';
		for(var items in cartData)
		{
			totalItems += '<tr>';			
			totalItems += '<td>' + cartData[items][2] + '</td>';
			totalItems += '</tr>';
		}
		totalItems += '</table>';
		cartCont.innerHTML = totalItems;
	} 
	else {
		// если в корзине пусто, то сигнализируем об этом
		//cartCont.innerHTML = 'В корзине пусто!';
	}
	//скрипт подсчета общего количества товара в корзине
	var TotalSum = 0;
	  $('.CartSum tr').each(function(){
		  TotalSum+=parseInt($('td', this).text());
	  });
	sessionStorage.setItem('count', TotalSum);
	  console.log(TotalSum);	
	return false;
}
	
function openCart2(e){
	
	var cartData = getCartData(), // вытаскиваем все данные корзины
			totalItems = '';
	//console.log(JSON.stringify(cartData));
	// если что-то в корзине уже есть, начинаем формировать данные для вывода
	if(cartData !== null)
	{
		totalItems = '<table class="CartPrice">';
		for(var items in cartData)
		{
			totalItems += '<tr>';			
			totalItems += '<td>' + cartData[items][3] + '</td>';
			totalItems += '</tr>';
		}
		totalItems += '</table>';
		cartCont.innerHTML = totalItems;
	} 
	//скрипт подсчета общего количества товара в корзине
	var TotalPrice = 0;
	  $('.CartPrice tr').each(function(){
		  TotalPrice+=parseInt($('td', this).text());
	  });
	sessionStorage.setItem('price', TotalPrice);
	  console.log(TotalPrice);	
	return false;
}	
</script>