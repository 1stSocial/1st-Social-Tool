<?php

Class Item_model extends CI_Model {

    function get_taxonomy($pid)
    {
        $query = $this->db->get_where('taxonomy', array('tag_id'=>$pid));
        if($query->num_rows()>0)
        return $query->result();
    }
    
    function item_insert($data)
    {
        $this->db->insert('items',$data);
        
    }
    function get_item()
    {
        $q = 'SELECT i.id, i.name,i.title,i.body,i.status,i.createdTime,u.name as created_by FROM users u inner join items i on u.id = i. created_by';
        $query = $this->db->query($q);
        return $query->result();
    }
    
    function delete_item($id)
    {
        $this->db->where(array('id'=>$id));
        $this->db->delete('items');
    }
    
    function get_item_id($id)
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
    
    function update_item()
    {
       $id = $this->input->post('id');
       $data['name'] = $this->input->post('name');
       $data['title'] = $this->input->post('title');
       $data['body'] = $this->input->post('body');
       
       $this->db->update('items',$data,array('id'=>$id));
       
    }
    
}

?>
