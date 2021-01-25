<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'informe.php';
require MODELS.'municipio.php';
session_start();

require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css','estilos_inicio.css','estilos_form.css','comp_modal.css','comp_select.css','estilos_tablas.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['ses_municipio'];

$dimension = (isset($_GET['dimension'])) ? $_GET['dimension'] : '';
$tecnologia = (isset($_GET['tecnologia'])) ? $_GET['tecnologia'] : '';
$year = (isset($_SESSION['ses_year'])) ? $_SESSION['ses_year'] : '';
$grupo = isset($_GET['grupo']) ? $_GET['grupo']: '';

$obj_informe = new Informe();
if ($tipo_usuario == 'administrador' || $tipo_usuario == 'supervisor'){
	$obj_municipio = new Municipio();
	$array_municipio = $obj_municipio->listar();
	$array_dim = ['Salud Ambiental','Vida saludable y condiciones no transmisibles','Convivencia social y salud mental','Seguridad alimentaria y nutricional','Sexualidad y derechos sexuales y reproductivo','Vida saludable y enfermedades  Transmisibles','Salud en emergencias y desastres','Salud y ámbito laboral','Autoridad Sanitaria','Poblaciones de mayor vulnerabilidad'];
	$array_tec = ['Caracterización social y ambiental del entorno','Información en salud','Educación para la salud','Tamizajes','Rehabilitación  Basada en Comunidad','Prevención y Control de Vectores (Obligatorias en zonas endémicas)','Adquisición y suministro de Medicamentos o insumos de uso masivo para la prevención y control o eliminación de interés en salud pública','Vacunación antirrábica','Zonas de orientación y centros de escucha','Conformación y fortalecimiento de redes familiares, comunitarias y sociales','Jornadas de salud','Centros de escucha Comunitarios'];
	$array_gru = ['Presentación Equipo PIC','Fortalecimiento a Redes','Talleres Movilización Social','Réplicas','Eventos','Participación Ciudadana','Producto Educomunicativo','Informes','Reunión Cierre municipio'];
	$array_year = ['2014','2015','2016','2017','2018','2019','2020'];
	if ($dimension != '' || $tecnologia != '' || $year != '' || $grupo != '') {
		// var_dump($municipio);
		// var_dump($dimension);
		// var_dump($tecnologia);
		// var_dump($grupo);
		// var_dump($year);
		$array = $obj_informe->filtrar($municipio,$dimension,$tecnologia,$grupo,$year);
	}else{
		$array = $obj_informe->listar_all($municipio);
	}
}else{
	$array = $obj_informe->listar($usuario,$municipio);
}

?>

