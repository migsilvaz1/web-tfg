<?php
include "menu.php";
if (!isset($_GET['mode']) or !isset($_GET['idas']) or !isset($_GET['other']) or !isset($_GET['id'])) {
	header("Location: error.php");
} else {
	if(isset($_POST['guardar'])){
	// 			Volver a donde venias
		$url = "error.php";
		$id_from = $_GET['idas'];
		$id_other = $_GET['other'];
		if ($_GET['mode'] == "img_pd") {
			$url = "Location: datospruebadiagnostica.php?idepisodio=$id_other&idpdiag=$id_from";
		} elseif ($_GET['mode'] == "img_pro") {
			$url = "Location: datosprocedimiento.php?idepisodio=$id_other&idprod=$id_from";
		} elseif ($_GET['mode'] == "doc") {
			$url = "Location: datosprocedimiento.php?idepisodio=$id_other&idprod=$id_from";
		}
		header($url);
	}
	$pacientes = get_all_paciente();
	$mode = $_GET['mode'];
	$idas = $_GET['idas'];
	$other = $_GET['other'];
	$imagen = get_by_id_documento($_GET['id'], $mode);
?>
<head>
	<title>Editar</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
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
		</div>
		</div>
		<
<?php } ?>
		