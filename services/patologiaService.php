<?php
	include_once"connection.php";
	
	function get_all_patologia(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM patologias');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_patologia($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM patologias WHERE id_patologia =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_patologia($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM patologias WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_patologia($nombre){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO patologias VALUES(NULL,:nombre)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_patologia($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE patologias SET nombre = :nombre WHERE id_patologia = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function delete_patologia($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM patologias WHERE id_patologia = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>