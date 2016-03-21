<?php
class M_user extends CI_Model
{
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }
    
    function getAll() {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('master_directorate', 'user.USER_DIRECTORATE=master_directorate.M_DIRECTORATE_ID');
        $this->db->join('master_group', 'user.USER_GROUP=master_group.M_GROUP_ID');
        $this->db->join('master_department', 'user.USER_DEPARTMENT=master_department.M_DEPARTMENT_ID');
        $this->db->join('master_title', 'user.USER_TITLE=master_title.M_TITLE_ID');
        $this->db->order_by('USER_ID', 'asc');
        $users = $this->db->get();
        return $users;
    }
    
    function getUserByID($_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('USER_ID', $_id);
        $this->db->order_by('USER_ID', 'asc');
        $query = $this->db->get();
        return $query;
    }
    
    function getAccess($email, $password) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('master_title', 'user.USER_TITLE=master_title.M_TITLE_ID');
        $this->db->where('USER_EMAIL', $email);
        $user = $this->db->get()->result_array();
        if(count($user)>0) {
            $isCorrect = password_verify($password, $user[0]['USER_PASS']);
            if($isCorrect) {
                return $user[0];
            } else {
                return false;
            }
        } else return false;
    }
    
    function registerUser($_data) {
        $options = [ 'cost' => 13 ];
        $encPass = password_hash($_data['password'], PASSWORD_BCRYPT, $options);
        
        $data = array(
            'USER_FIRST_NAME' => $_data['first_name'],
            'USER_LAST_NAME' => $_data['last_name'],
            'USER_NIP' => $_data['nip'],
            'USER_DIRECTORATE' => $_data['directorate'],
            'USER_GROUP' => $_data['group'],
            'USER_DEPARTMENT' => $_data['department'],
            'USER_EMAIL' => $_data['email'],
            'USER_TITLE' => $_data['title'],
            'USER_PASS' => $encPass,
            'USER_IMG' => "static/images/users/default.png",
            'IS_ACTIVE' => false
        );
        $res = $this->db->insert('user', $data);
        if($res) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return $res;
        }
    }
    
    function addUser($_data) {
        $res = $this->db->insert('user', $_data);
        if($res) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return $res;
        }
    }
    
    public function getDetailByID($_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('master_directorate', 'user.USER_DIRECTORATE=master_directorate.M_DIRECTORATE_ID');
        $this->db->join('master_group', 'user.USER_GROUP=master_group.M_GROUP_ID');
        $this->db->join('master_department', 'user.USER_DEPARTMENT=master_department.M_DEPARTMENT_ID');
        $this->db->join('master_title', 'user.USER_TITLE=master_title.M_TITLE_ID');
        $this->db->where('USER_ID', $_id);
        $this->db->order_by('USER_ID', 'desc');
        $query = $this->db->get();
        return $query;
    }
    
    function checkRegistered($_email){
        $user = $this->db->get_where('user', "USER_EMAIL='".$_email."'")->result_array();
        
        if(count($user)>0) {
            return true;
        } else return false;
    }
    
    function getActiveByID($_userid) {
        $resp = $this->db->get_where('user', "USER_ID='".$_userid."'")->result();
        return $resp[0]->IS_ACTIVE;
    }
    
    function getActiveByEmail($_email) {
        $resp = $this->db->get_where('user', "USER_EMAIL='".$_email."'")->result();
        return $resp[0]->IS_ACTIVE;
    }
    
    function setActiveByID($_userid, $active) {
        $data = array("IS_ACTIVE"=>$active);
        $this->db->where('USER_ID', $_userid);
        $resp = $this->db->update('user', $data);
        return $resp;
    }
    
    function setDetailByID($_userid, $_data) {
        $data = array(
            'USER_FIRST_NAME' => $_data['first_name'],
            'USER_LAST_NAME' => $_data['last_name'],
            'USER_NIP' => $_data['nip'],
            'USER_DIRECTORATE' => $_data['directorate'],
            'USER_GROUP' => $_data['group'],
            'USER_DEPARTMENT' => $_data['department'],
            'USER_EMAIL' => $_data['email'],
            'USER_TITLE' => $_data['title'],
            'USER_IMG' => $_data['profpic']
        );

        $this->db->where('USER_ID', $_userid);
        $res = $this->db->update('user', $data);

         return $res;
    }
    
    function setPasswordByID($_id, $_newpassword) {
 
        $options = [ 'cost' => 13 ];
        $encPass = password_hash($_newpassword, PASSWORD_BCRYPT, $options);
        
        $data = array(
            'USER_PASS' => $encPass,
        );

        $this->db->where('USER_ID', $_id);
        $resp = $this->db->update('user', $data);

        return $resp;
        
    }
    function setPasswordByEmail($_email, $_newpassword) {
 
        $options = [ 'cost' => 13 ];
        $encPass = password_hash($_newpassword, PASSWORD_BCRYPT, $options);
        
        $data = array(
            'USER_PASS' => $encPass,
        );

        $this->db->where('USER_EMAIL', $_email);
        $resp = $this->db->update('user', $data);

        return $resp;
        
    }
    
}
?>