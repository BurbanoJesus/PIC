<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'usuario.php';
require_once MODELS.'modulo.php';
require_once MODELS.'actividad.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_tablas.css','comp_modal.css'];
require_once VIEWS.'templates/head.php';



$id_modulo = $_GET['id'];

$obj_modulo = new Modulo();
$row_modulo = $obj_modulo->detalles_actividad($id_modulo);
$arr_modulos = $obj_modulo->listar($row_modulo->id_curso);

$obj_actividad = new Actividad();
$array = $obj_actividad->listar($id_modulo);

$obj_usuario = new Usuario();
$id_curso = $row_modulo->id_curso;
$subs = $obj_usuario->comprobar_suscripcion($id_curso);
$arr_usuario_progreso = $obj_usuario->listar_progreso_modulos($id_curso);

$next_indice = 0;
// var_dump($arr_modulos);
if (count($arr_modulos) > 1){
	$arr_lista_modulos = [];
	foreach ($arr_modulos as $key => $row) {
		array_push($arr_lista_modulos, $row->id_modulo);
	}
	$indice = array_search($id_modulo, $arr_lista_modulos);
	$next_indice = (count($arr_lista_modulos) - 1 > $indice) ? $indice + 1 : 0;
	$next_modulo = $arr_lista_modulos[$next_indice];
}

if ($arr_usuario_progreso != False){
	$arr_act_completas = [];
	foreach ($arr_usuario_progreso as $key => $row) {
		array_push($arr_act_completas, $row->id_actividad);
	}
}

$aprende = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main" id="actividades">
		<div class="contenido">
			<?php
			require_once LIBS.'verificar_sesion.php';
			$object = $array;
			require_once LIBS.'empty.php';
			if ($flag_empty === False){ ?>
			<div class="informacion last">
				<div class="indice">
					<i class="icon-arrow-c"></i>
					<span class="nav_modulo" onclick="window.location = '<?php echo HOST?>curso?id=<?php echo $row_modulo->id_curso ?>'">Modulo: <?php echo $row_modulo->nombre_modulo ?></span>
				</div>
				<h2 class="titulo">Actividades</h2>
				<div class="lista_actividades">
					<div class="tabla no_color">
						<table>
							<tbody>
								<?php 
								if ($array !== False) {
								foreach ($array as $key => $row){
								$actividad = ($row->tipo_actividad == 'general') ? HOST."actividad?id=$row->id_actividad" :  HOST."examen?id=$row->id_actividad";
								?>
								<tr class="parent_me_elemento" id="s<?php echo $key ?>" id_data="<?php echo $row->id_actividad?>" url_data="inicio/aprende/c_eliminar_actividad">
									<td class="td_actividad">
										<div class="actividad" onclick="window.location = '<?php echo $actividad?>'">
											<a class="actividad" href="<?php echo $actividad?>"><b><?php echo $key + 1 ?>: </b><?php echo $row->nombre_actividad ?></a>
										</div>
									</td>
									<td class="responsive_movil_off"><button onclick="window.location = '<?php echo $actividad?>'" class="button">Entrar</button></td>
									<?php if ($subs !== False){ ?>
									<td class="">
										<?php
										$estado = 'Incompleto';
										$class_estado = '';
										if (isset($arr_act_completas)){
											if(in_array($row->id_actividad, $arr_act_completas)){
												$estado = 'Completo';
												$class_estado = 'completo';
											}
										}
										?>
										<span class="estado_progreso responsive_movil_off <?php echo $class_estado ?>">
											<p><?php echo $estado ?></p>
										</span>
										<span class="estado_progreso responsive_movil_on <?php echo $class_estado ?>">
											<?php if ($estado == 'Completo') { ?>
											<i class="icon-check-b responsive_movil_on"></i>
											<?php }else{ ?>
											<i class="icon-cancelar responsive_movil_on"></i>
											<?php } ?>
										</span>
									</td>
									<?php } ?>
									<td class="td_acciones">
										<div class="div_acciones">
											<div class="acciones me_eliminar"><i class="icon-filled-eliminar-b"></i><span class="icon_info">Eliminar</span></div>
										</div>
									</td>
								</tr>
								<?php }
								} ?>
								<?php if ($tipo_usuario == 'administrador'){ ?>
								<tr>
									<td colspan="3" onclick="window.location = '<?php echo HOST?>agregar_actividad?id=<?php echo $id_modulo ?>'">
										<div class="add_actividad" >
											<i class="icon-filled-add"></i> 
											Agregar Actividad
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="buttons_inline next">
						<button onclick="window.location = '<?php echo HOST?>curso?id=<?php echo $row_modulo->id_curso ?>'" class="button">Volver a Modulos</button>
						<?php if ($next_indice != 0){ ?>
						<button onclick="window.location = '<?php echo HOST?>actividades?id=<?php echo $next_modulo ?>'" class="button">Siguiente Modulo</button>
						<?php } ?>
					</div>
				</div>
				<div id="div_mod_eliminar"></div>
			</div>
			<?php } ?>
		</div>
	</div>	
</main>
<?php
$scripts = ['comp_modal.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>