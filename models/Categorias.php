<?php


class Categorias extends model{


	public function getCategorias(){

		$array = array();

		$sql = "SELECT * FROM categorias";
		$sql = $this->db->prepare($sql);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}





}


?>