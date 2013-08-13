<?php
Class User_model extends CI_Model
{
	private $_id;
	private $_name;
	private $_domainId;
	private $_username;
	private $_password;
	private $_type;
	private $_accessLevel;
	
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}
	
	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
	}
	

	/**
	 * @return the $_name
	 */
	public function getName() {
		return $this->_name;
	}
	
	/**
	 * @param field_type $_id
	 */
	public function setName($_name) {
		$this->_name = $_name;
	}
	
	/**
	 * @return the $_domainId
	 */
	public function getDomainId() {
		return $this->_domainId;
	}
	
	/**
	 * @param field_type $_domainId
	 */
	public function setDomainId($_domainId) {
		$this->_domainId = $_domainId;
	}
	
	/**
	 * @return the $_username
	 */
	public function getUsername() {
		return $this->_username;
	}
	
	/**
	 * @param field_type $_username
	 */
	public function setUsername($_username) {
		$this->_username = $_username;
	}
	
	/**
	 * @return the $_password
	 */
	public function getPassword() {
		return $this->_password;
	}
	
	/**
	 * @param field_type $_password
	 */
	public function setPassword($_password) {
		$this->_password = $_password;
	}
	
	/**
	 * @return the $_type
	 */
	public function getType() {
		return $this->_type;
	}
	
	/**
	 * @param field_type $_type
	 */
	public function setType($_type) {
		$this->_type = $_type;
	}
	
	/**
	 * @return the $_accessLevel
	 */
	public function getAccessLevel() {
		return $this->_accessLevel;
	}
	
	/**
	 * @param field_type $_accessLevel
	 */
	public function setAccessLevel($_accessLevel) {
		$this->_accessLevel = $_accessLevel;
	}
	
	
	public function __construct(array $options = null)
	{
		parent::__construct();
		if (null !== $options) {
			foreach ($options as $option => $value) {
				$setter = 'set'. ucfirst($option);
				if (method_exists($this, $setter)) {
					$this->{$setter}($value);
				}
			}
			return $this;
		}
	}
	
	
	
	
	
    function login($username, $password) {    	
        $this->db->select('id, username, password,access_level');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);   
      $query = $this->db->get();      
    
        if ($query->num_rows() == 1) {
            return $query->result();
        }
        else {
            return false;
        }
    }

    function get_user_domain($user_id) {
        $this->db->select('domain');
        $query = $this->db->get_where('users', array('id' => $user_id));
        return $query->result();
    }

    function set_user_domain() {

    }

    /**
     * Short desc
     *
     * Long description first sentence starts here
     * and continues on this line for a while
     * finally concluding here at the end of
     * this paragraph
     *
     * The blank line above denotes a paragraph break
     */
    function add_user($user_data) {
        $data = array(
            "username" => $user_data['username'],
            "domain" => $user_data['domain'],
            "user_level" => $user_data['user_level'],
            "avatar" => $user_data['avatar_image_url']
        );

        $this->db->insert('users', $data);
    }

    function remove_user($user_id) {

    }

    function get_user_details($user_id) {

    }

    function set_user_details($user_id, $update_data) {
        $data = array();
        if (isset($update_data)) {
            if (isset($update_data['username'])) {
                $data['username'] = $user_data['username'];
            }
            if (isset($update_data['username'])) {
                $data['domain'] = $user_data['domain'];
            }
            if (isset($update_data['username'])) {
                $data['user_level'] = $user_data['user_level'];
            }
            if (isset($update_data['username'])) {
                $data['avatar'] = $user_data['avatar_image_url'];
            }
        }

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }
    /*
     * Get all partners 
     */
    public function getAllPartners(){
        $query = $this->db->get_where('users',array( "access_level" =>'partner'));
		if ($query->num_rows()>0){
			return $query->result();
		}
    }
}
?>