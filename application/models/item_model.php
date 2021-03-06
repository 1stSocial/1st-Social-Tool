<?php
 

Class Item_model extends CI_Model {
 
    function get_taxonomy($pid)
    {
//       $this->db->select("*");
//       $this->db->from('taxonomy');
//        $this->db->like('tag_id','%'.$pid.'%');
//       $query = $this->db->get(); 
       
       $sql = "select * from taxonomy WHERE tag_id REGEXP '[[:<:]]".$pid."[[:>:]]'";
       $query = $this->db->query($sql);
//        if($query->num_rows()>0)
//        {
//            $res = $query->result();
//            
//            foreach ($res as $va)
//            {
//                $val = explode(',', $va->tag_id);
//                
//                var_dump($val);
//                
//                if(count($val) > 1)
//                {
//                    
//                }
//                
//            }
//        var_dump($query->result());
            return $query->result();
//        }
    }
    
    function change()
    {
        $temp = $this->db->get('items');
        $arr = $temp->result();
        foreach ($arr as $val)
        {
            $res =  $this->db->get_where('board',array('id'=>$val->board_id));
            $res_val = $res->result();
//            var_dump($res_val);die;
             $this->db->update('items', array('parent_tag_id'=> $res_val[0]->parent_tags),array('board_id'=>$val->board_id));
             
        }
    }
            
    function item_insert($data,$tag_id)
    {
        
        $this->db->insert('items',$data);
       $rs['item_id'] = $this->db->insert_id();   
//        $tag_id = $this->input->post('tag_id');
//        var_dump($tag_id); die;
       $val ="";
       
      if($tag_id)
      {
      if(is_array($tag_id))
      {
          foreach ($tag_id as $value) {
              if($value != "")
              $val .=  '( '.$rs['item_id'].','.$value.'),';
          } 
          
            
         $val[strlen($val)-1] = "";
          
          $sql = "insert into item_tags(item_id,tag_id) values ".$val."";
//       
          $this->db->query($sql); 
         
      }
      else
      {
          $temp_ar = array(
                    'item_id' =>$rs['item_id'],
                    'tag_id' => $tag_id        
              );
          $this->db->insert('item_tags',$temp_ar);
      }
    
      $val="";
        $taxoarr = $this->input->post('taxo');
       foreach ($taxoarr as $taxo_id => $taxo_val) {
        if($taxo_val != "")
        {
          $val .= '('.$rs['item_id'].','.$taxo_id.',"'. $taxo_val.'"),';
        }
       }
       
       
      $val[strlen($val)-1] = "";
       
       $sql1 = "insert into item_taxo (item_id,taxo_id,value) values ".$val."";
       $this->db->query($sql1);
         }
       return $rs['item_id'];
    }
    function get_item($id)
    {
        if($id == 1)
        {
//            $q = 'SELECT i.id, i.name,i.title,i.body,i.status,i.createdTime,u.name as created_by FROM users u inner join items i on u.id = i. created_by ';
        
            $this->db->select('i.id, i.name,i.title,i.body,i.status,i.createdTime,boards.name as board_name,u.name as created_by');
        $this->db->from('users as u');
        $this->db->join('items as i','u.id = i.created_by' );
        $this->db->join('board_domain as b', 'b.board_id = i.board_id');
        $this->db->join('board as boards','boards.id = i.board_id');
//        $this->db->where('b.domain_id',$id); 
        $query = $this->db->get();
            
//             $query = $this->db->query($q);
        }
        else
//        $q = 'SELECT i.id, i.name,i.title,i.body,i.status,i.createdTime,u.name as created_by FROM users u inner join items i on u.id = i. created_by where i.created_by = '.$id;
        {
            
            $t = $this->db->get_where('users' ,array('id'=>$id));
           $temp = $t->result_array();
            $did= $temp['0']['domain_id'];
            
        $this->db->select('i.id, i.name,i.title,i.body,i.status,i.createdTime,boards.name as board_name,u.name as created_by');
        $this->db->from('users as u');
        $this->db->join('items as i','u.id = i.created_by' );
        $this->db->join('board_domain as b', 'b.board_id = i.board_id');
        $this->db->join('board as boards','boards.id = i.board_id');
        $this->db->where('b.domain_id',$did); 
        $query = $this->db->get();
        
        }
        
//        var_dump($query->result());die;
//       
        return $query->result();
    }
    
    function delete_item($id)
    {
        $this->db->where(array('id'=>$id));
        $this->db->delete('items');
        $this->db->where(array('item_id'=>$id));
        $this->db->delete('item_tags');
        $this->db->where(array('item_id'=>$id));
        $this->db->delete('item_taxo');
    }
    
    function  get_item_id($id)
    {
        
        $res = $this->db->get_where('item_tags',array('item_id'=>$id));
        if($res->num_rows()>0)
        {
        $this->db->select('*,t.tag_id as tag_id,i.id as item_id,');  
        $this->db->from('items as i');
        $this->db->join('item_tags as t', 'i.id = t.item_id');         
        $this->db->where('item_id', $id); 
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
             return $query->result_array();
             
         }
        }
        else
        {
            $this->db->select('*,id as item_id,');  
        $this->db->from('items');
//        $this->db->join('item_tags as t', 'i.id = t.item_id');         
        $this->db->where('id', $id); 
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
             return $query->result_array();
             
         }
        }
        
        
    }
    
    function get_item_taxo($id)
    {
        $this->db->select('*,first.value as ival');
        $this->db->from('item_taxo as first');
        $this->db->join('taxonomy as t','first.taxo_id = t.id');
        $this->db->where('item_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
             return $query->result_array();
          }
    }
    
    
            
    function update_item()
    {
       $id = $this->input->post('id');
       $data['name'] = $this->input->post('name');
       $data['title'] = $this->input->post('title');
       $data['status'] = $this->input->post('status');
       $data['body'] = $this->input->post('body');
       $data['image'] = $this->input->post('image');
       $data['call_to_action'] =  $this->input->post('call_to_action');
       
       $this->db->update('items',$data,array('id'=>$id));
       $this->db->delete('item_taxo', array('item_id'=>$id));
       $taxoarr = $this->input->post('taxo');
       if($taxoarr)
       {
       foreach ($taxoarr as $taxo_id => $taxo_val) 
           {
                if(!$taxo_val=='')
                {
                    $taxo = array(
                                 'item_id'=>$id,
                                 'taxo_id'=>$taxo_id,
                                 'value' => $taxo_val
                    );

                    $this->db->insert('item_taxo',$taxo);
               }
        }
       }
        
        $this->db->delete('item_tags', array('item_id'=>$id));
        $tagarr = $this->input->post('tag_id');
        if($tagarr)
      {
       foreach ($tagarr as $tag_val) 
           {
                if(!$tag_val=='')
                {
                    $taxo = array(
                                 'item_id'=>$id,
                                 'tag_id'=>$tag_val
                    );

                    $this->db->insert('item_tags',$taxo);
               } 
        }
      }
    }
    
    function get_board($id)
    {
        $this->db->select('domain_id');
        $val = $this->db->get_where('users',array('id'=>$id));
        if($val->num_rows()>0)
        {
            $temp = $val->result_array();
            $dom_id = $temp['0']['domain_id'];
        }
        
        $this->db->select('b.*');  
        $this->db->from('board_domain as b_u');
        $this->db->join('board as b', 'b.id = b_u.board_id');
        if($id == '1')
        {
            
        }
        else
        $this->db->where('b_u.domain_id', $dom_id); 
        
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
             return $query->result_array();
             
         }
    }
    
    function get_type($id)
    {
        $query = $this->db->get_where('taxonomy', array('id'=>$id));
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

?>
