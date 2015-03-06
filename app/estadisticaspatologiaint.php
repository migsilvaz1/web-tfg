<?php
include "menu.php";
$patologias = get_all_patologia();
?>
<head>
	<title>Inicio</title>
</head>
<body>
	<div id="inicio" class="container" style="margin-top: 60px;">

		<!-- Barra lateral -->

		<div id="blateral" class="jumbotron col-md-4">
			<h3>Lista de patologias</h3>
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
				<h3 id="titulo1"> Datos de la patología </h3>
				<div class="form-group">
					<label class="form-group"  id="plabel">Patologia: </label>
				</div>
				<div  class="form-group">
					<label class="form-group"  id="pclabel">Porcentaje que ha presentado complicaciones: </label>
				</div>
				<div class="form-group">
					<label class="form-group"  id="emlabel">Edad media de los pacientes: </label>
				</div>
				<div class="form-group">
					<!--<label id="pculabel">Pacientes que se han curado con un procedimiento: </label>-->
						<label  id="pslabel">Porcentaje de pacientes por sexo</label>
						<label id="pshlabel">Hombres: </label><label id="psmlabel">Mujeres: </label>
					</div>
					<div class="form-group">
						<label class="form-group"  id="pflabel">Numero de pacietes que han fallecido en un periodo de 30 dias: </label>
					</div>
				</div>
			</div>
</body>