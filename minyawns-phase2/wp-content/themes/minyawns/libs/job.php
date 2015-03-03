<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array('debug' => true));

require '../../../../wp-load.php';


/** Update the profile data */
$app->map('/addjob/', function() use ($app) {

            $requestBody = $app->request()->getBody();  // <- getBody() of http request
            $json_a = json_decode($requestBody, true);

            $postid = ($json_a['id']) > 0 ? $json_a['id'] : '';
            // var_dump($json_a);
//            foreach ($json_a as $key => $value) {
//                if (strstr($key, 'category')) {
//                    var_dump($value);
//                }
//            }
//
//            exit();

            $post = array(
                'ID' => $postid,
                'post_author' => get_current_user_id(), //The user ID number of the author.
                'post_date' => date("Y-m-d H:i:s"), //The time post was made.
                'post_date_gmt' => date("Y-m-d H:i:s"), //The time post was made, in GMT.
                'post_status' => 'publish',
                'post_title' => $json_a['job_task'],
                'post_type' => 'job',
                'post_content' => $json_a['job_details']
            );

            $post_id = wp_insert_post($post);
//$post_id=934;
//print_r($json_a);exit();
            foreach ($json_a as $key => $value) {

                if ($key == 'job_tags') {
                    $tags = explode(",", $value);

                    if (isset($postid))
                        wp_delete_object_term_relationships($postid, 'job_tags');

                    for ($i = 0; $i < count($tags); $i++) {
                        wp_set_post_terms($post_id, $tags[$i], 'job_tags', true);
                    }
                } elseif ($key == "job_start_date") {
                    $start = $value;
                    $end = $value;
                    update_post_meta($post_id, $key, strtotime(str_replace(',', ' ', $value)));
                    update_post_meta($post_id, 'job_end_date', strtotime(str_replace(',', ' ', $value)));
                } elseif ($key == "job_start_time") {

                    update_post_meta($post_id, $key, strtotime($value));
                    update_post_meta($post_id, 'job_start_date_time', strtotime(date("j-m-Y", strtotime(str_replace(',', ' ', $start))) . $value));
                } elseif ($key == "job_end_time") {

                    $date = date("j-m-Y ", strtotime($end));

                    update_post_meta($post_id, $key, strtotime($value));

                    update_post_meta($post_id, 'job_end_date_time', strtotime(date("j-m-Y", strtotime(str_replace(',', ' ', $start))) . $value));
                } elseif ($key !== 'job_details' && $key !== "job_end_date") {
                    update_post_meta($post_id, $key, $value);
                }

                if (strstr($key, 'category')) {
                    $categories[] = intval($value);
                }
            }

            wp_set_object_terms($post_id, $categories,'job_category');


            $app->response()->header("Content-Type", "application/json");
            echo json_encode(array('post_slug' => get_permalink($post_id)));
        })->via('GET', 'POST', 'PUT', 'DELETE'); 

 

