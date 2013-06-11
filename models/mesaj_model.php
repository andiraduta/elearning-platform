<?php

class Mesaj_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function lista_mesaje($id_utilizator) {
		$sql = "SELECT id_mesaj, status, subiect, mesaj, uu.nume, uu.username 
			FROM `mesaje` m 
			INNER JOIN `utilizatori` u ON m.catre_utilizator = u.id_utilizator 
			INNER JOIN `utilizatori` uu ON m.de_la_utilizator = uu.id_utilizator
			WHERE m.catre_utilizator = ".(int) $id_utilizator."
			ORDER BY id_mesaj DESC;";
		$query = mysql_query($sql);
		$array = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$array[] = $row;
		}
		
		return $array;
	}
	
	public function detalii_mesaj($id_mesaj) {
		$sql = "SELECT id_mesaj, status, subiect, mesaj, m.data_creare, uu.nume, uu.username 
			FROM `mesaje` m 
			INNER JOIN `utilizatori` uu ON m.de_la_utilizator = uu.id_utilizator
			WHERE m.id_mesaj = ".(int) $id_mesaj." LIMIT 1;";
		$query = mysql_query($sql);
		return mysql_fetch_assoc($query);
	}
	
	public function lista_mesaje_trimise($id_utilizator) {
		$sql = "SELECT id_mesaj, status, subiect, mesaj, m.data_creare, nume, username 
			FROM `mesaje` m 
			INNER JOIN `utilizatori` u ON m.catre_utilizator = u.id_utilizator 
			WHERE m.de_la_utilizator = ".(int) $id_utilizator."
			ORDER BY id_mesaj DESC;";
		$query = mysql_query($sql);
		$array = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$array[] = $row;
		}
		
		return $array;
	}
	
	public function marcheaza_citit($id_mesaj) {
		$sql = "UPDATE mesaje SET status = 1 WHERE id_mesaj = ".(int) $id_mesaj;
		if( mysql_query($sql) ) {
			return true;
		} else {
			return false;
		}
	}
	
	public function sterge_mesaj($id_mesaj) {
		$sql = "DELETE FROM mesaje WHERE id_mesaj = ".$id_mesaj;
		if( mysql_query($sql) ) {
			return true;
		} else {
			return false;
		}
	}
	
	public function adauga_mesaj($data) {
		$insert = "INSERT INTO mesaje (id_mesaj, de_la_utilizator, catre_utilizator, subiect, mesaj, status, data_creare) VALUES (NULL, '".(int) $data['id_utilizator']."', '".(int) $data['id_destinatar']."', '".mysql_real_escape_string($data['subiect'])."', '".mysql_real_escape_string($data['mesaj'])."', 0, '".date('Y-m-d H:i:s', time())."');";
		if( mysql_query($insert) ) {
			return true;
		} else {
			return false;
		}
	} 
	
	public function cauta_destinatar($destinatar) {
		$sql = "SELECT id_utilizator, username, nume FROM utilizatori WHERE username LIKE '%".mysql_real_escape_string($destinatar)."%' OR nume LIKE '%".mysql_real_escape_string($destinatar)."%' ORDER BY nume ASC LIMIT 10;";
		$query = mysql_query($sql);
		$array = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$array[] = array('id' => $row['id_utilizator'], 'value' => $row['nume'].' ('.$row['username'].')');
		}
		
		return $array;
	}
	
}