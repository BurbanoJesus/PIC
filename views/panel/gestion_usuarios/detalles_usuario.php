<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'usuario.php';
session_start();
require_once LIBS."verificar_admin.php";

$estilos = ['estilos_panel.css','comp_modal.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

$usuario = (isset($_GET['id'])) ? $_GET['id'] : '';

$obj_usuario = new Usuario();
$row = $obj_usuario->usuario_por_nickname_all($usuario);
$array_cursos = $obj_usuario->listar_progreso_perfil($usuario);


?>

<main>
	<div class="panel">
		<?php
		$gestion_usuarios = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php $volver = 'gestion_usuarios'; include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s100" method="POST" action="#">
				<h2 class="titulo_panel">Detalles Usuario</h2>
				<div class="separador"></div>
				<div class="content_detalles">
					<div class="info_detalles">
						<div class="nombre_detalles usuario">
							<div class="file_multimedia" id="img_usuario">
								<img target="theater" class="call_theater simple file" index="0" src="<?php echo $row->img_preview?>" alt="" />
							</div>
							<span class="main"><?php echo $row->nombres ?></span>
						</div>
						<div class="lista_detalles">
							<div class="opcion">
								<span class="info_label">Tipo de usuario</span>
								<span class="info"><?php echo $row->tipo_usuario ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Fecha de registro</span>
								<?php $fecha = to_fecha_str($row->fecha_reg) ?>
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
								<span class="info_label">Correo</span>
								<span class="info"><?php echo $row->tipo_id ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Correo</span>
								<span class="info"><?php echo $row->identificacion ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Correo</span>
								<span class="info"><?php echo $row->telefono ?></span>
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
								<div class="info_progreso" onclick="window.location = '<?php echo HOST?>modulos?id=<?php echo $row->modulos ?>'"><span class="estado_progreso completo">Ver curso</span></div>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="content_button next">
					<button type="button" class="button inline" onclick="window.location = '<?php echo HOST?>gestion_usuarios?id=lkuy'"><i class="icon-lineal-flecha volver"></i>Regresar</button>
				</div>
			</form>
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
	</div>
</main>
<?php
$scripts= ['comp_modal.js'];
include VIEWS.'templates/foot.php'; 
?>