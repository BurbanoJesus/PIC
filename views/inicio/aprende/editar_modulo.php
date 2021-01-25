<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'modulo.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css'];
require VIEWS.'templates/head.php';

if (isset($_GET['id'])) {
	$id_modulo = $_GET['id'];

	$obj_modulo = new Modulo();
	$row = $obj_modulo->detalles($id_modulo);
}

$cuenta = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main" id="editar_modulo">
		<div class="contenido">
			<?php
			require_once LIBS.'verificar_sesion.php';
			$object = $row;
			require_once LIBS.'empty.php';
			if ($flag_empty === False){ ?>
			<form id="form_registrar_modulo" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_editar_modulo.php">
				<h2>Editar Modulo</h2>
				<div class="input s100">
					<h3>Nombre del Modulo</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="nombre" placeholder="Ingresar Nombre..." value="<?php echo $row->nombre_modulo ?>" /></div>
				</div>
				<div class="input s100">
					<h3>Descripción del Modulo</h3>
					<div class="contenido_input"><textarea class="input input_text" name="descripcion"  placeholder="Ingresar Descripción..."><?php echo $row->descripcion ?></textarea></div>
				</div>
				<input type="hidden" name="id_modulo" value="<?php echo $id_modulo ?>" />
				<input type="hidden" name="modulos" value="<?php echo $row->id_curso ?>" />
				<input type="hidden" name="fecha" value="" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-editar"></i>Actualizar</button>
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