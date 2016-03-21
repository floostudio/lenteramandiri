<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library(array('session','form_validation'));
    }
        
    public function index()
    {
        
        //$msg2 = 'marketing1';
        //$data['enc2']      = password_hash($msg2, PASSWORD_BCRYPT, $options);
        //$data['isCorrect'] = password_verify($msg2, $data['enc2'])      ;
        
        $this->load->view('cpanel/login');
    }
    
    function getAccess() {
        $username   = $this->input->post('username');
        $passwd     = $this->input->post('passwd');

        $data_member = $this->M_login->checkLogin($username, $passwd);
        if($data_member){
            
                $this->session->set_userdata('lm_userid',$data_member->USER_CPANEL_ID);
                $this->session->set_userdata('lm_username',$data_member->USER_CPANEL_USERNAME);
                $this->session->set_userdata('lm_name',$data_member->USER_CPANEL_NAME);
                $this->session->set_userdata('lm_userlogo',$data_member->USER_CPANEL_LOGO);
            
                redirect('dashboard');
            
        }
        else {
            $this->session->set_flashdata('wrong_pass', ' Incorrect username or password');
            redirect("login");
        }
    }
    
    function signOut() {
            $this->session->sess_destroy();
            redirect('login');
    }
    
    private function setLastLogin($userid){
        $data = array("LAST_LOGIN" => date('Y-m-d H:i:s'));
        $resp = $this->M_user->setUserByID($userid, $data);
        return $resp;
    }

}
