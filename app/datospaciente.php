<?php
	include "menu.php";
	if(!isset($_GET['idpaciente'])){
		header("Location: error.php");
	}else{
		$pacietnes = get_all_paciente();
		$id = $_GET['idpaciente'];
		$paciente = get_by_id_paciente($_GET['idpaciente']);
		$episodios = get_all_episodio_from_paciente($id);
		
		if(!empty($_REQUEST['nhistorial'])){
			$num_historial = $_REQUEST['nhistorial'];
			$nombre = $_REQUEST['nombrepaciente'];
			$fecha_nac = $_REQUEST['fechanacimiento'];
			$sexo = $_REQUEST['sexo'];
			$enfermedades = $_REQUEST['enfermedadesconocidas'];
			update_paciente($id, $num_historial, $nombre, $fecha_nac, $sexo, $enfermedades, null, null);
			header("Location: datospaciente.php?idpaciente=$id");
		}
?>
<head>
	<title>Datos Paciente</title>
	<LINK REL=StyleSheet HREF="datospaciente.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
	<div id="inicio" class="container">
		<!-- Barra lateral -->
		<div id="blateral" class="jumbotron col-md-4">
			<h3>Lista de pacientes</h3>
			<ul>
				<?php 
					foreach ($pacietnes as $lpaciente) {
						$lnombre = $lpaciente['nombre'];
						$lid = $lpaciente['id_paciente'];
						echo "<li><a href=\"datospaciente.php?idpaciente=$lid\">$lnombre</a></li>";
					}
					?>
			</ul>
		</div>
		<!-- Fin Barra -->
		<div class="col-md-1"></div>
		<div id="formulario" class="jumbotron col-md-7">
			<form action="<?php echo"datospaciente.php?idpaciente=$lid" ?>" method="post" class="form-horizontal">
				<div id="grupo1">
					<h3 id="titulo1">
						Datos del paciente
					</h3>
					<div class="form-group">
							<label id="nhlabel" for="nhistorial" class="col-sm-3 control-label">Numero Historial</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nhistorial" name="nhistorial" value="<?php echo $paciente['numeroHistorial']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label id="nplabel" for="nombrepaciente" class="col-sm-3 control-label">Nombre</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nombrepaciente" name="nombrepaciente" value="<?php echo $paciente['nombre']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label id="fnlabel" for="fechanacimiento" class="col-sm-3 control-label">Fecha nacimiento</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="fechanacimiento" name="fechanacimiento" value="<?php echo $paciente['fechaNacimiento']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label id="sexlabel" for="sexo" class="col-sm-3 control-label">Sexo</label>
						<div class="col-sm-9">
						<input type="radio" id="sexo" name="sexo" value="H" <?php
							if ($paciente['sexo'] == "H") { echo "checked";
							}
						?>>
						Hombre
						<input type="radio" id="sexo" name="sexo" value="M" <?php
							if ($paciente['sexo'] == "M") { echo "checked";
							}
						?>>
						Mujer
						</div>
					</div>
					<div class="form-group">
						<label id="eclabel" for="enfermedadesconocidas" class="col-sm-3 control-label">Enfermedades conocidas</label>
						<div class="col-sm-9">
							<textarea id="enfermedadesconocidas" class="form-control" name="enfermedadesconocidas"><?php echo $paciente['enfermedadesConocidas']; ?></textarea>
						</div>
					</div>
					<div id="botonesdp" class="pull-right">
						<input type="submit" class="btn btn-default" value="Guardar">
					</div>
				</div>
			</form>
			<div id="grupo2">
				<h3 id="titulo2">Factores de riesgo</h3>
					<ul>
						<li>
							Prueba
						</li>
					</ul>
					<div id="botonesfc">
						<input type="submit" value="Elimiar">
						<input type="submit" value="Anadir">
					</div>
				</div>
			</form>
			<form action="datospaciente.php" method="post">
				<div id="grupo3">
					<div id="titulo3">
						Episodios
					</div>
					<ul>
						<?php
							foreach ($episodios as $episodio) {
								$idepisodio = $episodio['id_episodio'];
								$nepisodio = $episodio['nombre'];
								echo "<li><a href=\"detallesepisodio.php?idepisodio=$idepisodio\">$nepisodio</a></li>";
							}
						?>
					</ul>
				</div>

			</form>
		</div>
	</div>
</body>
<?php }
?>