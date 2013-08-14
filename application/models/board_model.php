<?php

Class Board_model extends CI_Model {

    private $_id;
    private $_name;
    private $_parentTag;
    private $_createdTime;
    private $_createdBy;

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
     * @return the $_parentTag
     */
    public function getParentTag() {
        return $this->_parentTag;
    }

    /**
     * @param field_type $_parentTag
     */
    public function setParentTag($_parentTag) {
        $this->_parentTag = $_parentTag;
    }

    /**
     * @return the $_createdTime
     */
    public function getCreatedTime() {
        return $this->_createdTime;
    }

    /**
     * @param field_type $_createdTime
     */
    public function setCreatedTime($_createdTime) {
        $this->_createdTime = $_createdTime;
    }

    /**
     * @return the $_createdBy
     */
    public function getCreatedBy() {
        return $this->_createdBy;
    }

    /**
     * @param field_type $_createdTime
     */
    public function setCreatedBy($_createdBy) {
        $this->_createdBy = $_createdBy;
    }

    public function __construct(array $options = null) {
        parent::__construct();
        if (null !== $options) {
            foreach ($options as $option => $value) {
                $setter = 'set' . ucfirst($option);
                if (method_exists($this, $setter)) {
                    $this->{$setter}($value);
                }
            }
            return $this;
        }
    }

    public function saveBoard() {
        $data = array(
            "name" => $this->_name,
            "parent_tags" => $this->_parentTag,
            "createdTime" => $this->_createdTime,
            "created_by" => $this->_createdBy
        );
        // select clause to check if board is exist
        $query = $this->db->get_where('board', array("name" => $this->_name,
            "parent_tags" => $this->_parentTag,
            "created_by" => $this->_createdBy
        ));
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $this->db->where('id', $result[0]->id);
            $this->db->update('board', $data);
            return $result[0]->id;
        } else {
            $this->db->insert('board', $data);
            return $this->db->insert_id();
        }
    }
    
    // get board using userId 
    public function getBoards($userId){
        //$query = $this->db->get_where('board', array("created_by" => $userId));
        $this->db->select('*,u.name as user_name,b.name as board_name,b.id as board_id');  
        $this->db->from('board as b');
        $this->db->join('users as u', 'b.created_by = u.id');         
        $this->db->where('created_by', $userId); 
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
             return $query->result();
             
         }
    }
    
   // get board using boardId
    public function getBoardByBoardId($boardId){
         //$query = $this->db->get_where('board', array("id" => $boardId));
        $this->db->select('*');  
        $this->db->from('board');
        $this->db->join('board_tags', 'board.id = board_tags.board_id', 'left');         
        $this->db->where('board.id', $boardId); 
        $query = $this->db->get();
        
          if ($query->num_rows() > 0) {
             return $query->result();
             
         }
    }
    
    // delete board
    public function deleteBoard($boardId){        
          $this->db->delete('board', array('id' => $boardId));      
          
    }

}