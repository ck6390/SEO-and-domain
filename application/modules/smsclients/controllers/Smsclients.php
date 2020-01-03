<?php
class Smsclients extends MX_Controller {
function __construct() {
parent::__construct();
	$this->load->model('Smsclients_m','models');	
	$this->load->helper('sms_helper');
	if($this->session->userdata('logged_in') == FALSE) {
			$this->session->set_flashdata('error','<p class="alert alert-danger">Please login to view this page.</p>');
			redirect('login');
			exit;			
		}
 }
public function footer()
{
	$this->load->view('../../template/footer/footer');
}
//Insert Data into BD-----------//
	function index()
	{
		echo Modules::run('dashboard');
		
		$data['sms_client']= get_sms_clients();
		//var_dump($data);
		//die();
		$this->load->view('data_list',$data);
		$this->footer();  
	}

	public function check_sms_bal(){
		//echo $_POST['user_id'];
		$client_id = $_POST['client_id'];   
	 	$get_bal = check_balance($client_id);
	 	//var_dump($get_bal);
	 	if(@$get_bal['responseCode'] == '3009'){
	 		echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>Invalid Password</h3>";
	 	}elseif(@$get_bal['responseCode'] == '3018'){
	 		echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>".@$get_bal['response']."</h3>";
	 	}
	 	else{
	 		echo "<tr><th>Available Balance</th><th class='text-center'> : </th>
             <td class='btn btn-primary'>".@$get_bal[0]['routeBalance']."</td></tr><tr><th>SMS Type</th><th class='text-center'> : </th><td>".@$get_bal[0]['displayRouteName']."</td></tr>";
	 		
	 	}
	}

	public function update_expiry(){
		$client_id = $_POST['user_id'];
		$user_name = $_POST['user_name'];
		$exp_date = date('d/m/Y',strtotime($_POST['exp_date']));
		if(!empty($_POST['exp_date'])){
		 	$update_exp = update_expiry_sms($client_id,$user_name,$exp_date);
		 	if($update_exp){
		 		echo "<h3 class='text-center btn btn-success' style='color:#fff !important;'>Expiry update successfully!</h3>";
		 	}else{
		 		echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>Something went wrong. Please try again!</h3>";
		 	}
		}else{
			echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>Please select expiry date. Please try again!</h3>";
		}
	}

	public function forget_password(){
		$user_name = $_POST['user_name'];
	 	$forget_password = forget_pass_sms($user_name);
	 	if($forget_password){
	 		echo "<h3 class='text-center btn btn-success' style='color:#fff !important;'>Password update successfully. Please check register contact number!</h3>";
	 	}else{
	 		echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>Something went wrong. Please try again!</h3>";
	 	}
	}

	public function change_password(){
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		if(!empty($password) && !empty($user_name)){
		 	$change_pass = change_pass_sms($user_name,$password);
		 	if($change_pass){
		 		echo "<h3 class='text-center btn btn-success' style='color:#fff !important;'>Password change successfully!</h3>";
		 	}else{
		 		echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>Something went wrong. Please try again!</h3>";
		 	}
		}else{
			echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>Password can't be empty . Please try again!</h3>";
		}
	}

