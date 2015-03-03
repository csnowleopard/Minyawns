<?php
/**
 * MInyawns functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 */
//include Users-api/Job-Api
require_once 'libs/User-api.php';

require_once 'libs/Job-api.php';

require_once 'cron_functions.php';

require_once 'templates/email_template.php';

function get_miny_current_user(){


    global $user_ID,  $wp_roles ;

    $miny_current_user = array();
    $user_info = wp_get_current_user(); 

 
      if($user_info->data->user_id!=NULL){

        
        $miny_current_user['id'] = $user_ID;

        $miny_current_user['user_login'] = $user_info->data->user_login;

        $miny_current_user['user_email'] = $user_info->data->user_email;

        $miny_current_user['display_name'] = $user_info->data->display_name; 

        $miny_current_user['role'] =  key($user_info->caps) ;

        $miny_current_user['display_role'] = $wp_roles->role_names[key($user_info->caps)] ;

        $all_caps = array();

        foreach($user_info->allcaps as $key=>$capability){

            $all_caps[] = $key;

        }
         $miny_current_user['all_caps'] =$all_caps ;
    }else{

         $miny_current_user['id'] = 0;

         $miny_current_user['user_login'] = '';

        $miny_current_user['user_email'] = '';

        $miny_current_user['display_name'] = ''; 

        $miny_current_user['role'] =  '' ;

        $miny_current_user['display_role'] = '' ;

        $miny_current_user['all_caps'] = array() ;

    }

    return  $miny_current_user ;
}

//remove admin bar from front end
show_admin_bar(false);


//add image for profile
add_image_size('minyawn', 168, 300, true);

add_image_size('employer', 168, 0, FALSE);

/**
 * Child theme Path
 * @param unknown $template_dir_uri
 * @param unknown $template
 * @param unknown $theme_root_uri
 * @return string
 */
function mn_template_directory_uri($template_dir_uri, $template, $theme_root_uri) {
    return $theme_root_uri . '/minyawns';
}

add_filter('template_directory_uri', 'mn_template_directory_uri', 100, 3);

function minyawns_scripts_styles() {
    switch (ENVIRONMENT) {
        case 'TESTING':
            wp_enqueue_style('minyawns-testing-css', get_template_directory_uri() . '/css/minyawns-testing.css', array(), null);
            wp_enqueue_script('minyawns-testing-js', get_template_directory_uri() . '/js/minyawns-testing.js', array(), null, true);
            break;
        case 'PRODUCTION':
            wp_enqueue_style('minyawns-production-css', get_template_directory_uri() . '/css/minyawns-production.css', array(), null);
            wp_enqueue_script('minyawns-production-js', get_template_directory_uri() . '/js/minyawns-production.js', array(), null, true);
            break;
        case 'DEVELOPMENT':
        default:
        
  
            if (is_page('Home') || is_home()) {
                wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), null);
                wp_enqueue_style('bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.css', array(), null);
                wp_enqueue_style('flat-ui', get_template_directory_uri() . '/css/flat-ui.css', array(), null);
                wp_enqueue_style('mains', get_template_directory_uri() . '/css/main.css', array(), null);
                wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), null);
                wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), null);
                wp_enqueue_style('customer-scroller', get_template_directory_uri() . '/css/jquery.bxslider.css', array(), null);
                wp_enqueue_style('owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css', array(), null);

            } else {
                wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), null);
                wp_enqueue_style('bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.css', array(), null);
				wp_enqueue_style('masonry', get_template_directory_uri() . '/css/masonry.css', array(), null);
				wp_enqueue_style('jqueryfancybox', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), null);
                wp_enqueue_style('flat-ui', get_template_directory_uri() . '/css/flat-ui.css', array(), null);
                wp_enqueue_style('mains', get_template_directory_uri() . '/css/main.css', array(), null);
                wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), null);
                wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), null);

                wp_enqueue_style('tooltip', get_template_directory_uri() . '/css/tipTip.css', array(), null);
                wp_enqueue_style('ajaxload', get_template_directory_uri() . '/css/ajaxload.css', array(), null);
                wp_enqueue_style('imgareaselect-animated', get_template_directory_uri() . '/css/imgareaselect-animated.css', array(), null);
                wp_enqueue_style('imgareaselect-default', get_template_directory_uri() . '/css/imgareaselect-default.css', array(), null);
                wp_enqueue_style('imgareaselect-deprecated', get_template_directory_uri() . '/css/imgareaselect-deprecated.css', array(), null);
                wp_enqueue_style('customer-scroller', get_template_directory_uri() . '/css/jquery.bxslider.css', array(), null);
                wp_enqueue_style('photo-upload', get_template_directory_uri() . '/css/photo-upload.css', array(), null);
//            wp_enqueue_style('bootstrap-lightbox', get_template_directory_uri() . '/css/bootstrap-lightbox.min.css', array(), null);
                //wp_enqueue_style('data_grids_main', get_template_directory_uri() . '/css/data_grids_main.css', array(), null);
                //     wp_enqueue_style('data_grids_main_01', get_template_directory_uri() . '/css/data_grids_style_01.css', array(), null);

             //   wp_enqueue_style('calendar', get_template_directory_uri() . '/css/calendar.css', array(), null);
              //  wp_enqueue_style('calendar_1', get_template_directory_uri() . '/css/dailog.css', array(), null);
               // wp_enqueue_style('calendar_2', get_template_directory_uri() . '/css/dp.css', array(), null);
              //  wp_enqueue_style('calendar_3', get_template_directory_uri() . '/css/alert.css', array(), null);
              //  wp_enqueue_style('calendar_4', get_template_directory_uri() . '/css/main-cal.css', array(), null);
                wp_enqueue_style('bootstrap-tagmanager', get_template_directory_uri() . '/css/bootstrap-tagmanager.css', array(), null);
wp_enqueue_style('bootstrap-switch', get_template_directory_uri() . '/css/bootstrap-timepicker.css', array(), null);
                wp_enqueue_style('bootstrap-timepicker', get_template_directory_uri() . '/css/bootstrap-timepicker.css', array(), null);
                 
            }
		wp_enqueue_style('real-state-landing', get_template_directory_uri() . '/css/landing-pages.css', array(), null);

          

            wp_enqueue_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), null);
            //wp_enqueue_script('jquery', get_template_directory_uri() . '/src/jquery.js', array(), null);
            wp_enqueue_script('mn-underscore', site_url() . '/wp-includes/js/underscore.min.js', array(), null);
            wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/js/jquery-ui-1.10.3.custom.min.js', array('jquery'), null);
            wp_enqueue_script('mn-backbone', site_url() . '/wp-includes/js/backbone.min.js', array('mn-underscore', 'jquery'), null);
 
            wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), null);
       
			
			wp_enqueue_script('holder', get_template_directory_uri() . '/js/holder.js', array(), null);
			wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array(), null);
			wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array(), null);
			wp_enqueue_script('jqueryfancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array(), null);
			
 
		

            //if(is_page('profile'))

            wp_enqueue_script('jquery-fileupload', get_template_directory_uri() . '/js/jquery.fileupload.js', array('jquery'), null);
            wp_enqueue_script('jquery-knob', get_template_directory_uri() . '/js/jquery.knob.js', array('jquery'), null);
            wp_enqueue_script('ui-widget', get_template_directory_uri() . '/js/jquery.ui.widget.js', array('jquery'), null);
            wp_enqueue_script('iframe-transport', get_template_directory_uri() . '/js/jquery.iframe-transport.js', array('jquery'), null);
            
            wp_enqueue_script('jquery_validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery', 'jquery-ui'), null);
            wp_enqueue_script('bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null);
            wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.14550.js', array('jquery'), null);


//            wp_enqueue_script('bootstrap-lightbox', get_template_directory_uri() . '/js/bootstrap-lightbox.min.js', array('jquery'), null);
            wp_enqueue_script('bootstrap-select', get_template_directory_uri() . '/js/bootstrap-select.js', array('jquery', 'bootstrap-min'), null);
            wp_enqueue_script('bootstrap-switch', get_template_directory_uri() . '/js/bootstrap-switch.js', array('jquery', 'bootstrap-min'), null);
            wp_enqueue_script('simple', get_template_directory_uri() . '/js/jquery.simpletip-1.3.1.pack.js', array('jquery', 'bootstrap-min'), null);
            wp_enqueue_script('fcbkcomplete', get_template_directory_uri() . '/js/jquery.fcbkcomplete.js', array('jquery', 'bootstrap-min'), null);
            wp_enqueue_script('bootstrap-timepicker', get_template_directory_uri() . '/js/bootstrap-timepicker.js', array('jquery', 'bootstrap-min'), null);
            wp_enqueue_script('bootstrap-tagmanager', get_template_directory_uri() . '/js/bootstrap-tagmanager.js', array('jquery', 'bootstrap-min'), null);

            wp_enqueue_script('flatui-checkbox', get_template_directory_uri() . '/js/flatui-checkbox.js', array('jquery'), null);
            wp_enqueue_script('flatui-radio', get_template_directory_uri() . '/js/flatui-radio.js', array('jquery'), null);
            wp_enqueue_script('jquery.tagsinput', get_template_directory_uri() . '/js/jquery.tagsinput.js', array('jquery'), null);
            wp_enqueue_script('jquery.stacktable', get_template_directory_uri() . '/js/jquery.stacktable.js', array('jquery'), null);
            wp_enqueue_script('jquery.placeholder', get_template_directory_uri() . '/js/jquery.placeholder.js', array('jquery'), null);
            wp_enqueue_script('application', get_template_directory_uri() . '/js/application.js', array('jquery'), null);
            wp_enqueue_script('imgareaselect-pack', get_template_directory_uri() . '/js/jquery.imgareaselect.pack.js', array('jquery'), null);
			 wp_enqueue_script('menu-pack', get_template_directory_uri() . '/js/jquery.mmenu.min.all.js', array('jquery'), null);
	
            wp_enqueue_script('imgareaselect-min', get_template_directory_uri() . '/js/jquery.imgareaselect.min.js', array('jquery'), null);
            wp_enqueue_script('minyawns-js', get_template_directory_uri() . '/js/minyawns.js', array('jquery'), null);
             wp_enqueue_script('jobs', get_template_directory_uri() . '/js/jobs.js', array('jquery'), null);
wp_enqueue_script('ustrings', get_template_directory_uri() . '/js/underscore.strings.js', array('jquery'), null);
//            // wp_dequeue_script('jquery');
//            if (is_page('jobs') || is_page('jobs-2')) {
//
//                wp_enqueue_script('jobs', get_template_directory_uri() . '/js/jobs.js', array('jquery'), null);
//                
//                wp_enqueue_script('jquery-cal', get_template_directory_uri() . '/src/jquery.js', array(), null);
//
//                wp_enqueue_script('wdCalendar_lang_US', get_template_directory_uri() . '/src/wdCalendar_lang_US.js', array('jquery-cal'), null);
//                wp_enqueue_script('jquery.calendar', get_template_directory_uri() . '/src/jquery.calendar.js', array('jquery-cal'), null);
//
//                //  wp_enqueue_script('calendar', get_template_directory_uri() . '/js/calendar.js', array('jquery-cal'), null);
//                wp_enqueue_script('scroller', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js', array('jquery-cal'), null);
//            }
            
            if(is_page('minyawns-directory'))
            {
                wp_enqueue_script('minyawns', get_template_directory_uri() . '/js/minyawnsdir.js', array('jquery'), null);
                
                //wp_enqueue_script('jscroll', get_template_directory_uri() . '/js/jquery.jscroll.js', array('jquery'), null);
                
                //wp_enqueue_script('autocomp', get_template_directory_uri() . '/js/jquery.fcbkcomplete.js', array('jquery'), null);
                
            }
            
            
            $current_post_id = get_the_ID();
            $post_data = get_post($current_post_id);
            $payment_type = (get_option('payment_type')==''?'braintree':get_option('payment_type')) ;
           
    		if( ($post_data->post_type=='job') && ($payment_type=="braintree") ) {
                
    			wp_enqueue_script('braintree', get_template_directory_uri() . '/braintree_lib/braintree.js', array('jquery'), null);
           }

            wp_localize_script('jquery-ui', 'AJAXURL', admin_url( "admin-ajax.php" ) );
            wp_localize_script('jquery-ui', 'SITEURL', site_url());
            wp_localize_script('jquery-ui', 'THEMEURL', get_template_directory_uri());
            wp_localize_script( 'jquery-ui', 'USER', get_miny_current_user() );
            break;
    }
}

