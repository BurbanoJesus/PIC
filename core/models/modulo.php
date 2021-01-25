<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';

Class Modulo extends Db{

	function insertar($id,$id_curso,$nombre,$descripcion,$fecha){
		try{
			$sql = "INSERT INTO modulos VALUES(:id,:id_curso,:nombre,:descripcion,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'id_curso' => $id_curso, 'nombre' => $nombre, 'descripcion' => $descripcion, 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Modulo';
			$this->debug($error,$tipo);
		}
	}

	function listar($id){
		$sql = "SELECT * FROM modulos WHERE id_curso = :id";
		$query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function listar_all($id){
		$sql = "SELECT * FROM modulos JOIN cursos on modulos.id_curso = cursos.id_curso WHERE cursos.id_curso = :id";
		$query = $this->db->prepare($sql); 
        $query->execute(['id' => $id]);
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

        $sql_count = "SELECT COUNT(*) AS total FROM modulos WHERE categoria like :categoria AND tipo like :tipo AND titulo like :busqueda";
        $count = $this->db->prepare($sql_count);
        $count->execute(['categoria' => $categoria, 'tipo' => $tipo, 'busqueda' => '%'.$busqueda.'%']);
        if ($query->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        $this->calcularPaginas($count);

		$sql = "SELECT * FROM modulos WHERE categoria like :categoria AND tipo like :tipo AND titulo like :busqueda LIMIT :since, :numero";
		// echo($sql);
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
		$sql = "SELECT * FROM modulos WHERE id_modulo = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row;
	}

	function detalles_actividad($id){
		$sql = "SELECT cursos.id_curso,nombre_modulo FROM modulos JOIN cursos on modulos.id_curso = cursos.id_curso WHERE modulos.id_modulo = :id LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row;
	}

	function detalles_id_curso($id_modulo){
		$sql = "SELECT cursos.id_curso FROM modulos JOIN cursos on modulos.id_curso = cursos.id_curso WHERE modulos.id_modulo = :id LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id_modulo]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row->id_curso;
	}

	function len_modulo($id_modulo){
		$sql = "SELECT COUNT(id_actividad) AS total FROM actividades  WHERE id_modulo = :id_modulo";
		$query = $this->db->prepare($sql);
		$query->execute(['id_modulo' => $id_modulo]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row->total;
	}

	function actualizar($id,$nombre,$descripcion){
		try{
			$sql = "UPDATE modulos SET 
			nombre_modulo = :nombre, 
			descripcion = :descripcion
			WHERE id_modulo = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['nombre' => $nombre, 'descripcion' => $descripcion, 'id' => $id]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Modulo';
			$this->debug($error,$tipo);
		}
	}

	function lista_eliminar_actividades($id_modulo){
		$sql = "SELECT id_actividad FROM actividades WHERE id_modulo = :id_modulo";
		$query = $this->db->prepare($sql);
		$query->execute(['id_modulo' => $id_modulo]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function eliminar($id_modulo){
		try{
			$sql = "DELETE FROM modulos WHERE id_modulo = :id_modulo";
			$query = $this->db->prepare($sql);
			$query->execute(['id_modulo' => $id_modulo]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Modulo';
			$this->debug($error,$tipo);
		}
	}

	function eliminar_archivos($id_modulo,$id_curso){
		try{
			$carpeta_server =  MULTIMEDIA_S."modulo/$id_curso/$id_modulo/";
			if (file_exists($carpeta_server)) {
			 	rmdir($carpeta_server);
			}else{
				$error = 'No existe carpeta';
				$tipo = 'Eliminar';
				$this->debug($error,$tipo);
			} 
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Modulo';
			$this->debug($error,$tipo);
		}
	}

}

?>