<?php

class User_model extends CI_Model
{
    function get_parent()
    {
        
    }
    
    function page_count($page)
    {
        switch ($page) {
            case 'post_job':
            {
                $this->db->select('i.*,u.name as user_name');
                    
                $this->db->from('items as i');
                $this->db->join('users as u','u.id =i.created_by','inner');
        //      $this->db->distinct();
                $result = $this->db->get();
                return $result->num_rows();
            }break;

            case 'refine_job_salary':
            {
                $max = $this->input->post('max');
                $min = $this->input->post('min');

                $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
                $this->db->from('taxonomy as taxo');
                $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
                $this->db->join('items as i','i.id=t.item_id','inner');
                $this->db->join('users as u','u.id =i.created_by','inner');
                $this->db->where('taxo.name','salary');
                $this->db->where("t.value BETWEEN $min AND $max");
       
//        $query = $this->db->get();
                $result = $this->db->get();
                return $result->num_rows();
            }break;
            
            case 'keyword_search':
            {
                $keyword = $this->input->post('search');
       
                $this->db->select('id');
                $this->db->from('items');
                $this->db->like('name',$keyword);
                $this->db->or_like('title',$keyword);
                $query = $this->db->get();
                
                return $query->num_rows();
            }break;
        } 
       
        
    }
    
    function refine_post_count($id)
    {
                $this->db->select('item_id');
                $this->db->from('item_tags');
                $this->db->where_in('tag_id',$id);
                $result = $this->db->get();
                return $result->num_rows();
    } 
    function post_job($start)
    {
        $result1 = array();
      //$result = $this->db->query('select u.name as user_name,i.* from items i inner join users u on u.id =i.created_by ');
                    
                    $this->db->select('i.*,u.name as user_name');
                    
                    $this->db->from('items as i');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                     $this->db->limit(5, $start);
//                    $this->db->distinct();
                    $result = $this->db->get();
                    if($result->num_rows()>0)
                    {
                    $result1['item'] = $result->result();
                    
                    $TEMP = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag.parent_tag_id');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->id);
                        $this->db->distinct();
                        $temp1 = $this->db->get();
                        $T = $temp1->result();
                        $TEMP[] = $T;
                    }
                    $result1['parent'] = $TEMP;
                    
                    $temp=array();
                    
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag.*');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->id);
                        $temp3 = $this->db->get();
                        $temp[] =$temp3->result();
                    }
                    
                    $result1['child'] = $temp;
//                    print_r($result1);
                    $temp5 = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
                        $this->db->from('taxonomy as taxo');
                        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
                        $this->db->join('items as i','i.id=t.item_id','inner');
                        $this->db->join('users as u','u.id =i.created_by','inner');
                        $this->db->where('taxo.name','salary');
                        $res = $this->db->where('i.id',$val->id);
                        $temp4 = $this->db->get();
                        $temp5[] =$temp4->result();
                    }
                    
                    $result1['salary'] = $temp5;
                    
                        $this->db->select('id');
                        $this->db->from('tags');
                        $this->db->where('name','Location');
                        $query = $this->db->get();
                        $result1['Location'] =  $query->result();
                    
                    }
                    
