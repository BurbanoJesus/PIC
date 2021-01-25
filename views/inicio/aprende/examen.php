<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'actividad.php';
require_once MODELS.'usuario.php';
session_start();

$estilos = ['estilos_inicio.css','comp_check_radio.css'];
require_once VIEWS.'templates/head.php';

$id_actividad = isset($_GET['id']) ? $_GET['id'] : '';

$obj_actividad = new Actividad();
$array = $obj_actividad->detalles_examen($id_actividad);
$row_principal = $array[0];

$id_curso = $obj_actividad->detalles_curso($id_actividad);

$obj_usuario = new Usuario();
$subs = $obj_usuario->comprobar_suscripcion($id_curso);
$subs = ($subs !== False || $subs !== Null) ? True : False;
// 
$numero_intentos = $obj_usuario->numero_intentos_examen($id_actividad);
$numero_intentos = ($numero_intentos === False) ? 0 : $numero_intentos;
$numero_intentos_disponibles = 10 - $numero_intentos;

$aprende = "active";
include VIEWS.'templates/header.php';

?>
<main>
	<div class="main" id="examen">
		<div class="contenido" id="actividad" id_data="<?php echo $row_principal->id_actividad ?>" subs="<?php echo $subs ?>">
			<?php
			require_once LIBS.'verificar_sesion.php';
			$object = $array;
			require_once LIBS.'empty.php';
			require_once LIBS.'subs_not.php';
			if ($flag_subs === False && $flag_empty === False){ 
			?>
			<form class="form" method="POST" action="<?php echo CONTROLLERS?>inicio/aprende/c_comprobar_examen.php" id="form_examen">
				<div class="informacion">
					<h2 class="h2_informacion">
						<?php 
						echo $row_principal->nombre_actividad;
						echo ' ( Intentos disponibles: '.$numero_intentos_disponibles.' )';
						?>
					</h2>
					<p class="p_info_b"><?php echo $row_principal->descripcion ?></p>
					<div class="examen">
						<?php
						foreach ($array as $key => $row){
						$array_pregunta = [];
						$numero_pregunta = $key + 1;
						$numero_pregunta = $numero_pregunta.'. ';
						array_push($array_pregunta, $row->respuesta); 
						array_push($array_pregunta, $row->respuesta_incorrecta_a); 
						array_push($array_pregunta, $row->respuesta_incorrecta_b); 
						array_push($array_pregunta, $row->respuesta_incorrecta_c);
						shuffle($array_pregunta);
						?>
						<div class="tarjeta_examen">
							<h3><?php echo $numero_pregunta.$row->pregunta ?></h3>
							<div class="respuestas">
								<?php 
								$cont_key = $key + 1;
								foreach ($array_pregunta as $key_pregunta => $row_pregunta){
									switch ($key_pregunta) {
										case '0':
											$indice =  'A. ';
											break;
										case '1':
											$indice =  'B. ';
											break;
										case '2':
											$indice =  'C. ';
											break;
										case '3':
											$indice =  'D. ';
											break;
									}
									$cont_pregunta = $key_pregunta + 1;
								?>
								<div class="content_radio_s">
									<input type="radio" name="radio_<?php echo $cont_key ?>" id="in_radio_s<?php echo $key.$cont_pregunta ?>" class="in_radio_s" value="<?php echo $row_pregunta ?>" />
									<label for="in_radio_s<?php echo $key.$cont_pregunta ?>" class="radio_s"></label>
									<label for="in_radio_s<?php echo $key.$cont_pregunta ?>"><b><?php echo $indice ?></b><?php echo $row_pregunta ?></label>
								</div>
								<?php } ?>
								<input type="hidden" name="id_pregunta_<?php echo $cont_key ?>" value="<?php echo $row->id_pregunta ?>" />
							</div>
						</div>
						<?php } ?>
						<!-- <div class="tarjeta_examen">
							<h3>2. Pregunta numero 2 ?</h3>
							<div class="respuestas">
								<div class="respuesta"><input type="radio" name="pregunta2" /><span>a. Respuesta numero 1</span></div>
								<div class="respuesta"><input type="radio" name="pregunta2" /><span>b. Respuesta numero 2</span></div>
								<div class="respuesta"><input type="radio" name="pregunta2" /><span>c. Respuesta numero 3</span></div>
								<div class="respuesta"><input type="radio" name="pregunta2" /><span>d. Respuesta numero 4</span></div>
							</div>
						</div> -->
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
						<input type="hidden" name="id_actividad" value="<?php echo $row_principal->id_actividad ?>" />
						<input type="hidden" name="id_modulo" value="<?php echo $row_principal->id_modulo ?>" />
						<div class="buttons_inline">
							<button type="submit" class="button">Confirmar</button>
							<button onclick="window.location = '<?php echo HOST.'actividades?id='.$row_principal->id_modulo ?>'" type="button" class="button">Volver Actividades</button>
						</div>
					</div>
				</div>
			</form>
			<?php } ?>
		</div>
	</div>	
</main>
<?php
$scripts = ['comp_check_radio.js','comp_slider.js','comp_temporizador.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>