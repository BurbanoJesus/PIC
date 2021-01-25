<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_inicio.css'];
include VIEWS.'templates/head.php';

$url_redirect = (isset($_GET['url_redirect'])) ? $_GET['url_redirect'] : HOST.'inicio';
$active = (isset($_GET['active'])) ? $_GET['active'] : 'aprende';
$nota = (isset($_GET['active'])) ? $_GET['nota'] : '4';

${$active} = 'active';
include VIEWS.'templates/header.php';
?>

<main>
	<div class="main" id="resultados_examenes">
		<div class="contenido">
			<?php
			require_once LIBS.'verificar_sesion.php';
			?>
			<?php if ($nota > 5){ ?>
			<div class="success">
				<span class="resultados_titulo">Resultados Examen</span>
				<div class="aprobado">
					<!-- <i class="icon-lineal-check"></i> -->
					<img src="<?php echo IMG ?>default/aprobado.png" alt="">
					<span>Aprobado</span>
				</div>
				<span class="nota">Nota: <?php echo $nota ?>/10</span>
				<div class="content_button next">
					<button onclick="javascript:window.location ='<?php echo $url_redirect?>'" type="button" class="button">Aceptar</button>
				</div>
			</div>
			<?php }else{ ?>
			<div class="success no_aprobado">
				<span class="resultados_titulo">Resultados Examen</span>
				<div class="aprobado">
					<!-- <i class="icon-filled-no-check"></i> -->
					<img src="<?php echo IMG ?>default/reprobado.png" alt="">
					<span>Reprobado</span>
				</div>
				<span class="nota">Nota: <?php echo $nota ?>/10</span>
				<div class="content_button next">
					<button onclick="javascript:window.location ='<?php echo $url_redirect?>'" type="button" class="button">Aceptar</button>
				</div>
			</div>
			<?php } ?>
			<!-- <div class="error">
				<i class="icon-filled-no-check"></i>
				<span>Ha Ocurrido Un Error Intentelo de Nuevo</span>
				<div class="button siguiente">
					<button type="submit" class="button">Aceptar</button>
				</div>
			</div> -->
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>