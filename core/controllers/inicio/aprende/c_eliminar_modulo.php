<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'modulo.php';
require MODELS.'actividad.php';


$id_modulo = $_POST['id'];

$obj_modulo = new Modulo();
$id_curso = $obj_modulo->detalles_id_curso($id_modulo);
$array = $obj_modulo->lista_eliminar_actividades($id_modulo);

$obj_actividad = new Actividad();
// var_dump($array);
if ($array !== False && $array !== Null) {
	foreach ($array as $key => $row_main) {
		$row = $obj_actividad->detalles_curso_modulo($row_main->id_actividad);
		$tipo = $row->tipo_actividad;
		$id_modulo = $row->id_modulo;
		$id_curso = $row->id_curso;
		$eliminar = $obj_actividad->eliminar($row_main->id_actividad,$tipo);
		$eliminar_archivo = $obj_actividad->eliminar_archivos($row_main->id_actividad,$id_modulo,$id_curso);
	}
}

$eliminar_modulo = $obj_modulo->eliminar($id_modulo);
$eliminar_archivos_modulos = $obj_modulo->eliminar_archivos($id_modulo,$id_curso);

$eliminar = true;
$eliminar_archivo = true;

if($eliminar != false && $eliminar_archivo != false){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>