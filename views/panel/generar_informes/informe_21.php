<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_panel.css','estilos_informes.css'];
include VIEWS.'templates/head.php';
$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

?>

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
											<input type="date" name="fecha" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tr_informe">
							<span>COORDINADOR DEL PROCESO: </span>
							<input class="input_informe" type="text" name="sadas" />
							<span>MES: </span>
							<input class="input_informe" type="text" name="sadas" />
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
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="municipio_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="dirigido_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tema_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="fecha_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="eval_satis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="observaciones_1" /></td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="municipio_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="dirigido_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tema_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="fecha_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="eval_satis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="observaciones_1" /></td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="municipio_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="dirigido_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tema_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="fecha_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="eval_satis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="observaciones_1" /></td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="municipio_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="dirigido_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tema_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="fecha_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="eval_satis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="observaciones_1" /></td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="municipio_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="dirigido_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tema_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="fecha_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="eval_satis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="observaciones_1" /></td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="municipio_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="dirigido_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tema_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="fecha_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="eval_satis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="observaciones_1" /></td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="municipio_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="dirigido_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tema_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="fecha_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_conv_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="num_actores_asis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="eval_satis_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="observaciones_1" /></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="10">
											<div class="agregar_nuevo">
												<a class="button" id="add_1"><i class="icon-lineal-add"></i>Agregar fila</a>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="informes_footer">
							<span class="informes_span_1">COMPROMETIDOS CON LA CALIDAD</span>
						</div>
					</div>
					<div class="content_button next">
						<button type="submit" class="button"><i class="icon-filled-pdf"></i>Generar</button>
					</div>
<?php 
include VIEWS.'templates/foot.php'; 
?>