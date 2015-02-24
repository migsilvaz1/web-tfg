<?php
	include"connection.php";
	
	function get_all_procedimiento(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM procedimientos');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM procedimientos WHERE id_procedimiento =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function create_procedimiento($idTipop, $idEvolucion){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO procedimientos VALUES(NULL,:idTipop, :idEvolucion)');
		$stmt->bindParam(':idTipop', $idTipop);
		$stmt->bindParam(':idEvolucion', $idEvolucion);
		$stmt->execute();
		disconnect($con);
	}
	function update_procedimiento($id, $idTipop, $idEvolucion){
		$con = connect();
		$stmt = $con->prepare('UPDATE procedimientos SET id_tipop = :idTipop, id_evolucion = :idEvolucion WHERE id_procedimiento = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':idTipop', $idTipop);
		$stmt->bindParam(':idEvolucion', $idEvolucion);
		$stmt->execute();
		disconnect($con);
	}
	function delete_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM procedimientos WHERE id_procedimiento = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
	function get_all_complicacion_from_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('SELECT complicaciones.id_complicacion, nombre, mortalidadTemprana, mortalidadTardia FROM relcomplicacionprocedimiento
		 INNER JOIN complicaciones ON relcomplicacionprocedimiento.id_complicacion = complicaciones.id_complicacion WHERE id_procedimiento = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function get_all_episodio_from_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('SELECT episodios.id_episodio, nombre, fecha, id_paciente, id_servicio, id_centro, id_patologia FROM 
		relepisodioprocedimiento INNER JOIN episodios on relepisodioprocedimiento.id_episodio = episodios.id_episodio WHERE id_procedimiento = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function get_all_material_from_procedimiento($id){
		$con = connect();
		$stmt = $con->prepare('SELECT materiales.id_material, nombre FROM relprocedimientomaterial INNER JOIN materiales ON 
		relprocedimientomaterial.id_material = materiales.id_material WHERE id_procedimiento = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
?>