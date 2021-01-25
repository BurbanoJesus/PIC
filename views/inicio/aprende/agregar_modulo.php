<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'curso.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css'];
require VIEWS.'templates/head.php';

$id_curso = isset($_GET['id']) ? $_GET['id'] : '';

$obj_curso = new Curso();
$row = $obj_curso->detalles($id_curso);

$cuenta = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main" id="agregar_modulo">
		<div class="contenido">
			<?php
			require_once LIBS.'verificar_sesion.php';
			$object = $row;
			require_once LIBS.'empty.php';
			if ($flag_empty === False){ ?>
			<form id="form_agregar_modulo" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_agregar_modulo.php">
				<h2>Agregar Modulo</h2>
				<div class="input s100">
					<h3>Nombre del Modulo</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="nombre"  placeholder="Ingresar Nombre..." /></div>
				</div>
				<div class="input s100">
					<h3>Descripción del Modulo</h3>
					<div class="contenido_input"><textarea class="input input_text" name="descripcion"  placeholder="Ingresar Descripción..."></textarea></div>
				</div>
				<input type="hidden" name="id_curso" value="<?php echo $id_curso ?>" />
				<input type="hidden" name="fecha" value="" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-check"></i>Agregar</button>
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