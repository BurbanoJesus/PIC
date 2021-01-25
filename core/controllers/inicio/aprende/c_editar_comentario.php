<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
include_once LIBS."gd_imagen.php";
require MODELS.'curso.php';
use Plataforma\Libs\Validate;
session_start();

	$id_curso = $_POST['id_curso'];
	$nota = $_POST['nota'];
	$comentario = $_POST['comentario'];
	$usuario = $_SESSION['usuario']->usuario;
	$fecha = $fecha_actual;

	// Validate
	$view = 'editar_comentario';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);
	
	$obj_curso = new Curso();
	$insertar_mu = $obj_curso->actualizar_comentario($nota,$comentario,$id_curso,$usuario);
	header("Location: ".HOST."curso?id=$id_curso");
	exit;
?>

