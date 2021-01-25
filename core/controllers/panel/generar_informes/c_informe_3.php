<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'informe.php';
session_start();
require_once SERVER.'vendor/autoload.php';

$id = uniqid('IN', true);
$informe_detalles = 'DT_'.$id;
$fecha_main = $_POST['fecha_main'];
$nombre = $_POST['nombre'];
$area = $_POST['area'];
$meta = $_POST['meta'];
$tecnica = $_POST['tecnica'];
$objetivo = $_POST['objetivo'];
$metodologia = $_POST['metodologia'];
$participantes = $_POST['participantes'];
$horario_1 = $_POST['horario_1'];
$tematica_1 = $_POST['tematica_1'];
$conferencista_1 = $_POST['conferencista_1'];
$horario_2 = $_POST['horario_2'];
$tematica_2 = $_POST['tematica_2'];
$conferencista_2 = $_POST['conferencista_2'];
$cantidad = $_POST['cantidad'];
$clase = $_POST['clase'];
$rubro = $_POST['rubro'];
$valor = $_POST['valor'];
$videobeam = $_POST['videobeam'];
$marcadores = $_POST['marcadores'];
$cartulinas = $_POST['cartulinas'];
$papelografo = $_POST['papelografo'];
$papelbond = $_POST['papelbond'];
$otros = $_POST['otros'];
$responsable = $_POST['responsable'];
$fecha_solicitud = $_POST['fecha_solicitud'];
$firma = $_POST['firma'];
$subdireccion = $_POST['subdireccion'];
$secretaria = $_POST['secretaria'];
//
$usuario = $_SESSION['usuario']->usuario;
$ses_municipio = $_SESSION['ses_municipio'];
$ses_dimension = $_SESSION['ses_dimension'];
$ses_tecnologia = $_SESSION['ses_tecnologia'];
$ses_grupo = $_SESSION['ses_grupo'];
$fecha_reg = $fecha_actual;

$carpeta_destino = MULTIMEDIA_S."informes/".$usuario."/";
$carpeta_host = MULTIMEDIA_H."informes/".$usuario."/";
if (!file_exists($carpeta_destino)) @mkdir($carpeta_destino); 

$mpdf = new \Mpdf\Mpdf();
$html = '<div id="informe_3"><div class="content_informe" id="content_informe_3">
						<div class="tb_informes" id="tabla_1">
							<table border="1" class="header">
								<tbody>
									<tr class="center">
										<td rowspan="2" class="center nopadd logo_1" width="160"><img src="'.IMG.'panel/reporte_logo.png" width="140" ></td>
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
										<td class="center bold" width="50%">Nombre de Subdirección - Oficina</td>
										<td class="center bold" width="50%">Área o Programa</td>
									</tr>
									<tr class="center">
										<td class="center">'.$nombre.'</td>
										<td class="center">'.$area.'</td>
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
										<td class="center">'.$meta.'</td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Nombre de asistencia técnica</td>
									</tr>
									<tr class="center">
										<td class="center">'.$tecnica.'</td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Objetivo(s) de la asistencia técnica</td>
									</tr>
									<tr class="center">
										<td class="center">'.$objetivo.'</td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Metodología</td>
									</tr>
									<tr class="center">
										<td class="center">'.$metodologia.'</td>
									</tr>
									<tr class="center">
										<td class="center bold" width="50%" bgcolor="#DADADA">Participantes (Relacione las entidades o personas a invitar)</td>
									</tr>
									<tr class="center">
										<td class="center">'.$participantes.'</td>
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
										<td class="center">'.$horario_1.'</td>
										<td class="center">'.$tematica_1.'</td>
										<td class="center">'.$conferencista_1.'</td>
									</tr>
									<tr class="center">
										<td class="center">'.$horario_2.'</td>
										<td class="center">'.$tematica_2.'</td>
										<td class="center">'.$conferencista_2.'</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tb_informes" id="tabla_5">
							<table border="1" class="lowercase">
								<tbody>
									<tr class="center">
										<td colspan="4" class="center bold" width="50%" bgcolor="#DADADA">Solicitud Refrigerios
											<span class="block">(No diligenciar este aparte del formato cuando se desarrolle una asistencia técnica individual)</span>
										</td>
									</tr>
									<tr class="center">
										<td class="center bold">Cantidad</td>
										<td class="center">'.$cantidad.'</td>
										<td class="center bold">Clase</td>
										<td class="center">'.$clase.'</td>
									</tr>
									<tr class="center">
										<td class="center bold">Rubro</td>
										<td class="center">'.$rubro.'</td>
										<td class="center bold">Valor</td>
										<td class="center">'.$valor.'</td>
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
										<td class="center">'.$videobeam.'</td>
										<td class="center bold">Marcadores</td>
										<td class="center">'.$marcadores.'</td>
										<td class="center bold">Cartulinas</td>
										<td class="center">'.$cartulinas.'</td>
									</tr>
									<tr class="center">
										<td class="center bold">Papelógrafo</td>
										<td class="center">'.$papelografo.'</td>
										<td class="center bold">Papel bond</td>
										<td class="center">'.$papelbond.'</td>
										<td class="center bold">Otros:</td>
										<td class="center">'.$otros.'</td>
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
										<td class="center">'.$responsable.'</td>
										<td class="center">'.$fecha_solicitud.'</td>
										<td class="center">'.$firma.'</td>
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
										<td class="center">'.$subdireccion.'</td>
										<td class="center">'.$secretaria.'</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="informes_span_1">COMPROMETIDOS CON LA CALIDAD</div>
					</div></div>';
$stylesheet = file_get_contents(CSS.'estilos_informes.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

$name_archivo = 'Planeación asistencia técnica.pdf';
$name_clear = 'Planeación asistencia técnica';
$extension = 'pdf';
$cont_existe_file = 1;
$tipo_informe = '02';
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

