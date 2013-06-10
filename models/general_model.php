<?php

class General_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function inserare_noutate($data) {
		$insert = "INSERT INTO noutati (id_noutate, id_utilizator, titlu, text, data_creare) VALUES (NULL, '".(int) $data['id_utilizator']."', '".mysql_real_escape_string($data['titlu'])."', '".mysql_real_escape_string($data['text'])."', '".date('Y-m-d H:i:s', time())."');";
		if( mysql_query($insert) ) {
			return true;
		} else {
			return false;
		}
	}
	
	public function lista_noutati() {
		$sql = "SELECT titlu, text, n.data_creare, nume, username
			FROM noutati n
			INNER JOIN utilizatori u ON n.id_utilizator = u.id_utilizator
			ORDER BY id_noutate DESC;";
		$query = mysql_query($sql);
		$array = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$array[] = $row;
		}
		
		return $array;
	}
	
}