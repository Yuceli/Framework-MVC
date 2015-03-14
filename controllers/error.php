<?php


/**
 * 
 */
 class Error extends Controller
 {
 	
 	function __construct()
 	{   
 		parent::__construct();
 		echo 'Este es un error';
        
        $this->view->msg = 'Esta pagina no existe';
 		$this->view->render('error/index');
 	}
 } 











