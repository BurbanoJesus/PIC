<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';
Class Notificacion extends Db{
	private $paginaActual;
    private $totalPaginas;
    private $nResultados;
    private $resultadosPorPagina;
    private $indice;

	public function __construct(){
		parent::__construct();
		$this->resultadosPorPagina = 10;
        $this->indice = 0;
        $this->paginaActual = 1;
	}

	function insertar($id,$descripcion,$tipo_notificacion,$usuario,$id_destino,$fecha){
		try{
			$sql = "INSERT INTO notificaciones VALUES(:id,:descripcion,:estado,:tipo_notificacion,:usuario,:id_destino,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'descripcion' => $descripcion, 'estado' => 'D', 'tipo_notificacion' => $tipo_notificacion, 'usuario' => $usuario, 'id_destino' => $id_destino, 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;	
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Notificacion';
			$this->debug($error,$tipo);
		}
	}

	function listar(){
		$sql_count = "SELECT COUNT(*) AS total FROM notificaciones JOIN usuarios ON notificaciones.usuario = usuarios.usuario WHERE notificaciones.estado = 'D'";
        $count = $this->db->prepare($sql_count);
        $count->execute();
        if ($count->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        $this->calcularPaginas($count);

		$sql = "SELECT id_notificacion,fecha,usuarios.usuario,tipo_usuario,descripcion FROM notificaciones JOIN usuarios ON notificaciones.usuario = usuarios.usuario WHERE notificaciones.estado = 'D' LIMIT :since, :numero";
		$query = $this->db->prepare($sql);
        $query->execute(['since' => $this->indice, 'numero' => $this->resultadosPorPagina]);
        if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function numero_notificaciones(){
		$sql_count = "SELECT COUNT(*) AS total FROM notificaciones JOIN usuarios ON notificaciones.usuario = usuarios.usuario WHERE notificaciones.estado = 'D'";
        $count = $this->db->prepare($sql_count);
        $count->execute();
        if ($count->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total;
		return $count;
	}

	function detalles($id){
		$sql = "SELECT tipo_notificacion FROM notificaciones WHERE id_notificacion = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		$tipo = $row->tipo_notificacion;
		// var_dump($tipo);
		if ($tipo == 'informe') {
			$sql = "SELECT tipo_notificacion,id_destino,url_informe,descripcion,municipio,notificaciones.usuario,notificaciones.fecha FROM notificaciones JOIN INFORMES ON notificaciones.id_destino = INFORMES.id_informe WHERE id_notificacion = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
			$row = $query->fetchObject();
		}else if ($tipo == 'usuario') {
			$sql = "SELECT tipo_notificacion,id_destino,nombres,tipo_usuario,descripcion,municipio,usuarios.usuario,notificaciones.fecha FROM notificaciones JOIN usuarios ON notificaciones.id_destino = usuarios.usuario WHERE id_notificacion = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
			$row = $query->fetchObject();
		}
		// }else if ($tipo == 'informe') {
		// 	$sql = "SELECT id_notificacion,fecha,usuarios.usuario,tipo_usuario,descripcion,municipio FROM notificaciones JOIN usuarios ON notificaciones.usuario = usuarios.usuario WHERE id_notificacion = :id";
		// 	$query = $this->db->prepare($sql);
		// 	$query->execute(['id' => $id]);
		// 	if ($query->rowCount() == 0) return False;
		// 	$row = $query->fetchObject();
		// }
		return $row;
	}

	function eliminar($id){
		try{
			$sql = "DELETE FROM notificaciones WHERE id_lugar = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Notificacion';
			$this->debug($error,$tipo);
		}
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