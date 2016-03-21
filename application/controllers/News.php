<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

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
            $data['news'] = $this->M_news->getAll();
            $this->load->view('cpanel/news/view', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function create() {
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/news/create');
            $this->load->view('cpanel/layout/footer');
        }
        
        public function edit($id) {
            
            $data['news'] = $this->M_news->getById($id);
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/news/edit', $data);
            $this->load->view('cpanel/layout/footer');
        }
        
        public function creating() {
            
            $img = $this->DoUpload();
            if($img) {
                $data = array(
                    'NEWS_TITLE' => $this->input->post('title'),
                    'NEWS_CONTENT' => $this->input->post('content'),
                    'NEWS_IMAGE' => $img,
                    'IS_SHOW' => $this->input->post('valid'),
                );
                $status = $this->M_news->addNews($data);
                if($status) {
                    $this->session->set_flashdata('success', 'Succesfully create data');redirect('news');
                } else {
                    $this->session->set_flashdata('error', 'Failed create data');redirect('news/create');
                }
            }
            else {
                $this->session->set_flashdata('error', 'Failed upload Image');
                //redirect('news/create');
            }
        }
        
        public function update($id) {
            $news_id = $id;
            
            
            
            if(!$_FILES['userfile']['size'] == 0) {
                $img = $this->DoUpload();
            } else {
                $img = $this->input->post('banner');
            }
            
            $data = array(
                "NEWS_TITLE"      => $this->input->post('title'),
                "NEWS_CONTENT"      => $this->input->post('content'),
                "NEWS_IMAGE" => $img,
                "IS_SHOW"      => $this->input->post('valid')
            );
            
            
            if($img) {
                $status = $this->M_news->setNewsById($news_id, $data);
                if($status) {
                    $this->session->set_flashdata('success', 'Succesfully update data');redirect('news');
                } else {
                    $this->session->set_flashdata('error', 'Failed create data');redirect('news/edit/'.$id);
                }
            }
            else {
                $this->session->set_flashdata('error', 'Failed upload Image');redirect('news/edit/'.$id);
            }
        }
        
        function toggleActive($_newsid, $isActive) {
            $nstats = ($isActive) ? 0:1;
            $status = $this->M_news->setActiveByID($_newsid, $nstats);
            if($status)
                {$this->session->set_flashdata('success', 'Succesfully update data');redirect('news');}
            else
                {$this->session->set_flashdata('error', 'failed update data');redirect('news');}
        }
        
        public function DoUpload() {
                $config = array(
                    'upload_path' => "./static/images/news",
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'max_size' => "2048", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    
                );
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload())
                {
                    $upload_data = $this->upload->data();
                    //$this->_createThumbnail("static/images/news/".$upload_data['file_name']);
                    $this->_resize("static/images/news/".$upload_data['file_name']);
                    $fileName = 'static/images/news/'.$upload_data['file_name'] ;
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
            $res = $this->M_news->delNews($id);
            if($res){
                $this->session->set_flashdata('success', 'Data succesfully deleted');
                redirect('news');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete data');
                redirect('news');
            }
        }
}
