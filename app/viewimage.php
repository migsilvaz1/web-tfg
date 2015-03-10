<?php
include "menu.php";
if (!isset($_GET['mode']) or !isset($_GET['idas']) or !isset($_GET['other']) or !isset($_GET['id'])) {
	header("Location: error.php");
} else {
	$mode = $_GET['mode'];
	$idas = $_GET['idas'];
	$other = $_GET['other'];
	$id = $_GET['id'];
	$imagen = get_by_id_documento($_GET['id'], $mode);
	$src= base64_encode($imagen['image']);
	$name = $imagen['image_name'];
	if(isset($_POST['eliminar'])){
		delete_documento($id, $mode);
		$url = "error.php";
		if ($mode == "img_pd") {
			$url = "Location: datospruebadiagnostica.php?idepisodio=$other&idpdiag=$idas";
		} elseif ($mode == "img_pro") {
			$url = "Location: datosprocedimiento.php?idepisodio=$other&idprod=$idas";
		}
		header($url);
	}
	if(isset($_POST['volver'])){
		$url = "error.php";
		if ($mode == "img_pd") {
			$url = "Location: datospruebadiagnostica.php?idepisodio=$other&idpdiag=$idas";
		} elseif ($mode == "img_pro") {
			$url = "Location: datosprocedimiento.php?idepisodio=$other&idprod=$idas";
		}
		header($url);
	}
?>
<head>
	<title>Editar</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
<div id="inicio" class="container">
	<div id="buttons">
		<form action="<?php echo"viewimage.php?mode=$mode&idas=$idas&other=$other&id=$id"?>" method="post">
			<button type="submit" class="btn btn-default" name="eliminar">Eliminar Imagen</button>
			<button type="submit" class="btn btn-default" name="volver">Volver</button>
		</form>
	</div>
			<?php echo "<h4>$name</h4><img src=\"data:image/jpg;base64,$src\" alt=\"Responsive image\" ";?>
	</div>
<?php } ?>
		