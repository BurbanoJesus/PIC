<div class="div_menu_lateral">
	<div class="menu_lateral">
		<div class="logo">
			<img src="<?php echo IMG?>mingas_logo_b.png">
			<div class="h2">
			 	<h2>PIC</h2>
			 	<h2><?php echo strtoupper($_SESSION['str_logo']) ?></h2>
			 	<!-- <h2 class="b"><?php echo $_SESSION['str_logo'] ?></h2> -->
			</div>
		</div>
		<div class="panel_session">
			<div class="img_usuario">
				<img src="<?php echo $_SESSION['usuario']->img_preview ?>" alt="" />
			</div>
			<span><?php echo $tipo_usuario ?></span>
		</div>
		<nav>
			<a class="<?php echo $generar_informes?>" href="<?php echo HOST?>panel"><i class="icon-filled-admin-c"></i><span>Informes PIC</span></a>
			<a class="<?php echo $busqueda_informes?>" href="<?php echo HOST?>busqueda_informes"><i class="icon-filled-lupa-b"></i><span>Busqueda PIC</span></a>
			<a class="<?php echo $estructura_principal?>" href="<?php echo HOST?>estructura_principal"><i class="icon-filled-atencion"></i><span>Dimensiones</span></a>
			<?php if ($tipo_usuario == 'administrador'){ ?>
			<a class="<?php echo $notificaciones?>" href="<?php echo HOST?>notificaciones">
				<i class="icon-filled-correo"></i><span>Notificaciónes</span>
				<div class="notificacion">
					<i class="icon-filled-notificacion-b"></i>
					<span id="num_notificacion"></span>
				</div>
			</a>
			<a class="<?php echo $gestion_usuarios?>" href="<?php echo HOST?>gestion_usuarios"><i class="icon-filled-grupo"></i><span>Gestión de usuarios</span></a>
			<a class="<?php echo $gestion_ubicaciones?>" href="<?php echo HOST?>gestion_ubicaciones"><i class="icon-filled-ubicacion"></i><span>Gestión de ubicaciones</span></a>
			<a class="<?php echo $gestion_productos?>" href="<?php echo HOST?>gestion_productos"><i class="icon-filled-producto"></i><span>Gestión de productos</span></a>
			<?php } ?>
			<a href="<?php echo HOST?>inicio"><i class="icon-filled-pagina"></i><span>Pagina de Inicio</span></a>
			<!-- <a class="<?php echo $gestion_cursos?>" href="<?php echo HOST?>gestion_cursos"><i class="icon-filled-atencion-check"></i><span>Gestión de cursos</span></a> -->
			<a href="<?php echo HOST?>logout"><i class="icon-filled-power"></i><span>Cerrar Sesion</span></a>
		</nav>
		<div class="footer_p">
			<span>© 2020 Plan de intervenciones colectivas, Todos Los Derechos Reservados.</span>
		</div>
	</div>
	<i class="icon-cancelar-b quitar_menu_lateral responsive_movil_on"></i>
</div>