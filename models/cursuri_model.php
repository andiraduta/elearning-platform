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
		$sql = "SELECT c . * , u.id_utilizator, u.username, u.nume, cc.titlu AS 'categorie', f.id_forum, f.nume AS 'nume_forum'
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
	
	public function discutii_forum($id_forum) {
		$sql = "SELECT fd.*, count(id_postare) as 'nr_postari' FROM forum_discutii fd LEFT JOIN forum_postari p ON fd.id_discutie = p.id_discutie  WHERE fd.id_forum = ".(int) $id_forum.' GROUP BY fd.id_discutie';
		$query = mysql_query($sql);
		$discutii = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$discutii[] = $row;
		}
		
		return $discutii;
	}
	
	public function subiect_discutie($id_subiect) {
		$sql = "SELECT * FROM forum_discutii WHERE id_discutie = ".(int) $id_subiect;
		$query = mysql_query($sql);
		return mysql_fetch_assoc($query);
	}
	
	public function postari_subiect($id_subiect) {
		$sql = "SELECT fp.*, u.id_utilizator, u.nume, u.username
			FROM forum_postari fp 
			INNER JOIN utilizatori u ON fp.id_utilizator = u.id_utilizator 
			WHERE id_discutie = ".(int) $id_subiect;
		$query = mysql_query($sql);
		
		$postari = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$postari[] = $row;
		}
		
		return $postari;
	}
	
	public function adauga_subiect_discutie($data) {
		$sql = "INSERT INTO forum_discutii (id_discutie, id_forum, id_utilizator, titlu, data_creare) VALUES (NULL, ".(int) $data['id_forum'].", ".(int) $data['id_utilizator'].", '".mysql_real_escape_string($data['titlu'])."', '".date('Y-m-d H:i:s', time())."');";
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function modifica_subiect_discutie($data) {
		$sql = "UPDATE forum_discutii SET titlu = '".mysql_real_escape_string($data['titlu'])."' WHERE id_discutie = ".(int) $data['id_subiect'];
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function sterge_subiect_discutie($id_subiect) {
		$sql = "DELETE FROM forum_discutii WHERE id_discutie = ".(int) $id_subiect;
		if( mysql_query($sql) ) {
			$sql = "DELETE FROM forum_postari WHERE id_discutie = ".(int) $id_subiect;
			mysql_query($sql);
			return true;
		} else {
			return false;
		}
	}
	
	public function adauga_postare($data) {
		$sql = "INSERT INTO forum_postari (id_postare, id_discutie, id_utilizator, mesaj, data_creare) VALUES (NULL, ".(int) $data['id_discutie'].", ".(int) $data['id_utilizator'].", '".mysql_real_escape_string($data['raspuns'])."', '".date('Y-m-d H:i:s', time())."');";
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function adauga_eveniment($data) {
		$sql = "INSERT INTO evenimente (id_eveniment, id_curs, id_utilizator, titlu, data_eveniment, data_creare) VALUES (NULL, ".(int) $data['id_curs'].", ".(int) $data['id_utilizator'].", '".mysql_real_escape_string($data['titlu'])."', '".date('Y-m-d H:i:s', strtotime($data['data_eveniment']))."', '".date('Y-m-d H:i:s', time())."');";
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function evenimente_student($id_utilizator) {
		$sql = "SELECT e.titlu, e.data_eveniment, c.titlu as 'curs' 
			FROM `evenimente` e 
			INNER JOIN cursuri c ON e.id_curs = c.id_curs 
			INNER JOIN cursuri_utilizatori cu ON c.id_curs = cu.id_curs 
			INNER JOIN utilizatori u ON cu.id_utilizator = u.id_utilizator
			WHERE cu.id_utilizator = ".(int) $id_utilizator.";";
		$query = mysql_query($sql);
		$evenimente = array();
		while($row = mysql_fetch_assoc($query)) {
			$evenimente[] = $row;
		}
		
		return $evenimente;
	}
	
}