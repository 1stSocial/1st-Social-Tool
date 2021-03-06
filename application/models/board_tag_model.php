<?php


Class Board_tag_model extends CI_Model {

    private $_id;
    private $_boardId;
    private $_tagId;

    public function getId() {
        return $this->_id;
    }

    public function getBoardId() {
        return $this->_boardId;
    }

    public function getTagId() {
        return $this->_tagId;
    }

    public function setId($_id) {
        $this->_id = $_id;
    }

    public function setBoardId($_boardId) {
        $this->_boardId = $_boardId;
    }

    public function setTagId($_tagId) {
        $this->_tagId = $_tagId;
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

    public function saveBoardTag() {
        if(is_array($this->_tagId))
        {
        foreach($this->_tagId as $value)
        {
          if($value != 0)
        $data = array("board_id" => $this->_boardId, "tag_id" => $value);
          }
            
        }
  
        $query = $this->db->get_where('board_tags', $data);
        if ($query->num_rows() > 0) {
            $option = $query->result();
            $this->db->delete('board_tags', array('board_id' => $this->_boardId));
            $this->db->insert('board_tags', $data);
            //$this->db->where('id', $option[0]->id);
            //$this->db->update('board_tags', $data);
        } else {
            $this->db->insert('board_tags', $data);
        }
    }
    
    public function save_board_tag($dt)
    {
        if(is_array($dt))
        {
        foreach($dt as $value)
        {
          if($value != 0)
          {
        $data1 = array("board_id" => $this->_boardId, "tag_id" => $value);
          $this->db->insert('board_tags', $data1);}
          }
            
        }
        else
        {
            $data1 = array("board_id" => $this->_boardId, "tag_id" => $dt);
          $this->db->insert('board_tags', $data1);
        }
    }

        // get child tags of board
        public function getChildTagByBoard($boardId){
             $query = $this->db->get_where('board_tags',array( "board_id" =>$boardId));
            if ($query->num_rows()>0){
            return $query->result();         
            }
        }
        
        public function getChildTagByBoard_arr($boardId){
             $query = $this->db->get_where('board_tags',array( "board_id" =>$boardId));
            if ($query->num_rows()>0){
            return $query->result_array();         
            }
        }

                // delete tags by boardId 
        public function deleteTags($boardId){        
          $this->db->delete('board_tags', array('board_id' => $boardId));
        }

}



