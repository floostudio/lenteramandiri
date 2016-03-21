<?php
class M_login extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
                $this->load->database();
	}
        
        public function checkLogin($username, $pass){
            
            $query = $this->db->select('*')
                    ->from('user_cpanel')
                    ->where(array('USER_CPANEL_USERNAME'=> $username))
                    ->get();
            if ($query->num_rows() > 0)  { 
                $data = $query->result(); 
                
                $isCorrect = password_verify($pass, $data[0]->USER_CPANEL_PASS);
                //$isCorrect = true;
                return ($isCorrect) ? $query->row() : FALSE;
            }
            else { 
                return FALSE;
            } 
        }
        
        public function setPassByName($username, $passwd){
            $pass_ = md5($passwd);
            $data = array('USER_CPANEL_PASS'=> $pass_);
            $this->db->where('USER_CPANEL_USERNAME', $username);
            $res = $this->db->update('user_cpanel', $data);
            if($res) {
                $res = $this->getUserByName($username);
                if ($res->num_rows() > 0)  { return $res->row(); }
                else { return FALSE; } 
            }
            return $res;
        }
        
}
?>