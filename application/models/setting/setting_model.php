<?php


Class Setting_model extends CI_Model {

    
    public function save()
    {
        $data = $this->input->post();
        unset($data['btn']);
        $theme_name = $data['themename'];
        $updatedata = array(
            'status' => 0
        );
        $this->db->update('theme',$updatedata);
        
        $val = array(
            'theme_name' => $theme_name,
            'status'=>'1'
        );
        $this->db->insert('theme',$val);
        $id = mysql_insert_id();
        
        unset($data['themename']);
      
        
        foreach ($data as $key => $value) {
            if($value != "")
            {
            $val = array(
                'key' =>$key,
                'value'=>$value,
                'theme_id'=>$id       
            );
            
            $this->db->insert('theme_value',$val);
            }
        }
        
    }
    
    public function set_theme()
    {
        $val = $this->input->post('select');
        
        if($val == 'none')
        {
//            echo 'none';
        }
        else
        {
            $updatedata = array(
                'status' => 0
            );
            $this->db->update('theme',$updatedata);
            
            $updatedata2 = array(
                'status' => 1
            );
            $this->db->where('id',$val);
            $this->db->update('theme',$updatedata2);
//           echo '';
        }
    }
            
    function theme_name()
    {
        $res = $this->db->get('theme');
        if($res->num_rows())
        {
            return $res->result();
        }
        else 
        {
            return "";
        }
    }
    
    function delete_theme($id)
    {
        $this->db->delete('theme',array('id'=>$id));
        $this->db->delete('theme_value',array('theme_id'=>$id));
    }
    
    function get_theme_by_id($id)
    {
       $query = $this->db->get_where('theme_value', array('theme_id'=>$id));
       if($query->num_rows())
       {
           return $query->result_array();
       }
    }
    
    public function name($id)
    {
        $this->db->select('theme_name');
        $query = $this->db->get_where('theme', array('id'=>$id));
        if($query->num_rows())
       {
           $temp = $query->result_array();
           return $temp[0]['theme_name'];
       }
        
    }
    
    
    public function update()
    {
      $data =  $this->input->post();
      unset($data['btn']);
      $this->db->update('theme', array('theme_name'=>$data['themename']), array('id'=>$data['id']));
      $this->db->delete('theme_value',array('theme_id'=>$data['id']));
      
      unset($data['themename']);
      
        
        foreach ($data as $key => $value) {
            if($value != "")
            {
            $val = array(
                'key' =>$key,
                'value'=>$value,
                'theme_id'=>$data['id']   
            );
            
            $this->db->insert('theme_value',$val);
            }
        }
      
//      var_dump($data);
    }
    
    public function get_image()
    {
        $res = $this->db->get('items');
        if($res->num_rows())
        return $res->result_array();
        else
        return "";
    }
}

?>
