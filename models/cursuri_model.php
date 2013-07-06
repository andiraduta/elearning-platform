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
	
	public function sterge_curs($id_curs) {
		$sql = "DELETE FROM cursuri WHERE id_curs = ".(int) $id_curs;
		if( mysql_query($sql) ) {
			$sql = "DELETE FROM forum WHERE id_curs = ".(int) $id_curs;
			mysql_query($sql);
			$sql = "DELETE FROM cursuri_activitati WHERE id_curs = ".(int) $id_curs;
			mysql_query($sql);
			$sql = "DELETE FROM cursuri_utilizatori WHERE id_curs = ".(int) $id_curs;
			mysql_query($sql);
			$sql = "DELETE FROM evenimente WHERE id_curs = ".(int) $id_curs;
			mysql_query($sql);
			return true;
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
	
	public function lista_cursuri_profesor($id_utilizator) {
		$sql = "SELECT c.*, u.id_utilizator, u.username, u.nume, cc.titlu as 'categorie'  
			FROM cursuri c
			INNER JOIN cursuri_categorii cc ON c.id_categorie = cc.id_categorie
			INNER JOIN utilizatori u ON c.id_responsabil = u.id_utilizator 
			WHERE c.id_responsabil = ".(int) $id_utilizator." 
			ORDER BY c.titlu";
		$query = mysql_query($sql);
		$cursuri = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$cursuri[] = $row;
		}
		return $cursuri;
	}
	
	public function lista_cursuri_student($id_utilizator) {
		$sql = "SELECT c.*, u.id_utilizator, u.username, u.nume, cc.titlu as 'categorie'  
			FROM cursuri c
			INNER JOIN cursuri_categorii cc ON c.id_categorie = cc.id_categorie
			INNER JOIN cursuri_utilizatori cu ON c.id_curs = cu.id_curs 
			INNER JOIN utilizatori u ON cu.id_utilizator = u.id_utilizator 
			WHERE cu.id_utilizator = ".(int) $id_utilizator."
			ORDER BY c.titlu";
		$query = mysql_query($sql);
		$cursuri = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$cursuri[] = $row;
		}
		return $cursuri;
	}
	
	public function lista_utilizatori_curs($id_curs) {
		$sql = "SELECT u.*
			FROM cursuri_utilizatori cu 
			INNER JOIN cursuri c ON cu.id_curs = c.id_curs
			INNER JOIN utilizatori u ON cu.id_utilizator = u.id_utilizator
			WHERE c.id_curs = ".(int) $id_curs;
		$query = mysql_query($sql);
		$utilizatori = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$utilizatori[] = $row;
		}
		return $utilizatori;
	}
	
	public function student_are_acces($id_utilizator, $id_curs) {
		$sql = "SELECT id_utilizator
			FROM cursuri_utilizatori 
			WHERE id_curs = ".(int) $id_curs." AND id_utilizator = ".(int) $id_utilizator." 
			LIMIT 1";
		$query = mysql_query($sql);
		$row = mysql_fetch_assoc($query);
		if($row['id_utilizator'] > 0) {
			return true;
		} else {
			return false;
		}
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
	
	public function sterge_categorie($id_categorie) {
		$sql = "DELETE FROM cursuri_categorii WHERE id_categorie = ".(int) $id_categorie;
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function tipuri_activitati() {
		$sql = "SELECT * FROM cursuri_tipuri_activitati;";
		$query = mysql_query($sql);
		$activitati = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$activitati[] = $row;
		}
		
		return $activitati;
	}
	
	public function activitati_curs($id_curs) {
		$sql = "SELECT cta.tip_activitate, ca.id_activitate,
				cau.titlu as 'titlu_activitate_url', cau.nume_url, cau.link,
				cal.titlu as 'titlu_activitate_lectie', cal.continut,
				caf.titlu as 'titlu_activitate_fisier', caf.descriere, caf.fisier
			FROM cursuri_activitati ca 
			INNER JOIN cursuri_tipuri_activitati cta ON ca.id_tip_activitate = cta.id_tip_activitate
			LEFT JOIN cursuri_activitati_url cau ON ca.id_activitate = cau.id_activitate 
			LEFT JOIN cursuri_activitati_lectie cal ON ca.id_activitate = cal.id_activitate 
			LEFT JOIN cursuri_activitati_fisier caf ON ca.id_activitate = caf.id_activitate 
			WHERE ca.id_curs = ".(int) $id_curs."
			ORDER BY ca.id_activitate DESC";
		$query = mysql_query($sql);
		$activitati = array();
		while( $row = mysql_fetch_assoc($query) ) {
			$activitati[] = $row;
		}
		
		return $activitati;
	}
	
	public function adauga_activitate_url($data) {
		$sql = "INSERT INTO cursuri_activitati (id_activitate, id_curs, id_tip_activitate) VALUES (NULL, ".(int) $data['id_curs'].", ".(int) $data['tip_activitate'].");";
		if(mysql_query($sql)) {
			$id_activitate = mysql_insert_id();
			$sql = "INSERT INTO cursuri_activitati_url (id_activitate_url, id_activitate, titlu, nume_url, link, data_creare) VALUES (NULL, $id_activitate, '".mysql_real_escape_string($data['titlu'])."', '".mysql_real_escape_string($data['nume_url'])."', '".mysql_real_escape_string($data['url'])."', '".date('Y-m-d H:i:s', time())."');";
			mysql_query($sql);
			return true;
		} else {
			return false;
		}
	}
	
	public function adauga_activitate_fisier($data) {
		$sql = "INSERT INTO cursuri_activitati (id_activitate, id_curs, id_tip_activitate) VALUES (NULL, ".(int) $data['id_curs'].", ".(int) $data['tip_activitate'].");";
		if(mysql_query($sql)) {
			$id_activitate = mysql_insert_id();
			$sql = "INSERT INTO cursuri_activitati_fisier (id_activitate_fisier, id_activitate, titlu, descriere, fisier, data_creare) VALUES (NULL, $id_activitate, '".mysql_real_escape_string($data['titlu'])."', '".mysql_real_escape_string($data['descriere'])."', '".mysql_real_escape_string($data['fisier'])."', '".date('Y-m-d H:i:s', time())."');";
			mysql_query($sql);
			return true;
		} else {
			return false;
		}
	}
	
	public function adauga_activitate_lectie($data) {
		$sql = "INSERT INTO cursuri_activitati (id_activitate, id_curs, id_tip_activitate) VALUES (NULL, ".(int) $data['id_curs'].", ".(int) $data['tip_activitate'].");";
		if(mysql_query($sql)) {
			$id_activitate = mysql_insert_id();
			$sql = "INSERT INTO cursuri_activitati_lectie (id_activitate_lectie, id_activitate, titlu, continut, data_creare) VALUES (NULL, $id_activitate, '".mysql_real_escape_string($data['titlu'])."', '".mysql_real_escape_string($data['continut'])."', '".date('Y-m-d H:i:s', time())."');";
			mysql_query($sql) or die(mysql_error());
			return true;
		} else {
			return false;
		}
	}
	
	public function sterge_activitate_curs($id_activitate, $tip) {
		$sql = "DELETE FROM cursuri_activitati WHERE id_activitate = ".(int) $id_activitate;
		if(mysql_query($sql)) {
			if($tip == 'fisier') {
				$sql = "SELECT * FROM cursuri_activitati_fisier WHERE id_activitate = ".(int) $id_activitate;
				$query = mysql_query($sql);
				$row = mysql_fetch_assoc($query);
				if( $row['fisier'] != "" )
					unlink("./".$row['fisier']);
			}
			$sql = "DELETE FROM cursuri_activitati_".$tip." WHERE id_activitate = ".(int) $id_activitate;
			mysql_query($sql);
			return true;
		} else {
			return false;
		}
	}
	
	public function detalii_activitate_tip($id_activitate, $tip) {
		$sql = "SELECT * FROM cursuri_activitati_".$tip." WHERE id_activitate = ".(int) $id_activitate;
		$query = mysql_query($sql);
		return mysql_fetch_assoc($query);
	}
	
	public function modifica_activitate_lectie($data) {
		$sql = "UPDATE cursuri_activitati_lectie SET titlu = '".mysql_real_escape_string($data['titlu'])."', continut = '".mysql_real_escape_string($data['continut'])."' WHERE id_activitate = ".(int) $data['id_activitate'];
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function modifica_activitate_url($data) {
		$sql = "UPDATE cursuri_activitati_url SET titlu = '".mysql_real_escape_string($data['titlu'])."', nume_url = '".mysql_real_escape_string($data['nume_url'])."', link = '".mysql_real_escape_string($data['url'])."' WHERE id_activitate = ".(int) $data['id_activitate'];
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
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
	
	public function sterge_eveniment($id_eveniment) {
		$sql = "DELETE FROM evenimente WHERE id_eveniment = ".(int) $id_eveniment;
		if(mysql_query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function evenimente_student($id_utilizator) {
		$sql = "SELECT e.id_eveniment, e.titlu, e.data_eveniment, c.titlu as 'curs' 
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
	
	public function evenimente_profesor($id_utilizator) {
		$sql = "SELECT e.id_eveniment, e.titlu, e.data_eveniment, c.titlu as 'curs' 
			FROM `evenimente` e 
			INNER JOIN cursuri c ON e.id_curs = c.id_curs 
			INNER JOIN utilizatori u ON c.id_responsabil = u.id_utilizator
			WHERE c.id_responsabil = ".(int) $id_utilizator.";";
		$query = mysql_query($sql);
		$evenimente = array();
		while($row = mysql_fetch_assoc($query)) {
			$evenimente[] = $row;
		}
		
		return $evenimente;
	}
	
	public function adauga_utilizator_curs( $id_curs, $id_utilizator, $activ ) {
        if( $activ == 0 ) {
            $d = "DELETE FROM cursuri_utilizatori WHERE id_curs = ".(int) $id_curs." AND id_utilizator = ".(int) $id_utilizator.";";
            if( mysql_query($d) )
                return true;
            else
                return false;
        } else {
            $i = "INSERT INTO cursuri_utilizatori (id_curs_utilizator, id_curs, id_utilizator) VALUES (NULL, ".(int) $id_curs.", ".(int) $id_utilizator.");";
            if( mysql_query($i) )
                return true;
            else
                return false;
        }
    }
	
}