<?php
	include_once"connection.php";
	
	function get_all_servicio(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM servicios');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_servicio($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM servicios WHERE id_servicio =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_servicio($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM servicios WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_servicio($nombre){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO servicios VALUES(NULL,:nombre)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_servicio($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE servicios SET nombre = :nombre WHERE id_servicio = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function delete_servicio($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM servicios WHERE id_servicio = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>