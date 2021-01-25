<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'producto.php';
session_start();
require_once LIBS."verificar_admin.php";

$estilos = ['estilos_panel.css','estilos_tablas.css','comp_modal.css','estilos_form.css'];
include VIEWS.'templates/head.php';
$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];


$obj_producto = new Producto();
$array = $obj_producto->listar();

?>

<main>
	<div class="panel" id="gestionar_productos">
		<?php
		$gestion_productos = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_gestionar_productos.php" id="form_gestionar_productos">
				<h2 class="titulo_panel">Gestión de Productos</h2>
				<?php if ($array !== False && $array !== Null) { ?>
				<div class="tabla">
					<table>
						<thead>
							<tr class="tr_sin_color">
								<th width="140">Fecha registro</th>
								<th class="left">Tipo</th>
								<th class="left">Titulo</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach ($array as $key => $row){ 
							$fecha = to_fecha_simp_str($row->fecha_pub);
							?>
							<tr id="elemento_<?php echo $key ?>" class="parent_me_elemento" id_data="<?php echo $row->id_producto?>" url_data="panel/gestion_productos/c_eliminar_producto">
								<td class="nowrap"><?php echo $fecha ?></td>
								<td class="left"><div class="ellipsis"><?php echo $row->tipo_producto ?></div></td>
								<td class="nowrap left"><?php echo $row->titulo ?></td>
								<td class="td_acciones">
									<div class="div_acciones">
										<a href="<?php echo HOST?>detalles_producto?id=<?php echo $row->id_producto?>" class="acciones">
											<i class="icon-filled-visible" ></i>
											<span class="icon_info">Ver</span>
										</a>
										<div class="acciones"><i class="icon-filled-eliminar-b me_eliminar"></i><span class="icon_info">Eliminar</span></div>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<?php 
				echo '<div class="responsive_movil_off content_paginador">';
				$obj_producto->mostrarPaginas(5).'</div>';
				echo '</div>';
				echo '<div class="responsive_movil_on content_paginador">';
				$obj_producto->mostrarPaginas(3);
				echo '</div>';
				}else{ ?>
				<div class="not_notificaciones">
					<span>No hay productos registrados.</span>
				</div>
				<?php } ?>
				<div class="content_button next">
					<button type="button" class="button" onclick="window.location = '<?php echo HOST?>agregar_producto'"><i class="icon-lineal-add"></i>Agregar nuevo</button>
				</div>
			</form>
		</div>
		<div id="div_mod_eliminar"></div>
	</div>
</main>
<?php
$scripts = ['comp_modal.js'];
include VIEWS.'templates/foot.php'; 
?>