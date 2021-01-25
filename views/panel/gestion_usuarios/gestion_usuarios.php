<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'usuario.php';
session_start();
require_once LIBS."verificar_admin.php";

$estilos = ['estilos_panel.css','estilos_tablas.css','comp_modal.css','estilos_form.css'];
include VIEWS.'templates/head.php';
$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];


$obj_usuario = new Usuario();
$array = $obj_usuario->listar();

// var_dump($array);

?>

<main>
	<div class="panel" id="gestionar_usuarios">
		<?php
		$gestion_usuarios = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_busqueda_personas.php" id="buscar_personas">
				<h2 class="titulo_panel">Gestión de usuarios</h2>
				<?php if ($array !== False && $array !== Null) { ?>
				<div class="tabla">
					<table>
						<thead>
							<tr class="tr_sin_color">
								<th class="left" width="200">Nombres</th>
								<th width="120">Municipio</th>
								<th width="120">Documento</th>
								<th width="120">Usuario</th>
								<th width="120">Tipo usuario</th>
								<!-- <th width="135">Fecha registro</th> -->
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($array as $key => $row){ ?>
							<tr id="elemento_<?php echo $key ?>" class="parent_me_elemento" id_data="<?php echo $row->usuario?>" url_data="panel/gestion_usuarios/c_eliminar_usuario">
								<td class="left"><div class="ellipsis"><?php echo $row->nombres ?></div></td>
								<td class="left nowrap"><?php echo $row->municipio ?></td>
								<td class="left nowrap"><?php echo $row->identificacion ?></td>
								<td class="left nowrap"><?php echo $row->usuario ?></td>
								<td class="left nowrap"><?php echo $row->tipo_usuario ?></td>
								<!-- <td class="nowrap"><?php echo $row->fecha_reg ?></td> -->
								<td class="td_acciones">
									<div class="div_acciones">
										<a href="<?php echo HOST?>detalles_usuario?id=<?php echo $row->usuario?>" class="acciones"><i class="icon-filled-visible"></i><span class="icon_info">Ver</span></a>
										<a href="" class="acciones"><i class="icon-filled-user-block"></i><span class="icon_info">Bloquear</span></a>
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
				$obj_usuario->mostrarPaginas(5).'</div>';
				echo '</div>';
				echo '<div class="responsive_movil_on content_paginador">';
				$obj_usuario->mostrarPaginas(3);
				echo '</div>';
				}else{ ?>
				<div class="not_notificaciones">
					<span>No hay usuarios registrados.</span>
				</div>
				<?php } ?>
				<div class="content_button next">
					<button type="button" class="button" onclick="window.location = '<?php echo HOST?>agregar_usuario'"><i class="icon-lineal-add"></i>Agregar nuevo</button>
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