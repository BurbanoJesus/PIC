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
	<div class="panel" id="informe_3">
		<?php
		$busqueda_reportes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel informes">
			<?php $titulo = 'Planeación asistencia técnica'; $volver = 'opciones_informes?opcion='.$opcion; include VIEWS.'templates/contenido_informe_h1.php' ?>
			<form class="form s100 informes" method="POST" action="<?php echo CONTROLLERS?>panel/generar_informes/c_informe_3.php" id="form_informe_3">
				<div class="workspace">
					<div class="content_informe" id="content_informe_3">
						<div class="tb_informes" id="tabla_1">
							<table border="1" class="header">
								<tbody>
									<tr class="center">
										<td rowspan="2" class="center logo_1" width="160"><img src="<?php echo IMG?>panel/reporte_logo.png" width="140" /></td>
										<td colspan="3" class="center bold">
											<span class="block">PLANEACION ASISTENCIA TECNICA</span>
											<span class="block">(TALLERES, SEMINARIOS, CAPACITACIONES)</span>
										</td>
									</tr>
									<tr class="center">
										<td class="center"><div class="ellipsis">CÓDIGO: F-PATSSP01-02</div></td>
										<td class="nowrap">VERSIÓN: 01</td>
										<td class="nowrap">
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
										<td class="center bold" width="50%">Nombre de Subdirección - Oficina</td>
										<td class="center bold" width="50%">Área o Programa</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="nombre" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="area" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_3">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Mencionar en cual meta de producto y actividad del POA está programado</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="meta" /></td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Nombre de asistencia técnica</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="tecnica" /></td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Objetivo(s) de la asistencia técnica</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="objetivo" /></td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Metodología</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="metodologia" /></td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Participantes (Relacione las entidades o personas a invitar)</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="participantes" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_4">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td colspan="3" class="center bold" width="50%" bgcolor="#DADADA">Agenda</td>
									</tr>
									<tr class="center">
										<td class="center bold">Horario</td>
										<td class="center bold">Tematica</td>
										<td class="center bold">Conferencista</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="horario_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tematica_1" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="conferencista_1" /></td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="horario_2" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="tematica_2" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="conferencista_2" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_5">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td colspan="5" class="center bold" width="50%" bgcolor="#DADADA">Solicitud Refrigerios
											<span class="block">(No diligenciar este aparte del formato cuando se desarrolle una asistencia técnica individual)</span>
										</td>
									</tr>
									<tr class="center">
										<td class="center bold">Cantidad</td>
										<td class="center nopadd"><input class="total center" type="text" name="cantidad" /></td>
										<td class="center bold">Clase</td>
										<td class="center nopadd">
											<label for="clase_1">Normal</label>
											<input id="clase_1" class="center radio" type="radio" name="clase" value="Normal" />
											<label class="radio" for="clase_1"></label>
										</td>
										<td class="center nopadd">
											<label for="clase_2">Reforzar</label>
											<input id="clase_2" class="center radio" type="radio" name="clase" value="Reforzado" />
											<label class="radio" for="clase_2"></label>
										</td>
									</tr>
									<tr class="center">
										<td class="center bold">Rubro</td>
										<td class="center nopadd"><input class="total center" type="text" name="rubro" /></td>
										<td class="center bold">Valor</td>
										<td colspan="2" class="center nopadd"><input class="total center" type="text" name="valor" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_6">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td colspan="6" class="center bold" width="50%" bgcolor="#DADADA">Elementos de Apoyo</td>
									</tr>
									<tr class="center">
										<td class="center bold">Video Beam</td>
										<td class="center nopadd"><input class="total center" type="text" name="videobeam" /></td>
										<td class="center bold">Marcadores</td>
										<td class="center nopadd"><input class="total center" type="text" name="marcadores" /></td>
										<td class="center bold">Cartulinas</td>
										<td class="center nopadd"><input class="total center" type="text" name="cartulinas" /></td>
									</tr>
									<tr class="center">
										<td class="center bold">Papelógrafo</td>
										<td class="center nopadd"><input class="total center" type="text" name="papelografo" /></td>
										<td class="center bold">Papel bond</td>
										<td class="center nopadd"><input class="total center" type="text" name="papelbond" /></td>
										<td class="center bold">Otros:</td>
										<td class="center nopadd"><input class="total center" type="text" name="otros" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_7">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td class="center bold">Nombre del Responsable de la Asistencia Técnica</td>
										<td class="center bold">Fecha solicitud</td>
										<td class="center bold">Firma</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="responsable" /></td>
										<td class="center nopadd"><input class="total center" type="date" name="fecha_solicitud" value="<?php echo date('Y-m-d') ?>" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="firma" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes last" id="tabla_8">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td class="center bold" width="50%">Vo.Bo. SUBDIRECCION O OFICINA ASESORA</td>
										<td class="center bold" width="50%">Vo.Bo. SECRETARIA GENERAL</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><input class="total center" type="text" name="subdireccion" /></td>
										<td class="center nopadd"><input class="total center" type="text" name="secretaria" /></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="informes_footer">
							<span class="informes_span_1">COMPROMETIDOS CON LA CALIDAD</span>
						</div>
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
include VIEWS.'templates/foot.php'; 
?>