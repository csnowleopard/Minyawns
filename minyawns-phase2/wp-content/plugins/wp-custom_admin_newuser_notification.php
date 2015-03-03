<?php
/**
 * @package Custom New User Notification
 * @version 1
 */
/*
Plugin Name: Custom New User Notification
Description: Replaces default user registration mail notification  

*/
if ( !function_exists('wp_new_user_notification') ) :
function wp_new_user_notification($user_id, $plaintext_pass = '') {
	
	global $wpdb; 
	$user = get_userdata( $user_id );

	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

	$message  = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n<br/>";
	//$message .= sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n<br/>";
	$message .= sprintf(__('E-mail: %s'), $user->user_email) . "\r\n<br/>";
	
	
	
	//get the user role 
	$user = get_userdata( $user->ID );	
	$capabilities = $user->{$wpdb->prefix . 'capabilities'};	
	if ( !isset( $wp_roles ) )
		$wp_roles = new WP_Roles();
	
	foreach ( $wp_roles->role_names as $role => $name ) :	
	if ( array_key_exists( $role, $capabilities ) )
	{
		$reg_user_role =  ucfirst($role);
		if($reg_user_role=="Minyawn")
			$reg_user_role = "Minion";
	}	
	endforeach;
	$message .= sprintf(__('Role: %s'), $reg_user_role) . "\r\n\r\n<br/>";
	
	if($reg_user_role=="Employer")
	{
		$message .= sprintf(__('Name: %s'), get_usermeta($user->ID,'first_name',true)) . "\r\n\r\n<br/>";
		if(get_usermeta($user->ID,'company_name',true)!="") 
			$message .= sprintf(__('Company Name: %s'), get_usermeta($user->ID,'company_name',true)) . "\r\n\r\n<br/>";
	}
	else 
	{
		$message .= sprintf(__('First Name: %s'), get_usermeta($user->ID,'first_name',true)) . "\r\n\r\n<br/>";
		if(get_usermeta($user->ID,'last_name',true)!="")
			$message .= sprintf(__('Last Name: %s'), get_usermeta($user->ID,'last_name',true)) . "\r\n\r\n<br/>";
	}
		
	

	//@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);

	add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
	$headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
	wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), email_header() . $message . email_signature(), $headers);
	

	if (current_user_can('add_users')  && is_user_logged_in()) {
		

	$message  = sprintf(__('Username: %s'), $user->user_login) . "\r\n<br>";
	$message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n<br>";
	$message .= wp_login_url() . "\r\n";

	wp_mail($user->user_email, sprintf(__('[%s] Your username and password'), $blogname), email_header() . $message . email_signature(), $headers);        
       
        }
}
endif;