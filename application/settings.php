<?php 
	define('HOST','http://localhost/plataforma/');
	define('SERVER',$_SERVER['DOCUMENT_ROOT'].'/plataforma/');
	define('VIEWS',SERVER.'views/');
	define('VIEWS_H',HOST.'views/');
	define('STATIC',SERVER.'static/');
	define('MODELS',SERVER.'core/models/');
	define('LIBS',SERVER.'core/libs/');
	define('DATABASE',SERVER.'application/database/');
	define('MULTIMEDIA_S',SERVER.'static/multimedia/');
	define('IMG',HOST.'static/img/');
	define('JS',HOST.'static/js/');
	define('CSS',HOST.'static/css/');
	define('CONTROLLERS',HOST.'core/controllers/');
	define('MULTIMEDIA_H',HOST.'static/multimedia/');

	// Nombres Principales
	define('NOMBRE_APP','Plataforma PIC');
	define('NOMBRE_MUNICIPIO','Arboleda');
	define('NOMBRE_CABECERA','Berruecos');

	// Municipio
	$nombre_municipio = "Arboleda";
	$nombre_cabecera = "Berruecos";
	$nombre_app = "plataforma";

	// Menu Inicio
	$inicio = "";
	$experiencias = "";
	$aprende = "";
	$juegos = "";
	$quienes = "";
	$ubicaciones = "";
	$cuenta = "";

	// Menu Panel
	$generar_informes = "";
	$busqueda_informes = "";
	$estructura_principal = "";
	$notificaciones = "";
	$gestion_ubicaciones = "";
	$gestion_productos = "";
	$gestion_usuarios = "";
	$gestion_cursos = "";
	$pagina_inicio = "";

	//
	// FUNCION MANEJO DE ERRORES
	// set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
	// {throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );}, E_WARNING);

	// set_error_handler(function($errno, $errstr, $errfile, $errline)
	// {
	//     if (!(error_reporting() & $errno)) {
	//         // Este código de error no está incluido en error_reporting
	//         return;
	//     }

	//     switch ($errno) {
	//     case E_USER_ERROR:
	//         echo "<b>Mi ERROR</b> [$errno] $errstr<br />\n";
	//         echo "  Error fatal en la línea $errline en el archivo $errfile";
	//         echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
	//         echo "Abortando...<br />\n";
	//         exit(1);
	//         break;

	//     case E_USER_WARNING:
	//         echo "<b>Mi WARNING</b> [$errno] $errstr<br />\n";
	//         break;

	//     case E_USER_NOTICE:
	//         echo "<b>Mi NOTICE</b> [$errno] $errstr<br />\n";
	//         break;

	//     case E_WARNING:
	//     	echo "<b>Waring</b> [$errno] $errstr<br />\n";
	//         break;

	//     default:
	//         echo "Tipo de error desconocido: [$errno] $errstr<br />\n";
	//         break;
	//     }

	//     /* No ejecutar el gestor de errores interno de PHP */
	//     return true;
	// });
	// 
	// 

	date_default_timezone_set('America/Bogota');
	$fecha_actual = date("Y-m-d H:i:s"); //se utiliza i en minutos porque m es para mes.
	$year_actual = date("Y");
	// var_dump($fecha_actual);
	$months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

	//Funcion para convertir array en cadena sql separada de comas
	function to_datos_sql($array=[])
	{
		$str_sql = '';
		foreach ($array as $key => $value) {
			if ($key == 0) {
				if (is_int($value)) {
					$str_sql .= $value;
				}
				else{
					$str_sql .= '"'.$value.'"';
				}
			} else {
				if (is_int($value)) {
					$str_sql .= ','.$value;
				}else{
					$str_sql .= ',"'.$value.'"';
				}
			}
		}
		return $str_sql;
	}

	//Funcion para convertir fecha (yyyy-mm-dd hh:mm:ss) en string dia de mes de año.
	function to_fecha_str($fecha){
		global $months;
		$fecha = substr($fecha,0,10);
		$fecha = explode('-', $fecha);
		$yy = $fecha[0];
		$month = $fecha[1];
		$day = $fecha[2];
		// $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
		$fecha = $day.' de '.$months[$month-1].' de '.$yy;
		return $fecha;
	}

	//Funcion para convertir fecha (yyyy-mm-dd hh:mm:ss) en string HH:MM [a.m.,p.m.].
	function to_hora_str($fecha){
		$hora = substr($fecha,-9);
		$hora = explode(':', $hora);
		$hour = $hora[0];
		$min = $hora[1];
		$sec = $hora[2];
		$hour =(int) $hour;
		$format = ($hour >= 12)  ? " p.m." : " a.m.";
		$hour = ($hour > 12)  ? $hour-12 : $hour;
		$hour = ($hour == 0)  ? 12 : $hour;
		$hour = ($hour < 10)  ? "0".$hour : $hour;
		$hora = $hour.':'.$min.$format;
		// $fecha = date('h:i a', strtotime($fecha));
		// $fecha = str_replace('am', 'a.m.', $fecha);
		// $fecha = str_replace('pm', 'p.m.', $fecha);
		return $hora;
	}

	//Funcion para convertir fecha (yyyy-mm-dd hh:mm:ss) en string DD/MM/YYYY.
	function to_fecha_simp_str($fecha){
		$fecha = substr($fecha,0,10);
		$fecha = explode('-', $fecha);
		$yy = $fecha[0];
		$month = $fecha[1];
		$day = $fecha[2];
		// $months = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
		// $fecha = $day.'/'.$months[$month-1].'/'.$yy;
		$fecha = $day.'/'.$month.'/'.$yy;
		return $fecha;
	}


	//Funcion para convertir fecha (yyyy-mm-dd hh:mm:ss) en string DD/MM/YYYY.
	function date_ago($fecha){
		global $fecha_actual;
		$fecha1 = new DateTime($fecha_actual);//fecha inicial
		$fecha2 = new DateTime($fecha);//fecha de cierre
		$interval = date_diff($fecha1, $fecha2);
		// echo $interval->format('%Y años %m meses %d Dias %H horas %i minutos %s segundos');
		$years = (int) $interval->format('%y');
		$meses = (int) $interval->format('%m');
		$dias = (int) $interval->format('%d');
		$horas = (int) $interval->format('%h');
		$minutos = (int) $interval->format('%i');
		$segundos = (int) $interval->format('%s');
		// echo "<br>".$meses;
		// echo "<br>".$horas;
		// echo "<br>".$minutos;
		$str_date_ago = '';
		switch (True) {
			case ($years > 0):
				if ($years == 1) {
					$str_date_ago = 'hace '.$years.' año';
				}else{
					$str_date_ago = 'hace '.$years.' años';
					
				}
				break;

			case ($meses > 0):
				if ($meses == 1) {
					$str_date_ago = 'hace '.$meses.' mes';
				}else{
					$str_date_ago = 'hace '.$meses.' meses';
					
				}
				break;

			case ($dias > 0):
				if ($dias == 1) {
					$str_date_ago = 'hace '.$dias.' dia';
				}else{
					$str_date_ago = 'hace '.$dias.' dias';
					
				}
				break;

			case ($horas > 0):
				if ($horas == 1) {
					$str_date_ago = 'hace '.$horas.' hora';
				}else{
					$str_date_ago = 'hace '.$horas.' horas';
					
				}
				break;

			case ($minutos > 0):
				if ($minutos == 1) {
					$str_date_ago = 'hace '.$minutos.' minuto';
				}else{
					$str_date_ago = 'hace '.$minutos.' minutos';
					
				}
				break;
			
			case ($segundos < 60):
				$str_date_ago = 'hace un momento';

			default:
				break;
		}
		return $str_date_ago;
	}
	
	//Funcion para saber el tipo de archivo multimedia.
	function type_multimedia($url){
		$url = explode('/', $url);
		$nombre = end($url);
		$nombre = explode('.', $nombre);
		$extension = end($nombre);
		$extension = trim($extension);
		$extension = strtolower($extension);
		// echo $extension;
		if ($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg') {
			$type = 'imagen';
		} else {
			$type = 'video';
		}
		return $type;
	}

	//Funcion para saber el tipo de archivo multimedia.
	function ext_multimedia($url){
		$url = explode('/', $url);
		$nombre = end($url);
		$nombre = explode('.', $nombre);
		$extension = end($nombre);
		$extension = trim($extension);
		$extension = strtolower($extension);
		return $extension;
	}

	//Funcion para saber si hay conexion a la base de datos.
	function ping($bd){
		if ($bd->ping()) {
		    printf ("¡La conexión está bien!\n");
		} else {
		    printf ("Error: %s\n", $bd->error);
		}
	}

	//
    function tipo_icon_mult($tipo){
    	$str_icon = '';
    	switch ($tipo) {
    		case ($tipo == 'word' || $tipo == 'doc'):
    			$str_icon = '<img  class="actividad_file" src="/plataforma/static/img/files/word.png" alt="" />';
    			break;

    		case 'excel':
    			$str_icon = '<img  class="actividad_file" src="/plataforma/static/img/files/excel.png" alt="" />';
    			break;

    		case 'pdf':
    			$str_icon = '<img  class="actividad_file" src="/plataforma/static/img/files/pdf.png" alt="" />';
    			break;

    		case 'power':
    			$str_icon = '<img  class="actividad_file" src="/plataforma/static/img/files/power_point.png" alt="" />';
    			break;

    		case 'txt':
    			$str_icon = '<img  class="actividad_file" src="/plataforma/static/img/files/txt.png" alt="" />';
    			break;

    		case 'rar':
    			$str_icon = '<img  class="actividad_file" src="/plataforma/static/img/files/rar.png" alt="" />';
    			break;

    		case 'otro':
    			$str_icon = '<img  class="actividad_file" src="/plataforma/static/img/files/file.png" alt="" />';
    			break;
    		
    	}
    	return $str_icon;
    }

    // 
 	function name_url($url){
 		$url_arr = explode('/', $url);
 		$name = end($url_arr);

 		return $name;
 	}

 	// 
 	function recursiveDelete($url) {
	    if (is_file($url)) {
	        return @unlink($url);
	    }
	    elseif (is_dir($url)) {
	        $scan = glob(rtrim($url,'/').'/*');
	        foreach($scan as $index=>$path) {
	            recursiveDelete($path);
	        }
	        return @rmdir($url);
	    }
	}




 ?>