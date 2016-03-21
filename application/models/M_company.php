<?php
class M_company extends CI_Model
{
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }
    
    public function getAll($limit=null){
        
        $this->db->select('*');
        $this->db->from('company');
        $this->db->order_by('COMPANY_ID', 'asc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    public function getByID($_id) {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('COMPANY_ID', $_id);
        $this->db->order_by('COMPANY_ID', 'asc');
        $query = $this->db->get();
        return $query;
    }
    
    function add($data){
        $resp = $this->db->insert('company', $data);
        return $resp;
    }
    
    function set($id, $data){
        $this->db->where('COMPANY_ID', $id);
        $resp = $this->db->update('company', $data);
        return $resp;
    }
    
    function delete($id){
        $resp = $this->db->delete('company', array('COMPANY_ID' => $id));
        return $resp;
    }
    
    function setActiveByID($_companyid, $active) {
        $data = array("IS_SHOW"=>$active);
        $this->db->where('COMPANY_ID', $_companyid);
        $resp = $this->db->update('company', $data);
        return $resp;
    }
    
}
?>