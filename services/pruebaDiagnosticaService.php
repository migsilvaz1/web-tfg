<?php
	include_once"connection.php";
	
	function get_all_pdiagnostica(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM pruebasdiagnosticas');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_pdiagnostica($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM pruebasdiagnosticas WHERE id_pdiagnostica =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_pdiagnostica($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM pruebasdiagnosticas WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_pdiagnostica($nombre, $idRadiologo){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO pruebasdiagnosticas VALUES(NULL,:nombre,:idRadiologo)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':idRadiologo', $idRadiologo);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_pdiagnostica($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE pruebasdiagnosticas SET nombre = :nombre, id_radiologo = :idRadiologo WHERE id_pdiagnostica = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':idRadiologo', $idRadiologo);
		$stmt->execute();
		disconnect($con);
	}
	function delete_pdiagnostica($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM pruebasdiagnosticas WHERE id_pdiagnostica = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
	function get_all_episodio_from_pdiag($id){
		$con = connect();
		$stmt = $con->prepare('SELECT episodios.id_episodio, nombre, fecha, id_paciente, id_servicio, id_centro, id_patologia FROM 
		relepisodiopdiagnostica INNER JOIN episodios ON relepisodiopdiagnostica.id_episodio = episodios.id_episodio WHERE id_pdiagnostica = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
?>