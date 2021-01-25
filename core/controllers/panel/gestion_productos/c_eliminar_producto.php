<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'producto.php';
session_start();


$id_producto = $_POST['id'];

$obj_juego = new Producto();
$eliminar = $obj_juego->eliminar($id_producto);
$eliminar_archivos = $obj_juego->eliminar_archivos($id_producto);

// $eliminar = True;

if($eliminar != False){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>