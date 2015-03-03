<?php

global $wpdb;

/**
 * function to send mail to employer if a job  is completed 
 * 
 */
 

function employer_jobcompletion_reminder() {

    		global $wpdb;
    		//$now_time = date("Y-m-d H:i:s");
    		//$now_time = gmdate("Y-m-d H:i:s", current_time('timestamp'));
    		
    		/*echo "<span style='font-size:7px' >current_time( 'mysql' ) returns local site time: " . current_time( 'mysql' ) . '<br />';
    		echo "current_time( 'mysql', 1 ) returns GMT: " . current_time( 'mysql', 1 ) . '<br />';
    		echo "current_time( 'timestamp' ) returns local site time: " . date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
    		echo "current_time( 'timestamp', 1 ) returns GMT: " . date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) );
    		echo "</span>";*/
    		
    		$now_time = date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ));
   			
    	 /*	$job_completion_sql = $wpdb->prepare("SELECT distinct(a.ID) as post_id , a.post_title as post_title,
    				d.user_email, d.display_name, d.ID as employer_id
    				FROM {$wpdb->prefix}posts a
    				INNER JOIN {$wpdb->prefix}postmeta b on  a.ID = b.post_id
    				INNER JOIN {$wpdb->prefix}userjobs c    on  a.ID = c.job_id
    				INNER JOIN {$wpdb->prefix}users d  on d.ID = a.post_author
    				WHERE c.status = 'hired'  AND b.meta_key ='job_end_date_time'
    				AND from_unixtime(b.meta_value) < %s
    				",$now_time); */
    	 	
    	 	$job_completion_sql = $wpdb->prepare("SELECT distinct(a.ID) as post_id , a.post_title as post_title,
    	 			d.user_email, d.display_name, d.ID as employer_id
    	 			FROM {$wpdb->prefix}posts a
    	 			INNER JOIN {$wpdb->prefix}postmeta b on  a.ID = b.post_id
    	 			INNER JOIN {$wpdb->prefix}userjobs c    on  a.ID = c.job_id
    	 			INNER JOIN {$wpdb->prefix}users d  on d.ID = a.post_author
    	 			WHERE c.status = 'hired'  AND b.meta_key ='job_end_date_time'
    	 			AND b.meta_value <= %s
    	 			",current_time( 'timestamp'));
   			
   			 //echo "<span style='font-size:7px' ><br/><br/>job completion".$job_completion_sql."</span>";
    		$job_completions = $wpdb->get_results($job_completion_sql);
    
    		foreach($job_completions as $job_completion)
    		{
    			$emailid = $job_completion->user_email;
    			
    			$data['display_name'] = $job_completion->display_name;
    			
    			$data['job_id'] = $job_completion->post_id;
    			
    			$data['job_name'] = $job_completion->post_title;

                $data['job_slug']= basename( get_permalink($job_completion->post_id) );
    			    			
    			/* generate email template in a variable */
   				$mail = email_template($emailid, $data, 'employer_jobcompletion_reminder');
    
    			$email_content = $mail['hhtml'] . $mail['message'] . $mail['fhtml'];
    
    			$email_subject = $mail['subject'];
    
				/* call function to make db insert */
				db_save_for_cron_job($emailid, $email_content, $email_subject, 'employer_jobcompletion_reminder',$job_completion->post_id);
    		}
    
}
add_action('CRON_CONTROL_TIME_1', 'employer_jobcompletion_reminder',2,0);


/**
 * Get all users who have signed up 3 days ago and still have not activated the account
 */
function users_notactivated_reminder()
{
	global $wpdb;	
	//$now_time = date("Y-m-d H:i:s");
	//$now_time = gmdate("Y-m-d H:i:s", current_time('timestamp'));	
	$now_time = date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ));
	
	$qr_user_not_logged = $wpdb->prepare("SELECT *
											FROM {$wpdb->prefix}users
											WHERE user_status = 2
											AND user_registered >= DATE_SUB(%s, INTERVAL %d SECOND)
											AND user_registered <= DATE_SUB(%s, INTERVAL %d SECOND)
											",$now_time, (3*WP_CRON_CONTROL_TIME_1), $now_time, (2*WP_CRON_CONTROL_TIME_1));
	// echo "<br/><br/> not logged in ".$qr_user_not_logged;	
	
	$not_active_users = $wpdb->get_results($qr_user_not_logged);
	
	foreach($not_active_users as $not_active_user)
	{
		$emailid = $not_active_user->user_email;		
		
		$data['display_name'] = $not_active_user->display_name;
		
		$data['user_activation_key'] = $not_active_user->user_activation_key;
		
		$user = new WP_User( $not_active_user->ID );
		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
			foreach ( $user->roles as $role )
				$user_role = $role;		}
		
			$data['role'] = $user_role;
		
		/* generate email template in a variable */
		$mail = email_template($emailid, $data, 'user_activate_reminder');
		
		$email_content = $mail['hhtml'] . $mail['message'] . $mail['fhtml'];
		
		$email_subject = $mail['subject'];
		
		/* call function to make db insert */
		db_save_for_cron_job($emailid, $email_content, $email_subject, 'users_notactivated_reminder');
	}
	
}

