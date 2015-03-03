<?php
	include 'menu.php';
	$pacietnes = get_all_paciente();
	
	$DB_USER = "radio-user";
	$DB_PASS = "radio";
	$DB_NAME = "radiologia";
	$command = "\"C:\\Program Files\\MySQL\\MySQL Server 5.6\\bin\\mysqldump.exe\" --opt --skip-extended-insert --complete-insert --user=".$DB_USER.
	" --password=".$DB_PASS." ".$DB_NAME." > C:\\xampp\\htdocs\\root\\docs\\radiologia.sql";
	exec($command, $ret_arr, $ret_code);
?>
<head>
	<title>Exportar</title>
	<LINK REL=StyleSheet HREF="export_db.css" TYPE="text/css" MEDIA=screen>
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
			<div>
				Se ha generado automaticamente el bolcado de la base de datos. Puede obtener el archivo en el siguiente enlace: <a href="/root/docs/radiologia.sql" download>Archivo</a>
			</div>
		</div>
	</div>
</body>
