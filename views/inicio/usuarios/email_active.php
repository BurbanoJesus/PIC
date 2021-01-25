<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css'];
require VIEWS.'templates/head.php';
$cuenta = "active";
include VIEWS.'templates/header.php';

$msj = (isset($_GET['msj'])) ? $_GET['msj'] : '';
?>

<main>
	<div class="main">
		<div class="contenido">
			<form class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/usuarios/c_email_active.php" id="email_active">
				<div class="input">
					<h3>Correo electrónico.</h3>
					<div class="contenido_input">
						<input class="input input_correo" type="text" name="correo"  placeholder="Ingresar Correo..." minlength="5" required />
					</div>
				</div>
				<input type="hidden" name="fecha" value="" />
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-correo"></i>Enviar Correo</button>
				</div>
				<?php if($msj != ''){
					echo '<div class="c_msj_php">'.$msj.'</div>';
				} ?>
			</form>
		</div>
	</div>
</main>

<?php 
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>