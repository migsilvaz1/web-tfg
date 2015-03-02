<?php
	include_once"connection.php";
	
	function get_all_factor(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM factoresderiesgo');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_factor($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM factoresderiesgo WHERE id_factor =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_factor($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM factoresderiesgo WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_factor($nombre){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO factoresderiesgo VALUES(NULL,:nombre)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_factor($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE factoresderiesgo SET nombre = :nombre WHERE id_factor = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function delete_factor($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM factoresderiesgo WHERE id_factor = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
	function get_all_paciente_from_factor($id){
		$con = connect();
		$stmt = $con->prepare('SELECT pacientes.id_paciente, numeroHistorial, nombre, fechaNacimiento, sexo, enfermedadesConocidas, edad, 
		edadConsulta FROM relpacientefactor INNER JOIN pacientes ON relpacientefactor.id_paciente = pacientes.id_paciente WHERE id_factor = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
?>