add_action('CRON_CONTROL_TIME_1', 'users_notactivated_reminder',10,0);


/**
 * Get users who signed up & activated account and
 * havent applied for a job(role:minyawn) even after one week's time
 * or havent created a job(role:employer) even after one week's time
 */
function users_no_activity_reminder()
{
	global $wpdb;
	//$now_time = date("Y-m-d H:i:s");
	//$now_time = gmdate("Y-m-d H:i:s", current_time('timestamp'));
	$now_time = date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ));
	
	/*echo "current_time( 'mysql' ) returns local site time: " . current_time( 'mysql' ) . '<br />';
echo "current_time( 'mysql', 1 ) returns GMT: " . current_time( 'mysql', 1 ) . '<br />';
echo "current_time( 'timestamp' ) returns local site time: " . date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
echo "current_time( 'timestamp', 1 ) returns GMT: " . date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) );*/
	
	/*$qr_no_activity_users = $wpdb->prepare("SELECT a.*
											FROM {$wpdb->prefix}users a
											NATURAL LEFT JOIN  {$wpdb->prefix}userjobs b
											WHERE b.user_id is null
											AND a.user_status = 0
											AND a.user_registered > DATE_SUB(%s, INTERVAL %d SECOND )
											AND a.user_registered < DATE_SUB(%s, INTERVAL %d SECOND )
									
											UNION
									
											SELECT c.*
											FROM {$wpdb->prefix}users c
											NATURAL LEFT JOIN  {$wpdb->prefix}posts d
											WHERE (d.post_author is null or d.post_type!='job')
											AND c.user_status = 0
											AND c.user_registered > DATE_SUB(%s, INTERVAL %d SECOND )
											AND c.user_registered < DATE_SUB(%s, INTERVAL %d SECOND )
											",$now_time, (7*WP_CRON_CONTROL_TIME_1), $now_time, (6*WP_CRON_CONTROL_TIME_1), $now_time, (7*WP_CRON_CONTROL_TIME_1), $now_time, (6*WP_CRON_CONTROL_TIME_1));
	*/
	
	
	$qr_no_activity_users = $wpdb->prepare("(SELECT a.* FROM {$wpdb->prefix}users a LEFT JOIN  {$wpdb->prefix}userjobs b on a.id = b.user_id 
												INNER JOIN {$wpdb->prefix}usermeta h on h.user_id = a.ID		
												WHERE b.user_id is null
												AND  h.meta_key = %s
												AND h.meta_value LIKE %s
												AND a.user_status = 0
												AND a.user_registered >= DATE_SUB(%s, INTERVAL %d SECOND )
												AND a.user_registered <= DATE_SUB(%s, INTERVAL %d SECOND )
																			
											)
			
											UNION
																			
											(SELECT c.* FROM {$wpdb->prefix}users c  LEFT JOIN {$wpdb->prefix}posts d on c.ID = d.post_author
												INNER JOIN {$wpdb->prefix}usermeta j on j.user_id = c.ID
												WHERE (d.post_author is null or d.post_type!='job')
												AND  j.meta_key = %s
												AND j.meta_value LIKE %s
												AND c.user_status = 0
												AND c.user_registered >= DATE_SUB(%s, INTERVAL %d SECOND )
												AND c.user_registered <= DATE_SUB(%s, INTERVAL %d SECOND )
											)
											",$wpdb->prefix.'capabilities','%minyawn%',$now_time, (7*WP_CRON_CONTROL_TIME_1), $now_time, (6*WP_CRON_CONTROL_TIME_1),$wpdb->prefix.'capabilities','%employer%', $now_time, (7*WP_CRON_CONTROL_TIME_1), $now_time, (6*WP_CRON_CONTROL_TIME_1)
										);
	
	
	
	//echo "<br/><br/><span style='font-size:12'> no user activity".$qr_no_activity_users."</span>";
	$no_activity_users = $wpdb->get_results($qr_no_activity_users);
	
	foreach($no_activity_users as $no_activity_user)
	{
		
		$emailid = $no_activity_user->user_email;		
		 
		$user = new WP_User( $no_activity_user->ID );		
		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
			foreach ( $user->roles as $role )
				$user_role = $role;		}
			
		$data['role'] = $user_role;
		
		$data['display_name'] = $no_activity_user->display_name;
		
				
		/* generate email template in a variable */
		$mail = email_template($emailid, $data, 'user_no_activity_reminder');
		
		$email_content = $mail['hhtml'] . $mail['message'] . $mail['fhtml'];
		
		$email_subject = $mail['subject'];
		
		/* call function to make db insert */
		db_save_for_cron_job($emailid, $email_content, $email_subject, 'users_no_activity_reminder');
	}
	
	
}
add_action('CRON_CONTROL_TIME_1', 'users_no_activity_reminder',12,0);

/*
 *  Gets all users profiles which are 
 *  incomplete @employer @minyawn using 'user_incomplete_profile_reminder' as mail type
 *  loads email template and save these entries in the cron_jobs table
 * 
 */

