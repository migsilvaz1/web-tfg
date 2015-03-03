<?php
include "menu.php";

$patologias = get_all_patologia();
if(!isset($_GET['idpatologia'])){
		header("Location: error.php");
	}else{

		$id = $_GET['idpatologia'];
		$patologia = get_by_id_patologia($id);



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
				foreach ($patologias as $patologiaa) {
					$nombrea = $patologiaa['nombre'];
					$ida = $patologiaa['id_patologia'];
					echo "<li><a href=\"estadisticaspatologia.php?idpatologia=$ida\">$nombrea</a></li>";
				}
				?>
			</ul>
		</div>

		<!-- Fin Barra -->

		<div class="col-md-1"></div>
		<div class="jumbotron col-md-7">
			<div id="grupo1">
				<div id="titulo1">
					Datos de la patología
				</div>
				<label id="plabel">Patologia: <?php echo $patologia['nombre']; ?></label>

				<label id="pclabel">Porcentaje que ha presentado complicaciones: <?php echo porcentaje_complicaciones_patologia($id); ?></label>

				<label id="emlabel">Edad media de los pacientes: <?php echo edad_media_pacientes_patologia($id); ?></label>

				<!--<label id="pculabel">Pacientes que se han curado con un procedimiento: </label>-->
				<label id="pslabel">Porcentaje de pacientes por sexo</label>
				<label id="pshlabel">Hombres: <?php echo sexo_patologia($id, H); ?></label><label id="psmlabel">Mujeres:  <?php echo sexo_patologia($id, M); ?></label>
				<label id="pflabel">Numero de pacietes que han fallecido en un periodo de 30 dias: <?php echo mortalidad_temprana_patologia($id); ?></label>

			</div>
			<div id="botones">
				imprimir
			</div>

		</div>
	</div>
</body>
<?php }
?>