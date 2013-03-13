<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('file');
	}

	function index() {
		
	}

	private function create_theme($theme_name, $file_data) {

		if (!is_file('./themes/' . $theme_name)) {
			if (!write_file('./themes/' . $theme_name, $file_data)) {
	     		//File Not Written
	     		die("Theme not created");
			}	
		} else {
			//File already exists
			die("Theme already exists");
		}

	}



}

?>