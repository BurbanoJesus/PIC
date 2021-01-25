<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'helper.php';
include_once LIBS.'validate.php';
include_once LIBS.'gd_imagen.php';
require MODELS.'usuario.php';
session_start();

use Plataforma\Libs\Helper;
use Plataforma\Libs\Validate;

	$nombres = $_POST['nombres'];
	$tipo_id = $_POST['tipo_id'];
	$identificacion = $_POST['identificacion'];
	$telefono = $_POST['telefono'];
	$municipio = $_POST['municipio'];
	$correo = $_POST['correo'];
	$tipo_usuario = 'general';
	$fecha = $_POST['fecha'];
	$files = $_FILES['image'];
	$post_x = $_POST['x'];
	$post_y = $_POST['y'];
	$post_w = $_POST['w'];
	$post_h = $_POST['h'];
	// 
	$url = $_POST['url'];
	// 
	$usuario_actual = $_POST['usuario_actual'];
	$carpeta_usuario = $_POST['carpeta_usuario'];
	$img_preview = $_POST['img_preview'];
	$img_usuario = $_POST['img_usuario'];
	
	// Validate
	$view = "editar_usuario";
	$get = "&id=$usuario_actual";
	$obj_validar = new Validate($view,$get);
	// $obj_validar->validar_texto($nombres);
	// $obj_validar->validar_usuario($usuario);
	// $obj_validar->validar_correo($correo);
	// $obj_validar->validar_pass_equal($password,$password_b);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);
	// $nombres = $obj_validar->randerizar_texto_sql($nombres);

	$obj_usuario = new Usuario();

	$carpeta_destino = MULTIMEDIA_S."usuarios/".$carpeta_usuario."/";
	$carpeta_host = MULTIMEDIA_H."usuarios/".$carpeta_usuario."/";

	if(file_exists($carpeta_destino)){

		$obj_usuario = new Usuario();
		if($files['error'] == 0){
			$img_preview = str_replace(HOST, SERVER, $img_preview);
			$img_usuario = str_replace(HOST, SERVER, $img_usuario);
			unlink($img_preview);
			unlink($img_usuario);
			$name_archivo = $files["name"];
	        $name_clear = pathinfo($name_archivo)['filename'];
	        $origen_archivo= $files["tmp_name"];
	        $url_archivo= $carpeta_destino.$name_archivo;

	        $mime = $files["type"];
			$type = type_source($mime);
			$extension = ext_source($mime);
			$size = round(($files["size"] / 1000));
			$xf = 128;
			$yf = 128;
			$jcrop_y = 250;
			$quality = 90;
	        if ($type == 'image') {
				$name_mult = recortar_imagen($origen_archivo,$url_archivo,$xf,$yf,$post_x,$post_y,$post_w,$post_h,$jcrop_y,$extension, Null, 90);
				$xf = 1920;
				$yf = 1080;
				$preview = optimizar_imagen($origen_archivo,$url_archivo,$xf,$yf,$extension, Null, 90);
	        }

	        $img_preview = $carpeta_host.$preview;
	        $img_usuario = $carpeta_host.$name_mult;
	    }

	}else{
		header("Location: ".HOST."$view?validate_msj=Ha ocurrido un error, intentelo nuevamente");
		exit;
	}

	//DEFINIR LOS PARAMETROS QUE FALTAN Y HACER LA INSERCION EN LA BD
	$actualizar = $obj_usuario->actualizar($correo,$nombres,$tipo_id,$identificacion,$telefono,$municipio,$img_preview,$img_usuario,$usuario_actual);

	$url_redirect = HOST.'perfil';
	$active = 'cuenta';
	$action = 'Actualizacion';
	$row = $obj_usuario->usuario_por_nickname_all($usuario_actual);
	$_SESSION['usuario'] = $row;
	header("Location: ".HOST."inicio/success?&url_redirect=$url_redirect&active=$active&action=$action");
	exit;
  
?>

