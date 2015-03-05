<?php
	include"menu.php";
	if(!isset($_GET['idepisodio']) or !isset($_GET['idpaciente'])){
		header("Location: error.php");
	}else{
		$id = intval($_GET['idepisodio']);
		$id_paciente = intval($_GET['idpaciente']);
		$error = false;
		$action = false;
		if(isset($_POST['episodio-submit'])){
			if($_POST['nombreepisodio']==""){
				$error = true;
			}elseif($_POST['fechaepisodio']==""){
				$error = true;
			}else{
				$nombre = $_POST['nombreepisodio'];
				$fecha = date_format(date_create_from_format("d/m/Y", $_POST['fechaepisodio']), "Y-m-d");
				$servicio = $_POST['servicioepisodio'];
				$patologia = $_POST['patologiaepisodio'];
				$centro = $_POST['centroepisodio'];
				if($id == 0){
					create_episodio($nombre, $fecha, $id_paciente, $servicio, $centro, $patologia);
					$action = true;
				}else{
					update_episodio($id, $nombre, $fecha, $id_paciente, $servicio, $centro, $patologia);
					$action = true;
				}
			}
		}
		if(isset($_POST['botonndiagnostico'])){
			if($_POST['ndiagnostico']==""){
				$error = true;
			}else{
				create_diagnostico($_POST['ndiagnostico'], $id);
				$action = true;
			}
			
		}
		$pacietnes = get_all_paciente();
		$services = get_all_servicio();
		$patologias = get_all_patologia();
		$centros = get_all_centro();
		$diagnosticos = get_all_diagnostico_from_episodio($id);
		$procedimientos = get_all_procedimiento_from_episodio($id);
		$pruebas_diagnosticas = get_all_pdiag_from_episodio($id);
		if($id != 0){
			$episodio = get_by_id_episodio($id);
		}

?>
<head>
	<title>Datos del episodio</title>
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
						$lid = $paciente['id_paciente'];
						echo "<li><a href=\"datospaciente.php?idpaciente=$lid\">$nombre</a></li>";
					}
					?>
			</ul>
		</div>
		<!-- Fin Barra -->
		<div class="col-md-1"></div>
		<div id="formulario" class="jumbotron col-md-7">
			<div id="message">
			<?php if($error=="true"){ echo "<div id=\"divError\" class=\"alert alert-danger\" role=\"alert\"><label id=\"error1\"><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>&nbsp;Informaci&oacute;n no guardada por errores en el formulario</label></div>";}
				if($action=="true"){echo "<div id=\"divsuccess\" class=\"alert alert-success\" role=\"alert\"><label id=\"success\"><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Informaci&oacute;n guardada</label></div>";} ?>
			</div>
			<form action="<?php echo"datosepisodio.php?idepisodio=$id&idpaciente=$id_paciente"?>" method="post" class="form-horizontal">
				<div id="grupo1">
					<div id="titulo1">
						<h3>Datos del Episodio</h3>
					</div>
					<div class="form-group">
						<label id="nlabel" for="nombreepisodio" class="col-sm-3 control-label">Nombre</label>
						<div class="col-sm-9">
							<input type="text" id="nombreepisodio" name="nombreepisodio" class="form-control" value="<?php if($id != 0){echo $episodio['nombre'];} ?>">
						</div>
					</div>
					<div class="form-group">
						<label id="flabel" for="fechaepisodio" class="col-sm-3 control-label">Fecha</label>
						<div class="col-sm-9">
							<input type="text" id="fechaepisodio" name="fechaepisodio" class="form-control" value="<?php if($id != 0){echo date("d/m/Y", strtotime($episodio['fecha']));} ?>">
						</div>
					</div>
					<div class="form-group">
						<label id="slabel" for="servicio" class="col-sm-3 control-label">Servicio</label>
						<div class="col-sm-9">
							<select id="servicio" class="form-control" name="servicioepisodio">
								<?php
									foreach ($services as $value) {
										$selected = false;
										if($id != 0){
											if($value['id_servicio'] == $episodio['id_servicio']){
												$selected = true;
											}
										}
										if($selected){
											echo "<option value=\"".$value["id_servicio"]." \" selected>".$value['nombre']."</option>";
										}else{
											echo "<option value=\"".$value["id_servicio"]."\">".$value['nombre']."</option>";
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label id="plabel" for="patologia" class="col-sm-3 control-label">Patologia</label>
						<div class="col-sm-9">
							<select id="patologia" class="form-control" name="patologiaepisodio">
								<?php
									foreach ($patologias as $value) {
										$selected = false;
										if($id != 0){
											if($value['id_patologia'] == $episodio['id_patologia']){
												$selected = true;
											}
										}
										if($selected){
											echo "<option value=\"".$value["id_patologia"]."\" selected>".$value['nombre']."</option>";
										}else{
											echo "<option value=\"".$value["id_patologia"]."\">".$value['nombre']."</option>";
										}
									}
								?>
		
							</select>
						</div>
					</div>
					<div class="form-group">
						<label id="clabel" for="centro" class="col-sm-3 control-label">Centro</label>
						<div class="col-sm-9">
							<select id="centro" class="form-control" name="centroepisodio">
								<?php
									foreach ($centros as $value) {
										$selected = false;
										if($id != 0){
											if($value['id_centro'] == $episodio['id_centro']){
												$selected = true;
											}
										}
										if($selected){
											echo "<option value=\"".$value["id_centro"]."\" selected>".$value['nombre']."</option>";
										}else{
											echo "<option value=\"".$value["id_centro"]."\">".$value['nombre']."</option>";
										}
									}
								?>
							</select>
						</div>
					</div>
					<div id="botonesdp">
						<input type="submit" class="btn btn-default" name="episodio-submit" value="Guardar">
					</div>
				</div>
				</form>
				
				<div id="grupo4">
					<div id="titulo2">
						<h3>Diagn&oacute;sticos</h3>
					</div>
					<div class="lista">
					<ol>
						<?php
							foreach ($diagnosticos as $value) {
								$texto = $value['nombre'];
								echo "<li>$texto</li>";
							}
						?>
					</ol>
					</div>
					<div id="bndiag">
						<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#modFactores">
							Nuevo
						</button>
					</div>
				
				<div id="grupo2">
					<div id="titulo2">
						<h3>Pruebas diagnosticas</h3>
					</div>
					<div class="lista">
					<ol>
						<?php
							foreach ($pruebas_diagnosticas as $value) {
								$texto = $value['nombre'];
								$id_pdiag = $value['id_pdiagnostica'];
								echo "<li><a href=\"datospruebadiagnostica.php?idpdiag=$id_pdiag&idepisodio=$id\">$texto</a></li>";
							}
						?>
					</ol>
					</div>
					<div id="bnpdiag">
						<a href="datospruebadiagnostica.php?idpdiag=0&idepisodio=<?php echo $id ?>"\><button type="button" class="btn btn-default pull-right">
							Nuevo
						</button></a>
					</div>
				
				<div id="grupo3">
					<div id="titulo3">
						<h3>Procedimientos</h3>
					</div>
					<div class="lista">
					<ol>
						<?php
							foreach ($procedimientos as $value) {
								$tipop = get_by_id_tipo_procedimiento($value['id_tipop']);
								$texto = $tipop['nombre'];
								$id_prod = $value['id_procedimiento'];
								echo "<li><a href=\"datosprocedimiento.php?idprod=$id_prod&idepisodio=$id\">$texto</a></li>";
							}
						?>
					</ol>
					</div>
					<div id="bndiag">
						<a href="datosprocedimiento.php?idprod=0&idepisodio=<?php echo $id ?>"\><button type="button" class="btn btn-default pull-right">
							Nuevo
						</button></a>
					</div>
				</div>
			</div>
		</div>
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
							<h4 class="modal-title" id="myModalLabel">Inserte el nuevo diagn&oacute;tico</h4>
						</div>
						<div class="modal-body">
							<form action="<?php echo"datosepisodio.php?idepisodio=$id&idpaciente=$id_paciente"?>" method="post" class="form-horizontal">
								<div class="form-group">
									<label id="dlabel" for="ndiagnostico" class="col-sm-3 control-label">Diagn&oacute;stico</label>
									<div class="col-sm-offset-2 col-sm-10">
										<textarea id="ndiagnostico" name="ndiagnostico" class="form-control"></textarea>	
									</div>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Cancelar
							</button>
							<button type="submit" class="btn btn-primary" name="botonndiagnostico">
								Guardar
							</button>
							</form>
						</div>
					</div>
				</div>
			</div>
	
</body>
<?php
	}
?>