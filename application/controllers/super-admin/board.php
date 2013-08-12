<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board extends CI_Controller {

    function __construct()
    {
        parent::__construct(); 
        if(!$this->session->userdata('logged_in')){
        	redirect('/login');
        }
        
    }

    function index()    {
    	echo CI_VERSION;
    }
    
    function new_board(){
    	
    }
}