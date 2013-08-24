<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Item extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->view('header');
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            //Render Settings
            $data['settings'] = $session_data['access_level'] == 'super-admin' || $session_data['access_level'] == 'admin' ? "<a href='" . base_url() . "index.php/settings'><i class='icon-wrench icon-white'></i></a>" : false;

            $this->load->view('admin/home', $data);
            //$this->load->view('footer');
        } else {
            //If no session, redirect to login page
            redirect('/login');
        }
    }
    function index($option=FALSE)
    {
         $this->load->helper('form');
    }
    
    function Add_item()
    {
        $this->load->helper('form');
        $this->load->model('Board_model');
        $this->load->model('Tag_model');
        $this->load->model('Taxonomy_model');
        $session_data = $this->session->userdata('logged_in');
        
        $boardModel = new Board_model();
        $boards = $boardModel->getBoards($session_data['id']);
//         echo "<pre>";         var_dump($boards);
        $data['boards'] = $boards;
        
        $this->load->view('admin/add_item',$data);
        
    }
    
    function delete_item()
    {
        
    }
    
    function update_item()
    {
        
    }
}
?>
