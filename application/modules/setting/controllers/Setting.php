<?php
class Setting extends MX_Controller {
function __construct() {
parent::__construct();
	$this->load->model('Setting_m','models');
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
	$this->form_validation->set_rules('emails', 'Email', 'required|min_length[5]|is_unique[message_setting.emails]');
	$this->form_validation->set_rules('cc_emails', 'CC Email', 'min_length[5]|is_unique[message_setting.cc_emails]');
	$this->form_validation->set_rules('contact_number', 'Contact Number', 'min_length[10]|is_unique[message_setting.contact_number]');
	// Check if username has changed
	
	if($this->form_validation->run() == FALSE)
	{
		//$noticedata['single_content'] = '';
		$this->load->view('add');
		$this->footer();
	}
  else {
	$data = array(
	'emails' => $this->input->post('emails'),
	'cc_emails' => $this->input->post('cc_emails'),
	'contact_number' => $this->input->post('contact_number'),
	'insertyBy' => $this->input->post('updateby'),	
	);
	$this->models->index($data);
	echo '<script>alert("You Have Successfully insert this Record!");</script>';
	$url = 'setting/showdata';
	echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
}

//Fetch notice data from database display in data table
public function showData()
{
//$data['contentdata'] = $this->notice_m->getUsers();  //Array object into stored only $data['contentdata'] this value accessible view as $contentdata
$data['get_data'] = $this->models->get_all();
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
	'emails' => $this->input->post('emails'),
	'cc_emails' => $this->input->post('cc_emails'),
	'contact_number' => $this->input->post('contact_number')		
);
$this->models->notice_update($id,$data);
//  $this->show_content_id();
if($data == TRUE)
{
echo '<script>alert("You Have Successfully updated this Record!");</script>';
$url = 'setting/showdata';
echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
}
else{
echo '<script>alert("You Have Not Successfully updated this Record!");</script>';
$url = 'setting/showdata';
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
	$url = 'setting/showdata';
	  echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
	}
	else{
	  echo '<script>alert("You Have Not Successfully delete this Record!");</script>';
	  $url = 'setting/showdata';
	  echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
	}
}
//deactivate user
	public function deactivate($id)
	{	       
		if ($this->models->deactivateUser($id))
			{
				# Add success
				$this->session->set_flashdata('message', 'Updated status.(Unapproved)');
				redirect('setting', 'referesh');
			}
			else
			{
				# Failed
				$this->session->set_flashdata('message', 'Can\'t update status.');
				redirect('setting', 'referesh');
			}	
	}

	//activate user
	public function activate($id)
	{
		if ($this->models->activateUser($id))
			{
				# Add success
				$this->session->set_flashdata('message', 'Updated status(Approved).');
				redirect('setting/index', 'referesh');
			}
			else
			{
				# Failed
				$this->session->set_flashdata('message', 'Can\'t update status.');
				redirect('setting', 'referesh');
			}
		
	}

///////////////Get domain from server//////////////////////////

	// public function get_domain_lists()
	// {
		
		
	// }


}