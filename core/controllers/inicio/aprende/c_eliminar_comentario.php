<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'curso.php';
require MODELS.'actividad.php';


$id_comentario = $_POST['id'];

$obj_curso = new curso();
$eliminar = $obj_curso->eliminar_comentario($id_comentario);



if($eliminar != false){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>