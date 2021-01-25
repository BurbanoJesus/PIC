<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
require MODELS.'actividad.php';
require MODELS.'usuario.php';
use Plataforma\Libs\Validate;
session_start();
	
	$id_actividad = $_POST['id_actividad'];
	$id_modulo = $_POST['id_modulo'];
	$fecha = $fecha_actual;
	// Validate
	$view = 'comprobar_examen';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);

	$obj_actividad = new Actividad();
	$array = $obj_actividad->listar_preguntas($id_actividad);

	$len_examen = count($array);
	$respuestas_correctas = 0;
	// 
	$cont = 1;
    while(isset($_POST['radio_'.$cont])){
    	$respuesta = $_POST['radio_'.$cont];
    	$id_pregunta = $_POST['id_pregunta_'.$cont];

    	foreach ($array as $key => $row) {
    		if ($row->id_pregunta == $id_pregunta && $row->respuesta == $respuesta) {
    			$respuestas_correctas++;
    		}
    	}
		$cont++;
    }

    $nota = ($respuestas_correctas*10)/$len_examen;
    $estado_examen = 'R';

    // echo "<br>nota:".$nota;
	$obj_usuario= new Usuario();
	$insertar = $obj_usuario->cursos_examenes($id_actividad,$estado_examen,$fecha);
    if ($nota >= 6) {
    	$estado_examen = 'A';
    	$progreso = $obj_usuario->actualizar_progreso_cursos($id_actividad);
    }


	$url_redirect = HOST.'actividades?id='.$id_modulo;
	$active = 'aprende';
	header("Location: ".HOST."resultados_examen?&url_redirect=$url_redirect&active=$active&nota=$nota");
	exit;
?>

