<?php


class Anuncios extends model{


	public function getTotalAnuncios($filtros){

		$filtrostring = array('1=1');
		if (!empty($filtros['categoria'])) {
			$filtrostring[] = 'anuncios.id_categoria = :id_categoria';
		}
		if (!empty($filtros['preco'])) {
			$filtrostring[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
		}
		if (!empty($filtros['estado'])) {
			$filtrostring[] = 'anuncios.estado = :estado';
		}

		$sql = $this->db->prepare("SELECT count(*) as total FROM anuncios WHERE ".implode(' AND ', $filtrostring)."");
		
		if (!empty($filtros['categoria'])) {
			$sql->bindValue(":id_categoria", $filtros['categoria']);
		}
		if (!empty($filtros['preco'])) {
			$preco = explode('-', $filtros['preco']);
			$sql->bindValue(":preco1", $preco[0]);
			$sql->bindValue(":preco2", $preco[1]);
		}
		if (!empty($filtros['estado'])) {
			$sql->bindValue(":estado", $filtros['estado']);
		}

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$anuncios = $sql->fetch();
			$total = $anuncios['total'];
			return $total; 
			exit;
		}
	}


	public function getMeusAnuncios(){
		$array = array();

		$sql = "SELECT *, (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url FROM anuncios WHERE id_usuario = :id_usuario";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_usuario", $_SESSION['clogin']);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}


	public function getUltimosAnuncios($page, $perPage, $filtros){

		$offset = ($page - 1) * $perPage;

		$array = array();

		$filtrostring = array('1=1');
		if (!empty($filtros['categoria'])) {
			$filtrostring[] = 'anuncios.id_categoria = :id_categoria';
		}
		if (!empty($filtros['preco'])) {
			$filtrostring[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
		}
		if (!empty($filtros['estado'])) {
			$filtrostring[] = 'anuncios.estado = :estado';
		}

		$sql = $this->db->prepare("SELECT *, 
			(select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url, 
			(select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria 
			FROM anuncios 
			WHERE ".implode(' AND ', $filtrostring)." ORDER BY id DESC LIMIT $offset, $perPage");
		
		if (!empty($filtros['categoria'])) {
			$sql->bindValue(":id_categoria", $filtros['categoria']);
		}
		if (!empty($filtros['preco'])) {
			$preco = explode('-', $filtros['preco']);
			$sql->bindValue(":preco1", $preco[0]);
			$sql->bindValue(":preco2", $preco[1]);
		}
		if (!empty($filtros['estado'])) {
			$sql->bindValue(":estado", $filtros['estado']);
		}

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}



	public function getAnuncio($id_anuncio){
		$array = array();

		$sql = "SELECT *, (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria, (select telefone from usuarios where usuarios.id=anuncios.id_usuario) as telefone, (select nome from usuarios where usuarios.id=anuncios.id_usuario) as nome FROM anuncios WHERE id = :id_anuncio";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_anuncio", $id_anuncio);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();

			$sql = $this->db->prepare("SELECT id, url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
			$sql->bindValue(":id_anuncio",$id_anuncio);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}

		}

		return $array;
	}

	public function addAnuncio($categoria, $titulo, $valor, $descricao, $estado){

		$sql = "INSERT INTO anuncios(id_usuario, id_categoria, titulo, descricao, valor, estado) VALUES(:id_usuario, :id_categoria, :titulo, :descricao, :valor, :estado)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_usuario", $_SESSION['clogin']);
		$sql->bindValue(":id_categoria", $categoria);
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":estado", $estado);
		$sql->execute();
	}

	public function editAnuncio($categoria, $titulo, $valor, $descricao, $estado, $fotos, $id_anuncio){

		$sql = "UPDATE anuncios SET id_categoria = :id_categoria, titulo = :titulo, descricao = :descricao, valor = :valor, estado = :estado WHERE id = :id_anuncio AND id_usuario = :id_usuario";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_categoria", $categoria);
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":estado", $estado);
		$sql->bindValue(":id_usuario", $_SESSION['clogin']);
		$sql->bindValue(":id_anuncio", $id_anuncio);
		$sql->execute();

		if (count($fotos) > 0) {
			for ($q=0; $q < count($fotos['tmp_name']); $q++) { 
				$tipo = $fotos['type'][$q];
				if (in_array($tipo, array('image/jpeg', 'image/png'))) {
					
					$tmpname = md5(time().rand(0,9999)).'.jpg';
					move_uploaded_file($fotos['tmp_name'][$q], 'assets/img/anuncios/'.$tmpname);

					list($whidth_orig, $height_orig) = getimagesize('assets/img/anuncios/'.$tmpname);
					$ratio = $whidth_orig/$height_orig;
					
					$width = 500;
					$height = 500;

					if ($width/$height > $ratio) {
						$width = $height*$ratio;
					}else{
						$height = $width/$ratio;
					}

					$img = imagecreatetruecolor($width, $height);
					if ($tipo == 'image/jpeg') {
						$orig = imagecreatefromjpeg('assets/img/anuncios/'.$tmpname);
					}elseif($tipo == 'image/png'){
						$orig = imagecreatefrompng('assets/img/anuncios/'.$tmpname);
					}

					imagecopyresampled($img, $orig, 0, 0, 0, 0, $width, $height, $whidth_orig, $height_orig);

					imagejpeg($img, 'assets/img/anuncios/'.$tmpname, 80);

					$sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio, url = :url");
					$sql->bindValue(":id_anuncio", $id_anuncio);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();

				}
			}
		}
	}

	public function excluirAnuncio($id){

		$sql = "DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_anuncio", $id);
		$sql->execute();

		$sql = "DELETE FROM anuncios WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function excluirFoto($id){

		$id_anuncio = 0;

		$sql = $this->db->prepare("SELECT id_anuncio, url FROM anuncios_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();

			unlink('assets/img/anuncios/'.$row['url']);

			$id_anuncio = $row['id_anuncio'];
		}

		$sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		return $id_anuncio;
	}





}


?>