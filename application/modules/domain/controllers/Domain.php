<?php
class Domain extends MX_Controller {
function __construct() {
parent::__construct();
	$this->load->model('domain_m','models');
	echo Modules::run('dashboard');
	//$user = "Chandan Kr";
	// $this->load->view('../../template/dashboard/header/header');
    // $this->load->view('../../template/header/header');
    // $this->load->view('../../template/menu/menu'); 
	$this->load->helper('domains_helper');
 }
public function footer()
{
$this->load->view('../../template/footer/footer');
}
//Insert Data into BD-----------//
	function index()
	{
		if($this->session->userdata('logged_in') == FALSE) {
			$this->session->set_flashdata('error','<p class="alert alert-danger">Please login to view this page.</p>');
			redirect('login');
			exit;
		}  
		$this->showData();
	}
function add() {
	if($this->session->userdata('logged_in') == FALSE) {
        $this->session->set_flashdata('error','<p class="alert alert-danger">Please login to view this page.</p>');
        redirect('login');
        exit;
    }  
	$this->load->library('upload');
	//Including validation library
	$this->load->library('form_validation');
	
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
	$this->form_validation->set_rules('domain', 'Domain', 'required|min_length[5]|is_unique[f_domain.domain]');
	// Check if username has changed
	
	if($this->form_validation->run() == FALSE)
	{
		$this->load->view('add');
		$this->footer();
	}
  else {
	$data = array(
	'domain' => $this->input->post('domain'),
	'insertyBy' => $this->input->post('updateby'),	
	);
	$this->models->index($data);
	echo '<script>alert("You Have Successfully insert this Record!");</script>';
	$url = 'domain/showdata';
	echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
}

//Fetch notice data from database display in data table
public function showData()
{
//$data['contentdata'] = $this->notice_m->getUsers();  //Array object into stored only $data['contentdata'] this value accessible view as $contentdata
$data['getNotice'] = $this->models->get_notice();
$this->load->view('data_list', $data);
$this->footer();
//$this->load->view('notice_detail', $data);
}

//Fetch notice data from database disply in input box
public function updateView()
{
$id = $this->uri->segment(3);
$noticedata['single_content'] = $this->models->update_notice($id);
$this->load->view('add', $noticedata);
}
//particular id = did;
function edit($id) {
//$id= $this->input->post('did');
$data = array(
'domain' => $this->input->post('domain')
);
$this->models->notice_update($id,$data);
//  $this->show_content_id();
if($data == TRUE)
{
echo '<script>alert("You Have Successfully updated this Record!");</script>';
$url = 'domain/showdata';
echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
else{
echo '<script>alert("You Have Not Successfully updated this Record!");</script>';
$url = 'domain/showdata';
echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
}
//Notice delete
public function remove()
{
$data = $this->input->post('delete');

$this->models->removes($data);
if($data == TRUE)
{
echo '<script>alert("You Have Successfully delete this Record!");</script>';
$url = 'domain/showdata';
  echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
else{
  echo '<script>alert("You Have Not Successfully delete this Record!");</script>';
  $url = 'domain/showdata';
  echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
}


///////////////Get domain from server//////////////////////////

	// public function get_domain_lists()
	// {
		
		
	// }
	
	
	public function get_domain_from_server()
	{
		$data['dn']= get_domain_lists();
		$this->load->view('server_domain_list',$data);
		$this->footer();
	}

}