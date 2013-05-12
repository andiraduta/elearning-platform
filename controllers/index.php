<?php

class Index extends Controller {
	
    public $u;
    
	function __construct() {
		parent::__construct();        
	}
	
	function index() {
        $data = array();
		$this->view->render('index', $data);
	}
	
}