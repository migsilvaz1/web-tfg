<?php
	include_once"connection.php";
	
	function get_all_complicacion(){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM complicaciones');
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_id_complicacion($id){
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM complicaciones WHERE id_complicacion =:id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	
	function get_by_name_complicacion($nombre){
		$nombre = "%".$nombre."%";
		$con = connect();
		$stmt = $con->prepare('SELECT * FROM complicaciones WHERE nombre LIKE :nombre');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
	function create_complicacion($nombre, $mtemprana, $mtardia){
		$con = connect();
		$stmt = $con->prepare('INSERT INTO complicaciones VALUES(NULL,:nombre,:mtemprana,:mtardia)');
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':mtemprana', $mtemprana);
		$stmt->bindParam(':mtardia', $mtardia);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	function update_complicacion($id, $nombre, $mtemprana, $mtardia){
		$con = connect();
		$stmt = $con->prepare('UPDATE complicaciones SET nombre = :nombre, mortalidadTemprana = :mtemprana, mortalidadTardia = :mtardia WHERE id_centro = :id');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':mtemprana', $mtemprana);
		$stmt->bindParam(':mtardia', $mtardia);
		$stmt->execute();
		disconnect($con);
	}
	function delete_complicacion($id){
		$con = connect();
		$stmt = $con->prepare('DELETE FROM complicaciones WHERE id_centro = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
	function get_all_procedimiento_from_complicacion($id){
		$con = connect();
		$stmt = $con->prepare('SELECT procedimientos.id_procedimiento, id_tipop, id_evolucion FROM relcomplicacionprocedimiento INNER JOIN 
		procedimientos ON relcomplicacionprocedimiento.id_procedimiento = procedimientos.id_procedimiento WHERE id_complicacion = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		disconnect($con);
	}
?>