$app->get('/fetchjobs/', function() use ($app) {

            global $post, $wpdb;
            $prefix = $wpdb->prefix;
            $data = array();
            $current_user_id = get_current_user_id();
            $category_filter = "";
            $filtertables = "";
            /* Category filter */
            
            $logged_in_user_id = $_GET['logged_in_user_id'];

            if (isset($_GET['filter'])) {
                $category_filter = "AND $wpdb->posts.ID = $wpdb->term_relationships.object_id
                            AND $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id AND $wpdb->term_taxonomy.term_id IN (" . $_GET['filter'] . ")";
                $filtertables = "," . "$wpdb->term_relationships,$wpdb->term_taxonomy";
            }

            if (isset($_GET['my_jobs']))
                $sort_value="DESC";
            else
                $sort_value="ASC";


            if (isset($_GET['my_jobs'])) {
                 $url=$_SERVER['HTTP_REFERER'];
                 $user_id=is_numeric(basename($url)) === true ? basename($url) : get_current_user_id(); //via a link or direct view profile
                 $user = new WP_User($user_id);

                 $additional_filter=is_numeric(basename($url)) === true ? "AND status='hired'" : '';
                
                if ($user->roles[0] == 'minyawn') {
                    $tables = "$wpdb->posts,$wpdb->postmeta,{$wpdb->prefix}userjobs";
                    $my_jobs_filter = "WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND {$wpdb->prefix}userjobs.user_id= '" . $user_id . "' AND {$wpdb->prefix}userjobs.job_id=$wpdb->posts.ID ".$additional_filter."";
                    $limit = "LIMIT " . $_GET['offset'] . ",5";
                    $order_by = "AND $wpdb->postmeta.meta_key = 'job_start_date' 
                            ORDER BY $wpdb->postmeta.meta_value $sort_value";
                } else {
                    //AND $wpdb->postmeta.meta_value >= '" . current_time('timestamp') . "'
                    $tables = "$wpdb->posts,$wpdb->postmeta";
                    $my_jobs_filter = "WHERE $wpdb->posts.post_author= '" . $user_id . "' AND $wpdb->posts.ID = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_start_date' ";
                    $limit = "LIMIT " . $_GET['offset'] . ",5";
                    $order_by = "AND $wpdb->postmeta.meta_key = 'job_start_date' 
                            ORDER BY $wpdb->postmeta.meta_value $sort_value";
                }
            } else {
                if (isset($_GET['single_job'])) {
                    $tables = "$wpdb->posts, $wpdb->postmeta";
                    $my_jobs_filter = "WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_start_date' AND $wpdb->posts.ID ='" . $_GET['single_job'] . "' ";
                    $order_by = "AND $wpdb->postmeta.meta_key = 'job_start_date' 
                            ORDER BY $wpdb->postmeta.meta_value ASC";
                    $limit = "";
                } else {
                    //AND $wpdb->postmeta.meta_value >= '" . current_time('timestamp') . "'
                    $tables = "$wpdb->posts, $wpdb->postmeta";
                    $my_jobs_filter = "WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_end_date_time' 
                            AND $wpdb->postmeta.meta_value >= '" . current_time('timestamp') . "'";
                    $order_by = "AND $wpdb->postmeta.meta_key = 'job_end_date_time' 
                            ORDER BY $wpdb->postmeta.meta_value $sort_value";
                    $limit = "LIMIT " . $_GET['offset'] . ",5";
                }
            }

           $querystr = "
                            SELECT DISTINCT $wpdb->posts.* 
                            FROM $tables" . "$filtertables
                            $my_jobs_filter
                            $category_filter
                            AND $wpdb->posts.post_status = 'publish' 
                            AND $wpdb->posts.post_type = 'job'
                            $order_by
                            $limit
                         ";
        /*$querystr = "
               SELECT DISTINCT $wpdb->posts.*
               FROM $tables" . "$filtertables
               $my_jobs_filter
               $category_filter
               AND $wpdb->posts.post_status = 'publish'
               AND $wpdb->posts.post_type = 'job'
               $order_by

            ";*/
$pageposts = $wpdb->get_results($querystr, OBJECT);

$total = get_total_jobs();

$no_of_pages = ceil($total / 5);

$has_more_results = 0;

foreach ($pageposts as $pagepost) {

   $owner_id = is_job_owner(get_user_id(), $pagepost->ID); /* returns the job owner id if set else 0 */

                $tags = wp_get_post_terms($pagepost->ID, 'job_tags', array("fields" => "names"));

                $post_meta = get_post_meta($pagepost->ID);

                $min_job = new Minyawn_Job($pagepost->ID);

                //$minyawns_have_applied = $min_job->get_applied_by();
                $user_data = array();

                $user_image = array();

                $user_job_status = array();

                $user_id_applied = array();

                $user_rating_like = array();

                $user_rating_dislike = array();

                $default_applied_user_avatar = array();

                $single_job_rating = array();

                $minyawns_verified = array();

                $user_rating_job = array();

                $count_hired = 0;
                $count_applied = 0;
                $count_rated = 0;

                //commented on 13may2014 $object_id = get_object_id(get_current_user_id(), $pagepost->ID);
                $object_id = get_object_id($logged_in_user_id, $pagepost->ID);
       
                foreach ($object_id as $object_post_id) {

                    $defaults = array(
                        'post_id' => $object_id->id,
                    );
                }
                $all_comment = get_comments($defaults);
              
                $comment = $all_comment[0]->comment_content;


                foreach ($min_job->minyawns as $min) {

                    $user = array_push($user_data, $min['first_name'] . ' ' . $min['last_name']);

                    $user_profileimage = array_push($user_image, get_user_company_logo($min['user_id']));

                    $applied_user_id = array_push($user_id_applied, $min['user_id']);

                    $status = array_push($user_job_status, $min['user_job_status']);

                    $rating = array_push($single_job_rating, $min['user_job_rating']);

                    $minyawns_rating = get_user_rating_data($min['user_id'], $pagepost->ID);

                    $verified = get_user_meta($min['user_id'], 'user_verified');

                    array_push($minyawns_verified, $verified);


                    foreach ($minyawns_rating as $rating) {
                        $user_rating = array_push($user_rating_like, $rating->positive);
                        $user_dislike = array_push($user_rating_dislike, $rating->negative);
                        //$user['dislike'] = $rating->negative;

                        if ($user['like'] != "0" || $user['dislike'] != "0")
                            $user['is_job_rated'] = 1;
                        else
                            $user['is_job_rated'] = 0;
                    }



                    /* getting rating for a single job   */
                    $user_to_job_rating = get_user_job_rating_data($min['user_id'], $pagepost->ID);

                    if ($user_to_job_rating->positive > 0) {
                        array_push($user_rating_job, ($user_to_job_rating->positive) > 0 ? 'Well Done' : 'Rating:Awaited');
                        $count_rated = $count_rated + 1;
                    } elseif ($user_to_job_rating->negative > 0) {
                        array_push($user_rating_job, ($user_to_job_rating->negative) > 0 ? 'Terrible' : 'Rating:Awaited');
                        $count_rated = $count_rated + 1;
                    } else {
                        array_push($user_rating_job, 'Rating:Awaited');
                    }

                    if ($user_to_job_rating->status == 'applied') {
                        $status = 'Applied';
                        $count_applied = $count_applied + 1;
                    } else {
                        $status = 'Hired';
                        $count_hired = $count_hired + 1;
                    }
                }

                $job_status = $min_job->check_minyawn_job_status($pagepost->ID, $min['user_id']);


                // $total = get_total_jobs();

                if ($total <= $_GET['offset'] + 5)
                    $show_load = 1;
                else
                    $show_load = 0;


                if (strlen($_GET['single_job']) > 0) /* pagination issue */
                    $show_load = 1;

                if (get_user_company_logo($pagepost->post_author) == false)
                    $logo = get_avatar($pagepost->post_author, 168);
                else
                    $logo = get_user_company_logo($pagepost->post_author);


                if (get_user_role() !== 'employer' || $owner_id === 0) {

                    $wages_seen = (10 * $post_meta['job_wages'][0]) / 100;
                    $wages = $post_meta['job_wages'][0] - $wages_seen;
                } else {
                    //      $wages_seen = (13 * $post_meta['job_wages'][0]) / 100;
                    $wages = $post_meta['job_wages'][0];
                }
                $categories = array();
                $category_ids = array();
                $post_categories =  wp_get_object_terms($pagepost->ID,'job_category');
                foreach ($post_categories as $job_categories) {
                    array_push($categories, $job_categories->name);
                    array_push($category_ids, $job_categories->term_id);
                    array_push($category_slug, $job_categories->slug);
                }

                if (isset($_GET['single_job']))
                    $post_content = $pagepost->post_content;
                else
                    $post_content = $pagepost->post_content;



                $difference = strtotime(date('d M Y', $post_meta['job_start_date'][0])) - strtotime(date('d M Y'));
                if ($count_hired == $count_rated) {
                    $final_count = 1;
                } else {
                    $final_count = 0;
                }

                $company_details = get_user_meta(get_the_author_meta('ID', $pagepost->post_author));


                /*
                 *  1 ->running
                 *  2->locked ,if one applicant also hired then locked
                 */
                $data[] = array(

                    'event_start' => date('d-m-Y H:i:s', $post_meta['job_start_date_time'][0]),
                    'event_end' => date('d-m-Y H:i:s', $post_meta['job_end_date_time'][0]),
                    'job_author_email' => get_the_author_meta('user_email', $pagepost->post_author),
                    'post_date' => date('d M Y', strtotime($pagepost->post_date)),
                    'post_title' => $pagepost->post_title,
                    'post_id' => $pagepost->ID,
                    'job_start_date' => date('d M Y', $post_meta['job_start_date'][0]),
                    'job_end_date' => date('d M Y', $post_meta['job_end_date'][0]),
                    'job_day' => date('l', $post_meta['job_start_date'][0]),
                    'job_wages' => $wages,
                    //'job_progress' => 'available',
                    'job_start_day' => date('d', $post_meta['job_start_date'][0]),
                    'job_start_month' => substr(date('F', $post_meta['job_start_date'][0]),0,3),
                    'job_start_year' => date('Y', $post_meta['job_start_date'][0]),
                    'job_start_meridiem' => date('a', $post_meta['job_start_time'][0]),
                    'job_end_meridiem' => date('a', $post_meta['job_end_time'][0]),
                    'job_start_time' => date('g:i', $post_meta['job_start_time'][0]),
                    'job_end_time' => date('g:i', $post_meta['job_end_time'][0]),
                    'job_location' => $post_meta['job_location'][0],
                    'job_details' => strlen($post_content) >0 ? $post_content:'Details of the Employer not available',
                    'tags' => $tags,
                    //'tags_count' => sizeof($tags),
                    'job_author' => get_the_author_meta('first_name', $pagepost->post_author) . ' ' . get_the_author_meta('last_name', $pagepost->post_author),
                    'job_author_id' => get_the_author_meta('ID', $pagepost->post_author),
                    'job_company' => $company_details['company_name'][0],
                    'job_company_location' => $company_details['location'][0],
                    'job_author_logo' => $logo,
                    'job_status' => $job_status,
                    'user_to_job_status' => $user_job_status,
                    //'user_job_status' => is_null($min_job->is_hired) ? $min_job->is_hired : 'can_apply',
                    //'job_start_date_time' => $post_meta['job_start_date'][0],
                    //'job_end_time_check' => $post_meta['job_start_date_time'][0],
                    'job_end_date_time_check' => $post_meta['job_end_date_time'][0],
                    'job_start_date_time_check' => $post_meta['job_start_date_time'][0],
                    'todays_date_time' => current_time('timestamp'),
                    'post_slug' => wp_unique_post_slug($pagepost->post_name, $pagepost->ID, 'published', 'job', ''),
                    'users_applied' => isset($user_data) ? $user_data : array(),
                    'load_more' => $show_load,
                    'user_profile_image' => $user_image,
                    'user_rating_like' => $user_rating_like,
                    'user_rating_dislike' => $user_rating_dislike,
                    'default_user_avatar' => get_avatar($pagepost->ID),
                    'job_owner_id' => $owner_id,
                    'applied_user_id' => $user_id_applied,
                    'user_to_job_rating' => $user_rating_job,
                    'individual_user_to_job_status' => $status,
                    'total' => $total,
                    'job_categories' => $categories,
                    'job_category_ids' => $category_ids,
                    'job_category_slug' => $category_slug,
                    'is_verfied' => $minyawns_verified,
                    'required_minyawns' => $post_meta['job_required_minyawns'][0],
                    'days_to_job_expired' => round($difference / 86400),
                    'no_applied' => $count_applied,
                    'no_hired' => $count_hired,
                    'count_rated' => $final_count,
                    'comment' => strlen($comment) > 0 ? $comment : '',
                );
            }

            $app->response()->header("Content-Type", "application/json");
            echo json_encode($data);
        });

