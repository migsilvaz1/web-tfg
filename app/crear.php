<?php
	include"menu.php";
	
	$mensaje = "";

	if (isset($_POST["crear"])) {
		if ($_POST["crearimp"]=="" ){
			$mensaje = "hay error";
		}else{
		$tipo = $_POST["crear"];
		$nombre = $_POST["crearimp"];
		switch ($tipo) {
			case 'Servicio':
				create_servicio($nombre);
				$mensaje = "Servicio guardado correctamente";
				break;
			
			case 'Centro':
				create_centro($nombre);
				$mensaje = "Centro guardado correctamente";
				break;
				
			case 'Centro':
				create_material($nombre);
				$mensaje = "Material guardado correctamente";
				break;
			case 'Centro':
				create_radiologo($nombre);
				$mensaje = "Radiologo guardado correctamente";
				break;
			case 'Centro':
				create_factor($nombre);
				$mensaje = "Factor de riesgo guardado correctamente";
				break;
			case 'Centro':
				create_patologia($nombre);
				$mensaje = "Patologia guardada correctamente";
				break;
			case 'Centro':
				create_tipo_procedimiento($nombre);
				$mensaje = "Procedimiento guardado correctamente";
				break;
		}}
	}

?>
<head>
	<title>Crear</title>
</head>
<body>
	<div id="inicio" class="container">
		<div id="formulario" class="jumbotron">
			<div> mensaje <?php echo $mensaje; ?> </div>
			<form action="crear.php" method="post" name="crearform">
				<div id="grupo1">
					<label id="crearlabel" for="crear">Crear</label>
					<select id="crear" name="crear">
						<option value="Servicio">Servicio</option>
						<option value="Centro">Centro</option>
						<option value="Material">Material</option>
						<option value="Radiologo">Radiologo</option>
						<option value="Factorderiesgo">Factor de riesgo</option>
						<option value="Patologia">Patologia</option>
						<option value="Tipodeprocedimiento">Tipo de procedimiento</option>
					</select>
					<input type="text" id="crearimp" name="crearimp">
				<div id="botones">
					<input type="submit" value="Enviar formulario">
				</div>
			</form>
		</div>
	</div>
</body>