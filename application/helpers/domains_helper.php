<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	$result = array();
	$result1 = array();
if (!function_exists('get_domain_lists')) {

    function get_domain_lists($data = '') {
       $url = "https://api.godaddy.com/v1/domains/";
		// set your key and secret
		$header = array(
			'Authorization: sso-key 9uLN8xomEzL_6fbSqiCvzLPDuPfB7D4MDT:6fbYBZJedNzf5C6sKK548R'
		);
		$headers = array(
			'Authorization: sso-key dLDMpKe3kfyu_VJfrJMn2MiWsK2a9owXfJM:VJgUeUt2g3gaNFcqMTqFC1'
		);

		//open connection
		$ch = curl_init();
		$timeout=60;

		//set the url and other options for curl
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); // Values: GET, POST, PUT, DELETE, PATCH, UPDATE 
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $variable);
		//curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	   // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		//execute call and return response data.
		$result = curl_exec($ch);

		//close curl connection
		curl_close($ch);
		
		///////////////////////////////////////////////////////////////
	
		$ch1 = curl_init();
		$timeout=60;

		//set the url and other options for curl
		curl_setopt($ch1, CURLOPT_URL, $url);
		curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER,false);  
		curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'GET'); // Values: GET, POST, PUT, DELETE, PATCH, UPDATE 
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $variable);
		//curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
	  //  curl_setopt($ch, CURLOPT_HTTPHEADER, $merge_domain);
	   //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		//execute call and return response data.
		$result1 = curl_exec($ch1);

		//close curl connection
		curl_close($ch1);
		// decode the json response
		
		$dn = json_decode($result, true);
		$dn1 = json_decode($result1, true);
		$merge_domain = array_merge($dn,$dn1);
		$data = $merge_domain;//json_decode($merge_domain, true);
		return $data;
    }
}
	if (!function_exists('total_amount_of_seo')) {
		function total_amount_of_seo()
			{
				$ci = & get_instance();
				$ci->db->select('SUM(total_amount) as total_amt , SUM(paid_amount) as total_amt_collection');
				$ci->db->from('seo_clients');
				return $ci->db->get()->row();
			} 
	}