<div class="h1">
	<?php if(isset($volver)){
		$url_volver = HOST.$volver;
	}else{
		$url_volver = $_SERVER['HTTP_REFERER'];
	} ?>
	<div class="responsive_menu_p responsive_movil_on">
		<i class="icon-filled-menu"></i>
	</div>
	<div class="volver" onclick="window.location = '<?php echo $url_volver ?>'">
		<i class="icon-lineal-flecha volver"></i>
	</div>
	<h1 class="responsive_movil_off"><?php echo $titulo ?></h1>
	<h1 class="responsive_movil_on">PIC</h1>
	<?php if ($tipo_usuario != 'generador'){ ?>
	<a href="<?php echo HOST?>elegir_municipio" class="button btn_outline"><i class="icon-filled-ubicacion"></i><?php echo ucfirst($_SESSION['ses_municipio']) ?></a>
	<?php } ?>
</div>