<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_inicio.css'];
require_once VIEWS.'templates/head.php';
?>

<?php
$quienes = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main">
		<div class="contenido" id="quienes_somos">
			<div class="img">
				<!-- <h2 class="titulo">Quienes Somos</h2> -->
				<img index="0" src="<?php echo IMG?>default/logo_b.png" target="theater" class="call_theater simple" />
			</div>
			<h2 class="titulo">Quienes Somos</h2>
			<div class="info_about">
				<h2>Mision</h2>
				<p>depende de la actividad que la organización realice, así como del entorno en el que se encuentra y de los recursos de los que dispone. Si se trata de una empresa, la misión dependerá del tipo de negocio del que se trate, de las necesidades de la población en ese momento dado y la situación del mercado.</p>
			</div>
			<div class="info_about">
				<h2>Vision</h2>
				<p>se refiere a una imagen que la organización plantea a largo plazo sobre cómo espera que sea su futuro, una expectativa ideal de lo que espera que ocurra. La visión debe ser realista pero puede ser ambiciosa, su función es guiar y motivar al grupo para continuar con el trabajo.</p>
			</div>
			<div class="info_about">
				<h2>Indicadores</h2>
				<div class="lista_numeros">
					<p><b>1.</b> Se utilizan para realizar el monitoreo de los procesos, de los insumos y de las actividades.</p>
					<p><b>2.</b> Se utilizan para realizar el monitoreo de los procesos.</p>
					<p><b>3.</b> Se utilizan para realizar el monitoreo de los procesos, de los insumos.</p>
				</div>
			</div>
			<div class="info_about">
				<h2>Metas</h2>
				<p>se refiere a una imagen que la organización plantea a largo plazo sobre cómo espera que sea su futuro, una expectativa ideal de lo que espera que ocurra. La visión debe ser realista pero puede ser ambiciosa, su función es guiar y motivar al grupo para continuar con el trabajo.</p>
			</div>
			<div class="info_about">
				<h2>Objetivos</h2>
				<div class="lista_ul">
					<p>se refiere a una imagen que la organización plantea a largo plazo sobre cómo espera que sea su futuro, una expectativa ideal de lo que espera que ocurra.</p>
					<p>se refiere a una imagen que la organización plantea a largo plazo sobre cómo espera que sea su futuro, una expectativa ideal de lo que espera que ocurra.</p>
					<p>se refiere a una imagen que la organización plantea a largo plazo sobre cómo espera que sea su futuro, una expectativa ideal de lo que espera que ocurra.</p>
				</div>
			</div>
			<div class="info_about">
				<h2>Resultados Esperados</h2>
				<p>se refiere a una imagen que la organización plantea a largo plazo sobre cómo espera que sea su futuro, una expectativa ideal de lo que espera que ocurra. La visión debe ser realista pero puede ser ambiciosa, su función es guiar y motivar al grupo para continuar con el trabajo.</p>
			</div>
		</div>
	</div>
</main>
	
<?php 
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>