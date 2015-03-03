<?php

class PhotoModel{

public $user_id;
public $logged_in = false;
public $can_upload = false;
public $can_delete = false;
public $upload_nonce = false;
public $delete_nonce = false;
public $admin = false;

public $is_employer = false;
public $is_minyawn = false;



function init(){
    $this->user_id = get_current_user_id();

    if(is_super_admin()){
    	$this->admin = true;
    }

    if(is_user_logged_in()){
    	$this->logged_in = true;
    } 
 

    if (current_user_can('apply_for_jobs') ) {
    	$this->is_minyawn = true;
    }

    if (current_user_can('manage_jobs') ) {
    	$this->is_employer = true;
    }

    if (current_user_can('add_photos') ) {
 
    	$this->can_upload = true;
    }
    if (current_user_can('delete_photos') ) {
    	$this->can_delete = true;
    }
    if(isset( $_POST['upload_nonce'] ) && wp_verify_nonce( $_POST['upload_nonce'], "upload_photo_".$this->user_id )) {
    	$this->upload_nonce = true;
    }



    //get raw data and and retrieve the nonce
    $data = file_get_contents('php://input');
    $tempvalues = explode('&',$data);
    $values = array();
    foreach($tempvalues as $value)
    {
    	$value = explode('=',$value);
    	$values[$value[0]] = $value[1];
    }
   

    if(!empty( $values["delete_nonce"] ) && wp_verify_nonce( $values["delete_nonce"], "delete_photo_".$this->user_id )) {
    	$this->delete_nonce = true;
    }

  }




public function __construct() {
        //$this->user = get_current_user_id();
       }



public function upload_photos($jobid){

$file = $_FILES['photo']['tmp_name'];
$filename = $_FILES['photo']['name'];
//$parent_post_id = $_POST['jobid'];
$parent_post_id = $jobid;
$user_id = $this->user_id;

if(!$this->user_can_upload($parent_post_id)){
	return array(
		'status'	=> false,
		'error'		=> 'User not authorised to perform this task.',
		);
	exit;
}

 
$upload_file = wp_upload_bits($filename, null, file_get_contents($file));

if (!$upload_file['error']) {
	$wp_upload_dir = wp_upload_dir();
	$wp_filetype = wp_check_filetype($filename, null );
	$attachment = array(
		'guid'           => $wp_upload_dir['url'] . '/' . $filename,
		'post_mime_type' => $wp_filetype['type'],
		'post_parent' => $parent_post_id,
		'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
		'post_content' => '',
		'post_author' => $user_id,
		'post_status' => 'inherit'
	);
	$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );
	if (!is_wp_error($attachment_id)) {
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
		wp_update_attachment_metadata( $attachment_id,  $attachment_data );
	}else{
		$response = array(
		'status'	=> false,
		'error'		=> is_wp_error($attachment_id)
		);
	}
	$image_url =   wp_get_attachment_image_src($attachment_id, 'large' );
	//get the author of the job

	$job = get_post($parent_post_id); 
	$job_author = $job->post_author;

	$response = array(
		'status'	=> true,
		'photo'		=> array(
			'id'	=> $attachment_id,
			'url'	=> $image_url[0],
			'author' => $user_id,
			'date' => get_the_date('Y-m-d H:i:s.u',$attachment_id),
			'job_id' => $parent_post_id,
			'job_author'=>$job_author
			)
		);

	//send mail if the photo was uploaded for a job
	if($parent_post_id !=0){

		$this->send_photo_upload_mail($user_id,$parent_post_id);
	}
 	

}else{
	
	$response = array(
		'status'	=> false,
		'error'		=> $upload_file['error']
		);
}

return $response;
}











public function delete_photos($photoid){ 


if (!$this->user_can_delete($photoid)){
return false;
exit;
}

if(wp_delete_post($photoid)){
	return true;
}else{
	return false; 
}

}



public function get_photos($jobid='',$userid=''){
 
$args = array();
if($jobid !=''){
	$args["post_parent"] = $jobid;
}
if($userid !=''){
	$args["author"] = $userid;
	
}
$args['post_type'] = 'attachment';
$args['posts_per_page'] =  -1;
 
$results= get_posts( $args );

 
foreach($results as $result){

	//get the author of the job

	$job = get_post($result->post_parent); 

	$job_author = $job->post_author;

	$image_url =   wp_get_attachment_image_src($result->ID, 'large' );
 
   	$image_url = ( $image_url!=false)? $image_url[0]:'' ;
	 $data[] = array(
					'id' => $result->ID,
					'url' =>  $image_url,
					'author' => $result->post_author,
					'date' => $result->post_date,
					'job_id' => $result->post_parent,
					'job_author' => $job_author 

					);
}
	 
	return $data;
 
}





