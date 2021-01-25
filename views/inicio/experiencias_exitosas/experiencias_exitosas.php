<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'producto.php';
session_start();

$estilos = ['estilos_inicio.css','comp_check_radio.css','comp_select.css','comp_modal.css','comp_accordion.css'];
require_once VIEWS.'templates/head.php';

$dimension = (isset($_GET['dimension'])) ? $_GET['dimension'] : '';
$tipo = (isset($_GET['tipo'])) ? $_GET['tipo'] : '';
$year = (isset($_GET['year'])) ? $_GET['year'] : '';
$busqueda = (isset($_GET['busqueda'])) ? $_GET['busqueda'] : '';

$obj_producto = new Producto();
if ($dimension != '' || $tipo != '' || $busqueda != '') {
	switch ($tipo) {
		case 'Cuentos':
			$str_tipo = 'cuento';
			break;
		
		case 'Coplas':
			$str_tipo = 'copla';
			break;
		
		case 'Canciones':
			$str_tipo = 'cancion';
			break;
		
		case 'Obras de teatro':
			$str_tipo = 'obra de teatro';
			break;

		default:
			$str_tipo = '';
			break;
	}
	$array = $obj_producto->filtrar($dimension,$str_tipo,$busqueda);
	$flag_filtrar = True;
	$get_on = '';
} else {
	$array = $obj_producto->listar();
	$flag_filtrar = False;
	$get_on = 'get_on';
}

