<?php
include "menu.php";
$radiologos = get_all_radiologo();
?>
<head>
	<title>Estadisticas</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
	<div id="inicio" class="container">

		<!-- Barra lateral -->

		<div id="blateral" class="jumbotron col-md-4">
			<h3>Lista de radiologos</h3>
			<ul>
				<li><a href="estadisticasgenerales.php?idradiologo=0">Todos</li>
				<?php
				foreach ($radiologos as $radiologoa) {
					$nombrea = $radiologoa['nombre'];
					$ida = $radiologoa['id_radiologo'];
					echo "<li><a href=\"estadisticasgenerales.php?idradiologo=$ida\">$nombrea</a></li>";
				}
				?>
			</ul>
		</div>

		<!-- Fin Barra -->

		<div class="col-md-1"></div>
		<div class="jumbotron col-md-7">
			<div id="grupo1">
				<h3 id="titulo1"> Datos del radiologo </h3>
				<div class="form-group">
					<label class="form-group"  id="nlabel">Nombre: </label>
				</div>
				<div  class="form-group">
					<label class="form-group"  id="nelabel">Número de episodios atendidos: </label>
				</div>
				
			</div>
</body>