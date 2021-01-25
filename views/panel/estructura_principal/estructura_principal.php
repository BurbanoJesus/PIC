<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'municipio.php';
require MODELS.'usuario.php';
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css'];
include VIEWS.'templates/head.php';

$obj_municipio = new Municipio();
$array_municipio = $obj_municipio->listar();

?>
<main>
	<div class="main">
		<div class="estructura">
			<form id="form_estructura" class="absolute" action="<?php echo CONTROLLERS?>panel/c_estructura.php" method="POST">
				<!-- <div class="relieve"></div> -->
				<div class="div_h2_fill">
					<h2 class="h2_fill">ESTRUCTURA DEL PLAN DECENAL DE SALUD PÚBLICA</h2>
					<!-- <img class="absolute" src="<?php echo IMG?>logo_ins3.png" alt="" /> -->
					<!-- <img class="absolute r" src="<?php echo IMG?>logo_ins3.png" alt="" /> -->
					<!-- <img class="absolute" src="<?php echo IMG?>instituto_logo.png" alt=""> -->
				</div>
				<!-- <div class="volver" onclick="window.location = '<?php echo HOST?>seleccionar_fecha'">
					<i class="icon-lineal-flecha volver"></i>
				</div> -->
				<div class="wrap_estructura">
					<div class="logo">
						<img src="<?php echo IMG?>mingas_logo_b.png" />
						<h2 class="h2_logo">Dimensiones</h2>
					</div>
					<div class="subtitulo">
						<span class="t">Transversal</span>
						<span class="p">Prioritarias</span>
						<span class="t">Transversal</span>
					</div>
					<div class="opciones_dimensiones">
						<a class="enlace_estructura_v" href="<?php echo HOST?>tecnologias?dimension=Autoridad Sanitaria"><span>Autoridad Sanitaria</span></a>
						<div class="opciones_estructura">
							<a class="enlace_estructura a first" href="<?php echo HOST?>tecnologias?dimension=Salud Ambiental">Salud Ambiental</a>
							<a class="enlace_estructura b" href="<?php echo HOST?>tecnologias?dimension=Vida saludable y condiciones no transmisibles">Vida saludable y condiciones no transmisibles</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>tecnologias?dimension=Convivencia social y salud mental">Convivencia social y salud mental</a>
							<a class="enlace_estructura b" href="<?php echo HOST?>tecnologias?dimension=Seguridad alimentaria y nutricional">Seguridad alimentaria y nutricional</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>tecnologias?dimension=Sexualidad y derechos sexuales y reproductivo">Sexualidad y derechos sexuales y reproductivo</a>
							<a class="enlace_estructura b" href="<?php echo HOST?>tecnologias?dimension=Vida saludable y enfermedades  Transmisibles">Vida saludable y enfermedades  Transmisibles</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>tecnologias?dimension=Salud en emergencias y desastres">Salud en emergencias y desastres</a>
							<a class="enlace_estructura b last" href="<?php echo HOST?>tecnologias?dimension=Salud y ámbito laboral">Salud y ámbito laboral</a>
						</div>
						<a class="enlace_estructura_v right" href="<?php echo HOST?>tecnologias?dimension=Poblaciones de mayor vulnerabilidad"><span>Poblaciones de mayor vulnerabilidad</span></a>
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