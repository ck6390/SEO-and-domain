<?php
class Smsclients_m extends CI_Model {

	public function add_auth_key($data_client){
		return $this->db->insert('sms_auth_key',$data_client);
	}

	public function remove_auth_key($user_name){
		$this->db->where('user_name',$user_name);
		return $this->db->delete('sms_auth_key');
	}
}