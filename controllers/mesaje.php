<?php

class Mesaje extends Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data = array();
		$this->view->render('mesaje', $data, false);
	}

} 