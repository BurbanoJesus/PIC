<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'actividad.php';
session_start();
// sleep(100);
$id = $_POST['id'];
$_SESSION['actividad_actual'] = $id;
$obj_actividad = new actividad();
$row = $obj_actividad->detalles_tiempo($id);
// echo "SELECT * FROM usuarios WHERE nick_name = $usuario AND password = $pass";
if($row != false){
	echo json_encode(array('error' => false, 'row' => $row));
	}
else{
	echo json_encode(array('error' => true));
	}
 ?>