<?php
	include_once"connection.php";
	
	function get_all_diagnostico(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM diagnosticos');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_diagnostico($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM diagnosticos WHERE id_diagnostico =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_diagnostico($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM diagnosticos WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_diagnostico($nombre, $idEpisodio){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO diagnosticos VALUES(NULL,:nombre,:idEpisodio)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':idEpisodio', $idEpisodio);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_diagnostico($id, $nombre, $idEpisodio){
		$con = connect();
		$stmt = $con->prepare('UPDATE diagnosticos SET nombre = :nombre, id_episodio = :idEpisodio WHERE id_diagnostico = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':idEpisodio', $idEpisodio);
		$stmt->execute();
		disconnect($con);
	}
	function delete_diagnostico($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM diagnosticos WHERE id_diagnostico = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>