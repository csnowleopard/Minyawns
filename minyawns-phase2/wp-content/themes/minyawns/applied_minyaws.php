
<form class="paypal" action="payments.php" method="post" id="paypal_form" target="_blank">   

    <input type="hidden"  name="returnUrl" id="returnUrl" value="<?php echo $returnUrl; ?>" / >
           <input type="hidden" name="cancelUrl" id="cancelUrl"  value="<?php echo $cancelUrl; ?>" / >
           <input type="hidden"  name="notify_url" id="notify_url" value="<?php echo site_url() . '/paypal-payments/'; ?>" / >
           <input type='hidden' name='hdn_jobwages' id='hdn_jobwages' value='<?php echo $minyawn_job->get_job_wages(); ?>' />




    <div class="row-fluid minyawns-grid">
        <ul class="thumbnails">
            <?php
            foreach ($minyawn_job->minyawns as $minyawn):
                ?>
                <a href="<?php echo site_url() ?>/profile/<?php echo $minyawn['user_id'] ?>" target="_blank">
                    <li id="hire-thumb<?php echo $minyawn['user_id'] ?>" <?php if ($minyawn['user_job_status'] == "hired") { ?>class="span3 minyans-select" <?php } else { ?>class="span3" <?php } ?>>

                        <div class="thumbnail " >

                            <div class="caption">
                                <?php if ($minyawn['image'] !== false): ?>
                                    <div class="minyawns-img">
                                        <img src="<?php echo $minyawn['image']; ?>" />
                                    </div>
                                <?php else : ?>
                                    <div class="minyawns-img">
                                        <?php echo get_avatar($minyawn['user_email'], 168); ?>
                                    </div>
                                <?php endif; ?>

                                <div class='rating'>
                                    <a  id="total-like<?php echo $minyawn['user_id']; ?>" class="vote-up" href="#like" is_rated="<?php echo $minyawn['is_job_rated']; ?>" employer-vote="1"   job-id="<?php echo $minyawn['user_to_job'] ?>" user_id="<?php echo $minyawn['user_id']; ?>" action="vote-up" emp_id="<?php echo $user_ID; ?>">
                                        <i class="icon-thumbs-up"></i> <?php echo $minyawn['like']; ?>
                                    </a> 

                                    <a  id="total-dislike<?php echo $minyawn['user_id']; ?>" href="#dislike" is_rated="<?php echo $minyawn['is_job_rated']; ?>"  class="icon-thumbs vote-down" employer-vote="-1" job-id="<?php echo $minyawn['user_to_job'] ?>" user_id="<?php echo $minyawn['user_id']; ?>" action="vote-down"  emp_id="<?php echo $user_ID; ?>">
                                        <i class="icon-thumbs-down"></i> <?php echo $minyawn['dislike']; ?>
                                    </a>

                                </div>
                                <h4> <?php echo $minyawn['profile_name']; ?></h4>

                                <div class="collage"> <?php echo $minyawn['college']; ?> </div>
                                <h4> <?php echo $minyawn['major']; ?></h4>
                                <div class="social-link">
                                    <?php echo $minyawn['user_email']; ?> -<a href="<?php echo $minyawn['linkedin']; ?>" target="_BLANK"> <?php echo $minyawn['linkedin']; ?> </a> 
                                </div>
                                <div id='skills-div' style=' height: 84px;overflow: hidden;'>
                                    <?php
                                    //if (is_array($minyawn['user_skills'])) {
                                    $user_skills = explode(",", $minyawn['user_skills']);
                                    for ($i = 0; $i < sizeof($user_skills); $i++):
                                        ?>
                                        <span class="label label-small"><?php echo $user_skills[$i] ?></span>
                                        <?php
                                    endfor;
                                    // }
                                    ?>
                                </div>
                                <hr>

                                <?php
                                global $minyawn_job;

                                //print_r($minyawn_job->check_minyawn_job_status($minyawn['user_to_job']));
                                // if (is_job_owner(get_user_id(), $minyawn['user_to_job']) != 1) {
                                // } else {
                                if (is_job_owner(get_user_id(), $minyawn['user_to_job']) == 1) { /* if job owner only then show rating OR select minyawns */

                                    /* check job status if 2->hired OR 3 ->requirement comp show rating */
                                    if ($minyawn_job->get_current_date_time() > $minyawn_job->get_job_end_date_time() && $minyawn['user_job_status'] == "hired") {
                                        ?>

                                        <div class='dwn-btn'>
                                            <div class='row-fluid'>
                                                <div class='span6'>
                                                    <a id="vote-up<?php echo $minyawn['user_id']; ?>" class="btn btn-small btn-block  btn-success well-done" href="#like" is_rated="<?php echo $minyawn['is_job_rated']; ?>" employer-vote="1"   job-id="<?php echo $minyawn['user_to_job'] ?>" user_id="<?php echo $minyawn['user_id']; ?>" action="vote-up" emp_id="<?php echo $user_ID; ?>">
                                                        +1 Well Done
                                                    </a> 
                                                </div>
                                                <div class='span6'>
                                                    <a id="vote-down<?php echo $minyawn['user_id']; ?>"  href="#dislike" is_rated="<?php echo $minyawn['is_job_rated']; ?>"  class="btn btn-small btn-block  btn-danger terrible" employer-vote="-1" job-id="<?php echo $minyawn['user_to_job'] ?>" user_id="<?php echo $minyawn['user_id']; ?>" action="vote-down"  emp_id="<?php echo $user_ID; ?>">
                                                        -1 Terrible Job
                                                    </a>
                                                </div> 
                                            </div>
                                        </div>

                                    <?php } elseif ($minyawn['user_job_status'] == "hired" ) {
                                        //&& $minyawn_job->get_current_date_time() > $minyawn_job->get_job_end_date_time()
                                        ?>
                                        <div class="dwn-btn">
                                            <div class="roundedTwo">
                                                
                                                <input type="checkbox" id="roundedTwo<?php echo $minyawn['user_id'] ?>" value="<?php echo $minyawn['user_id'] ?>"  data-user-id="<?php echo $minyawn['user_id'] ?>" data-job-id="<?php echo $minyawn['user_to_job'] ?>"    name="confirm-miny[]"  id="<?php echo $minyawn['user_login'] ?>" <?php if ($minyawn['user_job_status'] == "hired") { ?> checked disabled class="minyans-select" <?php } ?> >
                                                <label for="roundedTwo<?php echo $minyawn['user_id'] ?>"> </label>Minyawn Selected
                                            </div>
                                        </div>
                                        <?php
                                    }elseif($minyawn['user_job_status'] == "applied"  && $minyawn_job->get_current_date_time() > $minyawn_job->get_job_end_date_time()) {
                                        ?>
                               <!-- job expired  -->
                                        
                                    <?php }else {
                                        
                                        if(job_selection_status($minyawn['user_to_job']) != 1){
                                        ?>
                                        <div class="dwn-btn">
                                            <div class="roundedTwo">
                                                <input type="checkbox" id="roundedTwo<?php echo $minyawn['user_id'] ?>" value="<?php echo $minyawn['user_id'] ?>"  data-user-id="<?php echo $minyawn['user_id'] ?>" data-job-id="<?php echo $minyawn['user_to_job'] ?>"    name="confirm-miny[]"  id="<?php echo $minyawn['user_login'] ?>" <?php if ($minyawn['user_job_status'] == "hired") { ?> checked disabled class="minyans-select" <?php } ?> >
                                                <label for="roundedTwo<?php echo $minyawn['user_id'] ?>"> </label>Select This Minyawn
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    }
                                }
                                //}
                                //}
                                ?>


                            </div>

                        </div>

                    </li>
                </a>
            <?php endforeach;
            ?>


        </ul>
    </div>
</form>


<?php 

if(job_selection_status($minyawn['user_to_job']) == 1)
{
    
    
}else if (is_job_owner(get_user_id(), $minyawn['user_to_job']) == 1 &&$minyawn_job->get_current_date_time() < $minyawn_job->get_job_end_date_time()) { ?>
    <span class='load_ajaxconfirm' style="display:none"></span>
    <a href="#confirminyawn" id="confirm-hire" data-toggle="modal" class="btn btn-medium btn-block green-btn btn-success" <?php if (count($minyawn_job->minyawns) == 0) { ?>style="display:none" <?php } ?> >Confirm & Hire</a>

<?php } ?>

