
<script type="text/template" id="jobs-table"> 
      <li class="_li <% if(result.todays_date_time > result.job_end_date_time_check) {%>job-closed<%}else{%>job-open<%}%> panel">
      
							 <div class="row-fluid mobile-hide" >
							  <div class="span9 ">
							       <div class="row-fluid "  >
                                      <div class="span1">
									  <div class="job-date" data-toggle="collapse-next" data-parent="#accordion24">
										<b><%= result.job_start_day %></b>
										<%= result.job_start_month %>
									  </div>
									  
									  </div>
									  <div class="span11 border-right job-details">
                                          <div class="job-title">
                                             <h5><a  class='prevent_default'  href=<?php echo site_url() ?>/job/<%= result.post_slug %>><%= result.post_title %></a></h5>
                                          </div>
                                          <div class="job-meta" data-parent="#accordion24">
                                          <div class="span9">
                                             <ul class="inline">
                                               
 
                                                <li data-toggle="collapse-next"  ><i class="icon-time"></i> <%= result.job_start_time %> &nbsp;<%= result.job_start_meridiem %> to <%= result.job_end_time %>  &nbsp;<%= result.job_end_meridiem %></li>
                                                      <li class="" data-toggle="collapse-next" ><i class="icon-map-marker"></i> <%= result.job_location %></li>
                                                      
                                                      <li class="no-bdr">
                                                      <i class="icon-calendar"></i>

                                                      <a href="<?php echo site_url() ?>/job/<%= result.post_slug %>" title="<%= result.post_title %>" class="addthisevent" style="visibility:visible;color:#949494;z-index:inherit">

                                                      Add to Calendar
                                                      <span class="_start"><%= result.event_start %></span>
                                                      <span class="_end"><%= result.event_end %></span>
                                                      <span class="_zonecode">6</span>
                                                      <span class="_summary"><%= result.post_title %></span>
                                                      <span class="_description"><%= result.job_details %></span>
                                                      <span class="_location"><%= result.job_location %></span>
                                                      <span class="_organizer"><%= result.job_company %></span>
                                                      <span class="_organizer_email"><%= result.job_author_email %></span>
                                                      <span class="_all_day_event">false</span>
                                                      <span class="_date_format">DD/MM/YYYY</span>
                                                      </a>
                                                      </li>


 
                                             </ul>
											 			</div>
                            <div class="span3" data-toggle="collapse-next" ></div>
                                          </div>
                                         
                                       </div>
                                    </div>
							  </div>
							  <div class="span3 status">
							    <div class="st-moile-span1">

                                          <div class="st-wages"> wages <b>$<%= result.job_wages %></b></div>
										  <a class="accordion-toggle" data-toggle="collapse-next" data-parent="#accordion24" >
     Show More Information
      </a>
                                       </div>
							  </div>
							 </div>
	  
	  <div id="collapseOne" class="accordion-body collapse ">
      <div class="accordion-inner">
                              <div class="row-fluid mobile-detail">
                                 <div class="span9 ">
                                    <div class="row-fluid ">
                                      <div class="span12 job-details">
                                         <p><%= result.job_details %><em>Job posted by<a href="<?php echo site_url() ?>/profile/<%=result.job_author_id %>" target="_blank"> <%= result.job_company %></a></em> </p>
                                       </div>
                                    </div>
									 <div class="additional-info">
                                       <div class="row-fluid">
                                          <div class="span6"><span> Category :</span><br><% for(i=0;i<result.job_categories.length;i++){ %> <span class="category-link" style="cursor: pointer; cursor: hand;" onclick="filter_categories('<%= result.job_category_ids[i] %>','<%= result.job_categories[i]%>')"><%= result.job_categories[i] %>,</span><%}%></div>
                                          <div class="span6"> <span> Tags :</span> <br><% for(i=0;i<result.tags.length;i++){ %> <span class="label"><%= result.tags[i] %></span><%}%></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="span3 status">
								    <div class="st-wages"> <b>$<%= result.job_wages %></b> wages</div>
                                    <div class="st-fluid">
                                     
                                       <div class="st-moile-span2">
                                           <%= job_progress %>                                          
                                       </div>
                                       <div class="clear"></div>
                                    </div>
                                    <div class="st-footer">                                       
                                        
                                       <%= job_collapse_button %>

                                    </div>

