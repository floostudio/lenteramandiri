<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->helper('url');
            $this->load->library(array('session','form_validation'));
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
            $data['group'] = $this->M_group->getAll();
            $this->load->view('cpanel/group/view', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function create() {
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/group/create');
            $this->load->view('cpanel/layout/footer');
        }
        
        public function edit($id) {
            
            $data['group'] = $this->M_group->getByID($id);
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/group/edit', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function creating() {
            
            $data = array(
                "M_GROUP_NAME" => $this->input->post('name'),
                "IS_SHOW" => $this->input->post('valid')
            );
            
            $status = $this->M_group->add($data);
            if($status) {
                $this->session->set_flashdata('success', 'Succesfully create data');redirect('master/group');
            } else {
                $this->session->set_flashdata('error', 'Failed create data');redirect('master/group/create');
            }
            
        }
        
        public function update($id) {
            $data = array(
                "M_GROUP_NAME" => $this->input->post('name'),
                "IS_SHOW" => $this->input->post('valid')
            );
            
            $status = $this->M_group->set($id, $data);
            if($status) {
                $this->session->set_flashdata('success', 'Succesfully update data');redirect('master/group');
            } else {
                $this->session->set_flashdata('error', 'Failed create data');redirect('master/group/edit/'.$id);
            }
            
        }
        
        public function delete() {
            $id =  $this->input->post('idsel');
            $res = $this->M_group->del($id);
            if($res){
                $this->session->set_flashdata('success', 'Data succesfully deleted');
                redirect('master/group');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete data');
                redirect('master/group');
            }
        }
        
        function toggleActive($_id, $isActive) {
            $nstats = ($isActive) ? 0:1;
            $status = $this->M_group->setActiveByID($_id, $nstats);
            if($status)
                {$this->session->set_flashdata('success', 'Succesfully update data');redirect('master/group');}
            else
                {$this->session->set_flashdata('error', 'failed update data');redirect('master/group');}
        }
}
