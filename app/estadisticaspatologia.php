<?php
include "menu.php";
include ('fpdf/fpdf.php');
//include_once('PDF.php');
$patologias = get_all_patologia();
$tprocedimientos = get_all_tipo_procedimiento();
$factores = get_all_factor();
if(!isset($_GET['idpatologia'])){
		header("Location: error.php");
	}else{

		$id = $_GET['idpatologia'];
		$patologia = get_by_id_patologia($id);





		/* tenemos que generar una instancia de la clase */
		if(isset($_POST['imprimir'])){
			$pdf = new FPDF();

			$pdf->AddPage();
			
			/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */

			$pdf->SetFont('Helvetica', 'B', 14);

			$pdf->Write (7,"ESTADISTICAS: ");
			$pdf->Write (7,$patologia['nombre']);
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Write (5,"Porcentaje que ha presentado complicaciones: ");
			$pdf->Write (5,porcentaje_complicaciones_patologia($id));
			$pdf->Write (5, "%");
			$pdf->Ln();
			$pdf->Write (5,"Edad media de los pacientes: ");
			$pdf->Write (5,edad_media_pacientes_patologia($id));
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
			$pdf->Write (5,"Porcentaje de pacietes que han fallecido en un periodo de 30 dias: ");
			$pdf->Write (5,porcentaje_complicaciones_patologia($id));
			$pdf->Write (5, "%");
			$pdf->Ln();
			$pdf->Write (5, "Porcentaje de pacientes con factores de riesgo: ");
			$pdf->Write (5, pacientes_factores_patologia($id));
			$pdf->Write (5, "%");
			$pdf->Ln();
			$pdf->Write (5, "Pacientes que se han curado con un procedimiento:");
			
  

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

				<label class="form-group" id="plabel">Patologia: <?php echo $patologia['nombre']; ?></label>
				</div>
				<div  class="form-group">
				<label class="form-group" id="pclabel">Porcentaje que ha presentado complicaciones: <?php echo porcentaje_complicaciones_patologia($id); ?>%</label>
				</div>
				<div  class="form-group">
				<label class="form-group" id="emlabel">Edad media de los pacientes: <?php echo edad_media_pacientes_patologia($id); ?></label>
				</div>
				<div  class="form-group">
				<label id="pslabel">Porcentaje de pacientes por sexo</label>
				<label id="pshlabel">Hombres: <?php echo sexo_patologia($id, "H"); ?>%    </label>
				<label id="psmlabel">     Mujeres:  <?php echo sexo_patologia($id, "M"); ?>%</label>
								</div>
				<div  class="form-group">
				<label class="form-group" id="pflabel">Numero de pacietes que han fallecido en un periodo de 30 dias: <?php echo mortalidad_temprana_patologia($id); ?></label>
				</div>
				
				
				
						<div class="form-group">
				<label id="pflabel">Porcentaje de pacientes con factores de riesgo: <?php echo pacientes_factores_patologia($id) ?>%</label>				
				</div>
				<label id="pculabel">Pacientes que se han curado con un procedimiento: </label>
				<table class="table table-striped">
					<tr>
						<td>Procedimiento</td>
						<td>Pacientes curados</td>
					</tr>
					<?php 
						foreach ($tprocedimientos as $tprocedimiento) {
							 $id_tproc = $tprocedimiento['id_tipop'];
							if(curacion_patologia_procedimiento($id, $id_tproc)!=0){ ?>
								<tr>
									<td><?php $procd_aux = get_by_id_tipo_procedimiento($id_tproc); echo $procd_aux['nombre']; ?></td>
									<td><?php echo curacion_patologia_procedimiento($id, $id_tproc); ?></td>
								</tr><?php
							}
						}
					?>
				</table>
				
				

				
				
				
				
				
				
			</div>
				<div id="botones" class="pull-right">
					<input id="imprimir" name="imprimir" type="submit" class="btn btn-default" value="Imprimir">
				</div>

		</div>
	</div>
</body>
<?php } ?>