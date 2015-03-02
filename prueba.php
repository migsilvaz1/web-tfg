<?php
	include '/services/pacienteService.php';
	$id = create_paciente("numeroHistorial", "nombre", '1987-1-1', null, null, null, null);
	echo $id;
?>
