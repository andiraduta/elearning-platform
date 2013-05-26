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
	
	public function lista_utilizatori() {
		$data = array();
		$this->view->render('lista_utilizatori', $data, false);
	}
	
	public function permisiuni_utilizatori() {
		$data = array();
		$this->view->render('roluri_permisiuni', $data, false);
	}
	
	public function permisiuni() {
		$data = array();
		$this->view->render('permisiuni_utilizator', $data, false);
	}

} 