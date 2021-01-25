<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'municipio.php';
require MODELS.'usuario.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css','comp_select.css','jquery.Jcrop.min.css'];
require VIEWS.'templates/head.php';
$cuenta = "active";
include VIEWS.'templates/header.php';

$usuario = (isset($_GET['id'])) ? $_GET['id'] : '';

$obj_municipio = new Municipio();
$array_municipio = $obj_municipio->listar();

$obj_usuario = new Usuario();
$row = $obj_usuario->usuario_por_nickname_all($usuario);

// var_dump($row);

// var_dump($_SESSION['url_redirect']);
// var_dump($url_redirect);
?>

<main>
	<div class="main" id="editar_usuario">
		<div class="contenido">
			<form id="form_editar_usuario" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/usuarios/c_editar_usuario.php" enctype="multipart/form-data">
				<h2 class="h2_informacion">Editar usuario</h2>
				<div class="input s100">
					<h3 class="text_center">Imagen.</h3>
					<div class="contenido_input">
						<div id="contenido_img" class="contenido_img jcrop">
							<div id="loading_inf_1" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt="" /></div>
							<div class="agregar_mult jcrop">
								<img class="img_actual" src="<?php echo $row->img_usuario?>" alt="" />
					        	<input class="input_file_one input_preview input_jcrop input_editar" id="input_file_1" name="image" type="file" accept="image/*"/>
					            <label class="label_icon label_editar" for="input_file_1"><i class="icon-filled-editar"></i><span>Cambiar</span></label>
								<!-- <div class="div_button"><label class="button" for="input_file_1">Agregar</label></div> -->
					        </div>
						</div>
					</div>
					<input type="hidden" name="x" value="" />
					<input type="hidden" name="y" value="" />
					<input type="hidden" name="w" value="" />
					<input type="hidden" name="h" value="" />
					<input type="hidden" name="usuario_actual" value="<?php echo $row->usuario ?>" />
					<input type="hidden" name="carpeta_usuario" value="<?php echo $row->carpeta_usuario ?>" />
					<input type="hidden" name="img_preview" value="<?php echo $row->img_preview ?>" />
					<input type="hidden" name="img_usuario" value="<?php echo $row->img_usuario ?>" />
				</div>
				<div class="input s100">
					<h3>Nombres</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="nombres"  placeholder="Ingresar Nombres..." value="<?php echo $row->nombres ?>" /></div>
				</div>
				<div class="input s100">
					<h3>Tipo de identificación</h3>
					<div class="select" id="tipo_id" data="<?php echo $row->tipo_id ?>">
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
					<div class="contenido_input"><input class="input input_text" type="text" name="identificacion"  placeholder="Ingresar número de identificación..." value="<?php echo $row->identificacion ?>" /></div>
				</div>
				<div class="input s100">
					<h3>Número de telefono</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="telefono"  placeholder="Ingresar número de telefono..." value="<?php echo $row->telefono ?>" /></div>
				</div>
				<div class="input s100">
					<h3>Municipio</h3>
					<div class="select" id="municipio" data="<?php echo $row->municipio ?>">
						<div class="head_select">
							<span class="nombre_select">Seleccione Municipio</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<?php foreach ($array_municipio as $key => $row_municipio) { ?>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span><?php echo ucwords($row_municipio->municipio)?></span></div>
							<?php } ?>
						</div>
						<input type="hidden" name="municipio" value="" />
					</div>
				</div>
				<div class="input s100">
					<h3>Correo Electrónico</h3>
					<div class="contenido_input"><input class="input input_correo" type="text" name="correo"  placeholder="Ingresar Correo..." value="<?php echo $row->correo ?>" /></div>
				</div>			
				<input type="hidden" name="fecha" value="" />
				<input type="hidden" name="url" value="<?php echo $url_redirect ?>" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-editar"></i>Actualizar</button>
				</div>
			</form>
		</div>
	</div>
</main>
<?php
$scripts = ['jquery.Jcrop.min.js','comp_select.js','jrecortar_perfil.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>