<?php
	include"/services/connection.php";
	
	function get_all_evolucion(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM evolucions');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_evolucion($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM evoluciones WHERE id_evolucion =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function create_evolucion($resultado, $notas){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO evoluciones VALUES(NULL,:resultado,:notas)');
		$stmt->bindParam(':resultado', $resultado);
		$stmt->bindParam(':notas', $notas);
		$stmt->execute();
		disconnect($con);
	}
	function update_evolucion($id, $resultado, $notas){
		$con = connect();
		$stmt = $con->prepare('UPDATE evoluciones SET resultado = :resultado, notas = :notas WHERE id_evolucion = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':resultado', $resultado);
		$stmt->bindParam(':notas', $notas);
		$stmt->execute();
		disconnect($con);
	}
	function delete_evolucion($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM evoluciones WHERE id_evolucion = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>