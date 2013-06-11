<?php

class Noutati extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
		$data = array();
		$data['noutati'] = $this->general->lista_noutati();
        $this->view->render('noutati', $data, false);
    }
	
	public function adauga() {
		$data = array();
        if( isset($_POST['salveaza']) ) {
			$validare_formular = new Validare_Formular;
			$validare_formular->set_rules('titlu', 'TITLU', 'trim|obligatoriu');
            $validare_formular->set_rules('anunt', 'ANUNT', 'trim|obligatoriu');
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            } else {
                // salveaza datele
                $inserare = array(
                    'id_utilizator' => (int) $_SESSION['id_utilizator'],
                    'titlu' => $_POST['titlu'],
                    'text' => $_POST['anunt'],
                );
                // datele au fost introduse
                if( $this->general->inserare_noutate($inserare) ) {
                    unset($_POST);
                    $data['mesaj'] = '<div class="alert alert-success">Datele au fost salvate! &nbsp;&nbsp;&nbsp; <a class="btn" href="'.URL.'index.php?url=noutati">Vezi toate noutatile</a></div>';
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul inserarii datelor! <br />'.mysql_error().'</div>';
                }
            }
		}
		$this->view->render('adauga_noutate', $data, false);
	}
    
}