<?php
	include"connection.php";
	
	function create_procedimiento_material($id_procedimiento, $id_material){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO relprocedimientomaterial VALUES(:id_procedimiento,:id_material)');
		$stmt->bindParam(':id_procedimiento', $id_procedimiento);
		$stmt->bindParam(':id_material', $id_material);
		$stmt->execute();
		disconnect($con);
	}
	
	function delete_procedimiento_mataterial($id_procedimiento, $id_material){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM relprocedimientomaterial WHERE id_procedimiento = :id_procedimiento AND id_material = :id_material');
		$stmt->bindParam(':id_procedimiento', $id_procedimiento);
		$stmt->bindParam(':id_material', $id_material);
		$stmt->execute();
		disconnect($con);
	}
	
	function create_episodio_procedimiento($id_episodio, $id_procedimiento){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO relepisodioprocedimiento VALUES(:id_episodio,:id_procedimiento)');
		$stmt->bindParam(':id_episodio', $id_episodio);
		$stmt->bindParam(':id_procedimiento', $id_procedimiento);
		$stmt->execute();
		disconnect($con);
	}
	
	function delete_episodio_procedimiento($id_episodio, $id_procedimiento){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM relepisodioprocedimiento WHERE id_episodio = :id_episodio AND id_procedimiento = :id_procedimiento');
		$stmt->bindParam(':id_episodio', $id_episodio);
		$stmt->bindParam(':id_procedimiento', $id_procedimiento);
		$stmt->execute();
		disconnect($con);
	}
	
	function create_complicacion_procedimiento($id_procedimiento, $id_complicacion){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO relcomplicacionprocedimiento VALUES(:id_procedimiento,:id_complicacion)');
		$stmt->bindParam(':id_procedimiento', $id_procedimiento);
		$stmt->bindParam(':id_complicacion', $id_complicacion);
		$stmt->execute();
		disconnect($con);
	}
	
	function delete_complicacion_procedimiento($id_procedimiento, $id_complicacion){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM relcomplicacionprocedimiento WHERE id_procedimiento = :id_procedimiento AND id_complicacion = :id_complicacion');
		$stmt->bindParam(':id_procedimiento', $id_procedimiento);
		$stmt->bindParam(':id_complicacion', $id_complicacion);
		$stmt->execute();
		disconnect($con);
	}
	
	function create_episodio_pdiagnostica($id_episodio, $id_pdiagnostica){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO relepisodiopdiagnostica VALUES(:id_episodio,:id_pdiagnostica)');
		$stmt->bindParam(':id_episodio', $id_episodio);
		$stmt->bindParam(':id_pdiagnostica', $id_pdiagnostica);
		$stmt->execute();
		disconnect($con);
	}
	
	function delete_episodio_pdiagnostica($id_episodio, $id_pdiagnostica){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM relepisodiopdiagnostica WHERE id_episodio = :id_episodio AND id_pdiagnostica = :id_pdiagnostica');
		$stmt->bindParam(':id_episodio', $id_episodio);
		$stmt->bindParam(':id_pdiagnostica', $id_pdiagnostica);
		$stmt->execute();
		disconnect($con);
	}

	function create_paciente_factor($id_paciente, $id_factor){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO relpacientefactor VALUES(:id_paciente,:id_factor)');
		$stmt->bindParam(':id_paciente', $id_paciente);
		$stmt->bindParam(':id_factor', $id_factor);
		$stmt->execute();
		disconnect($con);
	}
	
	function delete_paciente_factor($id_paciente, $id_factor){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM relpacientefactor WHERE id_paciente = :id_paciente AND id_factor = :id_factor');
		$stmt->bindParam(':id_paciente', $id_paciente);
		$stmt->bindParam(':id_factor', $id_factor);
		$stmt->execute();
		disconnect($con);
	}
?>