<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
include_once LIBS."gd_imagen.php";
require MODELS.'curso.php';
use Plataforma\Libs\Validate;

	$id = $_POST['id_curso'];
	$modulos = 'MD_'.$id;
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$dimension = $_POST['dimension'];
	$fecha = $_POST['fecha'];
	$files = $_FILES['image'];
	$post_x = $_POST['x'];
	$post_y = $_POST['y'];
	$post_w = $_POST['w'];
	$post_h = $_POST['h'];
	$file = $_POST['img_curso'];
	var_dump($nombre);
	// Validate
	$view = 'editar_curso';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);


	$carpeta_destino = MULTIMEDIA_S."cursos/".$id."/";
	$carpeta_host = MULTIMEDIA_H."cursos/".$id."/";
	var_dump($carpeta_destino);

	if(file_exists($carpeta_destino)){

	    if($files['error'] == 0){
			$img_curso = str_replace(HOST, SERVER, $file);
			unlink($img_curso);
			$name_archivo = $files["name"];
	        $name_clear = pathinfo($name_archivo)['filename'];
	        $origen_archivo= $files["tmp_name"];
	        $url_archivo= $carpeta_destino.$name_archivo;

	        $mime = $files["type"];
			$type = type_source($mime);
			$extension = ext_source($mime);
			$size = round(($files["size"] / 1000));
			$xf = 250;
			$yf = 250;
			$jcrop_y = 250;
			$quality = 90;
	        if ($type == 'image') {
				$name_mult = recortar_imagen($origen_archivo,$url_archivo,$xf,$yf,$post_x,$post_y,$post_w,$post_h,$jcrop_y,$extension, Null, 90);
	        }
	        $url_host = $carpeta_host.$name_mult;
	    }else{
	    	$url_host = $file;
	    }
		$obj_curso = new Curso();
		$insertar_mu = $obj_curso->actualizar($id,$nombre,$descripcion,$dimension,$url_host);
	}else{
		echo "string";
		header("Location: ".HOST."$view?id=$id&validate_msj=Ha ocurrido un error, intentelo nuevamente");
		exit;
	}

	$url_redirect = HOST.'cursos?dimension='.$dimension;
	$active = 'aprende';
	$action = 'Actualizacion';
	header("Location: ".HOST."inicio/success?&url_redirect=$url_redirect&active=$active&action=$action");
	exit;
?>

