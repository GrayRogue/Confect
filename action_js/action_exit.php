<?php 
	session_start();

	if (isset ($_POST['exit_button']))
	{
		$_SESSION['secure'] = false;		
		header("Location: ../admin_panel.php");
	}
?>