<?php

/**
 * Contains all required user api functions
 */

/**
 * Set up all existing profile data for the logged in user
 */
function setup_user_profile_data() {
//    if (!is_user_logged_in())
//    {   
//     fetch_not_logged_in();
//        return;
//        
//    }
    //global $current_user_new;
    error_reporting(E_ERROR | E_PARSE);
    //$get_user_id = explode("/", $_SERVER['REQUEST_URI']);
    //global $current_user_new;
    //$current_user_new = new stdclass;
    // var_dump(sizeof($get_user_id));exit();
    // if (!is_user_logged_in()) {
    //preg_match("/\/(\d+)$/",$_SERVER['REQUEST_URI'],$matches);
    $end = check_direct_access();

    //var_dump($end);exit();
    global $current_user, $current_user_new;

    $current_user_new = new stdclass;


    if (is_numeric($end)) {
        $current_user_new->data = new stdClass;
        $current_user_new = wp_set_current_user_profile($end);
    } else {
        $current_user_new->data = new stdClass;
        $current_user_new = $current_user;
    }

//var_dump($current_user_new);exit();
    $user_meta = get_user_meta($current_user_new->data->ID);

    $current_user_new->data->user_id = $current_user_new->data->ID;
    //set profile first name
    $current_user_new->data->first_name = trim($user_meta['first_name'][0]);

    //set profile last name
    $current_user_new->data->last_name = trim($user_meta['last_name'][0]);

    //set college
    $current_user_new->data->college = isset($user_meta['college']) ? trim($user_meta['college'][0]) : '';

    //set major
    $current_user_new->data->major = isset($user_meta['major']) ? trim($user_meta['major'][0]) : '';

    //set skills

    $current_user_new->data->user_skills = isset($user_meta['user_skills']) ? maybe_unserialize($user_meta['user_skills'][0]) : '';


    //set socials
    $current_user_new->data->socials = isset($user_meta['socials']) ? maybe_unserialize($user_meta['socials'][0]) : array();

    //set profile profile_body
    $current_user_new->data->profilebody = isset($user_meta['profilebody']) ? trim($user_meta['profilebody'][0]) : '';

    //set profile profile linked in
    $current_user_new->data->linkedin = isset($user_meta['linkedin']) ? trim($user_meta['linkedin'][0]) : '';

 //set profile profile facebook
    $current_user_new->data->facebook_link = isset($user_meta['facebook_link']) ? trim($user_meta['facebook_link'][0]) : '';
     
    $current_user_new->data->company_website = isset($user_meta['company_website']) ? trim($user_meta['company_website'][0]) : '';

    $current_user_new->data->company_name = isset($user_meta['company_name']) ? trim($user_meta['company_name'][0]) : '';

    //set profile profile linked in
    $current_user_new->data->location = isset($user_meta['location']) ? trim($user_meta['location'][0]) : '';

    //set profile facebook_uid
    $current_user_new->data->facebook_uid = isset($user_meta['facebook_uid']) ? trim($user_meta['facebook_uid'][0]) : 0;

    //set profile facebook_avatar_full image
    $current_user_new->data->facebook_avatar_full = isset($user_meta['facebook_avatar_full']) ? trim($user_meta['facebook_avatar_full'][0]) : '';

    //set profile facebook_avatar_thumb image
    $current_user_new->data->facebook_avatar_thumb = isset($user_meta['facebook_avatar_thumb']) ? trim($user_meta['facebook_avatar_thumb'][0]) : '';

    //check if user has avatar uploaded
    $current_user_new->data->avatar = isset($user_meta['avatar_attachment']) ? trim($user_meta['avatar_attachment'][0]) : false;

    //check if user verified
    $current_user_new->data->verified=isset($user_meta['user_verified'][0]) ? trim($user_meta['user_verified'][0]):0;
  
    // global $current_user_new;
    global $wpdb;
    $sql = $wpdb->prepare("SELECT {$wpdb->prefix}userjobs.user_id,{$wpdb->prefix}userjobs.job_id, SUM( if( rating =1, 1, 0 ) ) AS positive, SUM( if( rating = -1, 1, 0 ) ) AS negative
                              FROM {$wpdb->prefix}userjobs
                              WHERE {$wpdb->prefix}userjobs.user_id = %d
                              GROUP BY {$wpdb->prefix}userjobs.user_id", $current_user_new->data->ID);

    $minyawns_rating = $wpdb->get_row($sql);

  
        $current_user_new->data->like_count = $minyawns_rating->positive;
        $current_user_new->data->dislike_count = $minyawns_rating->negative;

//                    if($user['like'] != "0" || $user['dislike'] != "0")
//                        $user['is_job_rated']=1;
  
   
}

add_action('wp_loaded', 'setup_user_profile_data');

//User ID
function user_id() {
    echo get_user_id();
}

function get_user_id() {
    global $current_user_new;
    return $current_user_new->data->ID;
}

//is fb registered
function is_user_fb_registered() {
    global $current_user_new;
    return $current_user_new->data->facebook_uid !== 0;
}

//get user FB avatar URL
function get_user_fb_avatar($type = 'thumb') {
    global $current_user_new;

    if ($type == 'large')
        return 'https://graph.facebook.com/' . $current_user_new->data->facebook_uid . '/picture?width=200&height=200';
    else
        return 'https://graph.facebook.com/' . $current_user_new->data->facebook_uid . '/picture?type=square';
}

function get_mn_user_avatar() {

    global $current_user_new;
   
    if ($current_user_new->data->avatar !== false) {
       
        $url=wp_get_attachment_image_src($current_user_new->data->avatar);
        
    return $url[0];
        
    } else {
        return false;
    }
}

function get_mn_user_avatar_profile($role) {
    $upload_dir = wp_upload_dir();
    global $current_user_new;
    if ($current_user_new->data->avatar !== false) {
        //return wp_get_attachment_thumb_url($current_user_new->data->avatar);
        return site_url() . '/wp-content/uploads/user-avatars/' . get_user_id() . '/' . get_user_role() . get_user_id() . '.jpg';
    }

    if (is_user_fb_registered())
        return get_user_fb_avatar('large');

    return false;
}

//user profile name
function user_profile_name() {
    echo get_user_profile_name();
}

function get_user_profile_name() {
    global $current_user_new;

    return $current_user_new->data->first_name . ' ' . ($current_user_new->data->last_name) ? $current_user_new->data->last_name : '';
}

//User profile first name
function user_profile_first_name() {
    return get_user_profile_first_name();
}

function user_profile_company_name() {
  
    global $current_user_new;

    return $current_user_new->data->company_name;
}

function get_user_profile_first_name() {
    global $current_user_new;

    return $current_user_new->data->first_name;
}

//User profile last name
function user_profile_last_name() {
    return get_user_profile_last_name();
}

function get_user_profile_last_name() {
    global $current_user_new;

    return strlen($current_user_new->data->last_name) > 0 ? $current_user_new->data->last_name : '';
}

//User profile body
function user_profile_body() {
    echo get_user_profile_body();
}

function get_user_profile_body() {
    global $current_user_new;

    return $current_user_new->data->profilebody;
}

//Company website
function user_company_website() {
    echo get_user_company_website();
}

function get_user_company_website() {
    global $current_user_new;
   // return $current_user_new->data->company_website;
    return preg_replace('#^https?://#', '', rtrim($current_user_new->data->company_website,'/'));
}

//User location
function user_location() {
    echo get_user_location();
}

function get_user_location() {
    global $current_user_new;
    return $current_user_new->data->location;
}

//User profile linkedin
function user_profile_linkedin() {
    return get_user_profile_linkedin();
}

function get_user_profile_linkedin() {
    global $current_user_new;

    //return $current_user_new->data->linkedin;
    
  
    return preg_replace('#^http(s)?://#', '', rtrim($current_user_new->data->linkedin,'/'));
   
}

//user profile facebook
function user_profile_facebook() {
    return get_user_profile_facebook();
}

function get_user_profile_facebook() {
    global $current_user_new;
  
    return preg_replace('#^http(s)?://#', '', rtrim($current_user_new->data->facebook_link,'/'));
   
}

// user role
function get_user_role() {
    global $current_user_new;

    return $current_user_new->roles[0];
}

//user college 
function user_college() {
    echo get_user_college();
}

function get_user_college() {
    global $current_user_new;
    return isset($current_user_new->data->college) ? $current_user_new->data->college : '';
}

// User college major
function user_college_major() {
    echo get_user_college_major();
}

function get_user_college_major() {
    global $current_user_new;
    return isset($current_user_new->data->major) ? $current_user_new->data->major : '';
}



//User Intro Video ID
function get_user_intro_video_id() {
    global $current_user_new;
    return get_user_meta($current_user_new->data->ID, 'intro_video_id', true);
    
    }


//User profile email
function user_profile_email() {
    echo get_user_profile_email();
}

function get_user_profile_email() {
    global $current_user_new;

    return $current_user_new->data->user_email;
}

//User social pages
function get_user_social_pages() {
    global $current_user_new;
    return isset($current_user_new->data->socials) ? $current_user_new->data->socials : array();
}

//User social pages
function get_user_skills() {
    global $current_user_new;
    return isset($current_user_new->data->user_skills) ? $current_user_new->data->user_skills : '';
}

//User like count
function user_like_count() {
     global $current_user_new;
    echo get_user_like_count();
}

function get_user_like_count() {
    global $current_user_new;
    
    return  ($current_user_new->data->like_count) > 0 ? $current_user_new->data->like_count : 0;
}

//User dislike count
function user_dislike_count() {
     global $current_user_new;
    echo get_user_dislike_count();
}

function get_user_dislike_count() {
    
    global $current_user_new;
   
    return ($current_user_new->data->dislike_count) > 0 ? $current_user_new->data->dislike_count : 0;
}

function get_user_company_logo($user_id) {

    global $current_user_new;
    $user_meta = get_user_meta($user_id);
    //print_r($user_meta);exit();
    $post_attachment_id = isset($user_meta['avatar_attachment']) ? trim($user_meta['avatar_attachment'][0]) : false;

    if ($post_attachment_id)
        return wp_get_attachment_image($post_attachment_id, get_user_role());
    else
        return get_avatar($user_id);
}
function is_user_verified()
{
    global $current_user_new;
    return $current_user_new->data->verified;
    
}

/**
 * CLass to get all user's jobs
 */
class MN_User_Jobs {

    var $query_vars = array();
    var $jobs;
    var $job;
    var $job_count = 0;
    var $current_job = -1;
    var $in_the_loop = false;
    public $include_meta = array('job_date',
        'job_task',
        'job_start_date',
        'job_end_date',
        'job_start_time',
        'job_end_time',
        'job_required_minyawns',
        'job_wages',
        'job_location');
    public $include_user_meta = array('college', 'major', 'linkedin','facebook_link', 'user_skills');

    function __construct($args = null) {
        if (!empty($args)) {

            if (!isset($args['user_id']))
                return;

            $this->query_vars = wp_parse_args($args, array(
                'user_id' => false,
                'status' => false
            ));

            $this->query();
        }
    }

    function query() {
        global $wpdb;

        $qv = & $this->query_vars;

        $and = '';

        if (false !== $qv['status'])
            $and = $wpdb->prepare("AND ub.status=%s", $qv['status']);

        $sql = $wpdb->prepare("SELECT {$wpdb->prefix}users.*, GROUP_CONCAT(CONCAT({$wpdb->prefix}usermeta.meta_key,'|',{$wpdb->prefix}usermeta.meta_value)) AS usermeta,{$wpdb->prefix}userjobs.*
                              FROM {$wpdb->prefix}users
                              JOIN {$wpdb->prefix}usermeta ON user_id = {$wpdb->prefix}users.ID
                              JOIN {$wpdb->prefix}userjobs ON {$wpdb->prefix}userjobs.user_id = {$wpdb->prefix}users.ID
                              WHERE {$wpdb->prefix}userjobs.user_id = %d
                              GROUP BY {$wpdb->prefix}userjobs.user_id", $qv['user_id']);


        $minyawns = $wpdb->get_results($sql);

        $this->job_count = count($this->jobs);

        if (!empty($minyawns)) {
            foreach ($minyawns as $minyawn) {


                //if($minyawn->status == 'hired') $job_status='hired'
                
                
                $user = array(
                    'user_login' => $minyawn->user_login,
                    'profile_name' => $minyawn->first_name . $minyawn->last_name,
                    'user_email' => $minyawn->user_email,
                    'user_id' => $minyawn->ID,
                    'user_to_job' => $minyawn->job_id,
                    'user_job_status' => $minyawn->status
                );
                $rating = ($minyawn->rating) > 0 ? 'Well Done' : 'Rating:Awaited';
                if ($rating == 'Rating:Awaited')
                    $rating = ($minyawn->rating) < 0 ? 'Terrible' : 'Rating:Awaited';

                $user['user_job_rating'] = $rating;

                //convert the meta string to php array
                $usermeta = explode(',', $minyawn->usermeta);

                $fb_uid = false;
                foreach ($usermeta as $meta) {

                    $meta = explode('|', $meta);

                    if (in_array($meta[0], $this->include_user_meta))
                        $user[$meta[0]] = maybe_unserialize($meta[1]);

                    if ($meta[0] == 'avatar_attachment')
                        $user['image'] = wp_get_attachment_thumb_url($meta[1]);

                    if ($meta[0] == 'facebook_uid')
                        $fb_uid = $meta[1];
                }

                //set image
                if (!isset($user['image']) && $fb_uid !== false)
                    $user['image'] = 'https://graph.facebook.com/' . $fb_uid . '/picture?width=200&height=200';
                elseif (!isset($user['image']))
                    $user['image'] = false;

                if (!isset($user['rate_like']))
                    $user['rate_like'] = 0;
                if (!isset($user['rate_dislike']))
                    $user['rate_dislike'] = 0;

                $this->minyawns[$minyawn->ID] = $user;
            }
        }
    }

    function have_jobs() {
        if ($this->current_job + 1 < $this->job_count) {
            return true;
        } elseif ($this->current_job + 1 == $this->job_count && $this->job_count > 0) {
            //do_action_ref_array('loop_end', array(&$this));
            // Do some cleaning up after the loop
            $this->rewind_jobs();
        }

        $this->in_the_loop = false;
        return false;
    }

    function rewind_jobs() {
        $this->current_job = -1;
        if ($this->job_count > 0) {
            $this->job = $this->jobs[0];
        }
    }

    function the_job() {
        global $mn_job;
        $this->in_the_loop = true;

        if ($this->current_job == -1) // loop has just started
            do_action_ref_array('loop_start', array(&$this));

        $mn_job = $this->next_job();
    }

    function next_job() {

        $this->current_job++;

        $this->job = $this->jobs[$this->current_job];
        return $this->job;
    }

}

/* Funtion to send mail to employer when minyawn applies for a job
 * Date : 3sep2013
 */

function send_mail_employer_apply_job($job_id, $action) {
    global $user_ID, $wpdb;
    global $current_user;
    get_currentuserinfo();
    $job_data = get_post($job_id);
    $employer_id = $job_data->post_author;
    $employer_data = get_userdata($employer_id);

    //Send mail to Emplyer
    $mail_subject = "Minyawns - " . $current_user->display_name . " has " . $action . " for " . get_the_title($job_id);

    $mail_message = "Hi,<br/><br/>Looks like " .
            $current_user->display_name . " has " . $action . " for the job '" . get_the_title($job_id) . "'
                The next step is to confirm, pay and hire. Please log back on to minyawns  <a href='".  get_permalink($job_id)."' target='_blank'>'".get_the_title($job_id)."'</a>  and finish the process.<br/><br/>
                    Don't fret, we wont charge you until the job is done. We also offer 100% satisfaction guarantee or your money back!
                		<br/><br/><h3>Minyawn Details</h3>
                		<br/><b>Username : " . $current_user->user_login . "</b>
                		<br/><b>First name : " . $current_user->user_firstname . "</b>
                		<br/><b>Last Name : " . $current_user->user_lastname . "</b>
                		<br/><b>Email : " . $current_user->user_email . "</b>
	
                		<br/><br/><h3>Job Details</h3>
                		<br/><br/><b>Job : " . get_the_title($_POST['job_id']) . "</h6>
                		<br/><b>Start date : </b>" . date('d M Y', get_post_meta($_POST['job_id'], 'job_start_date', true)) . "
                		<br/><b>Start Time : </b>" . date('g:i a', get_post_meta($_POST['job_id'], 'job_start_time', true)) . "
                		<br/><b>End Date : </b>" . date('d M Y', get_post_meta($_POST['job_id'], 'job_end_date', true)) . "
					    <br/><b>end Time : </b>" . date('g:i a', get_post_meta($_POST['job_id'], 'job_end_time', true)) . "
                		<br/><b>Location : </b>" . get_post_meta($_POST['job_id'], 'job_location', true) . "
						<br/><b>Wages : </b>$" . get_post_meta($_POST['job_id'], 'job_wages', true) . "
                		<br/><b>details : </b>" . $job_data->post_content . "
	
                		<br/><br/>
	
                		";

    add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
    $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
    wp_mail($employer_data->user_email, $mail_subject, email_header() . $mail_message . email_signature(), $headers);
}

function replaceAll($text) { 
    $text = strtolower(htmlentities($text)); 
    $text = str_replace(get_html_translation_table(), "-", $text);
    $text = str_replace(" ", "-", $text);
    $text = preg_replace("/[-]+/i", "-", $text);
    return $text;
}


function minyawn_job_apply() {

    if ('POST' !== $_SERVER['REQUEST_METHOD'])
        return;



    global $user_ID, $wpdb;



    //get job ID
    $job_id = $_POST['job_id'];

    if ($_POST['action'] == 'minyawn_job_unapply') {
        $wpdb->query(
                $wpdb->prepare(
                        "
                DELETE FROM $wpdb->prefix.'userjobs'
		 WHERE user_id = %d
		 AND job_id = %s
		", $user_ID, $job_id
                )
        );

        $new_action = "apply";
        $status = 1;
    } else {
        $min_job = new Minyawn_Job($job_id);

        if ((int) ($min_job->required_minyawns) + 2 <= count($min_job->minyawns)) {
            $status = 2;
        } else {

            $wpdb->insert($wpdb->prefix . 'userjobs', array(
                'user_id' => $user_ID,
                'job_id' => $job_id,
                'status' => 'applied',
                'rating' => 0
                    ), array('%d', '%d', '%s', '%d'));
            $new_action = "unapply";
            $status = 1;

            $check_limit = new Minyawn_Job($job_id);

            //print_r(($min_job->required_minyawns)+2);print_r(count($min_job->minyawns));exit();
            /* plus one because it is checking before insert */
            if ((int) ($min_job->required_minyawns) + 2 <= count($min_job->minyawns) + 1)
                $status = 2;
        }
    }

    // send mail to employer who created job
    send_mail_employer_apply_job($job_id, 'applied');

    echo json_encode(array('success' => $status, 'new_action' => $new_action));

    die;
}

add_action('wp_ajax_minyawn_job_apply', 'minyawn_job_apply');

function minyawn_job_unapply() {
    if ('POST' !== $_SERVER['REQUEST_METHOD'])
        return;

    global $user_ID, $wpdb;

    //get job ID
    $job_id = $_POST['job_id'];

    $wpdb->delete($wpdb->prefix . 'userjobs', array(
        'user_id' => $user_ID,
        'job_id' => $job_id
    ));
    // send mail to employer who created job
   // send_mail_employer_apply_job($job_id, 'unapplied');

    echo json_encode(array('success' => 1, 'new_action' => 'apply'));

    die;
}

add_action('wp_ajax_minyawn_job_unapply', 'minyawn_job_unapply');

function wp_set_current_user_profile($id, $name = '') {
    //global $current_user_new;
    //if ( isset( $current_user_new ) && ( $current_user_new instanceof WP_User ) && ( $id == $current_user_new->ID ) )
    //	return $current_user_new;


    $current_user_new = get_userdata($id);

    //print_r($current_user_new);exit();
    //setup_userdata( $current_user_new->ID );
    //do_action('set_current_user');

    return $current_user_new;
}

function check_direct_access() {

    return end((explode('/', rtrim($_SERVER['REQUEST_URI'], '/'))));
}

function get_user_rating_data($user_id, $job_id) {
    global $wpdb;
    $sql = $wpdb->prepare("SELECT {$wpdb->prefix}userjobs.user_id,{$wpdb->prefix}userjobs.job_id, SUM( if( rating =1, 1, 0 ) ) AS positive, SUM( if( rating = -1, 1, 0 ) ) AS negative
                              FROM {$wpdb->prefix}userjobs
                              WHERE {$wpdb->prefix}userjobs.user_id = %d AND {$wpdb->prefix}userjobs.job_id
                              GROUP BY {$wpdb->prefix}userjobs.user_id", $user_id, $job_id);

    $minyawns_rating = $wpdb->get_results($sql);

    return $minyawns_rating;
}

function get_user_job_rating_data($user_id, $job_id) {
    global $wpdb;
    $sql = $wpdb->prepare("SELECT {$wpdb->prefix}userjobs.user_id,{$wpdb->prefix}userjobs.job_id,{$wpdb->prefix}userjobs.status, SUM( if( rating =1, 1, 0 ) ) AS positive, SUM( if( rating = -1, 1, 0 ) ) AS negative
                              FROM {$wpdb->prefix}userjobs
                              WHERE {$wpdb->prefix}userjobs.user_id = %d AND {$wpdb->prefix}userjobs.job_id = %d
                              GROUP BY {$wpdb->prefix}userjobs.user_id", $user_id, $job_id);

    $minyawns_rating = $wpdb->get_row($sql);

    return $minyawns_rating;
}





/*
 *  function to get user role
 *  return after spell check
 *  @params nil
 *  @return minyawn,employer
 */

function get_user_role_text()
{
    if (get_user_role() == "minyawn"){ return 'Minion';} else  return 'Employer' ; 
    
}

function get_logged_in_role()
{
    global $current_user;
   $user_role=$current_user->roles[0];
   
   
   switch($user_role){
   
   	case "minyawn"  	: return 'Minion';
   	case 'employer' 	: return 'Employer';
   	case 'administrator': return 'Administrator';	
   	default 			: return ucwords($user_role);
   }
   //if ($user_role == "minyawn"){ return 'Minion';} else  if('')return 'Employer' ; 
    
}

function get_logged_in_email()
{
    global $current_user;
    return $current_user->user_email;
    
}


function is_facebook_user()
{
    global $current_user;
   
   return strlen($current_user->facebook_avatar_full) > 0 ? 'true' :'false';
   
    
}


function get_user_avatar()
{
    global $current_user;
    $user_header_meta=get_user_meta($current_user->ID);
 
  if (isset($user_header_meta['avatar_attachment'])) {
        return wp_get_attachment_image($user_header_meta['avatar_attachment'][0]);
    } else {
        return get_avatar($current_user->ID);
    }
    
    
}

/*
 *  Pass get_users() user data will return basic info
 *  
 * 
 * 
 */
function get_minyawn_profile($userData,$total)
{
    
         $user_meta = get_user_meta($userData->ID);

                    $minyawns_rating = get_user_rating_data($userData->ID, '');
                    foreach ($minyawns_rating as $rating) {
                        $user_rating = $rating->positive;
                        $user_dislike = $rating->negative;
                    }

                    $user_profile_pic = isset($user_meta['avatar_attachment']) ? trim($user_meta['avatar_attachment'][0]) : false;

                    if(isset($user_meta['intro_video_id'][0])){
                        $user_pic_img_src =  '<img src="http://i.ytimg.com/vi/'.$user_meta['intro_video_id'][0].'/1.jpg" />';
                    }else{

                       if ($user_profile_pic !== false) {
                        $user_pic_img_src =  wp_get_attachment_image($user_profile_pic, get_user_role());
                    } else {
                        $user_pic_img_src = get_avatar($userData->ID);
                    }
                     
                    }
                    

                    
             
                    $data = array(
                        'user_id' => $userData->ID,
                        'user_email' => isset($userData->user_email) ? $userData->user_email : '',
                        'user_url' => isset($userData->user_url) ? $userData->user_url : '',
                        'description' => isset($user_meta['description'][0]) ? $user_meta['description'][0] : '',
                        'skills' => isset($user_meta['user_skills'][0]) ? $user_meta['user_skills'][0] : '',
                        'major' => isset($user_meta['major'][0]) ? substr($user_meta['major'][0],0,20) : '',
                        'college' => isset($user_meta['college'][0]) ? substr($user_meta['college'][0],0,20) : '',
                        'linkedin' => isset($user_meta['linkedin'][0]) ? $user_meta['linkedin'][0] : '',
                        'facebook_link' => isset($user_meta['facebook_link'][0]) ? $user_meta['facebook_link'][0] : '',
                        'rating_positive' => isset($user_rating) ? $user_rating : 0,
                        'rating_negative' => isset($user_dislike) ? $user_dislike : 0,
                        'user_avatar' => $user_pic_img_src,
                        'total' => $total,
                        'minion_name' => isset($user_meta['first_name'][0]) > 0 ? substr($user_meta['first_name'][0] ." ". $user_meta['last_name'][0],0,20) :'',
                        'user_verified'=>isset($user_meta['user_verified'][0]) ? $user_meta['user_verified'][0] :'N',
                        'intro_video_id'=>isset($user_meta['intro_video_id'][0]) ? $user_meta['intro_video_id'][0] :''     
                    );
  
                    
   
   
  
   
   return $data;
}

function minyawns_applied_to_jobs($jobID,$employer_id)
{
    global $wpdb;
       $sql = $wpdb->prepare("SELECT {$wpdb->prefix}userjobs.user_id,{$wpdb->prefix}userjobs.status  FROM {$wpdb->prefix}userjobs,{$wpdb->prefix}posts,{$wpdb->prefix}postmeta
                              WHERE {$wpdb->prefix}userjobs.user_id = %d AND {$wpdb->prefix}userjobs.job_id
                              GROUP BY {$wpdb->prefix}userjobs.user_id", $_POST['user_id'], $_POST['job_id']);

            $minyawns_rating = $wpdb->get_row($sql);
    
    
    
}

function minyawns_hired_to_jobs($userID,$jobID)
{
    global $wpdb;
       $sql = $wpdb->prepare("SELECT {$wpdb->prefix}userjobs.user_id,{$wpdb->prefix}userjobs.status  FROM {$wpdb->prefix}userjobs,{$wpdb->prefix}posts,{$wpdb->prefix}postmeta
                              WHERE {$wpdb->prefix}userjobs.user_id =$userID AND {$wpdb->prefix}userjobs.job_id=$jobID AND {$wpdb->prefix}userjobs.status='hired'
                              GROUP BY {$wpdb->prefix}userjobs.user_id", $_POST['user_id'], $_POST['job_id']);

            $row= $wpdb->get_row($sql);
    
            if($row > 0)
              $is_hired=true;
            else
              $is_hired=false;
            
    return $is_hired;
    
}

