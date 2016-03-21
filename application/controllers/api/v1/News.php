<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class News extends REST_Controller {
	
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
        
        function index_get() {
            $news = $this->M_news->getValid()->result_array();
            $data = array();
            for($i=0; $i< count($news); $i++) {
                if($news[0]['NEWS_IMAGE']) $news[$i]['NEWS_IMAGE'] = base_url ().$news[$i]['NEWS_IMAGE'];
                $data[$i]['news_id'] = intval($news[$i]['NEWS_ID']);
                $data[$i]['title'] = $news[$i]['NEWS_TITLE'];
                $data[$i]['image'] = $news[$i]['NEWS_IMAGE'];
                $data[$i]['content'] = $news[$i]['NEWS_CONTENT'];
                $data[$i]['date'] = strtotime($news[$i]['NEWS_DATE']);
            }
            $this->response($data, 200);
        }
        
        function detail_get($_newsid) {
            $news = $this->M_news->getByID($_newsid)->result_array();
            if(count($news)>0) {
                if($news[0]['NEWS_IMAGE']) $news[0]['NEWS_IMAGE'] = base_url ().$news[0]['NEWS_IMAGE'];
                $data = array(
                    'news_id' => intval($news[0]['NEWS_ID']),
                    'title' => $news[0]['NEWS_TITLE'],
                    'image' => $news[0]['NEWS_IMAGE'],
                    'content' => $news[0]['NEWS_CONTENT'],
                    'date' => strtotime($news[0]['NEWS_DATE'])
                );
                $this->response($data,200);
            }
            else {
                $this->response(array("status_code"=>"400", "message"=> "Data not found"), 400);
            }
        }
        
        
        
}