<?php

class Controller {

	function __construct() {
		$this->view = new View();
		$this->incarcaModel('general');
		
		// verifica daca utilizatorul este logat
		//$this->incarcaModel('user');
	}
	
	public function incarcaModel($nume) {
		
		$cale = 'models/'.$nume.'_model.php';
		
		if (file_exists($cale)) {
			require 'models/'.$nume.'_model.php';
			
			$numeModel = $nume . '_Model';
			$this->$nume = new $numeModel();
		}		
	}

}