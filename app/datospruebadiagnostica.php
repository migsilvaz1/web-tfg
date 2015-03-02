<?php
	include"menu.php";
	include"../services/radiologoService.php";

	$radiologos = get_all_radiologo();


?>
<head>
	<title>Datos prueba diagnóstica</title>
</head>
<body>
	<div id="inicio" class="container">
		<div id="formulario" class="jumbotron">
			<form action="inicio.php" method="post">
				<div id="grupo1">
					<div id="titulo1">
						Datos prueba diagnostica
					</div>
					<label id="nplabel" for="nombreprueba" >Nombre</label>
					<input type="text" id="nombreprueba" name="nombreprueba">


					<label id="rlabel" for="radiologo">Radiologo</label>
					<select id="radiologo">
						<?php
							foreach ($radiologos as $value) {
								echo "<option value=\"".$value["id_radiologo"]."\">".$value[nombre]."</option>";
							}
						?>
					</select>

				</div>
				
								<div id="grupo2">
					<div id="titulo2">
						Imagenes
					</div>
					<ol>
						<li>
							Prueba
						</li>
					</ol>
					<div id="botonesimg">
											<input type="submit" value="Eliminar imagen">
					<input type="submit" value="Añadir imagen">
					<input type="submit" value="Editar imagen">
				</div>
				<div id="botones">

					<input type="submit" value="Guardar">
					<input type="submit" value="Inicio">
				</div>
				
				
			</form>
		</div>
	</div>
</body>