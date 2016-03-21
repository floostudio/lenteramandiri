<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Tasks extends REST_Controller {
	
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
        
        function user_get($userid) {
            $task = $this->M_task->getValidByUser($userid)->result_array();
            $data = array();
            for($i=0; $i< count($task); $i++) {
                $data[$i]['task_id'] = intval($task[$i]['TASK_ID']);
                $data[$i]['title'] = $task[$i]['TASK_TITLE'];
                $data[$i]['expire'] = strtotime($task[$i]['TASK_EXPIRE']);
                $data[$i]['note'] = $task[$i]['TASK_NOTE'];
                $data[$i]['company'] = $task[$i]['COMPANY_NAME'];
            }
            $this->response($data, 200);
        }
        
        
        function detail_get($_taskid) {
            $task = $this->M_task->getByID($_taskid)->result_array();
            $taskdetail = $this->M_task->getDetailByID($_taskid)->result_array();
            $detail = array();
            for($i=0; $i<count($taskdetail); $i++) {
                $detail[$i]['task_detail_id'] = intval($taskdetail[$i]['TASK_DETAIL_ID']); 
                
                $detail[$i]['description'] = $taskdetail[$i]['TASK_DETAIL_DESC']; 
            }
            
            $this->response(array(
                'task_id'=> intval($task[0]['TASK_ID']),
                'title'=> $task[0]['TASK_TITLE'],
                'expire'=> strtotime($task[0]['TASK_EXPIRE']),
                'note'=> $task[0]['TASK_NOTE'],
                'company'=> $task[0]['COMPANY_NAME'],
                'detail'=>$detail),200);
            
        }
        
        function note_put($_taskid){
            $data = $this->put();
            if(!$data['note']) $this->response(array("status_code"=> "400", "message"=> 'Missing Parameters'),400);
            $resp = $this->M_task->setNotesByID($_taskid, $data['note']);
            if($resp) {
                $this->response(array("status_code"=> "200", "message"=> 'Update note success'),200);
            } else {
                $this->response(array("status_code"=> "400", "message"=> 'Bad Request'),400);
            }
        }
}