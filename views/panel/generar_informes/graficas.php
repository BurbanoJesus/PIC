<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_panel.css','estilos_informes.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];


$fecha_inicial = (isset($_GET['fecha_inicial'])) ? $_GET['fecha_inicial'].' 23:59:59' : '2020-01-01 23:59:59';
$fecha_final = (isset($_GET['fecha_final'])) ? $_GET['fecha_final'].' 23:59:59' : '2020-01-01 23:59:59';


$array = false;


?>

<main>
	<div class="panel">
		<?php
		$generar_informes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php $volver = 'opciones_informes'; include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_lista_archivos.php" id="busqueda_reportes">
				<h2 class="titulo_panel">Grafica 1:</h2>
				<div class="content_grafica" style="width: 90%;">
					<canvas id="myChart" width="350px" height="200px"></canvas>
				</div>
			</form>
		</div>
	</div>
</main>
<?php
$scripts = ['Chart.js','graficas.js'];
include VIEWS.'templates/foot.php'; 
?>