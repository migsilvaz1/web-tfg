<?php
	include"menu.php";
	if(!isset($_GET['idepisodio']) or !isset($_GET['idpdiag'])){
		header("Location: error.php");
	}else{
		$id_episodio = intval($_GET['idepisodio']);
		$id_pdiag = intval($_GET['idpdiag']);
		$error = false;
		$action = false;
		if(isset($_POST['pdiag-submit'])){
			if($_POST['nombreprueba']==""){
				$error = true;
			}else{
				if($id_pdiag == 0){
					$id_npdiag = create_pdiagnostica($_POST['nombreprueba'], $_POST['radiologo']);
					create_episodio_pdiagnostica($id_episodio, $id_npdiag);
					header("Location: datospruebadiagnostica.php?idepisodio=$id_episodio&idpdiag=$id_npdiag");
				}else{
					update_pdiagnostica($id_pdiag, $_POST['nombreprueba'], $_POST['radiologo']);
				}
				$action = true;
			}
		}
		$radiologos = get_all_radiologo();
		$pacientes = get_all_paciente();
		if($id_pdiag != 0){
			$pdiag = get_by_id_pdiagnostica($id_pdiag);
		}
		$episodio = get_by_id_episodio($id_episodio);
		$id_paciente = $episodio['id_paciente'];
		$imagenes = get_by_id_relacionada($id_pdiag, "img_pd");
		
?>
<head>
	<title>Datos prueba diagnóstica</title>
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
			<form action="<?php echo"datospruebadiagnostica.php?idepisodio=$id_episodio&idpdiag=$id_pdiag"?>" method="post" class="form-horizontal">
				<div id="grupo1">
					<div id="titulo1">
						<h3>Datos Prueba Diagnostica</h3>
					</div>
					<div class="form-group">
						<label id="nplabel" for="nombreprueba" class="col-sm-3 control-label">Nombre</label>
						<div class="col-sm-9">
							<input type="text" id="nombreprueba" name="nombreprueba" class="form-control" value="<?php if($id_pdiag != 0){ echo $pdiag['nombre'];} ?>">
						</div>
					</div>
					<div class="form-group">
						<label id="rlabel" for="radiologo" class="col-sm-3 control-label">Radiologo</label>
						<div class="col-sm-9">
							<select id="radiologo" name="radiologo" class="form-control">
								<?php
									foreach ($radiologos as $value) {
										$selected = false;
										if($id_pdiag != 0){
											if($value['id_radiologo'] == $pdiag['id_radiologo']){
												$selected = true;
											}
										}
										if($selected){
											echo "<option value=\"".$value["id_radiologo"]."\" selected>".$value['nombre']."</option>";
										}else{
											echo "<option value=\"".$value["id_radiologo"]."\">".$value['nombre']."</option>";
										}
									}
								?>
							</select>
						</div>
					</div>
					<div id="botonesdp" class="col-md-12">
						<input type="submit" class="btn btn-default pull-right" name="pdiag-submit" value="Guardar">
						<a href="<?php echo"datosepisodio.php?idepisodio=$id_episodio&idpaciente=$id_paciente" ?>"><button type="button" class="btn btn-default pull-right">Volver</button></a>
					</div>
				</div>
				</form>
				<div id="grupo2">
					<div id="titulo2">
						<h3>Im&aacute;genes Asociadas</h3>
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
									echo "<div class=\"col-md-4\"><a href=\"editimage.php?mode=img_pd&idas=$id_pdiag&other=$id_episodio&id=$id_imagen\">
									<img src=\"data:image/jpg;base64,$src\" class=\"img-rounded image-preview\" alt=\"Responsive image\"></a><h6>$name</h6></div>";
								}
							}
						?>
					</div>
					<div id="botonesimg">
						<?php if($id_pdiag==0){
							echo "<div class=\"pull-right\"><button type=\"button\" class=\"btn btn-default\" disabled=\"true\">Añadir Imagen</button>
							<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\" title=\"Es necesario guardar primero\"></span></div>";
						}else{
							echo "<a href=\"save.php?mode=img_pd&idas=$id_pdiag&other=$id_episodio\"><button type=\"button\" class=\"btn btn-default pull-right\">Añadir Imagen</button></a>";
						}?>
					</div>		
		</div>
	</div>
</body>
<?php } ?>