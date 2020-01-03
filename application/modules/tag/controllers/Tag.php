<?php
class Tag extends MX_Controller {
function __construct() {
parent::__construct();
$this->load->model('tag_m','models');
echo Modules::run('dashboard');
	$this->load->library('upload');
	//Including validation library
	$this->load->library('form_validation');	
	$this->load->helper('domains_helper');
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
 }
public function footer()
{
$this->load->view('../../template/footer/footer');
}
//Insert Data into BD-----------//
function index()
{

$this->showData();
}

function add() {
	
	//$domain_list = $this->models->get_domain();
	//var_dump($domain_list);
	//die;
	$this->form_validation->set_rules('google_verification', 'Google Verification', 'required|min_length[5]');
	$this->form_validation->set_rules('google_analytics', 'Google Analytics', 'required|min_length[5]');
	$this->form_validation->set_rules('domain', 'Domain', 'required|min_length[5]');
	$this->form_validation->set_rules('title', 'title', 'required|min_length[5]|max_length[65]');
	$this->form_validation->set_rules('metaKeyword', 'Meta Keyword', 'required|min_length[5]');
	$this->form_validation->set_rules('metaDescription', 'Meta Description', 'required|min_length[5]|max_length[160]');
	// Check if username has changed
	$data['getdomain']= get_domain_lists();
	$data['getdomains'] = $this->models->get_domain();
	//var_dump($data['getdomain']);
	//die();
	if($this->form_validation->run() == FALSE)
	{		
		
		
		$this->load->view('add',$data);
		$this->footer();
	}
  else {
	$data = array(
	'title' => $this->input->post('title').";",
	'domain' => $this->input->post('domain'),
	'metaKeyword' => $this->input->post('metaKeyword').";",
	'metaDescription' => $this->input->post('metaDescription').";",	
	'insertyBy' => $this->input->post('updateby'),
	'google_verification' => $this->input->post('google_verification').";",
	'google_analytics' => $this->input->post('google_analytics').";"
	);
	$this->models->index($data);
	echo '<script>alert("You Have Successfully insert this Record!");</script>';
	$url = 'tag/showdata';
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
$data['single_content'] = $this->models->update_notice($id);
$this->load->view('add', $data);
$this->footer();
}
//particular id = did;
function edit() {
	$this->form_validation->set_rules('google_verification', 'Google Verification', 'required|min_length[5]');
	$this->form_validation->set_rules('google_analytics', 'Google Analytics', 'required|min_length[5]');
	$this->form_validation->set_rules('domain', 'Domain', 'required|min_length[5]');
	$this->form_validation->set_rules('title', 'title', 'required|min_length[5]|max_length[65]');
	$this->form_validation->set_rules('metaKeyword', 'Meta Keyword', 'required|min_length[5]');
	$this->form_validation->set_rules('metaDescription', 'Meta Description', 'required|min_length[5]|max_length[160]');
		// Check if username has changed
	
	if($this->form_validation->run() == FALSE)
	{
		$id = $this->uri->segment(3);
		$data['single_content'] = $this->models->update_notice($id);
		$this->load->view('add',$data);
	}
	else{
	   $id = $this->uri->segment(3); 
	   $data = array(
			'title' => $this->input->post('title').";",	
			'domain' => $this->input->post('domain'),	
			'metaKeyword' => $this->input->post('metaKeyword').";",
			'metaDescription' => $this->input->post('metaDescription').";",	
			'google_verification' => $this->input->post('google_verification').";",
			'google_analytics' => $this->input->post('google_analytics').";"
			);
		$data = $this->models->notice_update($id,$data);
		//  $this->show_content_id();
		// if($data)
		// {
		echo '<script>alert("You Have Successfully updated this Record!");</script>';
		$url = 'tag/showdata';
		echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
		// }
		// else{
		// echo '<script>alert("You Have Successfully updated this Record!");</script>';
		// $url = 'tag/showdata';
		// echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
		// }
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
$url = 'tag/showdata';
  echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
else{
  echo '<script>alert("You Have Not Successfully delete this Record!");</script>';
  $url = 'tag/showdata';
  echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
}


//Code configuration status

public function code_staus_update()
{
	 $code_staus = $_POST['data'];
	 $this->models->code_staus_update($code_staus);
}

//verification status

public function code_verification()
{
	 $code_staus = $_POST['data'];
	 $this->models->code_verification($code_staus);
}

}