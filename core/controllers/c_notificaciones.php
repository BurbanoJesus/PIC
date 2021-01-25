<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'notificacion.php';
session_start();


$obj_notificacion = new notificacion();
$total = $obj_notificacion->numero_notificaciones();
// var_dump($total);

// $eliminar = True;

if($total !== False){
	echo json_encode(array('error' => false, 'total' => $total));
	}
else{
	echo json_encode(array('error' => true));
	}
?>