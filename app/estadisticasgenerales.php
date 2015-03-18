<?php
include "menu.php";
$radiologos = get_all_radiologo();
include ('fpdf/fpdf.php');
if(!isset($_GET['idradiologo'])){
		header("Location: error.php");
	}else if ($_GET['idradiologo']==0) {
			$id = 0;
			$pruebas = get_all_pdiagnostica();
			$contpd = 0;
			$contep = 0;
			foreach ($pruebas as $prueba) {
			$contpd++;
			}
			$episodios = get_all_episodio();
			foreach ($episodios as $episodio) {
				$contep++;
				
			}
			
			
		if(isset($_POST['imprimir'])){
			$pdf = new FPDF();

			$pdf->AddPage();
			

			$pdf->SetFont('Helvetica', 'B', 14);

			$pdf->Write (7,"ESTADISTICAS: ");
						$pdf->Ln();
						$pdf->Ln();
			
			$pdf->Write (5,"Numero de pruebas realizadas: ");
			$pdf->Write(5, $contpd);
			$pdf->Ln();
			$pdf->Write (5,"Numero de episodios atendidos: ");
			$pdf->Write(5, $contep);
			$pdf->Ln();

			
  

			$pdf->Output("estadisticas.pdf",'F');

			echo "<script language='javascript'> window.open('estadisticas.pdf');</script>";
}
		
	


?>
<head>
	<title>Estadisticas</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
	<div id="inicio" class="container">

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
					<h3 id="titulo1"> Datos totales</h3>
					<div  class="form-group">
						<label class="form-group"  id="nelabel">Numero de pruebas realizadas: </label> <?php echo $contpd; ?>
					</div>
					
					<div  class="form-group">
						<label class="form-group"  id="nealabel">Numero de episodios atendidos: </label> <?php echo $contep; ?>
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
$pruebas = get_all_pdiagnostica();
$cont = 0;
foreach ($pruebas as $prueba) {
	$id_aux = $prueba['id_radiologo'];
	if ($id_aux == $id){
		$cont++;
	}}
			if(isset($_POST['imprimir'])){
			$pdf = new FPDF();

			$pdf->AddPage();
			
			/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */

			$pdf->SetFont('Helvetica', 'B', 14);

			$pdf->Write (7,"ESTADISTICAS: ");
			$pdf->Write (7,$radiologo[nombre]);
						$pdf->Ln();
						$pdf->Ln();
			
			$pdf->Write (5,"Numero de pruebas realizadas: ");
			$pdf->Write(5, $cont);
			$pdf->Ln();

			
  

			$pdf->Output("prueba.pdf",'F');

			echo "<script language='javascript'> window.open('prueba.pdf');</script>";//paral archivo pdf generado
	
}
?>

<head>
	<title>Estadisticas</title>
	<LINK REL=StyleSheet HREF="common.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
	<div id="inicio" class="container">

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
						<label class="form-group"  id="nlabel">Nombre: </label> <?php echo $radiologo['nombre']; ?>
					</div>
					<div  class="form-group">
						<label class="form-group"  id="nelabel">Numero de pruebas realizadas: </label> <?php echo $cont; ?>
					</div>


				</div>
				<div id="botones" class="pull-right">
					<input id="imprimir" name="imprimir" type="submit" class="btn btn-default" value="Imprimir">
				</div>
</body>
<?php } ?>