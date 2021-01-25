<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

require_once VIEWS.'templates/head.php';
?>

<?php
$experiencias = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main">
		<div class="contenido" id="elegir_producto">
			<div class="productos_content">
				<h2 class="s_titulo">Salud Ambiental</h2>
				<div class="img" onclick="window.location = '<?php echo HOST?>cuentos'">
					<h2 class="titulo">Cuentos</h2>
					<img src="<?php echo IMG?>default/fondo_salud2.jpg" />
				</div>
				<div class="img" onclick="window.location = '<?php echo HOST?>coplas'">
					<h2 class="titulo">Coplas</h2>
					<img src="<?php echo IMG?>default/fondo_salud2.jpg" />
				</div>
				<div class="img" onclick="window.location = '<?php echo HOST?>canciones'">
					<h2 class="titulo">Canciones</h2>
					<img src="<?php echo IMG?>default/fondo_salud2.jpg" />
				</div>
				<div class="img" onclick="window.location = '<?php echo HOST?>canciones'">
					<h2 class="titulo">Obras de teatro</h2>
					<img src="<?php echo IMG?>default/fondo_salud2.jpg" />
				</div>
				<!-- <div class="buttons_inline">
					<button onclick="window.location = '<?php echo HOST?>/actividades?id=e12312'" class="button">Volver Actividades</button>
					<button onclick="window.location = '<?php echo HOST?>/actividad?id=e12312'" class="button">Siguiente Actividad</button>
				</div> -->
			</div>
			<div id="theater" class="theater" data="">
				<div index="" class="indicador"></div>
				<div class="close"><i class="icon-cancelar"></i></div>
				<div index="" class="btn_left"><i class="icon-arrow-c"></i></div>
				<div index="" class="btn_right"><i class="icon-arrow-c"></i></div>
				<div class="theater_main">
					<div class="theater_content">
						<img index="0" src="" id="img_theater">
					</div>
				</div>
			</div>
		</div>
	</div>	
</main>
	
<?php 
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>