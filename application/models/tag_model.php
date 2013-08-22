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
            
            $this->db->where('id',$data['id']);
            
            $this->db->update('tags',$data);
           
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
            if(!$data['parent_tag_id'])
            {
            $query = $this->db->get_where('tags',array('name'=> $data['name'],'parent_tag_id'=>'0'));
            return $query->num_rows();
            }
            else
                return 0;
            
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
        
        public function AllTag()
        {
            $query = $this->db->get('tags');
            if($query->num_rows()>0)
            {
                return $query->result();
            }
        }
        
        public function addtag($data)
        {
            if($data['parent_tag_id'])
            {
                $this->db->insert('tags', $data); 
            }
            else
            {
                $data['parent_tag_id'] = '0'; 
                $this->db->insert('tags', $data);
            }
        }

        public function id_val($id)
        {
            $query = $this->db->get_where('tags',array( "id" =>$id));
            if ($query->num_rows()>0){
                return $query->result();            
           	
            }
        }
        
        public function AllParentTags()
        {
            $query = $this->db->get('tags');
            
            foreach ($query->result() as $val)
            {
                $id = $val->id; 
                $temp = $this->db->get_where('tags',array('parent_tag_id'=>$id));
                
                if($temp->num_rows()>0)
                {
                    $result[$id] = $val->name; 
                }
            }
            
            return $result;
        }
        function AllParentTags2()
        {
            $query = $this->db->get('tags');
            
            foreach ($query->result() as $val)
            {
                $id = $val->id; 
                $temp = $this->db->get_where('tags',array('parent_tag_id'=>$id));
                
                if($temp->num_rows()>0)
                {
                    $result[] = $val; 
                }
            }
            
            return $result;
        }


        public function AllchildTagsid($parentTag)
        {
           $query =  $this->db->get('tags',array('parent_tag_id'=>$parentTag));
            foreach ($query->result() as $val)
            {
                $result[] = $val->id;
            }
            return $result;
        }
        
 } 