//                    print_r($result1);
//                    die;
                      return($result1);
                    
                    
    }
    
    function refine_post_job($id,$start)
    {
        $data = array();
        $data1 = array();
        $temp = array();
       $result1 = array();
        
                                              
            $this->db->select('item_id');
                $this->db->from('item_tags');
                $this->db->where_in('tag_id',$id);
                $this->db->limit(5, $start);
                $result = $this->db->get();
                if($result->num_rows()>0)
                {
                $data = $result->result();
              //  $result = $this->db->query('select u.name as user_name,i.* from items i inner join users u on u.id =i.created_by');
                    foreach ($data as $val)
                    {
                        $temp[] = $val->item_id;
                    }
                    $temp = array_count_values($temp);
                    $key = array_search(count($id)-1,$temp);
                }
//            endforeach;
        
                if(count($id)-1==1)
                {
                    $key = $id;
                }
                if(count($id)-1 == 0) 
                {
                    return $this->post_job();
                }
                
                    $this->db->select('i.*,t.item_id ,u.name as user_name');
                    $this->db->from('item_tags as t');
                    $this->db->join('items as i','i.id=t.item_id','inner');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    $this->db->where_in('t.tag_id',$key);
                    $this->db->limit(5, $start);
                    $this->db->distinct();
                    $result = $this->db->get();
                    if($result->num_rows()>0)
                    {
                        $result1['item'] = $result->result();
                    
               $TEMP = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag.parent_tag_id');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->id);
                        $this->db->distinct();
                        $temp1 = $this->db->get();
                        $T = $temp1->result();
                        $TEMP[] = $T;
                    }
                    $result1['parent'] = $TEMP;
                    
                    $temp=array();
                    
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag.*');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->id);
                        $temp3 = $this->db->get();
                        $temp[] =$temp3->result();
                    }
                    
                    $result1['child'] = $temp;
                    
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
                        $this->db->from('taxonomy as taxo');
                        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
                        $this->db->join('items as i','i.id=t.item_id','inner');
                        $this->db->join('users as u','u.id =i.created_by','inner');
                        $this->db->where('taxo.name','salary');
                        $res = $this->db->where('i.id',$val->id);
                        $temp4 = $this->db->get();
                        $temp5[] =$temp4->result();
                    }
                    
                    $result1['salary'] = $temp5;
                    
                    }
                    return($result1);
                    
       
    }
    
    function refine_job_salary($start)
    {
        $result1 = array();
        $max = $this->input->post('max');
        $min = $this->input->post('min');
        
        $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
        $this->db->from('taxonomy as taxo');
        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
        $this->db->join('items as i','i.id=t.item_id','inner');
        $this->db->join('users as u','u.id =i.created_by','inner');
        $this->db->where('taxo.name','salary');
        $this->db->where("t.value BETWEEN $min AND $max");
        $this->db->limit(5, $start);
       
//        $query = $this->db->get();
           $result = $this->db->get();
                    if($result->num_rows()>0)
                    {
                        $result1['item'] = $result->result();
                    
               $TEMP = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag.parent_tag_id');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->item_id);
                        $this->db->distinct();
                        $temp1 = $this->db->get();
                        $T = $temp1->result();
                        $TEMP[] = $T;
                    }
                    $result1['parent'] = $TEMP;
                    
                    $temp=array();
                    
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag.*');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->item_id);
                        $temp3 = $this->db->get();
                        $temp[] =$temp3->result();
                    }
                    
                    $result1['child'] = $temp;
                    
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
                        $this->db->from('taxonomy as taxo');
                        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
                        $this->db->join('items as i','i.id=t.item_id','inner');
                        $this->db->join('users as u','u.id =i.created_by','inner');
                        $this->db->where('taxo.name','salary');
                        $res = $this->db->where('i.id',$val->item_id);
                        $temp4 = $this->db->get();
                        $temp5[] =$temp4->result();
                    }   
                    
                    $result1['salary'] = $temp5;
                    
                    
                    
                    }
//                    print_r($result1);
//                    die;
                    return($result1);
    }
    
    function latest_job()
    {
        $this->db->select('items.id,items.name,items.title,items.createdTime');
        $this->db->from('items');
        $this->db->order_by('createdTime','DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result_array();
        
    }
    
    function view_detail($id)
    {
        $result1 = array();
      //$result = $this->db->query('select u.name as user_name,i.* from items i inner join users u on u.id =i.created_by ');
                    
                    $this->db->select('i.*,u.name as user_name');
                    
                    $this->db->from('items as i');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    if(is_array($id))
                       $this->db->where_in('i.id',$id); 
                    else 
                        $this->db->where('i.id',$id);
//                    $this->db->distinct();
                    $result = $this->db->get();
                    if($result->num_rows()>0)
                    {
                    $result1['item'] = $result->result();
                    
                    $TEMP = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag.parent_tag_id');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->id);
                        $this->db->distinct();
                        $temp1 = $this->db->get();
                        $T = $temp1->result();
                        $TEMP[] = $T;
                    }
                    $result1['parent'] = $TEMP;
                    
                    $temp=array();
                    
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag.*');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->id);
                        $temp3 = $this->db->get();
                        $temp[] =$temp3->result();
                    }
                    
                    $result1['child'] = $temp;
                    
                    
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
                        $this->db->from('taxonomy as taxo');
                        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
                        $this->db->join('items as i','i.id=t.item_id','inner');
                        $this->db->join('users as u','u.id =i.created_by','inner');
                        $this->db->where('taxo.name','salary');
                        $res = $this->db->where('i.id',$val->id);
                        $temp4 = $this->db->get();
                        $temp5[] =$temp4->result();
                    }
                    
                    $result1['salary'] = $temp5;    
//                    print_r($result1);
                    }
                    return($result1);
                    
    }
    
    function keyword_search($start)
    {
       $keyword = $this->input->post('search');
       
       $this->db->select('id');
       $this->db->from('items');
       $this->db->like('name',$keyword);
       $this->db->or_like('title',$keyword);
       $this->db->or_like('body',$keyword);
       $this->db->limit(5, $start);
       $query = $this->db->get();
       
       if($query->num_rows()>0)
       {
           $var = $query->result_array();
           $arr = array();
           
           foreach ($var as $va) {
               
               $arr[] = $va['id'];
           }
           
           return $this->view_detail($arr);
           
       }
 else {
            
       }
       
    }
    
    
    function apply_theme()
    {
        $this->db->select('id');
        $this->db->from('theme');
        $this->db->where('status','1');
        $query = $this->db->get();
        
        
//        var_dump($res);
        if($query->num_rows()>0)
        {
        $res = $query->result_array();
        $this->db->where('theme_id',$res['0']['id']);
        $result =  $this->db->get('theme_value');
        if($result->num_rows()>0)
        return $result->result_array();
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
    
}

?>
