<?php

class Cursuri extends Controller {

	public function __construct() {
		parent::__construct();
		$this->incarcaModel('cursuri');
	}
	
	public function index() {
		$data = array();
		
		$this->view->render('cursuri', $data, false);
	}
	
	public function cursurile_mele() {
		$data = array();
		if(are_rol('administrator')) {
			$data['cursuri'] = $this->cursuri->lista_cursuri_administrare();
		} else {
			$data['cursuri'] = $this->cursuri->lista_cursuri_utilizator((int) $_SESSION['id_utilizator']);
		}
		$this->view->render('cursurile_mele', $data, false);
	}
	
	public function curs($id_curs) {
		$data = array();
		$data['detalii_curs'] = $this->cursuri->detalii_curs($id_curs);
		$this->view->render('curs', $data, false);
	}
	
	public function categorii() {
		$data = array();
		$data['categorii_cursuri'] = $this->cursuri->categorii_format_tree();
		$this->view->render('categorii_cursuri', $data, false);
	}
	
	public function adauga_categorie() {
		$data = array();
		if( isset($_POST['salveaza']) ) {
			$validare_formular = new Validare_Formular;
			$validare_formular->set_rules('titlu', 'TITLU', 'trim|obligatoriu');
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            } else {
                // salveaza datele
                $inserare = array(
                    'id_parinte' => $_POST['parinte'],
                    'titlu' => $_POST['titlu'],
                    'descriere' => $_POST['descriere'],
                );
                // datele au fost introduse
                if( $this->cursuri->adauga_categorie($inserare) ) {
                    unset($_POST);
                    $data['mesaj'] = '<div class="alert alert-success">Categoria a fost adaugata! &nbsp;&nbsp;&nbsp; <a class="btn" href="'.URL.'index.php?url=cursuri/categorii">Inapoi la categorii</a></div>';
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul salvarii datelor! <br />'.mysql_error().'</div>';
                }
            }
		}
		$data['categorii_cursuri'] = $this->cursuri->categorii_format_tree();
		$this->view->render('adauga_categorie', $data, false);
	}
	
	public function modifica_categorie($id_categorie) {
		$data = array();
		if( isset($_POST['salveaza']) ) {
			$validare_formular = new Validare_Formular;
			$validare_formular->set_rules('titlu', 'TITLU', 'trim|obligatoriu');
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            } else {
                // salveaza datele
                $update = array(
                    'id_categorie' => $id_categorie,
                    'id_parinte' => $_POST['parinte'],
                    'titlu' => $_POST['titlu'],
                    'descriere' => $_POST['descriere'],
                );
                // datele au fost introduse
                if( $this->cursuri->modifica_categorie($update) ) {
                    unset($_POST);
                    $data['mesaj'] = '<div class="alert alert-success">Categoria a fost modificata! &nbsp;&nbsp;&nbsp; <a class="btn" href="'.URL.'index.php?url=cursuri/categorii">Inapoi la categorii</a></div>';
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul salvarii datelor! <br />'.mysql_error().'</div>';
                }
            }
		}
		$data['id_categorie'] = $id_categorie;
		$data['detalii_categorie'] = $this->cursuri->detalii_categorie($id_categorie);
		$data['categorii_cursuri'] = $this->cursuri->categorii_format_tree();
		$this->view->render('modifica_categorie', $data, false);
	}
	
	public function adauga_curs() {
		$data = array();
		if( isset($_POST['salveaza']) ) {
			$validare_formular = new Validare_Formular;
			$validare_formular->set_rules('profesor', 'PROFESOR', 'trim|obligatoriu');
			$validare_formular->set_rules('categorie', 'CATEGORIE', 'trim|obligatoriu');
			$validare_formular->set_rules('titlu', 'TITLU', 'trim|obligatoriu');
			$validare_formular->set_rules('data_inceput', 'DATA INCEPUT', 'trim|obligatoriu');
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            } else {
                // salveaza datele
                $insert = array(
                    'id_categorie' => $_POST['categorie'],
                    'id_responsabil' => $_POST['profesor'],
                    'titlu' => $_POST['titlu'],
                    'data_inceput' => $_POST['data_inceput'],
                    'descriere' => $_POST['descriere'],
                );
                // datele au fost introduse
                if( $id_curs = $this->cursuri->adauga_curs($insert) ) {
                    unset($_POST);
                    $data['mesaj'] = '<div class="alert alert-success">Cursul a fost adaugat! &nbsp;&nbsp;&nbsp; <a class="btn" href="'.URL.'index.php?url=cursuri/curs/'.$id_curs.'">Vezi pagina curs</a></div>';
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul salvarii datelor! <br />'.mysql_error().'</div>';
                }
            }
		}
		$this->incarcaModel('utilizator');
		$data['profesori'] = $this->utilizator->lista_profesori();
		$data['categorii_cursuri'] = $this->cursuri->categorii_format_tree();
		$this->view->render('adauga_curs', $data, false);
	}
	
	public function calendar() {
		$data = array();
		$this->view->render('calendar', $data, false);
	}

} 