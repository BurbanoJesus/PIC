<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
require MODELS.'modulo.php';
use Plataforma\Libs\Validate;

	$id = uniqid('MD', true);
	$id_curso = $_POST['id_curso'];
	$modulos = 'MD_'.$id_curso;
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$fecha = $_POST['fecha'];

	// $id_curso = str_replace('MD_', '', $modulos);
	$carpeta_destino = MULTIMEDIA_S."cursos/".$id_curso."/".$id."/";
	$carpeta_host = MULTIMEDIA_H."cursos/".$id_curso."/".$id."/";
    @mkdir($carpeta_destino); 

	// Validate
	$view = 'agregar_modulo';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);

	$obj_modulo = new Modulo();
	$insertar_mu = $obj_modulo->insertar($id,$id_curso,$nombre,$descripcion,$fecha);
	$url_redirect = HOST.'curso?id='.$id_curso;
	$active = 'aprende';
	header("Location: ".HOST."inicio/success?&url_redirect=$url_redirect&active=$active");
	exit;
?>

