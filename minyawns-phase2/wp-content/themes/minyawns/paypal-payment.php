<?php

/*
 * Template Name: Paypal Payment
 */


global $minyawn_job;
global $wpdb;


 
$paypal_email = PAYPAL_BUSINESSEMAIL;
 
 
$return_url = PAYPAL_PAYMENTSITE.'/success-payment/';
$cancel_url = PAYPAL_PAYMENTSITE.'/cancel-payment/'."?mntx=".$_POST['custom']."&jb=".$_POST['amount']."&amnt=".$_POST['amount'];
$notify_url = PAYPAL_PAYMENTSITE.'/paypal-payments/';
//}





// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){

	// Firstly Append paypal account to querystring
    
    $salt_job = wp_generate_password(20); // 20 character "random" string
            $key_job = sha1($salt . $_POST['item_number'] . uniqid(time(), true));

	  $paypal_payment = array('minyawn_txn_id' => $_POST['custom'], 'paypal_txn_id' => '', 'status' => '', 'minyawns_selected' =>$_POST['minyawn_id']);
          update_post_meta($_POST['item_number'], 'paypal_payment', $paypal_payment);
            
            
            
	$querystring .= "?business=".urlencode($paypal_email)."&";	
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	 
	 
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."& ";
	$querystring .= "notify_url=".urlencode($notify_url)."& ";
	$querystring .= "currency_code=USD";
	

 
       header('location:'.PAYPAL_SEC_PAYMENTSITE.'/cgi-bin/webscr'.$querystring);
	exit();

}
else
{
			get_header();			
			
			$data['receiver_id']			= $_POST['receiver_id'];
			$data['shipping']			= $_POST['shipping'];
			$data['item_name']			= $_POST['item_name'];
			$data['item_number'] 		= $_POST['item_number'];
			$data['payment_status'] 	= $_POST['payment_status'];
			$data['payment_amount'] 	= $_POST['mc_gross'];
			$data['payment_currency']	= $_POST['mc_currency'];
			$data['txn_id']				= $_POST['txn_id'];
			$data['receiver_email'] 	= $_POST['receiver_email'];
			$data['payer_email'] 		= $_POST['payer_email'];
			$data['custom'] 			= $_POST['custom'];
			$data['mc_fee'] = trim($_POST['mc_fee']);
			//$mc_gross = $_POST['mc_gross'];
			$data['mc_gross1']	 = trim($_POST['mc_gross1']);
			//$total_amount = $amount + $tax;
			$data['total_amount'] = trim($_POST['mc_gross']);
                        
                        
			
			
			$item__number = $data['item_number'];
			
			
			
			
	
	
			if( (isset($_POST["txn_id"])) && (isset($_POST["custom"])) )
			{	
				update_paypal_payment($data,'');
				
			}//end 	if( (isset($_POST["txn_id"])) && (isset($_POST["custom"])) )	
	
	
			// STEP 1: read POST data
			
			// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
			// Instead, read raw POST data from the input stream.
			$raw_post_data = file_get_contents('php://input');
			$raw_post_array = explode('&', $raw_post_data);
			$myPost = array();
			
			foreach ($raw_post_array as $keyval) 
			{
				$keyval = explode ('=', $keyval);
				if (count($keyval) == 2)
					$myPost[$keyval[0]] = urldecode($keyval[1]);
			}
			// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
			
			
			$req = 'cmd=_notify-validate';
			if(function_exists('get_magic_quotes_gpc')) 
			{
				$get_magic_quotes_exists = true;
			}
			
			
			foreach ($myPost as $key => $value) 
			{
				if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) 
				{
					$value = urlencode(stripslashes($value));
				}
				else
				{
					$value = urlencode($value);
				}
				$req .= "&$key=$value";
			}
			
			
			
			
	
 
                        $url = PAYPAL_SEC_PAYMENTSITE.'/webscr';
                        
                        $curl_result=$curl_err='';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: " . strlen($req),'Host: www.paypal.com'));
			curl_setopt($ch, CURLOPT_HEADER , 0);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$curl_result = @curl_exec($ch);
			$curl_err = curl_error($ch);
			curl_close($ch);
			
			$req = str_replace("&", "\n", $req);
			
			
			if ($curl_result== "VERIFIED") 
			{
								
				$mail_data = "\n\nPaypal Verified OK";							
				
				$job_data = get_post($item__number);
				
				$paypal_payment_meta = get_paypal_payment_meta($data['txn_id'],$data['custom'],$data['item_number']);
				$meta_sel_minyawns=array();
				foreach($paypal_payment_meta as $k_meta_pay=>$v_meta_pay )
				{
					if($k_meta_pay=='minyawns_selected')
					{
						$meta_sel_minyawns = explode(",",$v_meta_pay);
						//get user details
						foreach($meta_sel_minyawns as $k=>$v)
						{
							if($v!="")
							{
								$minyawn_data[] = get_userdata($v);
									
							}
						}
							
					}
				}
				
				
				
				if(($data['payment_status']=="Completed") )
				{
					  
					update_paypal_payment($data,$curl_result);
					  	 
					/*add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
					wp_mail('paragredkar@gmail.com', "verified",  $req.'curl result'.$curl_result );*/

					$receiver_subject = "Minyawns - Payment successfull for ".$data['item_name']." job";
					
					$receiver_message.="Hi,<br/><br/>
							
							Payment for '".get_the_title($data['item_number'] )."' successfully transferred .
							<br/><b>Transaction ID  :</b> ".$data['txn_id']."
							<br/><b>Job    			:</b> ".get_the_title($data['item_number'] )."
							<br/><b>Total Amount 			:</b> ".$data['total_amount']."
					
					<br/><b>selected Minyawns	:</b> ";
					
					
					//$receiver_message.= "<br/><br/>***".print_r($minyawn_data,true)."<br/><br/>";
					$cnt_sel_minyawns  = 1;
					$wages_minyawns = get_post_meta($data['item_number'] , 'job_wages', true) - ( (get_post_meta($data['item_number'] , 'job_wages', true) *10)/100 );
					
                                        foreach($minyawn_data as $key=>$value)
					{
						//$receiver_message.= "<br/><br/>###".print_r($key,true)."  --- ".print_r($value,true);
					
						$receiver_message.= "<br/>".$cnt_sel_minyawns.". ".$value->display_name."  ".$value->user_email;
						
						
						
						//update selected minyawns status to hired
						$wpdb->get_results("UPDATE {$wpdb->prefix}userjobs SET status = 'hired' WHERE user_id = '" . $value->ID . "' AND job_id = '" . $data['item_number'] . "'");
						update_post_meta($data['item_number'],'job_status','completed');
						//send mail to hired minyawns						
						$job_data = get_post($data['item_number']);
						//$minyawns_subject = "Minyawns - You have been hired for " . get_the_title($data['item_number'] ); 
						$minyawns_subject = "Minyawns - You have been hired! ";
               			$minyawns_message = "Hi,<br/><br/>
                		Congratulations, You have been hired for the job '" . get_the_title($data['item_number'] ) . "'<br/><br/>
                		<h3>Job: " . get_the_title($data['item_number'] ) . "</h3>                
                		<br/><b>Start date: </b>" . date('d M Y', get_post_meta($data['item_number'] , 'job_start_date', true)) . "
                		<br/><b>Start Time: </b>" . date('g:i a', get_post_meta($data['item_number'] , 'job_start_time', true)) . "                		 
					    <br/><b>End Time: </b>" . date('g:i a', get_post_meta($data['item_number'] , 'job_end_time', true)) . "	
                		<br/><b>Location: </b>" . get_post_meta($data['item_number'] , 'job_location', true) . "
						<br/><b>Wages: </b> $" . $wages_minyawns . "
                		<br/><b>Details: </b>" . $job_data->post_content . "
                
                		<br/><br/>
               
                		";
		                add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
		                $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
		                wp_mail($value->user_email, $minyawns_subject, email_header() . $minyawns_message . email_signature(), $headers);
								
		                
		                
		                
						
						
						

					$cnt_sel_minyawns++;
					}
							 
									
					$receiver_message.= "

	                		<br/><b>Job Date : </b>". date('d M Y',   get_post_meta($item__number,'job_start_date',true))."
	                		<br/><b>Start Time : </b>". date('g:i a',  get_post_meta($item__number,'job_start_time',true))."	                		
						    <br/><b>End Time : </b>". date('g:i a',  get_post_meta($item__number,'job_end_time',true))."
	                		<br/><b>Location : </b>". get_post_meta($item__number,'job_location',true)."
							<br/><b>Wages : </b> $".get_post_meta($item__number,'job_wages',true)."
	                		<br/><b>Details : </b>".$job_data->post_content."
									
									
							<br/><br/><br/>
							";
					
					
					
					
					
					add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
					$headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
					wp_mail($data['receiver_email'], $receiver_subject, email_header() . $receiver_message . email_signature(), $headers);
					
					$sender_subject = "Minyawns - Payment successfull for ".$data['item_name']." job";
					$sender_message.="Hi,<br/><br/>
				
							Your Payment for '".$data['item_name']."' successfully Completed .
							<br/><b>Transaction ID : </b> ".$data['txn_id']."
							<br/><b>Total Amount 			: </b> ".$data['total_amount']."
									
									
							<br/><b>Selected Minyawns	: </b> ";					
					
							//$receiver_message.= "<br/><br/>***".print_r($minyawn_data,true)."<br/><br/>";
							$cnt_sel_minyawns  = 1;
							foreach($minyawn_data as $key=>$value)
							{
								//$receiver_message.= "<br/><br/>###".print_r($key,true)."  --- ".print_r($value,true);
							
								$sender_message.= "<br/>".$cnt_sel_minyawns.". ".$value->display_name."  ".$value->user_email;
		
							$cnt_sel_minyawns++;
							}
							 
									
					$sender_message.= "		
							<br/><b>Job    		   :</b> ".$data['item_name']."
							<br/><b>Job Date : </b>". date('d M Y',get_post_meta($item__number,'job_start_date',true))."
							<br/><b>Start Time : </b>". date('g:i a',get_post_meta($item__number,'job_start_time',true))."							
							<br/><b>End Time : </b>". date('g:i a',get_post_meta($item__number,'job_end_time',true))."							 
							<br/><b>Location : </b>". get_post_meta($item__number,'job_location',true)."
							<br/><b>Wages : </b>".get_post_meta($item__number,'job_wages',true)."
							<br/><b>Details : </b>".$job_data->post_content."		
					
							<br/><br/><br/>
							";
						
					add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
					$headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
					wp_mail($data['payer_email'], $sender_subject, email_header() . $sender_message . email_signature(), $headers);
					
							
				}
				
		
			}
			else if($curl_result=="Failed")
			{
				 
				
				update_paypal_payment($data,$curl_result);
			 
				
				update_post_meta($data['item_number'],'job_status','failed');
				
				
				$receiver_subject = "Minyawns - Payment Failed for ".$data['item_name']." job";
				$receiver_message.="Hi,<br/><br/>
				
							Payment failed for '".$data['item_name']."'.
							<br/><b>Transaction ID  : </b> ".$data['txn_id']."
							<br/><b>Total Amount 			:</b> ".$data['total_amount']."	
						
							<br/><b>Selected Minyawns	: </b> ";
					
					
							//$receiver_message.= "<br/><br/>***".print_r($minyawn_data,true)."<br/><br/>";
							$cnt_sel_minyawns  = 1;
							foreach($minyawn_data as $key=>$value)
							{
								//$receiver_message.= "<br/><br/>###".print_r($key,true)."  --- ".print_r($value,true);
							
								$receiver_message.= "<br/>".$cnt_sel_minyawns.". ".$value->display_name."  ".$value->user_email;
		
							$cnt_sel_minyawns++;
							}
								 
									
					$receiver_message.= "			
									
									
							<br/><b>Job    			: </b> ".$data['item_name']."							
							<br/><b>Job Date : </b>". date('d M Y',   get_post_meta($item__number,'job_start_date',true))."
							<br/><b>Start Time : </b>". date('g:i a',  get_post_meta($item__number,'job_start_time',true))."							
							<br/><b>End Time : </b>". date('g:i a',  get_post_meta($item__number,'job_end_time',true))."							 
							<br/><b>Location : </b>". get_post_meta($item__number,'job_location',true)."
							<br/><b>Wages : </b>".get_post_meta($item__number,'job_wages',true)."
							<br/><b>details : </b>".$job_data->post_content."		
					
							<br/><br/><br/>
							";
					
				add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
				$headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
				wp_mail($data['receiver_email'], $subject, email_header() . $receiver_message . email_signature(), $headers);
					
					
				$sender_subject = "Minyawns - Payment Failed for ".$data['item_name']." job";
				$sender_message.="Hi,<br/><br/>
				
							Your Payment failed for '".$data['item_name']."'.
							<br/><b>Transaction ID  	: </b> ".$data['txn_id']."
							<br/><b>Job    				: </b> ".$data['item_name']."
							<br/><b>Amount 				: </b> ".$data['total_amount']."
			
							<br/><b>selected Minyawns	: </b> ";
					
					
							//$receiver_message.= "<br/><br/>***".print_r($minyawn_data,true)."<br/><br/>";
							$cnt_sel_minyawns  = 1;
							foreach($minyawn_data as $key=>$value)
							{
								//$receiver_message.= "<br/><br/>###".print_r($key,true)."  --- ".print_r($value,true);
							
								$sender_message.= "<br/>".$cnt_sel_minyawns.". ".$value->display_name."  ".$value->user_email;
		
							$cnt_sel_minyawns++;
							}
								 
									
					$sender_message.= "			
									
									
							<br/><b>Job    			:</b> ".$data['item_name']."							
							<br/><b>Job Date : </b>". date('d M Y',   get_post_meta($item__number,'job_start_date',true))."
							<br/><b>Start Time : </b>". date('g:i a',  get_post_meta($item__number,'job_start_time',true))."						 
							<br/><b>End Time : </b>". date('g:i a',  get_post_meta($item__number,'job_end_time',true))."							 
							<br/><b>Location : </b>". get_post_meta($item__number,'job_location',true)."
							<br/><b>Wages : </b>".get_post_meta($item__number,'job_wages',true)."
							<br/><b>details : </b>".$job_data->post_content."		
					
							<br/><br/><br/>
							";
				
				add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
				$headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
				wp_mail($data['payer_email'], $sender_subject, email_header() . $sender_message . email_signature(), $headers);
					
				exit();
			}



			get_footer();
	
	
}



 

 
