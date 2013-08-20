<?php
class Taxonomy_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    
    }
    function add_taxonomy()
    { 
    
        $data = array(  
                        
                        'tag_id' => NULL,
                        'taxonomy_id' => NULL,
                        'name'=>$this->input->post('taxonomyname'),
                        'type'=>$this->input->post('taxonomytype'),
                        'value'=>$this->input->post('taxonomyvalue')     
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
        $query = $this->db->get('taxonomy');
        
        }else{
            $this->db->where(array('id'=>$id));
            $query = $this->db->get('taxonomy');
          
        }
        return $query->result();
        }
        function update_taxonomy()
        {
            $data = array('name'=>$this->input->post('taxonomyname'),
                        'value'=>$this->input->post('taxonomyvalue'),
                        'type'=>$this->input->post('taxonomytype')
                        );
                    
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('taxonomy',$data);
        }
    
}
?>
