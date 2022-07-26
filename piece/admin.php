<script src="script/tab-script.js"></script>

<div id="wrapper">
	<div id="middle">
		<div id="admin_page">	
			<form action="action_js/action_exit.php" method="post">
				<h1>Панель управления<input type="submit" id="exti_button" name="exit_button" value="Выход"></h1>		
			</form>

			<div class="tab">
			  <button class="tablinks" id="open_add_workers" onclick="openChange(event, 'new-workers')">Добавить пользователя</button>
			  <button class="tablinks" id="open_del_workers" onclick="openChange(event, 'delete-workers')">Удалить пользователя</button>
			  <button class="tablinks" id="open_new_tovar" onclick="openChange(event, 'new-tovar')">Добавить товар</button>
			  <button class="tablinks" id="open_edit"  onclick="openChange(event, 'change-tovar')">Редактировать товар</button>
			</div>

			<div id="new-workers" class="tabcontent" style="display: none;">
				<h2>Форма добавления нового пользователя:</h2>
				<form id="new_workers_form" action="action_js/action_add_new_worker.php" method="post" enctype="multipart/form-data">
					<?php					
						echo '<p>Логин нового пользователя</p>';
						echo '<input name="new_workers_name" placeholder="Логин">';
						echo '<p>Пароль нового пользователя</p>';
						echo '<input id="password" onkeyup="success_password()" name="new_workers_pass" placeholder="Пароль"><br>';
						echo '<p>Подтвердите пароль</p>';
						echo '<input id="success_pass" onkeyup="success_password()" placeholder="Подтвердите пароль"><br>';
					?>
					<button id="submit_add" name="submit_add_new_worker">Добавить пользователя</button>
					<div id="succ_mess"></div>
				</form>
				<?php
					echo '<p style="color:red;">' . $add_message . '</p>'; 
					$add_message = null;
				?>
			</div>

			<div id="delete-workers" class="tabcontent" style="display: none;">
				<h2>Форма удаления пользователя:</h2>
				<form action="action_js/action_delete_worker.php" method="post" enctype="multipart/form-data">
					<?php			
						require_once("dbconnect.php");
						$WorkersQuery = mysql_query("Select * from Users;");
						$resultWorkersQuery = mysql_fetch_array($WorkersQuery);	
						echo '<br><table border="1">
   								<tr>
									<th> ☑</th>
    								<th>Логин</th>
							   </tr>';
						while($resultWorkersQuery = mysql_fetch_array($WorkersQuery))
						{
							echo '<tr>
									<td><input Name="chb[]" type="checkbox" Value="'.$resultWorkersQuery['id'].'"></td>
									<td><p name="workers_name">'.$resultWorkersQuery['login'].'</p></td>
								  </tr>';
						}
 						echo '</table>';
					?>
					<button name="submit_delete_worker">Удалить пользователя</button>
				</form>
				<?php
					echo '<p style="color:red;">' . $del_message . '</p>'; 
					$del_message = null;
				?>
			</div>

			<div id="new-tovar" class="tabcontent" style="display: none;">
				<h2>Форма добавления нового товара в список:</h2>
				<form action="action_js/action_add_new_tovar.php" method="post" enctype="multipart/form-data">
					<?php				
						echo '<br><input name="new_tovars_name" placeholder="Наименование"><br><br>';
						$CategoryQuery = mysql_query("Select * from Tovar;");
						$resultCategoryQuery = mysql_fetch_array($CategoryQuery);	
						echo '<select method="POST" name="tovar_category">';
						echo '<option value="0">Категория</option>';
						while($resultCategoryQuery = mysql_fetch_array($CategoryQuery))
						echo '<option value="'.$resultCategoryQuery['category'].'">'.$resultCategoryQuery['category'].'</option>';
						echo '</select><br><br>';
						echo '<input type="file" name="new_tovars_uploadfile" value="Фото"><br><br>';
						echo '<input name="new_tovars_price" placeholder="Цена"><br><br>';
						echo '<input name="new_tovars_disc" placeholder="Описание"><br><br>';
						echo '<input name="new_tovars_keep" placeholder="Калорийность"><br>';
					?>
					<button name="submit_add_new_tovar">Добавить товар</button> 
				</form>
				<?php
					echo '<p style="color:red;">' . $add_tov_message . '</p>'; 
					$add_tov_message = null;
				?>
			</div>

			<div id="change-tovar" class="tabcontent" style="display: none;">
				<h2>Форма редактирования товара:</h2>
				<form method="post" action="action_js/action_delete_tovar.php"  enctype="multipart/form-data">
					<?php				
						echo '<br><table>
								<tr>
									<td style="width:430px;"><b>Название</b></td>
									<td style="width:146px;"><b>Действие</b></td>
									<td><b>☑</b></td>
								</tr></table>';
					
						echo '<div id="table_edit">';
						echo '<table>
								<tr>
									<td><b></b></td>
									<td><b></b></td>
									<td><b></b></td>
								</tr>';
						
						$NameQuery = mysql_query("Select * from assortiment_tovarov;");
						
						while($resultNameQuery = mysql_fetch_array($NameQuery))
						{
							echo '<tr>
									<td>"'.$resultNameQuery['name'].'"</td>
									<td><a href="edit_product.php"><button type="button" class="edit_button" data-id="'.$resultNameQuery["id"].'" OnClick="edit_product(this)">Редактировать</button></a></td>
									<td><input Name="chb[]" type="checkbox" Value="'.$resultNameQuery['id'].'"></td>
								</tr>';
						}
 						echo '</table>
							</div>';
					?>
					<button name="submit_change_tovar">Удалить</button>
				</form>
				<?php
					echo '<p style="color:red;">' . $edit_tov_message . '</p>'; 
					$edit_tov_message = null;
				?>
			</div>
		</div>		
	</div><!-- Конец мидл -->
</div><!-- Конец врапер -->

<script>
	//Функция отображения блока измнения товара поверх остальных
	function edit_product(e)
	{			
		var itemId = e.getAttribute('data-id');		
		
		$.post(
			"action_js/getID.php",
			{
				"id" : itemId
			});
	}
	
	//Функция закрытия блока измнения
	function close_button()
	{
		$('#edit').remove();
	}
	
	function success_password()
	{
		$("#success_pass").on("keyup", function() 
		{ // Выполняем скрипт при изменении содержимого 2-го поля	
			var value_input1 = $("#password").val(); // Получаем содержимое 1-го поля
			var value_input2 = $("#success_pass").val(); // Получаем содержимое 2-го поля

			if(value_input1 != value_input2) { // Условие, если поля не совпадают

				$("#succ_mess").html("<p style='color:red;'><b>Пароли не совпадают!</b></p>"); // Выводим сообщение
				$("#submit_add").attr("disabled", "disabled"); // Запрещаем отправку формы

			} 
			else 
			{ // Условие, если поля совпадают

				$("#submit_add").removeAttr("disabled");  // Разрешаем отправку формы
				$("#succ_mess").html(""); // Скрываем сообщение			
			}
		});

	}
</script>
