<?php
	include"connection.php";
	
	function get_all_tipo_procedimiento(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM tipo_procedimientos');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_tipo_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM tipo_procedimientos WHERE id_tipop =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_tipo_procedimiento($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM tipo_procedimientos WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_tipo_procedimiento($nombre){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO tipo_procedimientos VALUES(NULL,:nombre)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function update_tipo_procedimiento($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE tipo_procedimientos SET nombre = :nombre WHERE id_tipop = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function delete_tipo_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM tipo_procedimientos WHERE id_tipop = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>