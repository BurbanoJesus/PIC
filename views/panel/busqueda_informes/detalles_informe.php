<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'informe.php';
require MODELS.'municipio.php';
session_start();

require_once LIBS."verificar_panel.php";

$estilos = ['estilos_panel.css'];
include VIEWS.'templates/head.php';

$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$id = (isset($_GET['id'])) ? $_GET['id'] : '';

$obj_informe = new Informe();
$row = $obj_informe->detalles($id);
// 
$obj_municipio = new Municipio();
$array_municipio = $obj_municipio->listar();
// 
// var_dump($row);

?>

<main>
	<div class="panel">
		<?php
		$busqueda_informes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php include VIEWS.'templates/contenido_panel_h2.php' ?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_busqueda_reportes.php" id="busqueda_reportes">
				<h2 class="titulo_panel">Detalles archivo PIC:</h2>
				<div class="separador"></div>
				<div class="content_detalles">
					<div class="info_detalles">
						<div class="nombre_detalles img_file">
							<!-- <i class="icon-filled-file main"></i> -->
							<?php
							$tipo_icon = ext_multimedia($row->url_informe);
							echo tipo_icon_mult($tipo_icon); 
							$nombre = name_url($row->url_informe); ?>
							<span class="main"><?php echo $nombre ?></span>
						</div>
						<div class="lista_detalles">
							<div class="opcion">
								<span class="info_label">Usuario creador</span>
								<span class="info"><?php echo $row->usuario ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Fecha Creado</span>
								<span class="info"><?php echo $row->fecha ?></span>
							</div>
							<div class="opcion">
								<span class="info_label">Municipio</span>
								<span class="info"><?php echo $row->municipio ?></span>
							</div>
							<div class="opcion last">
								<span class="info_label">Dimension</span>
								<span class="info"><?php echo $row->dimension ?></span>
							</div>
							<div class="opcion last">
								<span class="info_label">Tecnologia</span>
								<span class="info"><?php echo $row->tecnologia ?></span>
							</div>
							<div class="opcion last">
								<span class="info_label">Grupo</span>
								<span class="info"><?php echo $row->grupo ?></span>
							</div>
							<div class="opcion last">
								<span class="info_label">Año</span>
								<span class="info"><?php echo $row->year ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="content_button next">
					<a href="<?php echo $row->url_informe ?>" class="button" download="<?php echo $nombre ?>"><i class="icon-filled-file"></i>Descargar</a>
				</div>
			</form>
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/foot.php'; 
?>