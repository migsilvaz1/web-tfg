<?php
	include"/services/connection.php";
	
	function get_all_material(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM materiales');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_material($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM materiales WHERE id_material =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_material($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM materiales WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_material($nombre){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO materiales VALUES(NULL,:nombre)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function update_material($id, $nombre){
		$con = connect();
		$stmt = $con->prepare('UPDATE materiales SET nombre = :nombre WHERE id_material = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		disconnect($con);
	}
	function delete_material($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM materiales WHERE id_material = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
	function get_all_procedimiento_from_material($id){
		$con = connect();
		$stmt = $con->prepare('SELECT procedimientos.id_procedimiento, id_tipop, id_evolucion FROM relprocedimientomaterial INNER JOIN 
		procedimientos ON relprocedimientomaterial.id_procedimiento = procedimientos.id_procedimiento WHERE id_material = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
?>