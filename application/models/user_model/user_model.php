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
    function post_job($start,$board_id =  FALSE)
    {
        $result1 = array();
      //$result = $this->db->query('select u.name as user_name,i.* from items i inner join users u on u.id =i.created_by ');
                    
                    $this->db->select('i.*,u.name as user_name');
                    
                    $this->db->from('items as i');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    if($board_id)
                    {
                        $this->db->where('board_id',$board_id);
                    }
                     $this->db->limit(5, $start);
//                    $this->db->distinct();
                    $result = $this->db->get();
                    if($result->num_rows()>0)
                    {
                    $result1['item'] = $result->result();
//                    var_dump($result1['item']);
//                    die;    
                    
                    $TEMP = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('tag_parent.parent_tag_id');
                        $this->db->from('item_tags as taxo');
//                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->join('tag_parent','taxo.tag_id=tag_parent.tag_id','inner');
                        $this->db->where('taxo.item_id',$val->id);
                        $this->db->distinct();
                        $temp1 = $this->db->get();
                        $T = $temp1->result();
//                        var_dump($T);
//                        die;
                        $TEMP[] = $T;
                    }
                    $result1['parent'] = $TEMP;
                    
                    $temp=array();
                    
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('*');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tag_parent as t_p','taxo.tag_id=t_p.tag_id');
                        $this->db->join('tags as tag','t_p.tag_id=tag.id','inner');
                        $this->db->where('taxo.item_id',$val->id);
                        $this->db->distinct('tag.name');
                        $temp3 = $this->db->get();
                        $temp[] =$temp3->result();
                    }
                    
                    $result1['child'] = $temp;
