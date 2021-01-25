<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css','jquery.Jcrop.min.css','comp_select.css'];
require VIEWS.'templates/head.php';

$dimension = (isset($_GET['dimension'])) ? $_GET['dimension']: '';

$cuenta = "active";
include VIEWS.'templates/header.php';

try{

	$carpeta_server =  SERVER."/static/multimedia/cursos/CU5f7401bdb9bbb2.99014220/";
	$sel_archivos =  SERVER."/static/multimedia/cursos/CU5f7401bdb9bbb2.99014220/*";
	if (file_exists($carpeta_server)) {
		$files = glob($sel_archivos);
		var_dump($files);
		foreach($files as $file){
		    if(is_file($file))
		    unlink($file);
		}
		rmdir($carpeta_server);
		echo "string bien";
	}else{
		echo "string";
	}
}catch(Exception $e){
	echo "string catch";
}

?>

<main>
	<div class="main" id="registrar_curso">
		<div class="contenido">
			<?php
			require_once LIBS.'verificar_sesion.php';
			?>
			<form id="form_registrar_curso" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_registrar_curso.php" enctype="multipart/form-data">
				<h2>Registro de cursos</h2>
				<div class="input s100">
					<h3>Nombre del curso</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="nombre"  placeholder="Ingresar Nombre..." /></div>
				</div>
				<div class="input s100">
					<h3>Descripción del curso</h3>
					<div class="contenido_input"><textarea class="input input_text" name="descripcion"  placeholder="Ingresar Descripción..."></textarea></div>
				</div>
				<div class="input s100">
					<h3>Dimensión</h3>
					<div class="select" id="tipo_id" data="<?php echo $dimension ?>">
						<div class="head_select">
							<span class="nombre_select">Seleccione dimensión</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<?php
							$array_select = ['Salud Ambiental','Vida saludable y condiciones no transmisibles','Convivencia social y salud mental','Seguridad alimentaria y nutricional','Sexualidad y derechos sexuales y reproductivo','Vida saludable y enfermedades  Transmisibles','Salud en emergencias y desastres','Salud y ámbito laboral','Autoridad Sanitaria','Poblaciones de mayor vulnerabilidad'];
							foreach ($array_select as $key => $row){ ?>
							<div class="opcion">
								<i class="icon-filled-check"></i>
								<span><?php echo $row ?></span>
							</div>
							<?php } ?>
						</div>
						<input type="hidden" name="dimension" value="" />
					</div>
				</div>
				<div class="input s100" id="jcrop_curso">
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
$scripts = ['jquery.Jcrop.min.js','jrecortar_perfil.js','comp_select.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>