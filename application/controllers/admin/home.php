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
            //$this->load->view('footer');
        } else {
            //If no session, redirect to login page
            redirect('/login');
        }
    }

    function index($option=FALSE) {
        $viewData = array();
        $this->load->model('board_model');
        $this->load->helper('form');
        
        $boardModel = new Board_model();
        $session_data = $this->session->userdata('logged_in');
        $boards = $boardModel->getBoards($session_data['id']);
        // echo "<pre>"; print_r($boards);
        $viewData['boards'] = $boards;
        $viewData['option'] = $option;
        $this->load->view('admin/index', $viewData);
       
        $this->load->view('footer');
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
        $tagModel = new Tag_model();
        $parentTags = $tagModel->getAllParentTags();
        // echo"<pre>";        print_r($parentTags); die;
        //get all partners 
        $userModel = new User_model();
        $partners = $userModel->getAllPartners();
        //echo "<pre>"; print_r($partners);
        $viewData = array('parenTag' => $parentTags, 'partners' => $partners);

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
                $boardTagModel = new Board_tag_model(array('boardId' => $boardId, 'tagId' => $data['tagId']));
                $boardTagModel->saveBoardTag();
                $viewData['success'] = 'Board successfully created';
            }
            redirect('/admin/home/index');
        }
       echo $this->load->view('admin/create_board', $viewData , TRUE);
       die();
    }

    function edit_board() {
        $this->load->helper('form');
        $this->load->model('board_model');
        $this->load->model('Board_user_model');
        $this->load->model('tag_model');
        $this->load->model('user_model');
        $this->load->model('board_tag_model');
        $boardId = $this->uri->segment(4);
        $viewData = array();
        $boardModel = new Board_model();
        if (is_numeric($boardId) && !empty($boardId)) {
            //get board details
            $boardData = $boardModel->getBoardByBoardId($boardId);
            // echo "<pre>"; print_r($boardData);  
            $viewData['boardData'] = $boardData;
            // get all parent tag
            $tagModel = new Tag_model();
            $parentTags = $tagModel->getAllParentTags();
            $viewData['parenTag'] = $parentTags;
            // get all child tag
            $childTag = $tagModel->getChildTags($boardData[0]->parent_tags);
            $viewData['childTags'] = $childTag;

            //get selected child tag
            $boardTagModel = new Board_tag_model();
            $selectedChildTag = $boardTagModel->getChildTagByBoard($boardId);
            // echo "<pre>"; print_r($selectedChildTag);
            $viewData['selectedChildTag'] = $selectedChildTag;

            //get all partners 
            $userModel = new User_model();
            $partners = $userModel->getAllPartners();
            //echo "<pre>"; print_r($partners);  
            $viewData['partners'] = $partners;

            // get select partners 
            $boardUserModel = new Board_user_model();
            $selectPartners = $boardUserModel->getSelectedUserByBoardId($boardId);
            // echo "<pre>"; print_r($selectPartners);
            $viewData['selectedPartners'] = $selectPartners;


            $this->load->view('admin/edit_board', $viewData);
        }
    }

    function delete_board() {
        $boardId = $this->uri->segment(4);
        $this->load->model('board_model');
        $this->load->model('Board_user_model'); 
        $this->load->model('board_tag_model');
        // delete board details
        $boardModel = new Board_model();
        $boardModel->deleteBoard($boardId);

        // delete tags of corresponding board
        $boardTagModel = new Board_tag_model();
        $boardTagModel->deleteTags($boardId);

        // delete user assigned of board 
        $boardUserModel = new Board_user_model();
        $boardUserModel->deleteTags($boardId);
        redirect('/admin/home/index');
    }

    
    function child_tag_list()
    {
       $this->load->model('tag_model');
 
        if ($this->input->post()) {
       //     echo $_POST['parent'];
        }
          $tagModel = new Tag_model();
            $result = $tagModel->getChildTags($_POST['parent']);
            //echo "<pre>"; print_r($result);
            if(is_array($result))
            foreach ($result as $val) 
                echo '<option value="' . $val->id . '"selected>' . $val->name . '</option>';
                
            die();
            
    }
    
    function getChildTags() {
    
        $this->load->model('tag_model');

        if ($this->input->post()) {
            echo $_POST['parent'];
            die();
//            $tagModel = new Tag_model();
//            $result = $tagModel->getChildTags($data['parentTag']);
//            //echo "<pre>"; print_r($result);
//            foreach ($result as $val) {
//                echo '<option value="' . $val->id . '"selected>' . $val->name . '</option>';
                
                
            }
        
        
    }
    
    function create_Tags()
    {
        $this->load->model('tag_model');
        $this->load->helper('form');
        $this->load->library('javascript');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('parenttag','ParentTag','trim|required|xss_clean');
        
        if($this->input->post())
        {
          if($this->form_validation->run()== TRUE)
          {
           $data['parenttag'] = $_POST['parenttag'];
           $val = $_POST['child'];
           $data['childtag'] = explode(',',$val);
           if(!$this->tag_model->checkParentTag($data))
           {
           $data['parentid'] = $this->tag_model->addParentTag($data);
           $this->tag_model->addchildTag($data);
            echo '';
           }
           else
           {
               echo 'ParentTag all ready exist.';
           }
          }
          else
          {
              $this->load->view('admin/create_tag');
              $this->load->view('footer');
          }
           die();
        }
        
        $this->load->view('admin/create_tag');
        $this->load->view('footer');
    }

}

