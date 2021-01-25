<div class="menu">
	<div class="main_titulo responsive_movil_off" onclick="window.location = '<?php echo HOST?>inicio'">
		<img src="<?php echo IMG?>mingas_logo_b.png" alt="logo" />
		<span>PLAN DE INTERVENCIÓNES COLECTIVAS</span>
	</div>
	<nav>
		<a class="nav_elemento <?php echo $quienes?>" href="<?php echo HOST?>quienes_somos">Quienes Somos</a>
		<a class="nav_elemento <?php echo $experiencias?>" href="<?php echo HOST?>experiencias_exitosas">Experiencias Exitosas</a>
		<!-- <div class="nav_elemento <?php echo $experiencias?>">
			<span>EXPERIENCIAS EXITOSAS</span>
			<div class="submenu">
				<span class="submenu" onclick="window.location = '<?php echo HOST?>experiencias'"><i class="icon-filled-archivar"></i>CUENTOS</span>
				<span class="submenu" onclick="window.location = '<?php echo HOST?>experiencias'"><i class="icon-filled-archivar"></i>COPLAS</span>
				<span class="submenu" onclick="window.location = '<?php echo HOST?>experiencias'"><i class="icon-filled-archivar"></i>CANCIONES</span>
				<span class="submenu" onclick="window.location = '<?php echo HOST?>experiencias'"><i class="icon-filled-archivar"></i>OBRAS DE TEATRO</span>
				<span class="submenu" onclick="window.location = '<?php echo HOST?>'"><i class="icon-filled-archivar"></i>UBICACIONES PIC</span>
			</div>
		</div> -->
		<a class="nav_elemento <?php echo $ubicaciones?>" href="<?php echo HOST?>ubicaciones">Georeferencia</a>
		<a class="nav_elemento <?php echo $aprende?>" href="<?php echo HOST?>aprende">Aprende</a>
		<a class="nav_elemento <?php echo $juegos?>" href="<?php echo HOST?>juegos">Juegos</a>
		<a class="nav_elemento responsive_movil_on" href="<?php echo $url_sesion?>"><?php echo $estado_sesion ?></a>
		<?php if (!isset($_SESSION['usuario'])) { ?>
		<a class="nav_elemento responsive_movil_on" href="<?php echo HOST?>registrar_usuario">Registrarse</a>
		<?php } ?>
	</nav>
</div>