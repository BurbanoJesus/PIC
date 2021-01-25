<header>
	<div class="header">
		<div class="top_login">
			<div class="main_titulo responsive_movil_on" onclick="window.location = '<?php echo HOST?>inicio'">
				<img src="<?php echo IMG?>mingas_logo_b.png" alt="logo" />
				<span>PLAN DE INTERVENCIÓNES COLECTIVAS</span>
			</div>
			<div class="actualizacion">
				<!-- <div class="div_ult_act responsive_movil_off">
					<span>Ultima actualizacion:</span>
					<span class="ult_act"></span>
				</div> -->
				<div class="redes">
					<i onclick="window.open('https://www.facebook.com/Plan-de-Intervenciones-Colectivas-de-Nari%C3%B1o-128153758725791/','_blank')" class="icon-redes-facebook"></i>
					<i onclick="window.open('https://www.youtube.com/channel/UCVdasRx724Zz0BXZwV4xbFA?disable_polymer=true','_blank')" class="icon-redes-twitter"></i>
				</div>
			</div>
			<?php 
			$estado_sesion = (!isset($_SESSION['usuario'])) ? 'INICIAR SESIÓN': 'CERRAR SESIÓN'; 
			$url_sesion = (!isset($_SESSION['usuario'])) ? HOST.'login': HOST.'logout'; 
			?>
			<div class="sesion">
				<!-- <div class="version_beta">Version Beta</div> -->
				<?php if (!isset($_SESSION['usuario'])){ ?>
					<a href="<?php echo $url_sesion?>" class="login outline responsive_movil_off">
						<i class="icon-filled-user"></i>
						<?php echo $estado_sesion ?>
					</a>
					<a href="<?php echo HOST?>registrar_usuario" class="login outline responsive_movil_off">
						<i class="icon-filled-check"></i>
						Registrarse
					</a>
				<?php } ?>
				<div class="init_perfil">
					<?php 
					$tipo_usuario = '';
					// var_dump($_SESSION['usuario']->usuario);
					if (isset($_SESSION['usuario'])){ 
						$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
						$img_preview = $_SESSION['usuario']->img_preview;
						if($tipo_usuario != 'general'){
							$str_nombre = $_SESSION['usuario']->tipo_usuario;
						}else{
							$str_nombre = $_SESSION['usuario']->nombres;
							$str_nombre = explode(' ',$str_nombre)[0];
						}
					?>
					<div class="menu_elemento usuario">
						<div class="info_sesion me_icon">
							<span class="responsive_movil_off"><?php echo ucfirst($str_nombre) ?></span>
							<div class="img_usuario">
								<img class="img_head_preview" src="<?php echo $img_preview?>" alt="" />
							</div>
						</div>
						<div class="me_opciones">
							<div class="me_info_detalles">
								<img src="<?php echo $img_preview?>" alt="" />
								<span><?php echo ucfirst($str_nombre) ?></span>
								<span class="sub"><?php echo $_SESSION['usuario']->correo ?></span>
							</div>
							<?php if ($tipo_usuario == 'administrador' || $tipo_usuario == 'supervisor'){ ?>
							<span class="me_opcion me_panel" onclick="window.location = '<?php echo HOST?>panel'">
								<i class="icon-filled-set"></i>
								Panel PIC
							</span>
							<?php } ?>
							<?php if ($tipo_usuario == 'generador'){ ?>
							<span class="me_opcion me_panel" onclick="window.location = '<?php echo HOST?>seleccionar_fecha'">
								<i class="icon-filled-set"></i>
								Panel PIC
							</span>
							<?php } ?>
							<span class="me_opcion me_ver_perfil">
								<i class="icon-filled-user"></i>
								Ver Perfil
							</span>
							<span class="me_opcion me_cerrar_sesion">
								<i class="icon-filled-power"></i>
								Cerrar Sesion
							</span>
						</div>
					</div>
					<?php }else{ ?>
						<!-- <i class="icon-perfil-login"></i> -->
						<!-- <div class="crear_cuenta">
							<a href="<?php echo HOST?>registrar_usuario" class="crear_cuenta">Crear Cuenta</a>
						</div> -->
					<?php } ?>
				</div>
			</div>
			<div class="responsive_menu responsive_movil_on">
				<i class="icon-filled-menu"></i>
			</div>
		</div>
		<?php include VIEWS.'templates/menu_i.php'; ?>
	</div>
</header>