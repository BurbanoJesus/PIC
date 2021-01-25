<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/plataforma/application/database/database.php';

Class Actividad extends Db{

	function insertar($id,$id_modulo,$nombre,$descripcion,$tiempo,$tipo_actividad,$fecha){
		try{
			$sql = "INSERT INTO actividades VALUES(:id,:id_modulo,:nombre,:descripcion,:tiempo,:tipo_actividad,:fecha)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'id_modulo' => $id_modulo, 'nombre' => $nombre, 'descripcion' => $descripcion, 'tiempo' => $tiempo, 'tipo_actividad' => $tipo_actividad, 'fecha' => $fecha]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Actividad';
			$this->debug($error,$tipo);
		}
	}

	function listar($id){
		$sql = "SELECT * FROM actividades WHERE id_modulo = :id";
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

        $sql_count = "SELECT COUNT(*) AS total FROM actividades WHERE categoria like :categoria AND tipo like :tipo AND titulo like :busqueda";
        $count = $this->db->prepare($sql_count);
        $count->execute(['categoria' => $categoria, 'tipo' => $tipo, 'busqueda' => '%'.$busqueda.'%']);
        if ($query->rowCount() == 0) return False;
        $count = $count->fetch(PDO::FETCH_OBJ)->total; 
        $this->calcularPaginas($count);
		$sql = "SELECT * FROM actividades WHERE categoria like :categoria AND tipo like :tipo AND titulo like :busqueda LIMIT :since, :numero";
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
		$sql = "SELECT * FROM actividades NATURAL JOIN multimedia_actividades WHERE id_actividad = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);
		if ($query->rowCount() == 0){
			$sql = "SELECT * FROM actividades WHERE id_actividad = :id";
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

	function detalles_tiempo($id_actividad){
		$sql = "SELECT id_actividad,tiempo FROM actividades WHERE id_actividad = :id_actividad";
		$query = $this->db->prepare($sql);
		$query->execute(['id_actividad' => $id_actividad]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row;
	}


	function detalles_examen($id_actividad){
		$sql = "SELECT * FROM actividades NATURAL JOIN preguntas_examenes WHERE id_actividad = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id_actividad]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function detalles_curso($id_actividad){
		$sql = "SELECT cursos.id_curso FROM actividades JOIN modulos ON actividades.id_modulo = modulos.id_modulo JOIN cursos ON modulos.id_curso = cursos.id_curso WHERE id_actividad = :id_actividad";
		$query = $this->db->prepare($sql);
		$query->execute(['id_actividad' => $id_actividad]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row->id_curso;
	}

	function detalles_modulo($id_modulo){
		$sql = "SELECT cursos.id_curso FROM modulos JOIN cursos ON modulos.id_curso = cursos.id_curso WHERE id_modulo = :id_modulo";
		$query = $this->db->prepare($sql);
		$query->execute(['id_modulo' => $id_modulo]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row->id_curso;
	}

	function detalles_curso_modulo($id_actividad){
		$sql = "SELECT cursos.id_curso,modulos.id_modulo,tipo_actividad FROM actividades JOIN modulos ON actividades.id_modulo = modulos.id_modulo JOIN cursos ON modulos.id_curso = cursos.id_curso WHERE actividades.id_actividad = :id_actividad LIMIT 1";
		$query = $this->db->prepare($sql);
		$query->execute(['id_actividad' => $id_actividad]);
		if ($query->rowCount() == 0) return False;
		$row = $query->fetchObject();
		return $row;
	}

	function listar_preguntas($id_actividad){
		$sql = "SELECT * FROM  preguntas_examenes WHERE id_actividad = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id_actividad]);
		if ($query->rowCount() == 0) return False;
		$collect = Null;
		while($row = $query->fetchObject()){
		    $collect[] = $row;
		}
		return $collect;
	}

	function insertar_mu($id,$id_actividad,$url_host,$type){
		try{
			$sql = "INSERT INTO multimedia_actividades VALUES(:id,:id_actividad,:url_host,:type)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'id_actividad' => $id_actividad, 'url_host' => $url_host, 'type' => $type]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Actividad Multimedia';
			$this->debug($error,$tipo);
		}
	}

	function insertar_pg($id,$id_actividad,$pregunta,$respuesta,$respuesta_a,$respuesta_b,$respuesta_c){
		try{
			$sql = "INSERT INTO preguntas_examenes VALUES(:id,:id_actividad,:pregunta,:respuesta,:respuesta_a,:respuesta_b,:respuesta_c)";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id, 'id_actividad' => $id_actividad, 'pregunta' => $pregunta, 'respuesta' => $respuesta, 'respuesta_a' => $respuesta_a, 'respuesta_b' => $respuesta_b, 'respuesta_c' => $respuesta_c]);
			if ($query->rowCount() == 0) return False;
			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Insertar - Actividad preguntas examenes';
			$this->debug($error,$tipo);
		}
	}

	function eliminar($id_actividad,$tipo){
		try{
			$sql = "DELETE FROM actividades WHERE id_actividad = :id";
			$query = $this->db->prepare($sql);
			$query->execute(['id' => $id_actividad]);
			if ($query->rowCount() == 0) return False;
			//
			// if ($tipo == 'general') {
			// 	$sql_b = "DELETE FROM multimedia_actividades WHERE id_actividad = :id_actividad";
			// 	$query_b = $this->db->prepare($sql_b);
			// }else{
			// 	$sql_b = "DELETE FROM preguntas_examenes WHERE id_actividad = :id_actividad";
			// 	$query_b = $this->db->prepare($sql_b);
			// }
			// $query_b->execute(['id_actividad' => $id_actividad]);
			// if ($query->rowCount() == 0) return False;

			// $sql_c = "DELETE FROM CURSOS_PROGRESO WHERE id_actividad = :id_actividad";
			// $query_c = $this->db->prepare($sql_c);
			// $query_c->execute(['id_actividad' => $id_actividad]);

			return True;
		}catch(PDOException $e){
			$error = $e->getMessage().' -- '.$e->getCode();
			$tipo = 'Eliminar - Actividad';
			$this->debug($error,$tipo);
		}
	}

	function eliminar_archivos($id_actividad,$id_modulo,$id_curso){
		try{
			$carpeta_server = MULTIMEDIA_S."cursos/$id_curso/$id_modulo/$id_actividad/";
			$sel_archivos = MULTIMEDIA_S."cursos/$id_curso/$id_modulo/$id_actividad/*";
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
			$tipo = 'Eliminar - Carpeta Actividad';
			$this->debug($error,$tipo);
		}
	}
}

?>