<div id="content">
	<div id="personal_area">
		<form action="action/action_personal_area.php" method="post">
			<h1>Страница администратора  <input type="submit" name="exit_button" value="Выйти из профиля"></h1>			
				<p>Ваше имя на сайте: <b> <? echo $Username; ?> </b></p>
		</form>
		
	  	<div class="tab">
		  <button class="tablinks" onclick="openChange(event, 'position-workers')" id="defaultOpen">Изменение должности работника</button>
		  <button class="tablinks"  onclick="openChange(event, 'new-workers')">Добавление нового работника</button>
		  <button class="tablinks"  onclick="openChange(event, 'delete-workers')">Удаление работника</button>
		  <button class="tablinks"  onclick="openChange(event, 'new-tovar')">Добавление нового товара</button>
		  <button class="tablinks"  onclick="openChange(event, 'change-tovar')">Редактирование товара</button>
		  <button class="tablinks"  onclick="openChange(event, 'delete-tovar')">Удаление товара</button>
		</div>

		<div id="position-workers" class="tabcontent" style="display: block;" >
			<div class="border_div">
				<h2>Форма изменения должность работника:</h2>
				<form action="action/action_change_worker_position.php" method="post" enctype="multipart/form-data">
					<?php					
						$WorkersQuery = mysql_query("Select * from Workers;");
						$resultWorkersQuery = mysql_fetch_array($WorkersQuery);				
						echo '<select method="POST" name="workers_name">';
						echo '<option value="0">Выберите работника</option>';
						while($resultWorkersQuery = mysql_fetch_array($WorkersQuery))
							echo '<option value="'.$resultWorkersQuery["id"].'">'.$resultWorkersQuery['name'].'</option>';
						echo '</select>';					

						echo '<select method="POST" name="workers_position">';
						echo '<option value="0">Выберите новую должность работника</option>';
						echo '<option value="Администрато сайта">Администрато сайта</option>';
						echo '<option value="Редактор">Редактор</option>';
						echo '<option value="Курьер">Курьер</option>';
						echo '</select>';
					?>
					<input type="submit" name="submit_change_worker_position" value="Применить изменения">
				</form>
			</div>
		</div>

		<div id="new-workers" class="tabcontent" style="display: none;">
			<div class="border_div">
				<h2>Форма добавления нового работника:</h2>
				<form action="action/action_add_new_worker.php" method="post" enctype="multipart/form-data">
					<?php					
						echo '<input name="new_workers_name" placeholder="Введите имя нового работника">';
						echo '<select method="POST" name="workers_position">';
						echo '<option value="0">Выберите должность работника</option>';
						echo '<option value="Администрато сайта">Администрато сайта</option>';
						echo '<option value="Редактор">Редактор</option>';
						echo '<option value="Курьер">Курьер</option>';
						echo '</select>';
					?>
					<input type="submit" name="submit_add_new_worker" value="Добавить работника">
				</form>
			</div> 
		</div>

		<div id="delete-workers" class="tabcontent" style="display: none;">
			<div class="border_div">
				<h2>Форма удаления работника:</h2>
				<form action="action/action_delete_worker.php" method="post" enctype="multipart/form-data">
					<?php			
						$WorkersQuery = mysql_query("Select * from Workers;");
						$resultWorkersQuery = mysql_fetch_array($WorkersQuery);	
						echo '<select method="POST" name="workers_name">';
						echo '<option value="0">Выберите работника</option>';
						while($resultWorkersQuery = mysql_fetch_array($WorkersQuery))
							echo '<option value="'.$resultWorkersQuery["id"].'">'.$resultWorkersQuery['name'].'</option>';
						echo '</select>';
					?>
					<input type="submit" name="submit_delete_worker" value="Удалить работника">
				</form>
			</div>
		</div>
		
		<div id="new-tovar" class="tabcontent" style="display: none;">
			<div class="border_div">
				<h2>Форма добавления нового товара в список:</h2>
				<form action="action/action_add_new_tovar.php" method="post" enctype="multipart/form-data">
					<?php				
						echo '<input name="new_tovars_name" placeholder="Введите название товара"><br><br>';
						$CategoryQuery = mysql_query("Select * from Tovar;");
						$resultCategoryQuery = mysql_fetch_array($CategoryQuery);	
						echo '<select method="POST" name="tovar_category">';
						echo '<option value="0">Выберите категорию товара</option>';
						while($resultCategoryQuery = mysql_fetch_array($CategoryQuery))
							echo '<option value="'.$resultCategoryQuery['category'].'">'.$resultCategoryQuery['category'].'</option>';
						echo '</select><br><br>';
						echo '<input type="file" name="new_tovars_uploadfile" value="Выбрать картинку товара"><br><br>';	
						echo '<input name="new_tovars_price" placeholder="Введите цену товара"><br><br>';
						echo '<input name="new_tovars_quantity" placeholder="Введите количество товара"><br><br>';
					?>
					<input type="submit" name="submit_add_new_tovar" value="Добавить товар">
				</form>
			</div>
		</div>
		
		<div id="change-tovar" class="tabcontent" style="display: none;">
			<div class="border_div">
				<h2>Форма редактирования товара (выберите необходимый(-е) параметр(ы) для изменения):</h2>
				<form action="action/action_change_tovar.php" method="post" enctype="multipart/form-data">
					<?php				
						echo '<input name="search_tovars_name" placeholder="Введите название товара"><br>';
						echo '<INPUT Type="checkbox" Name="chb[]" Value="1"><input name="change_tovars_name" placeholder="Изменить название товара"><br><br>';
						$CategoryQuery = mysql_query("Select * from Tovar;");
						$resultCategoryQuery = mysql_fetch_array($CategoryQuery);	
						echo '<INPUT Type="checkbox" Name="chb[]" Value="2"><select method="POST" name="tovar_category">';				
						echo '<option value="0">Изменить категорию товара</option>';
						while($resultCategoryQuery = mysql_fetch_array($CategoryQuery))
							echo '<option value="'.$resultCategoryQuery["category"].'">'.$resultCategoryQuery['category'].'</option>';
						echo '</select><br><br>';
						echo '<INPUT Type="checkbox" Name="chb[]" Value="3"><input type="file" name="uploadfile" value="Изменить картинку товара"><br><br>';	
						echo '<INPUT Type="checkbox" Name="chb[]" Value="4"><input name="change_tovars_price" placeholder="Изменить цену товара"><br><br>';
						echo '<INPUT Type="checkbox" Name="chb[]" Value="5"><input name="change_tovars_quantity" placeholder="Изменить количество товара"><br><br>';
					?>
					<input type="submit" name="submit_change_tovar" value="Изменить параметры товар">
				</form>
			</div>
		</div>
		
		<div id="delete-tovar" class="tabcontent" style="display: none;">
			<div class="border_div">
				<h2>Форма удаления товара:</h2>
				<form action="action/action_delete_tovar.php" method="post" enctype="multipart/form-data">
					<?php	
						echo '<input name="delete_tovar_name" placeholder="Введите название товара"><br>';
					?>
					<input type="submit" name="submit_delete_tovar" value="Удалить товар">
				</form>
			</div>
		</div>
</div>