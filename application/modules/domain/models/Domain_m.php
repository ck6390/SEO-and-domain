<?php
class Domain_m extends CI_Model {
public function index($data)
	{
	
	$this->db->insert('f_domain',$data); //Table Name
	}
//Fetch f_domain data from DB
function get_notice() {
		
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
	$this->db->from('f_domain');//content here table name
	$this->db->where('id', $id);
	$query = $this->db->get();
	$result = $query->result();
	return $result;
}
// Update Query For particular item
function notice_update($id,$data){
	$this->db->where('id', $id);
	$this->db->update('f_domain', $data);//content here table name
}
//Multi remove sub category
function removes($data)
{
    if (!empty($data)) {
        $this->db->where_in('id', $data);
        $this->db->set('status', '0');
        $this->db->delete('f_domain');
    }
}
}