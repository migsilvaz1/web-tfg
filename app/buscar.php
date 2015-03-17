<?php
	include "menu.php";
	if(!isset($_POST['text'])){
		header("Location: error.php");
	}else{
		$text = $_POST['text'];
		$p_nh = get_by_name_numeroHistorial($text);
		$p_no = get_by_name_paciente($text);
		if(count($p_nh)==1 and count($p_no)==0){
			$id_paciente = $p_nh[0]['id_paciente'];
			$url = "Location: datospaciente.php?idpaciente=$id_paciente";
			header($url);
		}else if(count($p_nh)==0 and count($p_no)==1){
			$id_paciente = $p_no[0]['id_paciente'];
			$url = "Location: datospaciente.php?idpaciente=$id_paciente";
			header($url);
		}else{
			$merged = array_unique(array_merge($p_nh, $p_no), SORT_REGULAR);
?>
<head>
	<title>Buscar Paciente</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
	<div id="inicio" class="container">
		<div id="ppal" class="jumbotron">
			<h2>Lista de resultados</h2>
				<?php
				if(empty($merged)){
					echo "<h3>No se han encontrado resultados con el criterio \"$text\".</h3>";
				}else{
					?>
			<div class="lista-larga">
			<table class="table lista-larga">
				<tr>
					<th>Nombre</th>
					<th>Numero Historial</th>
					<th>Acceder</th>
				</tr>
				<?php
					foreach ($merged as $paciente) {
						$nombre = $paciente['nombre'];
						$nhistorial = $paciente['numeroHistorial'];
						$id = $paciente['id_paciente'];
						$url = "datospaciente.php?idpaciente=$id";
						echo "<tr><td>$nombre</td><td>$nhistorial</td><td><a href=\"$url\">
						<span class=\"glyphicon glyphicon-open-file\" aria-hidden=\"true\"></span></a></td></tr>";
					}
					echo "</table>";
				}
				?>
			</div>
		</div>
	</div>
</body>

<?php 	} 
	}?>