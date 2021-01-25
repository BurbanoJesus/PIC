<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS."validate.php";
use Museo\Libs\Validate;

	$dimension = $_POST['dimension'];
	$tipo = $_POST['tipo'];
	$busqueda = $_POST['busqueda'];

	// Validate
	$view = 'experiencias_exitosas';
	// $obj_validar = new Validate($view);

	// $fecha = $obj_validar->validar_fecha_actual($fecha);
	// $busqueda = $obj_validar->randerizar_texto_sql($busqueda);
	
  	
  	$categoria_lenght = strlen($dimension);
  	$tipo_lenght = strlen($tipo);
  	$busqueda_lenght = strlen($busqueda);

	// $listar = $obj_publicacion->listar($categoria,$vereda_barrio,$busqueda);
    
    $filtros = "";
    ($categoria_lenght > 0 || $tipo_lenght > 0 || $busqueda_lenght > 0) ? $filtros .= "?" : true;
    ($categoria_lenght > 0) ? $filtros .= "dimension=$dimension&" : true;
    ($tipo_lenght > 0) ? $filtros .= "tipo=$tipo&" : true;
    ($busqueda_lenght > 0) ? $filtros .= "busqueda=$busqueda&" : true;

    $filtros = substr($filtros, 0,-1);

	header("Location: ".HOST."experiencias_exitosas$filtros");
	exit;
?>