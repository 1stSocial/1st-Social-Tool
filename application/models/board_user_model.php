<?php
Class Board_user_model extends CI_Model
{
	private $_id;
	private $_boardId;
	private $_userId=array();	
	
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
	 * @return the $_boardId
	 */
	public function getBoardId() {
		return $this->_boardId;
	}
	
	/**
	 * @param field_type $_boardId
	 */
	public function setBoardId($_boardId) {
		$this->_boardId = $_boardId;
	}
	
	/**
	 * @return the $_userId
	 */
	public function getUserId() {
		return $this->_userId;
	}
	
	/**
	 * @param field_type $_userId
	 */
	public function setUserId($_userId) {
		$this->_userId = $_userId;
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
	
	public function saveBoardUser(){
		// select clause to check any user is exist for this board
		  $query = $this->db->get_where('board_users',array( "board_id" => $this->_boardId));
		  if ($query->num_rows()>0){
		  	$this->db->delete('board_users', array('board_id' => $this->_boardId));
		  	if(is_array($this->_userId) && !empty($this->_userId)){
		  		foreach($this->_userId as $userId){
		  		$this->db->insert('board_users', array('board_id'=>$this->_boardId,
		  				                         'user_id' =>$userId
		  				                   ));
		  		}
		  	}
		  }else{
		  	if(is_array($this->_userId) && !empty($this->_userId)){
		  		foreach($this->_userId as $userId){
		  			$this->db->insert('board_users', array('board_id'=>$this->_boardId,
		  					'user_id' =>$userId
		  			));
		  		}
		  	}
		  }
		
	}
        
        public function getSelectedUserByBoardId($boardId){
             $query = $this->db->get_where('board_users',array( "board_id" => $boardId));
             if ($query->num_rows()>0){
                 return $query->result();
             }
        }
        
         // delete tags by boardId 
        public function deleteTags($boardId){        
          $this->db->delete('board_users', array('board_id' => $boardId));
        }
	
}