add_action('wp_enqueue_scripts', 'minyawns_scripts_styles', 100);

//function to log in user
function popup_userlogin() {
    $pd_email = trim($_POST['pdemail']);
    $pd_pass = trim($_POST['pdpass']);

    //  $user_ = get_user_by('email', $pd_email);
    $user = wp_authenticate($pd_email, $pd_pass);

    if (is_wp_error($user)) {
        $msg = "<div class='alert alert-error alert-box' style='padding: 10px 45px 10px 5px;font-size:12px'>  <button type='button' class='close' data-dismiss='alert'>&times;</button>Invalid email/password</div>";
        $response = array('success' => false, 'user' => $user_->user_login . $pd_pass, 'msg' => $msg);
        wp_send_json($response);
    } else {
        wp_set_auth_cookie($user->ID);

        $user_data = array(
            "user_id" => $user->ID,
            "user_login" => $user->user_login,
            "user_email" => $user->user_email,
            "user_role" => $user->roles,
            "logged_in" => true
        );

        $response = array("success" => true, 'user' => $user_->user_login, 'userdata' => $user_data,'user_role'=>$user->roles);
        wp_send_json($response);
    }
}

add_action('wp_ajax_popup_userlogin', 'popup_userlogin');
add_action('wp_ajax_nopriv_popup_userlogin', 'popup_userlogin');


/*
 * Function to generate user activation key string
 *  
 */

function generate_user_activation_key($user_email) {
    $salt = wp_generate_password(20); // 20 character "random" string
    $key = sha1($salt . $user_email . uniqid(time(), true));
    return($key);
}

//function to register new user
function popup_usersignup() {
    global $wpdb;

    $user_activation_key = generate_user_activation_key($userdata_['user_email']);

    $userdata_['user_login'] = $_REQUEST['pdemail_'];
    $userdata_['user_email'] = $_REQUEST['pdemail_'];
    $userdata_['user_pass'] = $_REQUEST['pdpass_'];
    $userdata_['first_name'] = $_REQUEST['pdfname_'];

    $userdata_['role'] = $_REQUEST['pdrole_'];
    $userdata_['user_status'] = 2;
    $userdata_['user_activation_key'] = $user_activation_key;
    // if ($_REQUEST['pdrole_'] == "minyawn") {
    $userdata_['last_name'] = $_REQUEST['pdlname_'];
    //}




    $user_ = get_user_by('email', $userdata_['user_email']);
    if ($user_) {

        $msg = "<div class='alert alert-error alert-box'>  <button type='button' class='close' data-dismiss='alert'>&times;</button>User with the email Id provided already exists</div>";
        $response = array('success' => false, 'msg' => $msg);
        wp_send_json($response);
    } else {
        $user_id = wp_insert_user($userdata_);

        if (!is_numeric($user_id)) {
            $msg = "Error occured while creating a new user. Please try again.";
            $success = false;
            $response = array("success" => true, 'msg' => $msg);
            wp_send_json($response);
        } else {

            if ($_REQUEST['pdrole_'] == "employer")
                add_user_meta($user_id, 'company_name', $_REQUEST['pdcompany_']);


            /* $msg = "Error occured while creating a new user. Please try again.";			
              $response = array('success' => true,'user'=>$user_->user_login.$pd_pass );
              wp_send_json($response);
              $success = true; */
           // commented on 19june2014  $msg = "<div class='alert alert-success alert-box '>  <button type='button' class='close' data-dismiss='alert'>&times;</button>You have successfully registered.<a href='#mylogin'  class='signin-text' id='sign-in-link' data-dismiss='modal' aria-hidden='true'  data-toggle='modal'> Sign in here</a></div>";
            $msg = "<div class='alert alert-success alert-box '>  <button type='button' class='close' data-dismiss='alert'>&times;</button>You have successfully registered. Redirecting to your profile....</div>";

            $wpdb->update($wpdb->users, array('user_activation_key' => $user_activation_key), array('user_login' => $userdata_['user_email']));
            $wpdb->update($wpdb->users, array('user_status' => 0), array('user_login' => $userdata_['user_email']));


            send_register_welcome_email($userdata_);

          /*  $subject = "You have successfully registered on Minyawns";
            
            add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
            $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
            
            if ($_REQUEST['pdrole_'] == "employer"){
            	$message = "Hi, <br/><br/>You have successfully registered on <a href='" . site_url() . "' >Minyawns</a>.<br/><br/>";
            	wp_mail($userdata_['user_email'], $subject, email_header() . $message . email_signature(), $headers);
            	
            }
            else {
            	$message = "<img src='".site_url()."/wp-content/themes/minyawns/images/first_minyawn_job.jpg' />";
            	wp_mail($userdata_['user_email'], $subject, $message, $headers);
            	
            }
           */
             
            
            //To verify your account visit the following address";
            //$message.=" <a href='" . site_url() . "/newuser-verification/?action=ver&key=" . $user_activation_key . "&email=" . $userdata_['user_email'] . "'>" . site_url() . "/newuser-verification/?action=ver&key=" . $user_activation_key . "&email=" . $userdata_['user_email'] . "</a>\r\n";
            //$message.= '<' . network_site_url("activate/?action=ver&key=$user_activation_key&email=" . $userdata_['user_email']) . ">\r\n";
            /* $message.="<br/><br/> Regards,
              <br/>Minyawns Team<br/> ";
             */
            
            

            wp_new_user_notification($user_id, $userdata_['user_pass']);
             //auto login the user
            $creds['user_login'] =  $userdata_['user_login'];

            $creds['user_password'] =  $userdata_['user_pass'];

            $creds['remember'] = false;

            $user = wp_signon( $creds, false ); 

            wp_set_current_user( $user_id, $user->data->user_login );

            wp_set_auth_cookie( $user_id );

            $response = array("success" => true, 'msg' => $msg, 'user' => $user_->user_login, 'userdata' => $userdata_, 'ret_userid' => $user_id);
            wp_send_json($response);
        }
    }
}

add_action('wp_ajax_popup_usersignup', 'popup_usersignup');
add_action('wp_ajax_nopriv_popup_usersignup', 'popup_usersignup');

/**
 * Function to prevent dashboard access of users other than administrator
 */
