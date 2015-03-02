<?php
	include_once"connection.php";
	
	function get_all_centro(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM centros');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_centro($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM centros WHERE id_centro =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_centro($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM centros WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_centro($nombre){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO centros VALUES(NULL,:nombre)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_centro($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE centros SET nombre = :nombre WHERE id_centro = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function delete_centro($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM centros WHERE id_centro = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>