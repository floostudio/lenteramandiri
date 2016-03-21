<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Users extends REST_Controller {
	
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
        
        function hash_get($pass) {
            $options = [ 'cost' => 13 ];
        $encPass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $this->response($encPass);
        }
        
        function login_post() {
            $data = $this->post();
            if(!array_key_exists('email', $data) || !array_key_exists('password', $data)){
                $this->response(array('status_code'=> '400', 'message'=> 'Bad Request or Missing Parameter'), 400);
            }
            $isActive = $this->M_user->getActiveByEmail($data['email']);
            if(!$isActive) {
                $this->response(array('status_code'=> '403', 'message' => 'Access Denied, Ask your admin to activate this account'), 403);
            }
            
            $user = $this->M_user->getAccess($data['email'], $data['password']);
            if($user) {
                if($user['USER_IMG']) $user['USER_IMG'] = base_url().$user['USER_IMG'];
                $this->response(array(
                    'status_code'=> '200', 
                    'user_id' => intval($user['USER_ID']),  
                    'first_name' => $user['USER_FIRST_NAME'],
                    'last_name' => $user['USER_LAST_NAME'],
                    'profpic' => $user['USER_IMG'],
                    'title' => $user['M_TITLE_NAME'], 
                    'message'=> 'Login Successfull'), 200);
            } else {
                $this->response(array('status_code'=> '422', 'message' => 'Wrong email or password'), 422);
            }
        }
        
        function register_post() {
            $data = $this->post() ;
            
            $isRegistered = $this->M_user->checkRegistered($data['email']);
            if($isRegistered) {
                $this->response(array('status_code'=> '409', 'message'=> "Email Registered"), 400);
            }
            
            $registeredID = $this->M_user->registerUser($data);
            if($registeredID) {
                $this->response(array('status_code'=> '200','user_id'=> $registeredID, 'message'=> 'Registered Success'), 200);
            } else {
                $this->response(array('status_code'=> '400', 'message'=> "Bad Request"), 400);
            }
        }
        
        function detail_get($_userid) {
            $userdetail = $this->M_user->getDetailByID($_userid)->result_array();
            if(count($userdetail)>0) {
                if($userdetail[0]['USER_IMG']) $userdetail[0]['USER_IMG'] = base_url().$userdetail[0]['USER_IMG'];
                $this->response(array(
                    "first_name" => $userdetail[0]['USER_FIRST_NAME'],
                    "last_name" => $userdetail[0]['USER_LAST_NAME'],
                    "nip" => $userdetail[0]['USER_NIP'],
                    "directorate" => $userdetail[0]['M_DIRECTORATE_NAME'],
                    "group" => $userdetail[0]['M_GROUP_NAME'],
                    "department" => $userdetail[0]['M_DEPARTMENT_NAME'],
                    "title" => $userdetail[0]['M_TITLE_NAME'],
                    "email" => $userdetail[0]['USER_EMAIL'],
                    "profpic" => $userdetail[0]['USER_IMG'],
                ));
                $this->response($userdetail,200);
            }
            else {
                $this->response(array("status_code"=>"404", "message"=> "Data not found"), 400);
            }
        }
        
        function detail_put($_userid){
            $data = $this->put();
            $data['profpic'] = 'static/images/users/profile/'. $data['profpic'];
            $isUpdated = $this->M_user->setDetailByID($_userid, $data);
            if($isUpdated) {
                $this->response(array('status_code'=> '200', 'message'=> 'Update profile success'),200);
            }
            else {
                $this->response(array("status_code"=>"404", "message"=> "Data not found"), 400);
            }
        }
        
        
        function change_password_put(){
            $data = $this->put();
            
            $isCorrect = $this->M_user->getAccess($data['email'], $data['old_password']);
            //$isCorrect = true;
            if($isCorrect) {
                $isUpdated = $this->M_user->setPasswordByEmail($data['email'], $data['new_password']);
                if($isUpdated) {
                    $this->response(array('status_code'=> '200', 'message'=> 'Update password success'),200);
                }
                else {
                    $this->response(array("status_code"=>"409", "message"=> "Update Failed"), 409);
                }
            } else {
                $this->response(array("status_code"=>"409", "message"=> "Wrong Email/Password"), 409);
            }
        }
        
        function profpic_post() {
            $config['upload_path'] = './static/images/users/profile';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5048';
            $config['overwrite'] = TRUE;
            $config['max_width']  = '2048';
            $config['max_height']  = '2048';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload()) {
                $upload_data = $this->upload->data();
                $this->_resize("static/images/users/profile".$upload_data['file_name']);
                $this->response(array('status_code' => '200', 'filename'=>$upload_data['file_name']), 200);
            }
            else {
                $this->response(array('status_code' => 400 ,'message' => $this->upload->display_errors()), 400);
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