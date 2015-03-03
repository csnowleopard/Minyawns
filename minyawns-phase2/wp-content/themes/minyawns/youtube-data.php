<?php
require_once('../../../wp-blog-header.php');

//Add Video
if($_GET['action'] == 'add'){


function introVideoDuration($videoid) {
      $xml = simplexml_load_file('https://gdata.youtube.com/feeds/api/videos/' . $videoid . '?v=2');
      $result = $xml->xpath('//yt:duration[@seconds]');
      $total_seconds = (int) $result[0]->attributes()->seconds;

      return $total_seconds;
}


if (wp_verify_nonce($_GET['nonce'], 'addvideotousermeta')){

    if(introVideoDuration($_GET['videoid'])>30){
      $response = "Maximum video duration 30 seconds exceeded.";  
  }else{
      if(update_user_meta($_GET['userid'], 'intro_video_id', $_GET['videoid'])){
        $response = "ok"; 
    }else{
        $response = "Unable to assign video to user profile";
    }  
}

}else{
    $response = "Invalid API call";
}
echo $response;

}




//Delete Video
if($_GET['action'] == 'delete'){

    if (wp_verify_nonce($_GET['nonce'], 'deletevideousermeta')){
        if ( ! delete_user_meta($_GET['userid'], 'intro_video_id') ) {
          $response = 'There was some problem deleting intro video.';
      }else{
        $response = 'ok';
    }


}else{
    $response = 'Invalid API Call';
}

echo $response;

}




?>