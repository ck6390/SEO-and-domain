  <?php 
        $servername = "localhost";
        $username = "microfil_fil_seo";
        $password= "Admin_123$$";
        $db_name = "microfil_fil_seo";
        $conn = mysqli_connect($servername, $username, $password, $db_name);
        if(!$conn){
            die("connection not created" . mysqli_connect_error);
        }
        $query = "SELECT * FROM message_setting WHERE status = '1' order by id DESC";
        $res = mysqli_query($conn,$query);
     
		$sql = "SELECT * FROM seo_clients WHERE status = '1'";
		$result = mysqli_query($conn,$sql);
		//$seo_clients = json_encode($result, true);
		//var_dump($seo_clients);
		//die;
        // set your key and secret
 
    while($rows = mysqli_fetch_array($result))
    {
            
		//var_dump($rows['renewal_date']);
       // die();
	    //die();
       if(strtotime("+5 days")  > strtotime($rows['renewal_date']) && strtotime('now') < strtotime($rows['renewal_date']))
            {  //die("dgsdgs"); 
				// "hr@filliptechnologies.com,".
				//var_dump($result);
                if(mysqli_num_rows($res)){
                    while($row = mysqli_fetch_array($res)){
                     $to .= @$row['emails'].',';
                     $cc_to .= @$row['cc_emails'].',';
					}
				}
				//echo $to;
				//die();
				//$to ="hr@filliptechnologies.com,"."vikash@filliptechnologies.com,"."aastha@filliptechnologies.com";
					$subject = "Seo Client Expiry";
					$txt = "Client Name - ".$rows['clients_name']."\n"."Expiry Date - ".date('d-M-Y',strtotime($rows['renewal_date']))."Renewal Amount - ".$rows['total_amount'];
					$headers = "From: domainfilliptech@gmail.com" . "\r\n".
					"CC:{$cc_to}";
					if(mail($to,$subject,$txt,$headers))				
					{					
						echo "Mail sent successfully.";
					} 				
            }
			// var_dump(strtotime("+4 days"));
			// var_dump(strtotime('now'));
			// var_dump(strtotime($domain_exp));
			// die();
        if(strtotime("+2 days")  > strtotime(date('d-m-Y',strtotime($rows['renewal_date']))) && strtotime('now') < strtotime($rows['renewal_date']))
            {
			  // var_dump("sdgsd");
			   // die();
               $smsGatewayUrl='http://66.70.200.49';
                //api element
                $apiElement='/rest/services/sendSMS/sendGroupSms';
                //Your authentication key
                $authKey='3e377f8fcc852e1ceb8262ea7d82913';
                //Your message to send, Add URL encoding here.
                $message_body = "Client Name - ".$rows['clients_name']."\n"."Expiry Date - ".date('d-M-Y',strtotime($rows['renewal_date']))."Renewal Amount - ".$rows['total_amount'];
                $message=urlencode($message_body);
                //Sender ID
                $senderId='FILLIP';
                //$senderId='THEART';
                //Define route 
                $routeId='1';
               // $number = "7004770290";
                if(mysqli_num_rows($res)){
                    while($row = mysqli_fetch_array($res)){
                     $number .= $row['contact_number'].",";
					}
                }
                //$number = "7545999993,7545999990,7004770290";
                //Multiple mobiles numbers separated by comma
                $mobileNumber=$number;
                //SMS content type
                $smsContentType='unicode';
                //api parameters
                $api_params=$apiElement.'?AUTH_KEY='.$authKey.'&message='.$message.'&senderId='.$senderId.'&routeId='.$routeId.'&mobileNos='.$mobileNumber.'&smsContentType='.$smsContentType;
                $smsgatewaydata=$smsGatewayUrl.$api_params;
                $url = $smsgatewaydata;
                $ch3 = curl_init();
                curl_setopt($ch3, CURLOPT_POST, false);
                curl_setopt($ch3, CURLOPT_URL, urldecode($url));
                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch3);
                curl_close($ch3);
                if(!$output)
                {
                    $output = file_get_contents($smsgatewaydata);
                }
                if($output)
                {
					echo "MSG sent successfully.";
                   // return $output;
                }
                else
                {
                    return true; 
                }
				 
            }
		//var_dump($txt);
	//die();
    }