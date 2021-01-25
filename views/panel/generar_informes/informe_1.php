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
	<div class="panel" id="informe_1">
		<?php
		$busqueda_reportes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel informes">
			<?php $titulo = 'Procedimiento PIC'; $opcion = $volver = 'opciones_informes?opcion='.$opcion; include VIEWS.'templates/contenido_informe_h1.php' ?>
			<form class="form s100 informes" method="POST" action="<?php echo CONTROLLERS?>panel/generar_informes/c_informe_1.php" id="form_informe_1">
				<div class="workspace">
					<div class="content_informe" id="content_informe_1">
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
					</div>
				</div>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-pdf"></i>Generar</button>
				</div>
			</form>
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/foot.php'; 
?>