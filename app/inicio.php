<?php
	include"menu.php";
	
	$services = get_all_servicio();
	$patologias = get_all_patologia();
	$procedimientos = get_all_tipo_procedimiento();
	$pacietnes = get_all_paciente();
	$error = false;
	
	if(isset($_REQUEST['nhistorial'])){
		if(empty($_REQUEST['nhistorial'])){
			$error = true;
		}
		if(empty($_REQUEST['nombrepaciente'])){
			$error = true;
		}
		if(empty($_REQUEST['fechanacimiento'])){
			$error = true;
		}
		if(empty($_REQUEST['nombreepisodio'])){
			$error = true;
		}
		if(empty($_REQUEST['fechaepisodio'])){
			$error = true;
		}
	}
	
	if(!empty($_REQUEST['nhistorial'])){
		$num_historial = $_REQUEST['nhistorial'];
		$nombre = $_REQUEST['nombrepaciente'];
		$fecha_nac = $_REQUEST['fechanacimiento'];
		$nombre_episodio = $_REQUEST['nombreepisodio'];
		$fecha_episodio = $_REQUEST['fechaepisodio'];
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
			create_episodio($nombre_episodio, $fecha_episodio, $paciente_encontrado['id_paciente'], 
			$id_servicio, 1, $id_patologia);
			create_procedimiento($id_tipop, null);
		}else{
			$id_paciente = create_paciente($num_historial, $nombre, $fecha_nac, null, null, null, null);
			$id_episodio = create_episodio($nombre_episodio, $fecha_episodio, $id_paciente, $id_servicio, 1, $id_patologia);
			$id_procedimiento = create_procedimiento($id_tipop, null);
			create_episodio_procedimiento($id_episodio, $id_procedimiento);
		}
	}

?>
<head>
	<title>Inicio</title>
</head>
<body>
	<div id="inicio" class="container" style="margin-top: 60px;">
		<!-- Barra lateral -->
		<div id="blateral" class="jumbotron col-md-4">
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
			<div id="error"><?php if($error){ echo "hay error";} ?></div>
			<form action="inicio.php" method="post">
				<div id="grupo1">
					<div id="titulo1">
						Datos del paciente
					</div>
					<label id="nhlabel" for="nhistorial">Numero de historial</label>
					<input type="text" id="nhistorial" name="nhistorial">
					<label id="nplabel" for="nombrepaciente" >Nombre</label>
					<input type="text" id="nombrepaciente" name="nombrepaciente">
					<label id="fnlabel" for="fechanacimiento">Fecha Nacimiento</label>
					<input type="text" id="fechanacimiento" name="fechanacimiento">
				</div>
				<div id="grupo2">
					<div id="titulo2">
						Datos del Episodio
					</div>
					<label id="nlabel" for="nombreepisodio">Nombre</label>
					<input type="text" id="nombreepisodio" name="nombreepisodio">
					<label id="flabel" for="fechaepisodio">Fecha</label>
					<input type="text" id="fechaepisodio" name="fechaepisodio">
					<label id="slabel" for="servicio">Servicio</label>
					<select id="servicio" name="idservicio">
						<?php
							foreach ($services as $value) {
								echo "<option value=\"".$value["id_servicio"]."\">".$value[nombre]."</option>";
							}
						?>
					</select>
					<label id="plabel" for="patologia">Patologia</label>
					<select id="patologia" name="idpatologia">
						<?php
							foreach ($patologias as $value) {
								echo "<option value=\"".$value["id_patologia"]."\">".$value[nombre]."</option>";
							}
						?>

					</select>
				</div>
				<div id="grupo3">
					<div id="titulo3">
						Datos del Procedimiento
					</div>
					<label id="tlabel" for="tipo">Tipo</label>
					<select id="tipo" name="idtipop">
						<?php
							foreach ($procedimientos as $value) {
								echo "<option value=\"".$value["id_tipop"]."\">".$value[nombre]."</option>";
							}
						?>
					</select>
				</div>
				<div id="botones">
					<input type="submit" value="Enviar formulario">
				</div>
				
				
			</form>
		</div>
	</div>
</body>