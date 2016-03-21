<?php
class M_news extends CI_Model
{
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }
    
    public function getAll($limit=null){
        
        $this->db->select('*');
        $this->db->from('news');
        $this->db->order_by('NEWS_ID', 'desc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    function getValid($limit=null) {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('IS_SHOW', true);
        $this->db->order_by('NEWS_ID', 'desc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    public function getByID($_id) {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('NEWS_ID', $_id);
        $this->db->order_by('NEWS_ID', 'desc');
        $query = $this->db->get();
        return $query;
    }
    
    function addNews($data){
        $this->db->set('NEWS_DATE', 'NOW()', FALSE);
        $status = $this->db->insert('news', $data);
        return $status;
    }
    
    function setNewsByID($_newsid, $data) {
        $this->db->where('NEWS_ID', $_newsid);
        $res = $this->db->update('news', $data);

        return $res;
    }
   
    function setActiveByID($_newsid, $active) {
        $data = array("IS_SHOW"=>$active);
        $this->db->where('NEWS_ID', $_newsid);
        $resp = $this->db->update('news', $data);
        return $resp;
    }
   
   function delNews($_newsid) {
        $status = $this->db->delete('news', array('NEWS_ID' => $_newsid)); 
        return $status;
   }
}
?>