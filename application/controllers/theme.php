<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('file');
	}

	function index() {

		$this->load->view("theme_frame");

	}

	private function create_theme($theme_name, $file_data) {

		//Create file if it doesn't exist, otherwise write to it
		if (!write_file('./themes/' . $theme_name, $file_data)) {
     		//File Not Written
     		die("Theme not created");
		}	


	}



}

?>