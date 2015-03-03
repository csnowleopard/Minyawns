<?php
/**
 * Template Name: new-user-verification
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ajency
 * @subpackage Better_Rentals
 */
global $post;
global $wpdb ;


get_header(); ?>
 
<?php




global $wpdb;
if(isset($_REQUEST['action']))
	$pd_action = $_REQUEST['action'];
else
	invalid_newuserverification_key();

if(isset($_REQUEST['key']))
	$pd_key = $_REQUEST['key'];

if(isset($_REQUEST['email']))
	$pd_email = $_REQUEST['email'];

if($pd_action=="ver")
{
	//echo"teset";
	$user_table = $wpdb->base_prefix.'users';
	$res_verify_user =    $wpdb->get_results($wpdb->prepare("SELECT count(*) as user_count FROM $user_table WHERE user_email = %s AND user_status=%f and user_activation_key = '%s'", $pd_email, 2,$pd_key),OBJECT);
	if($res_verify_user)
	{
		//echo"test2";
		foreach($res_verify_user as $res_verify_usr)
		{	
			//echo "test3";
			if($res_verify_usr->user_count>0)
			{
				//echo "test4";
				//activate the user
				$wpdb->update($wpdb->users, array('user_activation_key' => ""), array('user_email' =>$pd_email));
				$wpdb->update($wpdb->users, array('user_status' => 0), array('user_email' => $pd_email));
				
				/* commented on 19june2014 echo "
				<div class='container'>
					<div class='main-content '>
					<div class='alert alert-info ' style='width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%'>
							<h4 style='text-align:center'>Your account is successfully verified.</h4>
							<hr>
							<img src='".get_template_directory_uri()."/images/big-minyawns.png'/ style='margin:auto;display:block;'><br>
							<b style='text-align:center;' >your email is successfully verified please <a href='#mylogin' data-toggle='modal' id='btn__login'>login</a> here </b>
							</div>
					</div>
				</div>
				
				";*/


                echo "
				<div class='container'>
					<div class='main-content '>
					<div class='alert alert-info ' style='width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%'>
							<h4 style='text-align:center'>Your account is successfully verified.</h4>
							<hr>
							<img src='".get_template_directory_uri()."/images/big-minyawns.png'/ style='margin:auto;display:block;'><br>
							<b style='text-align:center;' >your email is successfully verified please <a href='".site_url()."/wp-login.php' data-toggle='modal' id='btn__login'>login</a> here </b>
							</div>
					</div>
				</div>

				";
				
				
				$subject = "Your registration is approved on Minyawns";
				$message="Hi, <br/><br/>Your registration is approved on Minyawns.<br/><br/> You can visit <a href='".site_url()."' >Minyawns</a> to log in";
				add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
				$headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
				wp_mail($pd_email, $subject,email_header().$message.email_signature(),$headers);
				
			}
			else
			{
				invalid_newuserverification_key();
			}
		}
	}
}

?>
			
  <?php /*  <!-- Load JS here for greater good =============================-->
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-select.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-switch.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/flatui-checkbox.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/flatui-radio.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.tagsinput.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.placeholder.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.stacktable.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/application.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.pep.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.dragsort-0.5.1.js"></script>
	
	*/ ?>
		
	
 
			


<?php
get_footer();
?>