$app->map('/fetchjobscalendar/', function() use ($app) {
            global $post, $wpdb;
            $prefix = $wpdb->prefix;
// AND $wpdb->postmeta.meta_key = 'job_start_date' 
            //AND $wpdb->postmeta.meta_value <= '" . current_time('timestamp') . "' 

            $current_user_id = get_current_user_id();
            if (isset($_GET['my_jobs'])) {
                $tables = "$wpdb->posts, $wpdb->postmeta,{$wpdb->prefix}userjobs";
                $my_jobs_filter = "WHERE $wpdb->posts.post_author = $current_user_id  AND $wpdb->posts.ID = {$wpdb->prefix}userjobs.job_id AND {$wpdb->prefix}userjobs.job_id = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_start_date'";
            } else {
                $tables = "$wpdb->posts, $wpdb->postmeta";
                $my_jobs_filter = "WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_start_date' 
                            AND $wpdb->postmeta.meta_value >= '" . strtotime(date('1-m-Y', strtotime('this month'))) . "'";
                //AND $wpdb->postmeta.meta_value >= '" . current_time('timestamp') . "'
            }

            $querystr = "
                            SELECT $wpdb->posts.* 
                            FROM $tables
                            $my_jobs_filter
                            AND $wpdb->posts.post_status = 'publish' 
                            AND $wpdb->posts.post_type = 'job'
                            ORDER BY $wpdb->posts.ID DESC
                            
                         ";


            $data = array();
            $data['events'][] = array();
            $attendes = array();
            $emails = array();
            $gmtTimezone = new DateTimeZone('IST');
            $pageposts = $wpdb->get_results($querystr, OBJECT);
            $cnt = count($pageposts);
            foreach ($pageposts as $pagepost) {
                $min_job = new Minyawn_Job($pagepost->ID);
                $applied = $min_job->check_minyawn_job_status($pagepost->ID);

                $tags = wp_get_post_terms($pagepost->ID, 'job_tags', array("fields" => "names"));
                //print_r(implode(",",$tags));exit();
                $post_meta = get_post_meta($pagepost->ID);

                $fullday = 0;

                $location = isset($post_meta['job_location'][0]) ? $post_meta['job_location'][0] : '';
                $tags = implode(",", $tags);
                $wages = isset($post_meta['job_wages'][0]) ? $post_meta['job_wages'][0] : '';
                $details = isset($pagepost->post_content) ? $pagepost->post_content : '';
                $apply = true;
                $logo = get_avatar($pagepost->post_author, '10');

                // print_r($post_meta['job_start_date_time'][0]);exit();
                $st = date('d M Y H:i:s', $post_meta['job_start_date_time'][0]);
                $et = date('d M Y H:i:s', $post_meta['job_end_date_time'][0]);
                //$et='';
                $role = get_user_role($current_user_id);
                $data['events'][] = array(
                    $pagepost->ID,
                    $pagepost->post_name,
                    $st,
                    $et,
                    $fullday,
                    0, //more than one day event
                    0, //Recurring event
                    rand(-1, 13),
                    0, //editable,
                    $location, //location
                    $tags, //attends
                    $details,
                    $wages,
                    $apply,
                    $logo,
                    $role,
                    $applied,
                );
            }
            //$app->response()->header("Content-Type", "application/json");
            echo json_encode($data);
        })->via('GET', 'POST', 'PUT', 'DELETE');

