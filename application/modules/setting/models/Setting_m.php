<?php
class Setting_m extends CI_Model {
public function index($data)
	{
	
	$this->db->insert('message_setting',$data); //Table Name
	}
//Fetch message_setting data from DB
function get_all() {
		
	$query = $this->db->query('SELECT * FROM message_setting WHERE status="1" order by id desc'); //Fetch data from DB
	if ($query->num_rows() > 0){
	return $query->result(); //returns an array of objects
	}
    else {
	 
	return $query->result(); //returns an array of objects

	}
}

// Function To Fetch particular from DB
function update_notice($id){
	$this->db->select('*');
	$this->db->from('message_setting');//content here table name
	$this->db->where('id', $id);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
}
// Update Query For particular item
function notice_update($id,$data){
	$this->db->where('id', $id);
	$this->db->update('message_setting', $data);//content here table name
}
//Multi remove sub category
function removes($data)
{
    if (!empty($data)) {
        $this->db->where_in('id', $data);
        $this->db->set('status', '0');
        $this->db->delete('message_setting');
    }
}
//deactivate user
	function deactivateUser($id)
	{
		$active = array(
			'active'  => 0
		);
		
		$query = $this->db->update('message_setting', $active, array('id'=>$id));
		return $query;
	}

	function activateUser($id)
	{
		$active = array(
			'active'  => 1
		);		
		$query = $this->db->update('message_setting', $active, array('id'=>$id));
		
		return $query;
	}
}