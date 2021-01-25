<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'actividad.php';


$id_actividad = $_POST['id'];

$obj_actividad = new Actividad();
$row = $obj_actividad->detalles_curso_modulo($id_actividad);
$tipo = $row->tipo_actividad;
$id_modulo = $row->id_modulo;
$id_curso = $row->id_curso;
// echo $tipo."<br>";
// echo $id_curso."<br>";
// echo $id_modulo."<br>";
// echo $id_actividad."<br>";
$eliminar = $obj_actividad->eliminar($id_actividad,$tipo);
$eliminar_archivo = $obj_actividad->eliminar_archivos($id_actividad,$id_modulo,$id_curso);
$eliminar = true;
$eliminar_archivo = true;

if($eliminar != false && $eliminar_archivo != false){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>