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

        $dn2 = json_decode($result, true);

        $dn1 = json_decode($result1, true);

        $merge_domain = array_merge($dn2,$dn1);

        $dn = $merge_domain;//json_decode($merge_domain, true);
        
       // return $dn;

   for($i=0; $i<sizeOf($dn); $i++)
    {
      // echo strtotime(date('d-m-Y', strtotime(@$dn[$i]['expires']))).$dn[$i]['domain']."<br/>";
    
       //die();
       $domain_exp = $dn[$i]['expires'];   
		//var_dump($domain_exp);
        //die();
	    //die();
       if(strtotime("+10 days")  > strtotime($domain_exp) && strtotime('now') < strtotime($domain_exp))
            {  //die("dgsdgs"); 
				// "hr@filliptechnologies.com,".
				//var_dump($result);
                if(mysqli_num_rows($res)){
                    while($row = mysqli_fetch_array($res)){
                     $to .= $row['emails'].',';
                     $cc_to .= $row['cc_emails'].',';
					}
				}
				//echo $to;
				//die();
				//$to ="hr@filliptechnologies.com,"."vikash@filliptechnologies.com,"."aastha@filliptechnologies.com";
					$subject = "Domain Expiry";
					$txt = "Domain - ".$dn[$i]['domain']."\n"."Expiry Date - ".date('d-M-Y',strtotime($domain_exp));
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
        if(strtotime("+2 days")  > strtotime(date('d-m-Y',strtotime($domain_exp))) && strtotime('now') < strtotime($domain_exp))
            {
			  // var_dump("sdgsd");
			   // die();
               $smsGatewayUrl='http://66.70.200.49';
                //api element
                $apiElement='/rest/services/sendSMS/sendGroupSms';
                //Your authentication key
                $authKey='3e377f8fcc852e1ceb8262ea7d82913';
                //Your message to send, Add URL encoding here.
                $message_body = "Domain - ".$dn[$i]['domain']."\n"."Expiry Date - ".date('d-M-Y',strtotime($domain_exp));
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