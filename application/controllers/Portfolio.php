<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller {

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
            $this->load->view('cpanel/layout/header');
            $this->load->view('cpanel/layout/sidemenu');
            $this->load->view('cpanel/portfolio/dashboard');
            $this->load->view('cpanel/layout/footer');
        }
}
