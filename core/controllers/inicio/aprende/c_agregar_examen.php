<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
require MODELS.'actividad.php';
use Plataforma\Libs\Validate;

	$id = uniqid('AC', true);
	$tipo = 'examen';
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$tiempo = $_POST['tiempo'];
	$id_modulo = $_POST['id_modulo'];
	$fecha = $fecha_actual;
	// Validate
	$view = 'agregar_examen';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);

	$obj_actividad = new Actividad();
	$insertar = $obj_actividad->insertar($id,$id_modulo,$nombre,$descripcion,$tiempo,$tipo,$fecha);
	// 
	$cont = 1;
    while(isset($_POST['pregunta_'.$cont])){
    	$pregunta = $_POST['pregunta_'.$cont];
		$respuesta_a = $_POST['respuesta_'.$cont];
		$respuesta_b = $_POST['respuesta_a'.$cont];
		$respuesta_c = $_POST['respuesta_b'.$cont];
		$respuesta_d = $_POST['respuesta_c'.$cont];

		$insertar = $obj_actividad->insertar_pg(Null,$id,$pregunta,$respuesta_a,$respuesta_b,$respuesta_c,$respuesta_d);
		$cont++;
    }


	$url_redirect = HOST.'actividades?id='.$id_modulo;
	$active = 'aprende';
	header("Location: ".HOST."inicio/success?&url_redirect=$url_redirect&active=$active");
	exit;
?>