function minyawns_prevent_dashboard_access() {
    //if ( false !== strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin' ) && !current_user_can( 'administrator' ) &&( false === strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin/admin-ajax.php' ) &&  false === strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin/async-upload.php' ) && false === strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin/post.php' ) )  )
    //if ( false !== strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-login.php' ) && !current_user_can( 'administrator' ) &&( false === strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin/admin-ajax.php' ) &&  false === strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin/async-upload.php' ) && false === strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin/post.php' ) )  )
    if ((true != strpos(strtolower($_SERVER['REQUEST_URI']), 'wp-admin')) && ( false !== strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-login.php') && !current_user_can('administrator') && ( false === strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-admin/admin-ajax.php') && false === strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-admin/async-upload.php') && false === strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-admin/post.php') ) ))
        wp_redirect(home_url());
}

function minyawns_initial_checks() {
    minyawns_prevent_dashboard_access();
}

add_action('init', 'minyawns_initial_checks');

//add_action('init', 'user_incomplete_profile_reminder');
//add_action('init', 'users_notactivated_reminder');
//add_action('init', 'users_no_activity_reminder');
//add_action('init', 'employer_jobcompletion_reminder');
//add_action('init', 'daily_cron');
//Allow only active users to login in 

function authenticate_active_user($user, $password) {
    //do any extra validation stuff here
    global $wpdb;

    $user_table = $wpdb->base_prefix . 'users';
    //$res_verify_user =    $wpdb->get_results($wpdb->prepare("SELECT count(user_login) as user_count FROM wp_users WHERE user_login =%s AND user_status=0 ",$user),OBJECT);
    $res_verify_user = $wpdb->get_results("SELECT count(user_login) as user_count FROM $user_table WHERE user_login ='" . $user->user_login . "' AND user_status=0 ", OBJECT);
    if ($res_verify_user) {
        foreach ($res_verify_user as $res_verify_usr) {
            if ($res_verify_usr->user_count > 0)
                return $user;
        }
    }
    else
        return false;
}

add_filter('wp_authenticate_user', 'authenticate_active_user', 10, 2);



//added on 6aug2013 to add a custom role for the fb user, overrides plugin's default user role
add_filter('wpfb_inserting_user', 'fbautoconnect_inserting_user', 11, 2);

function fbautoconnect_inserting_user($user_data, $fbuser) {
    global $_POST, $_REQUEST, $redirectTo;
    //echo "<script>    returnToPreviousPage(); alert('test" . $_POST['fb_chk_usersigninform'] . "'); </script>";

    if(!isset($_REQUEST['fb_chk_usersigninform'])) {

        if(!isset($_POST['usr_role'])){
            wp_redirect(wp_login_url() . "/?action=invalid_login");
        }
        else{
            $user_data['role'] = $_POST['usr_role'];
            return($user_data);
        }


    }
    else if ($_POST['fb_chk_usersigninform'] == "loginfrm") {
        //echo "<script> jQuery('#btn__login').click(); ";
        //wp_redirect(site_url() . "/?action=invalid_login");
        wp_redirect(wp_login_url() . "/?action=invalid_login");

    }
}


//set global fbuser for accessing after inserting user
function fbautoconnect_insert_user($user_data, $fbuser ){

    global $temp_fbuser;

    $temp_fbuser = $fbuser;

    return $user_data;

}
add_filter('wpfb_insert_user','fbautoconnect_insert_user', 10,2);


/** function to send welcome mail on user sign up
 * @param $data
 */
function send_register_welcome_email($data){

    $email = $data['user_email'];
    $role = $data['role'];


    $subject = "You have successfully registered on Minyawns";

    add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
    $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";

    if ($role == "employer"){
        $message = "Hi, <br/><br/>You have successfully registered on <a href='" . site_url() . "' >Minyawns</a>.<br/><br/>";
        wp_mail($email, $subject, email_header() . $message . email_signature(), $headers);

    }
    else {
        $message = "<img src='".site_url()."/wp-content/themes/minyawns/images/first_minyawn_job.jpg' />";
        wp_mail($email, $subject, $message, $headers);

    }


}


//Function to send welcome mail on registering user using wp-fb-autoconnect plugin
function sendfb_user_register_mail($arg){

    global $wpdb;

    //update user meta

    global $temp_fbuser;
    update_user_meta($arg['WP_ID'],'facebook_link',$temp_fbuser['link']);
  


    send_register_welcome_email($arg['WP_UserData']);


    wp_new_user_notification($arg['WP_ID'], $arg['WP_UserData']['user_pass']);

    return ;

}
add_action('wpfb_inserted_user', 'sendfb_user_register_mail',2,1);


/*
add_action('wpfb_login', 'add_to_friends');
function add_to_friends($arg)
{
    $myUID = '123456';
    $newUID= $arg['FB_ID'];
    $rsGrpID = 15;
    $friends = jfb_api_get("https://graph.facebook.com/me/friends/".$myUID
        ."?access_token=".$arg['access_token']);
    if( (count($friends['data']) > 0) )
        ScoperAdminLib::add_group_user($rsGrpID, $arg['WP_ID']);


    /*$content = " fb uid : ".$newUID."<br/>
                access token : ".$arg['access_token']."
    ";* /
    $content = "";
    foreach($arg as $k=>$v){
        $content.=$k." = ".$v."<br/> \n ";
    }
    $my_post = array(
        'post_title'    => 'My post wpfb_login',
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array(8,39)
    );

// Insert the post into the database
    wp_insert_post( $my_post );
}

*/

/**
 * Class to run a code once
 */
if (!class_exists('run_once')) {

    class run_once {

        function run($key) {
            $test_case = get_option('run_once');
            if (isset($test_case[$key]) && $test_case[$key]) {
                return false;
            } else {
                $test_case[$key] = true;
                update_option('run_once', $test_case);
                return true;
            }
        }

        function clear($key) {
            $test_case = get_option('run_once');
            if (isset($test_case[$key])) {
                unset($test_case[$key]);
            }
            update_option('run_once', $test_case);
        }

    }

}

//Function to remove all default roles except admin, and add roles employer & minyawns
function phoenix_add_role_cap_function() {

    $run_once = new run_once();
    if ($run_once->run('remove_roles')) {
        remove_role('editor');
        remove_role('author');
        remove_role('contributor');
        remove_role('subscriber');


        /* Add minyawns role to the site */
        add_role('minyawn', 'minyawn', array(
            'read' => true,
            'edit_posts' => true,
            'delete_posts' => true,
        ));

        /* Add employer role to the site */
        add_role('employer', 'employer', array(
            'read' => true,
            'edit_posts' => true,
            'delete_posts' => true,
        ));
    }
}

add_action('init', 'phoenix_add_role_cap_function');

/**
 * generate mail header
 */
function email_header() {

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

/**
 * generate mail footer
 */
function email_signature() {
    return '<br/><br/>Regards,<br/>
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

//function to retrieve password on client side using ajax
function retrieve_password_ajx() {
    global $wpdb, $current_site;

    $errors = new WP_Error();

    if (empty($_POST['user_login'])) {
        //$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.'));
        $msg = "<div class='alert alert-success alert-box '>  <button type='button' class='close' data-dismiss='alert'>&times;</button>Enter a username or e-mail address.</div>";
        $success_val = false;
        $response = array('success' => $success_val, 'msg' => $msg);
        wp_send_json($response);
    } else if (strpos($_POST['user_login'], '@')) {
        $user_data = get_user_by('email', trim($_POST['user_login']));
        if (empty($user_data)) { //$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
            $msg = "<div class='alert alert-success alert-box '>  <button type='button' class='close' data-dismiss='alert'>&times;</button>There is no user registered with that email address.</div>";
            $success_val = false;
            $response = array('success' => $success_val, 'msg' => $msg);
            wp_send_json($response);
        }
    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }

    do_action('lostpassword_post');

    if ($errors->get_error_code()) {
        //	return $errors;
        $success_val = false;
        $response = array('success' => $success_val, 'msg' => $msg);
        wp_send_json($response);
    }

    if (!$user_data) {
        //$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or e-mail.'));
        $msg = "<div class='alert alert-success alert-box '>  <button type='button' class='close' data-dismiss='alert'>&times;</button>Invalid username or e-mail.</div>";
        $success_val = false;
        $response = array('success' => $success_val, 'msg' => $msg);
        wp_send_json($response);
        //return $errors;
    }

    // redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;

    do_action('retreive_password', $user_login);  // Misspelled and deprecated
    do_action('retrieve_password', $user_login);

    $allow = apply_filters('allow_password_reset', true, $user_data->ID);

    if (!$allow) {
        //return new WP_Error('no_password_reset', __('Password reset is not allowed for this user'));
        $success_val = false;
        $msg = 'Password reset is not allowed for this user';
        $response = array('success' => $success_val, 'msg' => $msg);
        wp_send_json($response);
    } else if (is_wp_error($allow))
        return $allow;

    $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
    if (empty($key)) {
        // Generate something random for a key...
        $key = wp_generate_password(20, false);
        do_action('retrieve_password_key', $user_login, $key);
        // Now insert the new md5 key into the db
        $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
    }
    $message = 'Hi, <br/><br/>Someone requested that the password be reset for the following account on <a href="' . site_url() . '">' . site_url() . '</a>';

    $message .= '<br/>Username: ' . $user_login;
    $message .= '<br/><br/>If this was a mistake, just ignore this email and nothing will happen.';
    $message .= '<br/>To reset your password, visit the following address:';
    //$message .= '<' . network_site_url("reset-password.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";
    $message .=" <br/><a href='" . site_url() . "/change-password/?action=rp&key=" . $key . "&login=" . rawurlencode($user_login) . "'>" . site_url() . "/change-password/?action=ver&key=" . $user_activation_key . "&login=" . rawurlencode($user_login) . "</a>\r\n";
    if (is_multisite())
        $blogname = $GLOBALS['current_site']->site_name;
    else
    // The blogname option is escaped with esc_html on the way into the database in sanitize_option
    // we want to reverse this for the plain text arena of emails.
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf(__('[%s] Password Reset'), $blogname);

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
    $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";

    if ($message && !wp_mail($user_email, $title, email_header() . $message . email_signature(), $headers)) {
        $msg = '<div class="alert alert-success alert-box ">  <button type="button" class="close" data-dismiss="alert">&times;</button>The e-mail could not be sent.' . "<br />\n" . 'Possible reason: your host may have disabled the mail() function.</div>';
        $success_val = false;
    } else {
        //wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.') );
        $msg = "<div class='alert alert-success alert-box '>  <button type='button' class='close' data-dismiss='alert'>&times;</button>Check your e-mail for the confirmation link.</div>";
        $success_val = true;
    }

    $response = array('success' => $success_val, 'msg' => $msg);
    wp_send_json($response);

    return true;
}

add_action('wp_ajax_retrieve_password_ajx', 'retrieve_password_ajx');
add_action('wp_ajax_nopriv_retrieve_password_ajx', 'retrieve_password_ajx');








/* Invalid new user verification key */

function invalid_newuserverification_key() {
    echo "
			<div class='container'>
			<div class='main-content '>
			<div class='alert alert-error ' style='width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%'>
			<h4 style='text-align:center'>Invalid authentication key or email ID</h4>
			<hr>
			<img src='" . get_template_directory_uri() . "/images/big-minyawns.png'/ style='margin:auto;display:block;'>
					</div>
					</div>
					</div>

					";
}

/**
 * Retrieves a user row based on password reset key and login
 *
 * @uses $wpdb WordPress Database object
 *
 * @param string $key Hash to validate sending user's password
 * @param string $login The user login
 * @return object|WP_Error User's database row on success, error object for invalid keys
 */
function check_password_reset_key_($key, $login) {
    global $wpdb;

    $key = preg_replace('/[^a-z0-9]/i', '', $key);

    if (empty($key) || !is_string($key))
        return new WP_Error('invalid_key', __('Invalid key'));

    if (empty($login) || !is_string($login))
        return new WP_Error('invalid_key', __('Invalid key'));

    $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $key, $login));

    if (empty($user))
        return new WP_Error('invalid_key', __('Invalid key'));

    return $user;
}

