<?php
class M_instances extends CI_Model
{
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }
    
    public function checkLogin($_vendorname, $_vendorpass) {
        $this->db->select('*');
        $this->db->from('api');
        $this->db->where(array('API_VENDOR_NAME'=> $_vendorname, 'API_VENDOR_PASS'=>md5($_vendorpass)));
        $query = $this->db->get();
        if(count($query->result_array()) > 0) return true;
        else return false;
    }
    
    public function saveAccessKey($_vendorname, $_accesskey, $_expire) {
        $data = array(
           'API_KEY' => $_accesskey,
           'API_EXPIRE' => $_expire
        );

        $this->db->where('API_VENDOR_NAME', $_vendorname);
        $resp = $this->db->update('api', $data);
        
        return $resp;
    }
    
    public function getAccess($_accesskey) {
        $this->db->select('*');
        $this->db->from('api');
        $this->db->where('API_KEY',$_accesskey);
        $query = $this->db->get();
        if(count($query->result_array()) > 0) return true;
        else return false;
    }
    
}
?>