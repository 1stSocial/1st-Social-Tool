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
		$this->db->select('t_p.*,t.name');
                $this->db->from('tag_parent as t_p');
                $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                $temp = $this->db->get_where('tag_parent',array('t_p.parent_tag_id'=>0));
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
            $this->db->update('tags',array('name'=>$data['name']));
             
//            $this->db->where('tag_id',$data['id']);
//            $this->db->delete('tag_parent');
             
        $this->db->where('tag_id',$data['id']);
        $this->db->delete('tag_parent');
                
            
            if(is_array($data['parent_tag_id']))
                {
                    foreach ($data['parent_tag_id'] as $value) {
                            $val = array(
                                'tag_id'=>$data['id'],
                                'parent_tag_id'=>$value
                            );
                            $this->db->insert('tag_parent', $val);
                    }
//                    $this->db->insert('tags', $value); die;
//                die;
                }
                else
                {
                    $val = array(
                                'tag_id'=>$data['id'],
                                'parent_tag_id'=>0
                            );
                    $this->db->insert('tag_parent', $val);
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
            if(!$data['parent_tag_id'])
            {
                $this->db->select('t_p.*,t.name');
                $this->db->from('tag_parent as t_p');
                $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                $query = $this->db->get_where('tag_parent',array('t_p.parent_tag_id'=>0));
//            $query = $this->db->get_where('tags',array('name'=> $data['name'],'parent_tag_id'=>'0'));
            return $query->num_rows();
            }
            else
                return 0;
            
        }
        
        public function deleteparentTags($Id){        
          
               
            $this->db->delete('tags', array('id' => $Id));
            $this->db->delete('tag_parent', array('tag_id'=>$Id));
             $this->db->delete('tag_parent', array('parent_tag_id'=>$Id));
        }
        
        public function ParentTagname($parentTagid){
            $this->db->select('*');
                $this->db->from('tag_parent as t_p');
                $this->db->join('tags as t','t_p.tag_id=t.id','inner');
            $query = $this->db->get_where('tag_parent',array( "tag_id" =>$parentTagid));
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
//            var_dump($data);
//            if($data['parent_tag_id'])
//            {
                $this->db->insert('tags',array('name'=>$data['name']));
                $tag_id = mysql_insert_id(); 
                if(is_array($data['parent_tag_id']))
                {
                    foreach ($data['parent_tag_id'] as $value) {
                            $val = array(
                                'tag_id'=>$tag_id,
                                'parent_tag_id'=>$value
                            );
                            $this->db->insert('tag_parent', $val);
                    }
//                    $this->db->insert('tags', $value); die;
//                die;
                }
                else
                {
                    $val = array(
                                'tag_id'=>$tag_id,
                                'parent_tag_id'=>0
                            );
                    $this->db->insert('tag_parent', $val);
                }
//            }
            
        }

        public function id_val($id)
        {
            
            $query = $this->db->get_where('tags',array( "id" =>$id));
            if ($query->num_rows()>0){
                return $query->result();            
           	
            }
        }
        
        
        public function parent_tag($id)
        {
            echo $id;
           $query = $this->db->get_where('tag_parent',array('tag_id'=>$id));
            if($query->num_rows())
            {
                $arr[] = array();
               $res = $query->result_array();
               foreach ($res as $val)
               {
                   $arr[] = $val['parent_tag_id'];
               }
               
               return $arr;
            }
            
        }

                public function root_parent()
        {
                $this->db->select('*');
                $this->db->from('tag_parent as t_p');
                $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                $temp = $this->db->get_where('tag_parent',array('t_p.parent_tag_id'=>0));
                if($temp->num_rows())
                {
                    $val = $temp->result();
                    foreach($val as $key => $value)
                    {
                        $result[$value->id] = $value->name;
                    }
                    return $result;
                }
        }

                public function AllParentTags()
        {
//            $query = $this->db->get('tags');
           
                $this->db->select('t_p.*,t.name');
                $this->db->from('tag_parent as t_p');
                $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                $query = $this->db->get();
                
//                var_dump($query->result_array());die;
                
            
            foreach ($query->result() as $val)
            {
                
                $id = $val->tag_id; 
                 $this->db->select('t_p.*,t.name');
                $this->db->from('tag_parent as t_p');
                $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                $temp = $this->db->get_where('tag_parent',array('t_p.parent_tag_id'=>$id));
                
                if($temp->num_rows()>0 || $val->parent_tag_id == 0)
                {
                    $result[$id] = $val->name; 
                }
            }
            
            
//            var_dump($result);die;
            return $result;
        }
        function AllParentTags2()
        {
            $this->db->select('t_p.*,t.name');
                $this->db->from('tag_parent as t_p');
                $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                $query = $this->db->get();
            
            foreach ($query->result() as $val)
            {
                $id = $val->tag_id; 
                 $this->db->select('t_p.*,t.name');
                $this->db->from('tag_parent as t_p');
                $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                $temp = $this->db->get_where('tag_parent',array('t_p.parent_tag_id'=>$id));
                
                
                if($temp->num_rows()>0)
                {
                    $result[] = $val; 
                }
            }
            
            return $result;
        }


        public function AllchildTagsid($parentTag)
        {
            $result = array();
          
            foreach ($parentTag as $value) 
            {
            
             $query =  $this->db->get('tags',array('parent_tag_id'=>$value));
            foreach ($query->result() as $val)
            {
                $result[] = $val->id;
            }
            }
            return $result;
        }
        
        public function tag_val($bid)
        {
            $query = $this->db->get_where('board',array('id'=>$bid));
            $arr = array();
            $arr2 = array();
            
            if($query->num_rows()>0)
            {
                $result = $query->result_array();
//                var_dump($result);die;
                foreach($result as $val) {
                    $this->db->select('t_p.*,t.name');
                    $this->db->from('tag_parent as t_p');
                    $this->db->join('tags as t','t_p.tag_id=t.id');
                    $this->db->where('t_p.parent_tag_id',$val['parent_tags']);
                    $query2 = $this->db->get_where();
                    if($query2->num_rows()>0)
                    {
                        $result2 = $query2->result_array();
//                        var_dump($result2);
//                        die;
                        foreach($result2 as $val2) {
                             $this->db->select('t_p.*,t.name');
                            $this->db->from('tag_parent as t_p');
                            $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                            $this->db->where('t_p.parent_tag_id',$val2['tag_id']);
                            $query3 = $this->db->get();
//                            $query3 = $this->db->get_where('tags',array('parent_tag_id'=>$val2['id']));
                            if($query3->num_rows()>0)
                            {
                                $arr[] = $val2;
                                foreach($query3->result_array() as $val3)
                                {
                                    $arr2[] = $val3;
                                }
                            }
                        }
                        }
                    }
                }
               
                $result_send['Parent'] = $arr;
                $result_send['child'] =$arr2;
                
                return $result_send;
        }


        public function semi_parent($bid=FALSE)
        {
//            echo $bid;die;
            $temp_res = array();
            if($bid)
            {
                $this->db->select('*');
                $this->db->from('board');
                $this->db->where('id',$bid);
                $abc =  $this->db->get();
                if($abc->num_rows()>0)
                {
                    $temp_res = $abc->result_array();
//                    var_dump($temp_res);
                }
               
            }
            else
            {
                $temp_res['0']['parent_tags'] = TRUE;
            }
            $this->db->select('t_p.*,t.name');
            $this->db->from('tag_parent as t_p');
            $this->db->join('tags as t','t_p.tag_id=t.id','inner');
            $this->db->where('t_p.parent_tag_id','0'); 
            
            $query = $this->db->get();
            
            $arr = array();
            $arr2 = array();
            
            if($query->num_rows()>0)
            {
                $result = $query->result_array();
//                var_dump($result);die;
               
                foreach($result as $val) 
                {   
                   
                  if($val['tag_id']  == $temp_res['0']['parent_tags'])
                  {
                    $this->db->select('t_p.*,t.name');
                    $this->db->from('tag_parent as t_p');
                    $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                    $this->db->where('t_p.parent_tag_id',$val['tag_id']);
                    $this->db->distinct();
                    $query2 = $this->db->get();
                  if($query2->num_rows()>0)
                    {
                        $result2 = $query2->result_array();
//                        var_dump($result2);die;
                        
                        foreach($result2 as $val2) {
                            $this->db->select('t_p.*,t.name');
                            $this->db->from('tag_parent as t_p');
                            $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                            $this->db->where('t_p.parent_tag_id',$val2['tag_id']);
//                            $this->db->distinct('t.name');
                            $query3 = $this->db->get();
                            if($query3->num_rows()>0)
                            {
                                $arr[] = $val2;
                                foreach($query3->result_array() as $val3)
                                {
                                    $arr2[] = $val3;
                                }
                            }
                        }
                        }
                    }
            }}
                $result_send['Parent'] = $this->super_unique($arr,'name');
                $result_send['child'] =$this->super_unique($arr2,'name');
                return $result_send;
            }
            
            
        function super_unique($array,$key)

        {

           $temp_array = array();

           foreach ($array as &$v) {

               if (!isset($temp_array[$v[$key]]))

               $temp_array[$v[$key]] =& $v;

           }

           $array = array_values($temp_array);

           return $array;
        }


            
            public function parenttag($id)
            {
                $this->db->select('t_p.*,t.name');
                    $this->db->from('tag_parent as t_p');
                    $this->db->join('tags as t','t_p.tag_id=t.id','inner');
                    $this->db->where('t_p.parent_tag_id',$id);
                    $query = $this->db->get();
//                $query = $this->db->get_where('tags',array('parent_tag_id'=>));
                if($query->num_rows()>0)
                {
                    return $query->result_array();
                }
                else
                {
                    return 0;
                }
                
            }
            
          
 } 