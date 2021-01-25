<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();
require_once LIBS."verificar_panel.php";
$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
if ($tipo_usuario == 'administrador' && !isset($_SESSION['ses_dimension'])){
	header("Location: ".HOST."estructura_principal");
	exit;
}

$estilos = ['estilos_panel.css','estilos_form.css'];
include VIEWS.'templates/head.php';

$opcion = isset($_GET['opcion']) ? $_GET['opcion']: '';

// $array_grupos = ['Salud Ambiental','Vida saludable y condiciones no transmisibles','Convivencia social y salud mental','Seguridad alimentaria y nutricional','Sexualidad y derechos sexuales y reproductivo','Vida saludable y enfermedades  Transmisibles','Salud en emergencias y desastres','Salud y ámbito laboral','Autoridad Sanitaria','Poblaciones de mayor vulnerabilidad'];

// if (!in_array($opcion, $array_grupos)){
// 	header("Location: ".HOST."estructura_principal");
// 	exit;
// }

$_SESSION['ses_grupo'] = $opcion;

// $array_1 = array(
// 	'Generar Procedimiento PIC' => 'informe_1',
// 	'Generar Programación de actividades de asistencia técnica' => 'informe_2',
// 	' Generar Planeación asistencia técnica' => 'informe_3',
// 	'Generar Acta de reunión' => 'informe_4',
// 	);

// switch (True) {
// 	case $opcion == 'Presentación Equipo PIC':
// 		$array = $array_1;
// 		break;
	
// 	default:
// 		$array = False;
// 		break;
// }

?>

<main>
	<div class="panel">
		<?php
		$generar_informes = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php $volver = 'panel'; include VIEWS.'templates/contenido_panel_h2.php' ?>
			<h2 class="titulo_panel"><?php echo $opcion ?></h2>
			<!-- <?php if ($tipo_usuario == 'generador' || $tipo_usuario == 'administrador'){ ?>
			<div class="lista_opciones">
				<?php
				$cont = 0;
				foreach ($array as $key => $row) {
				$last = (count($array) == $cont) ? 'last' : '';
				$cont++;
				?>
				<a class="opcion <?php echo $last ?>" href="<?php echo HOST.$row.'?opcion='.$opcion ?>">
					<i class="icon-filled-acta lista_icon"></i>
					<span><?php echo $cont.'. '.$key ?></span>
					<button class="button inline"><i class="icon-filled-pdf"></i>Continuar</button>
				</a>
				<?php } ?>
			</div>
			<?php } ?> -->

			<form class="form" method="POST" action="<?php echo CONTROLLERS?>panel/generar_informes/c_agregar_informe.php" id="form_agregar_informe" enctype="multipart/form-data">
				<div class="input s100 center">
					<!-- <h3>Subir Archivo</h3> -->
					<div class="contenido_input">
						<div id="contenido_img" class="contenido_img">
							<div id="loading_inf_1" class="loading_inf"><img src="<?php echo IMG?>loading/loading3.gif" alt=""></div>
							<div class="agregar_mult">
					        	<input class="input_file_one input_preview subir_archivo" id="input_file_1" name="file" type="file" required />
					            <!-- accept="image/*" or accept="image/jpeg,image/png" -->
					            <label class="label_icon icon-filled-upload" for="input_file_1"></label>
								<div class="div_button"><label class="button" for="input_file_1"><i class="icon-filled-upload-b"></i>Subir Archivo</label></div>
					        </div>
						</div>
					</div>
				</div>
				<div class="input s100">
					<h3>Nombre del informe/archivo.</h3>
					<div class="contenido_input"><input class="input input_text in_subir_archivo" type="text" name="nombre"  placeholder="Ingresar nombre..." /></div>
				</div>
				<div class="content_button next">
					<button type="submit" class="button btn_submit">
						<i class="icon-filled-check"></i>
						Aceptar
					</button>
				</div>
			</form>
			<?php if ($tipo_usuario == 'supervisor'){ ?>
			<h2 class="titulo_panel">Informe de evaluacion de generador</h2>
			<div class="lista_opciones">
				<a class="opcion last" href="<?php echo HOST?>informe_supervisor">
					<i class="icon-filled-acta"></i>
					<span>Generar Informe de evaluacion</span>
					<button class="button inline"><i class="icon-filled-pdf"></i>Continuar</button>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/foot.php'; 
?>