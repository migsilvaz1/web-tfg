<?php
	function connect(){
		$host="mysql:host=localhost:3306;dbname=radiologia";
		$user_name  = "radio-user";
		$password   = "radio";
		$options = array(
    		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);
		$con=null;
		try{
			$con = new PDO( $host, $user_name, $password,$options);
			//Indicamos que queremos que lance las excepciones cuando ocurra un error
			$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			//echo"Error de conexión con la base de datos.";
			 echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
		return $con;
		
	}
	
	function disconnect($cnx){
		$con = null;
	}
?>