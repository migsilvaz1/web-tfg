<?php
	include"menu.php";
	if(!isset($_GET['idepisodio']) or !isset($_GET['idproc']) or !isset($_GET['idcomp'])){
		header("Location: error.php");
	}else{
		$id_episodio = intval($_GET['idepisodio']);
		$id_proc = intval($_GET['idproc']);
		$id_comp = intval($_GET['idcomp']);
		$error = false;
		$mesaje="";
		if(isset($_POST['comp-submit'])){
			if($_POST['detalles']==""){
				$error = true;
				$mesaje="entro en error detalles";
			}elseif(!isset($_POST['mortemp'])){
				$error = true;
				$mesaje=$mesaje." entro en error mortalidad temprana";
			}elseif(!isset($_POST['mortard'])){
				$error = true;
				$mesaje=$mesaje." entro en error mortalidad tardia";
			}else{
				if($id_comp==0){
					$id_ncomp = create_complicacion($_POST['detalles'], $_POST['mortemp'], $_POST['mortard']);
					create_complicacion_procedimiento($id_proc, $id_ncomp);
					$mesaje=$mesaje." entro en opcion1";
				}else{
					update_complicacion($id_comp, $_POST['detalles'], $_POST['mortemp'], $_POST['mortard']);
					$mesaje=$mesaje." entro en opcion2";
				}
				header("Location: datosprocedimiento.php?idepisodio=$id_episodio&idprod=$id_proc");
			}
		}
		$pacientes = get_all_paciente();
		if($id_comp!=0){
			$complicacion = get_by_id_complicacion($id_comp);
		}
?>
<head>
	<title>Datos Complicaci&oacute;n</title>
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
			<?php print_r($mesaje) ?>
		</div>
		<!-- Fin Barra -->
		<div class="col-md-1"></div>
		<div id="formulario" class="jumbotron col-md-7">
			<div id="message">
			<?php if($error==true){ echo "<div id=\"divError\" class=\"alert alert-danger\" role=\"alert\"><label id=\"error1\"><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>&nbsp;Informaci&oacute;n no guardada por errores en el formulario</label></div>";}?>
			</div>
			<form action="<?php echo"datoscomplicacion.php?idepisodio=$id_episodio$&idproc=$id_proc&idcomp=$id_comp"?>" method="post" class="form-horizontal">
				<div id="grupo1">
					<div id="titulo1">
						<h3>Complicaci&oacute;n</h3>
					</div>
					<div class="form-group">
						<label id="rlabel" for="detalles" class="col-sm-3 control-label">Detalles</label>
						<div class="col-sm-9">
							<textarea type="text" id="detalles" name="detalles" class="form-control"><?php if($id_comp!=0){echo $complicacion['nombre'];} ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label id="mtlabel" for="mortemp" class="col-sm-3 control-label">Mortalidad Temprana</label>
						<div class="col-sm-9">
							<label class="radio-inline">
							  <input type="radio" name="mortemp" id="inlineRadio1" value="S" <?php if($id_comp!=0){if($complicacion['mortalidadTemprana']=="S"){echo "checked";}} ?>> Si
							</label>
							<label class="radio-inline">
							  <input type="radio" name="mortemp" id="inlineRadio2" value="N" <?php if($id_comp!=0){if($complicacion['mortalidadTemprana']=="N"){echo "checked";}} ?>> No
							</label>
						</div>
					</div>
					<div class="form-group">
						<label id="mtalabel" for="mortard" class="col-sm-3 control-label">Mortalidad Tard&iacute;a</label>
						<div class="col-sm-9">
							<label class="radio-inline">
							  <input type="radio" name="mortard" id="inlineRadio3" value="S"<?php if($id_comp!=0){if($complicacion['mortalidadTardia']=="S"){echo "checked";}} ?>> Si
							</label>
							<label class="radio-inline">
							  <input type="radio" name="mortard" id="inlineRadio4" value="N"<?php if($id_comp!=0){if($complicacion['mortalidadTardia']=="N"){echo "checked";}} ?>> No
							</label>
						</div>
					</div>					
					<div id="botonesdp" class="col-md-12">
						<input type="submit" class="btn btn-default pull-right" name="comp-submit" value="Guardar">
						<a href="<?php echo"datosprocedimiento.php?idepisodio=$id_episodio&idprod=$id_proc" ?>"><button type="button" class="btn btn-default pull-right">Volver</button></a>
					</div>
				</div>
			</form>
			</div>
		</div>
	</body>
<?php } ?>