<% console.log("result") %>
<% console.log(result) %>

                                   



                                 </div>
                              </div>   
</div>
</div>							  
                           </li>  
<?php
$salt_job = wp_generate_password(20);
$key_job = sha1($salt . uniqid(time(), true));

$payment_type = (get_option('payment_type')==''?'braintree':get_option('payment_type')) ;



if($payment_type=='braintree'){
    $form_submit_page = 'payments';
    $payment_button = '<a href="#paymentform"  data-toggle="modal"><input type="image"  width="160" height="40"  src="'.site_url().'/wp-content/themes/minyawns/images/pay-btn.png" value="Pay with PayPal" class="center-image"/></a>';

}
else {
    $form_submit_page = 'paypal-payments';
    $payment_button = '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" value="Pay with PayPal" class="center-image"/>';
}

?>
   <form class="paypal" action="<?php echo site_url() . '/'.$form_submit_page.'/'; ?>" method="post" id="paypal_form" target="_blank">
    <input type="hidden" name="cmd" value="_xclick">
                <input type='hidden' name='hdn_jobwages' id='hdn_jobwages' value='' />
                <input type="hidden" name="lc" value="UK" />
                <input type="hidden" name="no_note" value="1" />
                <input type="hidden" name="custom" value="<?php echo $key_job ?>" />
                <input type="hidden" name="amount" id="amount"  />
                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" /> 
                <input type="hidden" name="first_name" value="Customer  First Name"  />
                <input type="hidden" name="last_name" value="Customer  Last Name"  />
                <input type="hidden" name="item_number" id="item_number"  / >
                <input type="hidden" name="minyawn_id" id="minyawn_id" />
                <input type="hidden" name="item_name" value="<?php get_the_title($_POST['job_id']) ?>" / >






 


<?php if($payment_type=="braintree") {
 ?>
<div   id="paymentform" class="modal signup  hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?php echo site_url();?>/wp-content/themes/minyawns/images/delete.png"></button>
       <img class="payment_image" width="96" height="96" src="<?php echo site_url()?>/wp-content/themes/minyawns/images/avatar2.jpg">
    <h4 id="myModalLabel">Job Payment<!--<img src="Test%20job%2000003%20%7C%20Minyawns_files/logo.png">--> </h4>
  </div>
  <div class="modal-body">
	<div class="row-fluid" >
		<p class="payment_msg payment_success"style="display:none"><i class="icon-ok"></i> &nbsp; Transaction successful.</p>
	<div>

    <div class="row-fluid payformdiv" >
		<div class="span12"> 
	       <p class="align-center">Please enter the following details</p>
		<div class="control-group ">

			<input type="text" value="" placeholder="Card Number" autocomplete="off" data-encrypted-name="number"  class="span3">

        </div>
		<div class="control-group ">
            <input placeholder="CVV" class="span3" autocomplete="off" data-encrypted-name="cvv" type="text">
        </div>
		<div class="control-group ">
            <div class="row-fluid">
            	<div class="span6">
               		<input type="text" size="2" placeholder="MM" class="span3" name="month" autocomplete="off"  />
            	</div>
            	<div class="span6">
               	 	<input size="4" placeholder="YYYY" class="span3" name="year" type="text" autocomplete="off" >
            	</div>
            </div>
        </div>
        
<?php 
global $current_user;
$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);
$current_user_role =  trim($user_role);

 // if (current_user_can( 'manage_options' )) {
 if($current_user_role ==="administrator"){
  	
	  	define("ENCRYPTION_KEY", "!@#$%^&*");
		$string = get_option('admin_email');
		$encrypted_data =  encrypt_decrypt('encrypt', $string); 
  	
  	?>
		<div class="control-group ">
				<input type="hidden" name ="adminverify" id="adminverify" value="<?php echo $encrypted_data; ?>" />
				<input type="hidden" name ="hdn_markaspaid" id="hdn_markaspaid" value="0" />
				 
                <a id="admin_submit"  name="admin_submit"  href="#" class="">Mark as paid</a>
        </div> 
<?php }
?>
        <div class="control-group ">
                <button id="submit" class="btn btn-primary btn-block">Submit</button>
        </div> 
