<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Master extends REST_Controller {
	
        public function __construct() {
            parent::__construct();
            $this->load->helper('date');
            $header = array_change_key_case($this->input->request_headers());
            if(array_key_exists('x-header_access_key', $header)) {
                $ACCESS_KEY = $header['x-header_access_key'];
                $isAccesible = $this->M_instances->getAccess($ACCESS_KEY.date('Y-m-d', now('Asia/Jakarta')));
            } else {
                $isAccesible = false;
            }
            
            if(!$isAccesible) {
                $this->response(array("status_code" => '401', "message"=> "Authentication Failed or user doesn't have permission for requested operation"), 401);
            } 
        }
        
        function department_get() {
            
            $datas = $this->M_department->getValid()->result_array();
            $data = array();

            if(count($datas)>0) {
                for($i=0; $i< count($datas); $i++) {
                    $data[$i]['id'] = intval($datas[$i]['M_DEPARTMENT_ID']);
                    $data[$i]['name'] = $datas[$i]['M_DEPARTMENT_NAME'];
                }
                $this->response($data, 200);
            }
            else {
                $this->response(array("status_code"=>"400", "message"=> "Data not found"), 400);
            }
        }
        
        function directorate_get() {
            
            $datas = $this->M_directorate->getValid()->result_array();
            $data = array();

            if(count($datas)>0) {
                for($i=0; $i< count($datas); $i++) {
                    $data[$i]['id'] = intval($datas[$i]['M_DIRECTORATE_ID']);
                    $data[$i]['name'] = $datas[$i]['M_DIRECTORATE_NAME'];
                }
                $this->response($data, 200);
            }
            else {
                $this->response(array("status_code"=>"400", "message"=> "Data not found"), 400);
            }
        }
        function group_get() {
            
            $datas = $this->M_group->getValid()->result_array();
            $data = array();

            if(count($datas)>0) {
                for($i=0; $i< count($datas); $i++) {
                    $data[$i]['id'] = intval($datas[$i]['M_GROUP_ID']);
                    $data[$i]['name'] = $datas[$i]['M_GROUP_NAME'];
                }
                $this->response($data, 200);
            }
            else {
                $this->response(array("status_code"=>"400", "message"=> "Data not found"), 400);
            }
        }
        function title_get() {
            
            $datas = $this->M_title->getValid()->result_array();
            $data = array();

            if(count($datas)>0) {
                for($i=0; $i< count($datas); $i++) {
                    $data[$i]['id'] = intval($datas[$i]['M_TITLE_ID']);
                    $data[$i]['name'] = $datas[$i]['M_TITLE_NAME'];
                }
                $this->response($data, 200);
            }
            else {
                $this->response(array("status_code"=>"400", "message"=> "Data not found"), 400);
            }
        }
        
        
        
}