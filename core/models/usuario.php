<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';

require SERVER.'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

Class Usuario extends Db{
	private $paginaActual;
    private $totalPaginas;
    private $nResultados;
    private $resultadosPorPagina;
    private $indice;

	public function __construct(){
		parent::__construct();
		$this->resultadosPorPagina = 15;
        $this->indice = 0;
        $this->paginaActual = 1;
	}

	function insertar($correo,$nombres,$tipo_id,$identificacion,$telefono,$municipio,$img_preview,$img_usuario,$usuario,$password,$tipo_usuario,$codigo,$fecha_codigo,$carpeta_usuario,$fecha,$admin = 0)
	{
		try{
			$sql = "INSERT INTO usuarios VALUES(:correo,:nombres,:tipo_id,:identificacion,:telefono,:municipio,:img_preview,:img_usuario,:usuario,:password,:tipo_usuario,:estado,:codigo,:fecha_codigo,:carpeta_usuario,:estado_juego_vf,:estado_juego_ahorcado,:estado_juego_arrastrar,:fecha)";
			$estado_usuario  = ($admin == 1) ? 'A' : 'D';
			$query = $this->db->prepare($sql);
			$query->execute(['correo' => $correo, 'nombres' => $nombres, 'tipo_id' => $tipo_id, 'identificacion' => $identificacion, 'telefono' => $telefono, 'municipio' => $municipio, 'img_preview' => $img_preview, 'img_usuario' => $img_usuario, 'usuario' => $usuario, 'password' => $password, 'tipo_usuario' => $tipo_usuario, 'estado' => $estado_usuario, 'codigo' => $codigo, 'fecha_codigo' => $fecha_codigo, 'carpeta_usuario' => $carpeta_usuario, 'estado_juego_vf' => 'D', 'estado_juego_ahorcado' => 'D', 'estado_juego_arrastrar' => 'D', 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Usuario';
			$this->debug($error,$tipo);
		}
	}

	function listar(){
		$sql_count = "SELECT COUNT(*) AS total FROM usuarios";
        $count = $this->db->prepare($sql_count);
        $count->execute();
        if ($count->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        $this->calcularPaginas($count);
		$sql = "SELECT * FROM usuarios LIMIT :since, :numero";
		$query = $this->db->prepare($sql);
        $query->execute(['since' => $this->indice, 'numero' => $this->resultadosPorPagina]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function carpeta_usuario($usuario){
		$sql = "SELECT carpeta_usuario FROM usuarios WHERE usuario = :usuario LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['usuario' => $usuario]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row->carpeta_usuario;
	}

	function actualizar($correo,$nombres,$tipo_id,$identificacion,$telefono,$municipio,$img_preview,$img_usuario,$usuario){
		try{
			$sql = "UPDATE usuarios SET 
			correo = :correo, 
			nombres = :nombres,
			tipo_id = :tipo_id,
			identificacion = :identificacion,
			telefono = :telefono,
			municipio = :municipio,
			img_preview = :img_preview,
			img_usuario = :img_usuario
			WHERE usuario = :usuario";
			$query = $this->db->prepare($sql);
			$query->execute(['correo' => $correo, 'nombres' => $nombres, 'tipo_id' => $tipo_id, 'identificacion' => $identificacion, 'telefono' => $telefono, 'municipio' => $municipio, 'img_preview' => $img_preview, 'img_usuario' => $img_usuario, 'usuario' => $usuario]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Usuario';
			$this->debug($error,$tipo);
		}
	}

	function login($usuario,$pass){
		$sql = "SELECT * FROM usuarios WHERE usuario = :usuario OR correo = :correo LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['usuario' => $usuario, 'correo' => $usuario]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		if (password_verify($pass, $row->password) === False) return False;
		if ($row->estado == 'D') return False;
		return $row;
	}

	function usuario_por_email($correo,$email_active = 0){
		$sql = "SELECT correo,estado,nombres,usuario FROM usuarios WHERE correo = :correo LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['correo' => $correo]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		if ($email_active === 0) {
			if ($row->estado == 'D') return False;
		}
		return $row;
	}

	function usuario_por_nickname($usuario){
		$sql = "SELECT usuario,estado FROM usuarios WHERE usuario = :usuario LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['usuario' => $usuario]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		if ($row->estado == 'D') return False;
		return $row;
	}

	function usuario_por_nickname_all($usuario){
		$sql = "SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['usuario' => $usuario]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		if ($row->estado == 'D') return False;
		return $row;
	}

	function flag_usuario_email($correo){
		$sql = "SELECT correo,estado FROM usuarios WHERE correo = :correo LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['correo' => $correo]);
		if ($query->rowCount() == 0) return False;
		return True;
	}

	function flag_usuario_nickname($usuario){
		$sql = "SELECT usuario,estado FROM usuarios WHERE usuario = :usuario LIMIT 1";
		// echo($sql);
		$query = $this->db->prepare($sql);
		$query->execute(['usuario' => $usuario]);
		if ($query->rowCount() == 0) return False;
		return True;
	}

	function comprobar_codigo($usuario,$codigo){
		$sql = "SELECT usuario,codigo,fecha_codigo FROM usuarios WHERE usuario= BINARY :usuario LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['usuario' => $usuario]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		$fecha_actual = date("Y-m-d H:i:s");
		if ($codigo != $row->codigo) return False;
		if (strtotime($fecha_actual) > strtotime($row->fecha_codigo)) return False;
		return $row;
	}

	function actualizar_estado($usuario){
		try{
			$sql = "UPDATE usuarios SET estado= :estado WHERE usuario = :usuario";
			$query = $this->db->prepare($sql);
			$query->execute(['estado' => 'A', 'usuario' => $usuario]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Estado usuario';
			$this->debug($error,$tipo);
		}
	}

	function actualizar_codigo($usuario,$codigo,$fecha_codigo){
		try{
			$sql = "UPDATE usuarios SET codigo= :codigo, fecha_codigo= :fecha_codigo WHERE usuario = :usuario";
			// echo($sql);
			$query = $this->db->prepare($sql);
			$query->execute(['codigo' => $codigo, 'fecha_codigo' => $fecha_codigo, 'usuario' => $usuario]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Estado usuario';
			$this->debug($error,$tipo);
		}
	}

	function actualizar_pass($usuario,$password){
		try{
			$sql = "UPDATE usuarios SET password= BINARY :password WHERE usuario = :usuario";
			$query = $this->db->prepare($sql);
			$query->execute(['password' => $password, 'usuario' => $usuario]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Password';
			$this->debug($error,$tipo);
		}
	}

	function actualizar_progreso_juegos($nombre_juego)
    {	
    	try{
	    	switch ($nombre_juego) {
	    		case 'juego_vf':
	    			$str_tb_juego = 'JUEGOS_VF';
	    			$str_estado_juego = 'estado_juego_vf';
	    			break;
	    		
	    		case 'juego_ahorcado':
	    			$str_tb_juego = 'JUEGOS_AHORCADO';
	    			$str_estado_juego = 'estado_juego_ahorcado';
	    			break;

	    		case 'juego_arrastrar':
	    			$str_tb_juego = 'JUEGOS_ARRASTRAR';
	    			$str_estado_juego = 'estado_juego_arrastrar';
	    			break;

	    		default:
	    			# code...
	    			break;
	    	}
	    	$sql_count = "SELECT COUNT(*) AS total FROM $str_tb_juego";
	    	$query_count = $this->db->prepare($sql_count);
			$query_count->execute();
			if ($query_count->rowCount() == 0) return False;
			$count = $query_count->fetchObject()->total;

	    	$sql = "SELECT COUNT(*) AS total FROM JUEGOS_PROGRESO WHERE nombre_juego = :nombre_juego AND usuario = :usuario";
			$query = $this->db->prepare($sql);
			$query->execute(['nombre_juego' => $nombre_juego, 'usuario' => $_SESSION['usuario']->usuario]);
			$count_2 = $query->fetchObject()->total;
			if ($query->rowCount() == 0) return False;

			if ($count == $count_2){
				$sql = "UPDATE usuarios SET $str_estado_juego = :estado WHERE usuario = :usuario";
				$query = $this->db->prepare($sql);
				$query->execute(['estado' => 'A', 'usuario' => $_SESSION['usuario']->usuario]);
				if ($query->rowCount() == 0) return False;
				$_SESSION['usuario']->$str_estado_juego = 'A';
			}
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Juego progreso';
			$this->debug($error,$tipo);
		}
    }

    function actualizar_progreso_cursos($id_actividad)
    {
    	try{
	    	$sql = "SELECT CURSOS.id_curso,modulos.id_modulo FROM actividades INNER JOIN modulos ON actividades.id_modulo = modulos.id_modulo INNER JOIN CURSOS ON modulos.id_curso = cursos.id_curso WHERE id_actividad = :id_actividad";
			$query = $this->db->prepare($sql);
			$query->execute(['id_actividad' => $id_actividad]);
			if ($query->rowCount() == 0) return False;
			$row = $query->fetchObject();

			$sql = "INSERT INTO cursos_progreso VALUES(Null,:id_curso,:id_modulo,:id_actividad,:usuario)";
			$query = $this->db->prepare($sql);
			$query->execute(['id_curso' => $row->id_curso, 'id_modulo' => $row->id_modulo, 'id_actividad' => $id_actividad, 'usuario' => $_SESSION['usuario']->usuario]);
			if ($query->rowCount() == 0) return False;
			return $row->id_modulo;
			
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Progreso curso';
			$this->debug($error,$tipo);
		}

    }

    function cursos_examenes($id_actividad,$nota,$fecha){
		try{
	  //   	$sql = "SELECT cursos.id_curso,modulos.id_modulo FROM actividades INNER JOIN modulos ON actividades.id_modulo = modulos.id_modulo INNER JOIN cursos ON modulos.id_curso = cursos.id_curso WHERE id_actividad = :id_actividad";
			// $query = $this->db->prepare($sql);
			// $query->execute(['id_actividad' => $id_actividad]);
			// if ($query->rowCount() == 0) return False;
			// $row = $query->fetchObject();

			$sql = "INSERT INTO cursos_examenes VALUES(Null,:id_actividad,:usuario,:nota,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id_actividad' => $id_actividad, 'usuario' => $_SESSION['usuario']->usuario, 'nota' => $nota, 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Curso examen';
			$this->debug($error,$tipo);
		}
	}

	function numero_intentos_examen($id_actividad){
	    	$sql = "SELECT COUNT(*) AS total FROM cursos_examenes WHERE id_actividad = :id_actividad AND usuario = :usuario";
			$query = $this->db->prepare($sql);
			$query->execute(['id_actividad' => $id_actividad, 'usuario' => $_SESSION['usuario']->usuario]);
			if ($query->rowCount() == 0) return False;
			$row = $query->fetchObject();
			return $row->total;
	}

	function comprobar_suscripcion($id_curso){
	    	$sql = "SELECT id_curso,usuario FROM cursos_suscripciones WHERE id_curso = :id_curso AND usuario = :usuario";
			$query = $this->db->prepare($sql);
			$query->execute(['id_curso' => $id_curso, 'usuario' => $_SESSION['usuario']->usuario]);
			if ($query->rowCount() == 0) return False;
			$row = $query->fetchObject();
			return $row;
	}

	function cursos_subs($id_curso,$codigo,$fecha){
		try{
			$sql = "INSERT INTO cursos_suscripciones VALUES(Null,:id_curso,:usuario,:codigo,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id_curso' => $id_curso, 'usuario' => $_SESSION['usuario']->usuario, 'codigo' => $codigo, 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Curso suscripcion';
			$this->debug($error,$tipo);
		}
	}

	function cursos_codigos($id_curso,$codigo){
		try{
			$sql = "INSERT INTO cursos_codigos VALUES(Null,:id_curso,:codigo,:usuario)";
			$query = $this->db->prepare($sql);
			$query->execute(['id_curso' => $id_curso, 'codigo' => $codigo, 'codigo' => $codigo,  'usuario' => $_SESSION['usuario']->usuario]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Curso codigos';
			$this->debug($error,$tipo);
		}
	}

    function listar_progreso_actividades($id_modulo)
    {
    	$sql = "SELECT * FROM cursos_progreso WHERE id_modulo = :id_modulo AND usuario = :usuario";
		$query = $this->db->prepare($sql);
		$query->execute(['id_modulo' => $id_modulo, 'usuario' => $_SESSION['usuario']->usuario]);
		if ($query->rowCount() == 0) return False;
		// 
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
    }

    function listar_progreso_modulos($id_curso)
    {
    	$sql = "SELECT * FROM cursos_progreso WHERE id_curso = :id_curso AND usuario = :usuario";
		$query = $this->db->prepare($sql);
		$query->execute(['id_curso' => $id_curso, 'usuario' => $_SESSION['usuario']->usuario]);
		if ($query->rowCount() == 0) return False;
		// 
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
    }

    function listar_progreso_perfil($usuario)
    {
    	$sql = "SELECT cursos.id_curso,nombre_curso FROM cursos_suscripciones JOIN cursos ON cursos_suscripciones.id_curso = cursos.id_curso WHERE usuario = :usuario";
		$query = $this->db->prepare($sql);
		$query->execute(['usuario' => $usuario]);
		if ($query->rowCount() == 0) return False;
		// 
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
    }


    function eliminar($usuario){
    	try{
			$sql = "DELETE FROM usuarios WHERE usuario = :usuario";
			$query = $this->db->prepare($sql);
			$query->execute(['usuario' => $usuario]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Usuario';
			$this->debug($error,$tipo);
		}
	}

	function eliminar_archivos($id){
		try{
			$carpeta_server = MULTIMEDIA_S."usuarios/$id/";
			$sel_archivos = MULTIMEDIA_S."usuarios/$id/*";
			if (file_exists($carpeta_server)) {
				$files = glob($sel_archivos);
				foreach($files as $file){
				    if(is_file($file))
				    unlink($file);
				}
				rmdir($carpeta_server);
				return True;
			}else{
				$error = 'No existe carpeta';
				$tipo = 'Eliminar';
				$this->debug($error,$tipo);
			}
		}catch(Exception $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Carpeta usuario';
			$this->debug($error,$tipo);
		}
	}

	function enviar_email($correoElectronico, $nombre, $template, $subject)
    {	
	   // echo "<br>".$correoElectronico;
	   // echo "<br>".$nombre;

       	$mail = new PHPMailer;
		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// SMTP::DEBUG_OFF = off (for production use)
		// SMTP::DEBUG_CLIENT = client messages
		// SMTP::DEBUG_SERVER = client and server messages
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption mechanism to use - STARTTLS or SMTPS
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = 'plataformapic.soporte@gmail.com';
		$mail->Password = '@PIC_1234';

		$mail->setFrom('plataformapic.soporte@gmail.com', 'Plataforma Salud');
		$mail->addAddress($correoElectronico, $nombre);
		$mail->Subject = $subject;
		$mail->msgHTML($template);
		if (!$mail->send()) {
		    // echo 'Mailer Error: '. $mail->ErrorInfo;
		} else {
		    // echo 'Message sent!';
		}
	}

    function createRandomCode()
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
    
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
    
        return time().$pass;
    }

    function calcularPaginas($count){
        $this->nResultados  = $count;
        $this->totalPaginas = ceil($this->nResultados / $this->resultadosPorPagina);

        if(isset($_GET['pagina'])){
            $this->paginaActual = $_GET['pagina'];
            $this->indice = ($this->paginaActual - 1) * $this->resultadosPorPagina;
        }
    }

    function mostrarPaginas($rango){
    	if ($this->totalPaginas > 1 && $this->paginaActual <= $this->totalPaginas){
	        $actual = '';
	        $sincePag = 1;
	        $untilPag = $this->totalPaginas;
	        $rangoPag = $rango;
	        if($rangoPag <= $this->totalPaginas){
		        if($rangoPag % 2 == 0) {
		        	$limitIn = $rangoPag/2;
			        $limitOut= $rangoPag/2;
			        $isPar = True;
		        }else{
			        $limitIn = floor($rangoPag/2);
			        $limitOut= ceil($rangoPag/2);
			        $isPar = False;
		        }
		        
		        if($this->paginaActual <= $limitOut){
		        	// echo "strin a";
		        	$sincePag = 1;
		        	$untilPag = $rangoPag;
		        }

		        if($this->paginaActual > $limitOut && $this->paginaActual <= $this->totalPaginas - $limitOut){
		        	if ($isPar == True) {
		        		$sincePag = $this->paginaActual - $limitIn + 1;
		        		$untilPag = $this->paginaActual + $limitOut;
		        	}else{
			        	$sincePag = $this->paginaActual - $limitIn;
			        	$untilPag = $this->paginaActual + $limitOut - 1;
		        	}
		        }

		        if($this->paginaActual > $this->totalPaginas - $limitOut){
		        	$sincePag = $this->totalPaginas - $rangoPag + 1;
		        	$untilPag = $this->totalPaginas;
		        }
		    }
		    // 
		    if (isset($_GET)) {
		    	$href = '?';
			    foreach ($_GET as $key => $value){
			    	if ($key != 'pagina') {
			    		$href .= $key.'='.$value.'&';
			    	}
			    }
			    $href .= 'pagina=';
		    }else{
		    	$href = '?pagina=';
		    }
		    // 
	        echo '<ul class="paginador">';
	        if($this->paginaActual > 1){
        		echo '<li class="paginador"><a class="next_prev" href="'.$href.($this->paginaActual - 1).'">Anterior</a><li>';
	        }else{
        		echo '<li class="paginador"><a class="next_prev none" href=""></a><li>';
	        } 
	        for($i=$sincePag; $i <= $untilPag; $i++){
	            if(($i) == $this->paginaActual){
	                $actual = ' class="actual" ';
	            }else{
	                $actual = '';
	            }
	            echo '<li class="paginador"><a '.$actual.'href="'.$href.($i).'">'.($i).'</a></li>';
	        }
	        if($this->paginaActual < $this->totalPaginas){
	        	// var_dump($_GET);
        		echo '<li class="paginador"><a class="next_prev" href="'.$href.($this->paginaActual + 1).'">Siguiente</a><li>';
	        }else{
        		echo '<li class="paginador"><a class="next_prev none" href=""></a><li>';
	        } 
	        echo '</ul>';
	    }
    }

    function mostrarTotalResultados(){
        return $this->nResultados;
    }

}

?>