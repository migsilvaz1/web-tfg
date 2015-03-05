<?php
	include "menu.php";
	if(!isset($_GET['idpaciente'])){
		header("Location: error.php");
	}else{
		$pacietnes = get_all_paciente();
		$id = $_GET['idpaciente'];
		$paciente = get_by_id_paciente($_GET['idpaciente']);
		$episodios = get_all_episodio_from_paciente($id);
		$factores_paciente = get_all_factor_from_paciente($id);
		$factores_posibles = get_all_factor();
		
		if(isset($_POST['paciente-submit'])){
			$num_historial = $_REQUEST['nhistorial'];
			$nombre = $_REQUEST['nombrepaciente'];
			$fecha_nac = date_format(date_create_from_format("d/m/Y", $_REQUEST['fechanacimiento']), "Y-m-d");
			$sexo = $_REQUEST['sexo'];
			$enfermedades = $_REQUEST['enfermedadesconocidas'];
			update_paciente($id, $num_historial, $nombre, $fecha_nac, $sexo, $enfermedades, null, null);
			header("Location: datospaciente.php?idpaciente=$id");
		}
		if (isset($_POST['factores-submit'])){
			foreach ($factores_paciente as $elem) {
				delete_paciente_factor($id, $elem['id_factor']);
			}
			foreach ($_POST as $elemento) {
				if(!empty($elemento)){
					create_paciente_factor($id, $elemento);
				}
			}
			$string = "datospaciente.php?idpaciente=$id";
			header("Location:$string");
		}
?>
<head>
	<title>Datos Paciente</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
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
			<?php foreach ($_POST as $elemento) {
					print_r($elemento);
			}
			?>
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
							<input type="text" class="form-control" id="fechanacimiento" name="fechanacimiento" value="<?php echo date("d/m/Y", strtotime($paciente['fechaNacimiento'])); ?>">
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
					<div id="botonesdp">
						<input type="submit" class="btn btn-default" name="paciente-submit" value="Guardar">
					</div>
				</div>
			</form>
			<div id="grupo2">
				<h3 id="titulo2">Factores de riesgo</h3>
				<div class="lista">
					<ol>
						<?php
							foreach ($factores_paciente as $factor) {
								$nombre_factor = $factor['nombre'];
								echo "<li>$nombre_factor</li>";
							}
						?>
					</ol>
				</div>
					<div id="botonesfc">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modFactores">
							Modificar
						</button>
					</div>
				</div>
				<div id="grupo3">
					<h3 id="titulo3">
						Episodios
					</h3>
					<div class="lista">
					<ol id="listaepisodios">
						<?php
							foreach ($episodios as $episodio) {
								$idepisodio = $episodio['id_episodio'];
								$nepisodio = $episodio['nombre'];
								echo "<li><a href=\"datosepisodio.php?idepisodio=$idepisodio&idpaciente=$id\">$nepisodio</a></li>";
							}
						?>
					</ol>
				</div>
				<div id="botonnuevoep">
						<a href="datosepisodio.php?idepisodio=0&idpaciente=<?php echo $id ?>"\><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modFactores">
							Nuevo
						</button></a>
					</div>
				</div>

			<!-- Modal -->
			<div class="modal fade" id="modFactores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Seleccione los factores para el paciente</h4>
						</div>
						<div class="modal-body">
							<form action="<?php echo"datospaciente.php?idpaciente=$id" ?>" method="post" class="form-horizontal">
								<div class="lista" style="height: 50%;">
								<?php
									$cont = 0;
									foreach ($factores_posibles as $fact){
										$fact_name = $fact['nombre'];
										$fact_id = $fact['id_factor'];
										$checked = false;
										foreach ($factores_paciente as $factp) {
											if((int)$fact['id_factor'] == (int)$factp['id_factor']){
												$checked = true;
												break;
											}
										}
										?>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<div class="checkbox">
													<input type="checkbox" id="<?php echo $fact_name ?>" 
													name="<?php echo $cont ?>" 
													value="<?php echo $fact_id ?>" 
													<?php if($checked){echo "checked";}?>>
													<label for="<?php echo $fact_name ?>"><?php echo $fact_name ?></label>
												</div>
											</div>
										</div>
										<?php
										$cont++;
									}
								?>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Cancelar
							</button>
							<button type="submit" name="factores-submit" class="btn btn-primary">
								Guardar
							</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			</div>
	</div>
</body>
<?php }
?>