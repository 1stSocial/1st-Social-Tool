<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Home extends CI_Controller {
 
    function __construct() { 
        parent::__construct();
        $this->load->view('header');
        if($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            //Render Settings
            $data['settings'] = $session_data['access_level'] == 'super-admin' || $session_data['access_level'] == 'admin' ? "<a href='" . base_url() . "index.php/settings'><i class='icon-wrench icon-white'></i></a>" : false;

            $data['access_level'] = $session_data['access_level'];

            $this->load->view('admin/home', $data);
        } else {
            //If no session, redirect to login page
            redirect('/login');
        } 
    }

    function index($option = FALSE) {
        $viewData = array();
        $this->load->model('board_model');
        $this->load->helper('form');
        $this->load->model('tag_model');

        $boardModel = new Board_model();
        $session_data = $this->session->userdata('logged_in');
        $boards = $boardModel->getBoards($session_data['id']);
        $viewData['boards'] = $boards;
        $viewData['option'] = $option;

        $obj = new Tag_model();

        $viewData['parenTag'] = $obj->AllParentTags();


        $this->load->view('admin/index', $viewData);
 
        $this->load->view('footer');
    }

    function taxoval() {
        $this->load->model('taxonomy_model');
        $taxo_model = new Taxonomy_model;

        $id = implode(',',$this->input->post('tag_id')) ;
        $res = $taxo_model->get_int_taxo($id);

//        var_dump($res);die;
        $send = json_encode($res);
        echo $send;
        die;
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
        $this->load->model('adduser');
        $this->load->model('domain_model');
        
        $this->load->helper('form');

         $session_data = $this->session->userdata('logged_in');
        
        // get all parent tag
        $tagModel = new Tag_model();
        $parentTags = $tagModel->root_parent();

        //get all partners 
        $userModel = new User_model();
        $partners = $userModel->getAllPartners();
        //get all theme.
        $setting_model = new Setting_model();
        $Theme = $setting_model->theme_name();
        
        $user_model = new adduser();
        $domain_model = new domain_model();
        if($session_data['access_level'] == 'admin')
        {
            $domain = $user_model->domain();
        }
        else
        {
            $domain = $domain_model->user_domain($session_data['id']);
        }
        
        
        $viewData = array('parenTag' => $parentTags, 'partners' => $partners, 'theme' => $Theme,'domain' => $domain);

        if ($this->input->post()) {

           
            $data = $this->input->post();
            $domain_id = $data['domain'];
            unset($data['save']);
            unset($data['user_id']);
            $data['createdBy'] = $session_data['id'];
            $data['createdTime'] = date('Y-m-d h:m:s');
            $val['taxo'] = $data['filterable_taxo'];
            $val['title'] = $data['title'];
            $val['call_to_action'] = $data['call_to_action'];
            
            $img = $data['image'];

            // save board information 
            $boardModel = new Board_model($data);
            $boardId = $boardModel->saveBoard($val,$img);
            if (is_numeric($boardId)) { 
                // save user information 
                $domian_data = array('board_id' => $boardId, 'domain_id' => $domain_id);
                $domain_model->save_domain_board($domian_data);
                
                $tagmod = new Tag_model();
                $data['tagId'] = $tagmod->AllchildTagsid($data['parentTag']);
                // save tags information
              
                
                $boardTagModel = new Board_tag_model(array('boardId' => $boardId, 'tagId' => $data['parentTag']));
                $boardTagModel->save_board_tag($data['parentTag']);

                $boardModel->set_theme(array('board_id' => $boardId, 'theme_id' => $data['theme_id']));

                $viewData['success'] = 'Board successfully created';
                echo '';
                die;
            }
        }
        echo $this->load->view('admin/create_board', $viewData, TRUE);
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
        $this->load->model('adduser');
        $this->load->model('domain_model');
        
        $session_data = $this->session->userdata('logged_in');
        $boardId = $this->input->post('bid');

        $viewData = array();
        $viewData['id'] = $boardId;
        $boardModel = new Board_model();
        if (is_numeric($boardId) && !empty($boardId)) {
            //get board details
            $boardData = $boardModel->getBoardByBoardId($boardId);
            
          
            
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
            $selectedChildTag = $boardTagModel->getChildTagByBoard_arr($boardId);
            $viewData['selectedChildTag'] = $selectedChildTag;

            //get all partners 
//            $userModel = new User_model();
//            $partners = $userModel->getAllPartners();
//            $viewData['partners'] = $partners;

            //get domian 
             $user_model = new adduser();
             $domain_model = new domain_model();
            
             $viewData['selected_domain'] = $domain_model->board_domain($boardId);
             if($session_data['access_level'] == 'admin')
            {
                $viewData['domain'] = $user_model->domain();
            }
            else
            {
                $viewData['domain'] = $domain_model->user_domain($session_data['id']);
            }
        
            $viewData['selected_domain']= $domain_model->board_domain($boardId);
            
            $viewData['access_level'] = $session_data['access_level'];
            // get select partners 
            $boardUserModel = new Board_user_model();
            $selectPartners = $boardUserModel->getSelectedUserByBoardId($boardId);
            $viewData['selectedPartners'] = $selectPartners;

            $setting_model = new Setting_model();
            $Theme = $setting_model->theme_name();
            $viewData['theme'] = $Theme;

            
            $this->load->model('taxonomy_model');
            $taxo_model = new Taxonomy_model;

            $id = $this->input->post('tag_id');
            $viewData['taxo'] = $taxo_model->get_int_taxo($boardData[0]->parent_tags);
            
            $viewData['selected_theme'] = $boardModel->get_theme($boardId);
            
            echo $this->load->view('admin/edit_board', $viewData, TRUE);
            die;
        }
    }

    function delete_board() {
        $boardId = $this->uri->segment(4);
        $this->load->model('board_model');
        $this->load->model('Board_user_model');
        $this->load->model('board_tag_model');
         $this->load->model('domain_model');
        // delete board details
        $boardModel = new Board_model();
        $img = $boardModel->board_img($boardId);
        
        var_dump($img);
               
        $boardModel->deleteBoard($boardId);

        // delete tags of corresponding board
        $boardTagModel = new Board_tag_model();
        $boardTagModel->deleteTags($boardId);

        // delete user assigned of board 
        $boardUserModel = new Board_user_model();
        $boardUserModel->deleteTags($boardId);
        
        //delete domain relation
        $domain_model = new domain_model();
        $domain_model->delete_domain_board($boardId);
        
 
        if($img['0']['image']!="")
        {
            unlink($img['0']['image']);
        }
        redirect('/admin/home');
    }

    function child_tag_list() {
        $this->load->model('tag_model');

        if ($this->input->post()) {
            
        }
        $tagModel = new Tag_model();
        $result = $tagModel->getChildTags($_POST['parent']);
        if (is_array($result))
            foreach ($result as $val)
                echo '<option value="' . $val->id . '"selected>' . $val->name . '</option>';

        die();
    }

    function getChildTags() {

        $this->load->model('tag_model');

        if ($this->input->post()) {
            echo $_POST['parent'];
            die();
        }
    }

    function create_Tags() {
        $this->load->model('tag_model');
        $this->load->helper('form');
        $this->load->library('javascript');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        if ($this->input->post()) { {
                $data['id'] = NULL;
                $data['name'] = $this->input->post('parenttag');
                $data['parent_tag_id'] = $this->input->post('Parentid');
                
                $this->tag_model->addTag($data);
                echo '';
            }
        }
        die;
    }

    function tag_Management($val = FALSE, $val2 = FALSE) {
        $this->load->model('tag_model');
        $this->load->helper('form');
        $this->load->library('javascript');
        $this->load->library('form_validation');

        $tagModel = new Tag_model();
        $data['parentTags'] = $tagModel->AllTag();
        $obj = new Tag_model();
        $data['parenTag'] = $obj->AllTag();
		if (isset($val)) {
            $data['option'] = $val;
            $data['id1'] = $val2;
			$this->load->view('admin/TagManagement', $data);
			
        }
        else
            $this->load->view('admin/TagManagement', $data);
            $this->load->view('footer');
    }

    function delete_parenttag() {
        $this->load->model('tag_model');
        $tagModel = new Tag_model();

        $Id = $this->uri->segment(4);
        $tagModel->deleteparentTags($Id);
        redirect('/admin/home/tag_Management');
    }

    function tag() {
        $this->load->model('tag_model');
        $this->load->helper('form');

        $tagModel = new Tag_model();
        $id = $this->input->post('id');
        $data = $tagModel->id_val($id);
        $val['id'] = $data[0]->id;
        $val['name'] = $data[0]->name;
        $val['parentid'] = $tagModel->parent_tag($val['id']);


        $val['parenTag'] = $tagModel->AllParentTags();
        echo $this->load->view('admin/edit_Tag', $val, TRUE);
        die;
    }

    function update_Tag() {
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

    function update_board() {
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
    
    
    function domain_management()
    {
         $this->load->helper('form');
        $this->load->model('domain_model');
        $dom_model = new domain_model();
        
      $data['domain'] =   $dom_model->get_Domain();
        
        $this->load->view('admin/domain_management',$data);
    }
            
    function create_domin()
    {
        $this->load->helper('form');
        $this->load->model('domain_model');
        $dom_model = new domain_model();
        $data['domain'] =   $dom_model->get_Domain();
        
            if($this->input->post())
            {
                $data1['id'] = NULL;
                $data1['createdTime'] = date('Y-m-d h:m:s');
                $data1['name'] = $this->input->post('name');
                $data1['parent_tags'] = "";
                
                $val = $dom_model->create_domain($data1);
                echo $val;
                die;
            }
            else
            {
                    $this->load->view('admin/create_domain',$data);
            }
    }
    
    
    function edit_domain()
    {
        $this->load->helper('form');
        $this->load->model('domain_model');
        $dom_model = new domain_model();
        $data['domain'] =   $dom_model->get_Domain();
         
        $id = $this->uri->segment(4);
        
         if($this->input->post())
            {
                $data1['id'] = $this->input->post('id');
                $data1['name'] = $this->input->post('name');
                
                
                $val = $dom_model->update_domain($data1);
                echo $val;
                die;
            }
            else
            {
                $data['value'] =  $dom_model->edit_domain($id);
                $this->load->view('admin/edit_domain',$data);
            }
    }
    
    function delete_domain()
    {
        $id = $this->uri->segment(4);
        
        $this->load->model('domain_model');
        $dom_model = new domain_model();
        $dom_model->delete_domain($id);
        $this->domain_management();
    }
    
    
    function  get_domain()
    {
        $id = $this->input->post('id');
         $this->load->model('domain_model');
        $dom_model = new domain_model();
        $val = $dom_model->user_domain($id);
        echo $val;
        die;
    }
    
    
    function logo_image()
    {
        $imgname = "upload" . time() . ".jpg";

        if (isset($_FILES["img"])) {

            if ($_FILES["img"]["error"] > 0) {
              
                   echo '';
                
                die;
            } else {
                $Upload = 'assets/css/user/temp/' . $_FILES["img"]["name"];
                $Type = $_FILES["img"]["type"];
                $Storedin = $_FILES["img"]["tmp_name"];
                if ($_FILES["img"]["name"] != "") {
//                    chmod('assets/css/user/temp/', '0777');
                    move_uploaded_file($Storedin,'assets/img/internal/logo_img/'. $imgname);
                     if(isset($_POST['im']))
                    {
                         if($_POST['im'] != "")
                        unlink($this->input->post("im"));
                    }
                        echo 'assets/img/internal/logo_img/' . $imgname;
                   
                } else {
                    echo "";
                }
            }
        } else {
         
           if(isset($_POST['im']))
            {
               echo $this->input->post("im");
            }
           else
             {
               echo '';
             }
               
           
        }
        die;
    }
}

