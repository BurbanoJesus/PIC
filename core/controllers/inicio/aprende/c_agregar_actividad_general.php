<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include_once LIBS.'validate.php';
include_once LIBS."gd_imagen.php";
require MODELS.'actividad.php';
use Plataforma\Libs\Validate;

	$id_actividad = uniqid('AC', true);
	$tipo = 'general';
	$id_modulo = $_POST['id_modulo'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$tiempo = $_POST['tiempo'];
	$fecha = $fecha_actual;
	$files = $_FILES['files'];
	// Validate
	$view = 'agregar_actividad';
	// $obj_validar = new Validate($view);
	// $obj_validar->validar_texto($titulo);
	// $fecha = $obj_validar->validar_fecha_actual($fecha);
	$obj_actividad = new Actividad();
	$id_curso = $obj_actividad->detalles_modulo($id_modulo);



	$carpeta_destino = MULTIMEDIA_S."cursos/".$id_curso."/".$id_modulo."/".$id_actividad."/";
	$carpeta_host = MULTIMEDIA_H."cursos/".$id_curso."/".$id_modulo."/".$id_actividad."/";
    @mkdir($carpeta_destino); 

	$check_files = count($files["name"]);
    $cont = 1;
    // 
	$insertar = $obj_actividad->insertar($id_actividad,$id_modulo,$nombre,$descripcion,$tiempo,$tipo,$fecha);
    
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
	    				$name_mult = optimizar_imagen($origen_archivo, $url_archivo, $xf, $yf, $extension, $size);
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
		            

					$insertar_mu = $obj_actividad->insertar_mu(Null,$id_actividad,$url_host,$str_type);
		        }
		        else{
		            // echo 'Error en Carpeta Archivo<br>';
		        }
		    }
		}
    } else {
    	
    }
        
	$url_redirect = HOST.'actividades?id='.$id_modulo;
	$active = 'aprende';
	header("Location: ".HOST."inicio/success?&url_redirect=$url_redirect&active=$active");
	exit;
?>

