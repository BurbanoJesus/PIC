<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css','comp_select.css'];
include VIEWS.'templates/head.php';

$tecnologia = isset($_GET['tecnologia']) ? $_GET['tecnologia']: '';

$array_tec = ['Caracterización social y ambiental del entorno','Información en salud','Educación para la salud','Tamizajes','Rehabilitación  Basada en Comunidad','Prevención y Control de Vectores (Obligatorias en zonas endémicas)','Adquisición y suministro de Medicamentos o insumos de uso masivo para la prevención y control o eliminación de interés en salud pública','Vacunación antirrábica','Zonas de orientación y centros de escucha','Conformación y fortalecimiento de redes familiares, comunitarias y sociales','Jornadas de salud','Centros de escucha Comunitarios'];
if (!in_array($tecnologia, $array_tec)){
	header("Location: ".HOST."tecnologias");
	exit;
}
$_SESSION['ses_tecnologia'] = $tecnologia;

?>
<main>
	<div class="main">
		<div class="estructura">
			<form id="form_estructura" class="absolute" action="<?php echo CONTROLLERS?>panel/estructura_principal/c_seleccionar_fecha.php" method="POST">
				<!-- <div class="relieve"></div> -->
				<div class="div_h2_fill">
					<h2 class="h2_fill">PLAN DE INTERVENCIONES COLECTIVAS</h2>
				</div>
				<div class="volver" onclick="window.location = '<?php echo HOST?>tecnologias?dimension=<?php echo $_SESSION['ses_dimension'] ?>'">
					<i class="icon-lineal-flecha volver"></i>
				</div>
				<div class="wrap_estructura">
					<div class="logo">
						<img src="<?php echo IMG?>mingas_logo_b.png" />
						<h2 class="h2_logo">PIC</h2>
					</div>
					<div class="input">
						<h3 class="h3_input">Elige el Año.</h3>
						<div class="select" id="municipio" data="">
							<div class="head_select">
								<span class="nombre_select">Seleccione Año</span>
								<i class="icon-arrow"></i>
							</div>
							<div class="opciones">
								<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span>2014</span></div>
								<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span>2015</span></div>
								<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span>2016</span></div>
								<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span>2017</span></div>
								<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span>2018</span></div>
								<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span>2019</span></div>
								<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span>2020</span></div>
								<!-- <div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span>2021</span></div> -->
							</div>
							<input type="hidden" name="year" value="" />
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</main>
<?php
$scripts = ['comp_select.js'];
include VIEWS.'templates/foot.php'; 
?>