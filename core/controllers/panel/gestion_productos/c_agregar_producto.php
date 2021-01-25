<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS."validate.php";
include_once LIBS."gd_imagen.php";
require MODELS.'producto.php';
use Plataforma\Libs\Validate;

	$id = uniqid('PD', true);
	$categoria = $_POST['categoria'];
	$tipo = $_POST['tipo'];
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	$year = $_POST['year'];
	$fecha = $_POST['fecha'];
	$files = $_FILES['images'];

	// echo(IMG.'Simpson.avi');

	// Validate
	// $view = 'registrar_producto';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($categoria);
	// $obj_validar->validar_texto($titulo);
	// $obj_validar->validar_texto($descripcion);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);
	// $titulo = $obj_validar->randerizar_texto_sql($titulo);

	$carpeta_destino = MULTIMEDIA_S."productos/".$id."/";
	$carpeta_host = MULTIMEDIA_H."productos/".$id."/";
    if(!file_exists($carpeta_destino)) @mkdir($carpeta_destino); 

	$check_files = count($files["name"]);
	$obj_producto = new Producto();
    $cont_existe_file = 1;
    $str_preview = '';
	$type_preview = '';
	$flag_preview = False;

	$insertar = $obj_producto->insertar($id,$categoria,$tipo,$titulo,$descripcion,$year,$str_preview,$type_preview,$fecha);

    if ($check_files > 0) {
    	for($i=0;$i<count($files["name"]);$i++){
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
		            	if ($flag_preview == False) {
		            		$url_archivo_preview = $carpeta_destino.$name_clear.'_preview.'.$extension;
		            		$preview = optimizar_imagen($origen_archivo, $url_archivo_preview, 300, 300, $extension, Null, 90);
		            		$str_preview = $carpeta_host.$preview;
		            		$type_preview = $type;
		    				$name_mult = optimizar_imagen($origen_archivo, $url_archivo, $xf, $yf, $extension, $size);
		    				$flag_preview = True;
		            	}else{
		    				$name_mult = optimizar_imagen($origen_archivo, $url_archivo, $xf, $yf, $extension, $size);
		            	}
		            }else if($type == 'video') {
		            	if ($extension != 'mp4'){
		            		$name_clear = str_replace(' ', '_', $name_clear);
		            		$name_archivo = $name_clear.'.mp4';
							$name_mult = $name_archivo;
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
	            		if ($flag_preview == False) {
					        $str_preview = $carpeta_host.$name_archivo;
		            		$type_preview = $type;
		            		$flag_preview = True;
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
		            $str_type = tipo_ext_bd($type,$extension);	            
		            // echo('tipo: '.$type);
		            // echo "<br>";
					$insertar_mu = $obj_producto->insertar_mu(Null,$id,$url_host,$str_type);
		        }
		        else{
		            // echo 'Error en Carpeta Archivo<br>';
		            // header("Location: ".HOST."panel/success?&url_redirect=$url_redirect&active=$active");
					// exit;
		        }
		    }
		}
    } else {
		$str_preview = '';
		$type_preview = '';
    }
    
	$actualizar_img = $obj_producto->actualizar_img($id,$str_preview,$type_preview);
    
	$url_redirect = HOST.'gestion_productos';
	$active = 'gestion_productos';
	header("Location: ".HOST."panel/success?&url_redirect=$url_redirect&active=$active");
	exit;
  
?>

