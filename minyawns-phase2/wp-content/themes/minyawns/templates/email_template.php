<?php

/**
 * Function to specify the templates for the various emails that go out.
 * @param string $type
 * @return array
 */
function email_template($emailid, $data, $type) {

    switch ($type) {

        case 'user_activate_reminder':
            $template = array(
                'hhtml' => email_template_header(),
                'fhtml' => email_template_footer(),
                'subject' => get_email_subject($type, $data),
                'message' => get_email_msg($type, $data, $emailid)
            );
            break;


        case 'user_incomplete_profile_reminder':
            $template = array(
                'hhtml' => email_template_header(),
                'fhtml' => email_template_footer(),
                'subject' => get_email_subject($type, $data),
                'message' => get_email_msg($type, $data, $emailid)
            );
            break;

        case 'user_no_activity_reminder':
            $template = array(
                'hhtml' => email_template_header(),
                'fhtml' => email_template_footer(),
                'subject' => get_email_subject($type, $data),
                'message' => get_email_msg($type, $data, $emailid)
            );
            break;

        case 'employer_jobcompletion_reminder':
            $template = array(
                'hhtml' => email_template_header(),
                'fhtml' => email_template_footer(),
                'subject' => get_email_subject($type, $data),
                'message' => get_email_msg($type, $data, $emailid)
            );
            break;
        
          case 'invite_minion':
            $template = array(
                'hhtml' => email_template_header(),
                'fhtml' => email_template_footer(),
                'subject' => get_email_subject($type, $data),
                'message' => get_email_msg($type, $data, $emailid)
            );
            break;

        default:
            $template = array(
                'hhtml' => "",
                'fhtml' => "",
                'subject' => "",
                'message' => "",
            );
            break;
    }
    return $template;
}

////////////////////////////////////////////////EMAIL TEMPLATE HTML/////////////////////////////////////////////////////

function email_template_header() {

    return '<div style=" width:600px; margin:auto;background:url(' . site_url() . '/wp-content/themes/minyawns/images/pattern-bg.png);border: 5px solid #CCC;">
			<!-- header --->
			<div style="background-color: rgba(0, 0, 0, 0.39);padding: 6px;">
			<img src="' . site_url() . '/wp-content/themes/minyawns/images/logo.png" />
					</div>
					<!--End of Header -->

					<!--Message -->

					<!--End Of Message -->

					<!--Footer -->
					<div style="margin-top:20px;">
					<div style="width:512px; margin:auto;">
					<div style=" font-size: 12px; line-height: 22px; ">';
}

function email_template_footer() {

    return '<br/><br/>Cheers!<br/>
			Minyawns Team<br/><br/>
			</div>
				

			</div>
			<div style="clear:both;"></div>

			<div style="background:#f8f8f8;clear:both;margin:5px 5px 5px 5px;height:40px;padding-left: 10px;">
			
							<br>

							<div style="background:url(' . site_url() . '/wp-content/themes/minyawns/images/arro-up.png)repeat-x;clear:both;margin:5px 5px 5px 5px;height:80px;padding-left: 10px;padding: 1px;">

									<h5 style="color:#ffffff;text-align:center;">Replies to this message are not monitored. Our Customer Service team is available to assist you here: </h5>
									<a href="mailto:support@minyawns.com">support@minyawns.com</a>
									</div>
									</div>
									<!--End of footer -->
									</div>';
}

/**
 *
 * @param string $type
 * @param array $data
 * @return string email subject
 */
function get_email_subject($type, $data) {

    switch ($type) {

        case 'user_activate_reminder' : if ($data['role'] == "employer") {
                $email_sub = __("[" . get_bloginfo('name') . "] - Reminder to activate your profile");
            } else if ($data['role'] == "minyawn") {
                $email_sub = __("[" . get_bloginfo('name') . "] - Reminder to activate your profile");
            }
            return $email_sub;

        case 'user_incomplete_profile_reminder' :
            if ($data['role'] == "employer") {
               // $email_sub = __("[" . get_bloginfo('name') . "] - Attract more applicants with a complete profile");
        $email_sub="Attract more applicants with a complete profile";
                
            } else if ($data['role'] == "minyawn") {
                //$email_sub = __("[" . get_bloginfo('name') . "] - Attract more job offers with a complete profile.");
                $email_sub = "Complete Your Profile & Get a Job!";
            }



            return $email_sub;

        case 'user_no_activity_reminder' : if ($data['role'] == "employer") {
               // $email_sub = __("[" . get_bloginfo('name') . "] - Take the next step - Add jobs");
        $email_sub="Take the next step - Add jobs";
            } else if ($data['role'] == "minyawn") {
                $email_sub = __("[" . get_bloginfo('name') . "] - Take the plunge - Apply for a job");
            }


            return $email_sub;

        case 'employer_jobcompletion_reminder' : $email_sub = "Task Completed!";
            return $email_sub;
            
        case 'invite_minion':$email_sub="Congratulations! You have been invited to apply for a job.";
            return $email_sub;
    }//end switch($type)
}

//end function get_email_subject($type,$data)

/**
 * 
 * @param string $type
 * @param array $data
 * @param string $emailid
 * @return string message body
 */
