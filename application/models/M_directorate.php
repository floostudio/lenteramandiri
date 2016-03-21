<?php
class M_directorate extends CI_Model
{
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }
    
    public function getAll($limit=null){
        
        $this->db->select('*');
        $this->db->from('master_directorate');
        $this->db->order_by('M_DIRECTORATE_ID', 'asc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    function getValid($limit=null){
        $this->db->select('*');
        $this->db->from('master_directorate');
        $this->db->where('IS_SHOW', true);
        $this->db->order_by('M_DIRECTORATE_ID', 'asc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    public function getByID($_id) {
        $this->db->select('*');
        $this->db->from('master_directorate');
        $this->db->where('M_DIRECTORATE_ID', $_id);
        $this->db->order_by('M_DIRECTORATE_ID', 'asc');
        $query = $this->db->get();
        return $query;
    }
    
    function add($data){
        $resp = $this->db->insert('master_directorate', $data);
        return $resp;
    }
    
    function set($id, $data){
        $this->db->where('M_DIRECTORATE_ID', $id);
        $resp = $this->db->update('master_directorate', $data);
        return $resp;
    }
    
    function delete($id){
        $resp = $this->db->delete('master_directorate', array('M_DIRECTORATE_ID' => $id));
        return $resp;
    }
    
    function setActiveByID($_directorateid, $active) {
        $data = array("IS_SHOW"=>$active);
        $this->db->where('M_DIRECTORATE_ID', $_directorateid);
        $resp = $this->db->update('master_directorate', $data);
        return $resp;
    }
}
?>