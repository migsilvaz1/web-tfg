<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="/root/libs/css/bootstrap.css">
	<link rel="stylesheet" href="/root/libs/css/bootstrap-theme.css">
	<script src="/root/libs/js/jquery-1.11.2.min.js"></script>
	<script src="/root/libs/js/bootstrap.js"></script>
</head>
<body>
	<form action="inicio" method="post">
		  <div class="form-group">
	Datos del paciente <br>
	Numero de historial <input type="text" class="form-control" name="nhistorial" maxlength="100"> 
 	<br> 
 	Nombre <input type="text" name="nombrepaciente" maxlength="100"> 
 	<br>
 	Fecha nacimiento<input type="text" name="fechanacimiento" maxlength="100"> 
 	<br> 
 	Datos del Episodio <br>
 	Nombre <input type="text" name="nombreepisodio" maxlength="100"> 
 	<br> 
 	Fecha <input type="text" name="fechaepisodio" maxlength="100"> 
 	<br> 
 	Servicio <select name="servicio">
 		
 			</select> 
 	<br> 
 	Patologia <select name="patologia">
 		
 			</select>
 	<br> 
 	Datos del Procedimiento <br>
 	Tipo <select name="tipo">
 		
 			</select>
 	<br>  
 	<input type="submit" value="Enviar formulario"> 
	 <br>
	 	</div>
	</form>
</body>