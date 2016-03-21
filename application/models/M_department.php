<?php
class M_department extends CI_Model
{
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }
    
    public function getAll($limit=null){
        
        $this->db->select('*');
        $this->db->from('master_department');
        $this->db->order_by('M_DEPARTMENT_ID', 'asc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    public function getValid($limit=null){
        
        $this->db->select('*');
        $this->db->from('master_department');
        $this->db->where('IS_SHOW', true);
        $this->db->order_by('M_DEPARTMENT_ID', 'asc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    public function getByID($_id) {
        $this->db->select('*');
        $this->db->from('master_department');
        $this->db->where('M_DEPARTMENT_ID', $_id);
        $this->db->order_by('M_DEPARTMENT_ID', 'asc');
        $query = $this->db->get();
        return $query;
    }
    
    function add($data){
        $resp = $this->db->insert('master_department', $data);
        return $resp;
    }
    
    function set($id, $data){
        $this->db->where('M_DEPARTMENT_ID', $id);
        $resp = $this->db->update('master_department', $data);
        return $resp;
    }
    
    function delete($id){
        $resp = $this->db->delete('master_department', array('M_DEPARTMENT_ID' => $id));
        return $resp;
    }
    
    function setActiveByID($_departmentid, $active) {
        $data = array("IS_SHOW"=>$active);
        $this->db->where('M_DEPARTMENT_ID', $_departmentid);
        $resp = $this->db->update('master_department', $data);
        return $resp;
    }
}
?>