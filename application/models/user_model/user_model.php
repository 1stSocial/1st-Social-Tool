<?php
 
class User_model extends CI_Model
{
    function get_parent()
    {
         
    }
    
    function page_count($page,$b_id=FALSE)
    {
        $cou = 0;
        switch ($page) {
            case 'post_job':
            {
//                $this->db->select('i.*,u.name as user_name');
//                    
//                $this->db->from('items as i');
//                $this->db->join('users as u','u.id =i.created_by','inner');
//                if($b_id)
//                {
//                    $this->db->where('i.board_id',$b_id);
//                }
//        //      $this->db->distinct();
//                $result = $this->db->get();
//                return $result->num_rows();
                
                  $result1['item'] = array();
      //$result = $this->db->query('select u.name as user_name,i.* from items i inner join users u on u.id =i.created_by ');
              
          $type  = $this->db->get_where('board',array('id'=>$b_id));
          if($type->num_rows()>0)
          {
                $val = $type->result_array();
//                var_dump($val);
                $res = $val['0']['parent_tags'];
                $par_tags =  explode(',', $res);
                $cou = count(explode(',', $res));
          }
            if($cou == 0)
            {
                return 0;
            }
                if($cou == 1)
                {
                    $this->db->select('i.*,u.name as user_name');
//                    $this->db->where('i.status',1);
                    $this->db->from('items as i');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    if($b_id)
                    {
                        $this->db->where('board_id',$b_id);
                    }
                    $this->db->order_by('createdTime','DESC');
                    $result = $this->db->get();
                      if($result->num_rows()>0)
                    {
                        $result1['item'] = $result->result();
                    }
                }
                else 
                {
                   
                        $this->db->select('i.*,u.name as user_name');
//                    $this->db->where('i.status',1);
                    $this->db->from('items as i');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    
                        $this->db->where_in('parent_tag_id',$par_tags);
                    $this->db->order_by('createdTime','DESC');
                    $result = $this->db->get();
                        if($result->num_rows()>0)
                        {
                            $result1['item'] = $result->result();
                        }
                    
                }
                return count($result1['item']); 
            }break;

            case 'refine_job_salary':
            {

                $max = $this->input->post('max');
                $min = $this->input->post('min');
                $taxoid = $this->input->post('taxoid');
                
                $type  = $this->db->get_where('board',array('id'=>$b_id));


                $this->db->select('i.*,taxo.id,t.item_id as id,u.name as user_name,t.value as val');
                $this->db->from('taxonomy as taxo');
//                $this->db->where('i.status',1);
                $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
                $this->db->join('items as i','i.id=t.item_id','inner');
                $this->db->join('users as u','u.id =i.created_by','inner');
        //        $this->db->where('taxo.name','salary');
                $this->db->where("t.value BETWEEN $min AND $max");
                $this->db->where('t.taxo_id',$taxoid);
                
                if($b_id)
                    {
                        if($type->num_rows()>0)
                      {
                            $val = $type->result_array();
            //                var_dump($val);
                            $res = $val['0']['parent_tags'];
                            $par_tags =  explode(',', $res);
                            $cou = count(explode(',', $res));
                      }
                        if($cou == 0)
                        {
                            die;
                        }
                            if($cou == 1)
                            {
                                $this->db->where('i.board_id',$b_id);
                            }
                            else
                            {
                                $this->db->where_in('i.parent_tag_id',$par_tags);
                            }

                    }
                   $result = $this->db->get();
                  
                   return $result->num_rows();
                   
            }break;
            
            case 'keyword_search':
            {
                $keyword = $this->input->post('search');
                $this->db->select('*');
                $this->db->from('items');
//                $this->db->where('status',1);
                $this->db->like('name',$keyword);
                $this->db->or_like('title',$keyword);
                $this->db->or_like('body',$keyword);
                $query = $this->db->get();
       
                if($query->num_rows()>0)
                {

                    $var = $query->result_array();
         //          var_dump($var);die;
                    $arr = array();
                    if($b_id)
                    {
                         $type  = $this->db->get_where('board',array('id'=>$b_id));
                            if($type->num_rows()>0)
                            {
                                  $val = $type->result_array();
                  //                var_dump($val);
                                  $res = $val['0']['parent_tags'];
                                  $par_tags =  explode(',', $res);
                                  $cou = count(explode(',', $res));
                            }   

                          if($cou == 1)
                          {
                                foreach ($var as $va) {
                                if($va['board_id'] == $board_id)
                                {
                                         $arr[] = $va['id'];
                                }
                                }
                          }
                          else
                          {
                              foreach ($var as $va) {
                                if(in_array($va['parent_tag_id'], $par_tags))
                                    {
                                             $arr[] = $va['id'];
                                    }
                                }
                          }
//                    foreach ($var as $va) {
//                        if($va['board_id'] == $b_id)
//                        $arr[] = $va['id'];
                    }
                    return count($arr) ;
                    }

                }
            }break;
        } 
       
        
    
    
    function refine_post_count($id,$b_id=FALSE)
    {
        $data = array();
        $data1 = array();
        $temp1 = array();
       $result1 = array();
        $key =array();
        
                  $this->db->select('item_id');
                $this->db->from('item_tags');
                $this->db->where_in('tag_id',$id);
                $result = $this->db->get();
              
                if($result->num_rows()>0)
                {
                $data = $result->result();
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
        
                if((count($id))-1 == 1)
                {   
                  
                    if(!is_array($temp1))
                    {
                        $key = $temp1;
                        
                    }
                }
                if(count($id)-1 == 0) 
                {
                    return $this->post_job();
//                    die;
                }
                
                $type  = $this->db->get_where('board',array('id'=>$b_id));
         
                
                if(count($key))
               {
//                    var_dump($key);
                    $this->db->select('*');
                    $this->db->from('items');
//                    $this->db->where('status',1);
                    if($b_id)
                    {
                        
                        if($type->num_rows()>0)
                        {
                              $val = $type->result_array();
              //                var_dump($val);
                              $res = $val['0']['parent_tags'];
                              $par_tags =  explode(',', $res);
                              $cou = count(explode(',', $res));
                        }
                        if($cou == 1)
                        $this->db->where('board_id',$b_id);
                    }
                    $this->db->where_in('id',$key);
                    $tem = $this->db->get();
                    return $tem->num_rows();
               }
               else
               {
                   return '0';
               }
    } 
    function post_job($start,$board_id =  FALSE)
    {
        $result1 = array();
      //$result = $this->db->query('select u.name as user_name,i.* from items i inner join users u on u.id =i.created_by ');
              
//        echo $board_id;
          $type  = $this->db->get_where('board',array('id'=>$board_id));
          if($type->num_rows()>0)
          {
                $val = $type->result_array();
//                var_dump($val);
                $res = $val['0']['parent_tags'];
                $par_tags =  explode(',', $res);
                $cou = count(explode(',', $res));
          }
            if($cou == 0)
            {
                die;
            }
                if($cou == 1)
                {
                    $this->db->select('i.*,u.name as user_name');
                    
                    $this->db->from('items as i');
//                    $this->db->where('status',1);
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    if($board_id)
                    {
                        $this->db->where('board_id',$board_id);
                    }
                    $this->db->order_by('createdTime','DESC');
                    $this->db->limit(5, $start);
                    $result = $this->db->get();
                      if($result->num_rows()>0)
                    {
                        $result1['item'] = $result->result();
                    }
                    else
                    {
                        return("");
                    }
                }
                else 
                {
                    $this->db->select('i.*,u.name as user_name');
                    
                    $this->db->from('items as i');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                    $this->db->limit(5, $start);
                        $this->db->where_in('parent_tag_id',$par_tags);
                    $this->db->order_by('createdTime','DESC');
                    $result = $this->db->get();
                        if($result->num_rows()>0)
                        {
                            $result1['item'] = $result->result();
                        }
                        else
                        {
                            die;
                        }
                }
                  
//                    var_dump($result1['item']);
//                    die;    
                 if(count ($result1['item']) > 0)
                 {
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
                        if($board_id)
                        {
                            $new_temp = $this->db->get_where('board', array('id'=>$board_id));
                                $tag_id = $new_temp->result_array();
        //                        var_dump($tag_id);die;
                                $t_id = $tag_id['0']['Filterable_taxo'];
                        }
                        else
                        {
                            $t_id = 2;
                        }
                                
                        $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
                        $this->db->from('taxonomy as taxo');
                        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
                        $this->db->join('items as i','i.id=t.item_id','inner');
                        $this->db->join('users as u','u.id =i.created_by','inner');
                        $this->db->where('taxo.id',$t_id);
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
                    
                        $temp7 = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('it.item_id,taxo.id,it.value,taxo.name');
                        $this->db->from('item_taxo as it');
                        $this->db->join('taxonomy as taxo','taxo.id = it.taxo_id','inner');
                        $this->db->where('it.item_id',$val->id);
                        $temp6 = $this->db->get();
                        $temp7[] =  $temp6->result();
                    }    
                    $result1['taxonomy'] = $temp7;
                    
                    }
//                    print_r($result1);die;
//        var_dump($result1['taxonomy']);die; 
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
//                $this->db->order_by('createdTime','DESC');
         
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
        
                if((count($id))-1 == 1)
                {              
                    if(!is_array($temp1))
                    {
                        $key = $temp1;
                    }
                }
                if(count($id)-1 == 0) 
                {
                    return $this->post_job();
//                    die;
                }
//                var_dump($key);die;
         $type  = $this->db->get_where('board',array('id'=>$board_id));
         
               if(count($key))
               {
                    $this->db->select('i.*,t.item_id ,u.name as user_name');
//                    $this->db->where('i.status',1);
                    $this->db->from('item_tags as t');
                    $this->db->join('items as i','i.id=t.item_id','inner');
                    $this->db->join('users as u','u.id =i.created_by','inner');
                     $this->db->limit(5, $start);
                    $this->db->where_in('i.id',$key);
                    if($board_id)
                    {
                        //$this->db->where('i.board_id',$board_id);
                        
                        if($type->num_rows()>0)
                        {
                              $val = $type->result_array();
              //                var_dump($val);
                              $res = $val['0']['parent_tags'];
                              $par_tags =  explode(',', $res);
                              $cou = count(explode(',', $res));
                        }
                        if($cou == 1)
                        $this->db->where('board_id',$board_id);
                        
                    }
//                    $this->db->order_by('createdTime','DESC');
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
                        if($board_id)
                        {
                            $new_temp = $this->db->get_where('board', array('id'=>$board_id));
                                $tag_id = $new_temp->result_array();
        //                        var_dump($tag_id);die;
                                $t_id = $tag_id['0']['Filterable_taxo'];
                        }
                        else
                        {
                            $t_id = 2;
                        }
                        
                        $this->db->select('i.*,taxo.id,t.item_id ,u.name as user_name,t.value as val');
                        $this->db->from('taxonomy as taxo');
                        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
                        $this->db->join('items as i','i.id=t.item_id','inner');
                        $this->db->join('users as u','u.id =i.created_by','inner');
                        $this->db->where('taxo.id',$t_id);
                        $res = $this->db->where('i.id',$val->id);
                        $temp4 = $this->db->get();
                        $temp5[] =$temp4->result();
                    }
                    
                    $result1['salary'] = $temp5;
                    
                    
                      $temp7 = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('it.item_id,taxo.id,it.value,taxo.name');
                        $this->db->from('item_taxo as it');
                        $this->db->join('taxonomy as taxo','taxo.id = it.taxo_id','inner');
                        $this->db->where('it.item_id',$val->id);
                        $temp6 = $this->db->get();
                        $temp7[] =  $temp6->result();
                    }    
                    $result1['taxonomy'] = $temp7;
                    }
