<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'informe.php';
require LIBS.'gd_image_pdf.php';
session_start();
require_once SERVER.'vendor/autoload.php';

$id = uniqid('IN', true);
$informe_detalles = 'DT_'.$id;
$fecha_main = $_POST['fecha_main'];
$nombre_reunion = $_POST['nombre_reunion'];
$fecha_reunion = $_POST['fecha_reunion'];
$hora_re_i = $_POST['hora_re_i'];
$hora_re_f = $_POST['hora_re_f'];
$acta = $_POST['acta'];
$lugar = $_POST['lugar'];
$desarrollo = $_POST['desarrollo'];
$conclusiones = $_POST['conclusiones'];
$lugar_proxima = $_POST['lugar_proxima'];
$hora_proxima = $_POST['hora_proxima'];
$fecha_proxima = $_POST['fecha_proxima'];
$responsable_elabora = $_POST['responsable_elabora'];
$firma_elabora = ($_FILES['firma_elabora']['error'] == 0) ? $_FILES['firma_elabora'] : '';
$fecha_elabora = $_POST['fecha_elabora'];
$responsable_seguimiento = $_POST['responsable_seguimiento'];
$firma_seguimiento = ($_FILES['firma_seguimiento']['error'] == 0) ? $_FILES['firma_seguimiento'] : '';
// 
$usuario = $_SESSION['usuario']->usuario;
$ses_municipio = $_SESSION['ses_municipio'];
$ses_dimension = $_SESSION['ses_dimension'];
$ses_tecnologia = $_SESSION['ses_tecnologia'];
$ses_grupo = $_SESSION['ses_grupo'];
$fecha_reg = $fecha_actual;

$img_firma_elabora = ($firma_elabora !== '') ?  convertir_firma_digital($firma_elabora) : '';
$img_firma_seguimiento = ($firma_elabora !== '') ? convertir_firma_digital($firma_seguimiento) : '';
// echo $img_firma_elabora;
// echo $img_firma_seguimiento;

$carpeta_destino = MULTIMEDIA_S."informes/".$usuario."/";
$carpeta_host = MULTIMEDIA_H."informes/".$usuario."/";
if (!file_exists($carpeta_destino)) @mkdir($carpeta_destino); 

