<?php
 session_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI

class Item extends CI_Controller {

    public $abc_temp;
            
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
        } else {
            //If no session, redirect to login page
            redirect('/login');
        }
    } 
 
    function temp() 
    {
//        die;
//        chmod('assets/css/user/content/', '0777');
        copy($_FILES['file']['tmp_name'], 'assets/css/user/content/' . $_FILES['file']['name']);
        $Upload = 'assets/css/user/content/' . $_FILES["file"]["name"];
                $Storedin = $_FILES["file"]["tmp_name"];
//                      chmod('assets/css/user/temp/', '0777');
//                    move_uploaded_file($Storedin, 'assets/css/user/temp/' . $_FILES["file"]["name"]);
                    if (file_exists('assets/css/user/content/' . $_FILES["file"]["name"])) {
                        list($x, $y) = getimagesize($Upload);
                        $new = imagecreatetruecolor(100, 100);
                        $newtemp = imagecreatefromjpeg($Upload);
                        imagecopyresized($new, $newtemp, 0, 0, 0, 0, 100, 100, $x, $y);
                        imagejpeg($new, 'assets/css/user/thumbnail/' . $_FILES["file"]["name"]);
                    } else {
                        echo 'not uploaded';
                    }
                
        $array = array(
            'filelink' => base_url() . 'assets/css/user/content/' . $_FILES['file']['name'],
            'filename' => $_FILES['file']['name']
        );
        echo stripslashes(json_encode($array));
        die;
    }

    function index($option = FALSE) {
        $this->load->model('item_model');
        $this->load->helper('form');
        $session_data = $this->session->userdata('logged_in');

        $data['items'] = $this->item_model->get_item($session_data['id']);
        $this->load->view('admin/manage_item', $data);
    }

    function Add_item() {
        $this->load->helper('form');
        $this->load->model('item_model');
        $this->load->model('Tag_model');
        $this->load->model('Taxonomy_model');
        $session_data = $this->session->userdata('logged_in');
        
//        $this->item_model->change(); // for doing changes.
        
        $itemModel = new Item_model();
//        $boardModel = new Board_model();
        $boards = $itemModel->get_board($session_data['id']);

        $data['boards'] = $boards;
        $data['items'] = $this->item_model->get_item($session_data['id']);
        $this->load->view('admin/add_item', $data);
    }

    function fill_value() {
        $this->load->helper('form');
        $this->load->model('Board_model');
        $this->load->model('Tag_model');
        $this->load->model('Taxonomy_model');
        $this->load->model('item_model');

        $boardModel = new Board_model();
        $taxonomy = new Taxonomy_model();
        $item = new Item_model();
        
        $session_data = $this->session->userdata('logged_in');
        $borad_id = $this->input->post('boardval');
        $parent_id = $this->input->post('parent');
        
        
        $boards = $boardModel->getBoardByBoardId($borad_id);
        $data['board_id'] = $borad_id;
        $taxonomy = $item->get_taxonomy($parent_id);
        $tagid = $boardModel->bord_tag($borad_id); // 
        $data['board_name'] = $boards['0']->name;
        $data['created_by'] = $boards['0']->created_by;
        $data['Taxonomy'] = $taxonomy;
        
        $data['tag_id'] = $tagid['0']['tag_id']; // 
        $data['parent_tag'] =  $parent_id;
        $data['abc'] = $this->input->post('tag');
       
        $data['items'] = $this->item_model->get_item($session_data['id']);
        $this->load->view('admin/item_fill', $data);
    }

    function delete_item() {
        $this->load->model('Item_model');
        $itemid = $this->uri->segment(4);
        $item_modal = new Item_model();
        $item_modal->delete_item($itemid);
        $this->index();
    }

    function edit_item() {
        $this->load->model('Item_model');
        $this->load->model('tag_model');
        $this->load->helper('form');
     
        $tag_model = new Tag_model();

        $itemid = $this->uri->segment(4);
        $item_modal = new Item_model();

        $data['item'] = $item_modal->get_item_id($itemid);
        $data['Taxonomy'] = $item_modal->get_item_taxo($itemid);
        
        
         $data['taxonomy_val'] = $item_modal->get_taxonomy($data['item']['0']['parent_tag_id']);
        
        $data['Tag'] = $tag_model->tag_val_new($data['item']['0']['parent_tag_id']);
        $temp_data['name'] = $itemid;
        
        $data['image_div'] = $this->load->view('admin/gallary',$temp_data,TRUE);
        $this->load->view('admin/item_edit', $data);
        
    }

    function update_item() {

        $this->load->model('item_model');
        $error = array();
        $error_iden = TRUE;
        $item = new Item_model();

        $folder_name = $this->input->post('folder_name');
        $taxoarr = $this->input->post('taxo');
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $val = $item->get_type($id);

            if ($val) {
                switch ($val['0']['type']) {
                    case 'Integer': {
                            if (!$taxoarr[$id] == '') {
                                $exp = '/^[0-9]*[.]*[0-9]+$/';
                                if (!preg_match($exp, $taxoarr[$id])) {
                                    $error[] = $id . ":Please Enter Number";
                                    $error_iden = $error_iden && FALSE;
                                } else {
                                    $error[] = $id . ":";
                                    $error_iden = $error_iden && TRUE;
                                }
                            } else {
                                $error[] = $id . ":Please Enter Number";
                                $error_iden = $error_iden && FALSE;
                            }
                        }
                        break;
                    case 'String': {
                            if ($taxoarr[$id] == '') {
                                $error[] = $id . ":* please give value";
                                $error_iden = $error_iden && FALSE;
                            } else {
                                $error[] = $id . ":";
                                $error_iden = $error_iden && TRUE;
                            }
                        }
                        break;
                }
            }
        }
        if ($error_iden) {
            $this->load->model('Item_model');
            $item_model = new Item_model();
            $item_model->update_item();
            $folder_name =  md5('unique_salt' . $folder_name);
            if(is_dir('assets/css/user/content/'.$folder_name))
            rename('assets/css/user/content/'.$folder_name, 'assets/css/user/content/'.$this->input->post('id'));
//            unlink($this->input->post('unlink'));
            echo '';
            die;
        } else {
            echo json_encode($error);
            die;
        }
    } 

    function insert_item() {
        
     
        $session_data = $this->session->userdata('logged_in');
        $data['name'] = $this->input->post('name');
        $data['title'] = $this->input->post('title');
        $data['body'] = $this->input->post('body');
        $data['board_id'] = $this->input->post('board_id');
        $data['image'] = $this->input->post('image');
        
        $folder_name = $this->input->post('folder_name');
        
        $this->load->model('item_model');
        $error = array();
        $error_iden = TRUE;
        $item = new Item_model();

        $tag_id = $this->input->post('tag_id');

        $taxoarr = $this->input->post('taxo');
        $ids = $this->input->post('ids');

        foreach ($ids as $id) {

            $val = $item->get_type($id);

            if ($val) {
                switch ($val['0']['type']) {
                    case 'Integer': {
                            if (!$taxoarr[$id] == '') {
                                $exp = '/^[0-9]*[.]*[0-9]+$/';
                                if (!preg_match($exp, $taxoarr[$id])) {
                                    $error[] = $id . ":Please Enter Number";
                                    $error_iden = $error_iden && FALSE;
                                } else {
                                    $error[] = $id . ":";
                                    $error_iden = $error_iden && TRUE;
                                }
                            } else {
                                $error[] = $id . ":Please Enter Number";
                                $error_iden = $error_iden && FALSE;
                            }
                        }
                        break;
                    case 'String': {
                            if ($taxoarr[$id] == '') {
                                $error[] = $id . ":* please give value";
                                $error_iden = $error_iden && FALSE;
                            } else {
                                $error[] = $id . ":";
                                $error_iden = $error_iden && TRUE;
                            }
                        }
                        break;
                    
                    case 'html':
                    {
//                        $temp123 = trim(addslashes(htmlspecialchars(
//        html_entity_decode($taxoarr[$id], ENT_QUOTES, 'UTF-8'),
//        ENT_QUOTES, 'UTF-8'
//    )));
                        $taxoarr[$id] = htmlentities($taxoarr[$id]);
                        if ($taxoarr[$id] == '') {
                                $error[] = $id . ":* please give value";
                                $error_iden = $error_iden && FALSE;
                            } else {
                                $error[] = $id . ":";
                                $error_iden = $error_iden && TRUE;
                            }
                    }
                }
            }
        }
        if ($error_iden) {

            unset($data['save']);
            unset($data['user_id']);
            $data['created_by'] = $session_data['id'];
            $data['createdTime'] = date('Y-m-d h:m:s');
            $data['status'] = $this->input->post('status');
            $data['parent_tag_id'] = $tag_id;
            $data['call_to_action'] = $this->input->post('call_to_action');
//            var_dump($_SESSION['child_tag']);
            $tag = $this->input->post('abc');
           
            $item_id = $item->item_insert($data, $tag);
             echo '';
            $folder_name =  md5('unique_salt' . $folder_name);
            if(is_dir('assets/css/user/content/'.$folder_name))
            rename('assets/css/user/content/'.$folder_name, 'assets/css/user/content/'.$item_id);
           
//             unset($_SESSION['child_tag']);
            die;
        } else {
            echo json_encode($error);
            die;
        }
    }

    function test() {
        $imgname = "upload" . time() . ".jpg";

        if (isset($_FILES["img"])) {

            if ($_FILES["img"]["error"] > 0) {
                echo "";
                die;
            } else {
                $Upload = 'assets/css/user/temp/' . $_FILES["img"]["name"];
                $Type = $_FILES["img"]["type"];
                $Storedin = $_FILES["img"]["tmp_name"];
                if ($_FILES["img"]["name"] != "") {
                    
                    $pics = $_FILES["img"]["name"];
//                    chmod('assets/css/user/temp/', '0777');
                    move_uploaded_file($Storedin, 'assets/css/user/temp/' .$_FILES["img"]["name"]);
                    if (file_exists('assets/css/user/temp/' . $_FILES["img"]["name"])) {
                        list($x, $y) = getimagesize($Upload);
                        $new = imagecreatetruecolor(100, 100);
                        
                        if(preg_match("/.jpg/i", "$pics")){
                        $source = imagecreatefromjpeg($Upload);
                        }
                        
                        if(preg_match("/.jpeg/i", "$pics")){
                        $source = imagecreatefromjpeg($Upload);
                        }
                        if(preg_match("/.jpeg/i", "$pics")){
                        $source = Imagecreatefromjpeg($Upload);
                        }
                        if(preg_match("/.png/i", "$pics")){
                        $source = imagecreatefrompng($Upload);
                        }
                        if(preg_match("/.gif/i", "$pics")){
                        $source = imagecreatefromgif($Upload);
                        }
                        
                        
                        imagecopyresized($new, $source, 0, 0, 0, 0, 100, 100, $x, $y);
                        imagejpeg($new, 'assets/css/user/itemimage/' . $imgname);
                        unlink($Upload);
                        if(isset($_POST['imgscr']))
                        {
                            unlink($_POST['imgscr']);
                        }
                        echo 'assets/css/user/itemimage/' . $imgname;
                    } else {
                        echo 'not uploaded';
                    }
                } else {
                    echo "";
                }
            }
        } else {
           if(isset($_POST['imgscr']))
            {
               echo $this->input->post("imgscr");
            }
           else
             {
               echo '';
             }
               
           
        }
        die;
    }

    function childtag() {
        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $id = $this->input->post('id');
        $data['tag'] = $tag_model->tag_val_new($id);
        echo json_encode($data);
        die;
    }
    
    function uploadify()
    {
        $targetFolder = '/uploads'; // Relative to the root
        
            
//        $verifyToken = md5('unique_salt' . $_POST['timestamp']);

//        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
                $tempFile = $_FILES['Filedata']['tmp_name'];
                $targetPath = $_SERVER['DOCUMENT_ROOT'] ;
                $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
                
                // Validate the file type
                $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
                $fileParts = pathinfo($_FILES['Filedata']['name']);

                if (in_array($fileParts['extension'],$fileTypes)) {
                        move_uploaded_file($tempFile,$targetFile);
                        echo '1';
                } else {
                        echo 'Invalid file type.';
                }
//        }
//        if(isset($_POST['id']))
//        {
//             $tempFile = $_FILES['Filedata']['tmp_name'];
//                $targetPath = $_SERVER['DOCUMENT_ROOT'] ;
//                var_dump($targetPath);die;
//                $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
//
//                // Validate the file type
//                $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
//                $fileParts = pathinfo($_FILES['Filedata']['name']);
//
//                if (in_array($fileParts['extension'],$fileTypes)) {
//                        move_uploaded_file($tempFile,$targetFile);
//                        echo '1';
//                } else {
//                        echo 'Invalid file type.';
//                }
//        }
//        
    }
    
    function gallery()
    {
        if($this->input->post('name') != "")
        {
         $data['name'] = $this->input->post('name');
            $data['name'] = md5('unique_salt' . $data['name']);
        }
        if($this->input->post('id') !="")
        {
            $data['name'] = $this->input->post('id');
//            $data['name'] = md5('unique_salt' . $data['name']);
        }
         echo  $this->load->view('admin/gallary',$data,TRUE);
         die;
    }
    function delete_image()
    {
        $name = $this->uri->segment(4);
        $folder = $this->uri->segment(5);
        unlink('assets/css/user/content/'.$folder.'/'.$name);
        echo "";
        die;
    }
    
    function parenttag()
    {
          $this->load->helper('form');
         $this->load->model('tag_model');
        $id = $this->input->post('id');
        $val =  $this->tag_model->get_board_tag($id);
       echo form_dropdown('parent', $val,'','id = parent_id  onchange="change_val()" class=chosen-select');
        die;
    }
}

?>
