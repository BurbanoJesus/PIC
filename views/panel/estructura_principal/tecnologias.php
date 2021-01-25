<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css'];
include VIEWS.'templates/head.php';

$dimension = isset($_GET['dimension']) ? $_GET['dimension']: '';

$array_dim = ['Salud Ambiental','Vida saludable y condiciones no transmisibles','Convivencia social y salud mental','Seguridad alimentaria y nutricional','Sexualidad y derechos sexuales y reproductivo','Vida saludable y enfermedades  Transmisibles','Salud en emergencias y desastres','Salud y ámbito laboral','Autoridad Sanitaria','Poblaciones de mayor vulnerabilidad'];

if (!in_array($dimension, $array_dim)){
	header("Location: ".HOST."estructura_principal");
	exit;
}

$_SESSION['ses_dimension'] = $dimension;

?>
<main>
	<div class="main">
		<div class="estructura">
			<form id="form_estructura" class="absolute" action="<?php echo CONTROLLERS?>panel/c_estructura.php" method="POST">
				<!-- <div class="relieve"></div> -->
				<div class="div_h2_fill">
					<h2 class="h2_fill">PLAN DE INTERVENCIONES COLECTIVAS</h2>
					<!-- <img class="absolute" src="<?php echo IMG?>logo_ins3.png" alt="" /> -->
					<!-- <img class="absolute r" src="<?php echo IMG?>logo_ins3.png" alt="" /> -->
					<!-- <img class="absolute" src="<?php echo IMG?>instituto_logo.png" alt=""> -->
				</div>
				<div class="volver" onclick="window.location = '<?php echo HOST?>estructura_principal'">
					<i class="icon-lineal-flecha volver"></i>
				</div>
				<div class="wrap_estructura">
					<div class="opciones_dimensiones tecnologias">
						<div class="opciones_estructura tecnologias">
							<a class="enlace_estructura a" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Caracterización social y ambiental del entorno">
								<!-- <i class="icon-filled-check estado"></i> -->
								Caracterización social y ambiental del entorno
							</a>
							<a class="enlace_estructura e" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Información en salud">Información en salud</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Educación para la salud">Educación para la salud</a>
							<a class="enlace_estructura e" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Tamizajes">Tamizajes</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Rehabilitación  Basada en Comunidad">Rehabilitación  Basada en Comunidad</a>
							<a class="enlace_estructura e" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Prevención y Control de Vectores (Obligatorias en zonas endémicas)">Prevención y Control de Vectores (Obligatorias en zonas endémicas)</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Adquisición y suministro de Medicamentos o insumos de uso masivo para la prevención y control o eliminación de interés en salud pública">Adquisición y suministro de Medicamentos o insumos de uso masivo para la prevención y control o eliminación de interés en salud pública</a>
							<a class="enlace_estructura e" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Vacunación antirrábica">Vacunación antirrábica</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Zonas de orientación y centros de escucha">Zonas de orientación y centros de escucha</a>
							<a class="enlace_estructura e" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Conformación y fortalecimiento de redes familiares, comunitarias y sociales">Conformación y fortalecimiento de redes familiares, comunitarias y sociales</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Jornadas de salud">Jornadas de salud</a>
							<a class="enlace_estructura e last" href="<?php echo HOST?>seleccionar_fecha?tecnologia=Centros de escucha Comunitarios">Centros de escucha Comunitarios</a>
						</div>
					</div>
					<!-- <div class="logo">
						<h2 class="h2_logo">Dimensiones transversales</h2>
					</div>
					<div class="opciones_estructura">
						<a class="enlace_estructura c" href="<?php echo HOST?>panel">Autoridad Sanitaria</a>
						<a class="enlace_estructura d" href="<?php echo HOST?>panel">Poblaciones de mayor vulnerabilidad</a>
					</div> -->
				</div>
			</form>
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/foot.php'; 
?>