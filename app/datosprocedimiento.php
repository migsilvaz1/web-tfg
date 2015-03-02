<?php
	include"menu.php";
	include"../services/tipoprocedimientoService.php";

	$tipos = get_all_tipo_procedimiento();


?>
<head>
	<title>Datos Procedimiento</title>
</head>
<body>
	<div id="inicio" class="container">
		<div id="formulario" class="jumbotron">
			<form action="inicio.php" method="post">
				<div id="grupo1">
					<div id="titulo1">
						Datos procedimiento
					</div>
					<label id="tlabel" for="tipoprocedimiento">Tipo procedimiento</label>
					<select id="tipoprocedimiento">
						<?php
							foreach ($tipos as $value) {
								echo "<option value=\"".$value["id_tipop"]."\">".$value[nombre]."</option>";
							}
						?>
					</select>
					<label id="rlabel" for="resultado" >Resultado</label>
					<input type="text" id="resultado" name="resultado">
					
					<label id="nlabel" for="notas" >Notas</label>
					<input type="text" id="notas" name="notas">


				</div>
				
				
									<div id="grupo2">
					<div id="titulo2">
						Material
					</div>
					<ol>
						<li>
							Prueba
						</li>
					</ol>
					<div id="botonesmaterial">
					<input type="submit" value="Eliminar">
					<input type="submit" value="Añadir">
									</div>

					
					
										<div id="grupo3">
					<div id="titulo3">
						Complicaciones
					</div>
					<ol>
						<li>
							Prueba
						</li>
					</ol>
					<div id="botonescomplicaiones">
					<input type="submit" value="Eliminar">
					<input type="submit" value="Añadir">
								</div>

				
								<div id="grupo4">
					<div id="titulo4">
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