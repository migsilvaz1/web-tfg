<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="/root/libs/css/bootstrap.css">
	<link rel="stylesheet" href="/root/libs/css/bootstrap-theme.css">
</head>
<body>
	<script src="/root/libs/js/bootstrap.js"></script>
	<script src="/root/libs/js/jquery-1.11.2.min.js"></script>
	<nav id="myNavbar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Inicio</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">Menu<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="/pedido/historialPedidos.php">Historial Documentos</a>
							</li>
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="/facturas/listaFacturasOtraForma.php">Listado de facturas</a>
							</li>
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="/usuario/editarUsuario.php">Modificar datos</a>
							</li>
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="/cerrarSesion.php">Cerrar sesi&oacute;n</a>
							</li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
</body>
</html>