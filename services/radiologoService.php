<?php
	include_once"connection.php";
	
	function get_all_radiologo(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM radiologos');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_radiologo($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM radiologos WHERE id_radiologo =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_radiologo($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM radiologos WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_radiologo($nombre){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO radiologos VALUES(NULL,:nombre)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_radiologo($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE radiologos SET nombre = :nombre WHERE id_radiologo = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function delete_radiologo($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM radiologos WHERE id_radiologo = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>