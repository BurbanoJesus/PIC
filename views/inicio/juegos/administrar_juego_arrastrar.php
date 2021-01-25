<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'juego_arrastrar.php';
session_start();
require_once LIBS.'verificar_admin.php';

$estilos = ['estilos_inicio.css','estilos_tablas.css','comp_modal.css'];
require_once VIEWS.'templates/head.php';

$obj_juego_arrastrar = new Juego_arrastrar();
$array = $obj_juego_arrastrar->listar_all();

$juegos = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main">
		<div class="contenido relative" id="juegos">
			<div class="volver" onclick="window.location = '<?php echo HOST?>juegos'">
				<i class="icon-lineal-flecha volver"></i>
			</div>
			<h2 class="titulo">Listado Juego Colocar Respuestas</h2>
			<div class="tabla">
				<table>
					<thead>
						<tr class="tr_sin_color">
							<th width="50">#</th>
							<th class="left">Nombre</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($array !== Null){
						foreach ($array as $key => $row){ 
						?>
						<tr class="parent_me_elemento" id="s<?php echo $key ?>" id_data="<?php echo $row->id_juego ?>" url_data="inicio/juegos/c_eliminar_juego_arrastrar">
							<td class="center"><?php echo $key + 1 ?></td>
							<td class="left"><div class="ellipsis"><?php echo $row->enunciado ?></div></td>
							<td class="td_acciones">
								<div class="div_acciones">
									<a href="<?php echo HOST?>editar_juego_arrastrar?id_juego=<?php echo $row->id_juego ?>" class="acciones"><i class="icon-filled-editar" ></i><span class="icon_info">Editar</span></a>
									<div class="acciones me_eliminar"><i class="icon-filled-eliminar-b"></i><span class="icon_info">Eliminar</span></div>
								</div>
							</td>
						</tr>
						<?php }
						} ?>
					</tbody>
				</table>
			</div>
			<?php 
			echo '<div class="responsive_movil_off content_paginador">';
			$obj_juego_arrastrar->mostrarPaginas(5).'</div>';
			echo '</div>';
			echo '<div class="responsive_movil_on content_paginador">';
			$obj_juego_arrastrar->mostrarPaginas(3);
			echo '</div>';
			?>
			<div id="div_mod_eliminar"></div>
		</div>
	</div>	
</main>

<?php
$scripts = ['comp_modal.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>