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
	<div class="panel" id="informe_4">
		<?php
		$busqueda_reportes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel informes">
			<?php $titulo = 'Acta de reunión'; $volver = 'opciones_informes?opcion='.$opcion; include VIEWS.'templates/contenido_informe_h1.php' ?>
			<form class="form s100 informes" method="POST" enctype="multipart/form-data" action="<?php echo CONTROLLERS?>panel/generar_informes/c_informe_4.php" id="form_informe_4">
				<div class="workspace">
					<div class="content_informe" id="content_informe_4">
						<div class="tb_informes" id="tabla_1">
							<table border="1" class="header">
								<tbody>
									<tr class="center">
										<td rowspan="2" class="center logo_1" width="160"><img src="<?php echo IMG?>panel/reporte_logo.png" width="140" /></td>
										<td colspan="3" class="center bold">
											<span class="block">ACTA DE REUNIÓN</span>
										</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><div class="ellipsis">CÓDIGO: F-PGED05-11</div></td>
										<td class="nowrap nopadd">VERSIÓN: 01</td>
										<td class="nowrap nopadd">
											<span>FECHA: </span>
											<input type="date" name="fecha_main" value="<?php echo date('Y-m-d') ?>" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_2">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td colspan="2" class="center bold" width="400px">Nombre de la Reunión</td>
										<td class="center bold" width="140">Fecha</td>
										<td class="center bold">Hora Inicial</td>
										<td class="center bold">Hora Final</td>
										<td class="center bold" width="80">Acta N°</td>
									</tr>
									<tr class="center">
										<td colspan="2" class="center nopadd"><input class="total center" type="text" name="nombre_reunion" /></td>
										<td class="center nopadd"><input type="date" name="fecha_reunion" value="<?php echo date('Y-m-d') ?>" /></td>
										<td class="center nopadd"><input type="time" name="hora_re_i" value="<?php echo date('H:i') ?>" /></td>
										<td class="center nopadd"><input type="time" name="hora_re_f" value="<?php echo date('H:i') ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="acta" /></td>
									</tr>
									<tr class="center">
										<td colspan="2" class="center bold">Lugar:</td>
										<td colspan="6" class="center nopadd"><input class="total center" type="text" name="lugar" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_3">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td colspan="5" class="center bold">Asistentes</td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50">N°</td>
										<td class="center bold">Nombre</td>
										<td class="center bold">Doc. Identificación</td>
										<td class="center bold">Área o Empresa</td>
										<td class="center bold">Firma</td>
									</tr>
									<?php for ($i=1; $i <= 5 ; $i++) { ?>
									<tr class="center">
										<td class="center nopadd"><?php echo $i ?></td>
										<td class="center nopadd"><input class="total center" type="text" name="nombre_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="documento_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="area_<?php echo $i ?>" /></td>
										<td class="center nopadd">
											<div class="agregar_firma_digital">
												<div id="loading_<?php echo $i ?>" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt=""></div>
									        	<input class="input_firma" id="in_firma_<?php echo $i ?>" name="firma_<?php echo $i ?>" accept="image/jpeg,image/png" type="file" />
									            <!-- <label class="label_icon icon-filled-add-multimedia" for="input_file_1"></label> -->
												<div class="div_button"><label class="button_firma" for="in_firma_<?php echo $i ?>">Seleccionar Imagen</label></div>
									        </div>
										</td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5">
											<div class="agregar_nuevo">
												<a class="button" id="add_asistentes"><i class="icon-filled-add"></i>Agregar fila</a>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="tb_informes" id="tabla_4">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td colspan="3" class="center bold">Orden del día</td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50">N°</td>
										<td class="center bold">Temática</td>
										<td class="center bold">Responsable</td>
									</tr>
									<?php for ($i=1; $i <= 5 ; $i++) { ?>
									<tr class="center">
										<td class="center"><?php echo $i ?></td>
										<td class="center nopadd"><input class="total center" type="text" name="tematica_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_<?php echo $i ?>" /></td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="3">
											<div class="agregar_nuevo">
												<a class="button" id="add_orden"><i class="icon-filled-add"></i>Agregar fila</a>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="tb_informes" id="tabla_5">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td class="center bold">Desarrollo</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><textarea class="total center" name="desarrollo" ></textarea></td>
									</tr>
									<tr class="center">
										<td class="center bold">Conclusiones</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><textarea class="total center" name="conclusiones" ></textarea></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_6">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td class="center bold">Compromisos y tareas</td>
										<td class="center bold">Responsable de ejecutar</td>
										<td class="center bold" width="140">Fecha</td>
										<td class="center bold">Observaciones</td>
									</tr>
									<?php for ($i=1; $i <= 5 ; $i++) { ?>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="compromisos_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="responsable_ejecutar_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input type="date" name="fecha_compromisos_<?php echo $i ?>" value="" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="obs_compromisos_<?php echo $i ?>" /></td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4">
											<div class="agregar_nuevo">
												<a class="button" id="add_compromisos"><i class="icon-filled-add"></i>Agregar fila</a>
											</div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="tb_informes" id="tabla_7">
							<table border="1" class="lowercase">
								<tbody>
									<tr>
										<td colspan="3" class="center bold">Convocatoria Próxima reunión</td>
									</tr>
									<tr class="center">
										<td class="center bold">Lugar</td>
										<td class="center bold" width="140">Hora Inicio</td>
										<td class="center bold" width="140">Fecha</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="lugar_proxima" /></td>
										<td class="center nopadd"><input type="time" name="hora_proxima" value="<?php echo date('H:i') ?>" /></td>
										<td class="center nopadd" width="140"><input type="date" name="fecha_proxima" value="<?php echo date('Y-m-d') ?>" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_8">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td class="center bold">Responsable Elaboración</td>
										<td class="center bold">Firma</td>
										<td class="center bold" width="140">Fecha</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="responsable_elabora" /></td>
										<td class="center nopadd">
											<div class="agregar_firma_digital">
												<div id="loading_elabora" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt=""></div>
									        	<input class="input_firma" id="in_firma_elabora" name="firma_elabora" accept="image/jpeg,image/png" type="file" />
												<div class="div_button"><label class="button_firma" for="in_firma_elabora">Seleccionar Imagen</label></div>
									        </div>
										</td>
										<td class="center nopadd"><input type="date" name="fecha_elabora" value="<?php echo date('Y-m-d') ?>" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes last" id="tabla_9">
							<table border="1" class="lowercase">
								<tbody>
									<tr>
										<td colspan="6" class="center bold">Seguimiento</td>
									</tr>
									<tr class="center">
										<td colspan="2" class="center bold">Compromisos y tareas</td>
										<td class="center bold">Seguimiento</td>
										<td class="center bold" width="140">Fecha de realización</td>
										<td class="center bold">Observaciones</td>
									</tr>
									<?php for ($i=1; $i <= 5 ; $i++) { ?>
									<tr class="center">
										<td colspan="2" class="center nopadd"><input class="total center" type="text" name="compromisos_seguimiento_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="seguimiento_<?php echo $i ?>" /></td>
										<td class="center nopadd"><input type="date" name="fecha_seguimiento_<?php echo $i ?>" value="" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="obs_seguimiento_<?php echo $i ?>" /></td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7">
											<div class="agregar_nuevo">
												<a class="button" id="add_seguimiento"><i class="icon-filled-add"></i>Agregar fila</a>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="center bold">Responsable de realizar el Seguimiento:</td>
										<td colspan="4" class="center nopadd"><input class="total center" type="text" name="responsable_seguimiento" /></td>
									</tr>
									<tr>
										<td colspan="1" class="center bold">Firma</td>
										<td colspan="6" class="center nopadd">
											<div class="agregar_firma_digital">
												<div id="loading_seg" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt=""></div>
									        	<input class="input_firma" id="in_firma_seguimiento" name="firma_seguimiento" accept="image/jpeg,image/png" type="file" />
									            <!-- <label class="label_icon icon-filled-add-multimedia" for="input_file_1"></label> -->
												<div class="div_button"><label class="button_firma" for="in_firma_seguimiento">Seleccionar Imagen</label></div>
									        </div>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
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
$scripts = ['funciones_informes.js'];
include VIEWS.'templates/foot.php'; 
?>