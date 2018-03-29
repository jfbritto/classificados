<?php

class cadastrarController extends controller{

	public function index(){

		$dados = array();
		$alerta = '';

		$u = new Usuarios();

		if(isset($_POST['nome']) && !empty($_POST['nome'])){
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$senha = md5(addslashes($_POST['senha']));
			$telefone = addslashes($_POST['telefone']);

			if (!empty($nome) && !empty($email) && !empty($senha)) {
				if($u->cadastrar($nome, $email, $senha, $telefone)){
					$alerta = 1;
				}else{
					$alerta = 2;
				}

			}else{
				$alerta = 3;
			}	

		}

		$dados['alerta'] = $alerta;

		$this->loadTemplate('cadastrar', $dados);


	}


}