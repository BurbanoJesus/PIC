<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS."validate.php";
session_start();
use Museo\Libs\Validate;

	$dimension = $_POST['dimension'];
	$tecnologia = $_POST['tecnologia'];
	$grupo = $_POST['grupo'];
	$year = $_POST['year'];
	$municipio = $_POST['municipio'];
	// 
	$_SESSION['ses_dimension'] = $dimension;
	$_SESSION['ses_tecnologia'] = $tecnologia;
	$_SESSION['ses_grupo'] = $grupo;
	$_SESSION['ses_year'] = $year;
	$_SESSION['ses_municipio'] = $municipio;

	// Validate
	$view = 'lista_archivos';
	// $obj_validar = new Validate($view);

	// $fecha = $obj_validar->validar_fecha_actual($fecha);
	// $busqueda = $obj_validar->randerizar_texto_sql($busqueda);
	
	// $listar = $obj_publicacion->listar($categoria,$vereda_barrio,$busqueda);
    
    $filtros = "";
    (strlen($dimension) > 0 || strlen($tecnologia) > 0 || strlen($grupo) > 0 || strlen($year) > 0 || strlen($municipio) > 0) ? $filtros .= "?" : true;
    (strlen($dimension) > 0) ? $filtros .= "dimension=$dimension&" : true;
    (strlen($tecnologia) > 0) ? $filtros .= "tecnologia=$tecnologia&" : true;
    (strlen($grupo) > 0) ? $filtros .= "grupo=$grupo&" : true;
    (strlen($year) > 0) ? $filtros .= "year=$year&" : true;
    (strlen($municipio) > 0) ? $filtros .= "municipio=$municipio&" : true;

    $filtros = substr($filtros, 0,-1);

	header("Location: ".HOST."lista_archivos$filtros");
	exit;
?>