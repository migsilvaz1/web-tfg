<?php
	include"menu.php";
	if(isset($_FILES["userfile"])){
	        $target_dir = "C:/xampp/htdocs/root/docs/";
			$name = basename($_FILES["userfile"]["name"]);
			$target_file = $target_dir . $name;
			move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file);
			
			$DB_USER = "root";
			$DB_PASS = "root";
			$command = "\"C:\\Program Files\\MySQL\\MySQL Server 5.6\\bin\\mysql.exe\" --user=".$DB_USER.
			" --password=".$DB_PASS." < C:\\xampp\\htdocs\\root\\docs\\$name";
			exec($command, $ret_arr, $ret_code);
			header("Location: inicio.php");
	    }
	$pacientes = get_all_paciente();
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
			<h3>Importar la base de datos</h3>
			<div id="divError" class="alert alert-danger" role="alert">
				<label id="error1"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;Esta operaci&oacute;n puede llevar hasta 5 minutos. Cuando termine se redigir&aacute; a la p&aacute;gina de inicio.</label>
			</div>
			<div id="divError2" class="alert alert-danger" role="alert">
				<label id="error12"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;Seleccione solo archivos generados por esta aplicaci&oacute;n. Si no lo hace podr&iacute;a inutilizar la aplicaci&oacute;n.</label>
			</div>
			<form enctype="multipart/form-data" action="import_db.php" method="POST" class="form-horizontal">
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