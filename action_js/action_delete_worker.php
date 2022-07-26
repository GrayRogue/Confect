<?php 
session_start();
require_once("../dbconnect.php");

$checkBox = $_POST['chb'];

if(isset($_POST['submit_delete_worker']))
{
	$N = count($checkBox);
	if(empty($N))
	{
		$_SESSION["del_message"] = "Ничего не выбрано";
		header("Location: ../admin_panel.php");
		exit();
	}
	for($i=0; $i < $N; $i++)
    {
		$a = array($checkBox[$i]);
				
		if($checkBox > 0)
		{			
			mysql_query("Delete From Users Where id = '".$a[0]."'");
			$_SESSION["del_message"] = "Администратор успешно удален";
		}
	}	
}

header("Location: ../admin_panel.php");
?>