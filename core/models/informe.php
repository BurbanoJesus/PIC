<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';
Class Informe extends Db{
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

	function insertar($id,$url_informe,$tipo_informe,$usuario,$year,$municipio,$dimension,$tecnologia,$grupo,$fecha){
		try{
			$sql = "INSERT INTO informes VALUES(:id,:url_informe,:tipo_informe,:usuario,:year,:municipio,:dimension,:tecnologia,:grupo,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'url_informe' => $url_informe, 'tipo_informe' => $tipo_informe, 'usuario' => $usuario, 'year' => $year, 'municipio' => $municipio, 'dimension' => $dimension, 'tecnologia' => $tecnologia, 'grupo' => $grupo, 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Informe';
			$this->debug($error,$tipo);
		}
	}

	function listar($usuario,$municipio){
		$sql_count = "SELECT COUNT(*) AS total FROM informes WHERE usuario = :usuario AND municipio = :municipio";
        $count = $this->db->prepare($sql_count);
        $count->execute(['usuario' => $usuario, 'municipio' => $municipio]);
        if ($count->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        $this->calcularPaginas($count);
		$sql = "SELECT * FROM informes WHERE usuario = :usuario AND municipio = :municipio LIMIT :since, :numero";
		$query = $this->db->prepare($sql);
        $query->execute(['since' => $this->indice, 'numero' => $this->resultadosPorPagina, 'usuario' => $usuario, 'municipio' => $municipio]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function listar_all($municipio){
		$sql_count = "SELECT COUNT(*) AS total FROM informes WHERE municipio = :municipio";
        $count = $this->db->prepare($sql_count);
        $count->execute(['municipio' => $municipio]);
        if ($count->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        $this->calcularPaginas($count);
        var_dump($municipio);
		$sql = "SELECT * FROM informes WHERE municipio = :municipio LIMIT :since, :numero";
		$query = $this->db->prepare($sql);
        $query->execute(['since' => $this->indice, 'numero' => $this->resultadosPorPagina,'municipio' => $municipio]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	// function listar(){
	// 	$sql_count = "SELECT COUNT(*) AS total FROM informes";
 //        $count = $this->db->prepare($sql_count);
 //        $count->execute();
 //        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
 //        $this->calcularPaginas($count);
	// 	$sql = "SELECT * FROM informes LIMIT :since, :numero";
	// 	$query = $this->db->prepare($sql);
	// 	// var_dump($query);
 //        $query->execute(['since' => $this->indice, 'numero' => $this->resultadosPorPagina]);
	// 	// $query->get_result();
	// 	$collect = Null;
	// 	while($row = $query->fetchObject()){
	// 	    $collect[] = $row;
	// 	}
	// 	return $collect;
	// }

	function filtrar($municipio,$dimension,$tecnologia,$grupo,$year){
		$municipio = ($municipio == '') ? '%%' : $municipio;
		$dimension = ($dimension == '') ? '%%' : $dimension;
		$tecnologia = ($tecnologia == '') ? '%%' : $tecnologia;
		$grupo = ($grupo == '') ? '%%' : $grupo;
		$year = ($year == '') ? '%%' : $year;

        $sql_count = "SELECT COUNT(*) AS total FROM informes WHERE municipio like :municipio AND dimension like :dimension AND tecnologia like :tecnologia AND grupo like :grupo AND year like :year";
        $count = $this->db->prepare($sql_count);
        $count->execute(['municipio' => $municipio, 'dimension' => $dimension, 'tecnologia' => $tecnologia, 'grupo' => $grupo, 'year' => $year]);
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        if ($count == 0) return False;
        $this->calcularPaginas($count);

		$sql = "SELECT * FROM informes WHERE municipio like :municipio AND dimension like :dimension AND tecnologia like :tecnologia AND grupo like :grupo AND year like :year LIMIT :since, :numero";
		$query = $this->db->prepare($sql);
		$query->execute(['since' => $this->indice, 'numero' => $this->resultadosPorPagina,'municipio' => $municipio, 'dimension' => $dimension, 'tecnologia' => $tecnologia, 'grupo' => $grupo, 'year' => $year]);
        if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function detalles($id){
		// $sql = "SELECT nombres,url_informe,fecha,dimension,tecnologia,grupo,year,informes.municipio FROM informes JOIN USUARIOS ON informes.usuario = USUARIOS.usuario WHERE id_informe = :id";
		$sql = "SELECT usuario,url_informe,fecha,dimension,tecnologia,grupo,year,municipio FROM informes WHERE id_informe = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);
		if ($query->rowCount() == 0) return False;
		return $row = $query->fetchObject();
	}

	function url_informe($id){
		$sql = "SELECT url_informe FROM informes WHERE id_informe = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row->url_informe;
	}

	function eliminar($id){
		try{
			$sql = "DELETE FROM informes WHERE id_informe = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Informe';
			$this->debug($error,$tipo);
		}
	}

	function eliminar_archivos($url_informe){
		$url_informe = str_replace(HOST, SERVER, $url_informe);
		try{
			if(is_file($url_informe)){
				unlink($url_informe);
			}else{
				$error = 'No existe archivo';
				$tipo = 'Eliminar';
				$this->debug($error,$tipo);
			} 
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Archivo informe';
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

	function __destruct(){
	}

}

?>