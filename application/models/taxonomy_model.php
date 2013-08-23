<?php
class Taxonomy_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    
    }
    function add_taxonomy()
    { 
    
        $data = array(  
                        
                        'tag_id' => $this->input->post('parentid'),
                        'taxonomy_id' => NULL,
                        'name'=>$this->input->post('taxonomyname'),
                        'type' => $this->input->post('type'),
                    );
        $this->db->insert('taxonomy',$data);
        
    }
    function delete_taxonomy($id)
    {
        $this->db->delete('taxonomy',array('id'=>$id));
    }
    
    function get_taxonomy($id = '')
    {
        if($id == ''){
            $this->db->select('taxonomy.id,taxonomy.name,taxonomy.type,taxonomy.value,tags.name as parenttag');
            $this->db->from('taxonomy');
            $this->db->join('tags','tags.id=taxonomy.tag_id');
        $query = $this->db->get();
        //echo 'if';
        }else{
            $this->db->where(array('id'=>$id));
            $query = $this->db->get('taxonomy');
          
        }
        return $query->result();
        }
        function update_taxonomy()
        {    
            $data = array('name'=>$this->input->post('taxonomyname'),
                           'type'=>$this->input->post('type'),   
                            'tag_id' =>$this->input->post('tag_id'));  
            
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('taxonomy',$data);
        }
    
} 

?>
