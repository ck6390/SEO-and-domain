<?php
class Logout extends CI_Controller {

public function index(){
$ar = array('user_id','email','logged_in');
$this->session->unset_userdata($ar);
$this->session->set_flashdata('logout_success','You are logged out successfully!');
		$this->session->sess_destroy();
redirect('login/index');
}

}