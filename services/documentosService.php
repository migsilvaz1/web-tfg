<?php
	include_once"connection.php";
	
	function get_by_id_documento($id, $mode){
		$query = "";
		if($mode == "img_pd"){
			$query = "SELECT * FROM imagenes_pdiagnostica WHERE id_imagen =:id";
		}elseif($mode == "img_pro" ){
			$query = "SELECT * FROM imagenes_procedimiento WHERE id_imagen =:id";
		}elseif($mode == "doc"){
			$query = "SELECT * FROM documentos_procedimiento WHERE id_doc =:id";
		}else{
			throw new Exception("Error en el modo de documento", 1);
		}
		$con = connect();
		$stmt = $con->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		disconnect($con);
		return $res;
	}
	
	function get_by_id_relacionada($id, $mode){
		$query = "";
		if($mode == "img_pd"){
			$query = "SELECT * FROM imagenes_pdiagnostica WHERE id_pdiagnostica =:id";
		}elseif($mode == "img_pro" ){
			$query = "SELECT * FROM imagenes_procedimiento WHERE id_procedimiento =:id";
		}elseif($mode == "doc"){
			$query = "SELECT * FROM documentos_procedimiento WHERE id_procedimiento =:id";
		}else{
			throw new Exception("Error en el modo de documento", 1);
		}
		$con = connect();
		$stmt = $con->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		disconnect($con);
		return $res;
	}
	
	function create_documento($nombre, $blob, $id_asociada, $mode){
		$query = "";
		if($mode == "img_pd"){
			$query = "INSERT INTO imagenes_pdiagnostica VALUES(NULL,:name,:blob,:id_asociada)";
		}elseif($mode == "img_pro" ){
			$query = "INSERT INTO imagenes_procedimiento VALUES(NULL,:name,:blob,:id_asociada)";
		}elseif($mode == "doc"){
			$query = "INSERT INTO documentos_procedimiento VALUES(NULL,:name,:blob,:id_asociada)";
		}else{
			throw new Exception("Error en el modo de documento", 1);
		}
		$con = connect();
		$stmt = $con->prepare($query);
		$stmt->bindParam(':name', $nombre);
		$stmt->bindParam(':blob', $blob, PDO::PARAM_LOB);
		$stmt->bindParam(':id_asociada', $id_asociada);
		$stmt->execute();
		$lastInsertId = $con->lastInsertId();
		disconnect($con);
		return $lastInsertId;
	}
	
	function update_documento($id, $nombre, $blob, $id_asociada, $mode){
		$query = "";
		if($mode == "img_pd"){
			$query = "UPDATE imagenes_pdiagnostica SET image_name =:name, image =:blob, id_pdiagnostica =:id_asociada WHERE id_imagen =:id)";
		}elseif($mode == "img_pro" ){
			$query = "UPDATE imagenes_procedimiento SET image_name =:name, image =:blob, id_procedimiento =:id_asociada WHERE id_imagen =:id)";
		}elseif($mode == "doc"){
			$query = "UPDATE documentos_procedimiento SET doc_name =:name, doc =:blob, id_procedimiento =:id_asociada WHERE id_imagen =:id)";
		}else{
			throw new Exception("Error en el modo de documento", 1);
		}
		$con = connect();
		$stmt = $con->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $nombre);
		$stmt->bindParam(':blob', $blob);
		$stmt->bindParam(':id_asociada', $id_asociada);
		$stmt->execute();
		disconnect($con);
	}
	
	function delete_documento($id, $mode){
		$query = "";
		if($mode == "img_pd"){
			$query = "DELETE FROM imagenes_pdiagnostica WHERE id_imagen =:id";
		}elseif($mode == "img_pro" ){
			$query = "DELETE FROM imagenes_procedimiento WHERE id_imagen =:id";
		}elseif($mode == "doc"){
			$query = "DELETE FROM documentos_procedimiento WHERE id_doc =:id";
		}else{
			throw new Exception("Error en el modo de documento", 1);
		}
		$con = connect();
		$stmt = $con->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		disconnect($con);
	}
?>