function user_incomplete_profile_reminder() {

    global $wpdb;
    //$now_time = date("Y-m-d H:i:s");
   // $now_time = gmdate("Y-m-d H:i:s", current_time('timestamp'));
    $now_time = date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ));
    
    
    
    
    $incomplete_profiles = $wpdb->get_results("(SELECT *
									    		FROM {$wpdb->prefix}users u1
									    		INNER JOIN {$wpdb->prefix}usermeta um1 ON u1.ID = um1.user_id
									    		LEFT OUTER JOIN {$wpdb->prefix}usermeta um2 ON u1.ID = um2.user_id
									    		AND um2.meta_key = 'college'
									    		WHERE um1.meta_key = '{$wpdb->prefix}capabilities'
									    		AND um1.meta_value LIKE '%minyawn%'
									    		AND um2.meta_key IS NULL
									    		AND u1.user_registered >= DATE_SUB('".$now_time."', INTERVAL ".(2*WP_CRON_CONTROL_TIME_1)." SECOND )
									    		AND u1.user_registered <= DATE_SUB('".$now_time."', INTERVAL ".(1*WP_CRON_CONTROL_TIME_1)." SECOND )
									    )
									    UNION (
									    
									    SELECT *
									    FROM {$wpdb->prefix}users u1
									    INNER JOIN {$wpdb->prefix}usermeta um1 ON u1.ID = um1.user_id
									    LEFT OUTER JOIN {$wpdb->prefix}usermeta um2 ON u1.ID = um2.user_id
									    		AND um2.meta_key = 'location'
									    		WHERE um1.meta_key = '{$wpdb->prefix}capabilities'
									    		AND um1.meta_value LIKE '%employer%'
									    		AND um2.meta_key IS NULL
									    		AND u1.user_registered >= DATE_SUB('".$now_time."', INTERVAL ".(2*WP_CRON_CONTROL_TIME_1)." SECOND )
									    		AND u1.user_registered <= DATE_SUB('".$now_time."', INTERVAL ".(1*WP_CRON_CONTROL_TIME_1)." SECOND )
									    		)");
    
      //echo " <br/> <br/> incomplete profile <span style='font-size:8px;'> ";
     
      
    /* generate usernames and emailds */
    
     
    foreach ($incomplete_profiles as $incomplete_profile) {


        $emailid = $incomplete_profile->user_email;

        $data['display_name'] = $incomplete_profile->display_name; 
        
        $user = new WP_User( $incomplete_profile->ID );
        if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
        	foreach ( $user->roles as $role )
        		$user_role = $role;		}
        		
        $data['role'] = $user_role;
        	

        /* generate email template in a variable */
        $mail = email_template($emailid, $data, 'user_incomplete_profile_reminder');

        $email_content = $mail['hhtml'] . $mail['message'] . $mail['fhtml'];

        $email_subject = $mail['subject'];

        /* call function to make db insert */
         if ($data['role'] != "employer"){
        	db_save_for_cron_job($emailid, $email_content, $email_subject, 'user_incomplete_profile_reminder');
         }
    }
}
add_action('CRON_CONTROL_TIME_1', 'user_incomplete_profile_reminder',15,0);      

/*
 *  Function to save mails based on @type
 *  in cron_jobs table
 * 
 */

function db_save_for_cron_job($email, $content, $subject, $type,$jobid=0) {
    global $wpdb;

    
    $existing_entry = "SELECT * from cron_jobs where email_recipient='" . $email . "' AND type='" . $type . "' AND  job_id= ".$jobid;
    //echo  "<br/>".$type.$existing_entry;
    $record_exists = $wpdb->get_row($existing_entry);

    if (count($record_exists) === 0) {
        $data = array(
            'email_recipient' => $email,
            'mail_content' => $content,
            'subject' => $subject,
            'type' => $type,
            'flag' => 0,
        	'job_id' =>$jobid
        );

        $wpdb->insert('cron_jobs', $data);
    }
    //daily_cron(); /* call the cron function to exexute mails */
}

/*
 * 
 *  Job supposed to run on a  daily basis add appropriate 
 *  job_types in where clause
 * 
 */


function daily_cron() {
    global $wpdb;

    $daliy_crons_sql = $wpdb->get_results("SELECT * from cron_jobs WHERE flag='0'");

    foreach ($daliy_crons_sql as $daily_cron_sql) {
    	
    	
    	$cron_mails_done_updateqry = $wpdb->get_results("UPDATE cron_jobs SET flag = 1 WHERE id = ".$daily_cron_sql->id);
    	
    	$headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
    	        
    	add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
    	        
    	wp_mail($daily_cron_sql->email_recipient, $daily_cron_sql->subject, $daily_cron_sql->mail_content, $headers);
    	
       //$ar_emails_done[] =  $daily_cron_sql->id;
        
    }
 
    // $emails_done = implode(",",$ar_emails_done);
   //$cron_mails_done_updateqry = $wpdb->get_results("UPDATE cron_jobs SET flag = 1 WHERE id IN(".$emails_done.")");    
}

add_action('CRON_CONTROL_TIME_2_EMAIL', 'daily_cron',99,0);

?>
