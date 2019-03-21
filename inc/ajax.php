<?php
header('Content-Type: text/js; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 0);
/*
  ==================
  AJAX Functions
  ==================
*/

require_once('class.speaker.php');
require_once('class.sessions.php');

/*-------------SPEAKER---------------*/
add_action('wp_ajax_nopriv_se_speaker_load', 'se_speaker_load');
add_action('wp_ajax_se_speaker_load', 'se_speaker_load'); //nur für angemeldete (admins)

function se_speaker_load() {
  $SpeakerCl = new SpeakerClass;
  $postID = $_POST['id'];

  $speakerInfo = $SpeakerCl->getSpeaker($postID);

  //REVIEWS
  $review = '';
  if(get_post_meta($postID, 'review_public', true )) {
      $review = $SpeakerCl->getSpeakerReview($postID);
  }

  $response = array(
    'speaker' => $speakerInfo,
    'review' => $review
  );
  wp_send_json($response);
  die();
}

/*-------------PARTNER---------------*/
add_action('wp_ajax_nopriv_se_partner_load', 'se_partner_load');
add_action('wp_ajax_se_partner_load', 'se_partner_load'); //nur für angemeldete (admins)

function se_partner_load() {

  $SMicon = new SocialMedia();
  $postID = $_POST['id'];

  $response = '<div class="clearfix" style="width:100%;">';
  $response .= '<div class="se-partner-lb-logo"><img src="'.get_field('partner-logo', $postID).'"/></div>';
  $response .= '<div class="se-partner-lb-content">';
  //$response .= '<h3>'. get_the_title( $postID ) .'</h3>';
  $response .= '<p style="width:100%;">'.get_field('partner-text', $postID) .'</p>';

  $social = get_field('social_media', $postID);
  $i = 0;
  if($social){
    $response .= '<div class="se-partner-socialmedia clearfix">';
    while( $i < count($social["speaker_social_media"]) ){
      $smType = $social["speaker_social_media"][$i]['speaker_social_media_typ'];
      $icon = $SMicon->getSMicon($smType, '#d7d7d7', '25px');

      $response .= '<a href="' . $social["speaker_social_media"][$i]['speaker_social_media_link'] . '"  target="_blank" class="se-partner-sm-icon" style="margin:0px 5px 0 0;">';
      $response .= '<div class="se-sm-icon-anim" style="margin:8px 8px 0 0; height:18px; width:18px;">'.$icon.'</div>';
      $response .= '</a>';
      $i++;
    }
    $response .= '</div>';
  }

  $response .= '<a href="' .get_field('partner-link', $postID) . '" target="_blank" style="">';
  $response .= '<div class="mc-button-neg se-mc-txt" style="margin:40px 0; border: solid 2px' . esc_attr( get_option( 'main_color_picker' ) ) . '; float:left;">';
  $response .= __( 'WEBSEITE', 'SimplEvent' );
  $response .= '</div>';
  $response .= '</a>';

  $response .= '</div></div>';

  echo $response;
  die();
}

/*-------------PARTNER Kategorie---------------*/
add_action('wp_ajax_nopriv_se_partner_cat_load', 'se_partner_cat_load');
add_action('wp_ajax_se_partner_cat_load', 'se_partner_cat_load'); //nur für angemeldete (admins)

function se_partner_cat_load() {

  $postID = $_POST['cid'];

  $main_partner_args = array(
    'post_type' => 'p', 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array(
      array(
        'taxonomy' => 'Kategorie', 'field' => 'term_id', 'terms' => $postID,
      ),
    ),
  );
  $main_partner = new WP_Query($main_partner_args);
  $response = '';
  if ( $main_partner->have_posts() ) : while ( $main_partner->have_posts() ) : $main_partner->the_post();
    $Logo = $bild =

    $response .= '<div data-id="' . get_the_ID() . '" class="se-col-3 se-partner-logo" style="position:relative;">';
    $response .= '<div class="se-partner-logo-inner" style=" height:95%; width:95%; margin: auto; position:absolute; margin:2.5%; background-color:#f7f7f7;">';
    $response .= '<div class="se-partner-logo-pic" style="margin:15%;height:70%; width:70%; background-image:url(';
    $response .= get_field('partner-logo');
    $response .= '); background-size: contain;background-repeat: no-repeat; background-position: center center;">';
    $response .= '</div>';
    $response .= '</div>';
    $response .= '</div>';

  endwhile; endif;

  echo $response;
  die();
}

/*-------------Award Video---------------*/
add_action('wp_ajax_nopriv_se_award_video_load', 'se_award_video_load');
add_action('wp_ajax_se_award_video_load', 'se_award_video_load'); //nur für angemeldete (admins)

function se_award_video_load() {

  $postID = $_POST['cid'];

  $response = '<img src="' . get_template_directory_uri() . '/img/close.svg" alt="" class="closer">';
  $response .= '<iframe  src="https://www.youtube.com/embed/' . get_post_meta( $postID, 'award_video', true ) . '?rel=0&amp;controls=0;autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';


  echo $response;
  die();
}

/*-------------Sessions Slots---------------*/
add_action('wp_ajax_nopriv_se_session_slots', 'se_session_slots');
add_action('wp_ajax_se_session_slots', 'se_session_slots'); //nur für angemeldete (admins)

function se_session_slots() {
  $Csession = new SessionsClass;

  $slot = $_POST['slot'];
  $jahr = $_POST['year'];
  $response = $Csession->getSlot($jahr, $slot );

  echo $response;
  die();
}


/*-------------Sessions Referenten---------------*/
add_action('wp_ajax_nopriv_se_session_load', 'se_session_load');
add_action('wp_ajax_se_session_load', 'se_session_load'); //nur für angemeldete (admins)

function se_session_load() {

  $postID = $_POST['sid'];
  $rIndex = $_POST['rc'];

  $sessionRefs = get_field('referenten', $postID );

  $response = '<div class="clearfix" style="height:100%; width:100%;">';
  $response .= '<div class="se-sessions-img image-settings" style="background-image:url('. $sessionRefs[$rIndex]['bild'] .');">';
  $response .= '</div><div class="se-sessions-content">';
  $response .= '<h2>' . $sessionRefs[$rIndex]['session_referent_name'] . '</h2>';
  $response .= '<p class="se-mc-txt"style="margin-bottom:20px;">' . $sessionRefs[$rIndex]['session_referent_funktion'] . '</p>';
  $response .= '<p>' . $sessionRefs[$rIndex]['cv'] . '</p>';
  $response .= '</div></div>';

  echo $response;
  die();
}

/*-------------ReviewGallery---------------*/
add_action('wp_ajax_nopriv_se_review_gallery_load', 'se_review_gallery_load');
add_action('wp_ajax_se_review_gallery_load', 'se_review_gallery_load'); //nur für angemeldete (admins)

function se_review_gallery_load() {

  $gaid = $_POST['gaid'];
  $paid = $_POST['paid'];

  $theReview = get_field('reviews', $paid );

  $response = '<div class="clearfix" style="height:100%; width:100%; overflow-y:scroll;">';
  foreach ( $theReview[$gaid]["gallery"] as $galIMG ) {
    $response .= '<div class="image-settings se-review-gallery" imgsrc="' . $galIMG["url"] . '" style="background-image:url(' . $galIMG["url"] . '); "></div>';
    //$response .= '<img src="' . $galIMG["url"] . '" width="23%" height="auto"/>';
  }
  $response .= '</div>';

  echo $response;
  die();
}
