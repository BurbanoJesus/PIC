<div class="h2">
	<?php if(isset($volver)){
		$url_volver = HOST.$volver;
	}else{
		$url_volver = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']: '';
	} ?>
	<div class="responsive_menu_p responsive_movil_on">
		<i class="icon-filled-menu"></i>
	</div>
	<?php if(isset($volver)){ ?>
	<div class="volver responsive_movil_off" onclick="window.location = '<?php echo $url_volver ?>'">
		<i class="icon-lineal-flecha volver"></i>
	</div>
	<?php } ?>
	<h2 class="responsive_movil_off">Plan de Intervenciones Colectivas</h2>
	<h2 class="responsive_movil_on">PIC</h2>
	<?php if ($tipo_usuario != 'generador' && $_SESSION['ses_municipio'] != 'Elige Municipio'){ ?>
	<a href="<?php echo HOST?>elegir_municipio" class="button btn_outline">
		<i class="icon-filled-ubicacion"></i>
		<span><?php echo ucfirst($_SESSION['ses_municipio']) ?></span>
	</a>
	<?php } ?>
</div>