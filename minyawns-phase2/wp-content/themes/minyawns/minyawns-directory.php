<?php
/**
  Template Name: Minyawn Directory
 */

get_header();
require 'templates/_minyawnsdir.php';
?>
<!--  <div class="minions-applied"> <i class="icon-location-arrow "></i> Minyawn is Invited</div> 
<a href="#fakelink" class="btn btn-primary invite-btn">
												   <i class="icon-ok"></i>
												 Invite Minyawn
												   </a> below user email id

-->
<div class="container">
    <div id="main-content" class="main-content bg-white all-minyawns">
        <div class="breadcrumb-text">
            <p id="bread-crumbs-id">
                <a href="<?php echo site_url() ?>/minyawns-directory" class="view loaded">Minyawn Directory</a>
            </p>
        </div>
        <div>
            <?php if (strlen($_GET['filter']) > 0) { ?>
                <span style="margin-bottom: 10px; padding-top: 5px;" onclick="remove_filter()" class="label"><?php echo $_GET['filter'] ?><button data-dismiss="alert" class="close" type="button" style=" margin-left: 10px;margin-top: -2px;">×</button></span>
            <?php } ?>
        </div>
        <div class="row-fluid profile-wrapper">
            <div class="row-fluild">
                <div class="span3">
                    <div class="alert alert-success alert-sidebar">
                        <h3>Name / Skills / Major </h3>
                        <hr>
                        <form  method="GET" accept-charset="utf-8">
<!--                           <select name="select3[]" id="select3" multiple="multiple" class=" hidden">
                              <option value="sleep" selected="selected" id="opt_EwU91S1atqiGQn8EbiIHAG4JulxfDChW" class="selected">sleep</option>
                           </select>-->

                            <ul class="holder" style="width: 600px;">
                                <!--                              <li class="bit-box" rel="sleep" id="pt_EwU91S1atqiGQn8EbiIHAG4JulxfDChW">sleep<a class="closebutton" href="#"></a></li>-->
                                <li class="bit-input" id="select3_annoninput"><input placeholder="Enter Name, Skill or Major" name="filter" type="text" class="maininput" size="0" autocomplete="off"></li>
                            </ul>
                            <div class="facebook-auto" style="width: 600px;">
                                <ul id="select3_feed" style="width: 600px; display: none;"></ul>
                                <div class="default">Start to type...<a href="" class="select_all_items">select</a></div>
                            </div>
                        </form>
                    </div>
                    <!--                     <div class="alert alert-success alert-sidebar">
                                            <h3> Number of Jobs Completed </h3>
                                            <hr>
                                            <div id="slider3" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-segment" style="margin-left: 5.2631578947368425%;"></div>
                                               <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 50%;"></div>
                                               <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 50%;"></a>
                                            </div>
                                            <span class="ui-slider-value first">Atleast 3 job done</span>
                                            <br>
                                         </div>-->
<!--                    <div class="alert alert-success alert-sidebar">
                        <label class="checkbox" for="hired-minyawns">
                            <span class="icons"><span class="first-icon fui-checkbox-unchecked"></span><span class="second-icon fui-checkbox-checked"></span></span>
                            <input type="checkbox" value="" id="hired-minyawns" data-toggle="checkbox">
                            Minyawns who have hired to your jobs before
                        </label>
                    </div>
                    <div class="alert alert-success alert-sidebar">
                        <label class="checkbox" for="applied-minyawns">
                            <span class="icons"><span class="first-icon fui-checkbox-unchecked"></span><span class="second-icon fui-checkbox-checked"></span></span>
                            <input type="checkbox" value="" id="applied-minyawns" data-toggle="checkbox">
                            Minyawns who have applied to your jobs before
                        </label>
                    </div>-->
                    <div class="alert alert-success alert-sidebar">
                        <label  class="checkbox" for="checkbox-verified">
                            <span class="icons"><span class="first-icon fui-checkbox-unchecked"></span><span class="second-icon fui-checkbox-checked"></span></span>
                            <input type="checkbox" value="" id="checkbox-verified" >
                            Verified profiles only
                        </label>
                    </div>
                </div>
            </div>

            <div class="span9">
                <!--			   <div id="theFixed" class="alert alert-info alert-job-allminion" style="position:fixed;top:160px;">
                                           <h6>Invite Minyawns for following job</h6>
                                           <h5>
                                           <a href="#" target="_blank" style="color:#8ED030;">The template has been conceived with a proper balance
                                                                UI &amp; UX in order to offer an excellent  </a>
                                           </h5>
                                                </div>-->
                <!--			  <div id="more" class="peplist more">Send Invites by selecting Minyawns below </div>-->

                <div class="row-fluid minyawns-grid1">
                    <ul class="thumbnails minyawnslist" style="left: 100px;">

                        <span class="load_ajaxsingle_job_minions" style="display: none;"></span>
                    </ul>
                    <span class='load_ajax_large'></span>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade minion-dir" id="miniondir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Invite minyawn to...</h4>
      </div>
      <div class="modal-body">
       <table class="table">
        <thead  id="invite_to">
<!--          <tr >
            <th>Job Title</th>
            <th>Date</th>
            <th>Status</th>
           
          </tr>-->
        </thead>
        <tbody>
          
         <!-- <tr>
            <td class="td-job-title">Wash my car</td>
            <td class="sm-font">09 December, 2013</td>
            <td><a href="#" class="btn btn-primary invite-btn">
			 <i class="icon-ok"></i> Resend Invite
			</a></td>
          
          </tr>
          <tr class="success">
            <td class="td-job-title">Paint the office balcony</td>
            <td class="sm-font">09 December, 2013</td>
            <td><span class="applied">applied</span></td>
           
          </tr>
       
          <tr class="warning">
            <td class="td-job-title">Jobs status grid</td>
            <td class="sm-font">09 December, 2013</td>
            <td><span class="hired">Hired</span></td>
        
          </tr>
        
          <tr class="success">
            <td class="td-job-title">Paint the office balcony</td>
            <td class="sm-font">09 December, 2013</td>
            <td ><span class="applied">applied</span></td>
           
          </tr> -->
        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
