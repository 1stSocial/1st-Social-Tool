<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}

	function create_theme() {
		 fopen(base_url() . 'themes/something.css', 'w') or die("can't open file");
	}



}

?>