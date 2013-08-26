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
        $query = $this->db->get('items');
        
        return $query->result();
    }
    
    function delete_item()
    {
        
    }
}

?>
