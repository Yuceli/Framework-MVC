<?php 
/**
* 
*/
class Index extends Controller
{
	
	function __construct()
	{   
		parent::__construct();
		
		
	}

	function index(){
        echo 'Inside index index';
		$this->view->render('index/index');
	}

	function details(){
        
		$this->view->render('index/index');
	}
}







 ?>