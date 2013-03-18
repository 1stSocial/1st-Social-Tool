<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function fb_set_user_data() {
		$me_object = $this->input->post("me_object");
		var_dump($me_object);
	}

	function fb_get_user_data() {
		
	}


}