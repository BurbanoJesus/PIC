<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'curso.php';
session_start();

$id_curso = $_GET['id_curso'];
$obj_curso = new Curso();
$row_curso = $obj_curso->detalles($id_curso);


$nombre_curso = $row_curso->nombre_curso;
$nombre_usuario = $_SESSION['usuario']->nombres;
$identificacion = $_SESSION['usuario']->identificacion;

$dia = (int) date("d", strtotime($row_curso->fecha));
$mes = (int) date("m", strtotime($row_curso->fecha));
$year = (int) date("Y", strtotime($row_curso->fecha));

$days = ['Uno','Dos','Tres','Cuatro','Cinco','Seis','Siete','Ocho','Nueve','Diez','Once','Doce','Trece','Catorce','Quince','Dieciséis','Diecisiete','Dieciocho','Diecinueve','Veinte','Veintiuno','Veintidós','Veintitrés','Veinticuatro','Veinticinco','Veintiséis','Veintisiete','Veintiocho','Veintinueve','Treinta','Treinta y uno'];

$months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
$years = ['Dos mil veinte','Dos mil veintiuno','Dos mil veintidós'];

$str_dia = strtolower($days[$dia-1]);
$str_mes = strtolower($months[$mes-1]);
$str_year = strtolower($years[$year-2020]);

$str_inicio = ($dia == 1) ? 'al dia': 'a los';
$str_extra = ($dia == 1) ? '': 'dias';
$str_fecha_certificado =  $str_inicio.' '.$str_dia.' ('.$dia.') '.$str_extra.' del mes de '.$str_mes.' de '.$str_year.' ('.$year.').';


require_once SERVER.'/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'LEGAL-L']);
$html = '<div class="certificado" style="width:100%;text-align:center;">
<div class="content_certificado">
	<div class="content_img_main"><img class="img_main" src="'.IMG.'usuario/escudo_col.png" width="140" /></div>
	<h2>Plan de intervenciones colectivas</h2>
	<div class="content_element"><span class="sp_a" style="width:100%;">En cumplimiento de la ley 122 de 1992</span></div>
	<div class="content_element"><span class="sp_b" style="width:100%;">Hace constar que:</span></div>
	<div class="content_element"><span class="sp_nombre">'.$nombre_usuario.'</span></div>
	<div class="content_element"><span class="sp_cedula">Con Cedula de Ciudadania N° '.$identificacion.'</span></div>
	<div class="content_element"><span class="sp_c"  >Curso y aprobo la accion de formacion</span></div>
	<div class="content_element"><span class="sp_curso">'.$nombre_curso.'</span></div>
	<div class="content_element"><span class="sp_c">Con una duracion de 40 horas</span></div>
	<div class="content_element_d">En presente a lo anterior, se firma el presente en Pasto, '.$str_fecha_certificado.'</div>
	<div class="tabla no_color">
		<table>
			<tbody>
				<tr>
					<td class="center">
						<div class="block wrap_firmas">
							<img class="img_firma" src="'.IMG.'firma.jpg" width="100" />
							<div class="sp_firma_linea"  >________________________________</div>
							<div class="sp_firma_nombre"  >DIANA SOFIA BOLAÑOS GOMEZ</div>
							<div class="sp_firma_cargo"  >SUBDIRECTORA DE PIC</div>
						</div>
					</td>
					<td class="center">
						<div class="block wrap_firmas">
							<img class="img_firma" src="'.IMG.'firma.jpg" width="100" />
							<div class="sp_firma_linea">________________________________</div>
							<div class="sp_firma_nombre">DIANA SOFIA BOLAÑOS GOMEZ</div>
							<div class="sp_firma_cargo">SUBDIRECTORA DE PIC</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
</div>';
// $stylesheet = file_get_contents('style.css');
// $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$stylesheet = file_get_contents(CSS.'estilos_inicio.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
// $mpdf->Output(MULTIMEDIA_S.'informes/Programación de actividades de asistencia técnica.pdf','F');
$mpdf->Output('Certificado '.$nombre_curso.'.pdf','D');

header("Location: ".HOST."curso?id=$id_curso");
exit;
 
?>

