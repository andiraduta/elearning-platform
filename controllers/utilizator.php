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
	
	public function actualizare_cont() {
		$data = array();
		if( isset($_POST['salveaza']) ) {
			$validare_formular = new Validare_Formular;
			$validare_formular->set_rules('email', 'EMAIL', 'trim|obligatoriu|email');
            $validare_formular->set_rules('nume', 'PRENUME SI NUME', 'trim|obligatoriu');
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            } else {
                // salveaza datele
                $inserare = array(
                    'id_utilizator' => (int) $_SESSION['id_utilizator'],
                    'email' => $_POST['email'],
                    'nume' => $_POST['nume'],
                    'telefon' => $_POST['telefon'],
                    'localitate' => $_POST['localitate'],
                    'adresa' => $_POST['adresa'],
                );
                // datele au fost introduse
                if( $this->utilizator->actualizare_utilizator($inserare) ) {
                    unset($_POST);
                    $data['mesaj'] = '<div class="alert alert-success">Utilizatorul a fost modificat! &nbsp;&nbsp;&nbsp; <a class="btn" href="'.URL.'index.php?url=utilizator">Vezi toti utilizatorii</a></div>';
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul salvarii datelor! <br />'.mysql_error().'</div>';
                }
            }
		}
		$data['utilizator'] = $this->utilizator->detaliiUtilizator((int) $_SESSION['id_utilizator']);
		$this->view->render('modifica_informatii_cont', $data, false);
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
	
	public function schimba_parola() {
		$data = array();
        if( isset($_POST['salveaza']) ) {
            $validare_formular = new Validare_Formular;
            $validare_formular->set_rules('parola', 'PAROLA', 'trim|obligatoriu'); 
            $validare_formular->set_rules('confirma_parola', 'CONFIRMA PAROLA', 'trim|obligatoriu'); 
            // validare
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            //salveaza
            } else {
                if( trim($_POST['parola']) == trim($_POST['confirma_parola']) ) {
                    if( $this->utilizator->schimba_parola($_SESSION['id_utilizator'], $_POST['parola']) ) {
                        unset($_POST);
                        $data['mesaj'] = '<div class="alert alert-success">Datele au fost salvate!</div>';
                    } else {
                        $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul salvarii datelor! '.mysql_error().'</div>';
                    }
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">Campurile "Parola" si "Confirma parola" nu coincid!</div>';    
                }
            }
        }
        $data['detalii_utilizator'] = $this->utilizator->detaliiUtilizator( $_SESSION['id_utilizator'] ); 
        $this->view->render('modifica_parola', $data, false);
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
	
	public function adauga_rol() {
		$data = array();
		if( isset($_POST['salveaza']) ) {
			$validare_formular = new Validare_Formular;
			$validare_formular->set_rules('nume_rol', 'NUME ROL', 'trim|obligatoriu');
            if( $validare_formular->run() == FALSE ) {
                // eroare
                $data['mesaj'] = $validare_formular->error_string('<div class="alert alert-error">', '</div>');
            } else {
                // salveaza datele
                $inserare = array(
                    'nume_rol' => $_POST['nume_rol'],
                );
                // datele au fost introduse
                if( $this->utilizator->adauga_rol($inserare) ) {
                    unset($_POST);
                    $data['mesaj'] = '<div class="alert alert-success">Rolul a fost adaugat! &nbsp;&nbsp;&nbsp; <a class="btn" href="'.URL.'index.php?url=utilizator/permisiuni_utilizatori">Vezi toate rolurile</a></div>';
                } else {
                    $data['mesaj'] = '<div class="alert alert-error">A intervenit o eroare in momentul salvarii datelor! <br />'.mysql_error().'</div>';
                }
            }
		}
		$this->view->render('adauga_rol', $data, false);
	}
	
	public function modifica_permisiuni_rol($id_rol) {
        $data = array();
        $data['permisiuni_rol'] = $this->utilizator->permisiuni_rol($id_rol);
        $data['permisiuni']     = $this->utilizator->toate_permisiunile(); 
        $data['id_rol']         = $id_rol;
        $data['detalii_rol']    = $this->utilizator->detalii_rol($id_rol); 
        $this->view->render('modifica_permisiuni_rol', $data, false);
    }
	
	public function permisiuni_utilizatori() {
		$data = array();
        $data['roluri']     = $this->utilizator->toate_rolurile();
		$this->view->render('roluri_permisiuni', $data, false);
	}
	
	public function ajax_editeaza_permisiune_rol() {
        header('Content-Type: application/json');
        if( isset($_POST['id_rol']) && isset($_POST['id_permisiune']) ) {
            $id_rol = (int) $_POST['id_rol'];
            $id_permisiune = (int) $_POST['id_permisiune'];
            $activ = (int) $_POST['activat'];  
            if( $this->utilizator->modifica_permisiune_rol( $id_rol, $id_permisiune, $activ ) ) {
                echo json_encode(array('error' => 'false', 'mesaj' => 'ok')); 
            } else {
                echo json_encode(array('error' => 'true', 'mesaj' => 'A intervenit o eroare in momentul salvarii datelor!')); 
            }
        }
        exit();
    }

} 