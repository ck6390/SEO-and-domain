<?php 

class Dashboard extends MX_Controller {
    function __construct() {
    parent::__construct();
	$this->load->helper('domains_helper');
    $this->load->model('loggedin_m');
	$this->load->module('seoclient');
        $userid = $this->session->userdata('user_id');
        $user = $this->loggedin_m->getuserdata($userid);
        $this->load->view('../../template/dashboard/header/header',$user);
        $this->load->view('../../template/header/header');
        $this->load->view('../../template/menu/menu'); 
        if($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('error','<p class="alert alert-danger">Please login to view this page.</p>');
            redirect('login');
            exit;
        }   
    }
    public function index(){
                 
        
     }   

     public function dashboards()
     {
		$data['get_data'] = $this->models->get_all();
		//var_dump($data['get_data']);die;
        $this->load->view('loggedin_v',$data);
        $this->load->view('../../template/footer/footer');
     }

      
}