<?php

class Index extends Controller {
	
    public $u;
    
	function __construct() {
		parent::__construct();        
	}
	
	function index() {
        $data = array();
		$this->incarcaModel('cursuri');
		$data['categorii_cursuri'] = $this->cursuri->categorii_cursuri();
		$this->view->render('index', $data, false);
	}
	
}