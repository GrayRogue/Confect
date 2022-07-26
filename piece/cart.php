<script src="./jquery.spinner.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<?php
	echo '<div id="wrapper">
		<div id="middle">
			<div id="content_cart">
			<p id="cart_status">';
				?>
				<script>
					function getCartData()
					{
						return JSON.parse(sessionStorage.getItem('cart'));
					}
					var cartData = getCartData(); // вытаскиваем все данные корзины
					if(cartData !== null)
						cart_status.innerHTML = 'Количество товаров в корзине: ' + JSON.parse(sessionStorage.getItem('count'));
					else
						cart_status.innerHTML = 'В корзине 0 товаров';
				</script>
				<?php
				echo '</p><div id="cart_items"></div>';
				echo '<div id="cart_info">
					<p class="cart_title">Условия доставки</p>
					<div class="cart_info_simbol"><p>₽</p></div>
					<div class="cart_info_text">Условия доставки KappaPride
					<br>
					<br>1. Бесплатная доставка действует на сумму заказа от 1500 ₽. Заказы меньше этой суммы не доставляются.
					<br>
					<br>2. К заказам на кондитерские изделия меньше минимальной суммы может быть добавлена стоимость упаковки.
					<br>
					<br>*условия могу быть изменены в праздничные и предпраздничные дни, во время действия акций.
					<br>
					<br><b>*есть платные зоны доставки: Район Западный, Район Восточный.</b>					
					</div>
					<p style="font-size: 22px; float:left;	font-weight: bold;">Районы доставки</p>						
					<div class="cart_info_simbol2"><img src="image/pointer.png"></div>
					<div class="cart_info_text" style="margin-left:45px;">	
					<p class="cart_title">Центральный</p>
					<br>Включительно до улицы Свободы
					<br>
					<br><p class="cart_title">Северный</p>
					<br>Включительно до улицы Железнодорожная
					<br>
					<br><b>Стоимость доставки в другие районы города - 300₽. Доставка в отдаленные районы рассматривается по ситуации, в зависимости от загруженности дорог и количества заказов.</b>
					</div>
				</div>';
				echo '<div id="cart_form">
					<p class="cart_title">Заказать без регистрации</p>
					<br>
					<p style="font-size: 20px; margin-bottom: 20px;">Контакт для связи</p>
					<div class="cart_form_div">
						<p class="cart_form_div_p">Имя *</p>
						<input placeholder="Имя" id="name_client" onkeyup="text_validate(this)">
					</div>
					<br>
					<div class="cart_form_div">
						<p class="cart_form_div_p">Контактный телефон *</p>
						<input maxlength="11" placeholder="Контактный телефон" id="tel" onkeyup="number_validate(this)">
					</div>
					<br>
					<div id="deliver_div">
						<p style="font-size: 20px; margin-bottom: 20px;">Доставка</p>
						<div class="cart_form_div">
							<p class="cart_form_div_p">Улица *</p>
							<input placeholder="Улица" id="street" onkeyup="text_validate(this)">
						</div>
						<br>
						<div class="cart_form_div">
							<p class="cart_form_div_p">Дом *</p>
							<input placeholder="Дом" id="home" onkeyup="number_text_validate(this)"">
						</div>
						<br>
						<div class="cart_form_div">
							<p class="cart_form_div_p">Корпус</p>
							<input placeholder="Корпус" id="housing" onkeyup="number_text_validate(this)">
						</div>
						<br>
						<div class="cart_form_div">
							<p class="cart_form_div_p">Квартира *</p>
							<input placeholder="Квартира" id="apartment" onkeyup="number_validate(this)">
						</div>
						<br>
						<div class="cart_form_div">
							<p class="cart_form_div_p">Способ доставки *</p>
							<div id="dropdown-menu" class="dropdown-menu">
								<span class="title" id="deliverment">Способ доставки</span>
								<ul>
									<li><a id="courier">Курьер</a></li>
									<li><a id="pickup">Самовывоз</a></li>
								</ul>
							</div>
						</div>
						<br>
						<div id="pay">
							<p style="font-size: 20px; margin-bottom: 20px;">Оплата</p>
							<div class="cart_form_div2">
								<div class="radioButton_Div">
									<input type="radio" id="radioButton1" name="deliverance" onclick="check()">
									<span id="card">Картой</span>
								</div>
								<div class="radioButton_Div">
									<input type="radio" id="radioButton2" name="deliverance" onclick="check()">			
									<span id="courer">Наличными курьеру</span>					
								</div>
								<div id="price_del"></div>
							</div>
							<br>
							<div id="total_price_cart"></div>							
							<span id="error"></span>
							<br>
							<button id="to_order" type="button" onclick="take_order()">Заказать</button>
							
						</div>
					</div>
				</div>';
		echo'</div><!-- Конец контент -->		
	</div><!-- Конец мидл -->
