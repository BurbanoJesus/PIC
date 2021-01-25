<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_inicio.css'];
require_once VIEWS.'templates/head.php';

$aprende = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main">
		<div class="contenido" id="aprende">
			<?php 
			require_once LIBS.'verificar_sesion.php'; 
			if ($flag_session=== False){
			?>
			<form action="" class="form">
				<div class="wrap_estructura">
					<div class="logo">
						<<img src="<?php echo IMG?>mingas_logo_b.png" />
						<h2 class="h2_logo">Tipo de cursos</h2>
					</div>
					<div class="subtitulo">
						<!-- <span class="t">Transversal</span>
						<span class="p">Prioritarias</span>
						<span class="t">Transversal</span> -->
					</div>
					<div class="opciones_dimensiones">
						<a class="enlace_estructura_v" href="<?php echo HOST?>cursos?dimension=Autoridad Sanitaria"><span>Autoridad Sanitaria</span></a>
						<div class="opciones_estructura">
							<a class="enlace_estructura a first" href="<?php echo HOST?>cursos?dimension=Salud Ambiental">Salud Ambiental</a>
							<a class="enlace_estructura b" href="<?php echo HOST?>cursos?dimension=Vida saludable y condiciones no transmisibles">Vida saludable y condiciones no transmisibles</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>cursos?dimension=Convivencia social y salud mental">Convivencia social y salud mental</a>
							<a class="enlace_estructura b" href="<?php echo HOST?>cursos?dimension=Seguridad alimentaria y nutricional">Seguridad alimentaria y nutricional</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>cursos?dimension=Sexualidad y derechos sexuales y reproductivo">Sexualidad y derechos sexuales y reproductivo</a>
							<a class="enlace_estructura b" href="<?php echo HOST?>cursos?dimension=Vida saludable y enfermedades  Transmisibles">Vida saludable y enfermedades  Transmisibles</a>
							<a class="enlace_estructura a" href="<?php echo HOST?>cursos?dimension=Salud en emergencias y desastres">Salud en emergencias y desastres</a>
							<a class="enlace_estructura b last" href="<?php echo HOST?>cursos?dimension=Salud y ámbito laboral">Salud y ámbito laboral</a>
						</div>
						<a class="enlace_estructura_v right" href="<?php echo HOST?>cursos?dimension=Poblaciones de mayor vulnerabilidad"><span>Poblaciones de mayor vulnerabilidad</span></a>
					</div>
					<!-- <div class="logo">
						<h1 class="h1_logo">Dimensiones transversales</h1>
					</div>
					<div class="opciones_estructura">
						<a class="enlace_estructura c" href="<?php echo HOST?>panel">Autoridad Sanitaria</a>
						<a class="enlace_estructura d" href="<?php echo HOST?>panel">Poblaciones de mayor vulnerabilidad</a>
					</div> -->
				</div>
			</form>
			<?php } ?>
		</div>
	</div>	
</main>
<?php
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>