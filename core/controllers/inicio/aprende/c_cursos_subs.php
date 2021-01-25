<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
require MODELS.'usuario.php';
use Plataforma\Libs\Validate;
session_start();

	$id_curso = $_POST['id_curso'];
	$fecha = $_POST['fecha'];

	$codigo = uniqid('COD_CU', true);

	// Validate
	$view = 'curso';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);

	$obj_usuario = new Usuario();
	$insertar_subs = $obj_usuario->cursos_subs($id_curso,$codigo,$fecha);
	$insertar_cod = $obj_usuario->cursos_codigos($id_curso,$codigo);
	$url_redirect = HOST.'modulos?id='.$id_curso;
	$active = 'aprende';
	header("Location: $url_redirect");
	exit;
?>