<img class="submit_loader" style="display:none;"  src="<?php echo site_url()?>/wp-content/themes/minyawns/images/2.gif">
		</div>


		
	</div>
  </div>
  
</div>


 	
	 
  </div>
  
</div>
<?php
}
?>









                                                    <% if(result.job_owner_id === logged_in_user_id){%>
    <div id="show-single-job " class="alert alert-info" style="display:none;"><i class="icon-check-sign"></i> &nbsp;&nbsp;Please Select Your Minions</div>
    <%}%>
             <div class="row-fluid minyawns-grid1" >
		  <%  if ($(window).width() < 800) {%>
			
			<div class="span3 mobile-alert-box">
                  <div class="alert alert-success alert-sidebar author-data">
                      
					  
					  <div class="row-fluid">
					  <div class="span3">
						<%= result.job_author_logo %>
					  </div>
						<div class="span9 author-info">
                                                <a href="<?php echo site_url() ?>/profile/<%=result.job_author_id %>" target="_blank"><h4><%= result.job_company%></h4></a>
							<i class="icon-map-marker"></i> <%= result.job_company_location%>
						</div>
					  </div>
						
                        <br>
                    </div>
                 
              <% if(  ((is_admin==true) || (result.job_owner_id === logged_in_user_id))  && result.user_to_job_status.indexOf('hired') == -1){%>
                     <div id="selection" class="alert alert-success alert-sidebar" style="position:relative">
                        <h3>Your selection</h3>
                        <hr>
                        <b> No. of Minions Selected <img id="imgselect" class="imgselect" src="<?php echo get_template_directory_uri(); ?>/images/minyawn-total.png" style="margin-top:-10px;"/>: <span id="no_of_minyawns">0</span></b>
                        <b> Wages per Minion:<span id="wages_per_minyawns">0</span><span>$</span></b>
                        <b class="total-cost"> Total Wages Due:<span id="total_wages">0</span><span>$</span></b><br>
							<div class="msg-info">
							<span>Please Note</span>
							Funds to minions will be released on job completion only. If minions don't show up, you will get full refund.
<br> Any credit or debit card will do!</div>
                        <span id="paypal_pay" style="display:none"><?php echo $payment_button; ?></span>
                     <span id="selection_message"></span>
                                    </div>
                            <%}%>
                 
					   
</div>
 <%}%>
        <div class="span9">
        
    <div class="load_ajax_large_minyawns_container span12"><span class="load_ajax_large_minyawns"  ></span></div>
    <ul class="thumbnails">
    </ul>
        </br></br></br></br><span id="div_confirmhire"></span>
</div>









<div class="span3 mobile-alert-box-hidden">
                  <div class="alert alert-success alert-sidebar author-data">
                      <b style="color:#000;">Employer Details</b>
					  
					  <div class="row-fluid">
					  <div class="span3">
						<%= result.job_author_logo %>
					  </div>
						<div class="span9 author-info">
						
                                                <a href="<?php echo site_url() ?>/profile/<%=result.job_author_id %>" target="_blank"><h4><%= result.job_company%></h4></a>
							<i class="icon-map-marker"></i> <%= result.job_company_location%>
						</div>
					  </div>
						
                        <br>
                    </div> 
            <input type="hidden" id="jobid"  name="jobid"  value="<%= result.post_id%>">
            <input type="hidden" name="userid" value="<%= USER.id%>">
            
            <input type="hidden" name="upload_nonce"  id="upload_nonce" value=""  >
            <input type="hidden" name="delete_nonce"  id="delete_nonce" value=""  >
           
            
            <div class="alert alert-success alert-sidebar author-data" id="upload" style="display:none">
             
                  <div class="row-fluid">
                  <div class="span12">
                    <div id="drop">
                      Drop Your Job Photos Here 
                      <a class="btn btn-primary"><i class="icon-file"></i>Browse</a>
                      <input type="file" name="photo" multiple />
                    </div>

                    <ul>
                      <!-- The file uploads will be shown here -->
                    </ul>
                  </div>
                </div>
            </div> 
                      
            
             
           <div class="row-fluid" id="photo-grid" style="display:none">
      <div class="span12 align-left">
     <div align="left" id="photos_title" class="photos-title" style="display:none"> <b >Job Photos</b></div>
        <div class="isotope">
          <div class="grid-sizer"></div>
          
             </div>
        
       </div>
    </div>
              <% if( ( (is_admin==true)  || (result.job_owner_id === logged_in_user_id))  && result.user_to_job_status.indexOf('hired') == -1){%>
                     <div id="selection" class="alert alert-success alert-sidebar" style="position:relative">
                        <h3>Your selection</h3>
                        <hr>
                        <b> No. of Minions Selected <img id="imgselect" class="imgselect" src="<?php echo get_template_directory_uri(); ?>/images/minyawn-total.png" style="margin-top:-10px;"/>: <span id="no_of_minyawns">0</span></b>
                        <b> Wages per Minion:<span id="wages_per_minyawns">0</span><span>$</span></b>
                        <b class="total-cost"> Total Wages Due:<span id="total_wages">0</span><span>$</span></b><br>
							<div class="msg-info">
							<span>Please Note</span>
							Funds to minions will be released on job completion only. If minions don't show up, you will get full refund.
<br> Any credit or debit card will do!</div>
                        <span id="paypal_pay" style="display:none"><?php echo $payment_button; ?></span>
                     <span id="selection_message"></span>
                                    </div>
                            <%}%>
           
		
