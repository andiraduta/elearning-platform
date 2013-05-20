<?php

function este_logat() {
	return isset($_SESSION['logat']) && $_SESSION['logat'] == true;
}

function are_rol($rol) {
	return este_logat() && strtolower($_SESSION['rol']) == $rol;
}