$app->map('/confirm', function() use ($app) {

            global $wpdb;
            $paypal_minyawns_hired = "";
            $split_user = explode("-", $_POST['status']);
            for ($i = 0; $i < sizeof($split_user); $i++) {
                $split_status = explode(",", $split_user[$i]);
                // for ($j = 0; $j < sizeof($split_status); $j++) {

                /* $wpdb->get_results(
                  "
                  UPDATE {$wpdb->prefix}userjobs
                  SET status = '" . $split_status[1] . "'
                  WHERE user_id = '" . $split_status[0] . "'
                  AND job_id = '" . $_POST['job_id'] . "'
                  "
                  ); */
                if ($split_status[0] != "") {
                    if ($i > 0)
                        $paypal_minyawns_hired.= ",";

                    $paypal_minyawns_hired.=$split_status[0];
                }
                // }
            }


            /* aded on 1sep2013 */
            $salt_job = wp_generate_password(20); // 20 character "random" string
            $key_job = sha1($salt . $_POST['job_id'] . uniqid(time(), true));

            $paypal_payment = array('minyawn_txn_id' => $key_job, 'paypal_txn_id' => '', 'status' => '', 'minyawns_selected' => $paypal_minyawns_hired);
            add_post_meta($_POST['job_id'], 'paypal_payment', $paypal_payment);

            $total_wages = trim($_POST['jobwages']);
            $returnUrl = $_POST['returnUrl'];
            $cancelUrl = $_POST['cancelUrl'];
            $html.='<form class="paypal" action="' . site_url() . '/paypal-payments/" method="post" id="paypal_form" target="_self">
				<input type="hidden" name="cmd" value="_xclick" />
			    <input type="hidden" name="no_note" value="1" />
            	<input type="hidden" name="custom" value="' . $key_job . '" />
			    <input type="hidden" name="lc" value="UK" />			   
			    <input type="hidden" name="amount" value="' . $total_wages . '" />
			    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" /> 
			    <input type="hidden" name="first_name" value="Customer  First Name"  />
			    <input type="hidden" name="last_name" value="Customer  Last Name"  />			    
			    <input type="hidden" name="item_number" value="' . $_POST['job_id'] . '" / >
			    <input type="hidden" name="item_name" value="' . get_the_title($_POST['job_id']) . '" / >			   
            	<input type="submit" id="submitBtn" value=" " style="margin:auto; width:140px; height:47px; border:none; display:block;background-image:url(\'https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif\');" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif">
           	</form>
           	';
            echo json_encode(array('user_ids' => $_POST['user_id'], 'content' => $html, 'inc' => $inc));

            /* end added on 1sep2013 */
        })->via('GET', 'POST', 'PUT', 'DELETE');;


