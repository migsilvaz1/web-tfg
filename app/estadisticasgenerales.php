<?php
include "menu.php";
$radiologos = get_all_radiologo();
include ('fpdf/fpdf.php');
if(!isset($_GET['idradiologo'])){
		header("Location: error.php");
	}else if ($_GET['idradiologo']==0) {
			$id = 0;

?>
<head>
	<title>Estadisticas</title>
</head>
<body>
	<div id="inicio" class="container" style="margin-top: 60px;">

		<!-- Barra lateral -->

		<div id="blateral" class="jumbotron col-md-4">
			<h3>Lista de radiologos</h3>
			<ul>
				<li>
					<a href="estadisticasgenerales.php?idradiologo=0">Todos
				</li>
				<?php
				foreach ($radiologos as $radiologoa) {
					$nombrea = $radiologoa['nombre'];
					$ida = $radiologoa['id_radiologo'];
					echo "<li><a href=\"estadisticasgenerales.php?idradiologo=$ida\">$nombrea</a></li>";
				}
				?>
			</ul>
		</div>

		<!-- Fin Barra -->

		<div class="col-md-1"></div>
		<div class="jumbotron col-md-7">
			<form name='pdf' method='post' action='estadisticasgenerales.php?idradiologo=<?php echo $id; ?>'>
				<div id="grupo1">
					<h3 id="titulo1"> Datos del radiólgo</h3>
					<div class="form-group">
						<label class="form-group"  id="nlabel">Nombre: </label>
					</div>
					<div  class="form-group">
						<label class="form-group"  id="nelabel">Numero de episodios atendidos: </label>
					</div>

				</div>
				<div id="botones" class="pull-right">
					<input id="imprimir" name="imprimir" type="submit" class="btn btn-default" value="Imprimir">
				</div>
</body>
<?php
}else{
$id = $_GET['idradiologo'];
$radiologo = get_by_id_radiologo($id);
?>

<head>
	<title>Estadisticas</title>
</head>
<body>
	<div id="inicio" class="container" style="margin-top: 60px;">

		<!-- Barra lateral -->

		<div id="blateral" class="jumbotron col-md-4">
			<h3>Lista de radiologos</h3>
			<ul>
				<li>
					<a href="estadisticasgenerales.php?idradiologo=0">Todos
				</li>
				<?php
				foreach ($radiologos as $radiologoa) {
					$nombrea = $radiologoa['nombre'];
					$ida = $radiologoa['id_radiologo'];
					echo "<li><a href=\"estadisticasgenerales.php?idradiologo=$ida\">$nombrea</a></li>";
				}
				?>
			</ul>
		</div>

		<!-- Fin Barra -->

		<div class="col-md-1"></div>
		<div class="jumbotron col-md-7">
			<form name='pdf' method='post' action='estadisticasgenerales.php?idradiologo=<?php echo $id; ?>'>
				<div id="grupo1">
					<h3 id="titulo1"> Datos del radiólgo</h3>
					<div class="form-group">
						<label class="form-group"  id="nlabel">Nombre: </label>
					</div>
					<div  class="form-group">
						<label class="form-group"  id="nelabel">Numero de episodios atendidos: </label>
					</div>

				</div>
				<div id="botones" class="pull-right">
					<input id="imprimir" name="imprimir" type="submit" class="btn btn-default" value="Imprimir">
				</div>
</body>
<?php } ?>