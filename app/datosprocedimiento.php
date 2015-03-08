<?php
	include"menu.php";
	if(!isset($_GET['idepisodio']) or !isset($_GET['idprod'])){
		header("Location: error.php");
	}else{
		$id_episodio = intval($_GET['idepisodio']);
		$id_prod = intval($_GET['idprod']);
		$error = false;
		$action = false;
		if(isset($_POST['prod-submit'])){
			if($_POST['resultado']==""){
				$error = true;
			}elseif($_POST['notas']==""){
				$error = true;
			}else{
				if($id_prod==0){
					$id_evolucion = create_evolucion($_POST['resultado'], $_POST['notas']);
					$id_nprod = create_procedimiento($_POST['tipoprod'], $id_evolucion);
					header("Location: datosprocedimiento.php?idepisodio=$id_episodio&idprod=$id_nprod");
				}else{
					$procedimiento = get_by_id_procedimiento($id_prod);
					$id_evolucion = $procedimiento['id_evolucion'];
					update_procedimiento($id_prod, $_POST['tipoprod'], $id_evolucion);
					update_evolucion($id_evolucion, $_POST['resultado'], $_POST['notas']);
				}
				$action = true;
			}
		}
		if(isset($_POST['delete-submit'])){
			foreach ($_POST as $elemento) {
				if(!empty($elemento)){
					delete_documento($elemento, 'doc');
				}
			}
		}
		$tipos = get_all_tipo_procedimiento();
		$pacientes = get_all_paciente();
		$materiales = get_all_material_from_procedimiento($id_prod);
		$materiales_posibles = get_all_material();
		$complicaciones = get_all_complicacion_from_procedimiento($id_prod);
		$episodio = get_by_id_episodio($id_episodio);
		$id_paciente = $episodio['id_paciente'];
		if($id_prod!=0){
			$procedimiento = get_by_id_procedimiento($id_prod);
			$evolucion = get_by_id_evolucion($procedimiento['id_evolucion']);
		}
		$imagenes = get_by_id_relacionada($id_prod, 'img_pro');
		$documentos = get_by_id_relacionada($id_prod, 'doc');
		
		if (isset($_POST['materiales-submit'])){
			foreach ($materiales as $elem) {
				delete_procedimiento_mataterial($id_prod, $elem['id_material']);
			}
			foreach ($_POST as $elemento) {
				if(!empty($elemento)){
					create_procedimiento_material($id_prod, $elemento);
				}
			}
			$string = "datosprocedimiento.php?idepisodio=$id_episodio&idprod=$id_prod";
			header("Location:$string");
		}
		$documentos = get_by_id_relacionada($id_prod, 'doc');
		$path = "C:/xampp/htdocs/root/docs/";

?>
<head>
	<title>Datos Procedimiento</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
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
			<div id="message">
			<?php if($error=="true"){ echo "<div id=\"divError\" class=\"alert alert-danger\" role=\"alert\"><label id=\"error1\"><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>&nbsp;Informaci&oacute;n no guardada por errores en el formulario</label></div>";}
				if($action=="true"){echo "<div id=\"divsuccess\" class=\"alert alert-success\" role=\"alert\"><label id=\"success\"><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>&nbsp;Informaci&oacute;n guardada</label></div>";} ?>
			</div>
			<form action="<?php echo"datosprocedimiento.php?idepisodio=$id_episodio&idprod=$id_prod"?>" method="post" class="form-horizontal">
				<div id="grupo1">
					<div id="titulo1">
						<h3>Procedimiento</h3>
					</div>
					<div class="form-group">
						<label id="tlabel" for="tipoprocedimiento" class="col-sm-3 control-label">Tipo procedimiento</label>
						<div class="col-sm-9">
							<select id="tipoprocedimiento" class="form-control" name="tipoprod">
								<?php
									foreach ($tipos as $value) {
										$selected = false;
										if($id_prod != 0){
											if($value['id_tipop'] == $procedimiento['id_tipop']){
												$selected = true;
											}
										}
										if($selected){
											echo "<option value=\"".$value["id_tipop"]."\" selected>".$value['nombre']."</option>";
										}else{
											echo "<option value=\"".$value["id_tipop"]."\">".$value['nombre']."</option>";
										}
									}
								?>
							</select>
							</div>
					</div>
					<div class="form-group">
						<label id="rlabel" for="resultado" class="col-sm-3 control-label">Resultado</label>
						<div class="col-sm-9">
							<textarea type="text" id="resultado" name="resultado" class="form-control"><?php if($id_prod!=0){echo $evolucion['resultado'];} ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label id="nlabel" for="notas" class="col-sm-3 control-label">Notas</label>
						<div class="col-sm-9">
							<textarea type="text" id="notas" name="notas" class="form-control"><?php if($id_prod!=0){echo $evolucion['notas'];} ?></textarea>
						</div>
					</div>
					
					<div id="botonesdp" class="col-md-12">
						<input type="submit" class="btn btn-default pull-right" name="prod-submit" value="Guardar">
						<a href="<?php echo"datosepisodio.php?idepisodio=$id_episodio&idpaciente=$id_paciente" ?>"><button type="button" class="btn btn-default pull-right">Volver</button></a>
					</div>
				</div>
			</form>
				<div id="grupo2">
					<div id="titulo2">
						<h3>Materiales</h3>
					</div>
					<div class="lista">
						<ol>
							<?php
								foreach ($materiales as $material) {
									$nombre = $material['nombre'];
									echo "<li>$nombre</li>";
								}
							?>
						</ol>
					</div>
					<div id="botonesmaterial">
						<?php if($id_prod==0){
							echo "<div class=\"pull-right\"><button type=\"button\" class=\"btn btn-default\" disabled=\"true\">Modificar</button>
							<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\" title=\"Es necesario guardar primero\"></span></div>";
						}else{
							echo "<button type=\"button\" class=\"btn btn-default pull-right\" data-toggle=\"modal\" data-target=\"#modMaterial\">Modificar</button>";
						}?>
					</div>

					<div id="grupo3">
						<div id="titulo3">
							<h3>Complicaciones</h3>
						</div>
						<div class="lista">
							<ol>
								<?php
									foreach ($complicaciones as $complicacion) {
										$nombre = $complicacion['nombre'];
										$id_comp = $complicacion['id_complicacion'];
										echo "<li><a href=\"datoscomplicacion.php?idepisodio=$id_episodio$&idproc=$id_prod&idcomp=$id_comp\">$nombre</a></li>";
									}
								?>
							</ol>
						</div>
						<div id="botonescomplicaiones">
							<?php if($id_prod==0){
							echo "<div class=\"pull-right\"><button type=\"button\" class=\"btn btn-default\" disabled=\"true\">Nueva</button>
							<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\" title=\"Es necesario guardar primero\"></span></div>";
						}else{
							echo "<a href=\"datoscomplicacion.php?idepisodio=$id_episodio$&idproc=$id_prod&idcomp=0\"><button type=\"button\" class=\"btn btn-default pull-right\">Nueva</button></a>";
						}?>
						</div>
					</div>
					<div id="grupo4">
						<div id="titulo4">
							<h3>Imagenes Asociadas</h3>
						</div>
						<div id="imagenes" class="col-md-12 lista-imagenes">
							<?php
								if(empty($imagenes)){
									echo "No hay imagenes que mostrar";
								}else{
									foreach ($imagenes as $imagen) {
										$src= base64_encode($imagen['image']);
										$name = $imagen['image_name'];
										$id_imagen = $imagen['id_imagen'];
										echo "<div class=\"col-md-4\"><a href=\"editimage.php?mode=doc&idas=$id_prod&other=$id_episodio&id=$id_imagen\">
										<img src=\"data:image/jpg;base64,$src\" class=\"img-rounded image-preview\" alt=\"Responsive image\"></a><h6>$name</h6></div>";
									}
								}
							?>
						</div>
						<div id="botonesimg">
							<?php if($id_prod==0){
							echo "<div class=\"pull-right\"><button type=\"button\" class=\"btn btn-default\" disabled=\"true\">Añadir Imagen</button>
							<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\" title=\"Es necesario guardar primero\"></span></div>";
						}else{
							echo "<a href=\"save.php?mode=img_pro&idas=$id_prod&other=$id_episodio\"><button type=\"button\" class=\"btn btn-default pull-right\">Añadir Imagen</button></a>";
						}?>							
						</div>
					</div>
					<div id="grupo4">
						<div id="titulo4">
							<h3>Documentos Asociados</h3>
						</div>
						<div class="lista">
						<table class="table table-striped">
							<form action="<?php echo"datosprocedimiento.php?idepisodio=$id_episodio&idprod=$id_prod"?>" method="post">
							<?php
								foreach ($documentos as $doc) {
									$id_doc = $doc['id_doc'];
									$filename = $doc['doc_name'];
									$fullPath = $path . $filename;
									file_put_contents($fullPath, $doc['doc']);
									echo "<tr><td><a href=\"/root/docs/$filename\">$filename</a></td>
									<td><input type=\"checkbox\" name=\"$id_doc\" value=\"$id_doc\"></td></tr>";
								}
							?>
							
						</table>
						</div>
						<div id="botonesimg">
							<?php if(!empty($documentos)){
								echo "<input type=\"submit\" class=\"btn btn-default pull-right\" name=\"delete-submit\" value=\"Eliminar Seleccionados\">";
							}
							if($id_prod==0){
							echo "<div class=\"pull-right\"><button type=\"button\" class=\"btn btn-default\" disabled=\"true\">Añadir Documento</button>
							<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\" title=\"Es necesario guardar primero\"></span></div>";
						}else{
							echo "<a href=\"save.php?mode=doc&idas=$id_prod&other=$id_episodio\"><button type=\"button\" class=\"btn btn-default pull-right\">Añadir Documento</button></a>";
						}?>
						</div></form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
			<div class="modal fade" id="modMaterial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">Seleccione los factores para el paciente</h4>
						</div>
						<div class="modal-body">
							<form action="<?php echo"datosprocedimiento.php?idepisodio=$id_episodio&idprod=$id_prod" ?>" method="post" class="form-horizontal">
								<div class="lista" style="height: 50%;">
								<?php
									$cont = 0;
									foreach ($materiales_posibles as $material_p){
										$m_name = $material_p['nombre'];
										$m_id = $material_p['id_material'];
										$checked = false;
										foreach ($materiales as $material_s) {
											if((int)$m_id == (int)$material_s['id_material']){
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
													value="<?php echo $m_id ?>" 
													<?php if($checked){echo "checked";}?>>
													<label for="<?php echo $m_name ?>"><?php echo $m_name ?></label>
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
							<button type="submit" name="materiales-submit" class="btn btn-primary">
								Guardar
							</button>
							</form>
						</div>
					</div>
				</div>
			</div>
	</body>
<?php } ?>
