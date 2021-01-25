<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require MODELS.'curso.php';
require MODELS.'modulo.php';
require MODELS.'actividad.php';


$id = $_POST['id'];
$modulos = 'MD_'.$id;

$obj_curso = new curso();
$obj_modulo = new Modulo();
$obj_actividad = new Actividad();


$array_curso = $obj_curso->listar_elmininar_modulos($modulos);

if ($array_curso !== False && $array_curso !== Null) {
	foreach ($array_curso as $key => $row_curso) {
	$id_curso = $obj_modulo->detalles_id_curso($row_curso->id_modulo);
	$array = $obj_modulo->lista_eliminar_actividades($row_curso->id_modulo);
		if ($array !== False && $array !== Null) {
			foreach ($array as $key => $row_modulo) {
				$row = $obj_actividad->detalles_curso_modulo($row_modulo->id_actividad);
				$tipo = $row->tipo_actividad;
				$id_modulo = $row->id_modulo;
				$id_curso = $row->id_curso;
				$eliminar = $obj_actividad->eliminar($row_modulo->id_actividad,$tipo);
				$eliminar_archivo = $obj_actividad->eliminar_archivos($row_modulo->id_actividad,$id_modulo,$id_curso);
			}
		}
	$eliminar_modulo = $obj_modulo->eliminar($row_curso->id_modulo);
	$eliminar_archivos_modulos = $obj_modulo->eliminar_archivos($row_curso->id_modulo,$id_curso);
	}
}


$eliminar = $obj_curso->eliminar($id);
$eliminar_archivo = $obj_curso->eliminar_archivos($id);

$eliminar = true;
$eliminar_archivo = true;

if($eliminar != false && $eliminar_archivo != false){
	echo json_encode(array('error' => false));
	}
else{
	echo json_encode(array('error' => true));
	}
?>