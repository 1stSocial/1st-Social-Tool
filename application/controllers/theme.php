<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}

	function create_theme() {
		mkdir(base_url() . "assets/something", 0700);
		die(base_url() . "assets/something");
	}



}

?>