<main>
	<div class="panel" id="lista_archivos">
		<?php
		$busqueda_informes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php $volver = 'busqueda_informes'; include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/busqueda_informes/c_lista_archivos.php" id="form_lista_archivos">
				<div class="relative lista_archivos">
					<h2 class="titulo_panel">Lista de informes PIC:</h2>
					<button class="button transparent btn_filtros_lista_archivos" type="button"><i class="icon-filled-filtros-b"></i>Filtros</button>
					<button class="button btn_subir_archivo" type="button" onclick="window.location = '<?php echo HOST?>opciones_informes?opcion=<?php echo $grupo ?>'"><i class="icon-filled-upload-b"></i>Subir archivo</button>
				</div>
				<div class="filtros_panel">
					<div class="filtro">
						<h2 class="responsive_movil_off">Dimension</h2>
						<div class="select filtro" id="dimension" data="<?php echo $dimension ?>">
							<div class="head_select">
								<span class="nombre_select ellipsis">Seleccione dimension</span>
								<i class="icon-arrow"></i>
							</div>
							<div class="opciones">
								<div class="opcion default"><i class="icon-filled-ubicacion"></i><span>Todos(as)</span></div>
								<?php foreach ($array_dim as $key => $value) { ?>
									<div class="opcion"><i class="icon-filled-ubicacion"></i><span><?php echo $value ?></span></div>
								<?php } ?>
							</div>
							<input type="hidden" name="dimension" value="" />
						</div>
					</div>
					<div class="filtro">
						<h2 class="responsive_movil_off">Tecnologia</h2>
						<div class="select filtro" id="tecnologia" data="<?php echo $tecnologia ?>">
							<div class="head_select">
								<span class="nombre_select ellipsis">Seleccione tecnologia</span>
								<i class="icon-arrow"></i>
							</div>
							<div class="opciones">
								<div class="opcion default"><i class="icon-filled-ubicacion"></i><span>Todos(as)</span></div>
								<?php foreach ($array_tec as $key => $value) { ?>
									<div class="opcion"><i class="icon-filled-ubicacion"></i><span><?php echo $value ?></span></div>
								<?php } ?>
							</div>
							<input type="hidden" name="tecnologia" value="" />
						</div>
					</div>
					<div class="filtro">
						<h2 class="responsive_movil_off">Año</h2>
						<div class="select filtro" id="year" data="<?php echo $year ?>">
							<div class="head_select">
								<span class="nombre_select ellipsis">Seleccione año</span>
								<i class="icon-arrow"></i>
							</div>
							<div class="opciones">
								<div class="opcion default"><i class="icon-filled-ubicacion"></i><span>Todos(as)</span></div>
								<?php foreach ($array_year as $key => $value) { ?>
									<div class="opcion"><i class="icon-filled-ubicacion"></i><span><?php echo $value ?></span></div>
								<?php } ?>
							</div>
							<input type="hidden" name="year" value="" />
						</div>
					</div>	
					<div class="filtro">
						<h2 class="responsive_movil_off">Municipio</h2>
						<div class="select filtro" id="municipio" data="<?php echo $municipio ?>">
							<div class="head_select">
								<span class="nombre_select ellipsis">Seleccione municipio</span>
								<i class="icon-arrow"></i>
							</div>
							<div class="opciones">
								<div class="opcion default"><i class="icon-filled-ubicacion"></i><span>Todos(as)</span></div>
								<?php foreach ($array_municipio as $key => $row) { ?>
									<div class="opcion"><i class="icon-filled-ubicacion"></i><span><?php echo $row->municipio ?></span></div>
								<?php } ?>
							</div>
							<input type="hidden" name="municipio" value="" />
						</div>
					</div>
					<div class="filtro">
						<h2 class="responsive_movil_off">Grupo</h2>
						<div class="select filtro" id="grupo" data="<?php echo $grupo ?>">
							<div class="head_select">
								<span class="nombre_select ellipsis">Seleccione grupo</span>
								<i class="icon-arrow"></i>
							</div>
							<div class="opciones">
								<div class="opcion default"><i class="icon-filled-ubicacion"></i><span>Todos(as)</span></div>
								<?php foreach ($array_gru as $key => $value) { ?>
									<div class="opcion"><i class="icon-filled-ubicacion"></i><span><?php echo $value ?></span></div>
								<?php } ?>
							</div>
							<input type="hidden" name="grupo" value="" />
						</div>
					</div>
					<div class="content_button">
						<button class="button" type="submit"><i class="icon-filled-check"></i>Aplicar</button>
					</div>
				</div>
				<?php if ($array != False || $array != Null) { ?>
				<div class="tabla linea_h">
					<table>
						<thead>
							<tr class="tr_sin_color">
								<th class="left">Nombre</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($array as $key => $row) {
							$last = (count($array) == $key + 1) ? 'last' : '';
							?>
							<tr id="elemento_<?php echo $key ?>" class="elemento file parent_me_elemento <?php echo $last ?>" id_data="<?php echo $row->id_informe?>" url_data="panel/busqueda_informes/c_eliminar_informe">
								<!-- <td class="left nowrap">
									<div class="td_icon">
										<i class="icon-filled-correo"></i>
										<?php $date_ago = date_ago($row->fecha) ?>
										<span><?php echo $date_ago ?></span>
									</div>
								</td> -->
								<?php
								$tipo_icon = ext_multimedia($row->url_informe);
								$nombre = name_url($row->url_informe); ?>
								<td class="left">
									<div class="td_icon">
										<?php echo tipo_icon_mult($tipo_icon); ?>
										<div class="ellipsis"><span><?php echo $nombre ?></span></div>
									</div>
								</td>
								<td class="td_acciones">
									<div class="div_acciones">
										<a href="<?php echo $row->url_informe ?>" class="acciones"><i class="icon-filled-visible"></i><span class="icon_info">Visualizar archivo</span></a>
										<a href="<?php echo HOST?>detalles_informe?id=<?php echo $row->id_informe ?>" class="acciones"><i class="icon-filled-file"></i><span class="icon_info">Detalles archivo</span></a>
										<a href="<?php echo $row->url_informe ?>" class="acciones" download="<?php echo $nombre ?>"><i class="icon-filled-descargar"></i><span class="icon_info">Descargar</span></a>
										<div class="acciones"><i class="icon-filled-eliminar-b me_eliminar"></i><span class="icon_info">Eliminar</span></div>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<?php 
					echo '<div class="responsive_movil_off content_paginador">';
					$obj_informe->mostrarPaginas(5).'</div>';
					echo '</div>';
					echo '<div class="responsive_movil_on content_paginador">';
					$obj_informe->mostrarPaginas(3);
					echo '</div>';
					?>
				</div>
				<?php } else{ ?>
				<div class="not_archivos">
					<span>No hay archivos subidos.</span>
				</div>
				<?php } ?>
			</form>
		</div>
		<div id="div_mod_eliminar"></div>
	</div>
</main>
<?php
$scripts = ['comp_modal.js','comp_select.js'];
include VIEWS.'templates/foot.php'; 
?>