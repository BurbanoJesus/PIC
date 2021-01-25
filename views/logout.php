<?php
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();
$_SESSION["usuario"]= "";
session_destroy();

$estilos = ['estilos_inicio.css'];
include VIEWS.'templates/head.php';
?>
<main>
	<div class="logout">
		<h1>Información:</h1>
		<span>Sesion Finalizada</span>
		<a class="button" href="<?php echo HOST?>"><i class="icon-filled-home"></i>Ir al Inicio</a>
	</div>
</main>

<?php
include VIEWS.'templates/foot.php';
// $host = HOST;
// header("Refresh: 5; URL=$host");
?>