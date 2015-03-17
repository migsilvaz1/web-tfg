<?php
	include_once"connection.php";
	
	function porcentaje_complicaciones_patologia($id_patologia){
		$con = connect();
		$stmt = $con->prepare('SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia 
             INNER JOIN relepisodioprocedimiento on episodios.id_episodio = relepisodioprocedimiento.id_episodio 
             INNER JOIN procedimientos ON relepisodioprocedimiento.id_procedimiento = procedimientos.id_procedimiento 
             WHERE patologias.id_patologia = :id');
		$stmt->bindParam(':id', $id_patologia);
		$stmt->execute();
		$total_procedimientos = $stmt->fetch();
		$stmt = $con->prepare('SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia 
             INNER JOIN relepisodioprocedimiento on episodios.id_episodio = relepisodioprocedimiento.id_episodio 
             INNER JOIN procedimientos ON relepisodioprocedimiento.id_procedimiento = procedimientos.id_procedimiento 
             INNER JOIN relcomplicacionprocedimiento ON procedimientos.id_procedimiento = 
             relcomplicacionprocedimiento.id_procedimiento WHERE patologias.id_patologia = :id');
		$stmt->bindParam(':id', $id_patologia);
		$stmt->execute();
		$complicaciones_procedimientos = $stmt->fetch();
		disconnect($con);
		if($total_procedimientos[0] == 0){
			return 0;
		}else{
			return ($complicaciones_procedimientos[0] * 1.0)/($total_procedimientos[0] * 1.0)*100;
		}
	}
	function pacientes_factores_patologia($id_patologia){
		$con = connect();
		$stmt = $con->prepare('SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia 
             INNER JOIN pacientes ON episodios.id_paciente = pacientes.id_paciente WHERE 
             patologias.id_patologia = :id');
		$stmt->bindParam(':id', $id_patologia);
		$stmt->execute();
		$total_pacientes = $stmt->fetch();
		$stmt = $con->prepare('SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia 
             INNER JOIN pacientes ON episodios.id_paciente = pacientes.id_paciente INNER JOIN 
             relpacientefactor ON pacientes.id_paciente = relpacientefactor.id_paciente WHERE 
             patologias.id_patologia = :id');
		$stmt->bindParam(':id', $id_patologia);
		$stmt->execute();
		$pacientes_riesgo = $stmt->fetch();
		disconnect($con);
		if($total_pacientes[0]==0){
			return 0;
		}else{
			return ($pacientes_riesgo[0] * 1.0)/($total_pacientes[0] * 1.0)*100;
		}
	}
	function edad_media_pacientes_patologia($id_patologia){
		$con = connect();
		$stmt = $con->prepare('SELECT AVG(episodios.edadConsulta) FROM episodios WHERE episodios.id_patologia = :id');
		$stmt->bindParam(':id', $id_patologia);
		$stmt->execute();
		$media = $stmt->fetch();
		disconnect($con);
		return $media[0];
	}
	function sexo_patologia($id_patologia, $sexo){
		$con = connect();
		$stmt = $con->prepare('SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia 
             INNER JOIN pacientes ON episodios.id_paciente = pacientes.id_paciente WHERE 
             patologias.id_patologia = :id');
		$stmt->bindParam(':id', $id_patologia);
		$stmt->execute();
		$total_pacientes = $stmt->fetch();
		$stmt = $con->prepare('SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia 
             INNER JOIN pacientes ON episodios.id_paciente = pacientes.id_paciente WHERE 
             patologias.id_patologia = :id AND pacientes.sexo = :sexo');
		$stmt->bindParam(':id', $id_patologia);
		$stmt->bindParam(':sexo', $sexo);
		$stmt->execute();
		$pacientes_sexo = $stmt->fetch();
		disconnect($con);
		if($total_pacientes[0]==0){
			return 0;
		}else{
			return ($pacientes_sexo[0] * 1.0)/($total_pacientes[0] * 1.0)*100;
		}
	}
	function mortalidad_temprana_patologia($id_patologia){
		$con = connect();
		$stmt = $con->prepare('SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia 
             INNER JOIN relepisodioprocedimiento on episodios.id_episodio = relepisodioprocedimiento.id_episodio 
             INNER JOIN procedimientos ON relepisodioprocedimiento.id_procedimiento = procedimientos.id_procedimiento 
             INNER JOIN relcomplicacionprocedimiento ON procedimientos.id_procedimiento = 
             relcomplicacionprocedimiento.id_procedimiento INNER JOIN complicaciones ON 
             relcomplicacionprocedimiento.id_complicacion = complicaciones.id_complicacion WHERE 
             complicaciones.mortalidadTemprana = \'S\' AND patologias.id_patologia = :id');
		$stmt->bindParam(':id', $id_patologia);
		$stmt->execute();
		$res = $stmt->fetch();
		disconnect($con);
		return $res[0];
	}
	function curacion_patologia_procedimiento($id_patologia, $id_procedimiento){
		$con = connect();
		$stmt = $con->prepare('SELECT count(*) FROM patologias INNER JOIN episodios ON patologias.id_patologia = episodios.id_patologia 
             INNER JOIN relepisodioprocedimiento on episodios.id_episodio = relepisodioprocedimiento.id_episodio 
             INNER JOIN procedimientos ON relepisodioprocedimiento.id_procedimiento = procedimientos.id_procedimiento 
             INNER JOIN relcomplicacionprocedimiento ON procedimientos.id_procedimiento = 
             relcomplicacionprocedimiento.id_procedimiento INNER JOIN complicaciones ON 
             relcomplicacionprocedimiento.id_complicacion = complicaciones.id_complicacion WHERE 
             complicaciones.mortalidadTemprana = \'N\' AND complicaciones.mortalidadTardia = \'N\' AND 
             patologias.id_patologia = :id_patologia AND procedimientos.id_procedimiento = :id_procedimiento');
		$stmt->bindParam(':id_patologia', $id_patologia);
		$stmt->bindParam(':id_procedimiento', $id_procedimiento);
		$stmt->execute();
		$res = $stmt->fetch();
		disconnect($con);
		return $res[0];
	}
?>