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
        
        public function addParentTag($data)
        {
            $val = array(
                'id'=>NULL,
                'name'=>$data['parenttag'],
                'parent_tag_id'=>'0'
            );
            $this->db->insert('tags',$val);
            return mysql_insert_id();  
        }
	
        public function updateTag($data)
        {
            $value = array(
                'name'=>$data['parenttag'],
                'parent_tag_id'=>'0'
                    );
            $this->db->where('id',$data['id']);
            
            $this->db->update('tags',$value);
           
            $this->db->delete('tags', array('parent_tag_id'=>$data['id']));
            
            foreach ($data['childtag'] as $value)
            {
              $val2 = array(
                'id' => NULL,
                'name'=>$value,
                'parent_tag_id'=> $data['id'] 
                    );  
                if(!$value=="")
                    $this->db->insert('tags',$val2);
            }
        }

         public function addchildTag($data)
        {
            foreach ($data['childtag'] as $key => $value) 
                {
                    $val = array(
                                'id'=>NULL,
                                'name'=>$value,
                                'parent_tag_id'=> $data['parentid']
                                );
                    if(!$value=="")
                    $this->db->insert('tags',$val);
                }
               die();
        }
        
        public function checkParentTag($data)
        {
            $query = $this->db->get_where('tags',array('name'=> $data['parenttag'],'parent_tag_id'=>'0'));
            return $query->num_rows();
            
        }
        
        public function deleteparentTags($Id){        
          $this->db->delete('tags', array('id' => $Id));
          $this->db->delete('tags', array('parent_tag_id'=>$Id));
        }
        
        public function ParentTagname($parentTagid){
            
            $query = $this->db->get_where('tags',array( "id" =>$parentTagid));
            if ($query->num_rows()>0){
            $option=$query->result();            
           	if ($query->num_rows()>0){
			return $option[0]->name;
		}
            }
        }
       
}