<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}

	function create_theme() {
	    $path = base_url() . "assets/path";

	    if(!is_dir($path)) {
	      mkdir($path,0755,TRUE);
	    } else {
	    	die($path);
	    }

	}



}

?>