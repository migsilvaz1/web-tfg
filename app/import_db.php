<?php
	if(isset($_FILES["userfile"])){
		$uploads_dir = 'C:\\xampp\\htdocs\\root\\docs\\';
	    if ($_FILES["userfile"]["error"] == UPLOAD_ERR_OK) {
	        $tmp_name = $_FILES["userfile"]["tmp_name"];
	        $name = $_FILES["userfile"]["name"];
	        move_uploaded_file($tmp_name, "$uploads_dir/$name");
			
			$DB_USER = "radio-user";
			$DB_PASS = "radio";
			$command = "\"C:\\Program Files\\MySQL\\MySQL Server 5.6\\bin\\mysql.exe\" --user=".$DB_USER.
			" --password=".$DB_PASS." < C:\\xampp\\htdocs\\root\\docs\\$name";
			exec($command, $ret_arr, $ret_code);
	    }else{
	    	print_r($_FILES["userfile"]);
	    }
	}
?>
<html>
	<head></head>
	<body>
		<!-- El tipo de codificación de datos, enctype, se DEBE especificar como a continuación -->
		<form enctype="multipart/form-data" action="import_db.php" method="POST">
			<!-- MAX_FILE_SIZE debe preceder el campo de entrada de archivo -->
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
			<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
			Enviar este archivo:
			<input name="userfile" type="file" />
			<input type="submit" value="Send File" />
		</form>
	</body>
</html>