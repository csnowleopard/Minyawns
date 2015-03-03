<?php

require '../../../libs/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array('debug' => true));

require '../../../../../../wp-includes/wp-db.php';
require '../../../../../../wp-load.php';
global $wpdb;
global $wp_roles;
$app->post('/addjob', function () use ($app) {
            $addjob = json_decode(file_get_contents('php://input'), true);

                $post = array(
                'ID' => '', //Are you updating an existing post?
               'post_author' => "1", //The user ID number of the author.
                'post_date' => date("Y-m-d H:i:s"), //The time post was made.
                'post_date_gmt' => date("Y-m-d H:i:s"), //The time post was made, in GMT.
                'post_name' =>$addjob['tasks'], // The name (slug) for your post
                'post_status' => 'publish',
                'post_title' => $addjob['tasks'],
                'post_type' => 'jobs'
            
                );
               $post_id= wp_insert_post($post);
            
            
            foreach($addjob as $key=>$value)
            {
                
                add_post_meta($post_id, $key, $value);
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

?>
