<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanel extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('file');
	}

	function index() {

		$this->create_subdomain("greg-sub");
		$this->cpanel_authenticate();

	}

	private function create_subdomain($subdomain_name) {


	}

	private function cpanel_authenticate() {
		$whmusername = "firstexe";
		$whmpassword = "SDCjJDAWmLow";

		$query = "https://gator332.hostgator.com:2083";

		$curl = curl_init();		
		# Create Curl Object
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);	
		# Allow self-signed certs
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0); 	
		# Allow certs that do not match the hostname
		curl_setopt($curl, CURLOPT_HEADER,0);			
		# Do not include header in output
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);	
		# Return contents of transfer on curl_exec
		$header[0] = "Authorization: Basic " . base64_encode($whmusername.":".$whmpassword) . "\n\r";
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);  
		# set the username and password
		curl_setopt($curl, CURLOPT_URL, $query);			
		# execute the query
		$result = curl_exec($curl);
		if ($result == false) {
		error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");	
		# log error if curl exec fails
		}
		curl_close($curl);

		print $result;
	}



}