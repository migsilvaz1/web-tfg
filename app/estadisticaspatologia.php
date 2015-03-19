<?php
include "menu.php";
include ('fpdf/fpdf.php');
include('graphs.inc.php');
$patologias = get_all_patologia();
$tprocedimientos = get_all_tipo_procedimiento();
$factores = get_all_factor();
				$graph = new BAR_GRAPH("hBar");
				$values = "";
				$labels = "";
				$check = 0;
				$graph2 = new BAR_GRAPH("hBar");
				$values2 = "";
				$labels2 = "";
				$check2 = 0;
if(!isset($_GET['idpatologia'])){
		header("Location: error.php");
	}else{

		$id = $_GET['idpatologia'];
		$patologia = get_by_id_patologia($id);




		if(isset($_POST['imprimir'])){
			$pdf = new FPDF();

			$pdf->AddPage();
			

			$pdf->SetFont('Helvetica', 'B', 14);

			$pdf->Write (7,"ESTADISTICAS: ");
			$pdf->Write (7,$patologia['nombre']);
			$pdf->Ln();
			$pdf->Ln();
						$pdf->Ln();
			$pdf->Write (5,"Porcentaje que ha presentado complicaciones: ");
			$pdf->Write (5,porcentaje_complicaciones_patologia($id));
			$pdf->Write (5, "%");
						$pdf->Ln();
			$pdf->Ln();
			$pdf->Write (5,"Edad media de los pacientes: ");
			$pdf->Write (5,edad_media_pacientes_patologia($id));
						$pdf->Ln();
			$pdf->Ln();
			$pdf->Write (5,"Porcentaje de pacientes por sexo: ");
						$pdf->Ln();
			$pdf->Write (5,"Hombres: ");
			$pdf->Write (5, sexo_patologia($id, "H"));
			$pdf->Write (5, "%");
			$pdf->Write (5,"     Mujeres: ");
			$pdf->Write (5, sexo_patologia($id, "M"));
			$pdf->Write (5, "%");			
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Write (5,"Numero de pacietes que han fallecido en un periodo de 30 dias: ");
			$pdf->Write (5,mortalidad_temprana_patologia($id));
			$pdf->Ln();
						$pdf->Ln();
			$pdf->Write (5, "Porcentajes de pacientes con factores de riesgo: ");
			$pdf->Ln();
			foreach ($factores as $factor) {
					
							if(pacientes_factores_patologia($id, $factor['id_factor'])!=0){ 
								
									 $pdf->Write (5, $factor['nombre']); 
								$pdf->Write(5, ":   ");
									 $pdf->Write (5, pacientes_factores_patologia($id, $factor['id_factor']));
								$pdf->Write(5,"%");
								$pdf->Ln();
							}
						}

			$pdf->Ln();
			$pdf->Write (5, "Pacientes que se han curado con un procedimiento:");
			
			$pdf->Ln();
						foreach ($tprocedimientos as $tprocedimiento) {
							if(curacion_patologia_procedimiento($id, $tprocedimiento['id_tipop'])!=0){
								
									 $pdf->Write (5, $tprocedimiento['nombre'] ); 
								$pdf->Write(5, ":   ");
									 $pdf->Write (5, curacion_patologia_procedimiento($id, $tprocedimiento['id_tipop']));
								$pdf->Ln();
							}
						}

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
			<h3>Lista de patologias</h3>
			<ul>
				<?php
				foreach ($patologias as $patologiaa) {
					$nombrea = $patologiaa['nombre'];
					$ida = $patologiaa['id_patologia'];
					echo "<li><a href=\"estadisticaspatologia.php?idpatologia=$ida\">$nombrea</a></li>";
				}
				?>
			</ul>
		</div>

		<!-- Fin Barra -->

		<div class="col-md-1"></div>
		<div class="jumbotron col-md-7">
			<form name='pdf' method='post' action='estadisticaspatologia.php?idpatologia=<?php echo $id; ?>'>
			<div id="grupo1">
				<h3 id="titulo1">
					Datos de la patología
				</h3>
								<div class="form-group">

				<label class="form-group" id="plabel">Patologia: </label><?php echo $patologia['nombre']; ?>
				</div>
				<div  class="form-group">
				<label class="form-group" id="pclabel">Porcentaje que ha presentado complicaciones: </label> <?php echo porcentaje_complicaciones_patologia($id); ?>%
				</div>
				<div  class="form-group">
				<label class="form-group" id="emlabel">Edad media de los pacientes: </label> <?php echo edad_media_pacientes_patologia($id); ?>
				</div>
				<div  class="form-group">
				<label id="pslabel">Porcentaje de pacientes por sexo:</label>
				<ul class"list-inline">
					<li>Hombres: <?php echo sexo_patologia($id, "H"); ?>% </li><li>Mujeres: <?php echo sexo_patologia($id, "M"); ?>%</li> 
				</ul>
			</div>
								
				<div  class="form-group">
				<label class="form-group" id="pflabel">Numero de pacietes que han fallecido en un periodo de 30 dias: </label> <?php echo mortalidad_temprana_patologia($id); ?>
				</div>
				
				
				
						<div class="form-group">
				<label id="pflabel">Porcentajes de pacientes con factores de riesgo: </label>
				<table class="table table-striped">
					<tr>
						<td>Factor de riesgo</td>
						<td>Porcentaje de pacientes</td>
					</tr>
					<?php
						foreach ($factores as $factor) {
					
							if(pacientes_factores_patologia($id, $factor['id_factor'])!=0){ ?>
								<tr>
									<td><?php echo $factor['nombre']; ?></td>
									<td><?php echo pacientes_factores_patologia($id, $factor['id_factor']); ?></td>
								</tr><?php }
								} ?>
				</table>
				<?php

				foreach ($factores as $factor) {
					
							if(pacientes_factores_patologia($id, $factor['id_factor'])!=0){ 
								if($check==0){
									 $labels = $factor['nombre']; 
									 $values = pacientes_factores_patologia($id, $factor['id_factor']); 
									 $check = 1;
								}else{
									$labels .= ",";
									$labels .= $factor['nombre']; 
									 $values .= ",";
									 $values .= pacientes_factores_patologia($id, $factor['id_factor']); 
								}
								
								} }
				
				$graph->values = $values;
				$graph->labels=$labels;
				$graph->showValues = 2;
$graph->barWidth = 20;
$graph->barLength = 1.0;
$graph->labelSize = 12;
$graph->absValuesSize = 12;
$graph->percValuesSize = 12;
$graph->graphPadding = 10;
$graph->graphBGColor = "#ABCDEF";
$graph->graphBorder = "1px solid blue";
$graph->barColors = "#A0C0F0";
$graph->barBGColor = "#E0F0FF";
$graph->barBorder = "2px outset white";
$graph->labelColor = "#000000";
$graph->labelBGColor = "#C0E0FF";
$graph->labelBorder = "2px groove white";
$graph->absValuesColor = "#000000";
$graph->absValuesBGColor = "#FFFFFF";
$graph->absValuesBorder = "2px groove white";
echo $graph->create();
								?>
				</div>
				<label id="pculabel">Pacientes que se han curado con un procedimiento: </label>
				<table class="table table-striped">
					<tr>
						<td>Procedimiento</td>
						<td>Pacientes curados</td>
					</tr>
					<?php 
						foreach ($tprocedimientos as $tprocedimiento) {
							if(curacion_patologia_procedimiento($id, $tprocedimiento['id_tipop'])!=0){ ?>
								<tr>
									<td><?php echo $tprocedimiento['nombre']; ?></td>
									<td><?php echo curacion_patologia_procedimiento($id, $tprocedimiento['id_tipop']); ?></td>
								</tr><?php
								}
								}
					?>
				</table>
				
				<?php 
						foreach ($tprocedimientos as $tprocedimiento) {
							if(curacion_patologia_procedimiento($id, $tprocedimiento['id_tipop'])!=0){ 
								if($check2==0){
									 $labels2 = $tprocedimiento['nombre']; 
									 $values2 = curacion_patologia_procedimiento($id, $tprocedimiento['id_tipop']); 
									 $check2=1;
								}else{
									$labels2 .=",";
									$labels2 .=$tprocedimiento['nombre']; 
									$values2 .=",";
									$values2 .= curacion_patologia_procedimiento($id, $tprocedimiento['id_tipop']);
								}
								
								}
								}
						$graph2->values = $values2;
				$graph2->labels=$labels2;
				$graph2->showValues = 2;
$graph2->barWidth = 20;
$graph2->barLength = 1.0;
$graph2->labelSize = 12;
$graph2->absValuesSize = 12;
$graph2->percValuesSize = 12;
$graph2->graphPadding = 10;
$graph2->graphBGColor = "#ABCDEF";
$graph2->graphBorder = "1px solid blue";
$graph2->barColors = "#A0C0F0";
$graph2->barBGColor = "#E0F0FF";
$graph2->barBorder = "2px outset white";
$graph2->labelColor = "#000000";
$graph2->labelBGColor = "#C0E0FF";
$graph2->labelBorder = "2px groove white";
$graph2->absValuesColor = "#000000";
$graph2->absValuesBGColor = "#FFFFFF";
$graph2->absValuesBorder = "2px groove white";
echo $graph2->create();
					?>

				
				
				
				
				
				
			</div>
				<div id="botones" class="pull-right">
					<input id="imprimir" name="imprimir" type="submit" class="btn btn-default" value="Imprimir">
				</div>

		</div>
	</div>
</body>
<?php } ?>