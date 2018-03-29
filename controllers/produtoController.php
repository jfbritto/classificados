<?php

class produtoController extends controller{


	public function index(){

	}

	public function abrir($id){

		$dados = array();
		$incorreto = 2;

		$a = new Anuncios();
		$u = new Usuarios();

		if (empty($id)) {
			header('location:'.BASE_URL);
			exit;
		}

		$info = $a->getAnuncio($id);

		$dados['info'] = $info;

		$this->loadTemplate('produto', $dados);

	}


}