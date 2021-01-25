<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'producto.php';
session_start();

$estilos = ['estilos_inicio.css','comp_modal.css','comp_slider.css','estilos_tablas.css'];
require_once VIEWS.'templates/head.php';

$seguridad = "active";
include VIEWS.'templates/header.php';

$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$obj_producto = new Producto();
$array = $obj_producto->detalles($id);

?>
<main>
	<div class="main" id="detalles_producto">
		<div class="contenido">
			<?php  
			$object = $array;
			require_once LIBS.'error404.php';
			if ($flag_error404 !== True) {
			?>
			<div class="producto">
				<div class="base_slider">
					<div id="contenedor_slider" class="contenedor_slider">
						<div id="slider" class="slider">
							<?php
							$flag_archivos = False;
							$cont_slider = 0;
							$row_principal = $array[0];
							$row_principal->fecha_pub = to_fecha_str($row_principal->fecha_pub);
							foreach ($array as $key => $row){
							if ($row->tipo == 'image' || $row->tipo == 'video' || $row->tipo == 'audio'){
								$cont_slider++;
							?>
						    <section id="elemento_<?php echo $key ?>" class="slider_section parent_me_elemento" id_data="<?php echo $row->url?>" url_data="c_eliminar_imagen_inicio" slider="slider">
						    	<?php 
								if($row->tipo == 'image'){ ?>
									<div class="file_multimedia"><img index="0" src="<?php echo $row->url?>" target="theater" class="call_theater simple file" /></div>
								<?php } else if($row->tipo == 'video'){ ?>
									<div class="file_multimedia"><video index="0" target="theater" class="call_theater simple file" src="<?php echo $row->url?>" type="video/mp4" controls></video></div>
								<?php } else if($row->tipo == 'audio'){?>
									<div class="file_multimedia"><audio index="0" target="theater" class="call_theater simple file" src="<?php echo $row->url?>" type="audio/mp3" controls></audio></div>
								<?php } ?>
						    </section>
						   	<?php }else{
						   			$flag_archivos = True;
						   		}
						   	} 
						   	if (count($array) == 1 && $cont_slider == 0){ ?>
					   		<section id="elemento_0" class="slider_section parent_me_elemento">
								<div class="file_multimedia"><img index="0" src="<?php echo IMG?>default/default_producto.jpg" target="theater" class="call_theater simple file" /></div>
						    </section>
							<?php } ?>
						</div>
						<?php if ($cont_slider > 1){ ?>
					    <div id="btn_prev" class="btn_prev"><i class="icon-arrow-c"></i></div>
					    <div id="btn_next" class="btn_next"><i class="icon-arrow-c"></i></div>
						<?php } ?>
					</div>
				</div>
				<div class="vista_detalles">
					<div class="caracteristicas first">
						<h1><?php echo $row_principal->titulo?></h1>
						<p class="fecha">Publicado: <?php echo $row_principal->fecha_pub ?></p>
					</div>
					<div class="caracteristicas">
						<h2>Descripcion</h2>
						<p><?php echo $row_principal->descripcion ?></p>
					</div>
					<?php $class_flag_archivos = ($flag_archivos === False) ? 'last': '';  ?>
					<div class="caracteristicas <?php echo $class_flag_archivos ?>">
						<h2>Caracteristicas</h2>
						<div class="caracteristica">
							<div class="elemento">
								<h3>Dimension: </h3>
								<p><?php echo $row_principal->categoria ?></p>
							</div>
							<div class="elemento">
								<h3>Tipo: </h3>
								<p><?php echo $row_principal->tipo_producto ?></p>
							</div>
							<div class="elemento">
								<h3>Año: </h3>
								<p><?php echo $row_principal->year ?></p>
							</div>
						</div>
					</div>
					<?php if ($flag_archivos === True){ ?>
					<div class="caracteristicas last">
						<h2>Descargar Archivos</h2>
						<div class="tabla">
							<table>
								<thead>
									<tr class="tr_sin_color">
										<th width="80">Tipo</th>
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
												<a href="<?php echo $row->url ?>" class="acciones" download="<?php echo $nombre ?>">
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
					</div>
					<?php } ?>
				</div>
			</div>
			<div id="theater" class="theater multimedia" data="">
				<div index="" class="indicador"></div>
				<div class="close"><i class="icon-cancelar"></i></div>
				<div index="" class="btn_left"><i class="icon-arrow-c"></i></div>
				<div index="" class="btn_right"><i class="icon-arrow-c"></i></div>
				<div class="theater_main">
					<div class="theater_content">
						
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</main>
	
<?php
$scripts = ['comp_modal.js','comp_slider.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>