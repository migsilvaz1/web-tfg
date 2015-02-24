<?php
	include"menu.php";
?>
<head>
	<title>Inicio</title>
</head>
<body>
	<div id="inicio" class="container">
		<div id="formulario" class="jumbotron">
			<form action="inicio.php" method="post">
				<div id="grupo1">
					<div id="titulo1">
						Datos del paciente
					</div>
					<label id="nhlabel" for="nhistorial">Numero de historial</label>
					<input type="text" id="nhistorial" >
					<label id="nplabel" for="nombrepaciente">Nombre</label>
					<input type="text" id="nombrepaciente">
					<label id="fnlabel" for="fechanacimiento">Fecha Nacimiento</label>
					<input type="text" id="fechanacimiento" maxlength="100">
				</div>
				<div id="grupo2">
					<div id="titulo2">
						Datos del Episodio
					</div>
					<label id="nlabel" for="nombreepisodio">Nombre</label>
					<input type="text" id="nombreepisodio">
					<label id="nlabel" for="nombreepisodio">Fecha</label>
					<input type="text" id="fechaepisodio">
					<label id="slabel" for="servicio">Servicio</label>
					<select id="servicio"></select>
					<label id="plabel" for="patologia">Patologia</label>
					<select id="patologia"></select>
				</div>
				<div id="grupo3">
					<div id="titulo3">
						Datos del Procedimiento
					</div>
					<label id="tlabel" for="tipo">Tipo</label>
					<select id="tipo"></select>
				</div>
				<div id="botones">
					<input type="submit" value="Enviar formulario">
				</div>
			</form>
		</div>
	</div>
</body>