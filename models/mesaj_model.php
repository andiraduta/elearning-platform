<?php

class Mesaj_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function lista_mesaje($id_utilizator) {
	
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