/**
 * Handles resetting the user's password.
 *
 * @param object $user The user
 * @param string $new_pass New password for the user in plaintext
 */
function reset_password_($user, $new_pass) {
    do_action('password_reset', $user, $new_pass);

    wp_set_password($new_pass, $user->ID);

    wp_password_change_notification($user);
}

add_filter('avatar_defaults', 'custom_avatar');

function custom_avatar($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/images/profile.png';
    $avatar_defaults[$myavatar] = "Branded Avatar";
    return $avatar_defaults;
}

if (!function_exists('fb_addgravatar')) {

    function fb_addgravatar($avatar_defaults) {
        $myavatar = get_bloginfo('template_directory') . '/images/profile.png';
        $avatar_defaults[$myavatar] = 'Users';
        $myavatar2 = get_bloginfo('template_directory') . '/images/profile.png';
        $avatar_defaults[$myavatar2] = 'My Avatar';
        return $avatar_defaults;
    }

    add_filter('avatar_defaults', 'fb_addgravatar');
}

function create_post_type() {
    register_post_type('job', array(
        'labels' => array(
            'name' => __('Job'),
            'singular_name' => __('Job')
        ),
        'public' => true,
        'has_archive' => true,
        //'taxonomies' => array('category')
            )
    );
//      register_taxonomy(
//            'job_category', 'job'
//    );
      //register_taxonomy_for_object_type( 'category', 'job' );
}

add_action('init', 'create_post_type');
add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {
    register_taxonomy( 'job_category', 'job', array( 'hierarchical' => true, 'label' => 'Job Categories', 'query_var' => true, 'rewrite' => true ) );
}
function register_jobs_taxonomy() {
    register_taxonomy(
            'job_tags', 'job'
    );
   
    
  
    
    
//     register_taxonomy( 'job_tags',array('job'), array(
//'hierarchical' => true,
//'show_ui' => true,
//'query_var' => true,
//'rewrite' => array( 'slug' => 'job_tags'),
//));

}

add_action('init', 'register_jobs_taxonomy');

/**
 * Function to redirect after login depending on the user role
 * redirect to:
 * minyanws -> /minyawns
 * employer -> /employer
 */
function mn_login_redirect($redirect_to, $user_login, $user) {

    //is there a user to check?
    global $user;
    if (isset($user->roles) && is_array($user->roles)) {
        //check for admins
        if (in_array("administrator", $user->roles)) {
            // redirect them to the default place
            $redirect_to = site_url('wp-admin');
        } else {
            $redirect_to = site_url('profile');
        }
    }

    return $redirect_to;
}

add_filter('login_redirect', 'mn_login_redirect', 10, 3);

//setup the global $minyawnjob var for the single job page
function load_single_job() {
    if (!is_singular('job'))
        return;

    global $minyawn_job;
    $minyawn_job = new Minyawn_Job(get_the_ID());
}

add_action('template_redirect', 'load_single_job');

function check_access() {
    global $wpdb, $post, $current_user;
    $page_slug = $post->post_name;
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

    if (empty($user_role))
        $user_role = "Not logged in";

    $queryresult = $wpdb->get_results($wpdb->prepare("SELECT  count(id) as cnt_perm from  " . $wpdb->base_prefix . "userpermissions where role = %s and  noperm_slug = %s ", $user_role, $page_slug), OBJECT);
    foreach ($queryresult as $res)
        if ($res->cnt_perm > 0) {
          //  no_access_page($user_role, $page_slug);
            //return false;
        }
        else
            return true;
}

function no_access_page($user_role, $page_slug) {
    if ($user_role != "Not logged in")
        echo "<div class='alert alert-info ' style='width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%'>
            <div class='row-fluid'>
                <div class='span3'><br><img src='" . site_url() . "/wp-content/themes/minyawns/images/minyaws-icon.png'/></div>
                <div class='span9'> <h4 >No Access</h4>
        <hr>
        Sorry, you aren\'t allowed to view this page. If you are logged in and believe you should have access to this page, send us an email at <a href='mailto:support@minyawns.com'>support@minyawns.com</a> with your username and the link of the page you are trying to access and we\"ll get back to you as soon as possible. 
        <br>
        <a href='" . site_url() . "' class='btn btn-large btn-block btn-success default-btn'>Go Home</a>
        <div class='clear'></div></div>
            </div>
        </div><input type='hidden' name='noaccess_redirect_url' id='noaccess_redirect_url' value='" . site_url() . "/" . $page_slug . "/' />";
    else
        echo "<div class='alert alert-info ' style='width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%'>
            <div class='row-fluid'>
                <div class='span3'><br><img src='" . site_url() . "/wp-content/themes/minyawns/images/minyaws-icon.png'/></div>
                <div class='span9'> <h4 >No Access</h4>
        <hr>
        Hi, you are not logged in yet. If you are registered, please log in, or if not, sign up to get started with minyawns.
        <br>
        <a href='#fakelink' class='btn btn-large btn-block btn-success default-btn' onclick='jQuery(\"#btn__login\").click();' >Login</a>
        <div class='clear'></div></div>
            </div>
        </div> <input type='hidden' name='noaccess_redirect_url' id='noaccess_redirect_url' value='" . site_url() . "/" . $page_slug . "/' />";
    return false;
}

function paypal_payment_mail($email, $subject, $premail_msg, $data_paypal, $sel_minyawn_data) {
    $item__number = $data_paypal['item_number']; //job id
    $job_data = get_post($item__number);

    $mail_message.=" 
						<br/><b>Transaction ID 		: </b> " . $data['txn_id'] . "
						<br/><b>Total Amount 		: </b> " . $data['total_amount'] . "
						<br/><b>Selected Minyawns	: </b> ";


    $cnt_sel_minyawns = 1;
    foreach ($sel_minyawn_data as $key => $value) {
        $mail_message.= "<br/>" . $cnt_sel_minyawns . ". " . $value->display_name . "  " . $value->user_email;
        $cnt_sel_minyawns++;
    }

    $mail_message.= "
						<br/><b>Job    		   		:</b> " . $data['item_name'] . "
						<br/><b>Job Date 			: </b>" . date('d M Y', get_post_meta($item__number, 'job_start_date', true)) . "
						<br/><b>Start Time 			: </b>" . date('g:i a', get_post_meta($item__number, 'job_start_time', true)) . "
						<br/><b>End Time 			: </b>" . date('g:i a', get_post_meta($item__number, 'job_end_time', true)) . "
						<br/><b>Location 			: </b>" . get_post_meta($item__number, 'job_location', true) . "
						<br/><b>Wages 				: </b>" . get_post_meta($item__number, 'job_wages', true) . "
						<br/><b>Details 			: </b>" . $job_data->post_content . "
						<br/><br/><br/>
						";

    add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
    $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
    wp_mail($email, $subject, email_header() . $mail_message . email_signature(), $headers);
}

