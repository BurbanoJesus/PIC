<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
include_once LIBS."gd_imagen.php";
require MODELS.'curso.php';
use Plataforma\Libs\Validate;

	$id = uniqid('CU', true);
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$dimension = $_POST['dimension'];
	$fecha = $_POST['fecha'];
	$files = $_FILES['image'];
	$post_x = $_POST['x'];
	$post_y = $_POST['y'];
	$post_w = $_POST['w'];
	$post_h = $_POST['h'];
	$post_w_jcrop = $_POST['w_jcrop'];
	// var_dump($files);
	// Validate
	$view = 'registrar_curso';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);


	$carpeta_destino = MULTIMEDIA_S."cursos/".$id."/";
	$carpeta_host = MULTIMEDIA_H."cursos/".$id."/";

	if(!file_exists($carpeta_destino)){
	    $flag_validar = (@mkdir($carpeta_destino)) ? True : False; 
	    // if(@mkdir($carpeta_destino)) echo "si"; //para comprobar si se creo la carpeta.

		$obj_curso = new Curso();
		
		$name_archivo = $files["name"];
        $name_clear = pathinfo($name_archivo)['filename'];
        $origen_archivo= $files["tmp_name"];
        $url_archivo= $carpeta_destino.$name_archivo;

        $mime = $files["type"];
		$type = type_source($mime);
		$extension = ext_source($mime);
		$size = round(($files["size"] / 1000));
		$xf = 360;
		$yf = 264;
		$jcrop_y = $post_w_jcrop;
		$quality = 90;
        if ($type == 'image') {
			$name_mult = recortar_imagen($origen_archivo,$url_archivo,$xf,$yf,$post_x,$post_y,$post_w,$post_h,$jcrop_y,$extension, Null, 90);
        }

        $url_host = $carpeta_host.$name_mult;
		$insertar_mu = $obj_curso->insertar($id,$nombre,$descripcion,$dimension,$url_host,$fecha);
	}else{
		header("Location: ".HOST."$view?validate_msj=Ha ocurrido un error, intentelo nuevamente");
		exit;
	}

	$url_redirect = HOST.'aprende';
	$active = 'aprende';
	// header("Location: ".HOST."inicio/success?&url_redirect=$url_redirect&active=$active");
	// exit;
?>

