<?php
/*
  ==================
  AJAX Functions
  ==================
*/

/*-------------SPEAKER---------------*/
add_action('wp_ajax_nopriv_se_speaker_load', 'se_speaker_load');
add_action('wp_ajax_se_speaker_load', 'se_speaker_load'); //nur für angemeldete (admins)

function se_speaker_load() {

  $postID = $_POST['id'];
  $post = get_post($postID);

  $args = array('post_type' => 'speakers',
                'orderby' => 'title',
                'order' => 'ASC',
                'p' => $postID
              );
  $query1 = new WP_Query( $args );
  while ( $query1->have_posts() ) { $query1->the_post();
    global $social;
    $social = get_field('speaker_social_media');
  }
  // echo '<pre>';
  // var_dump($social);
  // echo '</pre>';


  $response = '<div class="se-col-8">';
  $response .= '<h1>' . $post->post_title . '</h1>';
  $response .= '<p>' . get_post_meta($postID, 'speaker_funktion', true ) . ', ' . get_post_meta($postID, 'speaker_firma', true ) . '</p>';
  $response .= '<p>' . get_post_meta($postID, 'speaker_cv', true ) . '</p>';
  $response .= '</div>';

  $response .= '<div class="se-col-4 se-sc-bg se-wc-txt" style="display:table;min-height:300px;">';
  $response .= '<div class="se-infobox se-speaker-content-container-infobox ">';
  $response .= '<p style="margin-top:-40px;">' . get_post_meta($postID, 'speaker_kategorie', true ) . '</p>';
  $response .= '<h2>' . get_post_meta($postID, 'speaker_zeit', true ) . '</h2>';
  $response .= '<a href="' . get_post_meta($postID, 'speaker_webseite', true )  . '" style="margin-bottom:40px;">';
  $response .= '<img src="' . get_template_directory_uri() . '/img/link-arrow.svg" height="16px"/>';
  $response .= '<span class="se-mc-txt">Programm</span>';
  $response .= '</a>';
  $i = 0;
  $response .= '<div class="se_speaker_social-media">';
  while( $i < count($social) ){

    switch ($social[$i]['speaker_social_media_typ']){
      case 'fb':
        $icon = 'icon_facebook.svg';
        break;
      case 'yt':
        $icon = 'icon_youtube.svg';
        break;
      case 'insta':
        $icon = 'icon_insta.svg';
        break;
      case 'in':
        $icon = 'icon_linkedin.svg';
        break;
      case 'twitter':
        $icon = 'icon_twitter.svg';
        break;
    }

    $response .= '<a href="' . $social[$i]['speaker_social_media_link'] . '"  target="_blank" class="se-sm-icon">';
    $response .= '<img src="' . get_template_directory_uri() . '/img/' . $icon . '" height="25px" style="margin:4px 8px 0 0;">';
    $response .= '</a>';
    $i++;
  }
  $webseite = get_post_meta($postID, 'speaker_webseite', true );
  if($webseite){
    $response .= '<a href="' . $webseite['url'] . '" target="_blank" style="position:absolute; right:0;">';
    $response .= '<div class="mc-button-neg se-mc-txt" style="margin:0; border: solid 2px' . esc_attr( get_option( 'main_color_picker' ) ) . '; float:right;">';
    $response .= __( 'WEBSEITE', 'SimplEvent' );
    $response .= '</div>';
    $response .= '</a>';
  }
  $response .= '</div>';
  $response .= '</div>';

  echo $response;
  die();
}

/*-------------PARTNER---------------*/
add_action('wp_ajax_nopriv_se_partner_load', 'se_partner_load');
add_action('wp_ajax_se_partner_load', 'se_partner_load'); //nur für angemeldete (admins)

function se_partner_load() {

  $postID = $_POST['id'];

  $response = '<img src="' . get_field('partner-logo', $postID) . '" alt="" width="150px" style="margin-top:30px;">';
  $response .= '<p style="margin: 40px 0 10px 0">' . get_post_meta($postID, 'partner-text', true  ) . '</p>';
  $response .= '<a href="' . get_field('partner-link', $postID) . '" target="_blank">';
  $response .= '<div class="mc-button-neg se-mc-txt" style="border: solid 2px' . esc_attr( get_option( 'main_color_picker' ) ) . ';">';
  $response .= __('WEBSEITE', 'SimplEvet');
  $response .= '</div>';
  $response .= '</a>';

  echo $response;
  die();
}

/*-------------PARTNER Kategorie---------------*/
add_action('wp_ajax_nopriv_se_partner_cat_load', 'se_partner_cat_load');
add_action('wp_ajax_se_partner_cat_load', 'se_partner_cat_load'); //nur für angemeldete (admins)

function se_partner_cat_load() {

  $postID = $_POST['cid'];

  $main_partner_args = array(
    'post_type' => 'partner', 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array(
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
    $response .= '<div class="se-partner-logo-inner" style=" height:95%; width:95%; margin: auto; position:absolute; margin:2.5%; background-color:rgba(222, 222, 222, 0.5);">';
    $response .= '<div class="" style="margin:15%;height:70%; width:70%; background-image:url(';
    $response .= get_field('partner-logo');
    $response .= '); background-size: contain;background-repeat: no-repeat; background-position: center center;">';
    $response .= '</div>';
    $response .= '</div>';
    $response .= '</div>';

  endwhile; endif;

  echo $response;
  die();
}

/*-------------Award Kategorie---------------*/
add_action('wp_ajax_nopriv_se_award_video_load', 'se_award_video_load');
add_action('wp_ajax_se_award_video_load', 'se_award_video_load'); //nur für angemeldete (admins)

function se_award_video_load() {

  $postID = $_POST['cid'];

  $response = '<img src="' . get_template_directory_uri() . '/img/close.svg" alt="" class="closer">';
  $response .= '<iframe  src="https://www.youtube.com/embed/' . get_post_meta($postID, 'award_video', true  ) . '?rel=0&amp;controls=0;autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
  $response .= '<script type="text/javascript">';
  $response .= "var lightboxContainer = jQuery('.se-award-lightbox-container'); var lightboxCloser = jQuery('.se-award-lightbox-container'); lightboxContainer.on('click', function(){ console.log('hallasdfsa'); jQuery('body').find('.se-award-lightbox-container').remove();});";
  $response .= '</script>';




  echo $response;
  die();
}
