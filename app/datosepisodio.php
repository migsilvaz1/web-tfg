<?php
	include"menu.php";
	if(!isset($_GET['idepisodio'])){
		header("Location: error.php");
	}else{
		
		$pacietnes = get_all_paciente();
		$services = get_all_servicio();
		$patologias = get_all_patologia();
		$procedimientos = get_all_procedimiento();
		$centros = get_all_centro();

?>
<head>
	<title>Datos del episodio</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
	<div id="inicio" class="container">
		<!-- Barra lateral -->
		<div id="blateral" class="jumbotron col-md-4">
			<h3>Lista de pacientes</h3>
			<ul>
				<?php 
					foreach ($pacietnes as $paciente) {
						$nombre = $paciente['nombre'];
						$id = $paciente['id_paciente'];
						echo "<li><a href=\"datospaciente.php?idpaciente=$id\">$nombre</a></li>";
					}
					?>
			</ul>
		</div>
		<!-- Fin Barra -->
		<div class="col-md-1"></div>
		<div id="formulario" class="jumbotron col-md-7">
			<form action="inicio.php" method="post">
				<div id="grupo1">
					<div id="titulo1">
						Datos del Episodio
					</div>
					<label id="nlabel" for="nombreepisodio">Nombre</label>
					<input type="text" id="nombreepisodio" name="nombreepisodio">
					<label id="flabel" for="fechaepisodio">Fecha</label>
					<input type="text" id="fechaepisodio" name="fechaepisodio">
					<label id="slabel" for="servicio">Servicio</label>
					<select id="servicio">
						<?php
							foreach ($services as $value) {
								echo "<option value=\"".$value["id_servicio"]."\">".$value[nombre]."</option>";
							}
						?>
					</select>
					<label id="plabel" for="patologia">Patologia</label>
					<select id="patologia">
						<?php
							foreach ($patologias as $value) {
								echo "<option value=\"".$value["id_patologia"]."\">".$value[nombre]."</option>";
							}
						?>

					</select>
					<label id="clabel" for="centro">Centro</label>
					<select id="centro">
						<?php
							foreach ($centros as $value) {
								echo "<option value=\"".$value["id_centro"]."\">".$value[nombre]."</option>";
							}
						?>
					</select>
					<label id="dlabel" for="diagnostico">Diagnostico</label>
					<input type="text" id="diagnostico" name="diagnostico">
					
					
				</div>
				
				
				<div id="grupo2">
					<div id="titulo2">
						Pruebas diagnosticas
					</div>
					<ol>
						<li>
							Prueba
						</li>
					</ol>
					<div id="botonesfc">
						<input type="submit" value="Anadir">
				</div>
				
				<div id="grupo3">
					<div id="titulo3">
						Procedimientos
					</div>
					<ol>
						<li>
							Prueba
						</li>
					</ol>
					<div id="botonesfc">
						<input type="submit" value="Anadir">
				</div>
				
				<div id="botones">
					<input type="submit" value="Enviar formulario">
				</div>
				
				
			</form>
		</div>
	</div>
</body>
<?php
	}
?>