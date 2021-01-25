<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'informe.php';
session_start();
require_once SERVER.'vendor/autoload.php';

$id = uniqid('IN', true);
$informe_detalles = 'DT_'.$id;
$fecha_main = $_POST['fecha_main'];
$coordinador = $_POST['coordinador'];
$mes = $_POST['mes'];
$usuario = $_SESSION['usuario']->usuario;
$ses_municipio = $_SESSION['ses_municipio'];
$ses_dimension = $_SESSION['ses_dimension'];
$ses_tecnologia = $_SESSION['ses_tecnologia'];
$ses_grupo = $_SESSION['ses_grupo'];
$fecha_reg = $fecha_actual;

$carpeta_destino = MULTIMEDIA_S."informes/".$usuario."/";
$carpeta_host = MULTIMEDIA_H."informes/".$usuario."/";
if (!file_exists($carpeta_destino)) @mkdir($carpeta_destino); 

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'LEGAL-L']);
$html = '<div id="informe_2"><div class="content_informe" id="content_informe_2">
			<div class="tb_informes space" id="tabla_1">
				<table border="1" class="header">
					<tbody>
						<tr class="center">
							<td rowspan="2" class="center nopadd"><img class="logo_1" src="'.IMG.'panel/reporte_logo.png" width="130" /></td>
							<td colspan="3" class="center bold">PROGRAMACIÓN DE ACTIVIDADES DE ASISTENCIA TÉCNICA</td>
						</tr>
						<tr class="center">
							<td class="center"><div class="ellipsis">CÓDIGO: F-PATSSP01-01</div></td>
							<td class="nowrap">VERSIÓN: 01</td>
							<td class="nowrap">
								<span>FECHA: </span>
								<span>'.$fecha_main.'</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tr_informe">
				<span class="next">COORDINADOR DEL PROCESO: </span>
				<span class="next">'.$coordinador.'</span>
				<div class="next"></div>
				<span class="next">MES: </span>
				<span class="next">'.$mes.'</span>
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
						';
						$cont = 1;
						while (isset($_POST['municipio_'.$cont])){
						$municipio = ($_POST['municipio_'.$cont] != '') ? $_POST['municipio_'.$cont] : '-';
						$dirigido = $_POST['dirigido_'.$cont];
						$tema = $_POST['tema_'.$cont];
						$fecha = $_POST['fecha_'.$cont];
						$responsable = $_POST['responsable_'.$cont];
						$num_act_conv = $_POST['num_actores_conv_'.$cont];
						$seguimiento = $_POST['seguimiento_'.$cont];
						$num_act_asis = $_POST['num_actores_asis_'.$cont];
						$eval_satis = $_POST['eval_satis_'.$cont];
						$observaciones = $_POST['observaciones_'.$cont];
						$html .='<tr class="center">
							<td class="center">'.$municipio.'</td>
							<td class="center">'.$dirigido.'</td>
							<td class="center">'.$tema.'</td>
							<td class="center">'.$fecha.'</td>
							<td class="center">'.$responsable.'</td>
							<td class="center">'.$num_act_conv.'</td>
							<td class="center">'.$seguimiento.'</td>
							<td class="center">'.$num_act_asis.'</td>
							<td class="center">'.$eval_satis.'</td>
							<td class="center">'.$observaciones.'</td>
						</tr>';
						$cont++;
						}
				$html .='</tbody>
				</table>
			</div>
			<div class="informes_span_1">COMPROMETIDOS CON LA CALIDAD</div>
		</div>
		</div>';
$stylesheet = file_get_contents(CSS.'estilos_informes.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

$name_archivo = 'Programación de actividades de asistencia técnica.pdf';
$name_clear = 'Programación de actividades de asistencia técnica';
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

