<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css'];
include VIEWS.'templates/head.php';
$active = (isset($_GET['active'])) ? $_GET['active'] : '';
$url_redirect = (isset($_GET['url_redirect'])) ? $_GET['url_redirect'] : HOST.'inicio';
$action = (isset($_GET['action'])) ? $_GET['action'] : '';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

switch (True) {
	case ($action == 'Actualizacion'):
		$str_action = 'Actualización Exitosa';
		break;

	case ($action == 'Enviado'):
		$str_action = 'Enviado Correctamente';
		break;
	
	default:
		$str_action = 'Registro Exitoso';
		break;
}

$titulo = (isset($_GET['titulo'])) ? $_GET['titulo'] : 'Registro Exitoso';

?>

<main>
	<div class="panel">
		<?php
		${$active} = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<div class="h2"><h2>PIC</h2></div>
			<form class="form" action="" id="success">
				<div class="success">
					<i class="icon-lineal-check"></i>
					<span><?php echo $str_action?></span>
					<?php 
						if (strlen($titulo) > 0 ) {
							echo '<p class="success_p">'.$titulo.'</p>';
						}
					?>
					<div class="content_button next">
						<button onclick="javascript:window.location ='<?php echo $url_redirect?>'" type="button" class="button">Aceptar</button>
					</div>
				</div>

				<!-- <div class="success_error">
					<i class="icon-filled-no-check"></i>
					<span>Ha Ocurrido Un Error Intentelo de Nuevo</span>
					<div class="button siguiente">
						<button type="submit" class="button">Aceptar</button>
					</div>
				</div> -->
			</form>
		</div>
	</div>
</main>
<?php include VIEWS.'templates/foot.php'; ?>