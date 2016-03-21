<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->user_id = $this->session->userdata('lm_userid');
            $this->user_name = $this->session->userdata('lm_username');
            $this->name = $this->session->userdata('lm_name');
            $this->user_logo = $this->session->userdata('lm_userlogo');
            if(!$this->user_id){
                redirect('login');
            }
        }
        public function index()
        {
            $this->load->view('login');
        }
        
        public function view($username) {
            $data['user'] = $this->M_user_cpanel->getUserByName($username);
            
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/profile/view', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function update($username) { 
            if($username == $this->user_name) {
                // Upload file and checked the uploaded image
                if(!$_FILES['userfile']['size'] == 0) {
                    $fn = $this->DoUpload();
                } else {
                    $fn = $this->input->post('logo');
                }
                
                if(!$fn) {
                    $this->session->set_flashdata('fileuploaderror', '<b> Failed!</b> Error uploading image!');
                    redirect('profile/view/'.$username);
                }
                else {
                    // if no error in uploading image, update data
                    $user = $this->M_user_cpanel->setUserByName($username, $fn);
                    if($user) { 
                        $this->user_name = $this->session->set_userdata('lm_username',$user->USER_CPANEL_USERNAME);
                        $this->user_logo = $this->session->set_userdata('lm_userlogo',$user->USER_CPANEL_LOGO);
                        $this->session->set_flashdata('success', '<b> Success!</b> Data Succesfully been updated !');
                        redirect('profile/view/'.$username);
                    }
                    else {
                        redirect('profile/view/'.$username);
                    }
                }
                
            } else {
                //redirect('dashboard');
            }
        }
        
        public function changepass($username=null) {
            if(!isset($username)){
                $this->load->view('cpanel/layout/header');
                $this->load->view('cpanel/layout/sidemenu');
                $this->load->view('cpanel/profile/change_password');
                $this->load->view('cpanel/layout/footer');
            }
            else if($username == $this->user_name){
                // Check Old Password
                $oldpasswd = $this->input->post('old_pass');
                $newpasswd = $this->input->post('new_pass');
                $newpasswd2 = $this->input->post('reenter_pass');
                $data_member = $this->M_login->checkLogin($username, $oldpasswd);
                if($newpasswd != $newpasswd2) {
                    $this->session->set_flashdata('wrong_pass', '<b> Error!</b> Please re-enter same password');
                    redirect('profile/changepass');
                }
                if($data_member){
                    // Update password here
                    $this->M_user_cpanel->setPassByName($username, $newpasswd);
                    $this->session->set_flashdata('success', '<b> Success!</b> Password successfully changed');
                    redirect('profile/changepass');
                } else {
                    $this->session->set_flashdata('wrong_pass', '<b> Failed!</b> Wrong old password');
                    redirect('profile/changepass');
                }
                    
                
            } else {
                redirect ("dashboard");
            }
        }
        
        public function DoUpload() {
                $config = array(
                    'upload_path' => "./static/images/users/logo",
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'max_size' => "2048", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "160",
                    'max_width' => "160"
                );
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload())
                {
                    $upload_data = $this->upload->data();
                    $fileName = 'static/images/users/logo/'.$upload_data['file_name'] ;
                    return $fileName;
                }
                else {
                    return false;
                }
        }
        
}
