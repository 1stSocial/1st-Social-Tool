<?php
Class Adduser extends CI_Model {
 
    public function get_user($user_name)
    {
        $this->db->select('*');
        $temp =  $this->db->get_where('users', array('username'=>$user_name));
        
        if($temp->num_rows())
        {
             $val = $temp->result_array();
             $id = $val['0']['id'];
             if($val['0']['access_level'] == 'admin')
             {
                 $this->db->select('u.*,dom.name as domain_name');
                 $this->db->from('users as u');
                 $this->db->join('domain as dom','dom.id = u.domain_id');
                 $value =  $this->db->get();
             }
             else
             {
                 $this->db->select('u.*,dom.name as domain_name');
                 $this->db->from('users as u');
                 $this->db->join('domain as dom','dom.id = u.domain_id');
//                 var_dump($id);die;
                 $this->db->where('parent_user_id',$id);
                 $value =  $this->db->get();
                 
             }
             if($value->num_rows())
             {
                $result =  $value->result();
//                var_dump($result);die;
                return $result;
             }
        }
        else
        {
            return "";
        }
        
    }
    
    public function domain()
    {
       $res = $this->db->get('domain');
       if($res->num_rows())
       {
           return $res->result();
       }
       
    }
    
    public function user_id($user_name)
    {
        $this->db->select('*');
        $temp =  $this->db->get_where('users', array('username'=>$user_name));
        
        if($temp->num_rows())
        {
            $val = $temp->result_array();
            
            return $val['0']['id'];
        }
    }
    
    public function add_user()
    {
        $data = $this->input->post();
        $data['password'] = md5($data['password']);
        $this->db->insert('users', $data);
        return mysql_insert_id();
    }
    
    public function username_check()
    {
        $username =  $this->input->post('username');
        $res = $this->db->get_where('users',  array('username'=>$username));
        if($res->num_rows()>0)
        {
            return 'no';
        }
        else 
        {
            return 'ok';
        }

    }
    
    public function delete_user($id)
    {
        $this->db->delete('users',array('id'=>$id));
    }
    
    public function detail($id)
    {
//        echo $id;
       
        $this->db->select('u.*,dom.name as domain_name');
                 $this->db->from('users as u');
                 $this->db->join('domain as dom','dom.id = u.domain_id');
                 $this->db->where(array('u.id'=>$id));
                 $value =  $this->db->get();
                 
             
             if($value->num_rows())
             {
                $result =  $value->result_array();
//                var_dump($result);die;
                return $result;
             }
             else
             {
                 return "";
             }
    }
    public function update_user()
    {
       
        $data = $this->input->post();
        
        $id = $data['id'];
        unset($data['id']);
        if($data['password']!="")
        {
            $data['password'] = md5($data['password']);
        }
        else
        {
            unset($data['password']); 
        }
        
        $this->db->where('id',$id);
        $this->db->update('users',$data);
//        $this->db->get(); 
    }
    
    
}
?>