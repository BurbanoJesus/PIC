<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'curso.php';
session_start();
require_once LIBS.'verificar_admin.php';

$estilos = ['estilos_inicio.css','estilos_form.css','jquery.Jcrop.min.css','comp_select.css'];
require VIEWS.'templates/head.php';

$id_curso = (isset($_GET['id'])) ? $_GET['id']: '';

$obj_curso = new Curso();
$row = $obj_curso->detalles($id_curso);
var_dump($row);

$cuenta = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main" id="editar_curso">
		<div class="contenido">
			<?php
			$object = $row;
			require_once LIBS.'error404.php';
			if ($flag_error404 === False){ ?>
			<form id="form_editar_curso" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_editar_curso.php" enctype="multipart/form-data">
				<h2>Editar Curso</h2>
				<div class="input s100">
					<h3>Nombre del curso</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="nombre"  placeholder="Ingresar Nombre..."  value="<?php echo $row->nombre_curso ?>" /></div>
				</div>
				<div class="input s100">
					<h3>Descripción del curso</h3>
					<div class="contenido_input"><textarea class="input input_text" name="descripcion"  placeholder="Ingresar Descripción..."><?php echo $row->descripcion ?></textarea></div>
				</div>
				<div class="input s100">
					<h3>Dimensión</h3>
					<div class="select" id="tipo_id" data="<?php echo $row->dimension ?>">
						<div class="head_select">
							<span class="nombre_select">Seleccione dimensión</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<?php
							$array_select = ['Salud Ambiental','Vida saludable y condiciones no transmisibles','Convivencia social y salud mental','Seguridad alimentaria y nutricional','Sexualidad y derechos sexuales y reproductivo','Vida saludable y enfermedades  Transmisibles','Salud en emergencias y desastres','Salud y ámbito laboral','Autoridad Sanitaria','Poblaciones de mayor vulnerabilidad'];
							foreach ($array_select as $key => $row_dim){ ?>
							<div class="opcion">
								<i class="icon-filled-check"></i>
								<span><?php echo $row_dim ?></span>
							</div>
							<?php } ?>
						</div>
						<input type="hidden" name="dimension" value="" />
					</div>
				</div>
				<div class="input s100">
					<h3 class="text_center">Cambiar Imagen.</h3>
					<div class="contenido_input">
						<div id="contenido_img" class="contenido_img jcrop">
							<div id="loading_inf_1" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt="" /></div>
							<div class="agregar_mult jcrop">
								<img class="img_actual" src="<?php echo $row->img_curso ?>" alt="" />
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
					<input type="hidden" name="id_curso" value="<?php echo $row->id_curso ?>" />
					<input type="hidden" name="img_curso" value="<?php echo $row->img_curso ?>" />
				</div>
				<input type="hidden" name="fecha" value="" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-editar"></i>Actualizar</button>
				</div>
			</form>
			<?php } ?>
		</div>
	</div>
</main>
<?php
$scripts = ['jquery.Jcrop.min.js','jrecortar_perfil.js','comp_select.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>