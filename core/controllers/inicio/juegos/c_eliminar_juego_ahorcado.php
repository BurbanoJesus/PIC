<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'juego_ahorcado.php';


$id_juego = $_POST['id'];

$obj_juego = new Juego_ahorcado();
$eliminar = $obj_juego->eliminar($id_juego);

// $eliminar = True;

if($eliminar != False){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>