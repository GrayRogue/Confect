<script src="script/tab-script.js"></script>
<div id="wrapper">
	<div id="middle">
		<div id="admin_page">
			<div class="tab" style="height: 570px;">				  
				<a href="admin_panel.php" style="text-decoration: none"><button class="tablinks" >Назад</button></a>
			</div>
			
			<div id="change-tovar" class="tabcontent" style="height: 550px;">
				<h2>Форма редактирования товара:</h2>
					<div id="edit">
						<form method="post" id="edit_form" action="/" enctype="multipart/form-data">
							<?php
								$CategoryQuery = mysql_query("Select * from Tovar;");
								$resultCategoryQuery = mysql_fetch_array($CategoryQuery);
								reset($_SESSION['id']);
								$id = $_SESSION['id'];
								if(empty($id) || empty($_SESSION['id']) || !isset($_SESSION['id']))
								{						
									echo "<script>window.location.href='edit_product.php'</script>";
								}
								$query = mysql_query('select * from assortiment_tovarov where id="'.$id.'"');
								$result = mysql_fetch_array($query);
								echo '<span>Название: </span><input id="name_prod" style="margin-left:10px;" type="text" value="'.$result['name'].'">';
								echo '<br><span>Категория: </span>'; 						
								echo '<select method="POST" id="category_prod">';				
								echo '<option value="0">Категория</option>';
								while($resultCategoryQuery = mysql_fetch_array($CategoryQuery))
									echo '<option value="'.$resultCategoryQuery["category"].'">'.$resultCategoryQuery['category'].'</option>';
								echo '</select><span>(текущая: '.$result['tovar_category'].')</span>';
								echo '<br><span>Изображение: </span>' . '<br><img src="tovarspictures/'.$result['picture'].'">' . '<br><input type="file" id="photo" style="border:0; width:300px;" name="edit_uploadfile" value="Изменить фото товара">';
								echo '<br><span>Цена: </span>' . '<input onkeyup="number_validate(this)" id="price" style="margin-left:38px;" type="text" value="'.$result['price'].'">';
								echo '<br><span>Калории: </span>' . '<input id="keep" style="margin-left:10px;" type="text" value="'.$result['keep'].'">';
								echo '<br><span>Описание: </span>' . '<br><textarea row="3" col="30" id="description">'.$result["description"].'</textarea>';
								echo '<br><button name="edit_change" data-id="'.$result["id"].'" id="change" onclick="message(this)">Применить изменения</button><div id="edit_mes"></div>';
								$_SESSION['ID'] = $_SESSION['id']; 
								unset($_SESSION['id']);
							?>
						</form>
						<?php
							echo '<p style="color:red; font-size:18px; margin-left:10px;"><b>' . $_SESSION["upd_message"] . '</b></p>'; 
							$_SESSION["upd_message"] = null;
						?>
					</div>
			</div>
		</div>		
	</div><!-- Конец мидл -->
</div><!-- Конец врапер -->


<script>
	function message(e)
	{		
		var itemId = e.getAttribute('data-id');
		var	itemName = $.trim($("#name_prod").val());
		var	itemCategory = document.getElementById("category_prod"), sel_value = itemCategory.value;
		var	itemPhoto = $.trim($("#photo").val());
		var	itemPrice = $.trim($("#price").val());
		var	itemDescription = $.trim($("#description").val());
		var	itemKeep = $.trim($("#keep").val());
		
		if(itemName == '')
			edit_mes.innerHTML = '<p style="color:red; font-size:18px; margin-left:10px;"><b>Поле названия товара осталось пустым</b></p>';
		if(itemPrice == '')
			edit_mes.innerHTML = '<p style="color:red; font-size:18px; margin-left:10px;"><b>Поле цены товара осталось пустым</b></p>';
		if(itemDescription == '')
			edit_mes.innerHTML = '<p style="color:red; font-size:18px; margin-left:10px;"><b>Поле описания товара осталось пустым</b></p>';
		if(itemKeep == '')
			edit_mes.innerHTML = '<p style="color:red; font-size:18px; margin-left:10px;"><b>Поле калорийности товара осталось пустым</b></p>';
		if(itemPhoto != 0)
			itemPhoto = $.trim($("#photo")[0].files[0].name);
		
		$.post(
			"action_js/edit_prod.php",
			{
				"id" : itemId,
				"name" : itemName,
				"category" : sel_value,
				"photo" : itemPhoto,
				"price" : itemPrice,
				"description" : itemDescription,
				"keep" : itemKeep
			});
				
		$("#edit_form").attr("action", "action_js/uploadphoto.php");
	}
	
	function number_validate(inp) 
	{
    	inp.value = inp.value.replace(/[^\d,.]*/g, '')
                         .replace(/[,.]+/g, '')
                         .replace(/^[^\d]*(\d+([.,]\d{0,5})?).*$/g, '$1');
	}
</script>