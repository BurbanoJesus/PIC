<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'municipio.php';
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css','comp_select.css','estilos_form.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];
$view = 'busqueda_informes';

$fecha_inicial = (isset($_GET['fecha_inicial'])) ? $_GET['fecha_inicial'].' 23:59:59' : '2020-01-01 23:59:59';
$fecha_final = (isset($_GET['fecha_final'])) ? $_GET['fecha_final'].' 23:59:59' : '2020-01-01 23:59:59';


$obj_municipio = new Municipio();
$array_municipio = $obj_municipio->listar();

// var_dump($_SESSION['ses_municipio']);

?>

<main>
	<div class="panel" id="busqueda_informes">
		<?php
		$busqueda_informes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php 
			include VIEWS.'templates/contenido_panel_h2.php';
			include VIEWS.'templates/form_municipio_panel.php'; 
			if ($_SESSION['ses_municipio'] != 'Elige Municipio') { 
			?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_busqueda_informes.php" id="form_busqueda_informes">
				<h2 class="titulo_panel">Busqueda PIC:</h2>
				<div class="content_busqueda">
					<div class="busqueda">
						<input class="input" name="busqueda" type="text" placeholder="Buscar informes o archivos..." />
						<i class="icon-filled-lupa"></i>
					</div>
				</div>
				<div class="separador"></div>
				<div class="content_carpetas">
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?grupo=presentacion equipo pic'">
						<i class="icon-filled-folder"></i>
						<span>Presentación Equipo PIC</span>
					</div>
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?id=lkuy'">
						<i class="icon-filled-folder"></i>
						<span>Fortalecimiento a Redes</span>
					</div>
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?id=lkuy'">
						<i class="icon-filled-folder"></i>
						<span>Talleres Movilización Social</span>
					</div>
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?id=lkuy'">
						<i class="icon-filled-folder"></i>
						<span>Réplicas</span>
					</div>
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?id=lkuy'">
						<i class="icon-filled-folder"></i>
						<span>Eventos</span>
					</div>
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?id=lkuy'">
						<i class="icon-filled-folder"></i>
						<span>Participación Ciudadana</span>
					</div>
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?id=lkuy'">
						<i class="icon-filled-folder"></i>
						<span>Producto Educomunicativo</span>
					</div>
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?id=lkuy'">
						<i class="icon-filled-folder"></i>
						<span>Informes</span>
					</div>
					<div class="carpeta" onclick="window.location = '<?php echo HOST?>lista_archivos?id=lkuy'">
						<i class="icon-filled-folder"></i>
						<span>Reunión Cierre municipio</span>
					</div>
				</div>
			</form>
			<?php } ?>
		</div>
	</div>
</main>
<?php
$scripts = ['comp_select.js'];
include VIEWS.'templates/foot.php'; 
?>