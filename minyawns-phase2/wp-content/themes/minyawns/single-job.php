<?php
get_header();

global $minyawn_job;
require 'templates/_jobs.php';
?>
<script>
    jQuery(document).ready(function($) {
        jQuery("#single-job-page").show();
        load_browse_jobs('<?php the_ID() ?>', 'single_job');
        jQuery("#single-job-page").hide();

       $(window).bind('beforeunload', function(){
       if($("#no_of_minyawns").html() > 0)
      return 'Are you sure you want to leave?';
      
      });

      window.page='1';
      $("#show-single-job").show();
       $('#job_start_time').timepicker('setTime', '<?php echo $minyawn_job->get_start_time_eform() ?>');
        $('#job_end_time').timepicker('setTime','<?php echo $minyawn_job->get_end_time_eform() ?>');

    });
</script>
<!-- Minyawns have not been selected.  
You need to confirm the minyawn selection by making the payment,if you leave this page the selections will be lost.-->
<style type="text/css">
    /* ROUNDED TWO */
    .single-jobs .minyawns-grid .thumbnails .span3 .thumbnail .dwn-btn {
        position: absolute;
        bottom: 8%;
        width: 89%;
    }

    .roundedTwo {
        line-height: 25px;
        padding-left: 16px;

        height: 28px;
        background: #fcfff4;

        background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
        background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
        background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
        background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
        background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
        margin: 20px auto;

        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;

        -webkit-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
        -moz-box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
        box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0,0,0,0.5);
        position: relative;
    }
    .roundedTwo input{
        visibility: hidden !important;
    }
    .roundedTwo label {
        cursor: pointer;
        position: absolute;
        width: 20px;
        height: 20px;

        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        left: 4px;
        top: 4px;

        -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
        -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);
        box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,1);

        background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
        background: -moz-linear-gradient(top, #222 0%, #45484d 100%);
        background: -o-linear-gradient(top, #222 0%, #45484d 100%);
        background: -ms-linear-gradient(top, #222 0%, #45484d 100%);
        background: linear-gradient(top, #222 0%, #45484d 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#222', endColorstr='#45484d',GradientType=0 );
    }

    .roundedTwo label:after {
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        filter: alpha(opacity=0);
        opacity: 0;
        content: '';
        position: absolute;
        width: 9px;
        height: 5px;
        background: transparent;
        top: 5px;
        left: 4px;
        border: 3px solid #fcfff4;
        border-top: none;
        border-right: none;

        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .roundedTwo label:hover::after {
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
        filter: alpha(opacity=30);
        opacity: 0.3;
    }

    .roundedTwo input[type=checkbox]:checked + label:after {
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        filter: alpha(opacity=100);
        opacity: 1;
    }

    .minyans-select{
        border: 2px solid #23CF1C;
        background:url(<?php echo get_template_directory_uri() ?>/images/selectminyawns.png)no-repeat !important;
        background-position: 10px 10px !important;
    }
    .minyans-select:hover img{

        cursor: auto!important;
    }
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


<div class="container">
    <div class="tab-content" style="min-height:928px;">

        
        <div class="tab-pane jobs_table active single-job-1 rr single-view" id="tab2">
		
          
            <div class="breadcrumb-text">
                <p>
                    <a href="<?php echo site_url() ?>/jobs/#browse">My Jobs</a>
                    <?php echo get_the_title() ?>
                  				<div class="single-job-action">
<ul class="inline">				<li >
				<?php if ((get_user_role() === 'employer') && is_job_owner(get_user_id(), get_the_ID()) !== 0): ?> 
                        <a href="#edit-job-form" class=" single-edit edit loaded edit-job-data "  is-job-paid="<?php echo job_selection_status(get_the_ID()) ?>"><i class="icon-edit"></i> Edit</a>
                    <?php endif; ?>
					</li>
				 <?php if ((get_user_role() === 'employer') && is_job_owner(get_user_id(), get_the_ID()) !== 0 && job_selection_status(get_the_ID()) === 0): ?> 	<li>
               
                    <a href="#myModal1"  data-toggle="modal"  id="delete_jobs_link" class="delte-job "  job-id="<?php echo get_the_ID() ?>" style="display:none"><i class="icon-trash"></i> Delete</a>
              
				</li>  <?php endif; ?>
				</ul>
</div>

                </p> 

                <!--Delete Pop uP-->				
                <div id="myModal1" class="modal hide fade delte-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-body">
                        Are you sure you want to delete this job?
                    </div>
                    <div class="modal-footer">
                        <div class="action-btn">
                            <button class="btn btn-danger" id="delete_job" job-id="<?php echo get_the_ID() ?>">Yes </button>
                            <button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
                        </div>
                    </div>
                </div>
                <!--Delete Pop uP-->	          
            </div>
			<div class="row-fluid">
			<div class="span12">
            <span class='load_ajaxsingle_job' style="display:block"></span>
              <ul class="unstyled job-view-list" id="single-job-accordion" >
            

                <span  id='single-job-page'style="display:none"></span>
               

                        </ul>
						</div>
<!--						<div class="span3"><br>
	<div class="alert alert-success alert-sidebar jobexpired" >
		<div>Job has expired.</div>
	</div>
		<div class="alert alert-success alert-sidebar">
					 <h3>Your selection</h3><hr>
					<b> You have selected : <span id="no_of_minyawns">0</span></b>
					<b> Wages :<span id="wages_per_minyawns">0</span><span>$</span></b>
					<b class="total-cost"> Total Cost:<span id="total_wages" >0</span><span>$</span></b></br>
				  <span id='paypal_pay'><input type="image" id="submitBtn" value="Pay with PayPal" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif"></span>
		 </form>
		</div>
		<div class="alert alert-success alert-sidebar pending" >
		<div>Payment is pending</div>
	</div>
		<div class="alert alert-success alert-sidebar">
					 <h3>Your selection</h3><hr>
					<b> You have selected : <span id="no_of_minyawns">10</span></b>
					<b> Wages :<span id="wages_per_minyawns">200</span><span>$</span></b>
					<b class="total-cost"> Total Cost:<span id="total_wages" >2000</span><span>$</span></b></br>
					<i>Your Selection will not be processed until payement is made</i>
				  <span id='paypal_pay'><input type="image" id="submitBtn" value="Pay with PayPal" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif"></span>
		 </form>
		</div>
			<div class="alert alert-success alert-sidebar payement-done" >
		<div>Payment is done</div>
	</div>
		<div class="alert alert-success alert-sidebar">
					 <h3>Your selection</h3><hr>
					<b> You have selected : <span id="no_of_minyawns">10</span></b>
					<b> Wages :<span id="wages_per_minyawns">200</span><span>$</span></b>
					<b class="total-cost"> Total Cost:<span id="total_wages" >2000</span><span>$</span></b></br>
					
		 </form>
		</div>
	</div>-->
	</div>
                <!-- single jobs -->

          
            <div id="edit-job-form" class="span12" style=" margin-left: 30px; width: 95%;display: none " >
</br>
                <form id="job-form" class="form-horizontal">

                    <input type="hidden" value="<?php echo $minyawn_job->get_job_id(); ?>" name="id"></input>
                    <div class="control-group small">

                        <label class="control-label" for="inputtask">Tasks</label>
                        <div class="controls ">
                           <!-- <input type="text" id="job_task" name="job_task" value="<?php echo get_the_title() ?>" placeholder="" class="span3">-->
                            <textarea class="span6" name="job_task" rows="10" id="job_task" maxlength="100" cols="4" placeholder="" style="height:70px;"><?php echo get_the_title() ?></textarea>
                        </div>
                    </div>
                    <div class="control-group small float-left ">
                        <label class="control-label" for="inputtask">Start</label>
                        <div class="controls">
                            <div class="input-prepend input-datepicker">
                                <button type="button" class="btn"><span class="fui-calendar"></span></button>
                                <input type="text" class="span1" readonly  name="job_start_date" value="<?php echo $minyawn_job->get_job_date(); ?>" id="job_start_date">
                            </div>

                        </div>
                    </div>
                    <div class="input-append bootstrap-timepicker">
                        <input id="job_start_time" type="text"readonly class="timepicker-default input-small" name="job_start_time"/>
                        <span class="add-on">
                            <i class="icon-time"></i>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="control-group small float-left">
                        <label class="control-label" for="inputtask">End</label>
                        <div class="controls">
                            <div class="input-prepend input-datepicker">
                                <button type="button" class="btn"><span class="fui-calendar"></span></button>
                                <input type="text"  name="job_end_date" class="span1 hasDatepicker" readonly value="<?php echo $minyawn_job->get_job_end_date(); ?>" id="job_end_date">
                            </div>
                        </div>

                    </div>
                    <div class="input-append bootstrap-timepicker">
                        <input id="job_end_time" type="text" readonly class="timepicker-default input-small" value="<?php echo $minyawn_job->get_end_time_eform() ?>" name="job_end_time">
                        <span class="add-on">
                            <i class="icon-time"></i>
                        </span>
                    </div>
                    <div class="clear"></div>
                    <div class="control-group small">
                        <label class="control-label" for="inputtask">Required</label>
                        <div class="controls ">
                            <input type="text" name="job_required_minyawns" id="job_required_minyawns" placeholder="" value="<?php echo $minyawn_job->get_job_required_minyawns(); ?>" class="spinner">
                        </div>
                    </div>


                    <div class="control-group small">
                    <div class="control-group small float-left ">
                        <label class="control-label" for="inputtask">Wages</label>

                        <div class="controls small">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-dollar"></i></span>
                                <input class="span2" id="job_wages" type="text" name="job_wages" value="<?php echo $minyawn_job->get_job_wages(); ?>">
                            </div>
                        </div>
                    </div>
                          <label class="control-label" for="inputtask">Actual Wages &nbsp;&nbsp;</label>

                        <div class="controls small">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-dollar"></i></span>
                                <input class="span2 readonly-color" id="job_wages_actual"  readonly type="text" name="job_wages_actual" value="<?php echo $minyawn_job->get_job_wages() - ($minyawn_job->get_job_wages() *(10/100)) ?>">
                            </div>
                        </div>


                    </div>
                    <div class="control-group small">
                        <label class="control-label" for="inputtask">Location</label>
                        <div class="controls ">
                            <input type="text" name="job_location" id="job_location" value="<?php echo $minyawn_job->get_job_location(); ?>" placeholder="" class="span9">
                        </div>
                    </div>


                    <div class="control-group small">
                        <label class="control-label" for="inputtask">Tags</label>
                          <div class="controls tagsclass ">
                            <input  name="job_tags" id="job_tags_tag" value="<?php echo $minyawn_job->get_job_tags(); ?>" placeholder="" class="tm-input tagsinput_jobs">
                        </div>
                    </div>
                    <div class="control-group small mobile-category">
                        <label class="control-label" for="inputtask">Job Category</label>
                        <div class="controls ">
                            <?php
                            foreach ($minyawn_job->categories as $job_categories) {

                                $job_cats[] = $job_categories->term_id;
                            
                             
                            }
                       
                            foreach ($minyawn_job->all_categories as $category) {
                                ?>
                                <input class="category_label" type="checkbox" value="<?php echo $category->term_id ?>" name="category-<?php echo $category->term_id ?>" id="category" <?php if (in_array($category->term_id, $job_cats)) { ?> checked <?php } ?>/> <span class="category_name"><?php echo $category->name ?> </span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="control-group small">
                        <label class="control-label" for="inputtask">Details</label>
                        <div class="controls ">
                            <textarea class="span6" name="job_details" rows="10" id="job_details" cols="4" placeholder="" style="height:70px;"><?php echo $minyawn_job->get_job_details() ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <a id="update-job" href="#" class="btn btn-large btn-block btn-inverse span2 float-right" >Submit</a>
                    <div class="clear"></div>
                </form>
            </div>



 
   
<?php $upload_nonce = wp_create_nonce("upload_photo_".get_current_user_id()); ?>
<?php $delete_nonce = wp_create_nonce("delete_photo_".get_current_user_id()); ?>
<div style="display:none">
<input type="text" id="upload_nonce_" value="<?php echo $upload_nonce; ?>" >
<input type="text" id="delete_nonce_" value="<?php echo $delete_nonce; ?>" >
 </div>
 







        </div>
    </div>
</div>

<input type="hidden" id="hidden_minion_id"></input>
<input type="hidden" id="job_id" val="<?php echo the_ID() ?>"></input>
<!--<div id="confirminyawn" class="modal hide fade in papypalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 id="myModalLabel">Your Selection</h4>
    </div>
    <div class="modal-body">
        <div class="row-fluid main-pay ">
            <div class="row-fluid ">
                <div class="span6 pay-title"> No of Minayawns</div>
                <div class="span6 pay-data" id="no_of_minyawns">= <span id="no_of_minyawns"></span></div>
            </div>
            <div class="row-fluid ">
                <div class="span6 pay-title">Wage</div>
                <div class="span6 pay-data" >= $ <span id="wages_per_minyawns"></span></div>
            </div>
            <div class="row-fluid " style="border:0px;">
                <div class="span6 pay-title">Total</div>
                <div class="span6 pay-data" >= $ <span id="total_wages"></span></div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <div>To Confirm & pay</div></br>
        <span id='paypal_pay'><img id="paypal-loader" src="<?php echo site_url() . "/wp-content/themes/minyawns/images/2.gif" ?>" width="20" height="20" /><input type="image" id="submitBtn" value="Pay with PayPal" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif"></span>

    </div>
</div>	
-->
<div id="requiredminyawnerror" class="modal hide fade in papypalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-body">
        Please Select at-least one Minyawn
    </div>
 
  
</div>  

<div class="hidden">
    <script type="text/javascript">
        <!--//--><![CDATA[//><!--
            var warning_image = new Array()
            function preload() {
                for (i = 0; i < preload.arguments.length; i++) {
                    warning_image = new Image()
                    warning_image.src = preload.arguments[i]
                }
            }
            preload(
                "<?php echo get_template_directory_uri();?>/images/minyawns-job-warning.jpg"
            )
        //--><!]]>
    </script>
</div>
<?php
get_footer();