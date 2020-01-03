<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
    
    public function index() {
        if($this->session->userdata('logged_in') == TRUE) {
            redirect('dashboard');
        }
		 $this->load->view('../../template/header/header');
         $this->load->view('login');
       
    }
    /*Login Code here*/
    public function process() {
       
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $usertype = $this->input->post('usertype');
         $url  = $this->input->post('url');
        
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');
        /*If input wrong then load longin controller*/
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error',validation_errors());
            redirect('login');
        }
        /*Load here modal*/
        else {
            $this->load->model('login_m');
            $user_id = $this->login_m->login_user($email,$password,$usertype,$url);
            
            if($user_id) {
                $user_data = array(
                    'user_id' => $user_id,
                    'email'   => $email,
                    'usertype' => $usertype,
                    'url' => $url,
                    'logged_in' => TRUE
                );
                
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_success','You are now logged in.');
                //if ($usertype=="Ad") {
                    redirect('dashboard/dashboards');
               // } else {
                 //   redirect('Welcome');
                //}
                
                
            }
            else {
                redirect('login');
            }
        }
    }
    
}