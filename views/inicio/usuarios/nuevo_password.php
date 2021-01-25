<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'usuario.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css'];
require VIEWS.'templates/head.php';

$codigo = (isset($_GET['cod'])) ? $_GET['cod'] : '';
$usuario = (isset($_GET['usuario'])) ? $_GET['usuario'] : '';
$cuenta = "active";
include VIEWS.'templates/header.php';
$obj_inicio = new Usuario();

$comprobar_codigo = $obj_inicio->comprobar_codigo($usuario,$codigo);
// var_dump($verifiy);


if ($comprobar_codigo != False) {
	$_SESSION['usuario_rec_pass'] = $usuario;
?>

<main>
	<div class="main">
		<div class="contenido">
			<form class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/usuarios/c_nuevo_pass.php" id="nuevo_pass">
				<div class="input">
					<h3>Crear Nueva Contraseña</h3>
					<div class="contenido_input">
						<input class="input input_pass pass_equal" type="password" name="password"  placeholder="Ingresar Contraseña..." minlength="5" required />
						<div class="icon_pass"><i class="icon-lineal-visible pass_db"></i></div>
					</div>
				</div>
				<div class="input">
					<h3>Repetir Nueva Contraseña</h3>
					<div class="contenido_input">
						<input class="input input_pass pass_equal" type="password" name="password_b"  placeholder="Ingresar Contraseña..." minlength="5" required />
						<div class="icon_pass"><i class="icon-lineal-visible pass_db"></i></div>
					</div>
				</div>
				<input type="hidden" name="codigo" value="<?php echo $codigo ?>" />
				<input type="hidden" name="usuario" value="<?php echo $usuario ?>" />
				<input type="hidden" name="fecha" value="" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-anuncio"></i>Registrar</button>
				</div>
			</form>
		</div>
	</div>
</main>
<?php }else{
	include VIEWS.'templates/error404.php';
}
?>
<?php 
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>