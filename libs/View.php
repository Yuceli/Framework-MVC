<?php 

/**
* 
*/
class View
{
	
	function __construct()
	{
		//echo 'Esta es la vista<br/>';
	}

	public function render($name){

		require 'views/' . $name . '.php';


	}
}