</div><!-- Конец врапер -->';
?>

<script type="text/javascript">
					function addEvent(elem, type, handler)
					{
					  if(elem.addEventListener){
						elem.addEventListener(type, handler, false);
					  } else {
						elem.attachEvent('on'+type, function(){ handler.call( elem ); });
					  }
					  return false;
					}							
						
					function getCartData()
					{
						return JSON.parse(sessionStorage.getItem('cart'));
					}
						
					var cartData = getCartData(), // вытаскиваем все данные корзины
						itemBox = document.querySelectorAll('.cart_blocks'),
						totalItems = '';
										
					if(cartData !== null)
					{
						total_price_cart.innerHTML = 'Всего к оплате: ' + JSON.parse(sessionStorage.getItem('price')) + '₽';
						for(var items in cartData)
						{							
							totalItems += '<div class="cart_blocks" id="'+cartData[items][4]+'" data-trigger="spinner" >';
							totalItems += '<div class="tovar_picture">' +cartData[items][5]+'</div>';
							totalItems += '<div class="tovar_name"><span>' +cartData[items][0]+'</span></div>';
							totalItems += '<button class="count_btn_plus_cart"  type="button" data-spin="up" data-id="'+cartData[items][4]+'" OnClick="btn_plus(this)"></button><button class="count_btn_minus_cart" type="button" data-spin="down" data-id="'+cartData[items][4]+'" OnClick="btn_minus(this)"></button>'; 
							totalItems += '<input type="text" class="count_txt_cart" data-max = "100" data-min = "1" data-ruler="quantity" readonly value="' +cartData[items][2]+'">';
							totalItems += '<div class="tovar_total_price"><span class="myspan'+cartData[items][4]+'">' +cartData[items][3]+ '₽</span></div>';
							totalItems += '<button class="delete_button_cart" type="button" data-id="'+cartData[items][4]+'" OnClick="delete_item_from_cart(this)"></button>';
							totalItems += '</div>';
						}
						totalItems += '<button id="del_cart" type="button" OnClick="delete_cart()">Очистить корзину</button>';
						cart_items.innerHTML = totalItems;	
					}
	
					if(JSON.parse(sessionStorage.getItem('count')) <= 0)
					{
						$('#cart_info').remove();
						$('#delete_cart').remove();
						$('#cart_info').remove();
						$('#total_price_cart').remove();
						$('#cart_form').remove();
					}				
	
					//Функция удаления товара из хранилища
					function delete_item_from_cart(e)
					{
						var cartData = getCartData(), itemId = e.getAttribute('data-id'), TotalSum, TotalPrice;	
						
						//Изменение количества товара после удаления из корзины
						TotalSum = JSON.parse(sessionStorage.getItem('count'));
						TotalSum = TotalSum - cartData[Number(itemId)][2];
						sessionStorage.setItem("count", TotalSum);
						
						//Обновление значения количества товара в корзине в хедере страницы
						cartCount.innerHTML = '';
						cartCount.innerHTML = TotalSum;
						cart_status.innerHTML = 'Количество товаров в корзине: ' + JSON.parse(sessionStorage.getItem('count'));
						
						//Изменение цены после удаления из корзины
						TotalPrice = JSON.parse(sessionStorage.getItem('price'));
						TotalPrice = TotalPrice - cartData[Number(itemId)][Number(3)];
						sessionStorage.setItem("price", TotalPrice);
						
						//Обновление значения суммы товаров в корзине в хедере страницы
						cartPrice.innerHTML = '';
						cartPrice.innerHTML = TotalPrice;
						total_price_cart.innerHTML = 'Всего к оплате: ' + JSON.parse(sessionStorage.getItem('price')) + '₽';
							
						//удаление товара из хранилища
						delete cartData[Number(itemId)];
						cartData = JSON.stringify(cartData);
						sessionStorage.setItem("cart", cartData);						
											
						removeDiv(e);
						
						if(JSON.parse(sessionStorage.getItem('count')) <= 0)
						{
							$('#cart_info').remove();
							$('#cart_info').remove();
							$('#total_price_cart').remove();
							$('#cart_form').remove();
							$('#delete_cart').remove();
						}
							
						return false;
					}
	
					//Функция увеличения количества товара в корзине
					function btn_plus(e)
					{
						var cartData = getCartData(), itemId = e.getAttribute('data-id'), count, priceTovar, price, TotalSum, TotalPrice;
						
						//Изменение после увеличения количества товара в корзине
						TotalSum = JSON.parse(sessionStorage.getItem('count'));
						TotalSum = TotalSum += 1;
						sessionStorage.setItem("count", TotalSum);
						
						//Обновление значения количества товара в корзине в хедере страницы
						cartCount.innerHTML = '';
						cartCount.innerHTML = TotalSum;
						cart_status.innerHTML = 'Количество товаров в корзине: ' + JSON.parse(sessionStorage.getItem('count'));
						
						//Изменение суммы корзины после увеличения количества товара в корзине
						TotalPrice = JSON.parse(sessionStorage.getItem('price'));
						TotalPrice = TotalPrice + cartData[Number(itemId)][1];
						sessionStorage.setItem('price', TotalPrice);
						
						//Обновление значения суммы товаров в корзине в хедере страницы
						cartPrice.innerHTML = '';
						cartPrice.innerHTML = TotalPrice;
						total_price_cart.innerHTML = 'Всего к оплате: ' + JSON.parse(sessionStorage.getItem('price')) + '₽';
						
						//Изменение количества товара в корзине на +1
						count = cartData[Number(itemId)][2] += 1;
						count = JSON.stringify(cartData);
						sessionStorage.setItem("cart", count);
						
						//Изменение цены товара после увеличения количества товара в корзине
						cartData[Number(itemId)][3] = cartData[Number(itemId)][1] * cartData[Number(itemId)][2];
						cartData = JSON.stringify(cartData);
						sessionStorage.setItem("cart", cartData);							
						
						ChangeSpan(e);
						
						return false;
					}
					
					//Функция уменьшения количества товара в корзине
					function btn_minus(e)
					{
						var cartData = getCartData(), itemId = e.getAttribute('data-id'), count, priceTovar, price, TotalSum, TotalPrice;
						
						if(cartData[Number(itemId)][2] !== 1)
						{
							//Изменение после уменьшения количества товара в корзине
							TotalSum = JSON.parse(sessionStorage.getItem('count'));
							TotalSum = TotalSum -= 1;
							sessionStorage.setItem("count", TotalSum);

							//Обновление значения количества товара в корзине в хедере страницы
							cartCount.innerHTML = '';
							cartCount.innerHTML = TotalSum;
							cart_status.innerHTML = 'Количество товаров в корзине: ' + JSON.parse(sessionStorage.getItem('count'));

							//Изменение суммы корзины после уменьшения количества товара в корзине
							TotalPrice = JSON.parse(sessionStorage.getItem('price'));
							TotalPrice = TotalPrice - cartData[Number(itemId)][1];
							sessionStorage.setItem('price', TotalPrice);

							//Обновление значения суммы товаров в корзине в хедере страницы
							cartPrice.innerHTML = '';
							cartPrice.innerHTML = TotalPrice;
							total_price_cart.innerHTML = 'Всего к оплате: ' + JSON.parse(sessionStorage.getItem('price')) + '₽';

							//Изменение количества товара в корзине на -1
							count = cartData[Number(itemId)][2] -= 1;
							count = JSON.stringify(cartData);
							sessionStorage.setItem("cart", count);

							//Изменение цены товара после уменьшения количества товара в корзине
							cartData[Number(itemId)][3] = cartData[Number(itemId)][1] * cartData[Number(itemId)][2];
							cartData = JSON.stringify(cartData);
							sessionStorage.setItem("cart", cartData);							

							ChangeSpan(e);
						}
						
						return false;
					}
	
					//Функиця обновления значения цены конкретного товара в span class="myspan"
					function ChangeSpan(e)
					{
						var cartData = getCartData(), itemId = e.getAttribute('data-id');
						
						var spantext = (cartData[Number(itemId)][1]*cartData[Number(itemId)][2]);
						$('.myspan'+itemId).text(spantext+'₽');	
						
						return false;
					}
	
					//Функция удаления блока товара со страницы
					function removeDiv(e)
					{							
						var itemId = e.getAttribute('data-id');
						
						$('#'+cartData[itemId][4]).remove();
						
						return false;
					}					
	
					//Функция очистки корзины
					function delete_cart()
					{							
						sessionStorage.clear();						
						$('.cart_blocks').remove();
						$('#cart_info').remove();
						$('#total_price_cart').remove();
						$('#cart_form').remove();
						$('#cart_items').remove();
						$('#delete_cart').remove();
						
						cartPrice.innerHTML = 0;
						cart_status.innerHTML = 'В корзине 0 товаров';
						cartCount.innerHTML = 0;
						
						return false;
					}
	
