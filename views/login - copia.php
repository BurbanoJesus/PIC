<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'usuario.php';
session_start();

$estilos = ['estilos_login.css'];
include VIEWS.'templates/head.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] == ""){
	if (isset($_SERVER['HTTP_REFERER'])) {
		$_SESSION['url_redirect'] =  $_SERVER['HTTP_REFERER'];
	}else{
		if (!isset($_SESSION['url_redirect'])) {
			$_SESSION['url_redirect'] = HOST.'inicio';
		}
	}
	$url_redirect = $_SESSION['url_redirect'];
	if(isset($_GET['cod']) && isset($_GET['usuario'])){
		$codigo = $_GET['cod'];
		$usuario = $_GET['usuario'];
		$obj_inicio = new Usuario();
		$comprobar_codigo = $obj_inicio->comprobar_codigo($usuario,$codigo);
		if ($comprobar_codigo == True) {
			$obj_inicio->actualizar_estado($usuario);
		}
	}

// var_dump(password_hash('1234', PASSWORD_DEFAULT));
?>
<main>
	<div class="main" id="login">
		<div class="login">
			<form id="login" action="<?php echo CONTROLLERS?>c_login.php" method="POST">
				<div class="relieve"></div>
				<div class="logo_login">
					<img src="<?php echo IMG?>logo_ins5.png">
					<h2 class="h2_logo">Tipo de usuario</h2>
				</div>
				<!-- <h3>Tipo de usuario</h3> -->
				<div class="enlaces_login">
					<a href="<?php echo HOST?>login_u"><i class="icon-filled-user"></i>General</a>
					<a href="<?php echo HOST?>login_u"><i class="icon-filled-user"></i>Supervisor</a>
					<a href="<?php echo HOST?>login_u"><i class="icon-filled-user"></i>Generador</a>
					<a href="<?php echo HOST?>login_u"><i class="icon-filled-user"></i>Administrador</a>
				</div>
			</form>
		</div>
	</div>
</main>
<?php }else{
	header("Location: ".HOST."inicio");
} 
?>
<?php 
$scripts = ['login.js'];
include VIEWS.'templates/foot.php'; 
?>