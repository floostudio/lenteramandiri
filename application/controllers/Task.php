<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

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
        public function index() {
            $this->view();
        }
        
        public function view(){
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $data['task'] = $this->M_task->getAll();
            $this->load->view('cpanel/task/view', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function create() {
            $data['company'] = $this->M_company->getAll()->result();
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/task/create', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function edit($id) {
            
            $task = $this->M_task->getById($id)->result();
            $data['company'] = $this->M_company->getAll()->result();
            $data['expire'] = DateTime::createFromFormat('Y-m-d H:i:s', $task[0]->TASK_EXPIRE)->format('m/d/Y');
            $data['expires'] = $task[0]->TASK_EXPIRE;
            $data['task'] = $task;
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/task/edit', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function creating() {
            $_expire = date('Y-m-d H:i:s', strtotime($this->input->post('expire')));
            $data = array(
                "TASK_TITLE"      => $this->input->post('title'),
                "TASK_EXPIRE"     => $_expire,
                "COMPANY_ID"      => $this->input->post('company'),
                "TASK_NOTE"      => $this->input->post('note'),
                "IS_SHOW"      => $this->input->post('valid')
            );
            
            $status = $this->M_task->addTask($data);
            if($status) {
                $this->session->set_flashdata('success', 'Succesfully create data');redirect('task');
            } else {
                $this->session->set_flashdata('error', 'Failed create data');redirect('task/create');
            }
            
        }
        
        public function update($taskid) {
            $data = array(
                "TASK_TITLE"      => $this->input->post('title'),
                "TASK_EXPIRE"     => date('Y-m-d H:i:s', strtotime($this->input->post('expire'))),
                "COMPANY_ID"      => $this->input->post('company'),
                "TASK_NOTE"      => $this->input->post('note'),
                "IS_SHOW"      => $this->input->post('valid')
            );
            
            $status = $this->M_task->setTaskById($taskid, $data);
            if ($status) {
                $this->session->set_flashdata('success', 'Succesfully update data');
                redirect('task');
            } else {
                $this->session->set_flashdata('error', 'Failed create data');
                redirect('task/edit/' . $id);
            }
        }
    
        function toggleActive($_taskid, $isActive) {
            $nstats = ($isActive) ? 0:1;
            $status = $this->M_task->setActiveByID($_taskid, $nstats);
            if($status)
                {$this->session->set_flashdata('success', 'Succesfully update data');redirect('task');}
            else
                {$this->session->set_flashdata('error', 'failed update data');redirect('task');}
        }
        
        function manageassignment($_taskid) {
            $data['task_id'] = $_taskid;
            $data['task'] = $this->M_task->getByID($_taskid)->result();
            $data['list_user'] = $this->M_user->getAll();
            $data['preselected_user'] = $this->M_task->getTaskAssignment($_taskid);
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/task/manage_assignment', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        function updateassignment($_taskid) {
            $selected_user = $this->input->post('searchable');
            $status = true;
            $this->M_task->clearAssignment($_taskid);
            if($selected_user) {
                foreach($selected_user as $user) {
                    $status = $this->M_task->setAssignment($_taskid, $user);
                    if (!$status) {break;}
                }
            }
            if($status)
                {$this->session->set_flashdata('success', 'Succesfully assign user quiz');redirect('task');}
            else
                {$this->session->set_flashdata('error', 'failed assign user quiz ');redirect('task/manageassignment/'.$_taskid);}      
        }
        
        function managedetail($_taskid) {
            $data['task_id'] = $_taskid;
            $data['task'] = $this->M_task->getByID($_taskid)->result();
            $data['taskdetails'] = $this->M_task->getDetailByID($_taskid);
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/task/manage_detail', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function update_detail($task_id=null) {
            $data = $this->input->post();
            
            $status = $this->M_task->setDetailById($data, $task_id);
            if($status) {
                $this->session->set_flashdata('success', 'Succesfully update detail');redirect('task');
            } else {
                $this->session->set_flashdata('error', 'Failed update detail');redirect('task/managedetail/'.$task_id);
            }
            
        }
        
        public function DoUpload() {
                $config = array(
                    'upload_path' => "./static/images/task",
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'max_size' => "5120", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    
                );
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload())
                {
                    $upload_data = $this->upload->data();
                    //$this->_createThumbnail("static/images/task/".$upload_data['file_name']);
                    $this->_resize("static/images/task/".$upload_data['file_name']);
                    $fileName = 'static/images/task/'.$upload_data['file_name'] ;
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
            $config['width'] = "640";   
            $this->load->library('image_lib',$config);
            if(!$this->image_lib->resize()){
                echo $this->image_lib->display_errors();
            }      
            $this->image_lib->clear();

        }
        
        //Create Thumbnail function
        function _createThumbnail($filename) {
            $config['image_library']    = "gd2";      
            $config['source_image']     = $filename; 
            $config['create_thumb']     = TRUE;  
            $config['maintain_ratio']   = TRUE;     
            $config['width'] = "150";   

            $this->load->library('image_lib',$config);
            if(!$this->image_lib->resize()){
                echo $this->image_lib->display_errors();
            }      
            $this->image_lib->clear();
        }
        
        
        public function delete() {
            $id =  $this->input->post('idsel');
            $res = $this->M_task->delTask($id);
            if($res){
                $this->session->set_flashdata('success', 'Data succesfully deleted');
                redirect('task');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete data');
                redirect('task');
            }
        }
}
