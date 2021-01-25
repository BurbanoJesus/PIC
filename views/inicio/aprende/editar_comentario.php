<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'curso.php';
session_start();
// 
$estilos = ['estilos_inicio.css','estilos_form.css'];
require VIEWS.'templates/head.php';

$usuario = $_SESSION['usuario']->usuario;
$id_curso = $_GET['id'];

$obj_curso = new Curso();
$row = $obj_curso->detalles_comentario($id_curso,$usuario);


$cuenta = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main" id="agregar_comentario">
		<div class="contenido">
			<?php
			require_once LIBS.'verificar_sesion.php';
			$object = $row;
			require_once LIBS.'empty.php';
			if ($flag_empty === False){ ?>
			<form id="form_agregar_comentario" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_editar_comentario.php">
				<h2>Valoracion de curso</h2>
				<div class="info_curso">
					<div class="img"><img src="<?php echo $row->img_curso ?>" /></div>
					<div class="nombre_curso"><span><?php echo $row->nombre_curso ?></span></div>
				</div>
				<div class="input s100 center">
					<h3>Calificacion</h3>
					<div class="contenido_input">
						<div class="input_valoracion">
							<div class="wrap_estrellas">
								<div class="wrap_img_estrella"><img class="estrella_nota" src="<?php echo IMG?>estrellas/medium/borde_estrella_m.png" /></div>
								<div class="wrap_img_estrella"><img class="estrella_nota" src="<?php echo IMG?>estrellas/medium/borde_estrella_m.png" /></div>
								<div class="wrap_img_estrella"><img class="estrella_nota" src="<?php echo IMG?>estrellas/medium/borde_estrella_m.png" /></div>
								<div class="wrap_img_estrella"><img class="estrella_nota" src="<?php echo IMG?>estrellas/medium/borde_estrella_m.png" /></div>
								<div class="wrap_img_estrella"><img class="estrella_nota" src="<?php echo IMG?>estrellas/medium/borde_estrella_m.png" /></div>
							</div>
							<span>Se requiere calificación.</span>
							<input type="hidden" name="nota" value="<?php echo $row->valoracion ?>" required />
						</div>
					</div>
				</div>
				<div class="input s100">
					<!-- <h3>Descripción del Modulo</h3> -->
					<div class="contenido_input"><textarea class="input input_text" name="comentario"  placeholder="Escribir comentario..."><?php echo $row->texto_comentario ?></textarea></div>
				</div>
				<input type="hidden" name="id_curso" value="<?php echo $id_curso ?>" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-editar-b"></i>Actualizar</button>
				</div>
			</form>
		<?php } ?>
		</div>
	</div>
</main>
<?php
// $scripts = [''];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>