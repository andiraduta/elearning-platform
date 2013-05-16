<?php

class Cursuri_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function categorii_cursuri() {
		$sql = "SELECT * FROM cursuri_categorii ORDER BY titlu;";
		$query = mysql_query($sql);
		$categorii = array();
		while( $row = mysql_fetch_assoc($query) ) {
			if( $row['id_parinte'] == 0 ) {
				
			}
		}
		
		return $categorii;
	}

}