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
            
            $data['access_level'] = $session_data['access_level'];
            
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
        $this->load->model('tag_model');
        
        $boardModel = new Board_model();
        $session_data = $this->session->userdata('logged_in');
        $boards = $boardModel->getBoards($session_data['id']);
        // echo "<pre>"; print_r($boards);
        $viewData['boards'] = $boards;
        $viewData['option'] = $option;
        
        $obj = new Tag_model();
     
        $viewData['parenTag'] = $obj->AllParentTags();
              
             
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
        $this->load->model('setting/setting_model');
        $this->load->helper('form');
        // get all parent tag
        $tagModel = new Tag_model();
        $parentTags = $tagModel->root_parent();

        //get all partners 
        $userModel = new User_model();  
        $partners = $userModel->getAllPartners();
        //get all theme.
        $setting_model = new Setting_model();
        $Theme = $setting_model->theme_name();
        $viewData = array('parenTag' => $parentTags, 'partners' => $partners,'theme'=>$Theme);

        if ($this->input->post()) {
            
            $session_data = $this->session->userdata('logged_in');
            $data = $this->input->post();
//                        print_r($data); die;
            $userId = $data['user_id'];
            unset($data['save']);
            unset($data['user_id']);
            $data['createdBy'] = $session_data['id'];
            $data['createdTime'] = date('Y-m-d h:m:s');

//             echo "<pre>"; print_r($data); die;
            // save board information 
            $boardModel = new Board_model($data);
            $boardId = $boardModel->saveBoard();
            if (is_numeric($boardId)) {
                // save user information 
                $boardUserModel = new Board_user_model(array('boardId' => $boardId, 'userId' => $userId));
                $boardUserModel->saveBoardUser();
                $tagmod = new Tag_model();
                $data['tagId'] = $tagmod->AllchildTagsid($data['parentTag']);
                // save tags information
                $boardTagModel = new Board_tag_model(array('boardId' => $boardId, 'tagId' => $data['tagId']));
                $boardTagModel->saveBoardTag();
                
                $boardModel->set_theme(array('board_id'=>$boardId,'theme_id'=>$data['theme_id']));
                
                $viewData['success'] = 'Board successfully created';
                echo '';
                die;
            }
            
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
        $this->load->model('setting/setting_model');
        $this->load->model('board_tag_model');
        $boardId = $this->input->post('bid');
        
        $viewData = array();
        $viewData['id'] = $boardId;
        $boardModel = new Board_model();
        if (is_numeric($boardId) && !empty($boardId)) {
            //get board details
            $boardData = $boardModel->getBoardByBoardId($boardId);
            // echo "<pre>"; print_r($boardData);  
            $viewData['boardData'] = $boardData;
            // get all parent tag
            $tagModel = new Tag_model();
            $parentTags = $tagModel->root_parent();
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
            
            $setting_model = new Setting_model();
            $Theme = $setting_model->theme_name();
            $viewData['theme']= $Theme;
            echo $this->load->view('admin/edit_board', $viewData,TRUE);
            die;
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
        redirect('/admin/home');
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
        
        $this->form_validation->set_rules('name','Name','trim|required');
        
        if($this->input->post())
        {
//          if($this->form_validation->run()== TRUE)
          {
           $data['id'] = NULL;   
           $data['name'] = $this->input->post('parenttag');
           $data['parent_tag_id'] = $this->input->post('Parentid');
           
//           if(!$this->tag_model->checkParentTag($data))
//           {
           $this->tag_model->addTag($data);
           echo '';
//           }
//           else
//           {
//               echo 'ParentTag all ready exist.';
//           }
          }
//          else
//          {
//              echo 'else';
////              $this->load->view('admin/create_tag');
////              $this->load->view('footer');
//          }
           
        }
//        
//        $this->load->view('admin/create_tag');
//        $this->load->view('footer');
        die;
    }
    
    function tag_Management($val=FALSE,$val2=FALSE)
    {
        $this->load->model('tag_model');
        $this->load->helper('form');
        $this->load->library('javascript');
        $this->load->library('form_validation');
        
        $tagModel = new Tag_model();
        $data['parentTags'] = $tagModel->AllTag();
       // var_dump($data);
        $obj = new Tag_model();
              $data['parenTag'] = $obj->AllParentTags();
        if(isset($val))
        {
            $data['option'] = $val;
            $data['id1'] = $val2;
            $this->load->view('admin/TagManagement',$data);
        }
        else
        $this->load->view('admin/TagManagement',$data);
        $this->load->view('footer');
        
    }
    
    function delete_parenttag()
    {
        $this->load->model('tag_model');
        $tagModel = new Tag_model();
        
        $Id = $this->uri->segment(4);
        $tagModel->deleteparentTags($Id);
        redirect('/admin/home/tag_Management');
    }
    
    function tag()
    {
        $this->load->model('tag_model');
        $this->load->helper('form');
        
        $tagModel = new Tag_model();
        $id = $this->input->post('id');
        $data = $tagModel->id_val($id);
        $val['id'] = $data[0]->id;
        $val['name'] = $data[0]->name;
//        $val['parentid'] = $data[0]->parent_tag_id;
        $val['parenTag'] = $tagModel->AllParentTags();
      //  var_dump($val); die();
        echo $this->load->view('admin/edit_Tag',$val,TRUE);
        die;
    }
    
    function update_Tag()
    {
        $this->load->model('tag_model');
        $this->load->helper('form');
        
        $tagModel = new Tag_model();
        $data['id'] = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['parent_tag_id'] = $this->input->post('pid');
        
        $tagModel->updateTag($data);
        echo "";
        die();
    }
    
    function update_board()
    {
        $this->load->model('board_model');
        $this->load->model('Board_user_model');
        $this->load->model('tag_model');
        $this->load->model('user_model');
        $this->load->model('board_tag_model');
        
        $board = new Board_model();
        $board->update();
        echo '';
        die();
    }

}

