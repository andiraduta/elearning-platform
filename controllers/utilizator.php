<?php

class Utilizator extends Controller {

	public function __construct() {
		parent::__construct();
		$this->incarcaModel('utilizator');
	}
	
	public function index() {
		redirect('index.php?url=utilizator/lista_utilizatori');
	}
	
	public function adauga() {
		$data = array();
		if( isset($_POST['salveaza']) ) {
			$validare_formular = new Validare_Formular;
			$validare_formular->set_rules('rol', 'ROL', 'trim|obligatoriu');
			$validare_formular->set_rules('email', 'EMAIL', 'trim|obligatoriu|email');
			$validare_formular->set_rules('username', 'USERNAME', 'trim|obligatoriu');
            $validare_formular->set_rules('parola', 'PAROLA', 'trim|obligatoriu');
            $validare_formular->set_rules('nume', 'PRENUME SI NUME', 'trim|obligatoriu');
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            } else {
                // salveaza datele
                $inserare = array(
                    'rol' => $_POST['rol'],
                    'email' => $_POST['email'],
                    'username' => $_POST['username'],
                    'parola' => $_POST['parola'],
                    'nume' => $_POST['nume'],
                    'telefon' => $_POST['telefon'],
                    'localitate' => $_POST['localitate'],
                    'adresa' => $_POST['adresa'],
                );
                // datele au fost introduse
                if( $this->utilizator->adauga_utilizator($inserare) ) {
                    unset($_POST);
                    $data['mesaj'] = '<div class="alert alert-success">Utilizatorul a fost adaugat! &nbsp;&nbsp;&nbsp; <a class="btn" href="'.URL.'index.php?url=utilizator">Vezi toti utilizatorii</a></div>';
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul salvarii datelor! <br />'.mysql_error().'</div>';
                }
            }
		}
		$data['roluri'] = $this->utilizator->toate_rolurile(); 
		$this->view->render('adauga_utilizator', $data, false);
	}
	
	public function modifica($id_utilizator) {
		$data = array();
		if( isset($_POST['salveaza']) ) {
			$validare_formular = new Validare_Formular;
			$validare_formular->set_rules('rol', 'ROL', 'trim|obligatoriu');
			$validare_formular->set_rules('email', 'EMAIL', 'trim|obligatoriu|email');
			$validare_formular->set_rules('username', 'USERNAME', 'trim|obligatoriu');
            $validare_formular->set_rules('nume', 'PRENUME SI NUME', 'trim|obligatoriu');
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            } else {
                // salveaza datele
                $inserare = array(
                    'id_utilizator' => $id_utilizator,
                    'rol' => $_POST['rol'],
                    'email' => $_POST['email'],
                    'username' => $_POST['username'],
                    'nume' => $_POST['nume'],
                    'telefon' => $_POST['telefon'],
                    'localitate' => $_POST['localitate'],
                    'adresa' => $_POST['adresa'],
                );
                // datele au fost introduse
                if( $this->utilizator->modifica_utilizator($inserare) ) {
                    unset($_POST);
                    $data['mesaj'] = '<div class="alert alert-success">Utilizatorul a fost modificat! &nbsp;&nbsp;&nbsp; <a class="btn" href="'.URL.'index.php?url=utilizator">Vezi toti utilizatorii</a></div>';
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul salvarii datelor! <br />'.mysql_error().'</div>';
                }
            }
		}
		$data['id_utilizator'] = $id_utilizator;
		$data['roluri'] = $this->utilizator->toate_rolurile(); 
		$data['utilizator'] = $this->utilizator->detaliiUtilizator($id_utilizator);
		$this->view->render('modifica_utilizator', $data, false);
	}
	
	public function activeaza($id_utilizator) {
		if( $this->utilizator->activeaza_utilizator($id_utilizator) ) {
			$_SESSION['mesaj'] = '<div class="alert alert-success">Utilizatorul a fost activat!</div>';
		} else {
			$_SESSION['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul efectuarii actiunii!</div>';
		}
		redirect('index.php?url=utilizator/lista_utilizatori');
	}
	
	public function dezactiveaza($id_utilizator) {
		if( $this->utilizator->dezactiveaza_utilizator($id_utilizator) ) {
			$_SESSION['mesaj'] = '<div class="alert alert-success">Utilizatorul a fost dezactivat!</div>';
		} else {
			$_SESSION['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul efectuarii actiunii!</div>';
		}
		redirect('index.php?url=utilizator/lista_utilizatori');
	}
	
	public function contul_meu() {
		$data = array();
		$data['utilizator'] = $this->utilizator->detaliiUtilizator((int) $_SESSION['id_utilizator']);
		$this->view->render('contul_meu', $data, false);
	}
	
	public function lista_utilizatori() {
		$data = array();
		if( isset($_SESSION['mesaj']) ) {
			$data['mesaj'] = $_SESSION['mesaj'];
			unset($_SESSION['mesaj']);
		}
		$data['utilizatori'] = $this->utilizator->utilizatori_roluri();
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