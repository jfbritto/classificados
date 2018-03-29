<?php
require 'environment.php';

$config = array();

if (ENVIRONMENT == 'development') {
	define("BASE_URL", "http:/");
	$config['dbname'] = 'classificados';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '123456';
}else{
	define("BASE_URL", "http://localhost/aulasb7/PHP%20SUPER%20AVANÇADO/ESTRUTURA_MVC/");
	$config['dbname'] = 'classificados';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '123456';
}

global $db;

try{
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
}catch(PDOException $e){
	echo "Erro: ".$e->getMessage();
}

?>