$mpdf = new \Mpdf\Mpdf();
$html = '<div id="informe_4">
		<div class="content_informe" id="content_informe_4">
						<div class="tb_informes" id="tabla_1">
							<table border="1" class="header">
								<tbody>
									<tr class="center">
										<td rowspan="2" class="center logo_1" width="160"><img src="'.IMG.'panel/reporte_logo.png" width="140" /></td>
										<td colspan="3" class="center bold">
											<span class="block">ACTA DE REUNIÓN</span>
										</td>
									</tr>
									<tr class="center">
										<td class="center nopadd"><div class="ellipsis">CÓDIGO: F-PGED05-11</div></td>
										<td class="nowrap nopadd">VERSIÓN: 01</td>
										<td class="nowrap nopadd">
											<span>FECHA: </span>
											<span>'.$fecha_main.'</span>
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
										<td colspan="2" class="center nopadd">'.$nombre_reunion.'</td>
										<td class="center nopadd">'.$fecha_reunion.'</td>
										<td class="center nopadd">'.$hora_re_i.'</td>
										<td class="center nopadd">'.$hora_re_f.'</td>
										<td class="center nopadd">'.$acta.'</td>
									</tr>
									<tr class="center">
										<td colspan="2" class="center bold">Lugar:</td>
										<td colspan="6" class="center nopadd">'.$lugar.'</td>
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
									</tr>';
									$cont = 1;
									while (isset($_POST['nombre_'.$cont])){
									$nombre = $_POST['nombre_'.$cont];
									$documento = $_POST['documento_'.$cont];
									$area = $_POST['area_'.$cont];
									$firma = ($_FILES['firma_'.$cont]['error'] == 0) ? $_FILES['firma_'.$cont] : '';
									var_dump($_FILES['firma_'.$cont]);
									var_dump($firma);
									$img_firma = ($firma !== '') ?  convertir_firma_digital($firma) : '';
									$html .= '<tr class="center">
										<td class="center nopadd">'.$cont.'</td>
										<td class="center nopadd">'.$nombre.'</td>
										<td class="center nopadd">'.$documento.'</td>
										<td class="center nopadd">'.$area.'</td>
										<td class="center nopadd">'.$img_firma.'</td>
									</tr>';
									$cont++;
									}
						$html .= '</tbody>
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
									</tr>';
									$cont = 1;
									while (isset($_POST['tematica_'.$cont])){
									$tematica = $_POST['tematica_'.$cont];
									$responsable = $_POST['responsable_'.$cont];
									$html .= '<tr class="center">
										<td class="center">'.$cont.'</td>
										<td class="center nopadd">'.$tematica.'</td>
										<td class="center nopadd">'.$responsable.'</td>
									</tr>';
									$cont++;
									}
					$html .= '</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_5">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td class="center bold">Desarrollo</td>
									</tr>
									<tr class="center">
										<td class="center nopadd">'.$desarrollo.'</td>
									</tr>
									<tr class="center">
										<td class="center bold">Conclusiones</td>
									</tr>
									<tr class="center">
										<td class="center nopadd">'.$conclusiones.'</td>
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
									</tr>';
									$cont = 1;
									while (isset($_POST['compromisos_'.$cont])){
									$compromisos = $_POST['compromisos_'.$cont];
									$responsable_ejecutar = $_POST['responsable_ejecutar_'.$cont];
									$fecha_compromisos = $_POST['fecha_compromisos_'.$cont];
									$obs_compromisos = $_POST['obs_compromisos_'.$cont];
									$html .= '<tr class="center">
										<td class="center nopadd">'.$compromisos.'</td>
										<td class="center nopadd">'.$responsable_ejecutar.'</td>
										<td class="center nopadd">'.$fecha_compromisos.'</td>
										<td class="center nopadd">'.$obs_compromisos.'</td>
									</tr>';
									$cont++;
									}
						$html .= '</tbody>
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
										<td class="center nopadd">'.$lugar_proxima.'</td>
										<td class="center nopadd">'.$hora_proxima.'</td>
										<td class="center nopadd" width="140">'.$fecha_proxima.'</td>
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
										<td class="center nopadd">'.$responsable_elabora.'</td>
										<td class="center nopadd">'.$img_firma_elabora.'</td>
										<td class="center nopadd">'.$fecha_elabora.'</td>
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
									</tr>';
									$cont = 1;
									while (isset($_POST['compromisos_seguimiento_'.$cont])){
									$compromisos_seguimiento = $_POST['compromisos_seguimiento_'.$cont];
									$seguimiento = $_POST['seguimiento_'.$cont];
									$fecha_seguimiento = $_POST['fecha_seguimiento_'.$cont];
									$obs_seguimiento = $_POST['obs_seguimiento_'.$cont];
									$html .= '<tr class="center">
										<td colspan="2" class="center nopadd">'.$compromisos_seguimiento.'</td>
										<td class="center nopadd">'.$seguimiento.'</td>
										<td class="center nopadd">'.$fecha_seguimiento.'</td>
										<td class="center nopadd">'.$obs_seguimiento.'</td>
									</tr>';
									$cont++;
									}
								$html .= '</tbody>
								<tfoot>
									<tr>
										<td colspan="3" class="center bold">Responsable de realizar el Seguimiento:</td>
										<td colspan="4" class="center nopadd">'.$responsable_seguimiento.'</td>
									</tr>
									<tr>
										<td colspan="1" class="center bold">Firma</td>
										<td colspan="6" class="center nopadd">'.$img_firma_seguimiento.'</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<div class="informes_span_1">COMPROMETIDOS CON LA CALIDAD</div>
					</div></div>';
$stylesheet = file_get_contents(CSS.'estilos_informes.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

$name_archivo = 'Acta de reunión.pdf';
$name_clear = 'Acta de reunión';
$extension = 'pdf';
$cont_existe_file = 1;
$tipo_informe = '04';
$url_archivo = $carpeta_destino.$name_archivo;
while(file_exists($url_archivo)){
	$name_archivo = $name_clear.'_'.$cont_existe_file.'.'.$extension;
	$url_archivo = $carpeta_destino.$name_archivo;
	$cont_existe_file++;
}
$mpdf->Output($url_archivo,'F');

$url_host = $carpeta_host.$name_archivo;
$obj_informe = new informe();
$insertar = $obj_informe->insertar($id,$url_host,$tipo_informe,$usuario,$ses_municipio,$informe_detalles,$ses_dimension,$ses_tecnologia,$ses_grupo,$fecha_reg);

$mpdf->Output($name_clear.'.pdf','D');
  
?>

