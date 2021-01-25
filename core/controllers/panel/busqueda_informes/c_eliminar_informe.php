<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'informe.php';
session_start();


$id_informe = $_POST['id'];

$obj_informe = new Informe();
$url_informe = $obj_informe->url_informe($id_informe);
$eliminar = $obj_informe->eliminar($id_informe);
$eliminar_archivos = $obj_informe->eliminar_archivos($url_informe);

// $eliminar = True;

if($eliminar != False){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>