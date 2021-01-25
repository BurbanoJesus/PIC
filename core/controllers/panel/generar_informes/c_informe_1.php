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
$fecha_reg = $fecha_actual;

$carpeta_destino = MULTIMEDIA_S."informes/".$usuario."/";
$carpeta_host = MULTIMEDIA_H."informes/".$usuario."/";
if (!file_exists($carpeta_destino)) @mkdir($carpeta_destino); 

$mpdf = new \Mpdf\Mpdf();
$html = '		<div class="content_informe">
					<h2 class="informe_doc">INTERVENCIONES COLECTIVAS A TRAVES DE LA ESTRATEGIA DE MOVILIZACION SOCIAL EN LAS TECNOLOGÍAS DE CONFORMACIÓN DE REDES, EDUCACIÓN Y COMUNICACIÓN DE SALUD E INFORMACIÓN EN SALUD.</h2>
					<div class="space_doc"></div>
					<h3 class="informe_doc">1.	OBJETIVO</h3>
					<p class="informe_doc">Establecer los lineamientos para formular, ejecutar, monitorear y evaluar el Plan de Salud Pública de Intervenciones Colectivas departamental para el desarrollo de capacidades a los actores del SGSSS del Departamento de Nariño y a los trabajadores del IDSN cuando aplique, mediante procesos de participación social de conformidad con lo establecido en la  resolución 518 de 2015</p>
					<div class="space_doc"></div>
					<h3 class="informe_doc">2.	ALCANCE</h3>
					<p class="informe_doc">Este procedimiento aplica al seguimiento al cumplimiento  del plan de Intervenciones colectivas departamental de Nariño y es de obligatorio cumplimiento por todos los servidores tanto de planta como de contrato del IDSN. </p>
					<div class="space_doc"></div>
					<h3 class="informe_doc">3.	CONDICIONES GENERALES</h3>
					<p class="informe_doc">Para la formulación. Ejecución, monitoreo y evaluación del Plan de Salud Pública de Intervenciones Colectivas departamental mediante procesos de participación social, aplican las siguientes consideraciones:</p>
					<p class="informe_doc">Formular, implementar y evaluar procesos de asistencia técnica para el desarrollo de capacidades en los actores del Sistema General de Seguridad Social en Salud y otros actores involucrados en la formulación, ejecución, monitoreo y evaluación del Plan de Salud Pública de Intervenciones Colectivas.</p>
					<p class="informe_doc">Desarrollar, implementar, monitorear y evaluar la adecuación sociocultural de planes, programas y estrategias desarrolladas en el marco del Plan de Salud Pública de Intervenciones Colectivas, teniendo en cuenta las orientaciones técnicas que para el efecto defina el Ministerio de Salud y Protección Social</p>
					<p class="informe_doc"></p>
				</div>';
$stylesheet = file_get_contents(CSS.'estilos_informes.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output(MULTIMEDIA_S.'informes/Procedimiento PIC.pdf','F');
$mpdf->Output('Procedimiento PIC.pdf','D');

// header("Location: $host/inicio/success?&url_redirect=$url_redirect&active=$active&titulo=$titulo");
// exit;

// $mpdf = new \Mpdf\Mpdf();
// $mpdf->WriteHTML('<h1>Hello world!</h1>');
// $mpdf->Output();
  
?>

