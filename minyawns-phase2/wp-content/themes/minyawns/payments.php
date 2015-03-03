<?php
/**
  Template Name: Braintree Payments

 */
get_header();
global $minyawn_job;
require 'templates/_jobs.php';

$args = array(
    'type' => 'job',
    'child_of' => 0,
    'parent' => '',
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 1,
    'hierarchical' => 1,
    'exclude' => '',
    'include' => '',
    'number' => '',
    'taxonomy' => 'category',
    'pad_counts' => false
);
$all_categories = get_categories(array('hide_empty' => 0));


//$object_id=get_object_id(10,691);
//
//foreach($object_id as $objid){ 
//$defaults = array(
//     'post_id' => $objid->id,
//     );
//$all_comments[]=get_comments($defaults);
//}
?>

<!-- Row Div -->

<style>
    .category_label{
        margin-right: 5px !important; 
        margin-top: -2px !important;
    }
    .category_name{
        display: inline-block !important;
        margin-right: 5px !important;
        padding-top: 8px !important;
    }

</style>

<!--<div id="popover-content">
  <a id="link" href="#">click</a>
</div>
<button id="trigger" data-placement="bottom" title="title">Reveal popover</button>-->
<div class="container">

    <input type="hidden" name="categoryids[]" id="category_id" value="<?php if (isset($_GET['cat_id'])) {
    $_GET['cat_id'];
} ?>"/>
    <!--<ul class="nav nav-tabs nav-append-content jobs_menu">
        <li <?php if (isset($_GET['cat_id'])) { ?>class="active" <?php } ?> ><a  href="#tab1" id="browse">Browse Jobs</a></li>
        <li <?php if (!isset($_GET['cat_id'])) { ?>class="active" <?php } ?> id="my_jobs"><a href="#tab2">My Jobs</a></li>

    </ul>  -->
    <input type="hidden" id="tab_identifier" />
    <div class="tab-content">
        <div class="tab-pane jobs_table <?php if (isset($_GET['cat_id'])) { ?> active <?php } ?>" id="tab1">
            <div class="breadcrumb-text">
                <p>
                    <a href="#">My Job</a>
                    <a href="#" id="browse-jobs">Browse Jobs</a>
                    <a href="#" id="calendar-jobs" style="display:none">Calendar Jobs</a>                
                </p>
            </div>
            <!--	<div class="row-fluid upper-tab">
                            <div class="span1"><b class="text-right" >Wages :</b></div>
                            <div class="span2">
                    
                                            <div id="slider3" class="ui-slider">
                                            
                                                    <span class="ui-slider-value first">$500</span>
                                                    <span class="ui-slider-value last">$1000</span>
                                            </div>
                            
                            </div>
                            <div class="span7">
                                        <form action="submit.php" method="POST" accept-charset="utf-8">
                                            <select id="select3" name="select3" place-holder=" cool">
                                                    <option value="sleep" class="selected">sleep</option>
                                                    <option value="sport">sport</option>
                                                    <option value="freestyle">freestyle</option>
                                            </select>
                                            </form>
                            
                            </div>
                            <div class="span2">
                             <button class="btn btn-primary float-right" id="show-calendar" style="margin-right:20px;"><i class="icon-calendar calender"></i> Show calendar</button>
                <button class="btn btn-primary float-right" id="hide-calendar" style="margin-right:20px;display:none"><i class="icon-calendar calender"></i> Hide calendar</button>
                            
                            </div>
                    </div>-->
            <div class="row-fluid">
                <div class="span3" >
<!--                    <div class="alert alert-success alert-sidebar">
                        <h3>Skills / Major </h3><hr>
                        <form action="submit.php" method="POST" accept-charset="utf-8">
                            <select id="select3" name="select3" place-holder=" cool">
                                <option value="sleep" class="selected">sleep</option>
                                <option value="sport">sport</option>
                                <option value="freestyle">freestyle</option>
                            </select>
                        </form>
                    </div>-->
