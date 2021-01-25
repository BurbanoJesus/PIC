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
	<div class="panel" id="agregar_ubicacion">
		<?php
		$gestion_ubicaciones = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php $volver = 'gestion_productos'; include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s70" method="POST" action="<?php echo CONTROLLERS?>panel/gestion_ubicaciones/c_agregar_ubicacion.php" id="agregar_ubicacion" enctype="multipart/form-data">
				<h2>Agregar un nueva ubicación</h2>
				<div class="input s100">
					<h3>Nombre.</h3>
					<div class="contenido_input"><input class="input" type="text" name="titulo"  placeholder="Ingresar titulo..." required /></div>
				</div>
				<div class="input s100">
					<h3>Descripción.</h3>
					<div class="contenido_input"><textarea class="input input_text" name="descripcion" id="" placeholder="Ingresar Descripción..."></textarea></div>
				</div>
				<div class="input s100">
					<h3>Elegir Ubicación.</h3>
					<div class="maps">
						<input id="search_maps" type="text" placeholder="Buscar Lugar...">
						<div id="map" style="height: 800px;"></div>
						<div class="btn_geolo">
							<div class="img_geolo"></div>
						</div>
						<div class="div_lat_lng" style="display: none;">
							<input class="lat" type="text" name="latitud" required>
							<input class="lng" type="text" name="longitud" required>
						</div>
					</div>
				</div>
				<div class="input s100">
					<h3>Agregar Contenido Multimedia.</h3>
					<div class="contenido_input">
						<div id="contenido_img" class="contenido_img">
							<div id="loading_inf_1" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt=""></div>
							<div class="agregar_mult">
					            <input class="input_preview input_mult" id="input_file_1" name="images[]" type="file" required />
					            <!-- accept="image/*" or accept="image/jpeg,image/png" -->
					            <label class="label_icon icon-filled-add-multimedia" for="input_file_1"></label>
								<div class="div_button"><label class="button" for="input_file_1">Agregar</label></div>
					        </div>
						</div>
					</div>
				</div>
				<input type="hidden" name="fecha" value="" />
				<div class="content_button siguiente">
					<button type="submit" class="button"><i class="icon-filled-check"></i>Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</main>
<?php 
$scripts = ['https://maps.googleapis.com/maps/api/js?key=AIzaSyChPpLC5zuF6bKJYUb7Br2-geN5UvbxBC4&libraries=places','mapas_registro.js','comp_select.js'];
include VIEWS.'templates/foot.php'; 
?>