function get_email_msg($type, $data, $emailid) {
    switch ($type) {

        case 'user_activate_reminder' : if ($data['role'] == "employer") {
                $email_msg = "Hi " . $data['display_name'] . ",<br/><br/>
										
														You have not activated your profile yet. There are many minions waiting to complete your tasks,
										  				so please click 
										  				<a href='" . site_url() . "/newuser-verification/?action=ver&key=" . $data['user_activation_key'] . "&email=" . $emailid . "'>here</a> to activate your profile.<br/><br/>
																 			
														Let us know if you had any issues activating your account on <a href='mailto:support@minyawns.com'>support@minyawns.com</a><br/><br/>";
            } else if ($data['role'] == "minyawn") {
                $email_msg = "Hi " . $data['display_name'] . ",<br/><br/>

														You have not activated your profile yet. Many opportunities await, and lost time equals lost opportunities,
										  				so please click <a href='" . site_url() . "/newuser-verification/?action=ver&key=" . $data['user_activation_key'] . "&email=" . $emailid . "'>here</a>
										  				to activate your profile.<br/><br/>

														Let us know if you had any issues activating your account on <a href='mailto:support@minyawns.com'>support@minyawns.com</a>";
            }
            return $email_msg;

        case 'user_incomplete_profile_reminder' :                                         //$data['display_name']
            if ($data['role'] == "employer") {
                $email_msg = "Hi there! <br/><br/>
																
														We noticed that your profile is incomplete. Complete profiles get more applicants, 
														giving you the opportunity to choose the most relevant minions for your task.<br/><br/> 
																
														You can edit your profile by visiting <a href='http://www.minyawns.com/profile/'>http://www.minyawns.com/profile/</a><br/>
														<br/><br/>

														Let your minions run errands for you while you think of more important things to do.<br/><br/>

														If you have any issues,please feel free to contact us at <a href='mailto:support@minyawns.com'>support@minyawns.com</a><br/><br/>																
														";
            } else if ($data['role'] == "minyawn") {
                $email_msg = "Hi Minion!  <br/><br/>
														 
														We noticed that your profile is incomplete-- Yikes! Complete profiles usually get more attention from employers, 
														making you a more eligible candidate. Create more opportunities for yourself to earn extra money, 
														and bag amazing ratings and reviews from your employers.<br/><br/>
														
														Hurry up and get on it! Log in and edit your profile at <a href='http://www.minyawns.com/profile/'>http://www.minyawns.com/profile/</a><br/>
														<br/><br/>														
														
														Questions? Comments? Holla at us <a href='mailtp:support@minyawns.com'>support@minyawns.com</a><br/><br/>";
            }
            return $email_msg;

        case 'user_no_activity_reminder' : if ($data['role'] == "employer") {
                $email_msg = "Hi there! <br/><br/> 
														
														We noticed that you haven't added any jobs since you signed up. Please let us know if you are facing any difficulties,  
														we are happy to be of assistance.<br/><br/>
																
														We know you’re busy, so delegate now! Just hire a minion and kick back and relax while your minions work for you.<br/><br/>
																
														Need help? Just email us at <a href='mailto:support@minyawns.com'>support@minyawns.com</a> and 
														we will get your job posted to the site.<br/><br/>";
            } else if ($data['role'] == "minyawn") {
                $email_msg = "Hi Minion <br/><br/>
														We noticed that you haven't applied to any jobs since you signed up. Please let us know
														if you are facing any difficulties, we are happy to assist you.<br/><br/>
																
														Hey, we understand that your time is precious and you might not want to commit  to a 
                                                                                                                full-time or part-time job just yet. That’s why, as a Minyawn Minion, you get to pick the jobs 
                                                                                                                with time, pay and errands that work best for you!<br/><br/> 

                                                                                                                Want to apply, but don’t know how? It’s pretty simple:<br/>
                                                                                                                1) Log in to your account<br/>
                                                                                                                2) Click on ‘B    rowse Jobs’<br/>
                                                                                                                3) Pick a job. Apply for it!<br/><br/>
      
                                                                                                               Still having trouble? Email us at <a href='support@minyawns.com'>support@minyawns.com</a>.<br/><br/>";
            }

            return $email_msg;
//'" . $data['job_name'] . "'
        case 'employer_jobcompletion_reminder' : $email_msg = "Hi,<br/><br/>

														Congratulations,  Your task  has been completed! <br/><br/> It's time to rate and write a review for
														the minion who executed your task. To rate your minion go to <a href='".site_url()."/job/".$data['job_slug']."'>".$data['job_name']."</a>, simply click on the thumbs up or thumbs down icon on the bottom left corner
														of your job description.<br/><br/>

														If you have any questions or issues, please feel free to email us at <a href='mailto:support@minyawns.com'>support@minyawns.com</a><br/><br/>
				
		
		";
             return $email_msg;
             
        case 'invite_minion':$email_msg="Hi,<br/><br/> Well done! Your profile has caught the attention of an employer. You are one of the handpicked minions invited to apply for the job.<br/><br/>
<b>Job details</b><br/>Job description:".$data['decription']."<br/>
Wages: ".$data['wages']."<br/>
Report for duty at ".$data['time']." on ".$data['date']."<br/>
You are at an advantage over other minions as you are invited by the employer after going over your profile and checking if you meet the criteria for the job.
Sounds good? Go ahead.
<a href='".  site_url()."/job/".$data['slug']."'>Apply now</a><br/><br/>Once you apply you will receive a mail confirming your application.<br/><br/>You will be notified by email when you are selected for the job. Get, set and go! 
<br/><br/>
If you are facing difficulties applying for the job feel free to email us on <a href='mailto:support@minyawns.com'>support@minyawns.com</a>.
 ";
            
          return $email_msg;  
    }//end switch($type)
}

//end function get_email_msg($type, $data, $emailid)
?>