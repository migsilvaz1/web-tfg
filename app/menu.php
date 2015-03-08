<?php
	include"../services/servicioService.php";
	include"../services/centroService.php";
	include"../services/materialService.php";
	include"../services/radiologoService.php";
	include"../services/factorService.php";
	include"../services/patologiaService.php";
	include"../services/tipoprocedimientoService.php";
	include"../services/complicacionService.php";
	include"../services/diagnosticoService.php";
	include"../services/episodioService.php";
	include"../services/estadisticasService.php";
	include"../services/evolucionService.php";
	include"../services/pacienteService.php";
	include"../services/procedimientoService.php";
	include"../services/pruebaDiagnosticaService.php";
	include"../services/relacionesService.php";
	include"../services/documentosService.php";
?>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="/root/libs/css/bootstrap.css">
	<link rel="stylesheet" href="/root/libs/css/bootstrap-theme.css">
	<script src="/root/libs/js/jquery-1.11.2.min.js"></script>
	<script src="/root/libs/js/bootstrap.js"></script>
</head>
<body>
	<nav id="myNavbar" class="navbar navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="inicio.php">Inicio</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="crear.php">Crear</a></li>
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">Estad&iacute;sticas<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="estadisticasgeneralesint.php">Generales</a>
							</li>
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="estadisticaspatologiaint.php">Patolog&iacute;as</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">Base de Datos<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="">Importar</a>
							</li>
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="export_db.php">Exportar</a>
							</li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
</body>
</html>