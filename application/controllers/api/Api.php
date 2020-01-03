<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Api extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
       
    }
       
    /**
     * Get All Data from this method.
     * Get Student details
     * @return Response
    */
	public function index_get()
	{
		//die("sdf");
        $http = $this->uri->segment(3);	   
        $domain = $this->uri->segment(4)."/";	   
		//die;
        $this->load->model('Api_Model', 'api', true);       
        $this->data['meta_data1'] = $this->api->get_meta_tag($domain);
		//echo "<pre>";
		//print_r(str_replacr(";",'',$this->data['meta_data1']);
		//die;
		$json_data = json_encode($this->data['meta_data1'],true);
		$this->data['meta_data'] = json_decode(str_replace(';','',$json_data));
		//print_r($this->data['meta_data']);
        if($this->data){
            $this->data['response_code'] = REST_Controller::HTTP_OK;
            $this->data['response_msg'] = 'success';
            $this->response($this->data, REST_Controller::HTTP_OK);
        }else{
            $this->data['response_code'] = REST_Controller::HTTP_NO_CONTENT;
            $this->data['response_msg'] = $this->lang->line('text_rest_invalid_api_key');
            $this->response($this->data,REST_Controller::HTTP_NO_CONTENT);
        }       
	}
    /**
     * Get All Data from this method.
     * Get notice details
     * @return Response
    */
    /*public function parent_login_post()
    {
        $password = md5($_POST['password']);  
        $user_id = $_POST['user_id'];  
        //die;    
        $this->load->model('Api_Model', 'api', true);       
        $data = $this->data['parent_details'] = $this->api->check_credentail($user_id, $password);
        if($data){
            $this->data['response_code'] = REST_Controller::HTTP_OK;
            $this->data['response_msg'] = 'success';
            $this->response($this->data, REST_Controller::HTTP_OK);
        }else{
            $this->data['response_code'] = REST_Controller::HTTP_BAD_REQUEST;
            $this->data['response_msg'] = $this->lang->line('text_rest_invalid_credentials');
             $this->response($this->data,REST_Controller::HTTP_BAD_REQUEST);
        }  
    }*/
    /**
     * Get All Data from this method.
     * Get Students parent by
     * @return Response
    */
    /*public function parent_by_student_get()
    {
        $guardian_id = $_GET['id'];
        $school_id = $_GET['school_id'];
        $this->load->model('Api_Model', 'api', true);       
        $data = $this->data['students'] = $this->api->get_student_list($guardian_id,$school_id);
        if($data){
            $this->data['response_code'] = REST_Controller::HTTP_OK;
            $this->data['response_msg'] = 'success';
            $this->response($this->data, REST_Controller::HTTP_OK);
        }else{
            $this->data['response_code'] = REST_Controller::HTTP_NO_CONTENT;
            $this->data['response_msg'] = $this->lang->line('text_rest_invalid_api_key');
             $this->response($this->data,REST_Controller::HTTP_NO_CONTENT);
        }  
    }*/
     /**
     * Get All Data from this method.
     * Get all type notice
     * @return Response
    */
   /* public function notice_get($type,$school_id)
    {
        //$type = $_GET['']
       // if(!empty($type)){
            $this->load->model('Api_Model', 'api', true);       
            $data = $this->data[$type] = $this->api->get_notice($type,$school_id);
            // var_dump($data);
            if($data){
                $this->data['response_code'] = REST_Controller::HTTP_OK;
                $this->data['response_msg'] = 'success';
                $this->response($this->data, REST_Controller::HTTP_OK);
            }  
            else{
                $this->data['response_code'] = REST_Controller::HTTP_BAD_REQUEST;
                $this->data['response_msg'] = $this->lang->line('text_rest_invalid_api_key');
                $this->response($this->data,REST_Controller::HTTP_BAD_REQUEST);
            }
       
    }*/
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
       // print_r($_POST);
        //die();
       $input = $this->input->post();
        $this->db->insert('items',$input);
     
       $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('items', $input, array('id'=>$id));
     
        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('items', array('id'=>$id));
       
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }
    	
}