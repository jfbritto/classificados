<?php


class Usuarios extends model{


	public function getTotalUsuarios(){

		$sql = $this->db->query("SELECT count(*) as total FROM usuarios");

		if ($sql->rowCount() > 0) {
			$usu = $sql->fetch();
			$total = $usu['total'];
			return $total; 
			exit;
		}
	}


	public function cadastrar($nome, $email, $senha, $telefone){

		$sql = "SELECT * FROM usuarios WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();

		if ($sql->rowCOunt() == 0) {

			$sql = "INSERT INTO usuarios(nome, email, senha, telefone) VALUES(:nome, :email, :senha, :telefone)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", $senha);
			$sql->bindValue(":telefone", $telefone);
			$sql->execute();
			return true;
		}else{
			return false;

		}
	}

	public function logar($email, $senha){

		$sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", $senha);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$usu = $sql->fetch();

			$_SESSION['clogin'] = $usu['id']; 
			return true;
		}else{
			return false;
		}
	}

	public function nomeUsu($id){

		$sql = "SELECT nome FROM usuarios WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$usu = $sql->fetch();
			$nome = $usu['nome'];
		}else{
			$nome = '';
		}

		return $nome;
	}




}


?>