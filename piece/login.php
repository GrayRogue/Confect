<div id="wrapper">
	<div id="middle">
		<div id="login">
			<form id="login_form" method="post" action="action_js/action_login.php">
				<p>Введите логин: </p>
				<input type="text" name="login_field" placeholder="Логин">
				<p>Введите пароль: </p>
				<input type="password" name="password_field" placeholder="Пароль"><br>
				<button name="login_button">Войти</button>
			
				<?php
					echo '<p>' . $error_message . '</p>'; 
					$error_message = null;
				?>
			</form>
		</div>					
	</div><!-- Конец мидл -->
</div><!-- Конец врапер -->

