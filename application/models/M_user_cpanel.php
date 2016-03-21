<?php
class M_user_cpanel extends CI_Model
{
    public function __construct()
    {
            parent::__construct();
            $this->load->database();
    }

    public function setPassByName($username, $passwd){
        $options = [ 'cost' => 13 ];
        $encPass = password_hash($passwd, PASSWORD_BCRYPT, $options);
        $data = array('USER_CPANEL_PASS'=> $encPass);
        $this->db->where('USER_CPANEL_USERNAME', $username);
        $res = $this->db->update('user_cpanel', $data);
        if($res) {
            $res = $this->getUserByName($username);
            if ($res->num_rows() > 0)  { return $res->row(); }
            else { return FALSE; } 
        }
        return $res;
    }

    function getUserByName($_username) {
        $user = $this->db->get_where('user_cpanel', "USER_CPANEL_USERNAME='".$_username."'");

        return $user;
    }
    
    public function setUserByName($_username, $logo) {
            $_NAME = $this->input->post('user_name');
            $data = array(
               'USER_CPANEL_NAME' => $_NAME,
               'USER_CPANEL_LOGO' => $logo,
            );

            $this->db->where('USER_CPANEL_USERNAME', $_username);
            $res = $this->db->update('user_cpanel', $data);
            if($res) {
                $res = $this->getUserByName($_username);
                if ($res->num_rows() > 0)  { return $res->row(); }
                else { return FALSE; } 
            }
            return $res;
        }

}
?>