function get_paypal_payment_meta($transaction_id, $minyawns_tx_id, $jobid) {
    global $wpdb;
    $qry_paypal_payment = "SELECT meta_value as paypal_payment FROM {$wpdb->prefix}postmeta WHERE meta_key ='paypal_payment' ";
    if ($transaction_id != "")
        $qry_paypal_payment.=" and meta_value like '%" . $transaction_id . "%' ";
    if ($minyawns_tx_id != "")
        $qry_paypal_payment.=" and meta_value like '%" . $minyawns_tx_id . "%' ";
    if ($jobid != "")
        $qry_paypal_payment.=" and post_id ='" . $jobid . "' ";

    $paypal_tx = $wpdb->get_results($qry_paypal_payment);

    foreach ($paypal_tx as $res) {
        $paypal_payment = unserialize($res->paypal_payment);
    }
    return $paypal_payment;
}

/*
 * Function to update paypal payment details for hired minyawns
 * Date:2sep2013
 */

function update_paypal_payment($data, $curl_result) {
    global $wpdb;
   
   
    $transaction_id = $data['txn_id'];
    $minyawns_tx_id = $data['custom'];
    if ($curl_result == "VERIFIED")
        $status = $data['payment_status'];
    else
        $status = "";
    $jobid = $data['item_number'];


    $paypal_tx = $wpdb->get_results("SELECT meta_value as paypal_payment FROM {$wpdb->prefix}postmeta WHERE meta_key ='paypal_payment' and post_id ='" . $jobid . "' AND meta_value like '%" . $minyawns_tx_id . "%'  ");

    foreach ($paypal_tx as $res) {
        $paypal_payment = unserialize($res->paypal_payment);
    }
    $new_paypal_payment = array();
    foreach ($paypal_payment as $key_pp => $payment_tx) {
        switch ($key_pp) {
            case 'minyawn_txn_id':
                $new_paypal_payment['minyawn_txn_id'] = $payment_tx;
                break;
            case 'paypal_txn_id':
                $new_paypal_payment['paypal_txn_id'] = $transaction_id;
                break;
            case 'status' :
                $new_paypal_payment['status'] = $status;
                break;
            case 'minyawns_selected' :
                $new_paypal_payment['minyawns_selected'] = $payment_tx;
                break;
        }//end switch($key_pp)
    }//end foreach($paypal_payment as $key_pp => $payment_tx)

    $new_paypal_payment['date_time'] = strtotime(date('D-M-Y G:i:s'));
    $new_paypal_payment['paypal_date'] = strtotime(date('D-M-Y G:i:s'));
    //update postmeta for the job with transaction id
    $new_updated_paypal_payment = serialize($new_paypal_payment);
    $wpdb->get_results("update {$wpdb->prefix}postmeta  set meta_value = '" . $new_updated_paypal_payment . "' WHERE post_id = " . $jobid . " and meta_key ='paypal_payment'  AND    meta_value like '%" . $minyawns_tx_id . "%'");

    //echo "update {$wpdb->prefix}postmeta  set meta_value = '".$new_updated_paypal_payment."' WHERE post_id = ".$jobid." and meta_key ='paypal_payment'  AND    meta_value like '%".$minyawns_tx_id."%'";
//wp_mail('parag@ajency.in','paypalll',$new_paypal_payment."update {$wpdb->prefix}postmeta  set meta_value = '" . $new_updated_paypal_payment . "' WHERE post_id = " . $jobid . " and meta_key ='paypal_payment'  AND    meta_value like '%" . $minyawns_tx_id . "%'");

    if ($status == "Failed") {
        $split_user = explode(",", $new_paypal_payment['minyawns_selected']);
        for ($i = 0; $i < sizeof($split_user); $i++) {
            //$split_status = explode(",", $split_user[$i]);
            // for ($j = 0; $j < sizeof($split_status); $j++) {

            $wpdb->get_results("
					UPDATE {$wpdb->prefix}userjobs 
					SET status = 'applied'
					WHERE user_id = '" . $split_user[$i] . "' 
					AND job_id = '" . $_POST['job_id'] . "'
					"
            );
            //wp_mail('parag@ajency.in','job table check',"UPDATE {$wpdb->prefix}userjobs
				//	SET status = 'applied'	WHERE user_id = '" . $split_user[$i] . "'	AND job_id = '" . $_POST['job_id'] . "'
				//	");
        }//end for ($i = 0; $i < sizeof($split_user); $i++) 
    }//end if($status=="Failed")
    /* else TODO
      {

      //store completed transaction in paypal_payment for cron job

      $wpdb->get_results("insert into  {$wpdb->prefix}paypal_payment
      (job_id,job_author,job_email,trans_id,status,payment_date)values()");



      } */
}

 



add_action('admin_menu', 'job_rating');

function job_rating() {
    add_menu_page('Job Not Rated', 'Job Ratings', 'read', 'my-unique-identifier', 'load_job_rating_page');
}

