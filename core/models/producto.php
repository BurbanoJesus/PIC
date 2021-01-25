<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';
Class Producto extends Db{
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

	function insertar($id,$categoria,$tipo,$titulo,$descripcion,$year,$preview,$tipo_preview,$fecha){
		try{
			$sql = "INSERT INTO productos VALUES(:id,:categoria,:tipo,:titulo,:descripcion,:year,:preview,:tipo_preview,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'categoria' => $categoria, 'tipo' => $tipo, 'titulo' => $titulo, 'descripcion' => $descripcion, 'year' => $year, 'preview' => $preview, 'tipo_preview' => $tipo_preview, 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Producto';
			$this->debug($error,$tipo);
		}
	}

	function listar(){
		$sql_count = "SELECT COUNT(*) AS total FROM productos";
        $count = $this->db->prepare($sql_count);
        $count->execute();
        if ($count->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        $this->calcularPaginas($count);
		$sql = "SELECT * FROM productos LIMIT :since, :numero";
		$query = $this->db->prepare($sql);
        $query->execute(['since' => $this->indice, 'numero' => $this->resultadosPorPagina]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function filtrar($categoria,$tipo,$busqueda){
		$categoria = ($categoria == '') ? '%%' : $categoria;
		$tipo = ($tipo == '') ? '%%' : $tipo;
		$busqueda = ($busqueda == '') ? '%%' : $busqueda;

        $sql_count = "SELECT COUNT(*) AS total FROM productos WHERE categoria like :categoria AND tipo_producto like :tipo AND titulo like :busqueda";
        $count = $this->db->prepare($sql_count);
        $count->execute(['categoria' => $categoria, 'tipo' => $tipo, 'busqueda' => '%'.$busqueda.'%']);
        if ($query->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        $this->calcularPaginas($count);

		$sql = "SELECT * FROM productos WHERE categoria like :categoria AND tipo_producto like :tipo AND titulo like :busqueda LIMIT :since, :numero";
		$query = $this->db->prepare($sql);
		$query->execute(['categoria' => $categoria, 'tipo' => $tipo,'busqueda' => '%'.$busqueda.'%','since' => $this->indice, 'numero' => $this->resultadosPorPagina]);
		if ($query->rowCount() == 0) return False;

		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function detalles($id){
		$sql = "SELECT * FROM productos NATURAL JOIN multimedia_prodcutos WHERE id_producto = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);

		if ($query->rowCount() == 0){
			$sql = "SELECT * FROM productos WHERE id_producto = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
		}
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function insertar_mu($id,$id_producto,$url_host,$str_type){
		try{
			$sql = "INSERT INTO multimedia_prodcutos VALUES(:id,:id_producto,:url_host,:str_type)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'id_producto' => $id_producto, 'url_host' => $url_host, 'str_type' => $str_type]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Producto Multimedia';
			$this->debug($error,$tipo);
		}
	}

	function actualizar_img($id,$str_preview,$type_preview){
		try{
			$sql = "UPDATE productos SET 
			str_preview = :str_preview, 
			type_preview = :type_preview
			WHERE id = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'str_preview' => $str_preview, 'type_preview' => $type_preview]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Producto Img';
			$this->debug($error,$tipo);
		}
	}

	function eliminar($id){
		try{
			$sql_a = "DELETE FROM productos WHERE id_producto = :id";
			$query_a = $this->db->prepare($sql_a);
			$query_a->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
			// 
			// $sql_b = "DELETE FROM MULTIMEDIA_productos WHERE id_producto = :id";
			// $query_b = $this->db->prepare($sql_b);
			// $query_b->execute(['id' => $id]);
			// if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Producto';
			$this->debug($error,$tipo);
		}
	}

	function eliminar_archivos($id){
		try{
			$carpeta_server = MULTIMEDIA_S."productos/$id/";
			$sel_archivos = MULTIMEDIA_S."productos/$id/*";
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
			$tipo = 'Eliminar - Carpeta Producto';
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