<?php

class View {

	function __construct() {
		//echo 'this is the view';
	}

	public function render($name, $vars = array(), $noInclude = true)
	{
		if( isset($vars) && is_array($vars) && !empty($vars) ) {
			extract($vars);
		}
		
		if ($noInclude == true) {
			require 'views/' . $name . '.php';	
		}
		else {
			require 'views/header.php';
			require 'views/' . $name . '.php';
			require 'views/footer.php';	
		}
	}

}