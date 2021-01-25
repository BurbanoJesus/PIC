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
	<div class="main" id="login_u">
		<div class="login">
			<form id="login_u" action="<?php echo CONTROLLERS?>c_login_u.php" method="POST">
				<div class="relieve"></div>
				<div class="volver" onclick="window.location = '<?php echo HOST?>login'">
					<svg class="volver" viewBox="0 0 151.000000 131.000000"
					 preserveAspectRatio="xMidYMid meet">
					<g transform="translate(0.000000,131.000000) scale(0.100000,-0.100000)"
					fill="#5E5E5E" stroke="none">
					<path d="M524 1297 c-19 -11 -453 -523 -497 -587 -9 -13 -17 -40 -17 -60 0
					-31 28 -68 246 -330 136 -162 256 -300 268 -307 55 -32 136 12 136 74 0 39
					-16 61 -198 278 l-159 190 575 5 574 5 24 28 c32 37 32 87 0 124 l-24 28 -574
					5 -575 5 159 190 c182 217 198 239 198 278 0 62 -81 106 -136 74z"/>
					</g>
					</svg>
				</div>
				<?php 
				if (isset($_GET['cod']) && isset($_GET['usuario'])) {
					if ($comprobar_codigo != False){ ?>
					<div class="cuenta_activada"><span>Su cuenta ha sido activada correctamente</span></div>
				<?php } else{ ?>
					<div class="cuenta_activada error_cuenta_activada"><span>Ha ocurrido un error</span></div>
				<?php } 
				}
				?>
				<div class="logo">
					<img src="<?php echo IMG?>logo_ins5.png">
				</div>
				<!-- <i class="icon-perfil-login"></i> -->
				<div class="input_login">
					<input type="text" name="usuario" />
					<label for="">Usuario</label>
				</div>
				<div class="input_login password">
					<input type="password" name="password" />
					<label for="">Contraseña</label>
					<div class="icon_pass"><i class="icon-lineal-visible pass"></i></div>
				</div>
				<span class="sp_url_redirect" data="<?php echo $url_redirect ?>" style="display: none;"></span>
				<div class="error_login"></div>
				<button class="button pulse" type="submit">INICIAR SESIÓN</button>
				<div class="crear_cuenta">
					<a href="<?php echo HOST?>registrar_usuario" class="crear_cuenta">Crear una nueva cuenta</a>
					<a href="<?php echo HOST?>recuperar_password" class="crear_cuenta">Recuperar contraseña</a>
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