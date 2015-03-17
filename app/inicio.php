<?php
	include"menu.php";
	
	$services = get_all_servicio();
	$patologias = get_all_patologia();
	$procedimientos = get_all_tipo_procedimiento();
	$pacietnes = get_all_paciente();
	$error = "";
	
	if(isset($_REQUEST['nhistorial'])){
		if(empty($_REQUEST['nhistorial'])){
			$error = "true";
		}
		if(empty($_REQUEST['nombrepaciente'])){
			$error = "true";
		}
		if(empty($_REQUEST['fechanacimiento'])){
			$error = "true";
		}
		if(empty($_REQUEST['nombreepisodio'])){
			$error = "true";
		}
		if(empty($_REQUEST['fechaepisodio'])){
			$error = "true";
		}
	}
	
	if(!empty($_REQUEST['nhistorial'])){
		$num_historial = $_REQUEST['nhistorial'];
		$nombre = $_REQUEST['nombrepaciente'];
		$fecha_nac =date_format(date_create_from_format("d/m/Y", $_REQUEST['fechanacimiento']), "Y-m-d");
		$nombre_episodio = $_REQUEST['nombreepisodio'];
		$fecha_episodio = date_format(date_create_from_format("d/m/Y", $_REQUEST['fechaepisodio']), "Y-m-d");
		$edadConsulta = calcular_edad($fecha_nac);
		$id_servicio = $_REQUEST['idservicio'];
		$id_patologia = $_REQUEST['idpatologia'];
		$id_tipop = $_REQUEST['idtipop'];
		$paciente_encontrado;
		
		$existe = false;
		foreach ($pacietnes as $paciente) {
			if($num_historial == $paciente['numeroHistorial']){
				$paciente_encontrado = $paciente;
				$existe = true;
				break;
			}
		}
		if($existe){
			create_episodio($nombre_episodio, $fecha_episodio, $edadConsulta,$paciente_encontrado['id_paciente'], 
			$id_servicio, 1, $id_patologia);
			create_procedimiento($id_tipop, null);
		}else{
			$id_paciente = create_paciente($num_historial, $nombre, $fecha_nac, null, null, null, null);
			$id_episodio = create_episodio($nombre_episodio, $fecha_episodio, $edadConsulta, $id_paciente, $id_servicio, 1, $id_patologia);
			$id_procedimiento = create_procedimiento($id_tipop, null);
			create_episodio_procedimiento($id_episodio, $id_procedimiento);
		}
		header("Location: inicio.php");
		$error="false";
	}

?>
<head>
	<title>Inicio</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
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
			<div id="error"><?php if($error=="true"){ echo "<div id=\"divError\" class=\"alert alert-danger\" role=\"alert\"><label id=\"error1\"><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>&nbsp;Informaci&oacute;n no guardada por errores en el formulario</label></div>";}
				if($error=="false"){echo "<div id=\"divsuccess\" class=\"alert alert-success\" role=\"alert\"><label id=\"success\"><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Informaci&oacute;n guardada</label></div>";} ?></div>
			<form action="inicio.php" method="post" class="form-horizontal">
				<div id="grupo1">
					<h3 id="titulo1">
						Datos del paciente
					</h3>
					<div class="form-group">
						<label id="nhlabel" for="nhistorial" class="col-sm-2 control-label">Numero Historial</label>
						<div class="col-sm-10">
							<input type="text" id="nhistorial" name="nhistorial" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label id="nplabel" for="nombrepaciente" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
							<input type="text" id="nombrepaciente" name="nombrepaciente" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label id="fnlabel" for="fechanacimiento" class="col-sm-2 control-label">Fecha Nacimiento</label>
						<div class="col-sm-10">
							<input type="text" id="fechanacimiento" name="fechanacimiento" placeholder="dd/mm/aaaa" class="form-control">
						</div>
					</div>
				</div>
				<div id="grupo2">
					<h3 id="titulo2">
						Datos del Episodio
					</h3>
					<div class="form-group">
						<label id="nlabel" for="nombreepisodio" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
							<input type="text" id="nombreepisodio" name="nombreepisodio" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label id="flabel" for="fechaepisodio" class="col-sm-2 control-label">Fecha</label>
						<div class="col-sm-10">
							<input type="text" id="fechaepisodio" name="fechaepisodio" placeholder="dd/mm/aaaa" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label id="slabel" for="servicio" class="col-sm-2 control-label">Servicio</label>
						<div class="col-sm-10">
							<select id="servicio" name="idservicio" class="form-control">
							<?php
								foreach ($services as $value) {
									echo "<option value=\"".$value["id_servicio"]."\">".$value[nombre]."</option>";
								}
							?>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label id="plabel" for="patologia" class="col-sm-2 control-label">Patologia</label>
						<div class="col-sm-10">
						<select id="patologia" name="idpatologia" class="form-control">
							<?php
								foreach ($patologias as $value) {
									echo "<option value=\"".$value["id_patologia"]."\">".$value[nombre]."</option>";
								}
							?>
						</select>
						</div>
					</div>
				</div>
				<div id="grupo3">
					<h3 id="titulo3">
						Datos del Procedimiento
					</h3>
					</div>
					<div class="form-group">
						<label id="tlabel" for="tipo" class="col-sm-2 control-label">Tipo</label>
						<div class="col-sm-10">
						<select id="tipo" name="idtipop" class="form-control">
							<?php
								foreach ($procedimientos as $value) {
									echo "<option value=\"".$value["id_tipop"]."\">".$value[nombre]."</option>";
								}
							?>
						</select>
						</div>
				</div>
				<div id="botones" class="pull-right">
					<input type="submit" class="btn btn-default" value="Guardar">
				</div>
				
				
			</form>
		</div>
	</div>
</body>