<!--                    <div class="alert alert-success alert-sidebar">
                        <h3> Number of Jobs Completed </h3><hr>

                        <div id="slider3" class="ui-slider">

                            <span class="ui-slider-value first">$500</span>
                            <span class="ui-slider-value last">$1000</span>
                        </div>
                        <br>
                    </div>-->
                    <?php 

	     $args = array(
         	  'orderby' => 'name',
	          'show_count' => 0,
        	  'pad_counts' => 0,
	          'hierarchical' => 1,
        	 'taxonomy' => 'job_category',
        	  'title_li' => ''
        	);

	     $category=get_categories( $args );
  
    

                    
                    ?>
					  <div class="alert alert-success alert-sidebar">
                        <h3> Job Categories</h3><hr>
						<ul class="unstyled nav nav-list categories">
						<?php foreach($category as $cats){
                                                    $count=query_posts("category_name='. $cats->name.'");
                                                    
                                                    ?>	
                                                    <li onclick="filter_categories('<?php echo $cats->term_id ?>','<?php echo $cats->name; ?>')"><?php echo $cats->name; ?> <span class="nav-counter"></span></li>
						
						<?php } ?>
                                                </ul>
                        <br>
                    </div>

                </div>
                <div class="span9">
                    <?php if (isset($_GET['cat_id'])) { ?> Jobs listed under Category: <br><br><span class="label" onclick="remove_cat()"><?php echo str_replace('-', ' ', $_GET['cat_name']) ?>  <button style=" margin-left: 10px;margin-top: -19px;" type="button" class="close" data-dismiss="alert">&times;</button></span> <?php } ?>


                   
                    <span class='load-ajax-browse' style="display:block"></span> 
                    <div id="browse-jobs-table" class="browse-jobs-table">

                        <!-- Row Div header -->


                        <!-- <div class="row-fluid " id="accordion2" >
                 
                         </div>-->
                        <ul class="unstyled job-view-list" id="accordion2">

                        </ul>

                        <button class="btn load_more" id="load-more"> <div><span class='load_ajax' style="display:block"></span> <b>Load more</b></div></button>
                    </div>
                    <br>
                    <div style=" display:none; " id="calendar">

                        <div id="calhead" style="padding-left:1px;padding-right:1px;">          
                            <div class="cHead"><div class="ftitle"></div>
                                <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Loading data...</div>
                                <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Sorry, could not load your data, please try again later</div>
                            </div>          

                            <div id="caltoolbar" class="ctoolbar">
                                <!--                        <div id="faddbtn" class="fbutton">
                                                            <div><span title='Click to Create New Event' class="addcal">
                                
                                                                    New Event                
                                                                </span></div>
                                                        </div>-->
                                <div class="btnseparator"></div>
                                <!--                        <div id="showtodaybtn" class="fbutton">
                                                            <div><span title='Click to back to today ' class="showtoday">
                                                                    Today</span></div>
                                                        </div>-->
                                <div class="btnseparator"></div>

                                <!--                        <div id="showdaybtn" class="fbutton ">
                                                            <div><span title='Day' class="showdayview">Day</span></div>
                                                        </div>-->
                                <div  id="showweekbtn" class="fbutton ">
                                    <div><span title='Week' class="showweekview">Week</span></div>
                                </div>
                                <div  id="showmonthbtn" class="fbutton fcurrent ">
                                    <div><span title='Month' class="showmonthview">Month</span></div>

                                </div>
                                <div class="btnseparator"></div>
                                <div  id="showreflashbtn" class="fbutton">
                                    <div><span title='Refresh view' class="showdayflash">Refresh</span></div>
                                </div>
                                <div class="btnseparator"></div>
                                <div id="sfprevbtn" title="Prev"  class="fbutton">
                                    <span class="fprev"></span>

                                </div>
                                <div id="sfnextbtn" title="Next" class="fbutton">
                                    <span class="fnext"></span>
                                </div>
                                <div class="fshowdatep fbutton">
                                    <div>
                                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                                        <span id="txtdatetimeshow">Loading</span>

                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>
                        </div>
                        <div >

                            <div class="t1 chromeColor">
                                &nbsp;</div>
                            <div class="t2 chromeColor">
                                &nbsp;</div>
                            <div id="dvCalMain" class="calmain printborder">
                                <div id="gridcontainer" style="overflow-y: visible;">
                                </div>
                            </div>
                            <div class="t2 chromeColor">

                                &nbsp;</div>
                            <div class="t1 chromeColor">
                                &nbsp;
                            </div>   
                        </div>

                    </div>
                </div>
            </div>




        </div>
        <!-- /tabs -->
        <div class="tab-pane jobs_table  <?php if (!isset($_GET['cat_id'])) { ?> active <?php } ?>" id="tab2">
            <?php
            if (get_user_role() == 'minyawn') {

                echo '<h6 class="uppermsg">  Browse Jobs to find opportunities that interest you and apply for it</h6>';
            }
            ?>
            <div class="breadcrumb-text">
                <p>
                    <a href="#"><span id="parent_item">My Jobs</span></a>
                    <span id="sub_item">Job List</span>
                </p>
            </div>
            <dic class="row-fluid">
                
            <div class="span3" id="sidebar_categories">
             <div class="alert alert-success alert-sidebar" id="sidebar-content">
                        <h3> Job Categories</h3><hr>
						<ul class="unstyled nav nav-list categories">
						<?php foreach($category as $cats){
                                                    $count=query_posts("category_name='. $cats->name.'");
                                                    
                                                    ?>	
                                                    <li onclick="filter_categories('<?php echo $cats->term_id ?>','<?php echo $cats->name; ?>')"><?php echo $cats->name; ?> <span class="nav-counter"></span></li>
						
						<?php } ?>
                                                </ul>
                        <br>
                    </div>
                <div  id="my-jobs-emp-min">
                        
                        <br>
                    </div>
                </div>
                <div class="span9">




