<?php
class M_group extends CI_Model
{
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }
    
    public function getAll($limit=null){
        
        $this->db->select('*');
        $this->db->from('master_group');
        $this->db->order_by('M_GROUP_ID', 'asc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    public function getValid($limit=null){
        
        $this->db->select('*');
        $this->db->from('master_group');
        $this->db->where('IS_SHOW', true);
        $this->db->order_by('M_GROUP_ID', 'asc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    public function getByID($_id) {
        $this->db->select('*');
        $this->db->from('master_group');
        $this->db->where('M_GROUP_ID', $_id);
        $this->db->order_by('M_GROUP_ID', 'asc');
        $query = $this->db->get();
        return $query;
    }
    function add($data){
        $resp = $this->db->insert('master_group', $data);
        return $resp;
    }
    
    function set($id, $data){
        $this->db->where('M_GROUP_ID', $id);
        $resp = $this->db->update('master_group', $data);
        return $resp;
    }
    
    function delete($id){
        $resp = $this->db->delete('master_group', array('M_GROUP_ID' => $id));
        return $resp;
    }
    
    
    function setActiveByID($_groupid, $active) {
        $data = array("IS_SHOW"=>$active);
        $this->db->where('M_GROUP_ID', $_groupid);
        $resp = $this->db->update('master_group', $data);
        return $resp;
    }
}
?>