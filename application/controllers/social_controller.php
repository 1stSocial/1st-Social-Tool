<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
	 	$couch = new CouchSimple($options);
	}

	function fb_set_user_data() {
		$me_object = $this->input->post("me_object");
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, "http://217.199.160.116:5585/facebook_app_users");
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{categoryId: 12}");
		curl_setopt($ch, CURLOPT_POST, 1);
		$tuData = curl_exec($ch); 
		curl_close($ch);
	}

	function fb_get_user_data() {
		
	}


}