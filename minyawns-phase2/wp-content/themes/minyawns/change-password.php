<?php
/**
 * Template Name: change-password
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
	 </body>
</html>	
			
	*/ 
$alert_msg =0;
$user = check_password_reset_key_($_GET['key'], $_GET['login']);

if ( is_wp_error($user) ) {
	//wp_redirect( site_url('change-password/?action=lostpassword&error=invalidkey') );
	echo "
				<div class='container'>
					<div class='main-content '>
					<div class='alert alert-info ' style='width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%'>
							<h4 style='text-align:center'>Sorry, that key does not appear to be valid.</h4>
							<hr>
							<img src='".get_template_directory_uri()."/images/big-minyawns.png'/ style='margin:auto;display:block;'>
							</div>
					</div>
				</div>
	
				";
	$alert_msg = 1;
 
}

$errors = new WP_Error();

if ( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] )
	$errors->add( 'password_reset_mismatch', __( 'The passwords do not match.' ) );

do_action( 'validate_password_reset', $errors, $user );

if ( ( ! $errors->get_error_code() ) && isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {
	reset_password_($user, $_POST['pass1']);
	echo "
				<div class='container'>
					<div class='main-content '>
					<div class='alert alert-info ' style='width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%'>
							<h4 style='text-align:center'>Password changed successfully.</h4>
							<hr>
							<img src='".get_template_directory_uri()."/images/big-minyawns.png'/ style='margin:auto;display:block;'>
							</div>
					</div>
				</div>
	
				";
	$alert_msg = 1; 
	//login_header( __( 'Password Reset' ), '<p class="message reset-pass">' . __( 'Your password has been reset.' ) . ' <a href="' . esc_url( wp_login_url() ) . '">' . __( 'Log in' ) . '</a></p>' );
	//login_footer();
	//exit;
}

wp_enqueue_script('utils');
wp_enqueue_script('user-profile');

//login_header(__('Reset Password'), '<p class="message reset-pass">' . __('Enter your new password below.') . '</p>', $errors );



if($alert_msg!=1)
{
?>
		
	
 
<div class="container">
	<div class="main-content ">
		<div class="alert alert-info trg-box" >
		<h3> <a href="#" class="min-cirle"><i class="icon-unlock-alt"></i></a> Change Password<h3>
		<hr>
		<form class="form-horizontal frm-edit" name="resetpassform" id="resetpassform" action="<?php echo esc_url( site_url( 'change-password?action=resetpass&key=' . urlencode( $_GET['key'] ) . '&login=' . urlencode( $_GET['login'] ), 'login_post' ) ); ?>" method="post" autocomplete="off">
   
		    <div class="control-group">
		    <label class="control-label" for="inputpassword">New Password</label>
		    <div class="controls">
		      <input type="password" id="pass1" name="pass1" placeholder="" class="input">
		    </div>
		  </div>
		   <div class="control-group">
		    <label class="control-label" for="inputconfirm">Confirm Password</label>
		    <div class="controls">
		      <input type="password" id="pass2" name="pass2" placeholder="" class="input">
		    </div>
		  </div>
   
  
		  <hr><input type="submit" name="wp-submit" id="wp-submit" class="btn btn-large btn-block btn-inverse span2"  style="width:200px" value="<?php esc_attr_e('Reset Password'); ?>" />
		  <?php /*  <a href="#fakelink" class="btn btn-large btn-block btn-inverse span2">Update Info</a>*/ ?>
			<div class="clear"></div>
		</form>
	</div>

  </div>
  
</div>
<?php
} 
?>
<?php get_footer(); ?>