//                    var_dump($result1['child']);die;    
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
                    
                      return($result1);
                    
                    
    }
    
    function refine_post_job($id,$start,$board_id=FALSE)
    {
        $data = array();
        $data1 = array();
        $temp1 = array();
       $result1 = array();
        $key =array();
                                              
            $this->db->select('item_id');
                $this->db->from('item_tags');
                $this->db->where_in('tag_id',$id);
//                $this->db->limit(5, $start);
                $result = $this->db->get();
                if($result->num_rows()>0)
                {
                $data = $result->result();
//                var_dump($data);die;
              //  $result = $this->db->query('select u.name as user_name,i.* from items i inner join users u on u.id =i.created_by');
                    foreach ($data as $val)
                    {
                        $temp1[] = $val->item_id;
                    }
                    $temp = array_count_values($temp1);
                    foreach ($temp as $tempkey => $val)
                    {
                        if(count($id)-1 == $val)
                        {
                            $key[] = $tempkey;
                        }
                    }
                  
                }
        
                if(count($id)-1 == 1)
                {              
                    if(!is_array($temp1))
                    $key = $temp1;
                    
                }
                if(count($id)-1 == 0) 
                {
                    return $this->post_job();
                }
//                var_dump($key);
                    $this->db->select('i.*,t.item_id ,u.name as user_name');
                    $this->db->from('item_tags as t');
                    $this->db->join('items as i','i.id=t.item_id','inner');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    $this->db->where_in('i.id',$key);
                    if($board_id)
                    {
                        $this->db->where('i.board_id',$board_id);
                    }
                    $this->db->limit(5, $start);
                    $this->db->distinct();
                    $result = $this->db->get();
                    if($result->num_rows()>0)
                    {
                        $result1['item'] = $result->result();
//                        var_dump($result1['item']);die;
               $TEMP = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('t_p.parent_tag_id');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tag_parent as t_p','taxo.tag_id=t_p.tag_id');
                        $this->db->join('tags as tag','t_p.tag_id=tag.id','inner');
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
                        $this->db->select('*');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tag_parent as t_p','taxo.tag_id=t_p.tag_id');
                        $this->db->join('tags as tag','t_p.tag_id=tag.id','inner');
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
    
    function refine_job_salary($start,$board_id=FALSE)
    {
        $result1 = array();
        $max = $this->input->post('max');
        $min = $this->input->post('min');
        $taxoid = $this->input->post('taxoid');
        
        echo $taxoid;
        
        $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
        $this->db->from('taxonomy as taxo');
        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
        $this->db->join('items as i','i.id=t.item_id','inner');
        $this->db->join('users as u','u.id =i.created_by','inner');
        $this->db->where('taxo.name','salary');
        $this->db->where("t.value BETWEEN $min AND $max");
//        $this->db->where('t.taxo_id',$taxoid);
        if($board_id)
        {
            $this->db->where('i.board_id',$board_id);
        }
        
        $this->db->limit(5, $start);
       
//        $query = $this->db->get();
           $result = $this->db->get();
                    if($result->num_rows()>0)
                    {
                        $result1['item'] = $result->result();
//                        var_dump($result1['item']);
               $TEMP = array();
                    foreach ($result1['item'] as $val)
                    {
//                        $this->db->select('tag.parent_tag_id');
//                        $this->db->from('item_tags as taxo');
//                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
//                        $this->db->where('taxo.item_id',$val->item_id);
                         $this->db->select('t_p.parent_tag_id');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tag_parent as t_p','taxo.tag_id=t_p.tag_id','inner');
                        $this->db->join('tags as tag','t_p.tag_id=tag.id','inner');
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
                        $this->db->select('*');
                        $this->db->from('item_tags as taxo');
                        $this->db->join('tag_parent as t_p','taxo.tag_id=t_p.tag_id','inner');
                        $this->db->join('tags as tag','t_p.tag_id=tag.id','inner');
//                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
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
//                    var_dump($result1);
//                    die;
                    return($result1);
    }
    
    function latest_job($board_id = FALSE)
    {
        $this->db->select('items.id,items.name,items.title,items.createdTime');
        $this->db->from('items');
        if($board_id)
        $this->db->where('board_id',$board_id);
        
        $this->db->order_by('createdTime','DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        if($query->num_rows()>0)
            return $query->result_array();
        
    }
    
    function taxo_val($bid)
    {
        $this->db->select('Filterable_taxo');
        $this->db->from('board');
        $this->db->where('id',$bid);
        $res = $this->db->get();
        
        if($res->num_rows()>0)
        {
            $te = $res->result_array();
//            var_dump($te);die;
            $taxo = $te['0']['Filterable_taxo']; 
        }
        
        $val = array();
       
        $this->db->select("MAX(CAST(it.value AS SIGNED))");
        $this->db->from('item_taxo as it');
        $this->db->where('taxo_id',$taxo);
        
//        $this->db->where()
        $max = $this->db->get();
        if($max->num_rows()>0)
        {
            $res = $max->result_array();
            $temp =$res['0']['MAX(CAST(it.value AS SIGNED))'];
            $val['max'] =  intval($temp)/1000;
        }
        
        $this->db->select("MIN(CAST(it.value AS SIGNED))");
       $this->db->from('item_taxo as it');
        $this->db->where('taxo_id',$taxo);
        $max = $this->db->get();
        if($max->num_rows()>0)
        {
            $res = $max->result_array();
            $val['min'] = intval($res['0']['MIN(CAST(it.value AS SIGNED))'])/1000;
            if(!$val['min']<1)
            {
                $val['min'] = 0;
            }
        }
        
        $this->db->select('name');
        $this->db->from('taxonomy');
        $this->db->where('id',$taxo);
        $taxoname = $this->db->get();
        
        if($taxoname->num_rows()>0)
        {
            $t = $taxoname->result_array();
            $val['name'] = $t['0']['name'];
        }
        $val['taxoid'] =$taxo;
//        var_dump($val);die;
        
        return $val;
    }
            
    function view_detail($id)
    {
        $result1 = array();
      //$result = $this->db->query('select u.name as user_name,i.* from items i inner join users u on u.id =i.created_by ');
                    
                    $this->db->select('i.*,u.name as user_name');
                    
                    $this->db->from('items as i');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    if(is_array($id))
                    {
                        if(count($id))
                        {
                            $this->db->where_in('i.id',$id);
                            $result = $this->db->get();
                        }
                        else
                        {
                          
                            $this->db->where('i.id','1');
                            $result=  $this->db->get();
                        }
                        
                        
                    }
                    else 
                    {
                        $this->db->where('i.id',$id);
//                    $this->db->distinct();
                        $result = $this->db->get();
                    }
                    if($result->num_rows()>0)
                    {
                    $result1['item'] = $result->result();
//                    var_dump($result1['item']);die;
                    $TEMP = array();
                    foreach ($result1['item'] as $val)
                    {
//                        $this->db->select('tag.parent_tag_id');
//                        $this->db->from('item_tags as taxo');
////                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
//                        $this->db->join('tag_parent as tag','taxo.tag_id=tag_parent.tag_id');
////                        $this->db->where('taxo.item_id',$val->id);
//                        $this->db->where('taxo.item_id',$val->id);
                        $this->db->select('tag_parent.parent_tag_id');
                        $this->db->from('item_tags as taxo');
//                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->join('tag_parent','taxo.tag_id=tag_parent.tag_id');
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
                        $this->db->select('*');
                        $this->db->from('item_tags as taxo');
//                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
                        $this->db->join('tag_parent as t_p','taxo.tag_id=t_p.tag_id');
                        $this->db->join('tags as tag','t_p.tag_id=tag.id','inner');
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
    
    function keyword_search($start,$board_id=FALSE)
    {
       $keyword = $this->input->post('search');
           $this->db->select('*');
            $this->db->from('items');
            $this->db->like('name',$keyword);
            $this->db->or_like('title',$keyword);
            $this->db->or_like('body',$keyword);
            $this->db->limit(5, $start);
            $query = $this->db->get();
       
       if($query->num_rows()>0)
       {
           
           $var = $query->result_array();
//          var_dump($var);die;
           $arr = array();
//           if(!$board_id)
           {
           foreach ($var as $va) {
               
               $arr[] = $va['id'];
           }
           
           return $this->view_detail($arr);
           }
//           else
//           {
//             foreach ($var as $va) 
//                 {
//                        if($board_id == $va['board_id'])
//                        {
//                            $arr[] = $va['id'];
//                        }
//                 }
//                 return $this->view_detail($arr);
//           }
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
    
    function apply_theme2($id)
    {
        
        $temp = $this->db->get_where('board_page', array('board_id'=>$id));
        $val = $temp->result_array();
        $this->db->select('*');
        $this->db->from('theme_value');
        $this->db->where('theme_id',$val[0]['theme_id']); 
        $query = $this->db->get();
        
        
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return "";
        }
    }
    
    function get_boardid($name)
    {
        $query = $this->db->get_where('board', array('name'=>$name));
        if($query->num_rows()>0)
        return $query->result();
        else
        {
            return "";
        }
    }
    
    function board_exist($name)
    {
        $abc =  $this->db->get_where('board',array('name'=>$name));
        if($abc->num_rows())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
}

?>
