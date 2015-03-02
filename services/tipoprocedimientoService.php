<?php
	include_once"connection.php";
	
	function get_all_tipo_procedimiento(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM tipo_procedimiento');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_tipo_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM tipo_procedimiento WHERE id_tipop =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_tipo_procedimiento($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM tipo_procedimiento WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_tipo_procedimiento($nombre){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO tipo_procedimiento VALUES(NULL,:nombre)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_tipo_procedimiento($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE tipo_procedimiento SET nombre = :nombre WHERE id_tipop = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function delete_tipo_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM tipo_procedimiento WHERE id_tipop = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>