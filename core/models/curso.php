<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';

Class Curso extends Db{

	function insertar($id,$nombre,$descripcion,$dimension,$url_host,$fecha){
		try{
			$sql = "INSERT INTO cursos VALUES(:id,:nombre,:descripcion,:dimension,:url_host,:nota_curso,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => 'CU5f76750a6d3180.15302091', 'nombre' => $nombre, 'descripcion' => $descripcion, 'dimension' => $dimension, 'url_host' => $url_host, 'nota_curso' => '0.0', 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;	
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Curso';
			$this->debug($error,$tipo);
		}
	}

	function listar(){
		$sql = "SELECT * FROM cursos";
		$query = $this->db->prepare($sql);
        $query->execute();
        if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function filtrar($dimension){
		$dimension = ($dimension == '') ? '%%' : $dimension;

		$sql = "SELECT * FROM cursos WHERE dimension like :dimension";
		$query = $this->db->prepare($sql);
		$query->execute(['dimension' => $dimension]);
			
		$collect = Null;

		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function detalles($id){
		try{
			$sql = "SELECT * FROM cursos WHERE id_curso = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
			$row = $query->fetchObject();
			return $row;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Curso';
			$this->debug($error,$tipo);
		}
	}

	function detalles_modulo($id){
		$sql = "SELECT id_curso,nombre_curso,img_curso,dimension,nota_curso FROM cursos WHERE id_curso = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row;
	}

	function actualizar($id,$nombre,$descripcion,$dimension,$url_host){
		try{
			$sql = "UPDATE cursos SET 
			nombre_curso = :nombre, 
			descripcion = :descripcion,
			dimension = :dimension,
			img_curso = :url_host
			WHERE id_curso = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['nombre' => $nombre, 'descripcion' => $descripcion, 'dimension' => $dimension, 'url_host' => $url_host, 'id' => $id]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Curso';
			$this->debug($error,$tipo);
		}
	}

	function listar_elmininar_modulos($id){
		$sql = "SELECT id_modulo FROM MODULOS WHERE id_curso = :id";
		$query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function eliminar($id){
		try{
			$sql_a = "DELETE FROM cursos WHERE id_curso = :id";
			$query_a = $this->db->prepare($sql_a);
			$query_a->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
			return True;
		}
		catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'eliminar - Curso';
			$this->debug($error,$tipo);
		}
	}

	function eliminar_archivos($id){
		try{
			$carpeta_server = MULTIMEDIA_S."cursos/$id/";
			$sel_archivos = MULTIMEDIA_S."cursos/$id/*";
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
			$tipo = 'Eliminar - Curso';
			$this->debug($error,$tipo);
		}
	}

	function insertar_comentario($id,$valoracion,$comentario,$usuario,$id_curso,$fecha){
		try{
			$sql = "INSERT INTO cursos_comentarios VALUES(:id,:valoracion,:comentario,:usuario,:id_curso,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'valoracion' => $valoracion, 'comentario' => $comentario, 'usuario' => $usuario, 'id_curso' => $id_curso, 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			$this->actualizar_nota_curso($id_curso);
			return True;			
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - comentario';
			$this->debug($error,$tipo);
		}
	}

	function actualizar_nota_curso($id_curso){
		try{
			$sql = "SELECT valoracion FROM cursos_comentarios WHERE id_curso = :id_curso";
			$query = $this->db->prepare($sql);
	        $query->execute(['id_curso' => $id_curso]);
	        if ($query->rowCount() == 0) return False;
	        $array = $query->rowCount();
			if ($array > 0){
				$sumatoria = 0;
				$total = 0;
				while($row = $query->fetchObject()){
				    $sumatoria = $sumatoria + $row->valoracion;
				    $total++;
				}
				$promedio = $sumatoria/$total;
			}else{
				$promedio = $valoracion;
			}

			$sql = "UPDATE cursos SET 
			nota_curso = :nota_curso
			WHERE id_curso = :id_curso";
			$query = $this->db->prepare($sql);
			$query->execute(['id_curso' => $id_curso, 'nota_curso' => $promedio]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - cursos';
			$this->debug($error,$tipo);
		}
	}


	function listar_comentarios($id_curso){
		$sql = "SELECT id_comentario,usuarios.usuario,nombres,img_preview,valoracion,texto_comentario,fecha_comentario FROM cursos_comentarios JOIN usuarios ON cursos_comentarios.usuario = usuarios.usuario WHERE id_curso = :id_curso ORDER BY fecha_comentario DESC";
		$query = $this->db->prepare($sql);
        $query->execute(['id_curso' => $id_curso]);
        if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function listar_comentarios_notas($id_curso){
		$sql = "SELECT valoracion, COUNT(*) AS total FROM cursos_comentarios WHERE id_curso = :id_curso GROUP BY valoracion";
		$query = $this->db->prepare($sql);
        $query->execute(['id_curso' => $id_curso]);
        if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function flag_comentario($id_curso,$usuario){
		$sql = "SELECT id_curso FROM cursos_comentarios WHERE id_curso = :id_curso AND usuario = :usuario LIMIT 1";
		$query = $this->db->prepare($sql);
        $query->execute(['id_curso' => $id_curso, 'usuario' => $usuario]);
		if ($query->rowCount() == 0) return False;
		return True;
	}

	function detalles_comentario($id_curso,$usuario){
		$sql = "SELECT img_curso,nombre_curso,valoracion,texto_comentario FROM cursos_comentarios JOIN cursos ON cursos_comentarios.id_curso = cursos.id_curso  WHERE cursos_comentarios.id_curso = :id_curso AND usuario = :usuario";
		$query = $this->db->prepare($sql);
		$query->execute(['id_curso' => $id_curso, 'usuario' => $usuario]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row;
	}

	function actualizar_comentario($valoracion,$comentario,$id_curso,$usuario){
		try{
			$sql = "UPDATE cursos_comentarios SET 
			valoracion = :valoracion, 
			texto_comentario = :comentario
			WHERE id_curso = :id_curso AND usuario = :usuario";
			$query = $this->db->prepare($sql);
			$query->execute(['valoracion' => $valoracion, 'comentario' => $comentario, 'id_curso' => $id_curso, 'usuario' => $usuario]);
			if ($query->rowCount() == 0) return False;
			$this->actualizar_nota_curso($id_curso);
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Actualizar - Comentario';
			$this->debug($error,$tipo);
		}
	}

	function eliminar_comentario($id){
		try{
			$sql = "SELECT id_curso FROM cursos_comentarios WHERE id_comentario = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			if ($query->rowCount() == 0) return False;
			$row = $query->fetchObject();
			$id_curso = $row->id_curso;
			// 
			$sql = "DELETE FROM cursos_comentarios WHERE id_comentario = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id]);
			// 
			if ($query->rowCount() == 0) return False;
			$this->actualizar_nota_curso($id_curso);
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Comentario';
			$this->debug($error,$tipo);
		}
	}

}

?>