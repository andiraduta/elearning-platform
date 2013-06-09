<?php

class Noutati extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
		$data = array();
        $this->view->render('noutati', $data, false);
    }
    
}