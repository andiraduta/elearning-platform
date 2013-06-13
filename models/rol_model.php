<?php

class Rol_Model extends Model {

	protected $permisiuni;

	public function __construct() {
		parent::__construct();
		$this->permisiuni = array();
	}
	
	// returneaza un obiect rol si permisiunile asociate acestuia
	public static function iaPermisiuniRol($id_rol) {
		$rol = new Rol_Model();
		$sql = "SELECT t2.descriere_permisiune
			FROM roluri_permisiuni AS t1
			INNER JOIN permisiuni AS t2 ON t1.id_permisiune = t2.id_permisiune
			WHERE t1.id_rol = ". (int) $id_rol .";";
		$query = mysql_query($sql);

		while($row = mysql_fetch_assoc($query)) {
			$rol->permisiuni[$row["descriere_permisiune"]] = true;
		}
		return $rol;
	}

	// verifica daca permisiunea este setata
	public function arePermisiunea($permisiune) {
		return isset($this->permisiuni[$permisiune]);
	}

}