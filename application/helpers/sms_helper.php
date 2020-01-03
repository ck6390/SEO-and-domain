<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	$result = array();    
if (!function_exists('common_variables')) {
    function common_variables(){
        $result = array(
            'url_sms' => "http://66.70.200.49/",
            'auth_key_reseller' => "3e377f8fcc852e1ceb8262ea7d82913"
        );
        return $result;
    }
}
if (!function_exists('get_sms_clients')) {

    function get_sms_clients($data = '') {
    	$url = common_variables()['url_sms']."rest/services/client/clientList?AUTH_KEY=".common_variables()['auth_key_reseller'];
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
        curl_close($ch);

        return $sms_client = json_decode($output, true);
    }
}
if(!function_exists('check_balance')){
	function check_balance($client_id){
       echo $url=common_variables()['url_sms']."rest/services/sendSMS/getClientRouteBalance?AUTH_KEY=".common_variables()['auth_key_reseller']."&clientId={$client_id}";       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
        curl_close($ch);

        return $sms_bal = json_decode($output, true);
	}	
}

if(!function_exists('update_expiry_sms')){
    function update_expiry_sms($client_id,$user_name,$exp_date){       
        $url=common_variables()['url_sms']."rest/services/client/updateExpiry?AUTH_KEY=".common_variables()['auth_key_reseller']."&userName={$user_name}&clientId={$client_id}&expiryDate={$exp_date}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
        curl_close($ch);
        return $update_expiry = json_decode($output, true);
    }
}

if(!function_exists('forget_pass_sms')){
    function forget_pass_sms($user_name){      
        $url=common_variables()['url_sms']."rest/forgotpassword/{$user_name}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
}

if(!function_exists('change_pass_sms')){
    function change_pass_sms($user_name,$password){
        $url = "http://mysms.msgclub.net/rest/ChangePassByReseller?AUTH_KEY=".common_variables()['auth_key_reseller'];
        $post_arr = array('userName'=>$user_name,'password'=>$password);
        $json_en = json_encode($post_arr);
        //json_encode($post_arr);
        //die;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_en);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json')
        ); 
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
       
    }
}

if (!function_exists('add_sms_clients')) {
    function add_sms_clients($fname,$lname,$user_name,$mob_no,$user_email,$expiry,$utype)
     {   
        $url = common_variables()['url_sms']."rest/services/client/v2/addClient?AUTH_KEY=".common_variables()['auth_key_reseller']."&fname=".$fname."&lname=".$lname."&user_name=".$user_name."&mob_no=".$mob_no."&user_email=".$user_email."&expiry=".$expiry."&utype=".$utype;
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }
}

if(!function_exists('remove_user_sms')){
    function remove_user_sms($user_name,$user_id){        
        $url = common_variables()['url_sms']."rest/services/client/deleteClient?AUTH_KEY=".common_variables()['auth_key_reseller']."&userName=".$user_name."&clientId=".$user_id;
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }
}


if(!function_exists('get_auth_key')){
    function get_auth_key(){
        $ci = & get_instance();
        $ci->db->select('S.*');
        $ci->db->from('sms_auth_key AS S');
        $data = $ci->db->get()->result();
        $result = array();
        foreach ($data as $value) {
            $result[$value->user_name] = array(
                'user_name'=>$value->user_name,
                'auth_key'=>$value->auth_key
            );
        }
        return $result;
    }
}

if(!function_exists('send_sms')){
    function send_sms($urlencode){  
        $message=urlencode($urlencode);
        //Sender ID
        $senderId='FILLIP';
        $routeId='1';
        $number = "7004770290";
        //SMS content type
        $smsContentType='unicode';
        $apiElement='rest/services/sendSMS/sendGroupSms';
        //api parameters
        $api_params=$apiElement.'?AUTH_KEY='.common_variables()['auth_key_reseller'].'&message='.$message.'&senderId='.$senderId.'&routeId='.$routeId.'&mobileNos='.$number.'&smsContentType='.$smsContentType;
        $smsgatewaydata= common_variables()['url_sms'].$api_params;
        $url = $smsgatewaydata;
        //die;
        $ch3 = curl_init();
        curl_setopt($ch3, CURLOPT_POST, false);
        curl_setopt($ch3, CURLOPT_URL, urldecode($url));
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch3);
        curl_close($ch3);
        if(!$output)
            {
                $output = file_get_contents($smsgatewaydata);
            }
        return $output;    
    }
}

if(!function_exists('add_fund_sms')){
    function add_fund_sms($user_id,$routeId,$sms,$amount,$trasactiontype,$description){
        $url = common_variables()['url_sms']."rest/services/client/transferCredit?AUTH_KEY=".common_variables()['auth_key_reseller']."&clientId=".$user_id."&routeId=".$routeId."&sms=".$sms."&amount=".$amount."&transactiontype=".$trasactiontype."&description=".$description;
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }
}

if(!function_exists('check_reseller_balance')){
    function check_reseller_balance(){
        $url = common_variables()['url_sms']."rest/services/sendSMS/getClientRouteBalance?AUTH_KEY=".common_variables()['auth_key_reseller'];      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, urldecode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }
}