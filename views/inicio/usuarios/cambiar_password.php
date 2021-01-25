<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'usuario.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css'];
require VIEWS.'templates/head.php';

include VIEWS.'templates/header.php';
$usuario = $_SESSION['usuario']->usuario;
$obj_usuario = new Usuario();

?>

<main>
	<div class="main">
		<div class="contenido">
			<?php
			$object = $usuario;
			require LIBS.'error404.php';
			if ($flag_error404 == False) { 
			?>
			<form class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/usuarios/c_cambiar_password.php" id="nuevo_pass">
				<div class="input">
					<h3>Crear Nueva Contraseña</h3>
					<div class="contenido_input">
						<input class="input input_pass pass_equal" type="password" name="password"  placeholder="Ingresar Contraseña..." minlength="4" required />
						<div class="icon_pass"><i class="icon-lineal-visible pass_db"></i></div>
					</div>
				</div>
				<div class="input">
					<h3>Repetir Nueva Contraseña</h3>
					<div class="contenido_input">
						<input class="input input_pass pass_equal" type="password" name="password_b"  placeholder="Ingresar Contraseña..." minlength="4" required />
						<div class="icon_pass"><i class="icon-lineal-visible pass_db"></i></div>
					</div>
				</div>
				<input type="hidden" name="usuario" value="<?php echo $usuario ?>" />
				<input type="hidden" name="fecha" value="" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-check"></i>Cambiar</button>
				</div>
			</form>
		<?php } ?>
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>