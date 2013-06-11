<?php

class Utilizator_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
    
    public function adauga_utilizator( $data ) {
        mysql_query("START TRANSACTION;");
        $insert = "INSERT INTO utilizatori (id_utilizator, email, username, parola, nume, telefon, localitate, adresa, data_creare, activ) VALUES (NULL, '".mysql_real_escape_string($data['email'])."', '".mysql_real_escape_string($data['username'])."', '".md5($data['parola'])."', '".mysql_real_escape_string($data['nume'])."', '".mysql_real_escape_string($data['telefon'])."', '".mysql_real_escape_string($data['localitate'])."', '".mysql_real_escape_string($data['adresa'])."', '".date('Y-m-d H:i:s', time())."', 1);";
        if( mysql_query($insert) ) {
            $id_utilizator = mysql_insert_id();
            $insert = "INSERT INTO roluri_utilizatori (id_utilizator, id_rol) VALUES (".(int) $id_utilizator.", ".(int) $data['rol'].");";
            if( mysql_query($insert) ) {
                mysql_query("COMMIT;");
                return true;
            } else {
                return false;
            }
        } else {
            mysql_query("ROLLBACK;");
            return false;
        }
    }
    
    public function modifica_utilizator($data) {
        $u = "UPDATE utilizatori SET email = '".$data['email']."', username = '".$data['username']."', nume = '".$data['nume']."', telefon = '".$data['telefon']."', localitate = '".$data['localitate']."', adresa = '".$data['adresa']."'  WHERE id_utilizator = ".$data['id_utilizator'].";";
        if( mysql_query($u) ) {
             $u = "UPDATE roluri_utilizatori SET id_rol = ".(int) $data['rol']." WHERE id_utilizator = ".(int) $data['id_utilizator'];
             mysql_query($u);
            return true;
        } else {
            return false;
        }
    }
	
	public function detaliiUtilizator( $id_utilizator ) {
		$sql   = "SELECT ru.id_rol, u.* FROM utilizatori u INNER JOIN roluri_utilizatori ru ON u.id_utilizator = ru.id_utilizator WHERE u.id_utilizator = " . (int) $id_utilizator . " LIMIT 1;";
		$query = mysql_query($sql);
		$detalii = mysql_fetch_assoc($query);
        return $detalii;
	}
    
    public static function nume_utilizator( $id_utilizator ) {
        $sql = "SELECT username FROM utilizatori WHERE id_utilizator = ". $id_utilizator . " LIMIT 1";
        $nume = mysql_fetch_assoc(mysql_query($sql));
        return $nume['username'];
    }
    
    public function schimba_parola( $id_utilizator, $parola ) {
        $sql = "UPDATE utilizatori SET parola = '".md5($parola)."' WHERE id_utilizator = ".(int) $id_utilizator;
        if( mysql_query($sql) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function dezactiveaza_utilizator($id_utilizator) {
        $update = "UPDATE utilizatori SET activ = 0 WHERE id_utilizator = ".$id_utilizator;
        if( mysql_query($update) )
			return true;
		else
			return false;
    }
    
    public function activeaza_utilizator($id_utilizator) {
        $update = "UPDATE utilizatori SET activ = 1 WHERE id_utilizator = ".$id_utilizator;
        if( mysql_query($update) )
			return true;
		else
			return false;
    }
    
    public function toti_utilizatorii($inceput = 0, $limita = 10) {
        $sql = "SELECT * FROM utilizatori LIMIT $inceput, $limita;";
        $query = mysql_query($sql);
        $utilizatori = array();
        while($row = mysql_fetch_assoc($query)) {
            $utilizatori[] = $row;
        }
        return $utilizatori;
    } 
    
    public function utilizatori_roluri($inceput = 0, $limita = 10) {
        $sql = "SELECT *
            FROM `utilizatori` u
            INNER JOIN `roluri_utilizatori` ru ON u.id_utilizator = ru.id_utilizator
            INNER JOIN `roluri` r ON ru.id_rol = r.id_rol 
			ORDER BY nume_rol, username
            LIMIT $inceput, $limita;";
        $query = mysql_query($sql);
        $utilizatori = array();
        while($row = mysql_fetch_assoc($query)) {
            $utilizatori[$row['id_utilizator']] = $row;
        }
        return $utilizatori;
    }
    
    public function detalii_rol($id_rol) {
        $sql = "SELECT * FROM roluri WHERE id_rol = ".(int) $id_rol." LIMIT 1;";
        $query = mysql_query($sql);
        return mysql_fetch_assoc($query);
    }
    
    public function toate_rolurile($inceput = 0, $limita = 10) {
        $sql = "SELECT * FROM roluri LIMIT $inceput, $limita;";
        $query = mysql_query($sql);
        $roluri = array();
        while($row = mysql_fetch_assoc($query)) {
            $roluri[] = $row;
        }
        return $roluri;
    }
    
    public function toate_permisiunile() {
        $sql = "SELECT * FROM permisiuni;";
        $query = mysql_query($sql);
        $permisiuni = array();
        while($row = mysql_fetch_assoc($query)) {
            $permisiuni[] = $row;
        }
        return $permisiuni;
    }
    
    public function permisiuni_rol( $id_rol ) {
        $sql = "SELECT p.id_permisiune, p.descriere_permisiune
                FROM permisiuni p
            INNER JOIN roluri_permisiuni rp ON p.id_permisiune = rp.id_permisiune
            WHERE rp.id_rol = ". $id_rol .";";
        $query = mysql_query($sql);
        $permisiuni = array();
        while($row = mysql_fetch_assoc($query)) {
            $permisiuni[$row['id_permisiune']] = $row;
        }
        return $permisiuni;
    }
    
    public function modifica_permisiune_rol( $id_rol, $id_permisiune, $activ ) {
        if( $activ == 0 ) {
            $d = "DELETE FROM roluri_permisiuni WHERE id_rol = ".(int) $id_rol." AND id_permisiune = ".(int) $id_permisiune.";";
            if( mysql_query($d) )
                return true;
            else
                return false;
        } else {
            $i = "INSERT INTO roluri_permisiuni (id_rol, id_permisiune) VALUES (".(int) $id_rol.", ".(int) $id_permisiune.");";
            if( mysql_query($i) )
                return true;
            else
                return false;
        }
    }

}