<?php

class Login_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function validare_login($utilizator, $parola) {
		$sql = "SELECT u.id_utilizator, u.email, u.username, u.parola, r.id_rol, r.nume_rol
				FROM `utilizatori` u
				INNER JOIN roluri_utilizatori ru ON u.id_utilizator = ru.id_utilizator
				INNER JOIN roluri r ON ru.Id_rol = r.id_rol
				WHERE u.username = '".mysql_real_escape_string($utilizator)."' AND u.parola = '".md5($parola)."' 
				LIMIT 1;";
		$query = mysql_query($sql);
		$row = mysql_fetch_assoc($query);
		
		if(!empty($row)) {
            $_SESSION['id_utilizator'] = $row['id_utilizator'];
			$_SESSION['utilizator']    = $row['username'];
			$_SESSION['email']         = $row['email'];
			$_SESSION['rol']           = $row['nume_rol'];
			$_SESSION['id_rol']        = $row['id_rol'];
			$_SESSION['logat']         = true;
			return true;
		} else {
			return false;
		}
	}

}