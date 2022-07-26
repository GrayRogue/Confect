<?php
	if(isset($_POST['edit_change']))
	{
		$file_name = $_FILES['edit_uploadfile']['name'];
		$file_size = $_FILES['edit_uploadfile']['size'];
		$file_tmp = $_FILES['edit_uploadfile']['tmp_name'];
		$file_type = $_FILES['edit_uploadfile']['type'];

		$Newfile_type = substr($file_type, 0, 0);

		if (!move_uploaded_file($file_tmp,'../tovarspictures/'.$_FILES['edit_uploadfile']['name']))
		{
			move_uploaded_file($file_tmp,'../tovarspictures/'.$_FILES['edit_uploadfile']['name']);
		}
	}
?>
<script>
	document.location.href = "../edit_product.php";
</script>