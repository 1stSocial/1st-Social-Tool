<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->view('header');
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            //Render Settings
            $data['settings'] = $session_data['access_level'] == 'super-partner' || $session_data['access_level'] == 'partner' ? "<a href='" . base_url() . "index.php/settings'><i class='icon-wrench icon-white'></i></a>" : false;
            
            $data['access_level'] =  $session_data['access_level'];
            
            $this->load->view('admin/home', $data);
            //$this->load->view('footer');
        } else {
            //If no session, redirect to login page
            redirect('/login');
        }
    }
    
    function index()
    {
        redirect('admin/home');
    }
   
 
}

?>