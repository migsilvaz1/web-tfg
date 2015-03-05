<?php
	include '/services/pacienteService.php';
	$fecha_str = "13/11/1987";
// 	guardar
	$mysqltime = date_format(date_create_from_format("d/m/Y", $fecha_str), "Y-m-d");
// 	sacar
	$paciente = get_by_id_paciente(6);
	echo date("d/m/Y", strtotime($paciente['fechaNacimiento']));
?>
