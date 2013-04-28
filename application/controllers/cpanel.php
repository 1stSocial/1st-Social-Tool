<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanel extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper("url");
	}

	function index() {
		//$this->create_subdomain("greg-sub");
		//$this->create_subdomain($subdomain_name);

	}

	function create_subdomain($subdomain_name) {
		$this->cpanel_authenticate();
		return $this->xmlapi->api1_query('accountname','SubDomain','addsubdomain',array($subdomain_name,'domain.com',0,0,'/public_html/'));  
	}

        function copy_files($subdomain) {
            $location_from_root = '../../' . $subdomain;
            if (is_dir($location_from_root)) {
                shell_exec("cp -r assets/template_files/jobboard/ " . $location_from_root);
            } else {
                echo "Subdomain doesn't exist!";
            }

        }

	function create_database($db_name) {
		$this->cpanel_authenticate();
		$api_query = $this->xmlapi->api1_query('accountname', 'Mysql', 'adddb', array($db_name)); 
		
		//mysql_connect("firstexe_tool");

		return $api_query->data->result;
	}


	private function cpanel_authenticate() {
		$this->load->library('xmlapi', '184.172.173.27:2083');
		$this->xmlapi->password_auth('firstexe','SDCjJDAWmLow'); 
		// $this->xmlapi->set_debug(1); 
	}

	function import_db($db_name) {
		$username = "firstexe";
		$password = "SDCjJDAWmLow";
		$hostname = "localhost"; 

		$dbhandle = mysql_connect($hostname, $username, $password) 
		  or die("Unable to connect to MySQL");
                
                mysql_select_db($db_name);
                
                $result = mysql_list_tables($db_name);
                
                if (!mysql_fetch_row($result)) {
                    $sql = explode(";",file_get_contents(base_url() . "assets/template_files/wordpress_template.sql"));//
                    foreach($sql as $query) {
                        mysql_query($query, $dbhandle);
                        mysql_error($dbhandle);
                    }
                } else {
                    echo "Db not empty!";
                }

	}

}