<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'notificacion.php';
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

$id = (isset($_GET['id'])) ? $_GET['id'] : '';

$obj_notificacion = new Notificacion();

$row = $obj_notificacion->detalles($id);

// var_dump($row);

?>

<main>
	<div class="panel" id="detalles_notificacion">
		<?php
		$notificaciones = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php $volver = 'notificaciones'; include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_busqueda_reportes.php" id="busqueda_reportes">
				<h2 class="titulo_panel">Detalles notificación</h2>
				<div class="separador"></div>
				<div class="content_detalles">
					<div class="info_detalles">
						<div class="nombre_detalles">
							<i class="icon-filled-notificacion-c main"></i>
							<span class="main"><?php echo $row->descripcion ?></span>
						</div>
						<div class="lista_detalles">
							<?php if ($row->tipo_notificacion == 'informe') { ?>
							<div class="opcion">
								<span class="info_label">Usuario Creador</span>
								<span class="info"><?php echo $row->usuario ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Nombre archivo</span>
								<?php  
								$tipo_icon = ext_multimedia($row->url_informe);
								$nombre = name_url($row->url_informe);
								?>
								<span class="info link" onclick="window.location = '<?php echo HOST?>detalles_informe?id=<?php echo $row->id_destino ?>'">
									<?php echo $nombre ?>
								</span>
							</div>
							<?php } ?>
							<?php if ($row->tipo_notificacion == 'usuario') { ?>
							<div class="opcion">
								<span class="info_label">Usuario</span>
								<span class="info"><?php echo $row->usuario ?></span>
							</div>
							<?php } ?>
							<div class="opcion">
								<span class="info_label">Municipio</span>
								<span class="info"><?php echo $row->municipio ?></span>
							</div>
							<div class="opcion last">
								<span class="info_label">Fecha</span>
								<?php $fecha = to_fecha_str($row->fecha) ?>
								<?php $hora = to_hora_str($row->fecha) ?>
								<span class="info"><?php echo $fecha.' '.$hora ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="content_button next">
					<button type="button" class="button inline" onclick="window.location = '<?php echo HOST?>notificaciones?id=lkuy'" download><i class="icon-arrow-b volver"></i>Regresar</button>
				</div>
			</form>
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/foot.php'; 
?>