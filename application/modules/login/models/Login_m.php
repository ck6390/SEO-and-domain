<?php 
class Login_m extends CI_Model {
    public function login_user($email,$password,$usertype,$url) {
        $this->db->where('email',$email);
        //$this->db->where('password',md5('sha256'.$password));
        $this->db->where('password',$password);
        $this->db->where('usertype',$usertype);
        $this->db->where('url',$url);
        
        $result = $this->db->get_Where('users',array('email'=> $email));
        //$this->db->get_Where('users', array('email'=>'test@yahoo.com'));
		 
        if($result->num_rows() == 1 && $result->row(0)->status==1) {
            return $result->row(0)->id;
        }
		elseif($result->num_rows() == 1 && $result->row(0)->status==0)
		{
		     $this->session->set_flashdata('error','Sorry ! Please activate your account.');
            return false;
		}
        else {
            $this->session->set_flashdata('error','Email or Password is incorrect');
            return false;
        }
    }

    
}