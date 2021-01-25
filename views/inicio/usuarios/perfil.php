<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'usuario.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_tablas.css','comp_modal.css'];
require_once VIEWS.'templates/head.php';
?>

<?php
// $actualidad = "active";
include VIEWS.'templates/header.php';
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$usuario = $_SESSION['usuario']->usuario;
$obj_usuario = new Usuario();
$row = $obj_usuario->usuario_por_nickname_all($usuario);
$array_cursos = $obj_usuario->listar_progreso_perfil($usuario);
// $array_1 = $obj_usuario->actualizar_progreso_usuario('juego_vf');
// var_dump($array_1);

// var_dump($row->usuario);

?>
<main>
	<div class="main" id="detalles_perfil">
		<div class="contenido">
			<?php  
			$object = $row;
			require LIBS.'error404.php';
			if ($flag_error404 == False) { 
			$fecha = to_fecha_str($row->fecha_reg);
			$hora = to_hora_str($row->fecha_reg);
			?>
			<form class="s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_ver_perfil.php" id="form_ver_perfil">
				<h2 class="titulo">Perfil de usuario</h2>
				<div class="separador"></div>
				<div class="content_detalles">
					<div class="h2_detalles"><h2>Información Personal</h2></div>
					<div class="info_detalles relative parent_me_elemento" id_data="<?php echo $row->usuario?>">
						<div class="nombre_detalles usuario">
							<!-- <span><i class="icon-filled-foto"></i>Editar</span> -->
							<div class="file_multimedia" id="img_usuario">
								<img target="theater" class="call_theater simple file" index="0" src="<?php echo $row->img_preview?>" alt="" />
							</div>
							<span class="main"><?php echo $row->nombres ?></span>
						</div>
						<div class="lista_detalles">
							<div class="opcion">
								<span class="info_label">Fecha de registro</span>
								<span class="info"><?php echo $fecha ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Municipio</span>
								<span class="info"><?php echo $row->municipio ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Correo</span>
								<span class="info"><?php echo $row->correo ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Telefono</span>
								<span class="info"><?php echo $row->telefono ?></span>
							</div>
							<div class="opcion last">
								<span class="info_label">Documento</span>
								<span class="info"><?php echo $row->identificacion ?></span>
							</div>
						</div>
						<div class="menu_elemento">
							<div class="me_icon"><i class="icon-filled-ellipsis"></i></div>
							<div class="me_opciones">
								<span class="me_opcion me_editar"><i class="icon-filled-editar"></i>Editar</span>
								<span class="me_opcion" onclick="window.location = '<?php echo HOST?>cambiar_password'"><i class="icon-filled-lock"></i>Cambiar Contraseña</span>
								<span class="me_opcion me_eliminar"><i class="icon-filled-eliminar-b"></i>Eliminar Cuenta</span>
							</div>
						</div>
					</div>
					<div class="h2_detalles"><h2>Información de Juegos</h2></div>
					<div class="info_detalles">
						<div class="lista_detalles progreso">
							<div class="opcion">
								<span class="info_label">Juego Verdadero/Falso</span>
								<?php $estado = ($row->estado_juego_vf != 'A')? 'Incompleto':'Completo'; ?>
								<?php $str_class = ($row->estado_juego_vf != 'A')? '':'completo'; ?>
								<div class="info_progreso"><span class="estado_progreso <?php echo $str_class ?>"><?php echo $estado ?></span></div>
							</div>
							<div class="opcion">
								<span class="info_label">Juego Ahorcado</span>
								<?php $estado = ($row->estado_juego_ahorcado != 'A')? 'Incompleto':'Completo'; ?>
								<?php $str_class = ($row->estado_juego_ahorcado != 'A')? '':'completo'; ?>
								<div class="info_progreso"><span class="estado_progreso <?php echo $str_class ?>"><?php echo $estado ?></span></div>
							</div>
							<div class="opcion last">
								<span class="info_label">Juego Mueve y juega</span>
								<?php $estado = ($row->estado_juego_arrastrar != 'A')? 'Incompleto':'Completo'; ?>
								<?php $str_class = ($row->estado_juego_arrastrar != 'A')? '':'completo'; ?>
								<div class="info_progreso"><span class="estado_progreso <?php echo $str_class ?>"><?php echo $estado ?></span></div>
							</div>
						</div>
					</div>
					<?php if ($array_cursos !== False){ ?>
					<div class="h2_detalles"><h2>Información de Cursos</h2></div>
					<div class="info_detalles">
						<div class="lista_detalles progreso">
							<?php
							// var_dump($array_cursos);
							foreach ($array_cursos as $key => $row){
							$last = (count($array_cursos) == $key + 1) ? 'last': '';
							?>
							<div class="opcion <?php echo $last ?>">
								<span class="info_label">Curso <?php echo $key + 1 ?>: <?php echo $row->nombre_curso ?></span>
								<div class="info_progreso" onclick="window.location = '<?php echo HOST?>modulos?id=<?php echo $row->id_curso ?>'"><span class="estado_progreso completo">Ver curso</span></div>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="content_button next">
					<button type="button" class="button inline" onclick="window.location = '<?php echo HOST?>inicio'"><i class="icon-lineal-flecha volver"></i>Regresar</button>
				</div>
			</form>
		<?php } ?>
		</div>
		<div id="theater" class="theater multimedia" data="">
			<div index="" class="indicador"></div>
			<div class="close"><i class="icon-cancelar"></i></div>
			<div index="" class="btn_left"><i class="icon-arrow-c"></i></div>
			<div index="" class="btn_right"><i class="icon-arrow-c"></i></div>
			<div class="theater_main">
				<div class="theater_content">
					
				</div>
			</div>
		</div>

		<div id="div_mod_eliminar"></div>
	</div>
</main>
<?php
$scripts= ['comp_modal.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php';
?>