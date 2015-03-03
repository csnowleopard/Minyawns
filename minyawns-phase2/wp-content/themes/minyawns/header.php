	<!doctype html>

	<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
	<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
	<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
	<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
	<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
	<html <?php language_attributes(); ?> class="no-js">
	<!--<![endif]-->

		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Your Empire, Our Minyawns to help. A web app to hire Local Seattle college students for short term help on your projects. For any businesses professional, small or big.">
		<meta name="keywords" content="one day interns, reliable help
	,temp workers
	,one day jobs
	,where to post a gig
	,where to find interns
	,how to get interns
	,hire an intern
	,where to hire college students in seattle
	,hiring college seasonal work
	,hire short term college students
	,Part time university reasources">
		
		<title><?php wp_title('|', true, 'right'); ?></title>
		
			<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
			 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:800' rel='stylesheet' type='text/css'>
	   
		<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->
		
		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
	
		<!-- wordpress head functions -->
		<?php wp_head(); 
			//require 'essential-scripts.php';
			?>
		  
		<!--Start of Zopim Live Chat Script-->
		<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){
		z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
		$.src='//v2.zopim.com/?1XmR5kCIDQtO4j3qMe0N8Uk2q4R5kd2Y';z.t=+new Date;$.
		type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
		</script>
		<!--End of Zopim Live Chat Script-->
		
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43096826-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- AddThisEvent -->
<script type="text/javascript" src="https://addthisevent.com/libs/1.5.8/ate.min.js"></script>
<!-- AddThisEvent Settings -->
<script type="text/javascript">
addthisevent.settings({
	mouse		: false,
	css			: false,
	outlook		: {show:true, text:"Outlook Calendar"},
	google		: {show:true, text:"Google Calendar"},
	yahoo		: {show:true, text:"Yahoo Calendar"},
	ical		: {show:true, text:"iCal Calendar"},
	hotmail		: {show:true, text:"Hotmail Calendar"},
	facebook	: {show:false, text:"Facebook Calendar"}
});
</script>

		</head>
			<script>
				var siteurl='<?php echo site_url(); ?>';
				var logouturl='<?php echo wp_logout_url('');?>';
				var email='<?php  echo get_user_profile_email() ?>';
				var role='<?php if (get_user_role() == "minyawn"){ echo 'Minyawn';} else echo 'Employer' ; ?>';
				var logged_in_role='<?php echo get_logged_in_role() ?>';
				var logged_in_user_id='<?php echo get_user_id(); ?>'
				var is_logged_in='<?php echo is_user_logged_in();?>';

				<?php $user = new WP_User( get_user_id() );
						if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
							foreach ( $user->roles as $role )
								$currentpage_user_role =  $role;
						} 
				?>
				 var currentpage_user_role = '<?php echo $currentpage_user_role; ?>'
				var is_admin='<?php echo current_user_can( 'administrator' ); ?>';
				var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
				</script>

	<body <?php body_class('logged-out'); ?> >

		<div class="mobile-menu-demo"> 
		<div id="header">
					<a href="#menuleft"></a>
					
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" width="150px" onclick="location.href='<?php echo site_url()?>';" style="cursor:pointer;"/> 
			
					<a href="#menuright" class="friends right"></a>
				</div>

				<nav id="menuleft">
					<ul>
					<li id="browse"><a id="browse" href="<?php echo site_url()?>/jobs/#browse">All Jobs </a></li>
	<!--                                <li id="my_jobs"><a id="my_jobs" href="<?php echo site_url()?>/jobs/#my-jobs" >My Jobs</a></li>-->
					<li id="directory"><a href="<?php echo site_url() ?>/minyawns-directory">Minyawns Directory</a></li>
					<li id="directory"><a href="<?php echo site_url() ?>/blog/">Blog</a></li>
									<li id="directory"><?php if (get_logged_in_role() === 'Minion'): ?>
					<a href="<?php echo site_url() ?>/edit-profile"> Update Your Profile</a>
					   <?php endif; ?>	
						<?php if (get_logged_in_role() === 'Employer'): ?>
					<a href="<?php echo site_url() ?>/add-job/">Create a job</a>
					   <?php endif; ?>
					 </li>
						
					</ul>
				</nav>
						<nav id="menuright">
						<?php	if (is_user_logged_in() == TRUE) {
								?>
										<ul>
										<li class="img Collapsed">
									<a href="#">
										 <?php 
										if(get_user_avatar() !== false)
											echo get_user_avatar() ;
										else
											echo get_avatar(get_user_id(), 168 ) ?>
										<?php echo get_logged_in_email(); ?><br />
										<small>Role :<?php echo get_logged_in_role(); ?></small>
									</a>
								</li>
										
					<li id="browse"><a class="" href="<?php echo site_url() ?>/profile"><i class="icon-user"></i> View Profile</a></li>
						<li id="browse">	<a class="" href="<?php  echo wp_logout_url(''); ?>"><i class="icon-unlock"></i> Logout</a></li>            
					<li id="browse">	<a href="<?php echo site_url(); ?>/helpfaqs/" title="Help and FAQ" target="_blank"><i class="icon-question-sign"></i> Help</a></li>
						
					</ul>
								<?php }else{ ?>
										<ul>
						<li>
							<a href="#myModal" data-toggle="modal"  id="link_minyawnregister" onclick="return true"><i class="icon-signin"></i> Signup Minyawn </a>
						
						</li>
						<li>
							<a  href="#myModal" data-toggle="modal" id="link_employerregister" onclick="return true"><i class="icon-signin"></i> Signup Business </a>
						
						</li>
					<li>
						<a <?php /*  commented on 19june2014  href="#mylogin"  <?php if(is_page('fb-connect-test')){ */ ?>   href="#mylogin"   <?php /*} else { ?>  href="<?php echo site_url()?>/wp-login.php"  <?php }  */ ?> data-toggle="modal" ><i class="icon-unlock-alt"></i> Login</a>
						
						</li>
	<li>
							<a href="<?php echo site_url(); ?>/helpfaqs/" title="Help and FAQ" target="_blank"><i class="icon-question-sign"></i> Help</a>
						
						</li>
			
					</ul>
						<?php } ?>
						
						
				
				</nav>
				</div>
		<div class=" pbl mtn top-menu">
		<?php

						if (is_user_logged_in() == TRUE) {
								?>
			<div class="bottom-menu  bottom-menu-inverse top-menu">
			
					<div class="row">
						<div  class="small-tag-line ">
							<p>Minyawns is an easy to use, on-demand, reliable way to find work or help fast.</p>
						</div>
				
						<?php

						if (is_user_logged_in() == TRUE) {
								?>
						<div class=" notify <?php if(get_user_role() == 'employer'){ echo 'employer-icon'; }?>  ">
						<div class="pull-right">
							<div id="logged-in">
							
							<div class="user-profile">
										<b><?php echo get_logged_in_email(); ?></b><br>
										Role :<?php echo get_logged_in_role(); ?>
										</div>
							 <div class="profile-pic">
							 <a id="user-popdown" > 
										 <?php 
										if(get_user_avatar() !== false)
											echo get_user_avatar() ;
										else
											echo get_avatar(get_user_id(), 168 ) ?>
										</a>
										</div>
										
										<!--                   
								<a id="user-popdown" href="javascript:void(0);"> <?php 
										if(get_mn_user_avatar() !== false)
											echo get_mn_user_avatar() ;
										else
											echo get_avatar( get_user_id(), 168 ) ?> <b class="caret"></b>
								
								 -->                           </a>
							</div>
							<div class="data-link">
								<a class="" href="<?php echo site_url() ?>/profile"><i class="icon-user"></i> View Profile</a>
							</div>
								<div class="data-link">
								<a class="" href="<?php  echo wp_logout_url(''); ?>"><i class="icon-unlock"></i> Logout</a>
							</div>
								<div class="data-link">
								<a href="<?php echo site_url(); ?>/helpfaqs/" title="Help and FAQ" target="_blank"><i class="icon-question-sign"></i> Help</a>
							</div>
							</div>
								<div class="clear"></div>
						</div>
					
					
					
						

						<?php } ?>
						</div>
			 
				</div> <!-- /bottom-menu-inverse -->
					<div class="top-menu-header">
			<a href="<?php echo site_url(); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt=""  class="minions-logo"/> 
			</a>
			&nbsp;<b style="color:#fff;">Follow us</b>&nbsp;&nbsp;<a href="https://www.facebook.com/minyawn" target="_blank"> <img src="<?php echo get_template_directory_uri(); ?>/images/social-fb.png" alt="" /></a>  &nbsp;<a href="https://twitter.com/Minyawns"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-twitter.png" alt="" /> </a>
			<!-- city -name-->
		 	&nbsp;&nbsp;<b class="text-primary">City : <abbr ><?php echo get_option('Minyawn_city');?></abbr></b>
			<!-- city -name-->
			<div class="main-menu">
			<ul class="inline">
					<li><b>Browse:</b></li>
					<li id="browse"><a id="browse" href="<?php echo site_url()?>/jobs/#browse">All Jobs </a></li>
									<li id="my_jobs"><a id="my_jobs" href="<?php echo site_url()?>/jobs/#my-jobs" >My Jobs</a></li>
					<li id="directory"><a href="<?php echo site_url() ?>/minyawns-directory">Minyawns Directory</a></li>
					<li id="directory"><a href="<?php echo site_url() ?>/blog/">Blog</a></li>
					<li class="green-btn-top"   >
					 <?php if (get_logged_in_role() === 'Minion'): ?>
					<i class="icon-edit"></i>&nbsp;<a href="<?php echo site_url() ?>/edit-profile"> Update Your Profile</a>
					   <?php endif; ?>	
						<?php if (get_logged_in_role() === 'Employer'): ?>
					<i class="icon-plus-sign" ></i><a href="<?php echo site_url() ?>/add-job/">&nbsp; Create a job</a>
					   <?php endif; ?>
					   </li>
					
			</ul>
			


			</div>

			<div class="clear"></div>
		</div>
				<?php } else { ?>
						<div class="bottom-menu  bottom-menu-inverse top-menu">
			
					<div class="row">
						<div  class="small-tag-line ">
							<p>Minyawns is an easy to use, on-demand, reliable way to find work or help fast.</p>
						</div>
				
						
						<div class=" notify <?php if(get_user_role() == 'employer'){ echo 'employer-icon'; }?>  ">
						<div class="pull-right">
							<div class="data-link">
								<a href="#myModal" data-toggle="modal"  id="link_minyawnregister" onclick="return true"><i class="icon-signin"></i> Signup as a Student </a> 
							</div>
							<div class="data-link">
								<a  href="#myModal" data-toggle="modal" id="link_employerregister" onclick="return true"><i class="icon-signin"></i> Signup as a Business </a> 
							</div>
								<div class="data-link">
								<a <?php /*  commented on 19june2014 href="#mylogin"  ?> <?php if(is_page('fb-connect-test')){ */ ?>  href="#mylogin"   <?php  /* } else { ?>  href="<?php echo site_url()?>/wp-login.php"  <?php } */  ?>  data-toggle="modal" id="btn__login"><i class="icon-unlock-alt"></i> Login </a>
							</div>
								<div class="data-link">
								<a href="<?php echo site_url(); ?>/helpfaqs/" title="Help and FAQ" target="_blank"><i class="icon-question-sign"></i> Help</a>
							</div>
							</div>
						
								<div class="clear"></div>
						</div>
				
					
					
						

					
						</div>
			 
				</div>
						<div class="top-menu-header">
			<a href="<?php echo site_url(); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt=""  class="minions-logo"/> 
			</a>
			&nbsp;<b style="color:#fff;">Follow us</b>&nbsp;&nbsp;<a href="https://www.facebook.com/minyawn" target="_blank"> <img src="<?php echo get_template_directory_uri(); ?>/images/social-fb.png" alt="" /></a>  &nbsp;<a href="https://twitter.com/Minyawns"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-twitter.png" alt="" /> </a>
<!-- city -name-->
	   &nbsp;<b class="text-primary">City :&nbsp; <?php /*<a data-toggle="modal" data-target="#chossecity"  class="showcity"> */ ?>
                                <?php $admin_city =  get_option('minyawn_city'); ?>

                                <select name="lst_sitecity" id="lst_sitecity" > 
	<option value="Seattle" <?php if($admin_city == "Seattle") echo " selected "; ?> >Seattle</option>
	<option value="Fresno" <?php if($admin_city == "Fresno") echo " selected "; ?> >Fresno</option>
                                </select>

                                <?php /*</a> */ ?> </b>
			<!-- city -name-->
			<div class="main-menu">
			<ul class="inline">
					<li><b>Browse:</b></li>
					<li id="browse"><a id="browse" href="<?php echo site_url()?>/jobs/#browse">All Jobs </a></li>
	<!--                                <li id="my_jobs"><a id="my_jobs" href="<?php echo site_url()?>/jobs/#my-jobs" >My Jobs</a></li>-->
					<li id="directory"><a href="<?php echo site_url() ?>/minyawns-directory">Minyawns Directory</a></li>
					<li id="directory"><a href="<?php echo site_url() ?>/blog/">Blog</a></li>
					<li class="green-btn-top"   >
					 
					   
					<i class="icon-plus-sign" ></i><a href="<?php echo site_url() ?>/add-job/">&nbsp; Create a job</a>
					  
					   </li>
					
			</ul>
			


			</div>

			<div class="clear"></div>
		</div>
				
					<?php } ?>


			</div>

			
			
			
			
			
			
			
			
			
			
	  <?php

						if (is_user_logged_in() == FALSE) {
								?>      
			
			
			<!-- LOgin/forgot pass pop up -->
						<input type="hidden" name="hdn_siteurl" id="hdn_siteurl" value="<?php echo site_url(); ?>" />

						<div id="mylogin" class="modal signup  hide fade" tabindex="-1"
							role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
							style="" >
							<div class="modal-header">
								<button id="close_btn" type="button" class="close" data-dismiss="modal"
									aria-hidden="true">
									<img
										src="<?php echo get_template_directory_uri(); ?>/images/delete.png"
										alt="" />
								</button>
								<h4 id="myModalLabel">
									Login to Minyawns
								</h4>
							</div>
							<div class="modal-body">
								<div id="div_loginmsg"></div>
								<div class="row-fluid">
									<div class="span5">


										<form name="frm_login" id="frm_login" action="" autocomplete="off" >
											<div class="control-group ">
								<input type="text" name="txt_email" id="txt_email" value="" placeholder="Email Address" class="span3"
								onblur="this.placeholder = 'Email Address'"  onfocus="this.placeholder = ''"
								autocomplete="off"
								>
											</div>
											<div class="control-group ">
					<input class="span3" type="password" name="txt_pass" id="txt_pass" value=""  onblur="this.placeholder = 'Password'"  onfocus="this.placeholder = ''" autocomplete="off"  placeholder="Password">
					
					
					
											</div>
											<div class="row-fluid">
												<div class="span4">
													
													<a type="button" href="#" class="btn btn-medium btn-block btn-inverse "
														id="btn_login"><i class="icon-unlock-alt"></i> &nbsp;Login</a>
												</div>
												<div class="span8">
													<a href="#"
														style="line-height: 42px; color: #12B13E; font-weight: bold;"
														id="btn_forgotpass">Forgot your password ?</a>
												</div>
											</div>
										</form>


									</div>
									<div class="span2">
									<b class="or">or</b>
									
									</div>
									<div class="span5 fb-login fb-deskstop">
										<h6 class="align-center" style="margin-bottom: 0px;">Login
											Using Facebook</h6>
										<p class="align-center">Get using Minyawns, faster !</p>
										<br>

										<?php /*<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/fbConnect_button.png" class="center-image"/></a>*/ ?>

										<?php

										//if(is_page('fb-connect-test')){
											jfb_output_facebook_btn();
											jfb_output_facebook_init();
											jfb_output_facebook_callback();
										/*}
										else{
											echo "<p class='align-center'><span style='color:#FA8258; font-weight:bold; font-size:18px; '>Coming soon</span></p>";
										}*/
										?>
									</div>
							
									<span id="div_msgforgotpass"></span>

									<div id="div_forgotpass" class="tab_content_login"
										style="display: none;">

										<p>Enter your username or email to reset your password.</p>
										<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form" id="frm_forgotpassword" name="frm_forgotpassword">
											<div class="username">
												<label for="user_login" class="hide"><?php _e('Username or Email'); ?>:
												</label> <input type="text" name="user_login" value=""
													size="20" id="user_login" tabindex="1001" />
											</div>
											<div class="login_fields">
												<?php //do_action('login_form', 'resetpass'); ?>
												<input type="button" id="user-submit" name="user-submit"
													value="<?php _e('Reset my password'); ?>"
													class="user-submit btn btn-large btn-block btn-inverse span2"
													tabindex="1002" />
												<?php $reset = $_GET['reset']; if($reset == true) { 
													echo '<p>A wmessage will be sent to your email address.</p>';
	} ?>
												<input type="hidden" name="redirect_to"
													value="<?php echo $_SERVER['REQUEST_URI']; ?>;?reset=true" />
												<input type="hidden" name="user-cookie" value="1" />
											</div>
										</form>
									</div>

										<div class="span6 fb-login fb-mobile">
										<h6 class="align-center" style="margin-bottom: 0px;">Login
											Using Facebook</h6>
										<p class="align-center">Get using Minyawns, faster !</p>
										<br>

										<?php echo jfb_output_facebook_btn(); ?>
									</div>

										<span id="signup_subheader">Don’t have an account? <a href="#myModal" <?php /*id="get-minon"*/ ?>  data-toggle="modal" id="link_employerregister" class="login-signup" >Sign up here</a></span>	
								</div>
							</div>

						</div>
						<!-- ENd  LOgin/forgot pass pop up -->
	 

						<?php } ?>

						</div>
					</div>
				</div> <!-- /bottom-menu-inverse -->

			</div>

	 <div id="myModal" class="modal signup hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background:url(<?php echo get_template_directory_uri();?>/images/pattern-bg.png)">
	   <div class="modal-header">
		  <button type="button" id="signup_popup_close" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo get_template_directory_uri(); ?>/images/delete.png"/></button>
		  <span id="div_signupheader"><h4 id="myModalLabel">Sign Up as a Minyawn</h4></span>
	   </div>
	   <div class="modal-body">
	  
		  <div id="div_signupmsg" ></div>
		  <div class="row-fluid">
			 <div class="span5">
				<form name="frm_signup"  id="frm_signup" action="" autocomplete="off">
				   <input type="hidden" name="signup_role" id="signup_role" value="" />
				   <h6 class="align-center" style=" margin-bottom: 0px; ">
					  Create an Account
				   </h6>
				   <p class="align-center">Fill out the required information Below</p>
				   <div class="control-group ">
					  <input type="text" value="" name="signup_email"  id="signup_email"  placeholder="Email Address" class="span3">
				   </div>
				   <div class="control-group ">
					  <input type="password" value="" name="signup_password"  id="signup_password" onblur="this.placeholder = 'Password'"  onfocus="this.placeholder = ''"
								autocomplete="off"  placeholder="Password" class="span3">
				   </div>
				 
				   <div class="control-group span6 " style=" margin-left: 0px; ">
					  <input type="text" value=""  name="signup_fname"   id="signup_fname"  placeholder="First Name" class="span3">
				   </div>
				   <div class="control-group span6 ">
					  <input type="text" value=""  name="signup_lname"   id="signup_lname"  placeholder="Last Name" class="span3">
				   </div>
					 <div class="control-group ">
					  <input type="text" value="" name="signup_company"  id="signup_company"  placeholder="Company Name" class="span3">
				   </div>
				   <div class="clear"></div>
				   <button href="#" class="btn btn-large btn-block btn-inverse" id="btn_signup"  type="button">Sign Up</button>
				</form>
			 </div>
			  <div class="span1">
				<b class="or">or</b>
			  </div>
			 <div class="span6">
				<h6 class="align-center" style=" margin-bottom: 0px; ">
				   Sign Up Using Facebook
				</h6>
				<p class="align-center">Get using Minyawns, faster !</p>
				<br><br><br>
				<?php
				//if(is_page('fb-connect-test')){
				   jfb_output_facebook_btn();
				/*}
				else{
					echo "<p class='align-center'><span style='color:#FA8258; font-weight:bold; font-size:18px; '>Coming soon</span></p>";
				}*/
				?>
				<br><br>
				<p class="align-center"><span id="div_alreadyregister">Already registered at Minyawns?</span><a href="#" id="lnk_signin"><b> Sign in here</b></a></p>
			 </div>
		  </div>
		   <span id="div_signup_subheader"></span>
	   </div>
	</div>

	
	<!--- chosse city-->
	 <div id="chossecity" data-backdrop="static"  data-keyboard="false"  class="modal signup hide fade bb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background:url(<?php echo get_template_directory_uri();?>/images/pattern-bg.png)">
	   <div class="modal-header">
		
		  <span id="div_signupheader"><h4 id="myModalLabel">Choose your City </h4></span>
	   </div>
	   <div class="modal-body ">
      <a href="javascript:void(0)" class="select__city" city ="seattle" > <div class="alert alert-block ">
	  <img src="<?php echo get_template_directory_uri();?>/images/seatle.png"/>
	  <b> SEATTLE</b>
	  </div></a>
           <a href="javascript:void(0)" class="select__city" city ="frensco" >
 <div class="alert alert-block ">
  <img src="<?php echo get_template_directory_uri();?>/images/frensco.png"/>
   <b> FRESNO</b>
	  </div>
	</a>
		   <span id="div_signup_subheader"></span>
	   </div>
	</div>