</div>
 
                       
                     </div>
                  </div>
    </form>



</script>




<script type="text/template" id="profile-table">   
<% console.log('check..................')%>
<% console.log(result) %>
<% console.log('currentpage_user_role') %>
<% console.log(currentpage_user_role)%>
    <li class="_li <% if(result.todays_date_time > result.job_end_date_time_check) {%>job-closed<%}else{%>job-open<%}%>">
    

							 <div class="row-fluid mobile-hide" >
							  <div class="<% /*if(currentpage_user_role=="employer"){ span9 } else{ */ %>span6<% /* } */  %> ">
							       <div class="row-fluid " data-toggle="collapse-next" data-parent="#accordion24">
                                      <div class="span2">
									  <div class="job-date">
										<b><%= result.job_start_day %></b>
										<%= result.job_start_month %>
									  </div>
									  
									  </div>
									  <div class="span10 border-right job-details">
                                          <div class="job-title">
                                             <h5><a href=<?php echo site_url() ?>/job/<%= result.post_slug %>> <%= result.post_title %></a></h5>
                                          </div>
                                          <div class="job-meta">
                                             <ul class="inline">
                                               
                                                <li ><i class="icon-time"></i> <%= result.job_start_time %> &nbsp;<%= result.job_start_meridiem %> to <%= result.job_end_time %>  &nbsp;<%= result.job_end_meridiem %></li>
                                                      <li class="no-bdr"><i class="icon-map-marker"></i> <%= result.job_location %></li>
                                             </ul>
                                          </div>
                                         
                                       </div>
                                    </div>
							  </div>
							  <div class="<% /* if(currentpage_user_role=="employer"){ span3< else{ */ %>span3<% /* } */ %> status">
							    <div class="st-moile-span1">

                                          <div class="st-wages"> wages <b>$<%= result.job_wages %></b></div>
										  <a class="accordion-toggle" data-toggle="collapse-next" data-parent="#accordion24" >
     Show More Information
      </a>
                                       </div>
							  </div>
				<% /*if(currentpage_user_role!="employer"){ */ %>
                 <div class="span3">

                  		<div class="st-moile-span1">
                     			 <%= review.status1 %>
                         </div>

                  </div> 
				<% /*} */ %>

			   </div> 
               </div>
               <div class="clearfix"></div>
	  
	  <div id="collapseOne" class="accordion-body collapse ">
      <div class="accordion-inner">
                              <div class="row-fluid mobile-detail">
                                 <div class="span6 ">
                                    <div class="row-fluid ">
                                      <div class="span12 job-details">
                                         <p> <%= result.job_details %> <em>job posted by<a href="<?php echo site_url() ?>/profile/<%=result.job_author_id %>" target="_blank"> <%= result.job_author%></a></em> </p>
                                       </div>
                                    </div>
									                   <div class="additional-info">
                                       <div class="row-fluid">
                                          <div class="span6"><span> Category :</span><br><% for(i=0;i<result.job_categories.length;i++){ %> <span class="category-link" style="cursor: pointer; cursor: hand;" onclick="filter_categories('<%= result.job_category_ids[i] %>','<%= result.job_categories[i]%>')"><%= result.job_categories[i] %>,</span><%}%></div>
                                          <div class="span6"> <span> Tags :</span> <br><% for(i=0;i<result.tags.length;i++){ %> <span class="label"><%= result.tags[i] %></span><%}%></div>
                                       </div>
                                 </div>
                                 </div>
                                 <div class="span3 status">
								                    <div class="st-wages"> <b>$<%= result.job_wages %></b> wages</div>
                                    <div class="st-fluid">
                                     
                                       <div class="st-moile-span2">
                                           <%= job_progress %>                                          
                                       </div>
                                       <div class="clear"></div>
                                    </div>
                                    <div class="st-footer">                                       
                                        
                                       <%= job_collapse_button %>
                                      
                                    </div>
                                 </div>
                                 <div class="span2"> <%= review.status2 %></div>
                              </div>   
