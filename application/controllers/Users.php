<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	
    function __construct() {
        parent::__construct();

        $this->user_id = $this->session->userdata('lm_userid');
        $this->user_name = $this->session->userdata('lm_username');
        $this->name = $this->session->userdata('lm_name');
        $this->user_logo = $this->session->userdata('lm_userlogo');
        if(!$this->user_id){ redirect('login'); }
    }
        
    public function index() {
       redirect('users/manage');
    }

    function profile($id) {
        $data['user'] = $this->M_user->getUserById($id);
        
        if($id!=-1 && is_numeric($id)) {
            $data['user'] = $this->M_user->getUserById($id);
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/side_menu');
            $this->load->view('page/users/profile', $data);
        } else {
            $data['heading'] = "ERROR PAGE"; $data['message'] = "Page not found";
            $this->load->view('page/error/404', $data);
        }
    }
    
    function manage() {
        $data['users'] = $this->M_user->getAll();
        $this->load->view('cpanel/layout/header');
        $this->load->view('cpanel/layout/sidemenu');
        $this->load->view('cpanel/users/view', $data);
        $this->load->view('cpanel/layout/footer');
    }
    
    function create() {
        $data['directorate'] = $this->M_directorate->getAll()->result();
        $data['group'] = $this->M_group->getAll()->result();
        $data['department'] = $this->M_department->getAll()->result();
        $data['title'] = $this->M_title->getAll()->result();
        $this->load->view('cpanel/layout/header');
        $this->load->view('cpanel/layout/sidemenu');
        $this->load->view('cpanel/users/create', $data);
        $this->load->view('cpanel/layout/footer');
    }
    
    function creating() {
        
        $pass = $this->input->post('pass');
        
        $options = [
            'cost' => 13,
        ];
        $encPass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $img = $this->DoUpload();
        
        if($img) {
            $data = array (
                'USER_FIRST_NAME' => $this->input->post('first_name'),  
                'USER_LAST_NAME' => $this->input->post('last_name'),  
                'USER_EMAIL' => $this->input->post('email'),  
                'USER_NIP' => $this->input->post('nip'),  
                'USER_DIRECTORATE' => $this->input->post('directorate'),  
                'USER_GROUP' => $this->input->post('group'),  
                'USER_DEPARTMENT' => $this->input->post('department'),  
                'USER_TITLE' => $this->input->post('title'),  
                'USER_PASS' => $encPass,  
                'USER_IMG' => $img,
                'IS_ACTIVE' => $this->input->post('active'),  
            );

            $resp = $this->M_user->addUser($data);
            if($resp) {
                $this->session->set_flashdata('success', 'Succesfully create data');redirect('users/manage');
            } else {
                $this->session->set_flashdata('error', 'Failed create data');redirect('users/create');
            }
        }
        else {
            $this->session->set_flashdata('error', 'Failed upload Image');
            redirect('users/create');
        }
        
        
    }
    
    private function getUserID($ut_id) {
        $record = $this->M_user->getUserByUTID($ut_id)->result_array();
        if(empty($record))
        {
            $num = $ut_id;
            $id = sprintf("%04s",1);
            $userid = $num . $id;
            return $userid;
        }
        $last = end($record);
        $userid = $last['USER_ID']+1;
        return $userid;
    }
    
    function edit($userid) {
        $user = $this->M_user->getUserById($userid);
        $data['user']  = $user->result();
        $data['directorate'] = $this->M_directorate->getAll()->result();
        $data['group'] = $this->M_group->getAll()->result();
        $data['department'] = $this->M_department->getAll()->result();
        $data['title'] = $this->M_title->getAll()->result();
        $this->load->view('cpanel/layout/header');
        $this->load->view('cpanel/layout/sidemenu');
        $this->load->view('cpanel/users/edit', $data);
        $this->load->view('cpanel/layout/footer');
    }
    
    function updating($userid) {
        if(!$_FILES['userfile']['size'] == 0) {
            $img = $this->DoUpload();
        } else {
            $img = $this->input->post('banner');
        }
        
        if($img) {
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['nip'] = $this->input->post('nip');
            $data['directorate'] = $this->input->post('directorate');
            $data['group'] = $this->input->post('group');
            $data['department'] = $this->input->post('department');
            $data['email'] = $this->input->post('email');
            $data['title'] = $this->input->post('title');
            $data['profpic'] = $img;

            $isActive = $this->input->post('active');
            $this->M_user->setActiveByID($userid, $isActive);

            $resp = $this->M_user->setDetailById($userid, $data);
            if($resp) {
                $this->session->set_flashdata('success', 'Succesfully update data');redirect('users/manage');
            } else {
                $this->session->set_flashdata('error', 'Failed create data');redirect('users/edit/'.$userid);
            }
        }
        else {
            $this->session->set_flashdata('error', 'Failed upload Image');redirect('users/edit/'.$userid);
        }
        
    }
    
    function toggleActive($_userid, $isActive) {
        $nstats = ($isActive) ? 0:1;
        $status = $this->M_user->setActiveByID($_userid, $nstats);
        if($status)
            {$this->session->set_flashdata('success', 'Succesfully update data');redirect('users/manage');}
        else
            {$this->session->set_flashdata('error', 'failed update data');redirect('users/manage');}
    }
    
    function updateProfile($userid) {
        $status = $this->input->post('status');
        $data = array (
          'USER_NAME' => $this->input->post('username'),  
          'EMAIL_ADDRESS' => $this->input->post('email'),  
          'NAME' => $this->input->post('name')
        );
        
        $resp = $this->M_user->setUserById($userid, $data);
        if($resp) {
            $this->session->set_flashdata('success', 'Succesfully update data');redirect('users/profile/'.$userid);
        } else {
            $this->session->set_flashdata('error', 'Failed create data');redirect('users/profile/'.$userid);
        }
    }
    
    
    
    function changepass($userid) {
        $data['userid'] = $userid;
        $this->load->view('cpanel/layout/header');
        $this->load->view('cpanel/layout/sidemenu');
        $this->load->view('cpanel/users/changepass', $data);
    }
    
    function updatepass($userid) {
        $pass = $this->input->post('new_pass');
        
        $resp = $this->M_user->setPasswordByID($userid, $pass);
        if($resp) {
            $this->session->set_flashdata('success', 'Succesfully update password');redirect('users/edit/'.$userid);
        } else {
            $this->session->set_flashdata('error', 'Failed update password');redirect('users/changepass/'.$userid);
        }
    }
    
    function changeuserpass($userid) {
        $data['userid'] = $userid;
        $this->load->view('cpanel/layout/header');
        $this->load->view('cpanel/layout/side_menu');
        $this->load->view('page/users/changeuserpass', $data);
    }
    
    function updateuserpass($userid) {
        $pass = $this->input->post('gsl_passwd');
        
        $options = [
            'cost' => 13,
        ];
        $encPass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $data = array(
            "PASSWORD" => $encPass,
        );
        
        $resp = $this->M_user->setUserById($userid, $data);
        if($resp) {
            $this->session->set_flashdata('success', 'Succesfully update password');redirect('users/profile/'.$userid);
        } else {
            $this->session->set_flashdata('error', 'Failed update password');redirect('users/profile/'.$userid);
        }
    }
    
    function deleteuser($userid) {
        $resp = $this->M_user->delUser($userid);
        if($resp) {
            $this->session->set_flashdata('success', 'Succesfully delete data');redirect('users');
        } else {
            $this->session->set_flashdata('error', 'Failed delete data');redirect('users');
        }
    }
    
    function DoUpload() {
            $config = array(
                'upload_path' => "./static/images/users/profile",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "5120", // Can be set to particular file size , here it is 2 MB(2048 Kb)

            );

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload())
            {
                $upload_data = $this->upload->data();
                $this->_resize("static/images/users/profile/".$upload_data['file_name']);
                $fileName = "static/images/users/profile/".$upload_data['file_name'] ;
                return $fileName;
            }
            else {
                return false;
            }
    }

    //Create Thumbnail function
    function _resize($filename) {
        $config['image_library']    = "gd2";      
        $config['source_image']     = $filename;  
        $config['maintain_ratio']   = TRUE;    
        $config['width'] = "500";   
        $this->load->library('image_lib',$config);
        if(!$this->image_lib->resize()){
            echo $this->image_lib->display_errors();
        }      
        $this->image_lib->clear();

    }

    
}
