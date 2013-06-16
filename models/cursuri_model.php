<?php

class Cursuri_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function adauga_curs($data) {
		$sql = "INSERT INTO cursuri (id_curs, id_categorie, id_responsabil, titlu, descriere, data_inceput, data_creare) VALUES (NULL, ".$data['id_categorie'].", ".$data['id_responsabil'].", '".mysql_real_escape_string($data['titlu'])."', '".mysql_real_escape_string($data['descriere'])."', '".date('Y-m-d H:i:s', strtotime($data['data_inceput']))."', '".date('Y-m-d H:i:s', time())."');";
		if(mysql_query($sql)) {
			$id_curs = mysql_insert_id();
			$sql = "INSERT INTO forum (id_forum, id_curs, nume, descriere, data_creare) VALUES (NULL, $id_curs, 'Forum discutii', '', '".date('Y-m-d H:i:s', time())."');";
			mysql_query($sql);
			return $id_curs;
		} else {
			return false;
		}
	}
	
	public function detalii_curs($id_curs) {
		$sql = "SELECT c . * , u.id_utilizator, u.username, u.nume, cc.titlu AS 'categorie', f.nume AS 'nume_forum'
			FROM cursuri c
			INNER JOIN cursuri_categorii cc ON c.id_categorie = cc.id_categorie
			INNER JOIN utilizatori u ON c.id_responsabil = u.id_utilizator
			INNER JOIN forum f ON c.id_curs = f.id_curs
			WHERE c.id_curs =".(int) $id_curs;
		$query = mysql_query($sql);
		return mysql_fetch_assoc($query);
	}
	
	public function lista_cursuri($id_categorie = "") {
		$sql = "SELECT c.*, u.id_utilizator, u.username, u.nume, cc.titlu as 'categorie'  
			FROM cursuri c
			INNER JOIN cursuri_categorii cc ON c.id_categorie = cc.id_categorie
			INNER JOIN utilizatori u ON c.id_responsabil = u.id_utilizator 
			".($id_categorie != "" ? 'WHERE c.id_categorie = '.(int) $id_categorie : '')." 
			ORDER BY c.titlu";
		$query = mysql_query($sql);
		$cursuri = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$cursuri[] = $row;
		}
		return $cursuri;
	}
	
	public function lista_cursuri_administrare() {
		$sql = "SELECT c.*, u.id_utilizator, u.username, u.nume, cc.titlu as 'categorie'  
			FROM cursuri c
			INNER JOIN cursuri_categorii cc ON c.id_categorie = cc.id_categorie
			INNER JOIN utilizatori u ON c.id_responsabil = u.id_utilizator 
			ORDER BY c.titlu";
		$query = mysql_query($sql);
		$cursuri = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$cursuri[] = $row;
		}
		return $cursuri;
	}
	
	public function lista_cursuri_utilizator() {
		$sql = "SELECT c.*, u.id_utilizator, u.username, u.nume, cc.titlu as 'categorie'  
			FROM cursuri c
			INNER JOIN cursuri_categorii cc ON c.id_categorie = cc.id_categorie
			INNER JOIN utilizatori u ON c.id_responsabil = u.id_utilizator 
			ORDER BY c.titlu";
		$query = mysql_query($sql);
		$cursuri = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$cursuri[] = $row;
		}
		return $cursuri;
	}
	
	public function categorii_cursuri() {
		$sql = "SELECT * FROM cursuri_categorii ORDER BY id_categorie;";
		$query = mysql_query($sql);
		$categorii = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$categorii[] = $row;
		}
		
		return $categorii;
	}
	
	public function categorii_format_tree() {
		$categorii = $this->categorii_cursuri();
		$tree = $this->categorii_tree($categorii);
		return $tree;
	}

	public function categorii_tree(&$categorii) {
		$map = array(
			0 => array('subcategorii' => array())
		);

		foreach ($categorii as &$categorie) {
			$categorie['subcategorii'] = array();
			$map[$categorie['id_categorie']] = &$categorie;
		}

		foreach ($categorii as &$categorie) {
			$map[$categorie['id_parinte']]['subcategorii'][] = &$categorie;
		}

		return $map[0]['subcategorii'];
	}
	
	public function adauga_categorie($data) {
		$sql = "INSERT INTO cursuri_categorii (id_categorie, id_parinte, titlu, descriere, data_creare) VALUES (NULL, ".(int) $data['id_parinte'].", '".mysql_real_escape_string($data['titlu'])."', '".mysql_real_escape_string($data['descriere'])."', '".date('Y-m-d H:i:s', time())."');";
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function modifica_categorie($data) {
		$sql = "UPDATE cursuri_categorii SET id_parinte = ".(int) $data['id_parinte'].", titlu = '".mysql_real_escape_string($data['titlu'])."', descriere = '".mysql_real_escape_string($data['descriere'])."' WHERE id_categorie = ".(int) $data['id_categorie'];
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function detalii_categorie($id_categorie) {
		$sql = "SELECT * FROM cursuri_categorii WHERE id_categorie = ". (int) $id_categorie . " LIMIT 1;";
		$query = mysql_query($sql);
		return mysql_fetch_assoc($query);
	}
	
}