</div>
</div>	
							 
    </li>  
    <?php
    $salt_job = wp_generate_password(20);
    $key_job = sha1($salt . uniqid(time(), true));
    ?>
    <form class="paypal" action="<?php echo site_url() . '/paypal-payments/'; ?>" method="post" id="paypal_form" target="_blank">
    <input type="hidden" name="cmd" value="_xclick">
    <input type='hidden' name='hdn_jobwages' id='hdn_jobwages' value='' />
    <input type="hidden" name="lc" value="UK" />

    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="custom" value="<?php echo $key_job ?>" />
    <input type="hidden" name="amount" id="amount"  />
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" /> 
    <input type="hidden" name="first_name" value="Customer  First Name"  />
    <input type="hidden" name="last_name" value="Customer  Last Name"  />
    <input type="hidden" name="item_number" id="item_number"  / >
    <input type="hidden" name="item_name" value="<?php get_the_title($_POST['job_id']) ?>" / >
    <% if(result.job_owner_id === logged_in_user_id){%>
    <div id="show-single-job " class="alert alert-info" style="display:none;"><i class="icon-check-sign"></i> &nbsp;&nbsp;Please Select Your Minions</div>
    <%}%>
    <div class="row-fluid minyawns-grid1">
    <div class="span9">
    <ul class="thumbnails">
<!--    <span class='load_ajaxsingle_job_minions' style="display:none"></span>-->
    </ul>
    </br></br></br></br><span id="div_confirmhire"></span>
    </div>
    <div class="span3">

    <!--  <div class="alert alert-success alert-sidebar jobexpired">
    <div>Job has expired.</div>
    </div>-->
    <% if(result.job_owner_id === logged_in_user_id ){%>
    <div id="selection" class="alert alert-success alert-sidebar" style="position:relative">
    <h3>Your selection</h3>
    <hr>
    <b> No. of Minions Selected <img id="imgselect" class="imgselect" src="<?php echo get_template_directory_uri(); ?>/images/minyawn-total.png" style="margin-top:-10px;"/>: <span id="no_of_minyawns">0</span></b>
    <b> Wages per Minion:<span id="wages_per_minyawns">0</span><span>$</span></b>
    <b class="total-cost"> Total Wages Due:<span id="total_wages">0</span><span>$</span></b><br>
<div class="msg-info">
							<span>Please Note</span>
							Funds to minions will be released on job completion only. If minions don't show up, you will get full refund.
 <br>Any credit or debit card will do!</div>
    <span id="paypal_pay" style="display:none"> <?php echo $payment_button; ?></span>
    <span id="selection_message"></span>
    </div>
    <%}%>


    </div>


    </div>
    </div>
    </form>
</script>