function load_job_rating_page() {
    if (!current_user_can('administrator')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    include_once 'admin-job-rating.php';
}

function get_object_id($user_id, $job_id = '', $type) {
    global $wpdb;

    if (strlen($job_id) > 0) {
        $select = "{$wpdb->prefix}userjobs.id,{$wpdb->prefix}userjobs.rating";
        $from = "FROM {$wpdb->prefix}userjobs";
        $user_job_where = "WHERE {$wpdb->prefix}userjobs.user_id = " . $user_id . " AND {$wpdb->prefix}userjobs.job_id = " . $job_id . "";
    } else {
        $select = "{$wpdb->prefix}userjobs.id,{$wpdb->prefix}userjobs.rating,{$wpdb->prefix}posts.post_title";
        $from = "FROM {$wpdb->prefix}userjobs,{$wpdb->prefix}posts,{$wpdb->prefix}comments";
        $user_job_where = "WHERE {$wpdb->prefix}userjobs.user_id = " . $user_id . "";
        $user_job_where .=" AND {$wpdb->prefix}posts.ID = {$wpdb->prefix}userjobs.job_id AND {$wpdb->prefix}userjobs.rating !=0 AND {$wpdb->prefix}userjobs.id={$wpdb->prefix}comments.comment_post_id";
    }

    $sql = $wpdb->prepare("SELECT " . $select . " " . $from . "                           
                              " . $user_job_where . "");

    if ($type === 1)
        $object_id = $wpdb->get_results($sql);
    else
        $object_id = $wpdb->get_row($sql);

    return $object_id;
}

/* TODO
 * function cron_paypal_payment_complete()
  {

  add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
  $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
  wp_mail("paragredkar@gmail.com", "test cron job", email_header() . "test message" . email_signature(), $headers);
  }
  add_action('payment_complete_cron_job', 'cron_paypal_payment_complete');
 */


add_filter('cron_schedules', 'filter_schedules', 2, 0);

function filter_schedules() {
    $users_notactivated_reminder = array(
        'WP_CRON_CONTROL_TIME_1' => array('interval' => WP_CRON_CONTROL_TIME_1,
            'display' => 'WP_CRON_CONTROL_TIME_1'),
        'WP_CRON_CONTROL_TIME_2' => array('interval' => WP_CRON_CONTROL_TIME_2,
            'display' => 'WP_CRON_CONTROL_TIME_2')
    );
    return($users_notactivated_reminder);
}

add_action('show_user_profile', 'verified_minyawns_option');
add_action('edit_user_profile', 'verified_minyawns_option');

function verified_minyawns_option($user) {
//    if(!current_user_can('edit_user'))
//       return false; 


    $is_checked = 'unchecked';
    if (get_user_meta($user->ID, 'user_verified', 'Y')):
        $is_checked = 'checked';
    endif;
    ?>

    <th scope="row"><label for="pass2">Verified User</label></th>
    <td>
        <input type="checkbox" name="verify_user" id="verify_user" <?php echo $is_checked ?>  /> Check this if the user is verified.
        <br>
    </td>



    <?php
}

add_action('personal_options_update', 'verified_minyawns_save');
add_action('edit_user_profile_update', 'verified_minyawns_save');

function verified_minyawns_save($user_id) {
//    if(!current_user_can('edit_user'))
//       return false; 
    if (isset($_POST['verify_user']))
        $value = "Y";
    else
        $value = "N";



    update_user_meta($user_id, 'user_verified', $value);
}

/*
 *  GOW
 * 
 * 
 */
//add_action( 'init', 'create_dealer_locator' );
//function create_dealer_locator() {
//    register_post_type( 'dealer_locator',
//        array(
//            'labels' => array(
//                'name' => 'Dealer Locator',
//                'singular_name' => 'List of Dealer Locators',
//                'add_new' => 'Add New',
//                'add_new_item' => 'Add New Dealer Locator',
//                'edit' => 'Edit',
//                'edit_item' => 'Edit Dealer Locator',
//                'new_item' => 'New Dealer Locator',
//                'view' => 'View',
//                'view_item' => 'View Dealer Locator',
//                'search_items' => 'Search Dealer Locators',
//                'not_found' => 'No Movie Dealer Locator',
//                'not_found_in_trash' => 'No Dealer Locator found in Trash',
//                'parent' => 'Parent Dealer Locator'
//            ),
// 
//            'public' => true,
//            'menu_position' => 15,
//            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
//             //'taxonomies' => array('category', 'post_tag'),
//            //'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
//            'has_archive' => true
//        )
//    );
//}
//    add_action( 'init', 'build_taxonomies_dealer', 0 );
//
//function build_taxonomies_dealer() {
//    register_taxonomy( 'dealer_category', 'dealer_locator', array( 'hierarchical' => true, 'label' => 'Dealer Categories', 'query_var' => true, 'rewrite' => true ) );
//}
//function register_dealer_taxonomy() {
//    register_taxonomy(
//            'dealer_tags', 'dealer_locator'
//    );
//}
//add_action('init', 'register_dealer_taxonomy');
?>
<?php
function qt_custom_breadcrumbs() {
  
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
  
  global $post;
  $homeLink = get_bloginfo('url');
  
  if (is_home() || is_front_page()) {
  
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
  
  } else {
  
    echo '<div id="crumbs"> ';
  
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
  
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
  
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
  
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
  
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
  
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
  
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
  
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
  
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
  
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
  
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
  
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
  
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
  
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  
    echo '</div>';
  
  }
} // end qt_custom_breadcrumbs()

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;






 

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

 





function braintree_payments(){
	
	 /* echo ".........";
	  var_dump($_POST);
	  */
	
	global $current_user;
$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);
$current_user_role =  trim($user_role);




	$admin_verify_decrypted = "";
	 
	 global $wpdb,$user_ID;
	 foreach($_POST['data'] as $val){
	 $data[$val['name']] = $val['value'];
	 
	 }
	 
	 //var_dump($data);
	 /*if(isset($data['adminverify'])){
	 	
	 	$admin_verify_encrypted = $data['adminverify']; 
	 	
	 	$admin_verify_decrypted =  encrypt_decrypt('decrypt', $admin_verify_encrypted); 
	 
	 }*/
	 /*if(isset($data['hdn_markaspaid'])){
	 	
	 	$admin_markaspaid = $data['hdn_markaspaid'];  
	 
	 }*/
	 


$result = array();	 
	 
if($current_user_role!="administrator"){
	
	
	
	require_once ABSPATH.'wp-content/themes/minyawns/braintree_lib/Braintree.php';

//Sandbox mode
/*Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('m5j78m5tpkbqjz9r');
Braintree_Configuration::publicKey('hpsfvwz3qwstzwqy');
Braintree_Configuration::privateKey('7821082eb89ed086c1a0d1b7e08a9362');
*/ 

/*Braintree_Configuration::environment('production');
Braintree_Configuration::merchantId('s5f7jrwq9qdr4prr');
Braintree_Configuration::publicKey('wps9xdqgpy453srw');
Braintree_Configuration::privateKey('44d5720ea98a377f84ef20cf23776dd2');
*/ 

//Production mode
/*Braintree_Configuration::environment('production');
Braintree_Configuration::merchantId('s5f7jrwq9qdr4prr');
Braintree_Configuration::publicKey('wps9xdqgpy453srw');
Braintree_Configuration::privateKey('44d5720ea98a377f84ef20cf23776dd2');
*/


if(BRAINTREE_PAYMENT_MODE=="sandbox"){


	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId('m5j78m5tpkbqjz9r');
	Braintree_Configuration::publicKey('hpsfvwz3qwstzwqy');
	Braintree_Configuration::privateKey('7821082eb89ed086c1a0d1b7e08a9362');
}
else if(BRAINTREE_PAYMENT_MODE=="production"){
//Production mode


	Braintree_Configuration::environment('production');
	Braintree_Configuration::merchantId('s5f7jrwq9qdr4prr');
	Braintree_Configuration::publicKey('wps9xdqgpy453srw');
	Braintree_Configuration::privateKey('44d5720ea98a377f84ef20cf23776dd2');
}


	
$result = Braintree_Transaction::sale(array(
    										"amount" => $data["amount"],
    										"creditCard" => array(
        									"number" => $data["number"],
       										"cvv" => $data["cvv"],
        									"expirationMonth" => $data["month"],
       	 									"expirationYear" => $data["year"]
										    ),
										    "options" => array(
										        "submitForSettlement" => true,
										    	
										    ),
										    "customFields"=> array("minyawn_txn_id"		=> $data['custom'],
										    						"item_number"		=> $data["item_number"],
										    						'minyawns_selected' => $data['minyawn_id'] 
										    					   )
										     
											));
											
											/*
											 * 'abc' => array('minyawns_selected' =>$data["minyawn_id"],
										    						'custom'			=> $data["custom"],
										    						'item_number'		=> $data["item_number"],
											 */
											
											
											



} 

$paypal_payment = array('minyawn_txn_id' => $data['custom'], 'paypal_txn_id' => '', 'status' => '', 'minyawns_selected' =>$data['minyawn_id']);

 //var_dump($paypal_payment);

update_post_meta($data['item_number'], 'paypal_payment', $paypal_payment);
          
          
         

//var_dump($result);

$item__number = $data["item_number"];

$admin_email = get_option( 'admin_email' );

$current_userdata = get_userdata($user_ID);




/*echo "\n\n\ admin_markaspaid".$admin_markaspaid;
 echo "\n\n admin_verify_decrypted".$admin_verify_decrypted;
 echo "\n\n admin email ".get_option('admin_email');*/

 if( ($result->success) || ($current_user_role==="administrator" )  ) {
    //echo("Success! Transaction ID: " . $result->transaction->id);
    
    
				if($result->success){
					$data['txn_id'] = $result->transaction->id;
				}
	
    			if($current_user_role==="administrator"){
    				
    				$data['txn_id'] = "AdminMarked_".$data['custom'];
    			}
    
      			 	
				$job_data = get_post($item__number);
				
				$data['item_name'] = $job_data->post_title;
				
				$data['payment_status'] = 'Completed';
				
				update_braintree_payment($data,'Completed');
				
				$paypal_payment_meta = get_paypal_payment_meta($data['txn_id'],$data['custom'],$data['item_number']);
				
				
				/*echo 'paypal_payment_meta';
				var_dump($paypal_payment_meta);
				exit();*/
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
				
				/*echo 'minyawns data';
				var_dump($minyawn_data);
				*/ 
				
				/*if(($data['payment_status']=="Completed") )
				{*/
					  
					
					  	 
					/*add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
					wp_mail('paragredkar@gmail.com', "verified",  $req.'curl result'.$curl_result );*/
					 
					$receiver_subject = "Minyawns - Payment successfull for ".$data['item_name']." job";
					
					$receiver_message.="Hi,<br/><br/>
							
							Payment for '".get_the_title($data['item_number'] )."' successfully transferred .
							<br/><b>Transaction ID  :</b> ".$data['txn_id']."
							<br/><b>Job    			:</b> ".get_the_title($data['item_number'] )."
							<br/><b>Total Amount 			:</b> ".$data['amount']."
					
					<br/><b>selected Minyawns	:</b> ";
					
					
					//$receiver_message.= "<br/><br/>***".print_r($minyawn_data,true)."<br/><br/>";
					$cnt_sel_minyawns  = 1;
					$wages_minyawns = get_post_meta($data['item_number'] , 'job_wages', true) - ( (get_post_meta($data['item_number'] , 'job_wages', true) *10)/100 );
					
                    foreach($minyawn_data as $key=>$value)
					{
						//$receiver_message.= "<br/><br/>###".print_r($key,true)."  --- ".print_r($value,true);
					
						$receiver_message.= "<br/>".$cnt_sel_minyawns.". ".$value->display_name."  ".$value->user_email;
						
						
						
						//update selected minyawns status to hired
						//echo "UPDATE {$wpdb->prefix}userjobs SET status = 'hired' WHERE user_id = '" . $value->ID . "' AND job_id = '" . $data['item_number'] . "'";
						$wpdb->get_results("UPDATE {$wpdb->prefix}userjobs SET status = 'hired' WHERE user_id = '" . $value->ID . "' AND job_id = '" . $data['item_number'] . "'");
						update_post_meta($data['item_number'],'job_status','completed');
						//send mail to hired minyawns						
						$job_data = get_post($data['item_number']);						
						//$minyawns_subject = "Minyawns - You have been hired for " . get_the_title($data['item_number'] ); 
						$minyawns_subject = "Minyawns - You have been hired! ";
               			$minyawns_message = "Hi,<br/><br/>
                		Congratulations, You have been hired for the job '" . get_the_title($data['item_number'] ) . "'<br/><br/>
                		Please take note of the following: <br/>
                		1) Be on time to your job. You are getting paid to do your best work – you want to represent
				yourself, the University of Washington, and Minyawns well! <br/>
				2) If you are not contacted by the job poster, then they trust you to show up. Please show up 
				regardless of the situation – you will be paid once the job is complete.<br/>
				3) Wear appropriate attire to the event - whether it is formal, business-casual, or casual. <br/>
				4) You will be paid within 24 hours of the job either through Venmo or PayPal. Please specify which
				method of payment you would like by emailing support@minyawns.com. If we do not receive 
				an email, we will send the money via PayPal by default. <br/><br/>
				Best of luck & have fun! <br/>
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
		                
		                
		                
		               /* wp_mail('paragredkar@gmail.com', $minyawns_subject.'minyawns mail'.$value->user_email, email_header() . $minyawns_message . email_signature(), $headers);
								
		                
		                echo "\n minyawn mail to ".$value->user_email;
		                */
						
						
						

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
					//wp_mail($data['receiver_email'], $receiver_subject, email_header() . $receiver_message . email_signature(), $headers);
					wp_mail($admin_email, $receiver_subject, email_header() . $receiver_message . email_signature(), $headers);
					
					/*echo 'admin mail'.$admin_email;
					wp_mail('paragredkar@gmail.com', $receiver_subject.' receiver mail '.$admin_email, email_header() . $receiver_message . email_signature(), $headers);
					*/
					
					
					$sender_subject = "Minyawns - Payment successfull for ".$data['item_name']." job";
					$sender_message.="Hi,<br/><br/>
				
							Your Payment for '".$data['item_name']."' successfully Completed .
							<br/><b>Transaction ID : </b> ".$data['txn_id']."
							<br/><b>Total Amount 			: </b> ".$data['amount']."
									
									
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
					//wp_mail($data['payer_email'], $sender_subject, email_header() . $sender_message . email_signature(), $headers);
					wp_mail($current_userdata->user_email, $sender_subject, email_header() . $sender_message . email_signature(), $headers);
					
					/*echo 'current_userdata->user_email'.$current_userdata->user_email;
					wp_mail('paragredkar@gmail.com', $sender_subject.' payer email '. $current_userdata->user_email, email_header() . $sender_message . email_signature(), $headers);
					*/	
				//}
    
    
    
    $data['cvv'] = '';
    $data['number'] = '';
    $data['year'] = '';  
    $data['month'] = ''; 
    
    $response_payment = array("success"			=> true, 
    						  'transaction_id'	=> $data['txn_id'],
    						  'msg'				=> 'Transaction successful.',
    						  'data'			=> $data,
    						  'error'			=> ''
   							  );
    wp_send_json($response_payment);
    
    
    
} else if ($result->transaction) {
     /*echo("Error: " . $result->message);
    echo("<br/>");
    echo("Code: " . $result->transaction->processorResponseCode);
    print_r($result); 
    
  echo "\n Transaction ID".$result->transaction->id;*/
    
  				$data['txn_id'] = $result->transaction->id; 
  				
    			$data['payment_status'] = 'Failed';
    
    			update_braintree_payment($data);
			 
				
				update_post_meta($data['item_number'],'job_status','failed');
				
				$job_data = get_post($data['item_number']);	
				
				
				$paypal_payment_meta = get_paypal_payment_meta($data['txn_id'],$data['custom'],$data['item_number']);
				
				
				/*echo 'paypal_payment_meta';
				var_dump($paypal_payment_meta);
				exit();*/
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
				
				
				
				
				
				
				$receiver_subject = "Minyawns - Payment Failed for ".$job_data->post_title." job";
				$receiver_message.="Hi,<br/><br/>
				
							Payment failed for '".$job_data->post_title."'.
							<br/><b>Transaction ID  	: </b> ".$data['txn_id']."
							<br/><b>Total Amount 		: </b> ".$data['amount']."	
						
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
									
									
							<br/><b>Job    	  : </b> ".$job_data->post_title."							
							<br/><b>Job Date  : </b>". date('d M Y',   get_post_meta($item__number,'job_start_date',true))."
							<br/><b>Start Time: </b>". date('g:i a',  get_post_meta($item__number,'job_start_time',true))."							
							<br/><b>End Time  : </b>". date('g:i a',  get_post_meta($item__number,'job_end_time',true))."							 
							<br/><b>Location  : </b>". get_post_meta($item__number,'job_location',true)."
							<br/><b>Wages 	  : </b>".get_post_meta($item__number,'job_wages',true)."
							<br/><b>details   : </b>".$job_data->post_content."		
					
							<br/><br/><br/>
							";
					
				add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
				$headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
				//wp_mail($data['receiver_email'], $subject, email_header() . $receiver_message . email_signature(), $headers);

				wp_mail($admin_email, $subject, email_header() . $receiver_message . email_signature(), $headers);
				
				// wp_mail('paragredkar@gmail.com', $subject.' receiver error '.$admin_email, email_header() . $receiver_message . email_signature(), $headers);

				
				
					
				$sender_subject = "Minyawns - Payment Failed for ".$job_data->post_title." job";
				$sender_message.="Hi,<br/><br/>
				
							Your Payment failed for '".$job_data->post_title."'.
							<br/><b>Transaction ID  	: </b> ".$data['txn_id']."							
							<br/><b>Amount 				: </b> ".$data['amount']."
			
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
									
									
							<br/><b>Job    			:</b> ".$job_data->post_title."							
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
				//wp_mail($data['payer_email'], $sender_subject, email_header() . $sender_message . email_signature(), $headers);

				
				wp_mail($current_userdata->user_email, $sender_subject, email_header() . $sender_message . email_signature(), $headers);
					
				
				//wp_mail('paragredkar@gmail.com', $sender_subject.' payer error '.$current_userdata->user_email, email_header() . $sender_message . email_signature(), $headers);
					
				$data['cvv'] = '';
			    $data['number'] = '';
			    $data['year'] = '';  
			    $data['month'] = ''; 
    
				$response_payment = array("success"			=> false, 
										  'transaction_id'	=> '', 
    						  			  'error'			=> $result->transaction->processorResponseCode, 
    						  			  'msg'				=> $result->message,
										  'data'			=> $data
										 );
				 
   				wp_send_json($response_payment);
    
    
    
    
    
    
    
    
    
    
    
} else {
    $error_message = "Validation errors:<br/>";
    foreach (($result->errors->deepAll()) as $error) {
        //echo("- " . $error->message . "<br/>");
        $error_message.= "- " . $error->message . "<br/>";
        
    }
    
    $data['cvv'] = '';
    $data['number'] = '';
    $data['year'] = '';  
    $data['month'] = ''; 
    
    $response_payment = array("success"			=> false, 
    						  'transaction_id'	=> '', 
    						  'error'			=> '', 
    						  'msg'				=> $error_message,
    						  'data'			=> $data	
    						 );
    
    
    
    wp_send_json($response_payment);
}
	
	
}
add_action('wp_ajax_braintree_payments', 'braintree_payments');
add_action('wp_ajax_nopriv_braintree_payments', 'braintree_payments');








