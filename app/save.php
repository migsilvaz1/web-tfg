<?php
	include"menu.php";
	if(!isset($_GET['mode']) or !isset($_GET['idas']) or !isset($_GET['other'])){
		header("Location: error.php");
	}else{
		if(isset($_FILES['userfile'])){
			$target_dir = "docs/";
			$name = basename($_FILES["userfile"]["name"]);
			$target_file = $target_dir . $name;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file);
			
	// 		guardar el documento en la bdd
			$blob = fopen($target_file,'rb');
			$mode = "none";
			if($_GET['mode']=="img_pd"){
				$mode = "img_pd";
			}elseif($_GET['mode']=="img_pro"){
				$mode = "img_pro";
			}elseif($_GET['mode']=="doc"){
				$mode = "doc";
			}
			$id_asociada = intval($_GET['idas']);
			create_documento($name, $blob, $id_asociada, $mode);
			fclose($blob);
// 			Volver a donde venias
			$url = "error.php";
			$id_from = $_GET['idas'];
			$id_other = $_GET['other'];
			if($_GET['mode']=="img_pd"){
				$url = "Location: datospruebadiagnostica.php?idepisodio=$id_other&idpdiag=$id_from";
			}elseif($_GET['mode']=="img_pro"){
				$url = "Location: datosprocedimiento.php?idepisodio=$id_other&idprod=$id_from";
			}elseif($_GET['mode']=="doc"){
				$url = "Location: datosprocedimiento.php?idepisodio=$id_other&idprod=$id_from";
			}
			header($url);
		}
?>
<html>
	<head></head>
	<body>
		<?php
		if(isset($_FILES['userfile'])){
			print_r($_FILES);
			print_r($target_file);
		}
		?>
		<!-- El tipo de codificación de datos, enctype, se DEBE especificar como a continuación -->
		<form enctype="multipart/form-data" action="save.php" method="POST">
			<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
			Enviar este archivo:
			<input name="userfile" type="file" />
			<input type="submit" value="Send File" />
		</form>
	</body>
</html>
<?php } ?>