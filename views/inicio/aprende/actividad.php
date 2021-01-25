<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'usuario.php';
require_once MODELS.'actividad.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_tablas.css','comp_modal.css','comp_slider.css'];
require_once VIEWS.'templates/head.php';

$tipo_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario']->tipo_usuario : '';
$id_actividad = isset($_GET['id']) ? $_GET['id'] : '';

$obj_actividad = new Actividad();
$array = $obj_actividad->detalles($id_actividad);
$row_principal = $array[0];
// var_dump($array);

$id_curso = $obj_actividad->detalles_curso($id_actividad);
$obj_usuario = new Usuario();
$subs = $obj_usuario->comprobar_suscripcion($id_curso);
$subs = ($subs !== False || $subs !== Null) ? True : False;
// var_dump($subs);

$aprende = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main" id="actividad_general">
		<div class="contenido" id="actividad" id_data="<?php echo $row_principal->id_actividad ?>" id_modulo="<?php echo $row_principal->id_modulo ?>" subs="<?php echo $subs ?>">
			<?php
			require_once LIBS.'verificar_sesion.php';
			require_once LIBS.'subs_not.php';
			if ($flag_subs === False){ 
			?>
			<div class="detalles_pb">
				<div class="base_slider slider_move">
					<div id="contenedor_slider" class="contenedor_slider">
						<div id="slider" class="slider">
							<?php
							$flag_archivos = True;
							$cont_slider = 0;
							foreach ($array as $key => $row){
							if ($row->tipo == 'image' || $row->tipo == 'video' || $row->tipo == 'audio'){
								$cont_slider++;
							?>
						    <section id="elemento_<?php echo $key ?>" class="slider_section parent_me_elemento" id_data="<?php echo $row->url?>" url_data="c_eliminar_imagen_inicio" slider="slider">
						    	<?php 
								$type = type_multimedia($row->url);
								if($type == 'imagen'){ ?>
									<div class="img"><img index="0" src="<?php echo $row->url?>" target="theater" class="call_theater simple file" /></div>
								<?php } else if($type == 'video'){ ?>
									<div class="img"><video index="0" target="theater" class="call_theater simple file" src="<?php echo $row->url?>" type="video/mp4" controls></video></div>
								<?php } else if($row->tipo_preview == 'audio'){?>
									<div class="img"><audio index="0" target="theater" class="call_theater simple file" src="<?php echo $row->url?>" type="audio/mp3" controls></audio></div>
								<?php } ?>
						    </section>
						   	<?php }else{
						   			$flag_archivos = False;
						   		}
						   	}	
						   	if ($cont_slider == 0){?>
					   		<section id="elemento_0" class="slider_section parent_me_elemento">
								<div class="img"><img index="0" src="<?php echo IMG?>default/default_actividad.jpg" target="theater" class="call_theater simple file" /></div>
						    </section>
							<?php } ?>
						</div>
						<?php if ($cont_slider > 1){ ?>
					    <div id="btn_prev" class="btn_prev"><i class="icon-arrow-c"></i></div>
					    <div id="btn_next" class="btn_next"><i class="icon-arrow-c"></i></div>
						<?php } ?>
					</div>
				</div>
				<h1 class="detalles">Actividad: <?php echo $row_principal->nombre_actividad ?></h1>
				<span class="detalles">Actividad</span>
				<?php echo $row_principal->descripcion ?>
				<div class="enlaces_files">
					<?php if ($flag_archivos === False){ ?>
					<span>Archivos disponibles:</span>
					<!-- <div class="file_head">
						<span class="file_head_sp">Tipo</span>
						<span class="file_head_sp">Nombre</span>
						<span class="file_head_sp">Descargar</span>
					</div>
					<div class="file">
						<i class="icon-filled-pdf file_l"></i>
						<a href="<?php echo IMG?>actividad.pdf" download>PDF EXPERIENCIAS -MOVILIZACION SOCIAL</a>
						<i class="icon-filled-descargar file_r"></i>
					</div> -->
					<div class="tabla">
						<table>
							<thead>
								<tr class="tr_sin_color">
									<th width="45">Tipo</th>
									<th class="left">Nombre</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($array as $key => $row){
								if ($row->tipo != 'image' && $row->tipo != 'video'){
								// var_dump($row->tipo);
								$tipo_icon = tipo_icon_mult($row->tipo);
								$nombre_archivo = name_url($row->url)
								?>
								<tr>
									<td class="no_padd"><?php echo $tipo_icon ?></td>
									<td class="left"><div class="ellipsis"><?php echo $nombre_archivo ?></div></td>
									<td class="td_acciones">
										<div class="div_acciones">
											<a href="<?php echo $row->url ?>" class="acciones" download="<?php echo $nombre_archivo ?>">
												<i class="icon-filled-descargar" ></i>
												<span class="icon_info">Descargar</span>
											</a>
										</div>
									</td>
								</tr>
								<?php } 
								} ?>
							</tbody>
						</table>
					</div>
					<?php } ?>
				</div>
				<div class="temporizador">
					<div class="content_temp">
						<span class="sp_temp">Tiempo para finalizar la actividad:</span>
						<span id="tiempo">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; display: block; shape-rendering: auto;" width="30px" height="23px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
							<rect x="17.5" y="30" width="15" height="40" fill="#9e9e9e">
							  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
							  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
							</rect>
							<rect x="42.5" y="30" width="15" height="40" fill="#9e9e9e">
							  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
							  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
							</rect>
							<rect x="67.5" y="30" width="15" height="40" fill="#9e9e9e">
							  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
							  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
							</rect>
							</svg>
						</span>
					</div>
				</div>
				<div class="buttons_inline">
					<button id="btn_actividad" class="button btn_finalizar_actividad disabled">Finalizar Actividad</button>
					<button onclick="window.location = '<?php echo HOST.'actividades?id='.$row_principal->id_modulo ?>'" class="button">Volver Actividades</button>
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
		<?php } ?>
		</div>
	</div>	
</main>
	
<?php
$scripts = ['comp_slider.js','comp_temporizador.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>