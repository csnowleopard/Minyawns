<?php
/**
  Template Name: Add Job

 */
get_header();

global $minyawn_job;

$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', rtrim($_SERVER['REQUEST_URI_PATH'], '/'));
$count=count($segments);

$segment=is_numeric($segments[$count-1]) ? $segments[$count-1] : ""; 

 
$minyawn_job= New Minyawn_Job($segment);
 
 
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
    'taxonomy' => 'job_category',
    'pad_counts' => false
);
$all_categories = get_categories(array('hide_empty' => 0,'taxonomy' => 'job_category'));
//print_r($all_categories);

$new_array=array();
foreach($minyawn_job->get_job_categories() as $job_categories){
$array=in_array($job_categories[0],$all_categories);

        
}




///$object_id=get_object_id(10,691);
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
<script tyep="text/javascript">
    jQuery(document).ready(function($) {
    
$(".inline li").removeClass("selected");
 fetch_my_jobs(logged_in_user_id);
//$("#add-job-form").find('input:text').val('');

});
    </script>
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
                <?php if(is_user_logged_in()){?>
                <p>
                    <a href="#"><span id="parent_item">My Jobs</span></a>
                    <span id="sub_item">Job List</span>
                </p>
                <?php } ?>
            </div>
            <dic class="row-fluid">
                
         
                <div class="span12">
            <div id="jobs-list">
                <ul id="add-job-view" class="unstyled job-view-list"></ul>
                <div class="tab-pane" id="tab2">
                   <div id="add-job-form" >
                        <div class="row-fluid">
                              <?php
                            
                                if (is_user_logged_in() && get_logged_in_role() === 'Employer') {
                                    ?>
                            <div class="span8"> 
      <div class="alert alert-info job-sidebar previous-jobs previous-jobs-mobile">                          
                                        <h5>
                                            Job Templates
                                            <span class="experts">Reuse your previous jobs</span>
                                        </h5>
                                        <hr>
                                        <ul class="unstyled reuse-job">
                                            
                                            
                                        </ul> 
                                      

                                    </div>							
                                    <div class="alert alert-success alert-box " id="job-success" style="display:none;">  <button data-dismiss="alert" class="close" type="button">×</button>You have successfully add a job.</div>
                                    <!--                        <div id="success_msg" style="background-color:greenyellow;display:none;">Job added</div>-->
                                    <div id="ajax-load" class="modal_ajax_large" style="display:none"></div>
                                    <form id="job-form" class="form-horizontal">
                                        <input type="hidden" value="" id="user_skills"></input>
                                        <input type="hidden" value="" name="id"></input>
                                        <div class="control-group small">
                                            <label class="control-label" for="inputtask">Title of my job </label>
                                            <div class="controls ">
                                               <!-- <input type="text" id="job_task" name="job_task" value="" placeholder="" class="span3">-->
                                                <textarea class="span6" name="job_task" rows="10" id="job_task" maxlength="100" value="<?php echo $minyawn_job->get_title(); ?>" cols="4" placeholder="
                                                          " style="height:70px;"><?php echo $minyawn_job->get_title(); ?></textarea>
                                                <span class="help-block">Eg: Wash my Car.</span>
                                            </div>
                                        </div>

                                        <div class="control-group small float-left ">
                                            <label class="control-label" for="inputtask">Start the job</label>
                                            <div class="controls">
                                                <div class="input-prepend input-datepicker">
                                                    <button type="button" class="btn"><span class="fui-calendar"></span></button>
                                                    <input type="text" class="span1" readonly name="job_start_date" value="<?php echo $minyawn_job->get_job_date_addjob()  ?>" id="job_start_date">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="input-append bootstrap-timepicker controls" style=" margin-left: 10px; ">
                                            <input id="job_start_time" type="text" readonly class="timepicker-default input-small" name="job_start_time" value="<?php echo $minyawn_job->get_job_start_time()  ?>">
                                            <span class="add-on">
                                                <i class="icon-time"></i>
                                            </span>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="control-group small float-left" >
                                            <label class="control-label" for="inputtask">End the job </label>
                                            <div class="controls">
                                                <div class="input-prepend input-datepicker">
                                                    <button type="button" class="btn"><span class="fui-calendar"></span></button>
                                                    <input type="text"  name="job_end_date" class="span1 hasDatepicker" value="<?php echo $minyawn_job->get_job_date_addjob()  ?>" disabled id="job_end_date" style="width: 100px;">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="input-append bootstrap-timepicker controls" style=" margin-left: 10px; ">
                                            <input id="job_end_time" type="text" readonly class="timepicker-default input-small" name="job_end_time" value="<?php echo $minyawn_job->get_job_end_time()  ?>">
                                            <span class="add-on">
                                                <i class="icon-time"></i>
                                            </span>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="control-group small">
                                            <label class="control-label" for="inputtask">Minyawns Required</label>
                                            <div class="controls ">
                                                <input type="text" name="job_required_minyawns" id="job_required_minyawns" placeholder="" value="<?php echo $minyawn_job->get_job_required_minyawns() ?>" class="spinner sm-input">
                                                <span class="help-block">Eg: 2</span>
                                            </div>
                                        </div>


                                        <div class="control-group small">
                                            <div class="span6">
                                                <label class="control-label" for="inputtask">Total Price Per Minyawn</label>

                                                <div class="controls small">
                                                    <div class="input-prepend">
                                                        <span class="add-on"><i class="icon-dollar"></i></span>
                                                        <input class="span2 sm-input" id="job_wages" type="text" value="<?php echo $minyawn_job->get_job_wages()?>" name="job_wages" >
                                                        <span class="help-block">Eg: $120.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <label class="control-label" for="inputtask">Actual Price Per Minyawn</label>

                                                <div class="controls small">
                                                    <div class="input-prepend">
                                                        <span class="add-on"><i class="icon-dollar"></i></span>
                                                        <input class="span2 sm-input  readonly-color" id="job_wages_actual" type="text" readonly value="" name="job_wages" >
                                                        <span class="help-block">Actual Price shown to Minyawns,<br> due to Service fee</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="control-group small">
                                            <label class="control-label" for="inputtask">Location</label>
                                            <div class="controls ">
                                                <input type="text" name="job_location" id="job_location" value="<?php echo $minyawn_job->get_job_location()?>" placeholder="" class="span8">
                                                <span class="help-block">Eg: 1410 NE Campus Pkwy Seattle, WA 98195.</span>
                                            </div>
                                        </div>

                                        <div class="control-group small">
                                            <label class="control-label" for="inputtask">Tags</label>
                                            <div class="controls tagsclass ">
                                                <input  name="job_tags" id="job_tags" value="<?php echo $minyawn_job->get_job_tags(); ?>" placeholder="Tags here" class="tm-input tagsinput_jobs">
                                                <span class="help-block">Eg: Washing.</span>
                                            </div>
                                        </div>
                                        <div class="control-group small">
                                            <label class="control-label" for="inputtask">Job Category</label>
                                            <div class="controls ">
                                                <?php
                                              
                                                
                                                foreach ($all_categories as $category) {
                                                  
                                                    ?>
                                                    <input class="category_label" type="checkbox"  value="<?php echo $category->cat_ID ?>"   <?php if($checked_values[0] === $category->cat_ID){?>checked <?php }?>              name="category-<?php echo $category->cat_ID ?>" id="category-<?php echo $category->cat_ID ?>"/><span class="category_name"><?php echo $category->name ?></span>
                                                    <?php
                                               
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group small">
                                            <label class="control-label" for="inputtask">Job Description</label>
                                            <div class="controls ">
                                                <textarea class="span6" name="job_details" rows="10" id="job_details" cols="4" style="height:70px;"><?php  echo $minyawn_job->get_job_details();?></textarea>
                                                <span class="help-block">Eg: I need my blue corvette cleaned. I need someone who knows how to use the car buffer and has cleaned classic cars before.</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <a id="add-job" href="#" class="btn btn-large btn-block btn-inverse span2 float-right" >Submit</a>
                                        <div class="clear"></div>
                                    </form>
                                </div>
                                <div class="span4" id="right-sidebar">
                                    <div class="alert alert-info job-sidebar previous-jobs">                          
                                        <h5>
                                            Job Templates
                                            <span class="experts">Reuse your previous jobs</span>
                                        </h5>
                                        <hr>
                                        <ul class="unstyled reuse-job">
                                            
                                            
                                        </ul> 
                                      

                                    </div>

                                    <div class="alert alert-info job-sidebar">
                                        <h5>
                                            Example of Jobs
                                        </h5>
                                        <hr>
                                        <ul>
                                            <li> Need help, I am moving out, require some extra hands.</li>
                                            <li>Need a minyawn to clean my house</li>
                                            <li>Need more likes for my Facebook page</li>
                                        </ul>
                                        <br>
                                        <a href="#examplepopup"  data-toggle="modal" >See more examples of jobs</a>

                                    </div>

                                    <div class="alert alert-info help-sidebar">
                                        <a href="#examplejob" role="button" data-toggle="modal" class="btn btn-inverse btn-large">Click here to view a sample job</a><br>
                                        Let us know if you are facing any difficulties, we are happy to be of assistance.
                                        We can help you get your job online now. Just email us on <a href="mailto:support@minyawns.com">support@minyawns.com</a> and we will get your job posted to the site.


                                    </div>
                                </div>
                            </div>
                      
                    </div>
                      <?php }else{ ?>                   

                       <div class="alert alert-info " style="width:70%;margin:auto;border: 10px solid rgba(204, 204, 204, 0.57);margin-top:10%;margin-bottom:10%">
			<div class="row-fluid">
                            <div class="span3"><br><img src="<?php echo get_template_directory_uri(); ?>/images/403error.jpg"/></div>
				<div class="span9">	<h4 >No Access</h4>
		<hr> 
		Sorry, you aren't allowed to view this page. If you are logged in and believe you should have access to this page, send us an email at <a href="mailto:support@minyawns.com">support@minyawns.com</a> with your username and the link of the page you are trying to access and we'll get back to you as soon as possible. 
 
		<br>
		<a <?php /* commented on 19june2014 href="#mylogin" */ ?>  href="javascript:void(0)"   data-toggle="modal" id="btn__login_oaccess" class="btn btn-large btn-block btn-success default-btn"  >Login</a>
		<div class="clear"></div></div>
			</div>
		</div>
                        <?php } ?>
                   
                    
                </div>
              


            </div>
           
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