//                    var_dump($result1);die;
                    return($result1);
               }
                    
                    
       
    }
    
    function refine_job_salary($start,$board_id=FALSE)
    {
        $result1 = array();
        $max = $this->input->post('max');
        $min = $this->input->post('min');
        $taxoid = $this->input->post('taxoid');
        
         $type  = $this->db->get_where('board',array('id'=>$board_id));
         
        
        $this->db->select('i.*,taxo.id,t.item_id as id,u.name as user_name,t.value as val');
//        $this->db->where('i.status',1);
        $this->db->from('taxonomy as taxo');
        $this->db->join('item_taxo as t','t.taxo_id=taxo.id');
        $this->db->join('items as i','i.id=t.item_id','inner');
        $this->db->join('users as u','u.id =i.created_by','inner');
//        $this->db->where('taxo.name','salary');
        $this->db->where("t.value BETWEEN $min AND $max");
        $this->db->where('t.taxo_id',$taxoid);
        if($board_id)
        {
            if($type->num_rows()>0)
          {
                $val = $type->result_array();
//                var_dump($val);
                $res = $val['0']['parent_tags'];
                $par_tags =  explode(',', $res);
                $cou = count(explode(',', $res));
          }
            if($cou == 0)
            {
                die;
            }
                if($cou == 1)
                {
                    $this->db->where('i.board_id',$board_id);
                }
                else
                {
                    $this->db->where_in('i.parent_tag_id',$par_tags);
                }
            
        }
        
        $this->db->limit(5, $start);
       
//        $query = $this->db->get();
           $result = $this->db->get();
                    if($result->num_rows()>0)
                    {
                        $result1['item'] = $result->result();
//                        var_dump($result1['item']);die;
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
                        $this->db->join('tag_parent as t_p','taxo.tag_id=t_p.tag_id','inner');
                        $this->db->join('tags as tag','t_p.tag_id=tag.id','inner');
//                        $this->db->join('tags as tag','taxo.tag_id=tag.id','inner');
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
                    
                      $temp7 = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('it.item_id,taxo.id,it.value,taxo.name');
                        $this->db->from('item_taxo as it');
                        $this->db->join('taxonomy as taxo','taxo.id = it.taxo_id','inner');
                        $this->db->where('it.item_id',$val->id);
                        $temp6 = $this->db->get();
                        $temp7[] =  $temp6->result();
                    }    
                    $result1['taxonomy'] = $temp7;
                    
                    }
