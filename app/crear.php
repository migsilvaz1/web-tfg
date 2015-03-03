<?php
	include"menu.php";
	
	$mensaje = " ";
	$pacietnes = get_all_paciente();
	if (isset($_POST["crear"])) {
		if ($_POST["crearimp"]=="" ){
			$mensaje = "<div class=\"alert alert-danger\" role=\"alert\"><label><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>&nbsp;Ha courrido un error</label></div>";
		}else{
		$tipo = $_POST["crear"];
		$nombre = $_POST["crearimp"];
		switch ($tipo) {
			case 'Servicio':
				create_servicio($nombre);
				$mensaje = "<div class=\"alert alert-success\" role=\"alert\"><label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Servicio guardado correctamente</label></div>";
				break;
			
			case 'Centro':
				create_centro($nombre);
				$mensaje = "<div class=\"alert alert-success\" role=\"alert\"><label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Centro guardado correctamente</label></div>";
				break;
				
			case 'Material':
				create_material($nombre);
				$mensaje = "<div class=\"alert alert-success\" role=\"alert\"><label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Material guardado correctamente</label></div>";
				break;
			case 'Radiologo':
				create_radiologo($nombre);
				$mensaje = "<div class=\"alert alert-success\" role=\"alert\"><label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Radiologo guardado correctamente</label></div>";
				break;
			case 'Factorderiesgo':
				create_factor($nombre);
				$mensaje = "<div class=\"alert alert-success\" role=\"alert\"><label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Factor de riesgo guardado correctamente</label></div>";
				break;
			case 'Patologia':
				create_patologia($nombre);
				$mensaje = "<div class=\"alert alert-success\" role=\"alert\"><label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Patolog&iacute;a guardado correctamente</label></div>";
				break;
			case 'Tipodeprocedimiento':
				create_tipo_procedimiento($nombre);
				$mensaje = "<div class=\"alert alert-success\" role=\"alert\"><label><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Tipo procedimiento guardado correctamente</label></div>";
				break;
		}}
	}

?>
<head>
	<title>Crear</title>
	<LINK REL=StyleSheet HREF="inicio.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
	<div id="inicio" class="container">
		<!-- Barra lateral -->
		<div id="blateral" class="jumbotron col-md-4">
			<h3>Lista de pacientes</h3>
			<ul>
				<?php 
					foreach ($pacietnes as $paciente) {
						$nombre = $paciente['nombre'];
						$id = $paciente['id_paciente'];
						echo "<li><a href=\"datospaciente.php?idpaciente=$id\">$nombre</a></li>";
					}
					?>
			</ul>
		</div>
		<!-- Fin Barra -->
		<div class="col-md-1"></div>
		<div id="formulario" class="jumbotron col-md-7">
			<div><?php echo $mensaje; ?></div>
			<form action="crear.php" method="post" name="crearform" class="form-horizontal">
				<div class="form-group">
					<label id="crearlabel" for="crear" class="col-sm-2 control-label">Crear</label>
					<div class="col-sm-5">
						<select id="crear" name="crear" class="form-control">
							<option value="Servicio">Servicio</option>
							<option value="Centro">Centro</option>
							<option value="Material">Material</option>
							<option value="Radiologo">Radiologo</option>
							<option value="Factorderiesgo">Factor de riesgo</option>
							<option value="Patologia">Patologia</option>
							<option value="Tipodeprocedimiento">Tipo de procedimiento</option>
						</select>
						</div>
						<div class="col-sm-5">
							<input type="text" id="crearimp" name="crearimp" class="form-control">
						</div>
					</div>
				<div id="botones" class="pull-right">
					<input type="submit" class="btn btn-default" value="Guardar">
				</div>
			</form>
		</div>
	</div>
</body>