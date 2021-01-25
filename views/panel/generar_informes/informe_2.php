<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_panel.css','estilos_informes.css'];
include VIEWS.'templates/head.php';
$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

$opcion = $_GET['opcion'];

?>

<main>
	<div class="panel" id="informe_2">
		<?php
		$busqueda_reportes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel informes">
			<?php $titulo = 'Programación de actividades de asistencia técnica'; $volver = 'opciones_informes?opcion='.$opcion; include VIEWS.'templates/contenido_informe_h1.php' ?>
			<form class="form s100 informes" method="POST" action="<?php echo CONTROLLERS?>panel/generar_informes/c_informe_2.php" id="form_informe_2">
				<div class="workspace">
					<div class="content_informe" id="content_informe_2">
						<div class="tb_informes space" id="tabla_1">
							<table border="1" class="header">
								<tbody>
									<tr class="center">
										<td rowspan="2" class="center nopadd"><img class="logo_1" src="<?php echo IMG?>panel/reporte_logo.png"></td>
										<td colspan="3" class="center bold">PROGRAMACIÓN DE ACTIVIDADES DE ASISTENCIA TÉCNICA</td>
									</tr>
									<tr class="center">
										<td class="center"><div class="ellipsis">CÓDIGO: F-PATSSP01-01</div></td>
										<td class="nowrap">VERSIÓN: 01</td>
										<td class="nowrap">
											<span>FECHA: </span>
											<input type="date" name="fecha_main" value="<?php echo date('Y-m-d') ?>" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tr_informe">
							<span>COORDINADOR DEL PROCESO: </span>
							<input class="input_informe" type="text" name="coordinador" />
							<span>MES: </span>
							<input class="input_informe" type="text" name="mes" />
							<!-- <span class="next">COORDINADOR DEL PROCESO: </span>
							<span class="next">Luis Muñoz</span>
							<div class="next"></div>
							<span class="next">MES: </span>
							<span class="next">Junio</span> -->
						</div>
						<div class="tb_informes last" id="tabla_2">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td rowspan="2" class="center bold">MUNICIPIO</td>
										<td rowspan="2" class="center bold">DIRIGIDO A</td>
										<td rowspan="2" class="center bold">TEMA</td>
										<td rowspan="2" class="center bold">FECHA</td>
										<td rowspan="2" class="center bold">RESPONSABLE DE LA CAPACITACIÓN</td>
										<td rowspan="2" class="center bold">No. ACTORES CONVOCADOS</td>
										<td colspan="4" class="center bold">SEGUIMIENTO</td>
									</tr>
									<tr class="center">
										<td class="center">No. ACTORES QUE ASISTEN</td>
										<td class="center">SE REALIZÓ LA AT (Si/No)</td>
										<td class="center">EVALUACION DE SATISFACCIÓN (Reportar calificación)</td>
										<td class="center">OBSERVACIONES</td>
									</tr>
									<?php for ($i=1; $i <= 7 ; $i++) { ?>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="municipio_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="dirigido_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tema_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="fecha_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="eval_satis_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="observaciones_<?php echo $i ?>" /></td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="10">
											<div class="agregar_nuevo">
												<a class="button" id="add_1"><i class="icon-filled-add"></i>Agregar fila</a>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<!-- <div class="informes_footer" style="">
							<span class="informes_span_1">COMPROMETIDOS CON LA CALIDAD</span>
						</div> -->
						<div class="informes_span_1">COMPROMETIDOS CON LA CALIDAD</div>
					</div>
					<div class="content_button next">
						<button type="submit" class="button"><i class="icon-filled-pdf"></i>Generar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</main>
<?php
// $scripts = ['funciones_informes.js'];
include VIEWS.'templates/foot.php'; 
?>