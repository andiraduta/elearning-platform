<?php

class Cursuri extends Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data = array();
		
		$this->view->render('cursuri', $data, false);
	}
	
	public function cursurile_mele() {
		$data = array();
		$this->view->render('cursurile_mele', $data, false);
	}
	
	public function calendar() {
		$data = array();
		$this->view->render('calendar', $data, false);
	}

} 