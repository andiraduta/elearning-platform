<?php

class Utilizator extends Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		//$data = array();
		//$this->view->render('cursuri', $data, false);
	}
	
	public function contul_meu() {
		$data = array();
		$this->view->render('contul_meu', $data, false);
	}

} 