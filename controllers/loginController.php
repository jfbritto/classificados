<?php

class loginController extends controller{


	public function index(){

		$dados = array();
		$incorreto = '';

		$u = new Usuarios();
		
		if(isset($_POST['email']) && !empty($_POST['senha'])){
			$email = addslashes($_POST['email']);
			$senha = md5(addslashes($_POST['senha']));

			if (!empty($email) && !empty($senha)) {
				if($u->logar($email, $senha)){
					header('location: '.BASE_URL);
				}else{
					$incorreto = 1;
				}

			}

		}

		$dados['incorreto'] = $incorreto;

		$this->loadTemplate('login', $dados);
	}

	public function sair(){

		unset($_SESSION['clogin']);
		header('location:'.BASE_URL);

	}

}

