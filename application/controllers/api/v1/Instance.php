<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Instance extends REST_Controller {
	
        public function __construct() {
            parent::__construct();
            
            $this->load->helper('date');
        }
        
        function index_post() {
            
            $data = $this->post();
            
            $islogin = $this->M_instances->checkLogin($data['vendor_name'], $data['vendor_pass']);
            if($islogin) {
                $ACCESS_KEY = hash_hmac("ripemd160", $data["vendor_name"].date('Y-m-d', now('Asia/Jakarta')), $data["vendor_pass"]);
                $today = date('Y-m-d', now('Asia/Jakarta'));
       
                $tomorrow = new DateTime(date('Y:m:d H:i:s'));
                $tomorrow->add(new DateInterval('P1D'));

                $this->M_instances->saveAccessKey($data['vendor_name'], $ACCESS_KEY.$today, $tomorrow->format('Y:m:d H:i:s'));
                $this->response(array(
                'access_key'=>$ACCESS_KEY), 200);
            } else {
                $this->response(array(
                'status_code'=>"403",
                'message'=> 'Wrong ID/PASSWORD VENDOR'), 403);
            }
            
            
//            $this->response(array(
//                "status_code" => 400,
//                "message"=> "bad_request"
//            ), 400);
//            
//            $this->response(array(
//                "status_code" => 404,
//                "message"=> "The Application for this request is not found"
//            ), 404);
//            
//            $this->response(array(
//                "status_code"=> 422,
//                "message"=> "The status code is not recognized"
//            ), 422);
            
            
        }
        
}