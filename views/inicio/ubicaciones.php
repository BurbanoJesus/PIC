<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_inicio.css','comp_modal.css','comp_slider.css','estilos_tablas.css'];
include VIEWS.'templates/head.php';

$ubicaciones = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main" id="ubicaciones">
		<div class="contenido slide_move">
			<div class="informacion">
				<h2 class="h2_informacion">Ubicaciones PIC</h2>
				<p class="p_info">Haz clic en los nombres de los marcadores que aparecen en el mapa</p>
				<div class="maps">
					<div id="map" style="height: 800px;"></div>
				</div>
			</div>
			<div id="theater" class="theater" data="">
				<div index="" class="indicador"></div>
				<div class="close"><i class="icon-cancelar"></i></div>
				<div index="" class="btn_left"><i class="icon-arrow-c"></i></div>
				<div index="" class="btn_right"><i class="icon-arrow-c"></i></div>
				<div class="theater_main">
					<div class="theater_content">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php 
$scripts = ['https://maps.googleapis.com/maps/api/js?key=AIzaSyChPpLC5zuF6bKJYUb7Br2-geN5UvbxBC4','mapas.js','comp_modal.js','comp_slider.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>