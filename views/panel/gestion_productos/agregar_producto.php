<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();
require_once LIBS."verificar_admin.php";

$estilos = ['estilos_panel.css','comp_select.css','estilos_form.css'];
include VIEWS.'templates/head.php';
$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

?>

<main>
	<div class="panel" id="agregar_producto">
		<?php
		$gestion_productos = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php $volver = 'gestion_productos'; include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form" method="POST" action="<?php echo CONTROLLERS?>panel/gestion_productos/c_agregar_producto.php" id="form_agregar_producto" enctype="multipart/form-data">
				<h2>Agregar producto educomunicativo</h2>
				<div class="input s100">
					<h3>Categoria.</h3>
					<div class="select" id="categoria" data="">
						<div class="head_select">
							<span class="nombre_select">Seleccione Categoria</span>
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
						<input type="hidden" name="categoria" value="" />
					</div>
				</div>
				<div class="input s100">
					<h3>Tipo de producto.</h3>
					<div class="select" id="tipo" data="">
						<div class="head_select">
							<span class="nombre_select">Seleccione Tipo</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<div class="opcion"><i class="icon-filled-check"></i><span>Cuento</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>Copla</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>Canción</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>Obra de teatro</span></div>
						</div>
						<input type="hidden" name="tipo" value="" />
					</div>
				</div>
				<div class="input s100">
					<h3>Titulo.</h3>
					<div class="contenido_input"><input class="input input_text" type="text" name="titulo"  placeholder="Ingresar titulo..." /></div>
				</div>
				<div class="input s100">
					<h3>Descripción.</h3>
					<div class="contenido_input"><textarea class="input input_text" name="descripcion" id="" placeholder="Ingresar Descripción..."></textarea></div>
				</div>
				<div class="input s100">
					<h3>Año de creación.</h3>
					<div class="select" id="year" data="">
						<div class="head_select">
							<span class="nombre_select">Seleccione Año</span>
							<i class="icon-arrow"></i>
						</div>
						<div class="opciones">
							<div class="opcion"><i class="icon-filled-check"></i><span>2014</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>2015</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>2016</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>2017</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>2018</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>2019</span></div>
							<div class="opcion"><i class="icon-filled-check"></i><span>2020</span></div>
						</div>
						<input type="hidden" name="year" value="" />
					</div>
				</div>
				<div class="input s100">
					<h3>Agregar Archivo(s).</h3>
					<div class="contenido_input">
						<div id="contenido_img" class="contenido_img">
							<div id="loading_inf_1" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt=""></div>
							<div class="agregar_mult">
					        	<input class="input_mult input_preview" id="input_file_1" name="images[]" type="file" required />
					            <!-- accept="image/*" or accept="image/jpeg,image/png" -->
					            <label class="label_icon icon-filled-add-multimedia" for="input_file_1"></label>
								<div class="div_button"><label class="button" for="input_file_1">Agregar</label></div>
					        </div>
						</div>
					</div>
				</div>
				<input type="hidden" name="fecha" value="" />
				<div class="content_button next">
					<button type="submit" class="button"><i class="icon-filled-check"></i>Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</main>
<?php 
$scripts = ['comp_select.js'];
include VIEWS.'templates/foot.php'; 
?>