public function user_can_upload($jobid) {
 

if($this->admin){
	return true;
	exit;

//Check if is user logged in	
}else if (!$this->logged_in){
  return false;

 //Check for nonce
}else if(!$this->upload_nonce) {
return false;

//Check for user capabilities
}else if (!$this->can_upload) {
 return false;

//Check if job id was set
}else if($jobid>0){


if($this->is_minyawn){
//Check if minyawn was hired for the job
if(!$this->is_minyawn_hired_for_job($jobid)){echo "6";
return false;
}else{
return true;
}
}

if($this->is_employer){
//Check if employer added the job
if(!$this->is_employer_added_job($jobid)){
return false;
}else{
return true;
}
}



}else{

 return true;
}

}






public function user_can_delete($photoid) {
if($this->admin){
	return true;
	exit;

//Check if is user logged in	
}else if (!$this->logged_in){
  return false;

 //Check for nonce
}else if(!$this->delete_nonce) {
return false;

//Check for user capabilities
}else if (!$this->can_delete) {
 return false;

//Check if photo belongs to the user
}else if(!$this->is_user_has_photo($photoid)){
return false;
}else{
return true;
}
}




public function is_user_has_photo($photoid){

	$args["author"] = $this->user_id;
 
	$args['post_type'] = 'attachment'; 
 
	$results= get_posts( $args ); 

	if(!$results){
		return false;
	}else{
	 	return true;
	}
}




public function is_minyawn_hired_for_job($jobid){

global $wpdb;
$userid = $this->user_id;
$results = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."userjobs WHERE user_id = ".$userid." AND job_id = ".$jobid." AND status = 'hired'", ARRAY_A );
if(!$results){
return false;
}else{
 return true;
}

}




public function is_employer_added_job($jobid){

$userid = $this->user_id;
$args = array();
$args["ID"] = $jobid;
$args["author"] = $userid;
$args['post_type'] = 'job';
$results= get_posts( $args );

if(!$results){
return false;
}else{
 return true;
}

}
 
public function send_photo_upload_mail($user_id,$job_id){
 
    $user_data = get_user_by('id', $user_id);

   	$last_uploaded = get_user_meta($user_id,'job_photo_upload',true);

    $last_uploaded_date = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
    
    $found_job = false;

 	foreach($last_uploaded as $last_uploaded_item){

 		

 		if($last_uploaded_item["job_id"]==$job_id){

 			$found_job = true;

 			$last_uploaded_date = $last_uploaded_item["uploaded_date"];

 			$last_uploaded_item["uploaded_date"] = date('Y-m-d');

 		}
 		
 	}

 	if($found_job == false){
 			
 			$last_uploaded[] = array("job_id"=>$job_id,"uploaded_date"=> date('Y-m-d'));

 		}

   	update_user_meta($user_id,'job_photo_upload',$last_uploaded);

   	$datetime1 = new DateTime($last_uploaded_date);

	$datetime2 = new DateTime(date('Y-m-d'));

	$interval = $datetime1->diff($datetime2);

	$days = $interval->format('%a');
  
    $job_data = get_post( $job_id); 

    $job_author_data = get_user_by('id', $job_data->post_author);
 
    $subject = $user_data->first_name." ".$user_data->last_name." has added Job images to ".$job_data->post_title;

    add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
    
    $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
 
    $message = "Hi, <br/><br/>".$user_data->first_name." ".$user_data->last_name." has uploaded Images to Job ".$job_data->post_title.".<br/><br/><a href='".get_post_permalink($job_id)."'>Click here</a> to view the images.<br/><br/>";
 
   	//mail to the employer
 	///wp_mail( $job_author_data->user_email, $subject, email_header() . $message . email_signature(), $headers);

   	//mail to administrator
   	$adminsitrators = get_users( 'role=administrator' );

	 
	foreach ( $adminsitrators as $adminsitrator ) { 

  		add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
   
		//wp_mail( $adminsitrator->user_email, $subject, email_header() . $message . email_signature(), $headers);

	}
     
 
} 




}

