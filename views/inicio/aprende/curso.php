<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'curso.php';
require_once MODELS.'modulo.php';
require_once MODELS.'usuario.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_tablas.css','comp_modal.css'];
require_once VIEWS.'templates/head.php';

$usuario = isset($_SESSION['usuario']->usuario) ? $_SESSION['usuario']->usuario : False;
$id_curso = isset($_GET['id']) ? $_GET['id']: '';

$obj_curso = new Curso();
$row_curso = $obj_curso->detalles_modulo($id_curso);
$array_comentarios = $obj_curso->listar_comentarios($id_curso);
$array_notas = $obj_curso->listar_comentarios_notas($id_curso);
$flag_comentario = $obj_curso->flag_comentario($id_curso,$usuario);

$obj_modulo = new Modulo();
$array_modulos = $obj_modulo->listar($id_curso);


$obj_usuario = new Usuario();
$id_curso = ($row_curso !== False) ? $row_curso->id_curso : '';
if ($usuario !== False) {
	$subs = $obj_usuario->comprobar_suscripcion($id_curso);
	$arr_usuario_progreso = $obj_usuario->listar_progreso_modulos($id_curso);
}

$aprende = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main">
		<div class="contenido relative aprende" id="modulos">
			<?php
			require_once LIBS.'verificar_sesion.php';
			if ($flag_session === False){
			$object = $row_curso;
			require_once LIBS.'not_found.php';
			if ($flag_not_found === False){
			?>
			<form id="form_subs" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_cursos_subs.php">
				<div class="wrap_nombre_curso" onclick="window.location = '<?php echo HOST?>cursos?dimension=<?php echo $row_curso->dimension ?>'">
					<i class="icon-lineal-flecha volver"></i>
					<h1 class="nombre_curso">Curso: <?php echo $row_curso->nombre_curso ?> estrategia de movilización social</h1>
				</div>
				<?php 
				$object = $array_modulos;
				require_once LIBS.'empty.php';
				if ($flag_empty === False){
				?>
				<div class="informacion">
					<h2 class="h2_informacion">Modulos</h2>
					<div class="modulos">
						<?php
						if ($array_modulos !== False){
						foreach ($array_modulos as $key => $row){ 
						$id_modulo = $row->id_modulo;
						$cont = 0;

						if ($arr_usuario_progreso !== False){
							foreach ($arr_usuario_progreso as $key_progreso => $row_progreso) {
								if ($row_progreso->id_modulo == $id_modulo) {
									$cont++;
								}
							}
						}
						$len_modulo = $obj_modulo->len_modulo($row->id_modulo);
						$porcentaje = ($len_modulo > 0) ? round(($cont/$len_modulo)*100, 0) : 0;
						$row->estado_modulo = ($porcentaje > 0) ? 'Incompleto' : 'No iniciado';
						$row->estado_modulo = ($porcentaje == 100) ? 'Completo' : $row->estado_modulo;
						$row->class_estado = ($porcentaje > 0) ? 'incompleto' : '';
						$row->class_estado = ($porcentaje == 100) ? 'completo' : $row->class_estado;
						$row->completado = $porcentaje;
						$porcentaje = $porcentaje.'%';

						if ($subs === False){
							$porcentaje = '0%';
							$row->estado_modulo = '';
							$row->class_estado = '';
						}
						?>
						<div class="tarjetas_modulos parent_me_elemento <?php echo $row->class_estado ?>" id="modulo<?php echo $key ?>" id_data="<?php echo $row->id_modulo?>" url_data="inicio/aprende/c_eliminar_modulo">
							<div onclick="window.location = '<?php echo HOST?>actividades?id=<?php echo $row->id_modulo ?>'" class="img">
								<img index="0" src="<?php echo $row_curso->img_curso ?>" target="theater" class="call_theater simple" />
								<div class="estado_modulo">
									<span><?php echo $porcentaje ?></span>
								</div>
							</div>
							<div onclick="window.location = '<?php echo HOST?>actividades?id=<?php echo $row->id_modulo ?>'" class="props">
								<h2>Modulo <?php echo $key + 1 ?>: <?php echo $row->nombre_modulo ?></h2>
								<a href="<?php echo HOST?>actividades?id=<?php echo $row->id_modulo ?>" class="button entrar_modulo <?php echo $row->class_estado ?>">Entrar</a>
							</div>
							<?php if ($tipo_usuario == 'administrador'){ ?>
							<div class="menu_elemento">
								<div class="me_icon filled">
									<i class="icon-filled-ellipsis"></i>
								</div>
								<div class="me_opciones">
									<span class="me_opcion me_editar">
										<i class="icon-filled-editar"></i>
										Editar
									</span>
									<span class="me_opcion me_eliminar">
										<i class="icon-filled-eliminar-b"></i>
										Eliminar
									</span>
								</div>
							</div>
							<?php } ?>
						</div>
						<?php }
						} ?>
						<?php 
						if ($tipo_usuario == 'administrador'){
							$center = (is_array($array_modulos)) ? '': 'center';
						?>
						<div class="tarjetas_modulos nuevo <?php echo $center ?>" onclick="window.location = '<?php echo HOST?>agregar_modulo?id=<?php echo $id_curso ?>'">
							<i class="icon-filled-modulo-add"></i>
							<a href="<?php echo HOST?>agregar_modulo?id=<?php echo $id_curso ?>" class="button nuevo_modulo">Agregar Modulo</a>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php if($subs !== False){ ?>
				<div class="informacion">
					<?php if ($array_modulos !== False) { ?>
					<h2 class="h2_informacion">Información de progreso.</h2>
					<div class="tabla">
						<table>
							<thead>
								<tr class="tr_color">
									<th>#</th>
									<th class="left">Modulo</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($array_modulos as $key => $row) { ?>
								<tr>
									<td class="td_codigo"><?php echo $key + 1 ?></td>
									<td class="left"><?php echo $row->nombre_modulo ?></td>
									<td class="td_estado center">
										<span class="estado_progreso <?php echo $row->class_estado ?>">
											<p class="responsive_movil_off"><?php echo $row->estado_modulo ?></p>
											<?php if ($row->estado_modulo == 'Completo') { ?>
												<i class="icon-filled-check-b responsive_movil_on"></i>
											<?php }else{ ?>
												<i class="icon-cancelar responsive_movil_on"></i>
											<?php } ?>
										</span>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } ?>
				<div class="informacion generar_certificado">
					<h2>Certificado.</h2>
					<div class="img"><img src="<?php echo IMG?>default/certificado_logo.png" /></div>
					<p class="p_certificado">Se debe completar todos los modulos y juegos para poder obtener el certificado.</p>
					<?php
					$completado = True;
					if (is_array($array_modulos)){
						foreach ($array_modulos as $key => $row) {
							if ($row->completado != '100') {
								$completado = False;
							}
						}
					}
					if ($completado != False) { 
					?>
					<div class="content_button">
						<button onclick="window.location = '/plataforma/c_generar_certificado?id_curso=<?php echo $id_curso ?>'" type="button" id="btn_certificado" class="button"><i class="icon-filled-descargar"></i>Descargar Certificado</button>
					</div>
					<?php } ?>
				</div>
				<?php }else{?>
				<div class="informacion">
					<input type="hidden" name="fecha" value="" />
					<input type="hidden" name="id_curso" value="<?php echo $id_curso ?>" />
					<div class="content_button next">
						<button type="submit" id="btn_subs" class="button entrar_modulo">Suscribirse a este curso</button>
					</div>
				</div>
				<?php } ?>
				<div class="informacion">
					<div class="cursos_valoracion">
						<h2>Valoración del curso</h2>
						<div class="wrap_valoracion">
							<div class="nota">
								<?php 
								$nota = $row_curso->nota_curso;
								$numero_comentarios = is_array($array_comentarios) ? count($array_comentarios) : 0;
								$comentarios_1 = 0;
								$comentarios_2 = 0;
								$comentarios_3 = 0;
								$comentarios_4 = 0;
								$comentarios_5 = 0;
								$porcentaje_1 = 0;
								$porcentaje_2 = 0;
								$porcentaje_3 = 0;
								$porcentaje_4 = 0;
								$porcentaje_5 = 0;
								if (is_array($array_notas)) {
									foreach ($array_notas as $key => $row_notas) {
										if ($row_notas->valoracion == '1.0') {
											$comentarios_1 = $row_notas->total;
											$porcentaje_1 = $row_notas->total * (100/$numero_comentarios);
										}else if ($row_notas->valoracion == '2.0') {
											$comentarios_2 = $row_notas->total;
											$porcentaje_2 = $row_notas->total * (100/$numero_comentarios);
										}else if ($row_notas->valoracion == '3.0') {
											$comentarios_3 = $row_notas->total;
											$porcentaje_3 = $row_notas->total * (100/$numero_comentarios);
										}else if ($row_notas->valoracion == '4.0') {
											$comentarios_4 = $row_notas->total;
											$porcentaje_4 = $row_notas->total * (100/$numero_comentarios);
										}else if ($row_notas->valoracion == '5.0') {
											$comentarios_5 = $row_notas->total;
											$porcentaje_5 = $row_notas->total * (100/$numero_comentarios);
										}
									}
								}
								if($nota !== '0.0'){ ?>
								<span class="numero"><?php echo $nota ?></span>
								<div class="wrap_estrellas">
								<?php
								$nota_base = floor($nota);
								$nota_restante = (float) $nota - $nota_base;
								for ($i=1; $i <= 5; $i++) {
									if ($nota_base >= $i) {
										echo '<img src="'.IMG.'estrellas/small/estrella_s.png" />';
									}else{
										if ($nota_restante > 0) {
										 	$nota_restante = substr($nota_restante, -1);
											echo '<img src="'.IMG.'estrellas/small/'.$nota_restante.'s.png" />';
											$nota_restante = 0;
										}else{
											echo '<img src="'.IMG.'estrellas/small/borde_estrella_s.png" />';
										}
									}
								}
								?>
								</div>
								
								<span><i class="icon-filled-user"></i><?php echo $numero_comentarios ?></span>
								<?php }else{ ?>
								<div class="not_nota">
									<span>El curso no tiene valoraciónes</span>
								</div>
								<?php } ?>
							</div>
							<div class="info_estrellas">
								<div class="sub_info">
									<span>5</span>
									<img src="<?php echo IMG?>estrellas/small/estrella_s.png" />
									<div class="barra">
										<div class="total"></div>
										<div class="porcentaje" style="width: <?php echo $porcentaje_5 ?>%;"></div>
									</div>
									<span class="num_val"><i class="icon-filled-user"></i><?php echo $comentarios_5 ?></span>
								</div>
								<div class="sub_info">
									<span>4</span>
									<img src="<?php echo IMG?>estrellas/small/estrella_s.png" />
									<div class="barra">
										<div class="total"></div>
										<div class="porcentaje b" style="width: <?php echo $porcentaje_4 ?>%;"></div>
									</div>
									<span class="num_val"><i class="icon-filled-user"></i><?php echo $comentarios_4 ?></span>
								</div>
								<div class="sub_info">
									<span>3</span>
									<img src="<?php echo IMG?>estrellas/small/estrella_s.png" />
									<div class="barra">
										<div class="total"></div>
										<div class="porcentaje c" style="width: <?php echo $porcentaje_3 ?>%;"></div>
									</div>
									<span class="num_val"><i class="icon-filled-user"></i><?php echo $comentarios_3 ?></span>
								</div>
								<div class="sub_info">
									<span>2</span>
									<img src="<?php echo IMG?>estrellas/small/estrella_s.png" />
									<div class="barra">
										<div class="total"></div>
										<div class="porcentaje d" style="width: <?php echo $porcentaje_2 ?>%;"></div>
									</div>
									<span class="num_val"><i class="icon-filled-user"></i><?php echo $comentarios_2 ?></span>
								</div>
								<div class="sub_info">
									<span>1</span>
									<img src="<?php echo IMG?>estrellas/small/estrella_s.png" />
									<div class="barra">
										<div class="total"></div>
										<div class="porcentaje e" style="width: <?php echo $porcentaje_1 ?>%;"></div>
									</div>
									<span class="num_val"><i class="icon-filled-user"></i><?php echo $comentarios_1 ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="informacion last">
					<div class="cursos_comentarios">
						<h2>Comentarios</h2>
						<?php if ($subs                                !== False) { ?>
						<div class="content_button add_comentario">
							<?php if ($flag_comentario === False) { ?>
							<button onclick="window.location = '<?php echo HOST?>agregar_comentario?id=<?php echo $row_curso->id_curso ?>'" class="button" type="button" ><i class="icon-filled-editar-b"></i>Escribir Comentario</button>
							<?php }else{ ?>
							<button onclick="window.location = '<?php echo HOST?>editar_comentario?id=<?php echo $row_curso->id_curso ?>'" class="button" type="button" ><i class="icon-filled-editar"></i>Editar Comentario</button>
							<?php } ?>
						</div>
						<?php }
						if (is_array($array_comentarios)) { 
						foreach ($array_comentarios as $key => $row_comentario){
							$fecha_comentario = date_ago($row_comentario->fecha_comentario);
							$last = ($key+1 == count($array_comentarios)) ? 'last' : '';
						?>
						<div class="wrap_comentario parent_me_elemento <?php echo $last ?>" id="c<?php echo $key ?>" id_data="<?php echo $row_comentario->id_comentario?>" url_data="inicio/aprende/c_eliminar_comentario">
							<div class="img"><img src="<?php echo $row_comentario->img_preview ?>" /></div>
							<!-- <div class="img"><img src="<?php echo $row_comentario->nombres?>default/default_perfil_rm.png" /></div> -->
							<div class="wrap_estructura_comentario">
								<div class="info_usuario">
									<span class="usuario"><?php echo $row_comentario->nombres ?></span>
									<div class="wrap_estrellas">
										<?php
										$nota_base = $row_comentario->valoracion;
										for ($i=1; $i <= 5; $i++) {
											if ($nota_base >= $i) {
												echo '<img src="'.IMG.'estrellas/small/estrella_s.png" />';
											}else{
												echo '<img src="'.IMG.'estrellas/small/borde_estrella_s.png" />';
											}
										}
										?>
										<span><?php echo $fecha_comentario ?></span>
									</div>
									<div class="wrap_texto">
										<span><?php echo $row_comentario->texto_comentario ?>
										</span>
									</div>
								</div>
								<?php if ($tipo_usuario === 'administrador') { ?>
								<div class="menu_elemento">
									<div class="me_icon"><i class="icon-filled-ellipsis"></i></div>
									<div class="me_opciones">
										<span class="me_opcion me_eliminar"><i class="icon-filled-eliminar-b"></i>Eliminar</span>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						<?php }}else{?>
						<div class="not_comentarios">No hay comentarios registrados para este curso</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			</form>
			<div id="div_mod_eliminar"></div>
		<?php } }?>
		</div>
	</div>	
</main>

<?php
$scripts = ['comp_modal.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>