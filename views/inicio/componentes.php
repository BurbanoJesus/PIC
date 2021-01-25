<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";

$estilos = ['comp_check_radio.css'];
require_once VIEWS.'templates/head.php';
$seguridad = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main" id="componentes">
		<div class="contenido">
			<div class="content_switch">
				<input type="checkbox" id="in_switch" class="in_switch" />
				<label for="in_switch" class="switch"></label>
				<label class="lb_switch">a. Wikipedia es una enciclopedia libre,​ políglota y editada de manera colaborativa. Es administrada por la Fundación Wikimedia, una organización sin ánimo de Wikipedia es una enciclopedia libre,​ políglota y editada de manera colaborativa. Es administrada por la Fundación Wikimedia, una organización sin ánimo de</label>
			</div>
			<div class="content_radio_s">
				<input type="radio" name="radio_a" id="in_radio_s_1" class="in_radio_s" />
				<label for="in_radio_s_1" class="radio_s"></label>
				<label for="in_radio_s_1">algo asdasd a</label>
				<input type="radio" name="radio_a" id="in_radio_s_2" class="in_radio_s" />
				<label for="in_radio_s_2" class="radio_s"></label>
				<label for="in_radio_s_2">algo asdasd b</label>
			</div>
			<div class="content_radio">
				<input type="radio" name="radio_a" id="in_radio_1" class="in_radio" />
				<label for="in_radio_1" class="radio"></label>
				<label for="in_radio_1">algo asdasd a</label>
				<input type="radio" name="radio_a" id="in_radio_2" class="in_radio" />
				<label for="in_radio_2" class="radio"></label>
				<label for="in_radio_2">algo asdasd b</label>
			</div>
			<div class="content_checkbox">
				<input type="checkbox" name="checkbox_a" id="in_checkbox_1" class="in_checkbox" />
				<label for="in_checkbox_1" class="checkbox"></label>
				<label for="in_checkbox_1">algo asdasd a</label>
				<input type="checkbox" name="checkbox_a" id="in_checkbox_2" class="in_checkbox" />
				<label for="in_checkbox_2" class="checkbox"></label>
				<label for="in_checkbox_2">algo asdasd b</label>
			</div>
		</div>
	</div>
</main>
<?php
$scripts = ['comp_check_radio.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>