function update_braintree_payment($data) {
    global $wpdb;
   
   
    $transaction_id = $data['txn_id'];
    $minyawns_tx_id = $data['custom'];
    $status = $data['payment_status'];
    
    $jobid = $data['item_number'];


    $paypal_tx = $wpdb->get_results("SELECT meta_value as paypal_payment FROM {$wpdb->prefix}postmeta WHERE meta_key ='paypal_payment' and post_id ='" . $jobid . "' AND meta_value like '%" . $minyawns_tx_id . "%'  ");

    foreach ($paypal_tx as $res) {
        $paypal_payment = unserialize($res->paypal_payment);
    }
    $new_paypal_payment = array();
    foreach ($paypal_payment as $key_pp => $payment_tx) {
        switch ($key_pp) {
            case 'minyawn_txn_id':
                $new_paypal_payment['minyawn_txn_id'] = $payment_tx;
                break;
            case 'paypal_txn_id':
                $new_paypal_payment['paypal_txn_id'] = $transaction_id;
                break;
            case 'status' :
                $new_paypal_payment['status'] = $status;
                break;
            case 'minyawns_selected' :
                $new_paypal_payment['minyawns_selected'] = $payment_tx;
                break;
        }//end switch($key_pp)
    }//end foreach($paypal_payment as $key_pp => $payment_tx)

    $new_paypal_payment['date_time'] = strtotime(date('D-M-Y G:i:s'));
    $new_paypal_payment['paypal_date'] = strtotime(date('D-M-Y G:i:s'));
    //update postmeta for the job with transaction id
    $new_updated_paypal_payment = serialize($new_paypal_payment);
    $wpdb->get_results("update {$wpdb->prefix}postmeta  set meta_value = '" . $new_updated_paypal_payment . "' WHERE post_id = " . $jobid . " and meta_key ='paypal_payment'  AND    meta_value like '%" . $minyawns_tx_id . "%'");

    //echo "update {$wpdb->prefix}postmeta  set meta_value = '".$new_updated_paypal_payment."' WHERE post_id = ".$jobid." and meta_key ='paypal_payment'  AND    meta_value like '%".$minyawns_tx_id."%'";
//wp_mail('parag@ajency.in','paypalll',$new_paypal_payment."update {$wpdb->prefix}postmeta  set meta_value = '" . $new_updated_paypal_payment . "' WHERE post_id = " . $jobid . " and meta_key ='paypal_payment'  AND    meta_value like '%" . $minyawns_tx_id . "%'");

    if ($status == "Failed") {
        $split_user = explode(",", $new_paypal_payment['minyawns_selected']);
        for ($i = 0; $i < sizeof($split_user); $i++) {
            //$split_status = explode(",", $split_user[$i]);
            // for ($j = 0; $j < sizeof($split_status); $j++) {

            $wpdb->get_results("
					UPDATE {$wpdb->prefix}userjobs 
					SET status = 'applied'
					WHERE user_id = '" . $split_user[$i] . "' 
					AND job_id = '" . $_POST['job_id'] . "'
					"
            );
            //wp_mail('parag@ajency.in','job table check',"UPDATE {$wpdb->prefix}userjobs
				//	SET status = 'applied'	WHERE user_id = '" . $split_user[$i] . "'	AND job_id = '" . $_POST['job_id'] . "'
				//	");
        }//end for ($i = 0; $i < sizeof($split_user); $i++) 
    }//end if($status=="Failed")
     
}




/* Function to provide option to set city in admin side dashboard  */

function my_general_settings_register_fields(){
    register_setting('general', 'minyawn_city', 'esc_attr');
    add_settings_field('minyawn_city', '<label for="minyawn_city">'.__('City' , 'minyawn_city' ).'</label>' , 'my_general_settings_fields_html', 'general');
}
add_filter('admin_init', 'my_general_settings_register_fields');

