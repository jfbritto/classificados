<?php

class Core{


	public function run(){


		$url = '/'; // seta barra na url
		if (isset($_GET['url'])) { //se a url for passada
			$url .= $_GET['url']; // ele concatena a url na barra
		}

		$params = array(); // inicia a variavel com um array

		if (!empty($url) && $url != '/') { //se a url não estiver vazia e não for só uma barra
			
			$url = explode('/', $url); // ele pega os parametros passados e quebra inserindo-os em um array
			array_shift($url); // apṕs isso ele elimina o primeiro registro do array que geralmente é 0

			$currentController = $url[0].'Controller'; // aqui ele seta o primeiro parametro da url na variavel $currentController
			array_shift($url); // e depois elimina o primeiro registro do array

			if (isset($url[0]) && !empty($url[0])) { // se o primeiro registro estiver setado e não estiver vazio
				$currentAction = $url[0]; // ele armazena esse registro na action que nada mais é o método dentro da classe(controller)
				array_shift($url); // e novamente elimina do array

			}else{
				$currentAction = 'index'; //se não ele coloca o index de default
			}

			if (count($url) > 0) { //se o que sobrou da url for maior que 0, ele armazena o resto na variavel params
				$params = $url; // armazenando...
			}
			

		}else{ //se a url estiver vazia ou só com uma barra, ele seta esses valores de default...
			$currentController = 'homeController';
			$currentAction = 'index';
		}


		$c = new $currentController(); // aqui ele inicia a classe que foi passada pela url que está armazenada no currentController

		call_user_func_array(array($c, $currentAction), $params); // essa funçao serve para chamar o metodo que foi passado para a nova instancia da classe passada




	}

}


?>