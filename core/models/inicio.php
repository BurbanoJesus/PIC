<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';
Class Inicio extends Db{
	
	function insertar($id = Null, $url, $tipo){
		try{
			$sql = "INSERT INTO multimedia_inicio VALUES(:id,:url,:tipo)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'url' => $url, 'tipo' => $tipo]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Inicio';
			$this->debug($error,$tipo);
		}
	}

	function listar_slider(){
		$sql = "SELECT * FROM multimedia_inicio";
		$query = $this->db->prepare($sql);
		$query->execute();
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function eliminar($url){
		try{
			$sql = "DELETE FROM multimedia_inicio WHERE url = :url";
			$query = $this->db->prepare($sql);
			$query->execute(['url' => $url]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Inicio';
			$this->debug($error,$tipo);
		}
	}

	function eliminar_archivo($url){
		$url = str_replace(HOST, SERVER, $url);
		try{
			if(is_file($url)){
				unlink($url);
			}else{
				$error = 'No existe archivo';
				$tipo = 'Eliminar';
				$this->debug($error,$tipo);
			} 
			return True;
		}catch(Exception $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Inicio archivo';
			$this->debug($error,$tipo);
		}
	}

	function __destruct(){
	}

}

?>