function my_general_settings_fields_html(){
    $value = get_option( 'minyawn_city', '' );
    //echo '<input type="text" id="minyawn_city" name="minyawn_city" value="' . $value . '" />';



    echo '<select id="minyawn_city" name="minyawn_city">
                <option value="Seattle"'.($value==="Seattle"?" selected ": " " ).'>Seattle</option>
                <option value="Fresno" '.($value==="Fresno"?" selected ": " " ).' >Fresno</option>
          </select>';



}





function my_general_settings_register_payment_fields(){
    register_setting('general', 'payment_type', 'esc_attr');
    add_settings_field('payment_type', '<label for="payment_type">'.__('Payment Type' , 'payment_type' ).'</label>' , 'my_general_payment_settings_fields_html', 'general');
}
add_filter('admin_init', 'my_general_settings_register_payment_fields');

function my_general_payment_settings_fields_html(){
    $value = get_option( 'payment_type', '' );
    //echo '<input type="text" id="minyawn_city" name="minyawn_city" value="' . $value . '" />';



    echo '<select id="payment_type" name="payment_type">
                <option value="braintree"'.($value==="braintree"?" selected ": " " ).'>Braintree</option>
                <option value="paypal" '.($value==="paypal"?" selected ": " " ).' >Paypal</option>
          </select>';



}

function my_login_logo() { ?>
    <style type="text/css">
	body{
	 background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/what-we-can-do-bg.jpg) !important;
	}
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            /* padding-bottom: 30px; */
            background-size: 274px 63px;
            width: 326px;
        }

		body.login #nav a, body.login #backtoblog a  {
			color:#fff !important;
			text-shadow:none;
			font-size:15px;
            text-align:center;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );




function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {

    $blog_title = get_bloginfo('name');
    return $blog_title;
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


function remove_lostpassword_text ( $text ) {
    if ($text == 'Lost your password?'){$text = '';}
    return $text;
}
add_filter( 'gettext', 'remove_lostpassword_text' );


/**
 * remove the register link from the wp-login.php script
 */
add_filter('option_users_can_register', function($value) {
    $script = basename(parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH));

    if ($script == 'wp-login.php') {
        $value = false;
    }

    return $value;
});

/*
function hide_login_nav(){
    ?><style>#nav,#backtoblog{display:none}</style><?php
}
add_action( 'login_head', 'hide_login_nav' );

*/

 //additonal field to user profile to 
//display user in home page footer
function my_show_extra_profile_fields( $user=array() ) { ?>
 
<h3>Extra profile information</h3>
 
<table class="form-table">
    <tr>
        <th><label for="twitter">Display on homepage footer </label></th>
        <td>
            <input type="checkbox" value = "1" name="display_on_homepage_footer" 

id="display_on_homepage_footer"  <?php if($user->display_on_homepage_footer==1){ echo "checked"; } 

?>    /><br />
             
        </td>
    </tr>
</table>
<?php }


add_action( 'edit_user_profile', 'my_show_extra_profile_fields' ,10,1);
add_action( 'user_new_form', 'my_show_extra_profile_fields' ,10,1);


//save addtional suer profile fields
 
function my_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    if(isset($_POST['display_on_homepage_footer'])){
        update_user_meta( $user_id, 'display_on_homepage_footer', $_POST['display_on_homepage_footer'] );
    }else{
        update_user_meta( $user_id, 'display_on_homepage_footer',0 );
    }

    
}


add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
add_action( 'user_register', 'my_save_extra_profile_fields' );


function get_users_for_homepage_footer(){


    $args = array( 
                'role'         => 'minyawn',
                'meta_key'     => 'display_on_homepage_footer',
                'meta_value'   => '1',
                'meta_compare' => '=' 
            );
    $homepage_users = get_users($args);

    return $homepage_users;
}


function get_user_avatar_by_id($id){

    $avatar_attachment = get_user_meta($id,'avatar_attachment');

    $user_profile_pic =  isset($avatar_attachment['avatar_attachment']) ? trim($avatar_attachment['avatar_attachment'][0]) : false;

    if ($user_profile_pic !== false) {

        $user_pic_img_src =  wp_get_attachment_image($user_profile_pic);

    } else {

        $user_pic_img_src = get_avatar($id);

    }
echo $user_pic_img_src;
    return $user_pic_img_src;
}



/*function photocontrol() {
require_once('class.photo.php');
global $photo_model;
$photo_model = new PhotoModel();
$photo_model->init();
}
add_action('init', 'photocontrol', '1');*/





/****************Photos API****************/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if(is_plugin_active('json-rest-api/plugin.php')){
/**
     * Change the json rest api plugin prefix from wp-json to api
     *
     * @since ajency-activity-and-notifications (0.1)
     *
     * @uses json rest api plugin filter hook json_url_prefix
     */
function change_json_rest_api_prefix($prefix){

    return "api";

}
add_filter( 'json_url_prefix', 'change_json_rest_api_prefix',10,1);


function photo_api_init() {
    global $photo_api;

    $photo_api = new PhotoAPI();
    add_filter( 'json_endpoints', array( $photo_api, 'register_routes' ) );
}
add_action( 'wp_json_server_before_serve', 'photo_api_init' );


require_once('class.photo.php');







class PhotoAPI {

   /*Initialize the photo model variable*/
   public $photo_model;
   

   /*Instantiate Photo object in construct*/
    public function __construct() {
        $this->photo_model = new PhotoModel();
        $this->photo_model->init();
    }

    /*Register Routes*/
    public function register_routes( $routes ) {

      //Upload route for user pictures
       $routes['/photos/upload'] = array(
            array( array( $this, 'upload_photos'), WP_JSON_Server::CREATABLE | WP_JSON_Server::ACCEPT_JSON ),
            );

       //Upload route for user pictures upload to the job
       $routes['/photos/upload/(?P<jobid>\d+)'] = array(
            array( array( $this, 'upload_photos'), WP_JSON_Server::CREATABLE | WP_JSON_Server::ACCEPT_JSON ),
            );

       //Delete route
       $routes['/photos/delete/(?P<photoid>\d+)'] = array(
            array( array( $this, 'delete_photos'), WP_JSON_Server::DELETABLE ),
            );

       //Route to get photos either by job id or user id or both
        $routes['/photos/job/(?P<jobid>\d+)/user/(?P<userid>\d+)'] = array(
            array( array( $this, 'get_photos'), WP_JSON_Server::READABLE ),
            );

        $routes['/photos/job/(?P<jobid>\d+)'] = array(
            array( array( $this, 'get_photos'), WP_JSON_Server::READABLE ),
            );

        $routes['/photos/user/(?P<userid>\d+)'] = array(
            array( array( $this, 'get_photos'), WP_JSON_Server::READABLE ),
            );

        $routes['/login/username/(?P<username>\w+)/password/(?P<password>\w+)'] = array(
            array( array( $this, 'get_login_status'), WP_JSON_Server::READABLE ),
            );


        
         return $routes;
    }



    //Upload photos and get response
    public function upload_photos($jobid = 0){
        $response = json_encode( $this->photo_model->upload_photos($jobid) );
        header( "Content-Type: application/json" );
        echo $response;
        exit;
    }

    //Delete photos and get response
    public function delete_photos($photoid){
        if($this->photo_model->delete_photos($photoid,$nonce)){
        $resp = 'true';
    }else{
        $resp = 'false';
    }

    $response = array('status' => $resp);

    $response = json_encode( $response );

    header( "Content-Type: application/json" );

    echo $response;

    exit;
    }

    //Get photos
    public function get_photos($jobid='',$userid=''){
        
     $response = $this->photo_model->get_photos($jobid, $userid);
     $response = json_encode( $response );

     header( "Content-Type: application/json" );

     echo $response;

     exit;
 }


//User Authentication
 public function get_login_status($username,$password){
    global $wp, $wp_rewrite, $wp_the_query, $wp_query;


    if(empty($username) || empty($password)){

        return false;

    } else {

        $response = array('status'=>false);

        $auth = wp_authenticate($username, $password );

        if( is_wp_error($auth) ) { 
            wp_logout();     
            $response = array('status'=>false);
        } else {

            /*$user_login = $username;
            $user = get_userdatabylogin($user_login);
            $user_id = $user->ID;
            wp_set_current_user($user_id, $user_login);
            wp_set_auth_cookie($user_id);
            do_action('wp_login', $user_login);*/


            $user_login = $username;
            $user = get_userdatabylogin($user_login);
            $user_id = $user->ID;


            $creds = array();
            $creds['user_login'] = $username;
            $creds['user_password'] = $password;
            $creds['remember'] = ($remember_me === "true") ? true : false;

            $user = wp_signon( $creds, false );

            //$user_id = get_current_user_id();
            //$logincookie = wp_generate_auth_cookie('1',strtotime( '+14 days' ),'logged_in','');

            $logincookie = wp_generate_auth_cookie( $user_id, strtotime( '+14 days' ), 'logged_in', '' );
            setcookie(LOGGED_IN_COOKIE, $logincookie, strtotime( '+14 days' ), COOKIEPATH, COOKIE_DOMAIN, false, false);

            //do_action( 'set_logged_in_cookie', LOGGED_IN_COOKIE, '43200', strtotime( '+14 days' ), '1','logged_in');

           // apply_filters('auth_cookie', $cookie, $user_id, $expiration, $scheme)

            $response = array('status'=> 'true',
                            'cookie'=> LOGGED_IN_COOKIE,
                            'value' =>  $logincookie
                    );
        }

        //$response = array('status'=>$status);
        $response = json_encode( $response );

        header( "Content-Type: application/json" );

        echo $response;

        exit;

    }   
}


  
}


}



