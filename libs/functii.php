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