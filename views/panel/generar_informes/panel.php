<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'municipio.php';
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css','comp_select.css','estilos_form.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$view = 'panel';
// unset($_SESSION['ses_municipio']);
switch (True) {
	case ($tipo_usuario == 'administrador'):
		$_SESSION['str_logo'] = 'ADMINISTRADOR';
		$_SESSION['str_h1'] = 'Administrador';
		$_SESSION['ses_municipio'] = (isset($_SESSION['ses_municipio'])) ?  $_SESSION['ses_municipio'] : 'Elige Municipio';
		break;

	case ($tipo_usuario == 'supervisor'):
		$_SESSION['str_logo'] = 'SUPERVISOR';
		$_SESSION['str_h1'] = 'Municipio de '.ucfirst($municipio);
		$_SESSION['ses_municipio'] = (isset($_SESSION['ses_municipio'])) ?  $_SESSION['ses_municipio'] : 'Elige Municipio';
		break;
	
	case ($tipo_usuario == 'generador'):
		$_SESSION['str_h1'] = 'Municipio de '.ucfirst($municipio);
		$_SESSION['str_logo'] = strtoupper($municipio);
		$_SESSION['ses_municipio'] = $_SESSION['usuario']->municipio;
		break;

	default:
	break;
}

?>

<main>
	<div class="panel">
		<?php
		$generar_informes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php 
			include VIEWS.'templates/contenido_panel_h2.php';
			include VIEWS.'templates/form_municipio_panel.php'; 
			if ($_SESSION['ses_municipio'] != 'Elige Municipio') {
			if ($tipo_usuario == 'generador' || $tipo_usuario == 'administrador'){
			?>
			<?php if (isset($_SESSION['ses_dimension'])){ ?>
			<div class="parametros">
				<div class="dimension"><span class="a">Dimension: </span><span class="b"><?php echo $_SESSION['ses_dimension'] ?></span></div>
				<div class="tecnologia"><span class="a">Tecnologia: </span><span class="b"><?php echo $_SESSION['ses_tecnologia'] ?></span></div>
				<div class="year"><span class="a">Año: </span><span class="b"><?php echo $_SESSION['ses_year'] ?></span></div>
			</div>
			<?php } ?>
			<div class="tarjetas">
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Presentación Equipo PIC'">
					<img src="<?php echo IMG?>panel/panel1.png">
					<h2>Presentación Equipo PIC</h2>
					<h3>Explorar las utilidades de la sección de presentación Equipo PIC</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Fortalecimiento a Redes'">
					<img src="<?php echo IMG?>panel/panel2.png">
					<h2>Fortalecimiento a Redes</h2>
					<h3>Explorar las utilidades de la sección de fortalecimiento a redes</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Talleres Movilización Social'">
					<img src="<?php echo IMG?>panel/panel3.png">
					<h2>Talleres Movilización Social</h2>
					<h3>Explorar las utilidades de la sección de talleres movilización social</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Réplicas'">
					<img src="<?php echo IMG?>panel/panel4.png">
					<h2>Réplicas</h2>
					<h3>Explorar las utilidades de la sección de réplicas</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Eventos'">
					<img src="<?php echo IMG?>panel/panel5.png">
					<h2>Eventos</h2>
					<h3>Explorar las utilidades de la sección de eventos</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Participación Ciudadana'">
					<img src="<?php echo IMG?>panel/panel6.png">
					<h2>Participación Ciudadana</h2>
					<h3>Explorar las utilidades de la sección de participación ciudadana</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Producto Educomunicativo'">
					<img src="<?php echo IMG?>panel/panel7.png">
					<h2>Producto Educomunicativo</h2>
					<h3>Explorar las utilidades de la sección de producto educomunicativo</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Informes'">
					<img src="<?php echo IMG?>panel/panel8.png">
					<h2>Informes</h2>
					<h3>Explorar las utilidades de la sección de informes</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Reunión Cierre municipio'">
					<img src="<?php echo IMG?>panel/panel9.png">
					<h2>Reunión Cierre municipio</h2>
					<h3>Explorar las utilidades de la sección de reunión cierre municipio</h3>
				</div>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Graficas'">
					<img src="<?php echo IMG?>panel/panel10.png">
					<h2>Graficas</h2>
					<h3>Explorar las utilidades de la sección de graficas</h3>
				</div>
				<?php }else{?>
				<div class="elemento" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=Informe de Generador'">
					<img src="<?php echo IMG?>panel/panel10.png">
					<h2>Informe de Generador</h2>
					<h3>Generar informe de evalucacion del municipio de <?php echo ucfirst($_SESSION['ses_municipio']) ?></h3>
				</div>
			</div>
			<?php }
			} ?>
		</div>
	</div>
</main>
<?php 
$scripts = ['comp_select.js'];
include VIEWS.'templates/foot.php'; 
?>