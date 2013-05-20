<?php
session_start();

require 'config/baza-de-date.php';
require 'config/constante.php';
require LIBS . 'functii.php';


// incarca clasele
function __autoload($class) {
	require LIBS . $class .".php";
}



$app = new Bootstrap();
