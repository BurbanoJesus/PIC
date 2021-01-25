<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';
Class Municipio extends Db{

	function insertar($id,$municipio){
		try{
			$sql = "INSERT INTO municipios VALUES(:id,:municipio)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'municipio' => $municipio]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Municipio';
			$this->debug($error,$tipo);
		}
	}

	function listar(){
		$sql = "SELECT * FROM municipios";
		$query = $this->db->prepare($sql);
		$query->execute();
		if ($query->rowCount() == 0) return False;
		// 
		$collect = Null;
		while($row = $query->fetchObject()){
			if ($row == False) return False;
		    $collect[] = $row;
		}
		return $collect;
	}

}

?>