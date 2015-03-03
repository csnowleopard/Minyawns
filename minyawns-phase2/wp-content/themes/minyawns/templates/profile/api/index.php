<?php

require '../../../libs/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array('debug' => true));

//require '../../../../../../wp-includes/wp-db.php';
require '../../../../../../wp-load.php';
global $wpdb;
global $wp_roles;
$app->post('/users', function () use ($app) {

            global $wpdb;
            $user_avatar = array('avatar_check' => '');
            if ($_GET['action'] == "fetch") {

                /* user meta except skills */
                $user_data = get_userdata($_GET['user_id']);  // fetch user data
                $user_meta = get_user_meta($_GET['user_id']); // fetch user meta
                // $user_skills=get_user_meta(trim($_GET['user_id']),'user_skills',FALSE);  /* user meta skils*/
                $user_role = mn_get_current_user_role($_GET['user_id']);

                
                $user_data = array(
                    'email' => $user_data->user_email,
                );

                if ($user_role == "minyawn") { /* if role is a author */
                    if (!is_array($user_meta['user_skills']))
                        $user_meta['user_skills'] = array();


                    $meta_array = array(
                        'college' => $user_meta['college'][0],
                        'first_name' => $user_meta['first_name'][0],
                        'last_name' => $user_meta['last_name'][0],
                        'major' => $user_meta['major'][0],
                        'url' => $user_meta['url'][0],
                        'user_skills' => $user_meta['user_skills'],
                        'user_id' => $_GET['user_id'],
                        'user_role' => $user_role
                    );
                }else {/* if role is a subscriber */
                    $meta_array = array(
                        'industry' => $user_meta['industry'][0],
                        'location' => $user_meta['location'][0],
                        'company_website' => $user_meta['company_website'][0],
                        'body' => $user_meta['body'][0],
                        'user_id' => $_GET['user_id'],
                        'user_role' => $user_role
                    );
                }
                if (is_array($user_meta['facebook_uid'])) {
                    $user_avatar = array(
                        'avatar_check' => $user_meta['facebook_uid'][0]
                    );
                }

                $data = array_merge($user_data, $meta_array, $user_avatar); //merge the two to send via json array
            } else {
                foreach ($_GET as $key => $values) {

                    delete_user_meta($_GET['current_user'], $key);
                    if ($key == "user_skills") {

                        $skill_values = split(',', $values);
                        for ($val = 0; $val < sizeof($skill_values); $val++) {

                            add_user_meta($_GET['current_user'], 'user_skills', trim($skill_values[$val]));
                        }
                    } else {
                        if (!empty($values))
                            update_user_meta($_GET['current_user'], $key, trim($values));
                    }
                }
                $data = array(); /* blank since the above condition is called when MY profile loads */
            }

            $app->response()->header("Content-Type", "application/json");
            echo json_encode(array('data' => $data, 'status' => "success"));
        });

$app->get('/logout', function () use ($app) {


            wp_logout();
            wp_redirect(home_url());
        });



$app->POST('/change_avatar', function() use($app) {
            delete_user_meta($_POST['user_id'], 'facebook_avatar_thumb');
            delete_user_meta($_POST['user_id'], 'facebook_avatar_full');
            $ext = explode('.', $_FILES['file']['name']);
            $extension = $ext[1];
            if($extension == "jpg" || $extension == "png" || $extension == "jpeg" ){
            $newname = "avatar_user" . '_' . $_POST['user_id'];
            $full_local_path = '../../../../../uploads/user_avatars/' . $newname . "." . $extension;
            move_uploaded_file($_FILES["file"]["tmp_name"], $full_local_path);

            $image = wp_get_image_editor($full_local_path);

            if (!is_wp_error($image)) {

                $image->resize(168, 168, true);
                $new_name = "avatar_user_" . $_POST['user_id'] . "_168x168";
                $image->save('../../../../../uploads/user_avatars/' . $new_name . "." . $extension);
            }
            $uploads = wp_upload_dir();
            $image_link = $uploads['baseurl'] . "/user_avatars/" . $new_name . "." . $extension;
           
            add_user_meta($_POST['user_id'], "facebook_avatar_thumb", $image_link);
           add_user_meta($_POST['user_id'], "facebook_avatar_full", $image_link);
            }
        });
$app->run();






/*
 * Function to get user role by user id
 */

function mn_get_current_user_role($user_id) {
    $user = new WP_User($user_id);

    $role = "";
    if (!empty($user->roles) && is_array($user->roles)) {
        foreach ($user->roles as $role) {
            return translate_user_role($role);
        }
    }
}
