<?php
Class Tag_model extends CI_Model
{
	private $_id;
	private $_name;
	private $_parentTagId;	
	
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
	 * @param field_type $_name
	 */
	public function setName($_name) {
		$this->_name = $_name;
	}
	
	
	/**
	 * @return the $_parentTagId
	 */
	public function getParentTagId() {
		return $this->_parentTagId;
	}
	
	/**
	 * @param field_type $_parentTagId
	 */
	public function setParentTagId($_parentTagId) {
		$this->_parentTagId = $_parentTagId;
	}
	
	public function getAllParentTags(){
		$query = $this->db->get_where('tags',array( "parent_tag_id" =>0));
		if ($query->num_rows()>0){
			return $query->result();
		}
		
	}
        
        public function getChildTags($parentTag){
            $query = $this->db->get_where('tags',array( "name" =>$parentTag));
            if ($query->num_rows()>0){
            $option=$query->result();            
            $query1 = $this->db->get_where('tags',array( "parent_tag_id" => $option[0]->id));
		if ($query1->num_rows()>0){
			return $query1->result();
		}
            }
        }
        public function deleteTags($boardId){        
          $this->db->delete('tags', array('board_id' => $boardId));
        }
	
}