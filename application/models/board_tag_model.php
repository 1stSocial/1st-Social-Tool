<?php
Class Board_tag_model extends CI_Model
{
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
        
        public function saveBoardTag(){
            $data=array( "board_id" =>$this->_boardId,"tag_id"=>$this->_tagId);
             $query = $this->db->get_where('board_tags',$data);
             if($query->num_rows()>0){
                 $option=$query->result();                 
                 $this->db->where('id', $option[0]->id);
		 $this->db->update('board_tags', $data);
             }else{
                 $this->db->insert('board_tags',$data);
             }
             
        }



        
}



