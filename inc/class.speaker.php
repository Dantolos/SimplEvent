<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

require_once('class.link.php');
require_once('class.socialmedia.php');

class SpeakerClass {

  public $outputSpeaker;
  public $outputReview;

  protected $postIDs;

  public function getSpeaker( $Pid = 'N', $Programm = true, $PageID = 0 ) {

    if($Pid == 'N' ) {  //check require parameter
      $this->outputSpeaker = 'pls set ID -> get_Speaker(TermID)';
    } else {
      $seMaC = esc_attr( get_option( 'main_color_picker' ) ) ;
      $Clink = new LinkIcon($seMaC);
      $SMicon = new SocialMedia();
      $post = get_post($Pid);

      $Ssprache = '';
      switch (get_post_meta($Pid, 'speaker_sprache', true )) {
        case 'de':
          $Ssprache = __( 'Deutsch', 'SimplEvent' ); break;
        case 'en':
          $Ssprache = __( 'Englisch', 'SimplEvent' ); break;
        case 'fr':
          $Ssprache = __( 'Französisch', 'SimplEvent' ); break;
        case 'it':
          $Ssprache = __( 'Italienisch', 'SimplEvent' ); break;
        default:
          $Ssprache = __( 'Deutsch', 'SimplEvent' ); break;
      }

      $this->outputSpeaker = '<div class="se-col-8" style="padding-right:5%;">';
      $this->outputSpeaker .= '<h1>' . $post->post_title . '</h1>';
      $this->outputSpeaker .= '<p class="se-mc-txt" style="margin-bottom:5px;"><b>' . get_post_meta( $Pid, 'speaker_funktion', true );
      if( get_field('speaker_firma', $Pid ) ) {
        $this->outputSpeaker .= ', ' . get_field('speaker_firma', $Pid );
      }
      $this->outputSpeaker .= '</b></p><p>' . get_field( 'speaker_cv', $Pid ) . '</p>';
      $this->outputSpeaker .= '</div>';
      $infoWidth = ( wp_is_mobile() ) ? 180 : 250;
      $this->outputSpeaker .= '<div class="se-col-4 se-sc-bg se-wc-txt" style="display:table;height:' . $infoWidth . 'px;overflow:hidden;">';
      $this->outputSpeaker .= '<div class="se-infobox se-speaker-content-container-infobox">';
      $this->outputSpeaker .= '<p style="margin-top:-40px; border-bottom:.5px solid #fff; margin-bottom:25px;">' . __(get_post_meta($Pid, 'speaker_kategorie', true ), 'SimplEvent') . ' | <span> ' . $Ssprache . '</span></p>';
      $this->outputSpeaker .= '<h3>' . get_post_meta( $Pid, 'speaker_zeit', true ) . '</h3>';

      if($Programm) { //check ob aktuelles jahr, wenn nicht, keine Programmverlinkung
        if(get_field('programm_link', $PageID )) {
          $programmLink = get_field('programm_link', $PageID );
          if ( function_exists('icl_object_id') ) {
            $programmLink = get_field('programm_link', $PageID );
            switch (ICL_LANGUAGE_CODE) {
              case 'de':
                $programmText = 'Programm'; break;
              case 'en':
                $programmText = 'Programme'; break;
              default:
                $programmText = get_site_url() . '/programm'; break;
            }
          } else {
            $programmText = 'Programm';
          }
          $this->outputSpeaker .= $Clink->getLinkIcon($programmLink, $programmText);
        }
      }

      $i = 0;
      $this->outputSpeaker .= '<div class="se_speaker_social-media">';

      $social = get_field('speaker_social_media', $Pid);
      while( $i < count($social) ) {
        $smType = $social[$i]['speaker_social_media_typ'];
        $icon = $SMicon->getSMicon($smType, '#fff', '25px');

        $smLink = $social[$i]['speaker_social_media_link'];
        $this->outputSpeaker .= '<a href="' . $smLink . '"  target="_blank" class="se-sm-icon" style="margin:0px 5px 0 0;">';
        $this->outputSpeaker .= '<div class="se-sm-icon-anim" style="margin:8px 8px 0 0; height:18px; width:18px;">'.$icon.'</div>';
        $this->outputSpeaker .= '</a>';
        $i++;
      }

      $webseite = get_field('speaker_webseite', $Pid );
      if($webseite) {
        $this->outputSpeaker .= '<a href="' .$webseite. '" target="_blank" style="position:absolute; right:0;">';
        $this->outputSpeaker .= '<div class="mc-button-neg se-mc-txt" style="margin:0px; border: solid 2px' . esc_attr( get_option( 'main_color_picker' ) ) . '; float:right;">';
        $this->outputSpeaker .= __( 'WEBSEITE', 'SimplEvent' );
        $this->outputSpeaker .= '</div>';
        $this->outputSpeaker .= '</a>';
      }
      $this->outputSpeaker .= '</div>';
      $this->outputSpeaker .= '</div></div>';
    }
    return $this->outputSpeaker;
  }

