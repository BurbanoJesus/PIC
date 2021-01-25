<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include MODELS.'municipio.php';
session_start();
require_once LIBS."verificar_admin.php";

$estilos = ['estilos_panel.css','comp_select.css','estilos_form.css','jquery.Jcrop.min.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

$obj_municipio = new Municipio();
$array_municipio = $obj_municipio->listar();

?>

<main>
	<div class="panel" id="agregar_usuario">
		<?php
		$gestion_usuarios = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php $volver = 'gestion_usuarios'; include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form id="form_registrar_usuario" class="form" method="POST" action="<?php echo CONTROLLERS?>panel/gestion_usuarios/c_agregar_usuario.php" enctype="multipart/form-data">
				<h2>Agregar usuario</h2>
				<div class="input s100">
					<h3>Tipo de usuario</h3>
					<div class="select" id="tipo_id" data="">
						<div class="head_select">
							<span class="nombre_select">Seleccione tipo de usuario</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<div class="opcion"><i class="icon-filled-ubicacion"></i><span>general</span></div>
							<div class="opcion"><i class="icon-filled-ubicacion"></i><span>generador</span></div>
							<div class="opcion"><i class="icon-filled-ubicacion"></i><span>supervisor</span></div>
						</div>
						<input type="hidden" name="tipo_usuario" value="" />
					</div>
				</div>
				<div class="input s100">
					<h3>Nombres</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="nombres"  placeholder="Ingresar Nombres..." /></div>
				</div>
				<div class="input s100">
					<h3>Tipo de identificación</h3>
					<div class="select" id="tipo_id" data="">
						<div class="head_select">
							<span class="nombre_select">Seleccione tipo de identificación</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<div class="opcion"><i class="icon-filled-ubicacion"></i><span>Cedula de ciudadania</span></div>
							<div class="opcion"><i class="icon-filled-ubicacion"></i><span>Tarjeta de identidad</span></div>
						</div>
						<input type="hidden" name="tipo_id" value="" />
					</div>
				</div>
				<div class="input s100">
					<h3>Número de identificación</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="identificacion"  placeholder="Ingresar número de identificación..." /></div>
				</div>
				<div class="input s100">
					<h3>Número de telefono</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="telefono"  placeholder="Ingresar número de telefono..." /></div>
				</div>
				<div class="input s100">
					<h3>Municipio</h3>
					<div class="select" id="municipio" data="">
						<div class="head_select">
							<span class="nombre_select">Seleccione Municipio</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<?php foreach ($array_municipio as $key => $row) { ?>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span><?php echo ucwords($row->municipio)?></span></div>
							<?php } ?>
						</div>
						<input type="hidden" name="municipio" value="" />
					</div>
				</div>
				<div class="input s100">
					<h3>Crear Usuario</h3>
					<div class="contenido_input"><input class="input input_usuario" type="text" name="usuario"  placeholder="Ingresar Usuario..." /></div>
				</div>
				<div class="input s100">
					<h3>Correo Electrónico</h3>
					<div class="contenido_input"><input class="input input_correo" type="text" name="correo"  placeholder="Ingresar Correo..." /></div>
				</div>
				<div class="input s100">
					<h3>Crear Contraseña</h3>
					<div class="contenido_input">
						<input class="input input_pass pass_equal" type="password" name="password"  placeholder="Ingresar Contraseña..." minlength="2" />
						<div class="icon_pass"><i class="icon-lineal-visible pass_db"></i></div>
					</div>
				</div>
				<div class="input s100">
					<h3>Repetir Contraseña</h3>
					<div class="contenido_input">
						<input class="input input_pass pass_equal" type="password" name="password_b"  placeholder="Ingresar Contraseña..." minlength="2" />
						<div class="icon_pass"><i class="icon-lineal-visible pass_db"></i></div>
					</div>
				</div>
				<div class="input s100" id="jcrop_otro">
					<h3 class="text_center">Agregar Imagen.</h3>
					<div class="contenido_input">
						<div id="contenido_img" class="contenido_img jcrop">
							<div id="loading_inf_1" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt=""></div>
							<div class="agregar_mult jcrop">
					        	<input class="input_file_one input_preview input_jcrop" id="input_file_1" name="image" type="file" accept="image/*" required />
					            <!-- accept="image/*" or accept="image/jpeg,image/png" -->
					            <label class="label_icon icon-filled-add-multimedia" for="input_file_1"></label>
								<div class="div_button"><label class="button" for="input_file_1">Agregar</label></div>
					        </div>
						</div>
					</div>
					<input type="hidden" name="x" value="" />
					<input type="hidden" name="y" value="" />
					<input type="hidden" name="w" value="" />
					<input type="hidden" name="h" value="" />
					<input type="hidden" name="w_jcrop" value="500" />
				</div>
				<input type="hidden" name="fecha" value="" />
				<input type="hidden" name="url" value="<?php echo $url_redirect ?>" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-check"></i>Registrar</button>
				</div>
			</form>
		</div>
	</div>
</main>
<?php 
$scripts = ['jquery.Jcrop.min.js','comp_select.js','jrecortar_perfil.js'];
include VIEWS.'templates/foot.php'; 
?>