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

            $data['access_level'] = $session_data['access_level'];

            $this->load->view('admin/home', $data);
        } else {
            //If no session, redirect to login page
            redirect('/login');
        }
    }

    function temp() {

        copy($_FILES['file']['tmp_name'], 'assets/css/user/content/' . $_FILES['file']['name']);

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

        $itemModel = new Item_model();
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
        $boards = $boardModel->getBoardByBoardId($borad_id);
        $data['board_id'] = $borad_id;
        $taxonomy = $item->get_taxonomy($boards['0']->parent_tags);
        $tagid = $boardModel->bord_tag($borad_id); // 
        $data['board_name'] = $boards['0']->name;
        $data['created_by'] = $boards['0']->created_by;
        $data['Taxonomy'] = $taxonomy;

        $data['tag_id'] = $tagid['0']['tag_id']; // 

        $_SESSION['child_tag'] = $this->input->post('tag');

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

        $data['Tag'] = $tag_model->tag_val($data['item']['0']['board_id']);
        echo $this->load->view('admin/item_edit', $data, TRUE);
        die;
    }

    function update_item() {

        $this->load->model('item_model');
        $error = array();
        $error_iden = TRUE;
        $item = new Item_model();

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
                }
            }
        }
        if ($error_iden) {

            unset($data['save']);
            unset($data['user_id']);
            $data['created_by'] = $session_data['id'];
            $data['createdTime'] = date('Y-m-d h:m:s');
            $data['status'] = '0';
            $tag = $_SESSION['child_tag'];
            unset($_SESSION['child_tag']);
            $item->item_insert($data, $tag);
            echo '';
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
                    chmod('assets/css/user/temp/', '0777');
                    move_uploaded_file($Storedin, 'assets/css/user/temp/' . $_FILES["img"]["name"]);
                    if (file_exists('assets/css/user/temp/' . $_FILES["img"]["name"])) {
                        list($x, $y) = getimagesize($Upload);
                        $new = imagecreatetruecolor(100, 100);
                        $newtemp = imagecreatefromjpeg($Upload);
                        imagecopyresized($new, $newtemp, 0, 0, 0, 0, 100, 100, $x, $y);
                        imagejpeg($new, 'assets/css/user/itemimage/' . $imgname);
                        unlink($Upload);
                        echo 'assets/css/user/itemimage/' . $imgname;
                    } else {
                        echo 'not uploaded';
                    }
                } else {
                    echo "";
                }
            }
        } else {
            echo "";
        }
        die;
    }

    function childtag() {
        $this->load->model('tag_model');
        $tag_model = new Tag_model();
        $id = $this->input->post('id');
        $data['tag'] = $tag_model->tag_val($id);
        echo json_encode($data);
        die;
    }

}

?>
