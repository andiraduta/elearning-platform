<?php

class Model {

	function __construct() {
		$conexiune = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		mysql_select_db(DB_NAME, $conexiune);
	}

}