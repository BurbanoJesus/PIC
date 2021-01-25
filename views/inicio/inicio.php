<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'inicio.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css','comp_slider.css','comp_modal.css'];
require_once VIEWS.'templates/head.php';

$obj_inicio = new Inicio();
$array = $obj_inicio->listar_slider();

$inicio = "active";
include VIEWS.'templates/header.php';
?>
<main>
	<div class="main" id="inicio">
		<div class="contenido">
			<div class="base_slider slider_move">
				<div id="contenedor_slider" class="contenedor_slider">
					<div id="slider" class="slider">
						<?php foreach ($array as $key => $row) { 
						if ($key == 0 && isset($_SESSION['usuario'])){}else{
						?>
					    <section id="elemento_<?php echo $key ?>" class="slider_section parent_me_elemento" id_data="<?php echo $row->url?>" url_data="c_eliminar_imagen_inicio" slider="slider">
					    	<?php 
							$type = type_multimedia($row->url);
							if ($type == 'imagen') { ?>
								<div class="file_multimedia"><img index="0" src="<?php echo $row->url?>" target="theater" class="call_theater simple file" /></div>
							<?php } else { ?>
								<div class="file_multimedia"><video index="0" target="theater" class="call_theater simple file" src="<?php echo $row->url?>" type="video/mp4" controls></video></div>
							<?php } ?>
							<?php if ($key == 0) { ?>
							<div class="info_section">
								<h2 class="responsive_movil_off">Abre tu cuenta gratis</h2>
								<span class="responsive_movil_off">Puedes crear tu cuenta registrandote gratis y disfrutar los servicios del sistio web del plan de intervenciónes colectivas.</span>
								<span class="responsive_movil_on">Registrate y disfruta los servicios del sistio web del plan de intervenciónes colectivas.</span>
								<a href="<?php echo HOST?>registrar_usuario" class="button section bg_b">Registrarse</a>
							</div>
							<?php } ?>
							<?php if ($tipo_usuario == 'administrador' && $key > 0){ ?>
								<div class="menu_elemento">
									<div class="me_icon filled">
										<i class="icon-filled-ellipsis"></i>
									</div>
									<div class="me_opciones">
										<!-- <span class="me_opcion me_eliminar"><i class="icon-filled-editar"></i>Editar</span> -->
										<span class="me_opcion me_eliminar">
											<i class="icon-filled-eliminar-b"></i>
											Eliminar
										</span>
									</div>
								</div>
							<?php } ?>
					    </section>
					   	<?php } 
					    } ?>
					</div>
				    <div id="btn_prev" class="btn_prev">
				    	<i class="icon-arrow-c"></i>
				    </div>
				    <div id="btn_next" class="btn_next">
				    	<i class="icon-arrow-c"></i>
				    </div>
				</div>
			</div>
			<?php if ($tipo_usuario == 'administrador') { ?>
			<form id="form_agregar_inicio" class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/c_inicio.php" enctype="multipart/form-data">
				<div class="input s100">
					<h3 class="text_center">Agregar Imagenes.</h3>
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
					<div class="content_button">
						<button type="submit" class="button">
							<i class="icon-filled-check"></i>
							Registrar
						</button>
					</div>
				</div>
			</form>
			<?php } ?>
			<div class="informacion last">
				<h2>Emisora Online</h2>
				<div class="emisora" onclick="window.open('http://node-35.zeno.fm/n0sng4z7mzzuv?fbclid=IwAR2WWkxisuhtFff-uze7h8e4htNGMF6T4MklYEwjaocwS9PjhhITjDFnlz4&rj-ttl=5&rj-tok=AAABcl2JkU0AQqkS_8vXl37g2g','_blank')" >
					<video muted autoplay loop playsinline src="<?php echo IMG?>default/emisora.mp4"></video>
					<!-- <img src="<?php echo IMG?>default/emisora.gif" alt=" /"> -->
					<!-- <iframe class="iframe" src="http://node-35.zeno.fm/n0sng4z7mzzuv?fbclid=IwAR2WWkxisuhtFff-uze7h8e4htNGMF6T4MklYEwjaocwS9PjhhITjDFnlz4&rj-ttl=5&rj-tok=AAABcl2JkU0AQqkS_8vXl37g2g" frameborder="0" style="border:0"></iframe> -->
				</div>
			</div>
		</div>
		<div id="theater" class="theater" data="">
			<div index="" class="indicador"></div>
			<div class="close"><i class="icon-cancelar"></i></div>
			<div index="" class="btn_left"><i class="icon-arrow-c"></i></div>
			<div index="" class="btn_right"><i class="icon-arrow-c"></i></div>
			<div class="theater_main">
				<div class="theater_content">
					<img index="0" src="" id="img_theater">
				</div>
			</div>
		</div>
		<div id="div_mod_eliminar"></div>
	</div>	
</main>
<?php
$scripts = ['comp_slider.js','comp_modal.js'];
include VIEWS.'templates/footer.php'; 
include VIEWS.'templates/foot.php';
?>