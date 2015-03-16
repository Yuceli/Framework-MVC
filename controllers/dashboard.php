<?php  
/**
* 
*/
class DashBoard extends Controller
{
	
	function __construct() 

	{   
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if($logged == false){
			session_destroy();
			header('location: ../login');
			exit;
		}
	}

	function index(){
   
		$this->view->render('dashboard/index');
	}


	function logout(){
		Session::destroy();
		header('location: ../login');
		exit;
	}

	
}