<?php

class Taxonomy_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function add_taxonomy() {

        $data = array(
            'tag_id' => implode(',',$this->input->post('parentid')),
            'taxonomy_id' => NULL,
            'name' => $this->input->post('taxonomyname'),
            'type' => $this->input->post('type'),
        );
        $this->db->insert('taxonomy', $data);
    }

    function delete_taxonomy($id) {
        $this->db->delete('taxonomy', array('id' => $id));
    }

    function get_taxonomy($id = '') {
        if ($id == '') {
            $this->db->select('taxonomy.id,taxonomy.name,taxonomy.type,taxonomy.value,taxonomy.tag_id as parenttag');
            $this->db->from('taxonomy');
//            $this->db->join('tags', 'tags.id=taxonomy.tag_id');
            $query = $this->db->get();
            //echo 'if';
       
        
        $temp_res = $query->result();
        
        foreach ($temp_res as $value) {
            
             $this->db->select('name');
             $this->db->from('tags');
             $this->db->where_in('id',  explode(',',$value->parenttag) );
             $res_temp = $this->db->get();
             
            if($res_temp->num_rows()>1)
            {
                $new_val = ""; 
                foreach ($res_temp->result() as $value1) {
                    $new_val .= $value1->name . ',';
                }
                $new_val[strlen($new_val)-1] = "";
                $value->parenttag = $new_val;
              
            }
            else
            {
               $value1=  $res_temp->result();
                $value->parenttag =  $value1[0]->name;
            }
             
        } } else {
            $this->db->where(array('id' => $id));
            $query = $this->db->get('taxonomy');
            $temp_res = $query->result();
        }
      
        return $temp_res;
    }

    function  get_int_taxo($tag_id = FALSE)
    {
        if($tag_id)
        {
            $this->db->select('*');
            $this->db->from('taxonomy');
            $this->db->where('tag_id',$tag_id);
            $this->db->where('type','Integer');
            $res = $this->db->get();
            if($res->num_rows()>0)
            {
                return $res->result_array(); 
            }
            else 
            {
                return "";
            }
        }
        else
        {
            return "";
        }
    }
            
    function update_taxonomy() {
        $data = array('name' => $this->input->post('taxonomyname'),
            'type' => $this->input->post('type'),
            'tag_id' => implode(',', $this->input->post('tag_id')));

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('taxonomy', $data);
    }

}

?>
