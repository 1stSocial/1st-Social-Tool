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
            
            $data['access_level'] =  $session_data['access_level'];
            
            $this->load->view('admin/home', $data);
            //$this->load->view('footer');
        } 
        else 
        {
            //If no session, redirect to login page
            redirect('/login');
        }
    }
    function index($option=FALSE)
    {
        $this->load->model('item_model');
         $this->load->helper('form');
         $session_data = $this->session->userdata('logged_in');
        
         $data['items'] = $this->item_model->get_item($session_data['id']);
         $this->load->view('admin/manage_item',$data);
         
    }
    
    function Add_item()
    {
        $this->load->helper('form');
        $this->load->model('item_model');
        $this->load->model('Tag_model');
        $this->load->model('Taxonomy_model');
        $session_data = $this->session->userdata('logged_in');
        
        $itemModel = new Item_model();
        $boards = $itemModel->get_board($session_data['id']);
//         echo "<pre>";         var_dump($boards);
//         die();
         $data['boards'] = $boards;
         $data['items'] = $this->item_model->get_item($session_data['id']);
//         var_dump($data);
        $this->load->view('admin/add_item',$data);
        
    }
    
    function fill_value()
    {
        $this->load->helper('form');
        $this->load->model('Board_model');
        $this->load->model('Tag_model');
        $this->load->model('Taxonomy_model');
        $this->load->model('item_model');
        
        $boardModel = new Board_model();
        $taxonomy = new Taxonomy_model();
        $item = new Item_model();
        $session_data = $this->session->userdata('logged_in');
        $borad_id = $this->input->post('board');
        $boards = $boardModel->getBoardByBoardId($borad_id);
//        var_dump($boards);
        $taxonomy = $item->get_taxonomy($boards['0']->parent_tags);
        $tagid = $boardModel->bord_tag( $borad_id);// 
        $data['board_name'] = $boards['0']->name;
        $data['created_by'] = $boards['0']->created_by;
        $data['Taxonomy'] = $taxonomy;
        
        $data['tag_id'] = $tagid['0']['tag_id'];// 
//        var_dump($data['Taxonomy']);
//       var_dump($data);
//        die;
        
        
        $data['items'] = $this->item_model->get_item($session_data['id']);
        $this->load->view('admin/item_fill',$data);
        
        
    }
            
    function delete_item()
    {
        $this->load->model('Item_model');
        $itemid = $this->uri->segment(4);
        $item_modal = new Item_model();
        $item_modal ->delete_item($itemid);
        $this->index();
    }
    
    function edit_item()
    {
        $this->load->model('Item_model');
        $this->load->helper('form');
        
        $itemid = $this->uri->segment(4);
        $item_modal = new Item_model();
//        echo $itemid ; die;
        $data['item'] = $item_modal ->get_item_id($itemid);
        $data['Taxonomy'] = $item_modal->get_item_taxo($itemid);
//        echo "id-";        var_dump($data); die;
       echo $this->load->view('admin/item_edit',$data,TRUE);
        die;
//        var_dump($data);
    }
            
    function update_item()
    {
        
        $this->load->model('item_model');
        $error = array();
        $error_iden = TRUE;
        $item = new Item_model();
        
        $taxoarr = $this->input->post('taxo');
        foreach ($taxoarr as $taxo_id => $taxo_val) 
            {
                $val = $item->get_type($taxo_id);
                 if($val)
                 {
                     switch($val['0']['type'])
                     {
                         case 'Integer':
                         {
                            if(!$taxo_val=='')
                            {
                             $exp = '/^[0-9]*[.]*[0-9]+$/' ;
                             if(!preg_match($exp,$taxo_val))
                             {
                                 $error[] = $taxo_id.":Please Enter Number";
                                 $error_iden = $error_iden && FALSE;
                             }
                             else
                             {
                                 $error[] = $taxo_id.":";
                                 $error_iden = $error_iden && TRUE;
                             }
                            }
                            else
                            {
                                $error[] = $taxo_id.":Please Enter Number";
                                $error_iden = $error_iden && FALSE;
                            }
                         }
                             break;
                         case 'String':
                         {
                             if($taxo_val=='')
                             {
                                 $error[] = $taxo_id.":* please give value";
                                 $error_iden = $error_iden && FALSE;
                             }
                             else
                             {
                                 $error[] = $taxo_id.":";
                                 $error_iden = $error_iden && TRUE;
                             }
                         }
                             break;
                     }
                 }
            }
        if($error_iden)
        {
            $this->load->model('Item_model');
            $item_model = new Item_model();
            $item_model->update_item();
            echo '';
            die;
        }
        else
        {
            echo json_encode($error);
            die;
        }
        
    }
    
    function insert_item()
    { 
        $session_data = $this->session->userdata('logged_in');
        $data['name'] = $this->input->post('name');
        $data['title'] = $this->input->post('title');
        $data['body'] = $this->input->post('body');
        $this->load->model('item_model');
        $error = array();
        $error_iden = TRUE;
        $item = new Item_model();
        
        $tag_id = $this->input->post('tag_id');
        
        $taxoarr = $this->input->post('taxo');
        foreach ($taxoarr as $taxo_id => $taxo_val) 
            {
                $val = $item->get_type($taxo_id);
                 if($val)
                 {
                     switch($val['0']['type'])
                     {
                         case 'Integer':
                         {
                            if(!$taxo_val=='')
                            {
                             $exp = '/^[0-9]*[.]*[0-9]+$/' ;
                             if(!preg_match($exp,$taxo_val))
                             {
                                 $error[] = $taxo_id.":Please Enter Number";
                                 $error_iden = $error_iden && FALSE;
                             }
                             else
                             {
                                 $error[] = $taxo_id.":";
                                 $error_iden = $error_iden && TRUE;
                             }
                            }
                            else
                            {
                                $error[] = $taxo_id.":Please Enter Number";
                                $error_iden = $error_iden && FALSE;
                            }
                         }
                             break;
                         case 'String':
                         {
                             if($taxo_val=='')
                             {
                                 $error[] = $taxo_id.":* please give value";
                                 $error_iden = $error_iden && FALSE;
                             }
                             else
                             {
                                 $error[] = $taxo_id.":";
                                 $error_iden = $error_iden && TRUE;
                             }
                         }
                             break;
                     }
                 }
            }
        if($error_iden)
        {
//                $taxo = $this->input->post('taxo');
//                $userId = $data['user_id'];

                unset($data['save']);
                unset($data['user_id']);
                $data['created_by'] = $session_data['id'];
                $data['createdTime'] = date('Y-m-d h:m:s');
                $data['status'] = '0';
                $item->item_insert($data);
               echo '';
                die();
        }
        else
        {
            echo json_encode($error);
            die;
        }
    }
}
?>