<script type="text/template" id="minion-cards">


    <li class="span3 thumbspan" id="<%= result.user_id %>" >

    <div class="thumbnail select-button-<%= result.user_id %>" id="thumbnail-<%= result.user_id %>">
    <div class="layer">
    <div id="a" class="m1">
    <div class="caption" >
    <% if(result.is_invited == 4){%>
     <div class="minions-applied"> <i class="icon-location-arrow "></i> Minion was Invited</div>
     <%}%>

    <div class="minyawns-img">
    <% if(result.is_hired === true){%>
    <div class="minaywns-sel">
	<i class="icon-ok"></i>
	SELECTED
	</div>
    <% } %>
    <a href='<?php echo site_url(); ?>/profile/<%= result.user_id %>'><%= result.user_image%></a>
    </div>
    <% if(result.is_verified === 'Y'){%>
    <!-- <img class="verfied" src="<?php echo get_template_directory_uri(); ?>/images/verifed.png" />-->
    <div class="verfied-txt">Verified Minion</div>
    <% } %>
    <h4><a href='<?php echo site_url(); ?>/profile/<%= result.user_id %>' target="_blank"> <%= result.name %></a></h4>
    <div class="collage"> <%= result.college%> </div>
    <div class="collage"> <%= result.major%> </div>
    <div class="social-link">
    <%= result.user_email %>
    </div>
    <div class="social-link profile-social-link">
    <% if (result.linkedin.length > 0 ){%>
    <% if( (result.linkedin.indexOf("https://") <= -1) && (result.linkedin.indexOf("http://") <= -1) ){
        var linkedinUrl = "http://"+result.linkedin;
    }
    else{
        var linkedinUrl = result.linkedin;
    }
    %>
    <a href='http://<%= result.linkedin %>' target='_blank'><i class='icon-linkedin'></i></a>
    <%} %>
     <% if (result.facebook_link.length > 0 ){%>
    <% if( (result.facebook_link.indexOf("https://") <= -1) && (result.facebook_link.indexOf("http://") <= -1) ){
        var facebook_linkUrl = "http://"+result.facebook_link;
    }
    else{
        var facebook_linkUrl = result.facebook_link;
    }
    %>
    <a href='http://<%= result.facebook_link %>' target='_blank'  class="icon-facebook-a"><i class='icon-facebook'></i></a>
    <%} %></div>

    <div class="rating">
    <a href="#fakelink" id="thumbs_up_<%= result.user_id %>">
    <i class="icon-thumbs-up" ></i> <span class="thumbs_up_counts"><%= result.rating_positive %></span>
    </a>
    <a href="#fakelink"  class="icon-thumbs" id="thumbs_down_<%= result.user_id %>">
    <i class="icon-thumbs-down" ></i> <span class="thumbs_down_counts"><%= result.rating_negative %></span>
    </a>
    </div>

    </div>

    </div>


    <div id="b" class="m2">

    <div class="caption" >
    <div>
    <div class="minyawns-img" >
    <a href='<?php echo site_url(); ?>/profile/<%= result.user_id %>' target="_blank"><%= result.user_image%></a>
    </div>
    <div class="rating">
    <a href="#fakelink" id="thumbs_up_<%= result.user_id %>">
    <i class="icon-thumbs-up" ></i> <span class="thumbs_up_counts"><%= result.rating_positive %></span>
    </a>
    <a href="#fakelink"  class="icon-thumbs" id="thumbs_down_<%= result.user_id %>">
    <i class="icon-thumbs-down" ></i> <span class="thumbs_down_counts"><%= result.rating_negative %></span>
    </a>
    </div>
    <h4><a href='<?php echo site_url(); ?>/profile/<%= result.user_id %>' target="_blank"> <%= result.name %></a></h4>
    <div class="collage"> <%= result.college%> </div>
    <div class="collage"> <%= result.major%> </div>
    <div class="social-link">
    <%= result.user_email %>
    </div>
    <div class="social-link   profile-social-link">
    <% if (result.linkedin.length > 0 ){%>
    <% if( (result.linkedin.indexOf("https://") <= -1) && (result.linkedin.indexOf("http://") <= -1) ){
        var linkedinUrl = "http://"+result.linkedin;
    }
    else{
        var linkedinUrl = result.linkedin;
    }
    %>
    <a href='http://<%= result.linkedin %>' target='_blank'><i class='icon-linkedin'></i></a>
    <%} %>
     <% if (result.facebook_link.length > 0 ){%>
    <% if( (result.facebook_link.indexOf("https://") <= -1) && (result.facebook_link.indexOf("http://") <= -1) ){
        var facebook_linkUrl = "http://"+result.facebook_link;
    }
    else{
        var facebook_linkUrl = result.facebook_link;
    }
    %>
    <a href='http://<%= result.facebook_link %>' target='_blank'  class="icon-facebook-a"><i class='icon-facebook'></i></a>
    <%} %>
            </div>
    </div>



    <div class="tags">
    Tags:<br>
    <%
    var split_skills=result.user_skills.split(',');
    for(var index=0;index<=split_skills.length;index++){
    %>
    <span class="label label-small"><%= split_skills[index] %></span>

    <% } %>
    </div>
    </div>

    </div>
    </div>

    </div>
