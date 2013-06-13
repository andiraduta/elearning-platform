<?php

class Utilizator_Privilegiat_Model extends Model {

	private $roluri;      

	public function __construct() {
		parent::__construct();
	}
	
	public static function detaliiUtilizator($id_utilizator) {
        $sql   = "SELECT * FROM utilizatori WHERE id_utilizator = " . (int) $id_utilizator . " LIMIT 1;";
        $query = mysql_query($sql);
        $result = mysql_fetch_assoc($query);

        if (!empty($result)) {
            $utilizatorPrivilegiat = new Utilizator_Privilegiat_Model();
            $utilizatorPrivilegiat->id_utilizator = $result["id_utilizator"];
            $utilizatorPrivilegiat->utilizator    = $result["username"];
            $utilizatorPrivilegiat->parola        = $result["parola"];
            $utilizatorPrivilegiat->email         = $result["email"];
            $utilizatorPrivilegiat->initiazaRoluri();      
            return $utilizatorPrivilegiat;
        } else {
            return false;
        }
    }
    
    protected function initiazaRoluri() {
        $this->roluri = array();
        $sql = "SELECT ru.id_rol, r.nume_rol 
                FROM roluri_utilizatori as ru
                LEFT JOIN roluri as r ON ru.id_rol = r.id_rol
                WHERE ru.id_utilizator = " . $this->id_utilizator;
        $query  = mysql_query($sql);
        while($row = mysql_fetch_assoc($query)) {
            $this->roluri[$row['nume_rol']] = Rol_Model::iaPermisiuniRol($row['id_rol']);
        }
    }
    
    public function arePrivilegiu($permisiune) {
        foreach($this->roluri as $rol) {
            if( $rol->arePermisiunea($permisiune) ) {
                return true;
            }
        }
        return false;
    }
    
    public function areRol($rolul) {
        foreach($this->roluri as $rol => $permisiuni) {
            if( $rolul == $rol ) {
                return true;
            }
        }
        return false;
    }

}