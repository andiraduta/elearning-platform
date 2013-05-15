<?php

class Login extends Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data = array();
		if( isset($_POST['login']) ) {
			if( trim($_POST['utilizator']) != "" && trim($_POST['parola']) != "" ) {
				$this->incarcaModel('login');
				if( $this->login->validare_login($_POST['utilizator'], $_POST['parola']) ) {
					// redirect in prima pagina a aplicatiei
					header("Location: " . URL . "index.php?url=index");
					exit();
				} else {
					$data['msg'] = '<div class="alert alert-error">Datele introduse nu sunt corecte!</div>';
				}
			} else {
				$data['msg'] = '<div class="alert alert-error">Va rugam sa completati toate campurile text!</div>';
			}
		}
		//print_r($data);
		$this->view->render('login', $data, false);
	}
	
	public function iesire() {
		session_destroy();
		header("Location: " . URL . "index.php?url=login");
		exit;
	}

} 