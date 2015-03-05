<?php
	include_once"connection.php";
	
	function get_all_episodio(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM episodios');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_episodio($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM episodios WHERE id_episodio =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_episodio($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM episodios WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_episodio($nombre, $fecha, $idPaciente, $idServicio, $idCentro, $idPatologia){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO episodios VALUES(NULL,:nombre,:fecha,:idPaciente,:idServicio,:idCentro,:idPatologia)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':fecha', $fecha);
		$stmt->bindParam(':idPaciente', $idPaciente);
		$stmt->bindParam(':idServicio', $idServicio);
		$stmt->bindParam(':idCentro', $idCentro);
		$stmt->bindParam(':idPatologia', $idPatologia);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_episodio($id, $nombre, $fecha, $idPaciente, $idServicio, $idCentro, $idPatologia){
		$con = connect();
		$stmt = $con->prepare('UPDATE episodios SET nombre = :nombre, fecha= :fecha, id_paciente = :idPaciente, 
		id_servicio = :idServicio, id_centro = :idCentro, id_patologia = :idPatologia WHERE id_episodio = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':fecha', $fecha);
		$stmt->bindParam(':idPaciente', $idPaciente);
		$stmt->bindParam(':idServicio', $idServicio);
		$stmt->bindParam(':idCentro', $idCentro);
		$stmt->bindParam(':idPatologia', $idPatologia);
		$stmt->execute();
		disconnect($con);
	}
	function delete_episodio($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM episodios WHERE id_episodio = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
	function get_all_pdiag_from_episodio($id){
		$con = connect();
		$stmt = $con->prepare('SELECT pruebasdiagnosticas.id_pdiagnostica, nombre, id_radiologo FROM relepisodiopdiagnostica INNER JOIN 
		pruebasdiagnosticas ON relepisodiopdiagnostica.id_pdiagnostica = pruebasdiagnosticas.id_pdiagnostica WHERE id_episodio = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function get_all_procedimiento_from_episodio($id){
		$con = connect();
		$stmt = $con->prepare('SELECT procedimientos.id_procedimiento, id_tipop, id_evolucion FROM relepisodioprocedimiento INNER JOIN procedimientos 
		ON relepisodioprocedimiento.id_procedimiento = procedimientos.id_procedimiento WHERE relepisodioprocedimiento.id_episodio = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function get_all_diagnostico_from_episodio($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM diagnosticos WHERE id_episodio = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
?>