window.onload=function()
{
	var menuElem = document.getElementById('dropdown-menu'),
    titleElem = menuElem.querySelector('.title');
    document.onclick = function(event) 
	{
		var target = elem = event.target;
    	while (target != this) 
		{
			if (target == menuElem) 
			{
				if(elem.tagName == 'A') titleElem.innerHTML = elem.textContent;
				menuElem.classList.toggle('open')
              return;
          }
          target = target.parentNode;
		}
    	menuElem.classList.remove('open');
	}
}

function check()
{
    var inp = document.getElementById('radioButton2'), inp2 = document.getElementById('radioButton1');
    if (inp.checked) 
	{
		price_del.innerHTML = '<p>Введите сумму сдачи</p><input type="text" id="residue" placeholder="Введите сумму сдачи" onkeyup="number_validate(this)">';
    }
	if(inp2.checked)
		price_del.innerHTML = '';
}
	
	
function take_order()
{
	var cart = {};
	
	cart = JSON.parse(sessionStorage.getItem('cart'));
		
	var value_name = $.trim($("#name_client").val()), 
		value_tel = $.trim($("#tel").val()), 
		value_street = $.trim($("#street").val()),
		value_home = $.trim($("#home").val()),
		value_housing = $.trim($("#housing").val()),
		value_apartment = $.trim($("#apartment").val()),
		inp = document.getElementById('radioButton1'), 
		inp2 = document.getElementById('radioButton2'),
		payment,
		value_residue = $.trim($("#residue").val()),
		residue,
		deliverment,
		order_token = Math.random().toString(36).substr(2, 20);

	if(value_name.length<=0)
	{
		error.innerHTML = 'Поле "Имя" осталось не заполненно';
	}
	else if(value_tel.length<=0)
	{
		error.innerHTML = 'Поле "Контактный телефон" осталось не заполненно';
	}
	else if(value_street.length<=0)
	{
		error.innerHTML = 'Поле "Улица" осталось не заполненно';
	}
	else if(value_home.length<=0)
	{
		error.innerHTML = 'Поле "Дом" осталось не заполненно';
	}
	else if(value_apartment.length<=0)
	{
		error.innerHTML = 'Поле "Квартира" осталось не заполненно';
	}
	else if($('#deliverment').html() == 'Способ доставки')
	{
		error.innerHTML = 'Выберите способ доставки';
	}
	else if($('#deliverment').html() !== 'Способ доставки')
	{
		deliverment = $('#deliverment').html();
		
		if(!inp.checked && !inp2.checked)
		{
			error.innerHTML = 'Выберите способ оплаты';
		}
		else if(inp.checked)
		{
			payment = $('#card').html();
			residue = 0;
		}
		else if(inp2.checked && value_residue.length<1)
		{
			error.innerHTML = 'Введите сумму сдачи';
		}
		else if(inp2.checked && $("#residue").length != 0)
		{
			payment = $('#courer').html();
			residue = $("#residue").val();
		}
	}	
	
	if(value_housing.length<=0)
	{
		value_housing = '-';
	}
	
	if(value_name.length>0 && value_tel.length>0 && value_street.length>0 && value_home.length>0 && value_housing.length>0 && value_apartment.length>0 && deliverment != '' && (inp.checked || inp2.checked) && payment != '' && residue>=0) 
	{
		$.post(
			"action_js/order.php",
			{
				"cart" : cart,
				"name_client" : $("#name_client").val(),
				"telephone" : $("#tel").val(),
				"street" : $("#street").val(),
				"home" : $("#home").val(),
				"housing" : value_housing,
				"apartment" : $("#apartment").val(),
				"payment" : payment,
				"residue" : residue,
				"deliverment" : deliverment,
				"order_token" : order_token
			});
		
		var success_order = '',
			d=new Date(),
			day=d.getDate(),
			month=d.getMonth() + 1,
			year=d.getFullYear(),
			cardData = getCartData();
		
		success_order += '<div id="tovar_blank">';
		success_order += '<h1>Спасибо за ваш заказ, '+$("#name_client").val()+'!</h1><br>';
		success_order += '<p>Итоговая сумма заказа: '+JSON.parse(sessionStorage.getItem('price'))+' рублей.</p>';
		success_order += '<p>Дата вашего заказа: '+day + "." + month + "." + year+'.</p>';
		success_order += '<p>Ваш уникальный номер заказа: <b>'+order_token+'</b>. Обязательно сохраните его или QR-код ниже для получения товара при самовывозе.</p><br>';	
		success_order += '<p>Ваш список товаров:</p><br>';
		if(cartData !== null)
		{
			success_order += '<table><tr style="border:1px solid"><th>Название</th><th style="border:1px solid; width:100px;">Цена</th><th>Количество</th></tr>';
			for(var items in cartData)
			{
				success_order += '<tr style="border:1px solid">';			
				success_order += '<td style="border:1px solid">' + cartData[items][0] + '</td>';
				success_order += '<td style="border:1px solid">' + cartData[items][3] + '</td>';
				success_order += '<td style="border:1px solid">' + cartData[items][2] + '</td>';
				success_order += '</tr>';
			}
			success_order += '</table><br>';
		}  
		success_order += '</div>';
		success_order += '<button id="save_tovar_blank" type="button" OnClick="save_tovar_blank(this)">Скачать товарный бланк</button><br>';
		success_order += '<img id="qrcode" style="width:150px;" src="https://qrcode.tec-it.com/API/QRCode?data='+order_token+'&color=%23ffffff&backcolor=%23000000" />';		
		success_order += '<br><p>Вы можете сохранить этот товарный бланк в файл, нажав на кнопку "Скачать товарный бланк" или сохранить QR-код, нажав на кнопку "Скачать QR-код".</p><br>';
		success_order += '<br><a href="https://qrcode.tec-it.com/API/QRCode?data='+order_token+'&method=download"><button id="print_tovar_blank" type="button">Скачать QR-код</button></a>';
		
		cart_items.innerHTML = success_order;
		
		sessionStorage.clear();
		$('.cart_blocks').remove();
		$('#delete_cart').remove();
		$('#cart_info').remove();
		$('#total_price_cart').remove();
		$('#cart_form').remove();

		cartPrice.innerHTML = 0;
		cart_status.innerHTML = 'В корзине 0 товаров';
		cartCount.innerHTML = 0;
		
	}
}
	
	//Функция ограничения ввода цифр в поле input
	function text_validate(inp) 
	{
    	inp.value = inp.value.replace(/[,.]+/g, ' ')
							.replace(/[^а-яА-Я]+/g,' ');
	}
	
	//Функция ограничения ввода букв в поле input
	function number_validate(inp) 
	{
    	inp.value = inp.value.replace(/[^\d,.]*/g, '')
                         .replace(/[,.]+/g, '')
                         .replace(/^[^\d]*(\d+([.,]\d{0,5})?).*$/g, '$1');
	}
	
	//Функция ограничения символов в поле input
	function number_text_validate(inp) 
	{
    	inp.value = inp.value.replace(/[^а-яА-Я0-9]+/g,'');
	}
	
	//Функция сохранения товарного бланка в файл
	function save_tovar_blank(e) 
	{			
		var pdf = new jsPDF("", "pt", "letter");
			pdf.addHTML($("#tovar_blank"), 20, 100, function() 
			{					
				pdf.save('Товарный бланк.pdf');
			});		
	}
		
</script>