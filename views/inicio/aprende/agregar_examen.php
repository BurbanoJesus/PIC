<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'modulo.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css','summernote.css','comp_select.css'];
require VIEWS.'templates/head.php';

if (isset($_GET['id'])) {
	$id_modulo = $_GET['id'];

	$obj_modulo = new Modulo();
	$row = $obj_modulo->detalles_actividad($id_modulo);
}

$aprende = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main" id="agregar_examen">
		<div class="contenido">
			<?php
			require_once LIBS.'verificar_sesion.php';
			$object = $row;
			require_once LIBS.'empty.php';
			if ($flag_empty === False){ ?>
			<form id="form_agregar_examen" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_agregar_examen.php">
				<h2>Agregar Examen</h2>
				<div class="input s100">
					<h3>Nombre del examen</h3>
					<div class="contenido_input"><input class="input" type="text" name="nombre"  placeholder="Ingresar nombre..." required /></div>
				</div>
				<div class="input s100">
					<h3>Descripción del examen</h3>
					<div class="contenido_input"><textarea class="input input_text" name="descripcion"  placeholder="Ingresar descripción..." required></textarea></div>
				</div>
				<div class="input s100">
					<h3>Tiempo del examen</h3>
					<div class="contenido_input"><input class="input" type="text" name="tiempo"  placeholder="Ingresar tiempo..." required /></div>
				</div>
				<div class="separador"></div>
				<div class="content_examen">
					<div class="contenido_preguntas">
						<div class="input s100">
							<h3>Pregunta 1.</h3>
							<div class="contenido_input"><textarea class="input input_text" name="pregunta_1"  placeholder="Ingresar Información..." required></textarea></div>
						</div>
						<div class="input s100">
							<h3>Respuesta Correcta.</h3>
							<div class="contenido_input"><input class="input" type="text" name="respuesta_1"  placeholder="Ingresar respuesta..." required /></div>
							<h3>Respuesta Incorrecta.</h3>
							<div class="contenido_input"><input class="input" type="text" name="respuesta_a1"  placeholder="Ingresar respuesta..." required /></div>
							<h3>Respuesta Incorrecta.</h3>
							<div class="contenido_input"><input class="input" type="text" name="respuesta_b1"  placeholder="Ingresar respuesta..." required /></div>
							<h3>Respuesta Incorrecta.</h3>
							<div class="contenido_input"><input class="input" type="text" name="respuesta_c1"  placeholder="Ingresar respuesta..." required /></div>
						</div>
					</div>
				</div>
				<div class="content_button agregar_nuevo">
					<a id="add_pregunta" class="button" type="button"><i class="icon-lineal-add"></i>Agregar Nueva Pregunta</a>
					<a id="remove_pregunta" class="disabled button" type="button"><i class="icon-cancelar"></i>Quitar Pregunta</a>
				</div>
				<input type="hidden" name="fecha" value="" />
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
$scripts = ['summernote.js','funciones_editor_texto.js','comp_select.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>