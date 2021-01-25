<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'lugar.php';
session_start();


$id_lugar = $_POST['id'];

$obj_lugar = new Lugar();
$eliminar = $obj_lugar->eliminar($id_lugar);
$eliminar_archivos = $obj_lugar->eliminar_archivos($id_lugar);

// $eliminar = True;

if($eliminar != False){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>