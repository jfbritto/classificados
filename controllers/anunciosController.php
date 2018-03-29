<?php


class anunciosController extends controller{


	public function index(){

		$dados = array();

		$a = new Anuncios();
		$anuncios = $a->getMeusAnuncios();

		$dados['anuncios'] = $anuncios;

		$this->loadTemplate('anuncios', $dados);

	}


	public function addAnuncio(){

		$dados = array();
		$cadastrado = '';

		$c = new Categorias(); 
		$a = new Anuncios();

		if(isset($_POST['categoria']) && isset($_POST['titulo'])){
			$categoria = addslashes($_POST['categoria']);
			$titulo = ucfirst(strtolower(addslashes($_POST['titulo'])));
			$valor = addslashes($_POST['valor']);
			$valor = str_replace('.', '', $valor);
			$valor = str_replace(',', '.', $valor);
			$descricao = ucfirst(strtolower(addslashes($_POST['descricao'])));
			$estado = addslashes($_POST['estado']);

			$a->addAnuncio($categoria, $titulo, $valor, $descricao, $estado);
			$cadastrado = 1;

		}

		$categorias = $c->getCategorias();

		$dados['categorias'] = $categorias;
		$dados['cadastrado'] = $cadastrado;

		$this->loadTemplate('adicionar_anuncio', $dados);
	}

	public function edit($id){
		

		if (isset($id)) {
			$id_anuncio = $id;
		}else{
			header('location:'.BASE_URL.'anuncios');
		}

		$dados = array();
		$editado = '';

		$a = new Anuncios();
		$c = new Categorias(); 

		if(isset($_POST['categoria']) && isset($_POST['titulo'])){
			$categoria = addslashes($_POST['categoria']);
			$titulo = ucfirst(strtolower(addslashes($_POST['titulo'])));
			$valor = addslashes($_POST['valor']);
			$valor = str_replace('.', '', $valor);
			$valor = str_replace(',', '.', $valor);
			$descricao = ucfirst(strtolower(addslashes($_POST['descricao'])));
			$estado = addslashes($_POST['estado']);
			if(isset($_FILES['fotos'])){
				$fotos = $_FILES['fotos'];
			}else{
				$fotos = array();
			}

			$a->editAnuncio($categoria, $titulo, $valor, $descricao, $estado, $fotos, $id_anuncio);
			
			$editado = 1;
		}

		$categorias = $c->getCategorias();
		$anuncio = $a->getAnuncio($id_anuncio);
		
		
		$dados['categorias'] = $categorias;
		$dados['anuncio'] = $anuncio;
		$dados['editado'] = $editado;



		$this->loadTemplate('editar_anuncio', $dados);

	}

	public function excluirAnuncio($id){
		$a = new Anuncios();

		if (!empty($id)) {
			$a->excluirAnuncio($id);
			header('location:'.BASE_URL.'anuncios');
		}else{
			header('location:'.BASE_URL.'anuncios');
		}
	}

	public function excluirFoto($id){

		$dados = array();

		$a = new Anuncios();

		if (!empty($id)) {
			$id_anuncio = $a->excluirFoto($id);
		}

		if (isset($id_anuncio)) {

			header('location: '.BASE_URL.'anuncios/edit/'.$id_anuncio);
			exit;
		}else{
			header('location: '.BASE_URL.'anuncios');
		}

	}

}