<?php
include "menu.php";
?>
<head>
	<title>Datos Paciente</title>
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
					<input type="text" id="nhistorial" name="nhistorial">
					<label id="nplabel" for="nombrepaciente" >Nombre</label>
					<input type="text" id="nombrepaciente" name="nombrepaciente">
					<label id="fnlabel" for="fechanacimiento">Fecha nacimiento</label>
					<input type="text" id="fechanacimiento" name="fechanacimiento">
					<label id="sexlabel" for="sexo">Sexo</label>
					<input type="radio" id="sexo" name="sexo" value="Varon" checked>
					Hombre
					<input type="radio" id="sexo" name="sexo" value="Hembra">
					Mujer <label id="eclabel" for="enfermedadesconocidas">Enfermedades conocidas</label>
					<textarea id="enfermedadesconocidas" name="enfermedadesconocidas"></textarea>					
					
					

					<div id="botonesdp">
						<input type="submit" value="Guardar">

					</div>
				</div>

				<div id="grupo2">
					<div id="titulo2">
						Factores de riesgo
					</div>
					<!--<label id="frlabel" for="tipo">Factores de riesgo</label>-->
					<ol>
						<li>
							Prueba
						</li>
					</ol>
					<div id="botonesfc">
						<input type="submit" value="Elimiar">
						<input type="submit" value="Anadir">
					</div>
				</div>

				<div id="grupo3">
					<div id="titulo3">
						Episodios
					</div>
					<!--<label id="tlabel" for="tipo">Episodios</label>-->
					<ol>
						<li>
							Prueba
						</li>
					</ol>
				</div>
				<div id="botonesinicio">
					<input type="submit" value="Inicio">
				</div>

			</form>
		</div>
	</div>
</body>