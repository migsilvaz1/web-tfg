<?php
	include"menu.php";
	if(!isset($_GET['mode']) or !isset($_GET['idas']) or !isset($_GET['other'])){
		header("Location: error.php");
	}else{
		if(isset($_FILES['userfile'])){
			$target_dir = "C:/xampp/htdocs/root/docs/";
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
	$pacientes = get_all_paciente();
	$mode = $_GET['mode'];
	$idas = $_GET['idas'];
	$other = $_GET['other'];
?>
<head>
	<title>Guardar</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
<div id="inicio" class="container">
		<!-- Barra lateral -->
		<div id="blateral" class="jumbotron col-md-4">
			<h3>Lista de pacientes</h3>
			<ul>
				<?php 
					foreach ($pacientes as $paciente) {
						$nombre = $paciente['nombre'];
						$lid = $paciente['id_paciente'];
						echo "<li><a href=\"datospaciente.php?idpaciente=$lid\">$nombre</a></li>";
					}
					?>
			</ul>
		</div>
		<!-- Fin Barra -->
		<div class="col-md-1"></div>
		<div id="formulario" class="jumbotron col-md-7">
			<form enctype="multipart/form-data" action="<?php echo "save.php?mode=$mode&idas=$idas&other=$other" ?>" method="POST" class="form-horizontal">
				<div class="form-group">
						<label id="rlabel" for="resultado" class="col-sm-3 control-label">Selecciona el archivo</label>
						<div class="col-sm-9">
							<input name="userfile" type="file"/>
						</div>
					</div>
				<input type="submit" value="Subir" class="btn btn-default pull-right"/>
			</form>
		</div>
		</div>
	</body>
</html>
<?php } ?>