  public function getSpeakerReview($Pid = 'N'){
    $seMaC = esc_attr( get_option( 'main_color_picker' ) );
    $Vlink = new LinkIcon($seMaC);

    if($Pid == 'N') {  //check require parameter

      $this->outputSpeaker = 'pls set ID -> get_Speaker(ID, )';

    } else {

      //Tabs bei mehr als einem Jahr
      $reviewsData = get_field( 'review_jahr', $Pid );
      $jahrCounterstyle = 0;

      $this->outputReview .= '<div class="se-speaker-review-tabs-container se-content clearfix">';
      $this->outputReview .= '<div id="review-taber" class="se-speaker-review-tab-main se-mc-bg se-wc-txt" >Review</div>';
      if($reviewsData > 1) {  
        foreach ( $reviewsData as $revDate ) {
          $jahrCounterstyle++;
          $tabStyle = ($jahrCounterstyle > 1) ? array('.8', '0') : array('1', '2px');
          $this->outputReview .= '<div revcon="' . $revDate['jahr'][0]->name . '" class="se-speaker-review-tabs se-sc-bg se-wc-txt" style="opacity:' . $tabStyle[0] . '; ">';
          $this->outputReview .=  $revDate['jahr'][0]->name;
          $this->outputReview .= '</div>';
        }
      }
      $this->outputReview .= '</div>';

      $jahrCounterere = 0;
    
      foreach ($reviewsData as $revJahr) {
        $jahrCounterere++;
        $hideTabes = ($jahrCounterere > 1) ? 'none' : 'block';
       
        $this->outputReview .= '<div revcon="'. $revJahr['jahr'][0]->name .'" class="se-strip se-speaker-review se-sc-bg" style="display:' . $hideTabes . ';"><div class="se-content" style="overflow:hidden;">';
        $this->outputReview .= '<div class="se-col-12 se-wc-txt">';
        $this->outputReview .= '<h4 style="font-weight: 700; margin-bottom:30px;">' . $revJahr['review_titel'] . '</h4>';
        $this->outputReview .= '</div>';
        $columnsV = $revJahr['review_video'] ? 5 : 12;
        $columnsT = $revJahr['review_text'] ? 7 : 12;

        if( $columnsT === 7 ){
          $this->outputReview .= '<div class="se-col-'.$columnsV.' se-wc-txt" style="padding-right:3%;">';
          $this->outputReview .= '<p style="border-top:2px solid ' . esc_attr( get_option( 'main_color_picker' ) ) . '; padding-top:10px;" align="justify">';
          $this->outputReview .= $revJahr['review_text'] . '</p></div>';
        }

        if( $revJahr['review_video'] ) {
          $this->outputReview .= '<div class="se-col-'.$columnsT.' se-wc-txt se-speaker-review-video">';
          $this->outputReview .= '<iframe width="100%" height="100%" src="https://media10.simplex.tv/content/' . $revJahr['review_video'] . '/index.html?embed=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe>';
          $this->outputReview .= '</div>';
        }

        $this->outputReview .= '</div>';
        $reviewIMG = $revJahr['review_galerie'];
        if( $reviewIMG ) {
          $this->outputReview .= '<div class="se-gallery-container">';
          for ($c=0; $c < count($reviewIMG); $c++) {
            $reviewIMGurl = $reviewIMG[$c]['url'];
            $ce = $c+1;
            $this->outputReview .= '<div counter="'. $ce .'" imgsrc="'.$reviewIMGurl.'" class="se-gallery-pic image-settings" style="background-image:url('.$reviewIMGurl.');">';
            $this->outputReview .= '</div>';
          }
          $this->outputReview .= '</div>';
        } else {
          $this->outputReview .= '<div class="se-review-placehodler" style="height:50px; width:100%;"></div>';
        }

        $this->outputReview .= '</div></div>';
      }

      return $this->outputReview;
    }
  }

}
