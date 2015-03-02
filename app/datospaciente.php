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
</head>
<body>
	<div id="inicio" class="container" style="margin-top: 60px;">
		<!-- Barra lateral -->
		<div id="blateral" class="jumbotron col-md-4">
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
			<form action="<?php echo"datospaciente.php?idpaciente=$lid" ?>" method="post">
				<div id="grupo1">
					<div id="titulo1">
						Datos del paciente
					</div>
					<label id="nhlabel" for="nhistorial">Numero de historial</label>
					<input type="text" id="nhistorial" name="nhistorial" value="<?php echo $paciente['numeroHistorial']; ?>">
					<label id="nplabel" for="nombrepaciente" >Nombre</label>
					<input type="text" id="nombrepaciente" name="nombrepaciente" value="<?php echo $paciente['nombre']; ?>">
					<label id="fnlabel" for="fechanacimiento">Fecha nacimiento</label>
					<input type="text" id="fechanacimiento" name="fechanacimiento" value="<?php echo $paciente['fechaNacimiento']; ?>">
					<label id="sexlabel" for="sexo">Sexo</label>
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
					<label id="eclabel" for="enfermedadesconocidas">Enfermedades conocidas</label>
					<textarea id="enfermedadesconocidas" name="enfermedadesconocidas"><?php echo $paciente['enfermedadesConocidas']; ?></textarea>
					<div id="botonesdp">
						<input type="submit" value="Guardar">
					</div>
				</div>
			</form>
			<form action="datospaciente.php" method="post">
				<div id="grupo2">
					<div id="titulo2">
						Factores de riesgo
					</div>
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