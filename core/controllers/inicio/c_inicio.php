<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
include_once LIBS.'gd_imagen.php';
require MODELS.'inicio.php';
use Plataforma\Libs\Validate;

	$files = $_FILES['images'];

	var_dump($files);

	// Validate
	$view = 'inicio';

	$carpeta_destino = MULTIMEDIA_S."inicio/";
	$carpeta_host = MULTIMEDIA_h."inicio/";


	$check_files = count($_FILES["images"]["name"]);
	$obj_inicio = new Inicio();
    $cont_existe_file = 1;
    if ($check_files > 0) {
    	for( $i=0; $i < count($files["name"]); $i++){
        // var_dump($files["name"][$i]);
		    if(strlen($files["name"][$i]) > 0 && strlen($files["tmp_name"][$i]) > 0){
		        if(file_exists($carpeta_destino)){
		            $name_archivo = $files["name"][$i];
		            $name_clear = pathinfo($name_archivo)['filename'];
		            $origen_archivo= $files["tmp_name"][$i];
		            $url_archivo= $carpeta_destino.$name_archivo;

		            $mime = $files["type"][$i];
	   				$type = type_source($mime);
	   				$extension = ext_source($mime);
	   				$size = round(($files["size"][$i] / 1000));
	   				$xf = 1920;
	   				$yf = 1080;
		            if ($type == 'image') {
		            	if ($i == 0) {
		            		// $url_archivo_preview = $carpeta_destino.$name_clear.'_preview.'.$extension;
		            		// $img_preview = optimizar_imagen($origen_archivo, $url_archivo_preview, 300, 300, $extension, Null, 90);
		    				$name_mult = optimizar_imagen($origen_archivo, $url_archivo, $xf, $yf, $extension, $size);
		            	}else{
		    				$name_mult = optimizar_imagen($origen_archivo, $url_archivo, $xf, $yf, $extension, $size);
		            	}
		            }else{
		            	$url_archivo = $carpeta_destino.$name_archivo;
	            		while(file_exists($url_archivo)){
	            			$name_archivo = $name_clear.'_'.$cont_existe_file.'.'.$extension;
				        	$url_archivo = $carpeta_destino.$name_archivo;
				        	$cont_existe_file++;
				        }
					    $flag_validar = (@move_uploaded_file($origen_archivo, $url_archivo)) ? True : False;
					    $name_mult = $name_archivo;
		            }

		            $url_host = $carpeta_host.$name_mult;
		            echo('tipo: '.$type);
		            echo "<br>";
		            echo('tipo: '.$extension);
		            echo "<br>";
					$insertar_mu = $obj_inicio->insertar(Null,$url_host,$type);
		        }
		        else{
		            echo 'Error en Carpeta Archivo<br>';
		        }
		    }
		}
    } else {
    	$url_host = IMG."default/default.png";
		$preview = $url_host;
    }
    
	header("Location: ".HOST."inicio");
	exit;
  
?>

