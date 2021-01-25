<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'modulo.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css','summernote.css'];
require VIEWS.'templates/head.php';

if (isset($_GET['id'])) {
$id_modulo = $_GET['id'];

$obj_modulo = new Modulo();
$row = $obj_modulo->detalles_actividad($id_modulo);
}

$cuenta = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main">
		<div class="contenido" id="agregar_actividad">
			<?php
			require_once LIBS.'verificar_sesion.php';
			$object = $row;
			require_once LIBS.'empty.php';
			if ($flag_empty === False){ ?>
			<form id="form_agregar_actividad" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_agregar_actividad_general.php" enctype="multipart/form-data">
				<h2>Agregar Actividad</h2>
				<div class="input s100">
					<h3>Nombre de actividad</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="nombre"  placeholder="Ingresar Nombre..." /></div>
				</div>
				<div class="input s100">
					<h3>Descripción actividad</h3>
					<div class="editor editor_pb"><textarea id="editor_texto" name="descripcion" height = '400px'></textarea></div>
				</div>
				<div class="input s100">
					<h3>Agregar contenido multimedia.</h3>
					<div class="contenido_input">
						<div id="contenido_img" class="contenido_img">
							<div id="loading_inf_1" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt=""></div>
							<div class="agregar_mult">
					            <input class="input_preview input_mult" id="input_file_1" name="files[]" type="file" required />
					            <!-- accept="image/*" or accept="image/jpeg,image/png" -->
					            <label class="label_icon icon-filled-add-multimedia" for="input_file_1"></label>
								<div class="div_button"><label class="button" for="input_file_1">Agregar</label></div>
					        </div>
						</div>
					</div>
				</div>
				<div class="input s50">
					<h3>Tiempo estimado de actividad (minutos)</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="tiempo"  placeholder="Ingresar tiempo..." /></div>
				</div>
				<input type="hidden" name="id_modulo" value="<?php echo $id_modulo ?>" />
				<?php if (isset($_GET['validate_msj'])) {
					echo '<div class="input s100"><div class="validate_msj">'.$_GET['validate_msj'].'</div></div>';
				} ?>
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-check"></i>Aceptar</button>
				</div>
			</form>
		<?php } ?>
		</div>
	</div>
</main>
<?php
$scripts = ['summernote.js','funciones_editor_texto.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>