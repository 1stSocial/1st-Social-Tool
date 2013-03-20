<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class Upload_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index() {
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function upload_image() {
		// $file_name = $this->input->post("board_name");
		if ($file_name == "") {
			$file_name = $_FILES["files"]["name"][0];
		}


		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$extension = end(explode(".", $_FILES["files"]["name"][0]));
		if ((($_FILES["files"]["type"][0] == "image/gif")
		|| ($_FILES["files"]["type"][0] == "image/jpeg")
		|| ($_FILES["files"]["type"][0] == "image/jpg")
		|| ($_FILES["files"]["type"][0] == "image/png"))
		&& ($_FILES["files"]["size"][0] < 200000)
		&& in_array($extension, $allowedExts)) {
			if ($_FILES["files"]["error"][0] > 0) {
				var_dump($_FILES["files"]["error"]);
			} else {
	 			move_uploaded_file($_FILES["files"]["tmp_name"][0],
	  			"themes/board_styling/client_images/" . $file_name);
		    }
	  	} else {
		  echo "Invalid file";
	  	}
	}
}
		