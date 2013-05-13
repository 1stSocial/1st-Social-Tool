<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanel extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("login_model");
	}

    function index() {

   }

	function clone_board($subdomain_name) {
				$this->login_model->check_login();
                $this->change_config_settings("firstexe_" . $subdomain_name);
				$this->create_subdomain($subdomain_name); //works
                $this->create_database($subdomain_name);
                shell_exec("mysqldump -ufirstexe_wrdp4 -pKTlN0SEtWqVKGDwJ firstexe_wrdp4 > backup.sql");
                shell_exec("mysql -ufirstexe_social -p99queen -A firstexe_" . $subdomain_name . " < backup.sql");
                
                $this->update_db($subdomain_name);
                $this->copy_template($subdomain_name);

	}

	function create_subdomain($subdomain_name) {
		$this->cpanel_authenticate();
		return $this->xmlapi->api1_query('accountname','SubDomain','addsubdomain',array($subdomain_name,'domain.com',0,0,'/public_html/'. $subdomain_name));  
	}

    function get_subdomains() {
        $this->cpanel_authenticate();
        $query = $this->xmlapi->api1_query('accountname','SubDomain','cplistsubdomains');
        echo json_encode(array("subdomains"=>$query->data->result));  
    }

    function copy_template($subdomain) {
        $location_from_root = '../../' . $subdomain;
        if (is_dir($location_from_root)) {
            shell_exec("cp -r assets/template_files/template/* " . $location_from_root);
        } else {
            echo "Subdomain doesn't exist!";
        }
    }

    private function change_perms($permissions) {
        $path_to_file = 'assets/template_files/template/wp-config.php';
        shell_exec("chmod " . $permissions . " " . $path_to_file);
    }

    function change_config_settings($db_name) {
        shell_exec("rm assets/template_files/template/wp-config.php");
        shell_exec("cp assets/template_files/template/wp-config-template.php assets/template_files/template/wp-config.php");
        $path_to_file = 'assets/template_files/template/wp-config.php';
        $file_contents = file_get_contents($path_to_file);
        $file_contents = preg_replace("/database_name_here/", $db_name, $file_contents);
        file_put_contents($path_to_file, $file_contents);
       
        //Safe guard
        $this->change_perms("644");
    }

	function create_database($db_name) {
		$this->cpanel_authenticate();
		$this->xmlapi->api1_query('accountname', 'Mysql', 'adddb', array($db_name)); 
        $this->xmlapi->api1_query('accountname', 'Mysql', 'adduserdb', array($db_name, 'firstexe_social', 'all')); 
		//mysql_connect("firstexe_tool");
	}


	private function cpanel_authenticate() {
		$this->load->library('xmlapi', '184.172.173.27');
        $this->xmlapi->set_port(2082);
		$this->xmlapi->password_auth('firstexe','SDCjJDAWmLow'); 
		// $this->xmlapi->set_debug(1); 
	}

	function update_db($subdomain_name) {
    	$db_name = "firstexe_" . $subdomain_name; 
		$username = "firstexe";
		$password = "SDCjJDAWmLow";
		$hostname = "localhost"; 

		$dbhandle = mysql_connect($hostname, $username, $password) 
		  or die("Unable to connect to MySQL");
                                
            if (mysql_select_db($db_name)) {
                $result = mysql_list_tables($db_name);
                if (mysql_fetch_row($result)) {
                    mysql_query("UPDATE wp_options SET option_value = 'http://" . $subdomain_name . ".1stsocial.com.au' WHERE option_name = 'siteurl'");
                    mysql_query("UPDATE wp_options SET option_value = 'http://" . $subdomain_name . ".1stsocial.com.au' WHERE option_name = 'home'");
                } else {
                    echo "Db empty!";
                }
            } else {
                "Db doesn't exist";
            }

	}

}