<!--	<div class="dwn-btn review_popover">

    <%= ratings_button %>
    <%  if(result.comment !== 0){ %>   <div  class="comment-box"> <i class="icon-thumbs-up weldone"></i><%= result.comment %></div><% } %>

    </div>-->
    <div class="dwn-btn review_popover">

   <%= ratings_button %>
<!--   <%  if(result.comment !== 0){ %><div  class="comment-box"> <i class="icon-thumbs-up weldone"></i> <%= result.comment %></div><% }else{%><div  class="comment-box"> <i class="icon-thumbs-down terrible"></i> <%= result.comment %></div><%}%>-->
   </div>

    <%= select_button %>
    <!--<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
    <label class="onoffswitch-label" for="myonoffswitch">
    <div class="onoffswitch-inner"></div>
    <div class="onoffswitch-switch"></div>
    </label>
    </div>-->
    </li>

</script>

<script type="text/template" id="confirm-hire">
    <input type="hidden" id="hidden_selected_min"/>
    <span class="load_ajaxconfirm" style="display:none"></span>
    <a  id="confirm-hire-button"  class="btn btn-medium btn-block green-btn btn-success">Confirm & Hire</a>

</script>

<script type="text/template" id="blank-card">
    <li class="span3 thumbspan card" id="91">
    <div class="thumbnail select-button-91" id="thumbnail-91">
    <div class="m1">
    <div class="caption">
    <div class="minyawns-img">
    <img src="<?php echo get_template_directory_uri(); ?>/images/avatar2.jpg" height="96" width="96"/>
    </div>
    <h4> Why wait for Minions to apply?</h4>
    <div class="text-meta-bold">With over 500 Minions equipped with valuable skills from top universities. 
    </div>
    <div class="text-meta">
    </div>
 <% if(result.job_owner_id === logged_in_user_id && result.user_to_job_status.indexOf('hired') == -1){ %>
    <a href="<?php echo site_url() ?>/minyawns-directory" target="_blank" class="btn btn-primary">
    <i class="icon-eye-open"></i>
    View All Minions
    </a>
    <% } %>
    </div>
    </div>

    </div>
    </li>
</script>

<script type="text/templates" id="no-result">
    <div class="alert alert-info myjobs no-job ">
    <b style="text-align: center">Create your first job now </b>&nbsp; <a href="<?php echo site_url()  ?>/add-job" class="btn btn-primary btn-large  mll" id="add-job-button">
                                <i class="icon-plus-sign"></i>
                                &nbsp;Add a Job

                            </a>
    
    </div>
</script>
<script type="text/templates" id="no-result-minion">
    <div class="alert alert-info myjobs no-job ">
    <b style="text-align: center">No jobs available! </b>&nbsp;               
          </a>
</div>
</script>
<script type="text/templates" id="comment-popover">
    <div class='tabbable tabs-below'><ul class='nav nav-tabs'><li class='active'>
    <a href='#A' data-toggle='tab'>Well done</a></li><li class='teriblecomments'><a href='#B' data-toggle='tab'>Terrible job</a></li></ul><a class="close"  href="#">&times;</a>
    <div class='tab-content'>
    <div class='tab-pane active' id='A'>
    <ul>
    <%
    if(result.positive.length >0) {
    for(var i=0;i<result.positive.length;i++){ %>
    <li><div class='jobname'>
    <a href='#'> <%= result.positive_title[i] %></a>
    </div>
    <div class='yourcomment'><%= result.positive[i] %></div>
    <% } }else {%>
    <div class='jobname'>You don't have any ratings!</a></div>       
    <% } %>  </li>
    </ul>
    </div>
    <div class='tab-pane tariblecontent' id='B'>
    <ul>
    <% if(result.negative.length >0)
    {  for(var i=0;i<result.negative.length;i++){ %>
    <li><div class='jobname'><a href='#'><%= result.negative_title[i] %></a></div>
    <div class='yourcomment'> <%= result.negative[i] %> </div></li>
    <% }
    }else {%>
    <div class='jobname'>Congrats! You don't have any terrible ratings!</a></div>       
    <% } %>       
    </ul>
    </div></div></div>