$app->map('/user-vote', function() use ($app) {
            $time = current_time('timestamp');
            global $wpdb;
//            print_r($_POST);
//            exit();



            $wpdb->get_results(
                    "
	UPDATE {$wpdb->prefix}userjobs 
	SET rating = '" . trim($_POST['rating']) . "'
	WHERE user_id = '" . trim($_POST['user_id']) . "' 
		AND job_id = '" . trim($_POST['job_id']) . "' AND status = 'hired'
	"
            );

            $id_sql = $wpdb->prepare("SELECT id from {$wpdb->prefix}userjobs  WHERE user_id = '" . trim($_POST['user_id']) . "' 
		AND job_id = '" . trim($_POST['job_id']) . "' AND status = 'hired' ");

            $last_id = $wpdb->get_row($id_sql);

            if (strlen($_POST['review']) > 0) {
                $data = array(
                    'comment_post_ID' => $last_id->id,
                    'comment_content' => trim($_POST['review']),
                    'comment_type' => 'review',
                    'comment_parent' => 0,
                    'user_id' => trim($_POST['emp_id']),
                    'comment_author_IP' => '127.0.0.1',
                    'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
                    'comment_date' => $time,
                    'comment_approved' => 1,
                );
            }
            wp_insert_comment($data);






            /* to calculate total ratings */
            $sql = $wpdb->prepare("SELECT {$wpdb->prefix}userjobs.user_id,{$wpdb->prefix}userjobs.job_id, SUM( if( rating =1, 1, 0 ) ) AS positive, SUM( if( rating = -1, 1, 0 ) ) AS negative
                              FROM {$wpdb->prefix}userjobs
                              WHERE {$wpdb->prefix}userjobs.user_id = %d AND {$wpdb->prefix}userjobs.job_id
                              GROUP BY {$wpdb->prefix}userjobs.user_id", $_POST['user_id'], $_POST['job_id']);

            $minyawns_rating = $wpdb->get_row($sql);


            $user_rating = $minyawns_rating->positive;
            $user_dislike = $minyawns_rating->negative;
            //$user['dislike'] = $rating->negative;
            //get  emplyer details
            $emp_data = get_userdata($_POST['emp_id']);
            $emp_name = ucfirst($emp_data->display_name);


            //get minyawns details
            $min_data = get_userdata($_POST['user_id']);
            $min_name = ucfirst($min_data->display_name);
            $min_email = $min_data->user_email;




            if ($_POST['action'] == "vote-up") {
                $like_count = $user_rating;
                $mail_subject = "Minyawns - You have received a Thumbs Up. ";
                $mail_message = "Hi <a href='" . site_url() . "/profile/" . $_POST['user_id'] . "'>" . $min_name . "</a>,<br/><br/> 
            			Congratulations, <br/><br/>

            			You have received Thumbs Up from <a href='" . site_url() . "/profile/" . $_POST['emp_id'] . "'>" . $emp_name . "</a><br/>
            			Great Job! Keep it up.		<br/><br/>
            			To visit Minyawns site, <a href='" . site_url() . "/'>Click here</a>. <br/><br/<br/>
            			
            			";
            } else {
                $like_count = $user_dislike;
                $mail_subject = "Minyawns - You have received Thumbs Down. ";
                $mail_message = "Hi <a href='" . site_url() . "/profile/" . $_POST['user_id'] . "'>" . $min_name . "</a>,<br/><br/>            			
            			You have received Thumbs Down from  <a href='" . site_url() . "/profile/" . $_POST['emp_id'] . "'>" . $emp_name . "</a><br/>
            			Put little more efforts to receive Thumbs Up.<br/><br/>
            			To visit Minyawns site, <a href='" . site_url() . "/'>Click here</a>. <br/><br/<br/>          			
            			
            			";
            }



            //send mail to minyawn for vote-up & vote down
            add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
            $headers = 'From: Minyawns <support@minyawns.com>' . "\r\n";
            wp_mail($min_email, $mail_subject, email_header() . $mail_message . email_signature(), $headers);





            echo json_encode(array('action' => $_POST['action'], 'rating' => $like_count, 'rating_negative'=>$user_dislike,  'user_id' => $_POST['user_id'], 'review' => $_POST['review']));
        })->via('GET', 'POST', 'PUT', 'DELETE');;

$app->get('/jobminions/', function() use ($app) {
            global $post, $wpdb;
            global $minyawn_job;

            $minion_ids = explode(',', $_GET['minion_id']);
            if (strlen(($_GET['minion_id'])) > 0) {
                for ($i = 0; $i < sizeof($minion_ids); $i++) {
                    $all_meta_for_user = get_user_meta($minion_ids[$i]);
                    $all_meta_for_user = array_map(function( $a ) {
                                return $a[0];
                            }, get_user_meta($minion_ids[$i]));


                    $minyawns_rating = get_user_rating_data($minion_ids[$i], $_GET['job_id']);
                    foreach ($minyawns_rating as $rating) {
                        $user_rating = $rating->positive;
                        $user_dislike = $rating->negative;
                    }


                    $user['image'] = "<img alt='' src='" . wp_get_attachment_thumb_url($all_meta_for_user['avatar_attachment']) . "' height='96' width='96'>";
                    if (!wp_get_attachment_thumb_url($all_meta_for_user['avatar_attachment']))
                        $user['image'] = get_avatar($all_meta_for_user['user_email']);


                    $object_id = get_object_id($minion_ids[$i], $_GET['job_id']);
//                    print_r($object_id);exit();
                    foreach ($object_id as $object_post_id) {

                        $defaults = array(
                            'post_id' => $object_id->id,
                        );
                    }
                    $all_comment = get_comments($defaults);
                    $comment = $all_comment[0]->comment_content;


                    $user_to_job_rating = get_user_job_rating_data($minion_ids[$i], $_GET['job_id']);

                    $rating = ($user_to_job_rating->positive) > 0 ? 'Well Done' : 0;
                    if ($user_to_job_rating->positive > 0) {
                        $rating = 'Well Done';

                        $count_rated = $count_rated + 1;
                    } else {
                        $rating = 0;
                    }
                    if ($user_to_job_rating->negative < 0) {
                        $rating = 'Terrible';

                        $count_rated = $count_rated + 1;
                    } else {
                        $rating = 0;
                    }

                    $is_invited = get_current_job_status($_GET['job_id'], $minion_ids[$i]);

$user_email=get_userdata($minion_ids[$i]);
                    $data[] = array(
                        'user_id' => $minion_ids[$i],
                        'name' => $all_meta_for_user['first_name'] . ' ' . $all_meta_for_user['last_name'],
                        'college' => isset($all_meta_for_user['college']) ? $all_meta_for_user['college'] : '',
                        'major' => isset($all_meta_for_user['major']) ? $all_meta_for_user['major'] : '',
                        'user_skills' => isset($all_meta_for_user['user_skills']) ? $all_meta_for_user['user_skills'] : '',
                        'linkedin' => isset($all_meta_for_user['linkedin']) ? preg_replace('#^http?://#', '', rtrim($all_meta_for_user['linkedin'], '/')) : '',
                        'facebook_link' => isset($all_meta_for_user['facebook_link']) ? preg_replace('#^http?://#', '', rtrim($all_meta_for_user['facebook_link'], '/')) : '',
                        'user_email' =>$user_email->user_email, /* nick name temp fix */
                        'rating_positive' => $user_rating,
                        'rating_negative' => $user_dislike,
                        'user_image' => $user['image'],
                        'user_to_job_rating_like' => $user_to_job_rating->positive,
                        'user_to_job_rating_dislike' => $user_to_job_rating->negative,
                        'comment' => isset($comment) > 0 ? $comment : 0,
                        'is_verified' => isset($all_meta_for_user['user_verified']) ? $all_meta_for_user['user_verified'] : '',
                        'is_hired' => minyawns_hired_to_jobs($minion_ids[$i], $_GET['job_id']),
                        'count_rated' => $count_rated,
                        'is_invited' => $is_invited
                    );
                }
            }
            else
                $data = array();


            $app->response()->header("Content-Type", "application/json");
            echo json_encode($data);
        });

$app->get('/getcomments/', function() use ($app) {
            global $post, $wpdb;
            global $minyawn_job;
            $negative = array();
            $negative_title = array();
            $positive = array();
            $positive_title = array();

            $object_id = get_object_id($_GET['minion_id'], '', 1);

            foreach ($object_id as $objid) {

                if ($objid->rating < 0) {
                    $defaults = array(
                        'post_id' => $objid->id,
                    );

                    $comments = get_comments($defaults);

                    $negative[] = isset($comments[0]->comment_content) > 0 ? $comments[0]->comment_content : '';
                    $negative_jobs[] = isset($objid->post_title) > 0 ? $objid->post_title : '';
                } else if ($objid->rating > 0) {
                    $defaults = array(
                        'post_id' => $objid->id,
                    );
                    $comments = get_comments($defaults);

                    $positive[] = isset($comments[0]->comment_content) > 0 ? $comments[0]->comment_content : '';
                    $positive_jobs[] = isset($objid->post_title) > 0 ? $objid->post_title : '';
                }

                $data = array(
                    //'comment_content' => $comment['0']->comment_content,
                    'negative' => isset($negative) > 0 ? $negative : 0,
                    'negative_title' => isset($negative_jobs) > 0 ? $negative_jobs : 0,
                    'positive_title' => isset($positive_jobs) > 0 ? $positive_jobs : 0,
                    'positive' => isset($positive) > 0 ? $positive : 0,
                );
            }

            foreach ($all_comments as $comment) {
                $data = array(
                    'comment_content' => $comment['0']->comment_content
                );
            }
            $app->response()->header("Content-Type", "application/json");
            echo json_encode($data);
        });

$app->map('/delete-job/', function() use($app) {

            global $wpdb;

            // exit();
            wp_delete_post($_POST['job_id'], true);

            delete_post_meta($_POST['job_id']);


            $wpdb->query($wpdb->prepare(
                            "
                DELETE FROM {$wpdb->prefix}userjobs WHERE job_id = '" . $_POST['job_id'] . "'"));


            echo "deleted";
        })->via('GET', 'POST', 'PUT', 'DELETE');;

$app->map('/reloadtags', function() use($app) {


            echo '<input  name="job_tags" id="job_tags" value="asdasd,asdssssasd,asdasd,asdasdddd" placeholder="Tags here" class="tm-input tagsinput_jobs">';
        })->via('GET', 'POST', 'PUT', 'DELETE');;


$app->get('/invitejobs', function () use ($app) {

            global $wpdb;
            $requestBody = $app->request()->getBody();  // <- getBody() of http reques
            $json_a = json_decode($requestBody, true);


            //PLEASE CHANGE THE < TO  >
            //first we find jobs which are not expired
            $data = get_activejobs(0);

            $app->response()->header("Content-Type", "application/json");
            echo json_encode($data);
        });

$app->map('/inviteminions', function() use($app) {
            global $wpdb;

            $status = send_invite($_POST['job_id'], $_POST['user_id']);

            $data = get_activejobs(1);

            // $user_meta = get_user_meta($_POST['user_id']);
            //print_r($user_meta);exit();
            $email = get_userdata($_POST['user_id']);
          $emailid=$email->user_email;
            $data_mail = array(
                'content' => get_the_content($_POST['job_id']),
                'wages' => get_post_meta($_POST['job_id'], 'job_wages', true),
                'time' => date('g:i', get_post_meta($_POST['job_id'], 'job_start_time', true)),
                'date' => date('d M Y', get_post_meta($_POST['job_id'], 'job_start_date', true)),
                'slug' => preg_replace('/[[:space:]]+/', '-', get_the_title($_POST['job_id']))
            );

            //date('g:i', $post_meta['job_start_time'][0]),
            $mail = email_template($emailid, $data_mail, 'invite_minion');
          
            $headers = 'From: Minyawns support@minyawns.com' . "\r\n";
            $headers .= "MIME-Version: 1.0\n" .
                    "From: Minyawns support@minyawns.com\n" .
                    "Content-Type: text/html; charset=\"" . "\"\n";


            wp_mail($emailid, $mail['subject'], $mail['hhtml'] . $mail['message'] . $mail['fhtml'], $headers);

            $requestBody = $app->request()->getBody();  // <- getBody() of http reques
            $json_a = json_decode($requestBody, true);

            $app->response()->header("Content-Type", "application/json");
            echo json_encode($data);
        })->via('GET', 'POST', 'PUT', 'DELETE');


$app->run();

function send_invite($jobid, $userid) {
    global $wpdb;

    $myrows = $wpdb->get_results("SELECT * FROM userinvites where user_id={$userid} AND job_id={$jobid}");

    if (count($myrows) == '0') {
        $table = 'userinvites';
        $data = array(
            'user_id' => $userid,
            'job_id' => $jobid
        );


        $wpdb->replace($table, $data);

        $status = true;
    } else {
        $status = false;
    }

    return $status;
}

function get_current_job_status($job_id, $user_id) {

    global $wpdb;

    $applied_sql = "select * from userinvites where job_id='" . $job_id . "' AND user_id='" . $user_id . "'";

    $jobids = $wpdb->get_results($applied_sql, OBJECT);

    if (count($jobids) > 0) {

        return 4; //invited
    } else {
        return 0;
    }
}

function get_activejobs($flag) {
    global $wpdb;

    $user_id = strlen($_GET['user_id']) > 0 ? $_GET['user_id'] : $_POST['user_id'];


    $tables = "$wpdb->posts, $wpdb->postmeta";

    if ($flag == 1)
        $fromFilter = "AND $wpdb->posts.ID='" . $_POST['job_id'] . "'";
    else
        $fromFilter = "AND $wpdb->posts.post_author='" . $_GET['employer_id'] . "'";


    $my_jobs_filter = "WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key = 'job_end_date_time' 
                            AND $wpdb->postmeta.meta_value > '" . current_time('timestamp') . "' " . $fromFilter . "";
    $order_by = "AND $wpdb->postmeta.meta_key = 'job_end_date_time' 
                            ORDER BY $wpdb->postmeta.meta_value ASC";


    $querystr = "
                            SELECT DISTINCT $wpdb->posts.* 
                            FROM $tables" . "$filtertables
                            $my_jobs_filter
                            $category_filter
                            AND $wpdb->posts.post_status = 'publish' 
                            AND $wpdb->posts.post_type = 'job'
                            $order_by
                           
                         ";

    $jobids = $wpdb->get_results($querystr, OBJECT);
    //using these ids we will get the status invited/applied/hired

    foreach ($jobids as $jobid) {



        $min_job = new Minyawn_Job($jobid->ID);
        $is_job_available =$min_job->check_minyawn_job_status($jobid->ID);

        if ($is_job_available === 1) {

            $job_status = $min_job->check_minyawn_job_status_invite($jobid->ID, $user_id);

            if ($job_status == 0)
                $job_status = get_current_job_status($jobid->ID, $user_id);


            $post_meta = get_post_meta($jobid->ID);

            if ($job_status == 0 || $job_status == 1 || $job_status == 4) {
                $data[] = array(
                    'job_title' => $jobid->post_title,
                    'job_start_date' => date('d M Y', $post_meta['job_start_date'][0]),
                    'job_user_status' => $job_status,
                    'job_id' => $jobid->ID,
                    'minyawn_id' => $user_id
                );
            }
        }
    }

    return $data;
}