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
            $data['settings'] = $session_data['access_level'] == 'super-admin' || $session_data['access_level'] == 'admin' ? "<a href='" . base_url() . "index.php/settings'><i class='icon-wrench icon-white'></i></a>" : false;

            $this->load->view('admin/home', $data);
            $this->load->view('footer');
        } else {
            //If no session, redirect to login page
            redirect('/login');
        }
    }

    function index() {
        $this->load->view('admin/index');
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('/login');
    }

    /*
     * Create board
     * */

    function create_board() {

        $this->load->model('board_model');
        $this->load->model('Board_user_model');
        $this->load->model('tag_model');
        $this->load->model('user_model');
        $this->load->model('board_tag_model');
        $this->load->helper('form');
        // get all parent tag
        $tagModel= new Tag_model();
        $parentTags=$tagModel->getAllParentTags();
       // echo"<pre>";        print_r($parentTags); die;
        
       //get all partners 
        $userModel= new User_model();
        $partners=$userModel->getAllPartners();
        //echo "<pre>"; print_r($partners);
        $viewData=array('parenTag'=>$parentTags,'partners'=>$partners);



        if ($this->input->post()) {
            $session_data = $this->session->userdata('logged_in');
            $data = $this->input->post();
            $userId = $data['user_id'];
            unset($data['save']);
            unset($data['user_id']);
            $data['createdBy'] = $session_data['id'];
            $data['createdTime'] = date('Y-m-d h:m:s');

           // echo "<pre>"; print_r($data);
            // save board information 
            $boardModel = new Board_model($data);
            $boardId = $boardModel->saveBoard();          
            if (is_numeric($boardId)) {
                  // save user information 
                $boardUserModel = new Board_user_model(array('boardId' => $boardId, 'userId' => $userId));
                $boardUserModel->saveBoardUser();
                
                // save tags information
                $boardTagModel= new Board_tag_model(array('boardId' => $boardId, 'tagId' => $data['tagId']));
                $boardTagModel->saveBoardTag();
                $viewData['success']='Board successfully created';
                
            }
        }
         $this->load->view('admin/create_board',$viewData);
    }

     function getChildTags(){
           $this->load->model('tag_model');
           
           if ($this->input->post()) {
               $data= $this->input->post();               
               $tagModel= new Tag_model();
               $result=$tagModel->getChildTags($data['parentTag']);
               //echo "<pre>"; print_r($result);
               foreach($result as $val){
                   echo '<option value="'.$val->id.'">'.$val->name.'</option>';
               }
           }
        die;
     }
}