	public function add(){
		//var_dump("expression");
		//die;
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('user_name', 'User Name', 'required');
		$this->form_validation->set_rules('mob_no', 'Contact Number', 'required|min_length[10]');
		$this->form_validation->set_rules('user_email', 'Email Id', 'required');
		$this->form_validation->set_rules('expiry', 'Expiry Date','required');
		// Check if username has changed
	
		if($this->form_validation->run() == FALSE)
		{
			//$noticedata['single_content'] = '';
			echo Modules::run('dashboard');
			$this->load->view('add');
			$this->footer();
		}
	    else {
			//$data = array(
				$fname = $this->input->post('fname');
				$lname = $this->input->post('lname');
				$user_name = $this->input->post('user_name');
				$mob_no = $this->input->post('mob_no');
				$user_email = $this->input->post('user_email');
				$expiry = date('d/m/Y',strtotime($this->input->post('expiry')));
				$utype = $this->input->post('utype');				
			
			$add_client = add_sms_clients($fname,$lname,$user_name,$mob_no,$user_email,$expiry,$utype );		
			if($add_client['response'] == 'success')
			{
				$data_client = array(
					'auth_key'=>$add_client['authKey'],
					'user_name'=>$user_name
				);
				$this->models->add_auth_key($data_client);
				echo '<script>alert("You Have Successfully add client!");</script>';
			}else{
				echo '<script>alert("Something went wrong. Please try again!");</script>';
			}
			$url = 'smsclients';
			echo '<script>window.location.href = "'.base_url().'index.php/'.$url.'";</script>';
		}
	}

	public function send_otp(){		
		$user_name = $_POST['user_name'];	
		$user_id = $_POST['user_id'];
		$random = mt_rand(10000,999999);
		$this->session->set_userdata('random', $random);
		$this->session->set_userdata('user_id', $user_id);
		$this->session->set_userdata('user_name', $user_name);		
		$message_bodysms= 'User Name  : - ' . $user_name."\n".'OTP : - '.$random;		
		$urlencode = urlencode($message_bodysms);
		if(send_sms($urlencode)){				
			echo "<h3 class='text-center btn btn-success' style='color:#fff !important;'>OTP sent successfully!</h3>";			
		}
	}

	public function verify_otp(){
		//echo $user_name;
		$random = $this->session->userdata('random');
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('user_name');
		$otp = $this->input->post('otp');
		if(!empty($otp)){		
			if($random == $otp){
				$this->models->remove_auth_key($user_name);
				//die();
				if(remove_user_sms($user_name,$user_id)['response'] == "success"){
					echo "<h3 class='text-center btn btn-success' style='color:#fff !important;'>Remove client successfully!</h3>";
				}
			}else{
				echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>OTP not match. Please try again!</h3>";
			}
		}else{
			echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>OTP can't be empty. Please try again!</h3>";
		}
	}

	public function add_fund(){
		$random = $this->session->userdata('random');
		$user_id = $_POST['user_id'];
		$routeId = $_POST['routeId'];
		$sms = $_POST['sms'];
		$amount = $_POST['amount'];
		$trasactiontype = $_POST['trasactiontype'];
		$description = $_POST['description'];
		$otp_fund = $_POST['otp_fund'];		
		if(!empty($sms) && !empty($amount) && !empty($trasactiontype) && !empty($description) && !empty($otp_fund)){			
			if($random == $otp_fund){
				if(add_fund_sms($user_id,$routeId,$sms,$amount,$trasactiontype,$description)['response']=="success"){
					if($trasactiontype = $_POST['trasactiontype']=="Normal"){
						echo "<h3 class='text-center btn btn-success' style='color:#fff !important;'>Add fund to client successfully!</h3>";
					}else{
						echo "<h3 class='text-center btn btn-success' style='color:#fff !important;'>Deduct fund from client successfully!</h3>";
					}
				}else{
					echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>Something went wrong. Please try again!</h3>";
				}
			}else{
				echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>OTP not match. Please try again!</h3>";
			}
		}else{
			echo "<h3 class='text-center btn btn-danger' style='color:#fff !important;'>Fill all fields. Please try again!</h3>";
		}
	}
	
	public function ckeck_reseller_balance_sms(){
		$reseller_bal = check_reseller_balance();
		$count = 1;
        foreach ($reseller_bal as $value) {
            if($value['routeBalance'] !=0 ){
            echo "<tr>
                    <td>".$count++."</td>
                    <td>".$value['displayRouteName']."</td>
                    <td class='btn-xs btn btn-primary col-md-4 border_radius_none'>".$value['routeBalance']."</td>
                 </tr>";              
            }
        }
	}
}