</script>

<script type="text/template" id="sample-jobs-template">
    <li id="<%= result.post_id %>">
    <div class="row-fluid"> 
    <div class="span2">
    <i class="icon-suitcase"></i>
    </div>
    <div class="span10">
    <%= result.post_title %>
    <div class="date-meta">Posted on <%= result.job_start_day %> <%= result.job_start_month %>, <%= result.job_start_year %></div>
    </div>
    </div>
    <div id="hidden_values">
    <input type="hidden" class="hidden_elements" name="job_task" id="job_title" value="<%= result.post_title %>"/>
    <input type="hidden" class="hidden_elements" name="job_start_date" id="start-date" value="<%= result.job_start_date %>"/>
    <input type="hidden" class="hidden_elements" name="job_end_date" id="end-date" value="<%= result.job_end_date %>"/>
    <input type="hidden" class="hidden_elements" name="job_start_time" id="start-time" value="<%= result.job_start_time %> <%= result.job_start_meridiem %>"/>
    <input type="hidden" class="hidden_elements" name="job_end_time" id="start-end" value="<%= result.job_end_time %> <%= result.job_end_meridiem %>"/>
    <input type="hidden" class="hidden_elements" name="job_required_minyawns" id="mrequired" value="<%= result.required_minyawns %>"/>
    <input type="hidden" class="hidden_elements" name="job_wages" id="jwages" value="<%= result.job_wages %>"/>
    <input type="hidden" class="hidden_elements" name="job_location" id="jlocation" value="<%= result.job_location %>"/>
    <input type="hidden" class="hidden_elements" name="job_tags" id="jtags" value="<%= result.tags %>"/>
    <input type="hidden" class="hidden_elements" name="categories" id="jcategories" value="<%= result.job_category_ids %>"/>
    <input type="hidden" class="hidden_elements" name="job_details" id="jdesc" value="<%= result.job_details %>"/>
    </div>
    </li>

</script>

<script type="text/templates" id="no_access">
      <div class="alert alert-info " style="width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%">
			<div class="row-fluid">
                            <div class="span3"><br><img src="<?php echo get_template_directory_uri(); ?>/images/404error.png"/></div>
				<div class="span9">	<h4 >No Access</h4>
		<hr>
		Hi, you are not logged in yet. If you are registered, please log in, or if not, sign up to get started with minyawns.
		<br>
		<a <?php /* commented on 19june2014 href="#mylogin" */ ?>  href="<?php echo site_url(); ?>/wp-login.php" data-toggle="modal" id="btn__login" class="btn btn-large btn-block btn-success default-btn"  >Login</a>
		<div class="clear"></div></div>
			</div>
		</div>
    
</script>

<script type="text/templates" id="employer-sidebar">
<div class="alert alert-success alert-sidebar">
<h3> Stuff that's good to know</h3><hr>
						<ul class="unstyled nav nav-list categories" id="display_text">
						<li><b>Make sure you set the right wage for the job,as the minions are hardworking and always deliver - so keep them happy</b></li>
                    <li><b>Be as clear as you can about the nature of the job. A surprised minion is not always a good thing</b></li>                                     
            <li><b>Be sure to rate your minion once the job is completed. A pat on the back or a light reproach will help the minion do better</b></li>
            </ul>
</div>

</script>

<script type="text/templates" id="minion-sidebar">
<div class="alert alert-success alert-sidebar">
<h3>Stuff every good minion must know</h3><hr>
						<ul class="unstyled nav nav-list categories" id="display_text">
						<li><b>Make sure your overall ratings are good.Most employers select minions with higher ratings</b></li>
            <li><b>Show up for jobs assigned and accepted by you. You will be paid only once the job has been successfully completed</b></li>
            <li><b>Do every job with a smile. Nobody likes a cranky minion</b></li>
           
            </ul>
</div>
        
</script>


