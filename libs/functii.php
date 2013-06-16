<?php

function este_logat() {
	return isset($_SESSION['logat']) && $_SESSION['logat'] == true;
}

function are_rol($rol) {
	return este_logat() && strtolower($_SESSION['rol']) == $rol;
}

function redirect($url) {
	header("Location: $url");
	exit();
}

function nr_mesaje_necitite( $id_utilizator ) {
	$sql = "SELECT count(id_mesaj) as 'nr' FROM mesaje WHERE status = 0 AND catre_utilizator = ".(int) $id_utilizator;
	$query = mysql_query($sql);
	$res = mysql_fetch_assoc($query);
	return $res['nr'];
}

function cursuri_adaugate_recent() {
	$sql = "SELECT c.*, u.id_utilizator, u.username, u.nume, cc.titlu as 'categorie'  
		FROM cursuri c
		INNER JOIN cursuri_categorii cc ON c.id_categorie = cc.id_categorie
		INNER JOIN utilizatori u ON c.id_responsabil = u.id_utilizator 
		ORDER BY c.id_curs DESC
		LIMIT 4";
	$query = mysql_query($sql);
	$cursuri = array();
	while($row = mysql_fetch_assoc($query)) {
		$cursuri[] = $row;
	}
	return $cursuri;
}