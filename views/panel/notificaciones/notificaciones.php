<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'notificacion.php';
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css','estilos_tablas.css','estilos_form.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

$obj_notificacion = new Notificacion();
$array = $obj_notificacion->listar();

// var_dump($array);
?>

<main>
	<div class="panel" id="notificaciones">
		<?php
		$notificaciones = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_notificaciones.php" id="form_notificaciones">
				<h2 class="titulo_panel">Notificaciónes</h2>
				<?php if ($array !== False && $array !== Null) { ?>
				<div class="tabla">
					<table>
						<thead>
							<tr class="tr_sin_color">
								<th width="120">Fecha</th>
								<th width="90">Usuario</th>
								<th width="90">Tipo</th>
								<th class="left">Descripción</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($array as $key => $row){ 
							?>
							<tr>
								<td class="left nowrap">
									<div class="td_icon">
										<i class="icon-filled-correo"></i>
										<?php $date_ago = date_ago($row->fecha) ?>
										<span><?php echo $date_ago ?></span>
									</div>
								</td>
								<td class="nowrap"><?php echo $row->usuario ?></td>
								<td class="nowrap"><?php echo $row->tipo_usuario ?></td>
								<td class="left">
									<div class="td_icon">
										<i class="icon-filled-pdf"></i>
										<div class="ellipsis"><span><?php echo $row->descripcion ?></span></div>
									</div>
								</td>
								<td class="td_acciones">
									<div class="div_acciones">
										<a href="<?php echo HOST?>detalles_notificacion?id=<?php echo $row->id_notificacion ?>" class="acciones"><i class="icon-filled-visible"></i><span class="icon_info">Ver Detalles</span></a>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<?php 
				echo '<div class="responsive_movil_off content_paginador">';
				$obj_notificacion->mostrarPaginas(5).'</div>';
				echo '</div>';
				echo '<div class="responsive_movil_on content_paginador">';
				$obj_notificacion->mostrarPaginas(3);
				echo '</div>';
				}else{ ?>
				<div class="not_notificaciones">
					<span>No hay notificaciones nuevas.</span>
				</div>
				<?php } ?>
			</form>
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/foot.php'; 
?>