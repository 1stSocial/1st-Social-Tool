<?php
Class Domain_model extends CI_Model {

    public function get_Domain()
    {
        $data = $this->db->get('domain');
        if($data->num_rows())
        {
            return $data->result();
        }
    }
    
    public function create_domain($data)
    {
        $val = $this->db->get_where('domain', array('name'=>$data['name']));
        if($val->num_rows() == 0)
        {
        $this->db->insert('domain', $data);
        return "";
        }
        else
        {
            return 'exist';
        }
    }
    
    public function edit_domain($id)
    {
        $data =  $this->db->get_where('domain', array('id'=>$id));
        if($data->num_rows())
        {
            return $data->result_array();
        }
    }
    
    public function update_domain($data)
            
    {
        $id = $data['id'];
        unset($data['id']);
        $val = $this->db->get_where('domain', array('name'=>$data['name']));
        if($val->num_rows() <= 0)
        {
            $this->db->where('id',$id);
            $this->db->update('domain', $data);
            return "";
        }
         else
        {
            return 'exist';
        }
    }
    
    
    public function delete_domain($id)
    {
        $this->db->delete('domain', array('id'=>$id));
    }
}
?>