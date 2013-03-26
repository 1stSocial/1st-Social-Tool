<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
        $this->load->view('header');
         $session_data = $this->session->userdata('logged_in');

         $data['username'] = $session_data['username'];

         //Render Settings
         $data['settings'] = $session_data['user_level'] == 'super-admin' || $session_data['user_level'] == 'admin' ? "<a href='".base_url()."index.php/settings'><i class='icon-wrench icon-white'></i></a>" : false;

         $this->load->view('home', $data);

         $this->load->view('footer');
        }
        else
        {
         //If no session, redirect to login page
         redirect('login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');

        session_destroy();

        redirect('login', 'refresh');
    }

}
