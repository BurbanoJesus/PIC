<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'/lugar.php';


$obj_user = new Lugar();
$lista = $obj_user->listar_all();
// echo "SELECT * FROM usuarios WHERE nick_name = $usuario AND password = $pass";
if($lista != false){
	echo json_encode(array('error' => false, 'lista' => $lista));
	}
else{
	echo json_encode(array('error' => true));
	}
 ?>