$experiencias = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main" id="experiencias_exitosas">
		<form method="POST" action="<?php echo CONTROLLERS?>inicio/experiencias_exitosas/c_lista_productos.php" id="form_lista_articulos">
			<div class="content_filtros">
				<div class="r_filtros responsive_movil_on <?php echo $get_on ?>">
					<!-- Icon filled label -->
					<i class="icon-filled-label r_filtros_arrow"></i>
					<span>Dimensiones</span>
				</div>
				<div class="filtros">
					<div class="vista responsive_movil_off">
						<span>Tipo de Vista:</span>
						<i class="icon-filled-lista vista_lista active"></i>
						<i class="icon-filled-galeria vista_grid"></i>
					</div>
					<div class="filtro last">
						<h2 class="responsive_movil_off">Dimensiones</h2>
						<?php
						$array_dim = ['Salud Ambiental','Vida saludable y condiciones no transmisibles','Convivencia social y salud mental','Seguridad alimentaria y nutricional','Sexualidad y derechos sexuales y reproductivo','Vida saludable y enfermedades  Transmisibles','Salud en emergencias y desastres','Salud y ámbito laboral','Autoridad Sanitaria','Poblaciones de mayor vulnerabilidad'];
						$array_tipo = ['Cuentos','Coplas','Canciones','Obras de teatro','Otros'];
						foreach ($array_dim as $key => $row){ ?>
						<div class="accordion_elemento">
							<div class="nombre_elemento">
								<i class="icon-filled-label icon_accordion"></i>
								<span><?php echo $row ?></span>
								<i class="icon-arrow-b arrow_accordion"></i>
							</div>
							<div class="accordion_contenido">
								<div class="accordion_experiencias">
									<a href="<?php echo HOST?>experiencias_exitosas?dimension=<?php echo $row ?>&tipo=<?php echo $array_tipo[0] ?>">
										<!-- Icon filled admin c -->
										<i class="icon-filled-admin-c"></i>
										Cuentos
									</a>
									<a href="<?php echo HOST?>experiencias_exitosas?dimension=<?php echo $row ?>&tipo=<?php echo $array_tipo[1] ?>">
										<i class="icon-filled-admin-c"></i>
										Coplas
									</a>
									<a href="<?php echo HOST?>experiencias_exitosas?dimension=<?php echo $row ?>&tipo=<?php echo $array_tipo[2] ?>">
										<i class="icon-filled-admin-c"></i>
										Canciones
									</a>
									<a href="<?php echo HOST?>experiencias_exitosas?dimension=<?php echo $row ?>&tipo=<?php echo $array_tipo[3] ?>">
										<i class="icon-filled-admin-c"></i>
										Obras de teatro
									</a>
									<a href="<?php echo HOST?>experiencias_exitosas?dimension=<?php echo $row ?>&tipo=<?php echo $array_tipo[4] ?>">
										<i class="icon-filled-admin-c"></i>
										Otros
									</a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<!-- <div class="filtro select">
						<h2>Año</h2>
						<div class="select" id="year" data="<?php echo $year ?>">
							<div class="head_select">
								<span class="nombre_select">Seleccione Año</span>
								<i class="icon-arrow"></i>
							</div>
							<div class="opciones">
								<div class="opcion default"><span>Todos(as)</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2014</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2015</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2016</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2017</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2018</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2019</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2020</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2021</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2022</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2023</span></div>
								<div class="opcion"><i class="icon-filled-ubicacion"></i><span>2024</span></div>
							</div>
							<input type="hidden" name="vereda_barrio" value="" />
						</div>
					</div>
					<div class="content_button">
						<button class="button" type="submit">Aplicar</button>
					</div> -->
				</div>
			</div>
			<div id="contenido" class="contenido">
				<div class="busqueda">
					<div class="div_busqueda">
						<input type="text" name="busqueda" placeholder="Ingresar Busqueda..." value="<?php echo $busqueda ?>" />
						<i onclick="javascript:$('#form_lista_articulos').submit()" class="icon-filled-lupa"></i>
					</div>
				</div>
				<?php if ($flag_filtrar === True && $dimension != ''){ ?>
				<div class="resultados_productos">
					<i class="icon-cancelar-b quitar_filtros"></i>
					<span class="titulo"><?php echo $dimension; ?></span>
					<span class="subtitulo"><?php echo $tipo ?></span>
				</div>
				<?php } ?>
				<div class="productos">
					<?php
					$object = $array;
					require_once LIBS.'empty.php';
					require_once LIBS.'not_found.php';
					if ($flag_empty !== True && $flag_not_found !== True ) {
					foreach ($array as $key => $row) {
						// $serial = serialize($row);
						// $serial = urlencode($serial); // echo $serial para pasarlo por get
						// $_SESSION['row'.$cont]= $row;
						$collect_id[]= $row->id_producto;
						$fecha = to_fecha_str($row->fecha_pub);
						$last = ($key + 1 == count($array)) ? 'last' : '';
					?>
					
					<div id="<?php echo $key?>" class="info_producto parent_me_elemento <?php echo $last ?>" id_data="<?php echo $row->id_producto?>" url_data="c_eliminar_producto">
						<div class="img">
							<?php
							if ($row->tipo_preview == 'image') { ?>
								<img src="<?php echo $row->preview?>" />
							<?php }else if($row->tipo_preview == 'video'){ ?>
								<video>
									<source src="<?php echo $row->preview?>" type="video/mp4">Your browser does not support HTML5 video
								</video>
							<?php }else{ ?>
								<img src="<?php echo IMG?>default/default_preview_producto.png" />
							<?php } ?>
						</div>
						<div class="caracteristicas">
							<h2><?php echo ucfirst($row->titulo) ?></h2>
							<p class="fecha">
								<i class="icon-filled-calendario-b"></i>
								Publicado: <?php echo $fecha ?>
							</p>
							<p>
								<i class="icon-filled-label"></i>
								Dimensión: <?php echo $row->categoria ?>
							</p>
							<p>
								<i class="icon-filled-fecha"></i>
								Año: <?php echo $row->year ?>
							</p>
							<p class="tipo">
								<i class="icon-filled-admin-c"></i>
								Tipo: <?php echo $row->tipo_producto ?>
							</p>
							<!-- <div class="detalles"><span>Ver Detalles </span><i class="icon-arrow-c"></i></div> -->
						</div>
						<!-- <?php if ($tipo_usuario == 'administrador'){ ?>
						<div class="menu_elemento">
							<div class="me_icon"><i class="icon-filled-ellipsis"></i></div>
							<div class="me_opciones">
								<span class="me_opcion me_editar"><i class="icon-filled-editar"></i>Editar</span>
								<span class="me_opcion me_eliminar"><i class="icon-filled-eliminar-b"></i>Eliminar</span>
							</div>
						</div>
						<?php } ?>	 -->
					</div>
					<?php } 
					} ?>
				</div>
				<?php 
				echo '<div class="responsive_movil_off flex_center">';
				$obj_producto->mostrarPaginas(5).'</div>';
				echo '</div>';
				echo '<div class="responsive_movil_on flex_center">';
				$obj_producto->mostrarPaginas(3);
				echo '</div>';
				?>
			</div>
			<div id="div_mod_eliminar"></div>
			<input type="hidden" name="dimension" value="<?php echo $dimension ?>" />
			<input type="hidden" name="tipo" value="<?php echo $tipo ?>" />
		</form>
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
$scripts = ['comp_check_radio.js','comp_accordion.js','comp_modal.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>