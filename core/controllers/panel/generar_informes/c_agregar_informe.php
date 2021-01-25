<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS."validate.php";
include_once LIBS."gd_imagen.php";
require MODELS.'informe.php';
require MODELS.'notificacion.php';
use Plataforma\Libs\Validate;
session_start();

require SERVER.'/vendor/autoload.php';

$id = uniqid('PD', true);
$multimedia = 'MU_'.$id;
$nombre = $_POST['nombre'];
$files = $_FILES['file'];
// 
$usuario = $_SESSION['usuario']->usuario;
$ses_year = $_SESSION['ses_year'];
$ses_municipio = $_SESSION['ses_municipio'];
$ses_dimension = $_SESSION['ses_dimension'];
$ses_tecnologia = $_SESSION['ses_tecnologia'];
$ses_grupo = $_SESSION['ses_grupo'];
$fecha_reg = $fecha_actual;
// sleep(15);
// Validate
// $view = 'registrar_informe';
// $obj_validar = new Validate($view);
// $obj_validar->validar_texto($categoria);
// $obj_validar->validar_texto($titulo);
// $obj_validar->validar_texto($descripcion);
// $fecha = $obj_validar->validar_fecha_actual($fecha);
// $titulo = $obj_validar->randerizar_texto_sql($titulo);

$carpeta_destino = MULTIMEDIA_S."informes/".$usuario."/";
$carpeta_host = MULTIMEDIA_H."informes/".$usuario."/";
if (!file_exists($carpeta_destino)) @mkdir($carpeta_destino); 

$obj_informe = new Informe();

if(strlen($files["name"]) > 0 && strlen($files["tmp_name"]) > 0){
    if(file_exists($carpeta_destino)){
        $name_archivo = $files["name"];
        $name_clear = pathinfo($name_archivo)['filename'];
        $extension_clear = pathinfo($name_archivo)['extension'];
        $origen_archivo= $files["tmp_name"];

        $mime = $files["type"];
		$type = type_source($mime);
		$extension = ext_source($mime);
		$size = round(($files["size"] / 1000));
		$xf = 1920;
		$yf = 1080;
		$name_clear = ($nombre != '') ? $nombre : $name_clear;
        $url_archivo= $carpeta_destino.$name_clear.'.'.$extension_clear;
        if ($type == 'image') {
			$name_mult = optimizar_imagen($origen_archivo, $url_archivo, $xf, $yf, $extension, $size);
        }else{
        	$name_archivo = $name_clear.'.'.$extension_clear;
        	$cont_existe_file = 1;
    		while(file_exists($url_archivo)){
    			$name_archivo = $name_clear.'_'.$cont_existe_file.'.'.$extension_clear;
	        	$url_archivo = $carpeta_destino.$name_archivo;
	        	$cont_existe_file++;
	        }
		    $flag_validar = (@move_uploaded_file($origen_archivo, $url_archivo)) ? True : False;
		    $name_mult = $name_archivo;
        }
    }
    else{
        // echo 'Error en Carpeta Archivo<br>';
        // header("Location: ".HOST."panel/success?&url_redirect=$url_redirect&active=$active");
		// exit;
    }
}
$url_host = $carpeta_host.$name_mult;
$tipo_informe = '00';
$obj_informe->insertar($id,$url_host,$tipo_informe,$usuario,$ses_year,$ses_municipio,$ses_dimension,$ses_tecnologia,$ses_grupo,$fecha_reg);
// 
$obj_notificacion = new Notificacion();
$descripcion = 'Se ha registrado un nuevo archivo';
$tipo_notificacion = 'informe';
$usuario = $_SESSION['usuario']->usuario;
$id_destino = $id;
$obj_notificacion->insertar(Null,$descripcion,$tipo_notificacion,$usuario,$id_destino,$fecha_reg);

$url_redirect = HOST.'panel';
$active = 'gestion_informes';
header("Location: ".HOST."panel/success?&url_redirect=$url_redirect&active=$active");
exit;
  
?>

