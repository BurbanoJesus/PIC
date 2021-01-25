<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'municipio.php';
require MODELS.'usuario.php';
session_start();
require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css','estilos_login.css','comp_select.css'];
include VIEWS.'templates/head.php';
$obj_municipio = new Municipio();
$array_municipio = $obj_municipio->listar();

$view = 'panel';
if (isset($_SERVER['HTTP_REFERER'])){
	$view = $_SERVER['HTTP_REFERER'];
	$view = explode('/', $view);
	$view = end($view);
}
// var_dump($view);
?>
<main>
	<div class="main">
		<div class="elegir_municipio">
			<form id="elegir_municipio" class="form" action="<?php echo CONTROLLERS?>panel/c_elegir_municipio.php" method="POST">
				<!-- <div class="relieve"></div> -->
				<div class="logo">
					<img src="<?php echo IMG?>mingas_logo_b.png">
					<h2>PIC</h2>
				</div>
				<div class="input">
					<h3 class="h3_input">Elige el municipio.</h3>
					<div class="select" id="municipio" data="">
						<div class="head_select">
							<span class="nombre_select">Seleccione Municipio</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<?php foreach ($array_municipio as $key => $row) { ?>
								<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span><?php echo ucwords($row->municipio)?></span></div>
							<?php } ?>
						</div>
						<input type="hidden" name="municipio" value="" />
					</div>
					<input type="hidden" name="view" value="<?php echo $view ?>" />
				</div>
				<!-- <div class="content_button next">
					<button class="button" type="submit">Aceptar</button>
				</div> -->
			</form>
		</div>
	</div>
</main>
<?php
$scripts = ['comp_select.js'];
include VIEWS.'templates/foot.php'; 
?>