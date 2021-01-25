<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'usuario.php';
session_start();

$id = $_POST['id'];
// var_dump($id);
// var_dump($_SESSION['actividad_actual']);
if ($_SESSION['actividad_actual'] == $id) {
	$obj_usuario = new Usuario();
	$row = $obj_usuario->actualizar_progreso_cursos($id);
}else{
	$row = 'pepinaco';
}
// var_dump($row);
// echo "SELECT * FROM usuarios WHERE nick_name = $usuario AND password = $pass";
if($row != false){
	echo json_encode(array('error' => false, 'row' => $row));
	}
else{
	echo json_encode(array('error' => true));
	}
 ?>