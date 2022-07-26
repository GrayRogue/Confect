<?php 
session_start();

require_once("../dbconnect.php");

$delete_tovar_name = $_POST['tovar_name'];

if(isset($_POST['submit_change_tovar']))
{
	$checkBox = $_POST['chb'];

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
			mysql_query("Delete From assortiment_tovarov Where id = '".$a[0]."'");
			$_SESSION["edit_tov_message"] = "Товар успешно удален";
		}
	}
	
	$_SESSION['del_tov_message'] = "Товар успешно удален";
}	

header("Location: ../admin_panel.php");
?>