<?php
class Tag_m extends CI_Model {
public function index($data)
	{
	
	$this->db->insert('f_tag',$data); //Table Name
	}
//Fetch f_tag data from DB
function get_notice() {
		
	$query = $this->db->query('SELECT * FROM f_tag WHERE status="1" order by id desc'); //Fetch data from DB
	if ($query->num_rows() > 0){
	return $query->result(); //returns an array of objects
	}
    else {
	 
	return $query->result(); //returns an array of objects

	}
}
//Fetch f_tag data from DB
function get_domain() {
		
	$query = $this->db->query('SELECT * FROM f_domain WHERE status="1" order by id desc'); //Fetch data from DB
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
	$this->db->from('f_tag');//content here table name
	$this->db->where('id', $id);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
}
// Update Query For particular item
function notice_update($id,$data){
	$this->db->where('id', $id);
	$this->db->update('f_tag', $data);//content here table name
}
//Multi remove sub category
function removes($data)
{
    if (!empty($data)) {
        $this->db->where_in('id', $data);
        $this->db->set('status', '0');
        $this->db->delete('f_tag');
    }
}

public function code_staus_update($code_staus)
{
	if (!empty($code_staus)) {
		$extrac_data = explode(",", $code_staus);
        $this->db->where_in('id', $extrac_data[1]);
        $this->db->set('code_status', $extrac_data[0]);
        return $this->db->update('f_tag');
    }
}
public function code_verification($code_staus)
{
	if (!empty($code_staus)) {
		$extrac_data = explode(",", $code_staus);
        $this->db->where_in('id', $extrac_data[1]);
        $this->db->set('verification', $extrac_data[0]);
        return $this->db->update('f_tag');
    }
}
}