<?php var_dump($_POST); ?>


				<h4>Please enter the details below to make the payment</h4>
				<div>
					<form action="transaction.php" method="POST"
						id="braintree-payment-form">
						<p>
							<label>Card Number</label> <input type="text" size="20"
								autocomplete="off" data-encrypted-name="number" />
						</p>
						<p>
							<label>CVV</label> <input type="text" size="4" autocomplete="off"
								data-encrypted-name="cvv" />
						</p>
						<p>
							<label>Expiration (MM/YYYY)</label> <input type="text" size="2"
								name="month" /> / <input type="text" size="4" name="year" />
						</p>
						
						 <input type="hidden" name="minyawn_id" id="minyawn_id" value="<?php echo $_POST['minyawn_id']; ?>"/>
						 <input type="hidden" name="item_number" id="item_number" value="<?php echo $_POST['item_number']; ?>"/>
						 <input type="hidden" name="custom" id="custom" value="<?php echo $_POST['custom']; ?>"/>
						 <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $_POST['amount']; ?>"/>
						 
						<input type="submit" id="submit" />
					</form>
				</div>





				<script src="https://js.braintreegateway.com/v1/braintree.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
				<script>
					  $(document).ready(function(){
					  
					   var ajax_submit = function (e) {
					      form = $('#braintree-payment-form');
					      e.preventDefault();
					      $("#submit").attr("disabled", "disabled");
					    /*  $.post('braintree_payments', form.serialize(), function (data) {
					        form.parent().replaceWith(data);
					      });
					      
					      */










					      jQuery.post(ajaxurl, {
				                action: 'braintree_payments',
				                data: form.serializeArray(),
				                 
				            },
				                    function(response) {

				            	 form.parent().replaceWith(data);

				                         
				                    })


































					      
					    }
					    //sandbox mode
					    //var braintree = Braintree.create('MIIBCgKCAQEAyL76cIAt5S6/q8WIhJUXwVnjoQWeYk+KmGF/GM0xJdZD+XeZNoeqUSSz0J0D77lQN6uOhCOSI9IRpmWL+Z4OVNz6KxuyHWxm8z04JvrGutNpNKTHg06KhiVoINt70gzgOjTqk9RqNnrmGo8BMZ4bY52o4rMzaCXhkT/syn4ZDQ8jZT5eQ+WZsbRa4e+q864VJwrOWQrdFNHH5RvyVe5Mq7yy+T1NmCHAfaKGmBXKB8Lf9htwUKB+R2oniUjDUK27+eY8M+g4EeqNCi3aOOcttiT1Pvpa2HOJQbmXZsjXSqEd7P7cwAMxhbWGXukIlgRE7Oc/GGO+fo356rNB4ihlgQIDAQAB');
					   //Production Mode
					  // var braintree = Braintree.create('MIIBCgKCAQEA7cnFispR+EZURzyxPTKSyAMa6NXElWV8z9yC8iSZ2x5nKnkzYF2h/Z23ZXdVCWs0qK/cFStqOavqi3YRGlhgwjpSjR+f4LlyV2b2m2h1LXGPi/vDzqQxP13hJwxNuiaCmsUXort9aQM9BnImVn7/Zvxfy0wVwwmWw2f/G6I6fsW60YbRm18xeSphKLH8ISrKoIzMfVhib2vYTmoT2DYEh4jChrMC+K7jVvtaYpBjw2iiQvbbDjhPd9XDYRW9gQdO9ekZD+K6S9r5FnAH7n4/1rYvOqaBWlAH1DJ5cvuwQXOoT/hfvGdc3BCenD9dmyP4dACClQYoDs1LS4bM4aFeVQIDAQAB');
					  
					  
					  <?php
					  if(BRAINTREE_PAYMENT_MODE=="sandbox"){
					  	?>
					  	var braintree = Braintree.create('MIIBCgKCAQEAyL76cIAt5S6/q8WIhJUXwVnjoQWeYk+KmGF/GM0xJdZD+XeZNoeqUSSz0J0D77lQN6uOhCOSI9IRpmWL+Z4OVNz6KxuyHWxm8z04JvrGutNpNKTHg06KhiVoINt70gzgOjTqk9RqNnrmGo8BMZ4bY52o4rMzaCXhkT/syn4ZDQ8jZT5eQ+WZsbRa4e+q864VJwrOWQrdFNHH5RvyVe5Mq7yy+T1NmCHAfaKGmBXKB8Lf9htwUKB+R2oniUjDUK27+eY8M+g4EeqNCi3aOOcttiT1Pvpa2HOJQbmXZsjXSqEd7P7cwAMxhbWGXukIlgRE7Oc/GGO+fo356rNB4ihlgQIDAQAB');
					  	<?php 
					  }
					  else if(BRAINTREE_PAYMENT_MODE=="production"){
					  ?>
					  	var braintree = Braintree.create('MIIBCgKCAQEA7cnFispR+EZURzyxPTKSyAMa6NXElWV8z9yC8iSZ2x5nKnkzYF2h/Z23ZXdVCWs0qK/cFStqOavqi3YRGlhgwjpSjR+f4LlyV2b2m2h1LXGPi/vDzqQxP13hJwxNuiaCmsUXort9aQM9BnImVn7/Zvxfy0wVwwmWw2f/G6I6fsW60YbRm18xeSphKLH8ISrKoIzMfVhib2vYTmoT2DYEh4jChrMC+K7jVvtaYpBjw2iiQvbbDjhPd9XDYRW9gQdO9ekZD+K6S9r5FnAH7n4/1rYvOqaBWlAH1DJ5cvuwQXOoT/hfvGdc3BCenD9dmyP4dACClQYoDs1LS4bM4aFeVQIDAQAB');
					  <?php 	
					  }  
					  ?>

					   
					   braintree.onSubmitEncryptForm('braintree-payment-form', ajax_submit);
					  })
   
  				</script>












			</div>
                <div>
        </div>

    </div>
    <div id="examplejob" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Sample Job Popup</h5>
        </div>
        <div class="modal-body">
            <form class="form-horizontal sample-form">
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Title of my job:</label>
                    <div class="controls">
                        Wash my Car
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Job Description:</label>
                    <div class="controls">
                        I need my blue corvette cleaned. I need someone who knows how to use the car buffer and has cleaned classic cars before.
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Location:</label>
                    <div class="controls">
                        1410 NE Campus Pkwy  Seattle, WA 98195,
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Start the job:</label>
                    <div class="controls">
                        24 October,   2013    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 2:45 pm
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">End the job:</label>
                    <div class="controls">
                        24 October,   2013    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;3:45 pm
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Minyawns Required:</label>
                    <div class="controls">
                        2
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Total Price Per Minyawn:</label>
                    <div class="controls">
                        $12.10
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Job Category:</label>
                    <div class="controls">
                        Check the category that best describes your job
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

        </div>
    </div>

    <!-- model box for example -->
    <div id="examplepopup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">See more examples of jobs</h5>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <div class="span3">
                    <h5>Labor Gigs</h5>
                    <ul>
                        <li> Dry cleaning  </li>
                        <li>  Drop off gifts </li>
                        <li>  Laundry </li>
                        <li>  Distribute flyers </li>
                        <li>  Pick up groceries </li>
                        <li> Wait in line</li>
                        <li>  Grocery delivery</li>
                        <li>  Cleaning</li>
                        <li>  Junk removal</li>
                        <li>  Spring cleaning</li>
                        <li>  Transport heavy furniture</li>
                    </ul>
                </div>
                <div class="span3">
                    <h5>Events Setup</h5>
                    <ul>
                        <li> Catering </li>
                        <li> Videography</li>
                        <li> Marketing </li>
                        <li> Holiday parties </li>
                        <li> Organise rooms </li>
                        <li> Sort and label</li>
                        <li>  Sort through boxes</li>
                    </ul>
                </div>
                <div class="span3">
                    <h5>Tech and Computers</h5>
                    <ul>
                        <li> Social media help</li>
                        <li> Data Entry</li>
                        <li> SEO</li>
                        <li> Website designing</li>
                    </ul>
                </div>
                <div class="span3">
                    <h5>Office work</h5>
                    <ul>
                        <li> Local searches</li>
                        <li> Research work</li>
                        <li> Admin work </li>
                        <li> Edit documents</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

        </div>
    </div>
</div>  </div>  </div>
<?php
get_footer();
?>

