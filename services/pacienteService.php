<?php
	include_once"connection.php";
	
	function get_all_paciente(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM pacientes');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_paciente($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM pacientes WHERE id_paciente =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_paciente($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM pacientes WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function get_by_name_numeroHistorial($nHistorial){
		$nHistorial = "%".$nHistorial."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM pacientes WHERE numeroHistorial LIKE :nHistorial');
		$stmt->bindParam(':nHistorial', $nHistorial);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_paciente($numeroHistorial, $nombre, $fechaNacimiento, $sexo, $enfermedadesConocidas){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO pacientes VALUES(NULL,:numeroHistorial,:nombre,:fechaNacimiento,:sexo,:enfermedadesConocidas)');
		$stmt->bindParam(':numeroHistorial', $numeroHistorial);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
		$stmt->bindParam(':sexo', $sexo);
		$stmt->bindParam(':enfermedadesConocidas', $enfermedadesConocidas);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_paciente($id, $numeroHistorial, $nombre, $fechaNacimiento, $sexo, $enfermedadesConocidas){
		$con = connect();
		$stmt = $con->prepare('UPDATE pacientes SET numeroHistorial = :numeroHistorial, nombre = :nombre, fechaNacimiento = :fechaNacimiento,
		sexo = :sexo, enfermedadesConocidas = :enfermedadesConocidas WHERE id_paciente = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':numeroHistorial', $numeroHistorial);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
		$stmt->bindParam(':sexo', $sexo);
		$stmt->bindParam(':enfermedadesConocidas', $enfermedadesConocidas);
		$stmt->execute();
		disconnect($con);
	}
	function delete_paciente($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM pacientes WHERE id_paciente = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
	function get_all_factor_from_paciente($id){
		$con = connect();
		$stmt = $con->prepare('SELECT factoresderiesgo.id_factor, nombre FROM relpacientefactor INNER JOIN factoresderiesgo ON relpacientefactor.id_factor = factoresderiesgo.id_factor WHERE id_paciente = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function get_all_episodio_from_paciente($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM episodios  WHERE id_paciente = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
?>