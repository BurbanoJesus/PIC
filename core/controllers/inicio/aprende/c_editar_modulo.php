<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
include_once LIBS."gd_imagen.php";
require MODELS.'modulo.php';
use Plataforma\Libs\Validate;

	$id = $_POST['id_modulo'];
	$modulos = $_POST['modulos'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$fecha = $_POST['fecha'];

	// Validate
	$view = 'editar_modulo';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);


	
	$obj_modulo = new modulo();
	$insertar_mu = $obj_modulo->actualizar($id,$nombre,$descripcion);

	$url_redirect = HOST.'modulos?id='.$modulos;
	$active = 'aprende';
	$action = 'Actualizacion';
	header("Location: ".HOST."inicio/success?&url_redirect=$url_redirect&active=$active&action=$action");
	exit;
?>

