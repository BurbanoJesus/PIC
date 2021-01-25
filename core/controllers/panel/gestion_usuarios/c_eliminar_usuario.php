<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'usuario.php';
session_start();

$obj_usuario = new Usuario();

$id_usuario = $_POST['id'];
$carpeta_usuario =  $obj_usuario->carpeta_usuario($id_usuario);
$eliminar = $obj_usuario->eliminar($id_usuario);
$eliminar_archivos = $obj_usuario->eliminar_archivos($carpeta_usuario);

// $eliminar = True;

if($eliminar != False){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>