<?php
class M_task extends CI_Model
{
    public function __construct() {
            parent::__construct();
            $this->load->database();
    }
    
    public function getAll($limit=null){
        
        $this->db->select('*, task.IS_SHOW as IS_SHOW');
        $this->db->from('task');
        $this->db->join('company', 'task.COMPANY_ID=company.COMPANY_ID');
        $this->db->order_by('TASK_ID', 'desc');
        if($limit) { $this->db->limit($limit); }
        $query = $this->db->get();
        return $query;
    }
    
    public function getAllByUser($userid){
        
        $this->db->select('*');
        $this->db->from('task');
        $this->db->join('company', 'task.COMPANY_ID=company.COMPANY_ID');
        $this->db->join('task_assignment', 'task_assignment.TASK_ID=task.TASK_ID');
        $this->db->where('task_assignment.USER_ID', $userid);
        $this->db->order_by('task.TASK_ID', 'desc');
        $query = $this->db->get();
        return $query;
    }
    
    public function getValidByUser($userid){
        
        $this->db->select('*');
        $this->db->from('task');
        $this->db->join('company', 'task.COMPANY_ID=company.COMPANY_ID');
        $this->db->join('task_assignment', 'task_assignment.TASK_ID=task.TASK_ID');
        $this->db->where(array('task_assignment.USER_ID'=>$userid, 'task.IS_SHOW'=> true));
        $this->db->order_by('task.TASK_ID', 'desc');
        $query = $this->db->get();
        return $query;
    }
    
    public function getByID($_id) {
        $this->db->select('*');
        $this->db->from('task');
        $this->db->join('company', 'task.COMPANY_ID=company.COMPANY_ID');
        $this->db->where('TASK_ID', $_id);
        $this->db->order_by('TASK_ID', 'desc');
        $query = $this->db->get();
        return $query;
    }
    
    public function getDetailByID($_id) {
        $this->db->select('*');
        $this->db->from('task_detail');
        $this->db->where('TASK_ID', $_id);
        $this->db->order_by('TASK_DETAIL_ID', 'desc');
        $query = $this->db->get();
        return $query;
    }
    
    public function setDetailById($data, $task_id) {
            
            $this->db->delete('task_detail', array('TASK_ID' => $task_id)); 
            $cnt = count($data['titles']);
            for($i=0; $i<$cnt; $i++){
                if($data['titles'][$i]){
                    $d = array(
                        "TASK_DETAIL_DESC" => $data['titles'][$i],
                        "TASK_ID" => $task_id
                    );
                    $res = $this->db->insert('task_detail', $d);
                }

            }
            return $res;
        }
    
    function addTask($data){
        $status = $this->db->insert('task', $data);
        return $status;
    }
    
    function setTaskByID($_taskid, $data) {
        $this->db->where('TASK_ID', $_taskid);
        $res = $this->db->update('task', $data);

        return $res;
   }
    
    function setNotesByID($_taskid, $_notes) {
        $data = array(
            'TASK_NOTE' => $_notes,
         );

         $this->db->where('TASK_ID', $_taskid);
         $res = $this->db->update('task', $data);

         return $res;
    }
    
    function setActiveByID($_taskid, $active) {
        $data = array("IS_SHOW"=>$active);
        $this->db->where('TASK_ID', $_taskid);
        $resp = $this->db->update('task', $data);
        return $resp;
    }
    
    function clearAssignment($task_id) {
        $status = $this->db->delete('task_assignment', array('TASK_ID' => $task_id)); 
        return $status;
    }

    function setAssignment($task_id, $user_id) {
        $data = array(
            "TASK_ID" => $task_id,
            "USER_ID" => $user_id,
        );

        $status = $this->db->insert('task_assignment', $data);
        return $status;
    }
    
    function getTaskAssignment($task_id) {
        $this->db->select('*');
       $this->db->from('task_assignment');
       $this->db->join('user', 'user.USER_ID=task_assignment.USER_ID');
       $this->db->order_by('TASK_ASS_ID', 'asc');
       $this->db->where(array('task_assignment.TASK_ID' => $task_id));
       $query = $this->db->get();
       return $query;
    }
    
    function delTask($_taskid) {
        $status = $this->db->delete('task', array('TASK_ID' => $_taskid)); 
        return $status;
    }
}
?>