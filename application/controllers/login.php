<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();	
		$this->load->model('user_model');	
	}

	function index() {
		$tempData=array('username'=>'abc',
				          'name'  =>'test user',
				);
		$model= new User_model($tempData);
	//	echo $model->getUsername();		
		
		$this->load->view('header');
		$this->load->helper(array('form'));
		$this->load->view('login');
     	$this->load->view('footer');
	}

}