//                    var_dump($result1);
//                    die;
                   
                    return($result1);
    }
    
    function latest_job($board_id = FALSE)
    {
        $type  = $this->db->get_where('board',array('id'=>$board_id));
          if($type->num_rows()>0)
          {
                $val = $type->result_array();
//                var_dump($val);
                $res = $val['0']['parent_tags'];
                $par_tags =  explode(',', $res);
                $cou = count(explode(',', $res));
          }
            if($cou == 0)
            {
               die;
            }
                if($cou == 1)
                {
                    $this->db->select('items.id,items.name,items.title,items.createdTime,items.board_id');
                    $this->db->from('items');
//                    $this->db->where('status',1);
                    if($board_id)
                    $this->db->where('board_id',$board_id);
                    $this->db->order_by('createdTime','DESC');
                    $this->db->limit(5);
                    $query = $this->db->get();
                }
                else
                {
                    $this->db->select('items.id,items.name,items.title,items.createdTime,items.board_id');
                    $this->db->from('items');
               
                    $this->db->where_in('parent_tag_id',$res);
                    $this->db->order_by('createdTime','DESC');
                    $this->db->limit(5);
                    $query = $this->db->get();
                }
        if($query->num_rows()>0)
            
        {
            return $query->result_array();
        }
    }
    
    function taxo_val($bid = FALSE)
    {
        $this->db->select('Filterable_taxo');
        $this->db->from('board');
        if($bid)
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
//                    var_dump($result1['item']);
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
                    
                      $temp7 = array();
                    foreach ($result1['item'] as $val)
                    {
                        $this->db->select('it.item_id,taxo.id,it.value,taxo.name');
                        $this->db->from('item_taxo as it');
                        $this->db->join('taxonomy as taxo','taxo.id = it.taxo_id','inner');
                        $this->db->where('it.item_id',$val->id);
                        $temp6 = $this->db->get();
                        $temp7[] =  $temp6->result();
                    }    
                    $result1['taxonomy'] = $temp7;
                    
//                    print_r($result1);
                    }
                    return($result1);
                    
    }
    
    function keyword_search($start,$board_id=FALSE)
    {
//     echo $board_id;
        
     
        
       $keyword = $this->input->post('search');
           $this->db->select('*');
//           $this->db->where('status',1);
            $this->db->from('items');
            $this->db->like('name',$keyword);
            $this->db->or_like('title',$keyword);
            $this->db->or_like('body',$keyword);
        
            $query = $this->db->get();
       
       if($query->num_rows()>0)
       {
           
           
           
           $var = $query->result_array();
           $arr = array();
           if($board_id)
           {
               if(!$start)
               {
                   
                   $start=0;
                    $i = 0;
               }
               else
               {    
                     $i = $start;
               }
               
               $type  = $this->db->get_where('board',array('id'=>$board_id));
                if($type->num_rows()>0)
                {
                      $val = $type->result_array();
      //                var_dump($val);
                      $res = $val['0']['parent_tags'];
                      $par_tags =  explode(',', $res);
                      $cou = count(explode(',', $res));
                }   
               
              if($cou == 1)
              {
                    foreach ($var as $va) {
                    if($va['board_id'] == $board_id)
                    {
                             $arr[] = $va['id'];
                    }
                    }
              }
              else
              {
                  foreach ($var as $va) {
                    if(in_array($va['parent_tag_id'], $par_tags))
                        {
                                 $arr[] = $va['id'];
                        }
                    }
              }
           $new = array();
           
           for($i=$start;$i<$start+5;$i++)
           {
               if($i < count($arr))
               $new[] = $arr[$i];
           }
           
           return $this->view_detail($new);
           }
       
       }
    else 
     {
            
     }
       
    }
    
    
    function apply_theme()
    {
        $this->db->select('id');
        $this->db->from('theme');
//        $this->db->where('status','1');
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
        {
            return $query->result();
        }
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
    
    function btn_name($id)
    {
        $val  =  $this->db->get_where('board',array('id'=>$id));
        if($val->num_rows())
        {
            $val2  = $val->result_array();
            return $val2[0]['call_to_action'];
        }
    }
    
}

?>
