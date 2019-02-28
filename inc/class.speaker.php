<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

require_once('class.link.php');
require_once('class.socialmedia.php');

class SpeakerClass {


  public $outputSpeaker;
  public $outputReview;
  protected $postIDs;

  public function getSpeaker($Pid = 'N'){
    if($Pid == 'N') {  //check require parameter
      $this->outputSpeaker = 'pls set ID -> get_Speaker(ID, )';

    } else {
      $seMaC = esc_attr( get_option( 'main_color_picker' ) ) ;
      $Clink = new LinkIcon($seMaC);
      $SMicon = new SocialMedia();
      $post = get_post($Pid);

      $this->outputSpeaker = '<div class="se-col-8" style="padding-right:5%;">';
      $this->outputSpeaker .= '<h1>'. $post->post_title.'</h1>';
      $this->outputSpeaker .= '<p>' . get_post_meta($Pid, 'speaker_funktion', true ) . ', ' . get_field('speaker_firma', $Pid ) . '</p>';
      $this->outputSpeaker .= '<p>' . get_field('speaker_cv', $Pid ) . '</p>';
      $this->outputSpeaker .= '</div>';
      $infoWidth = (wp_is_mobile()) ? 200 : 300;
      $this->outputSpeaker .= '<div class="se-col-4 se-sc-bg se-wc-txt" style="display:table;height:'.$infoWidth.'px;overflow:hidden;">';
      $this->outputSpeaker .= '<div class="se-infobox se-speaker-content-container-infobox">';
      $this->outputSpeaker .= '<p style="margin-top:-40px;">' . get_post_meta($Pid, 'speaker_kategorie', true ) . '</p>';
      $this->outputSpeaker .= '<h2>' . get_post_meta($Pid, 'speaker_zeit', true ) . '</h2>';
      $this->outputSpeaker .= $Clink->getLinkIcon('http://wpsif.e-towers.ch/programm/', 'PROGRAMM');

      $i = 0;
      $this->outputSpeaker .= '<div class="se_speaker_social-media">';

      $social = get_field('speaker_social_media', $Pid);
      while( $i < count($social) ){
        $smType = $social[$i]['speaker_social_media_typ'];
        $icon = $SMicon->getSMicon($smType, '#fff', '25px');

        $smLink = $social[$i]['speaker_social_media_link'];
        $this->outputSpeaker .= '<a href="' . $smLink . '"  target="_blank" class="se-sm-icon" style="margin:0px 5px 0 0;">';
        $this->outputSpeaker .= '<div class="se-sm-icon-anim" style="margin:8px 8px 0 0; height:18px; width:18px;">'.$icon.'</div>';
        $this->outputSpeaker .= '</a>';
        $i++;
      }

      $webseite = get_field('speaker_webseite', $Pid );
      if($webseite){
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
    if($Pid == 'N') {  //check require parameter
      $this->outputSpeaker = 'pls set ID -> get_Speaker(ID, )';

    } else {
      $this->outputReview = '<div class="se-strip se-speaker-review se-sc-bg"><div class="se-content" style="overflow:hidden;">';
      $this->outputReview .= '<div class="se-col-12 se-wc-txt">';
      $this->outputReview .= '<h4 style="font-weight: 700; margin-bottom:30px;">' . get_post_meta($Pid, 'review_titel', true ) . '</h4>';
      $this->outputReview .= '</div>';
      $columns = (get_post_meta($Pid, 'review_video', true )) ? 5 : 12;
      $this->outputReview .= '<div class="se-col-'.$columns.' se-wc-txt" style="padding-right:3%;">';
      $this->outputReview .= '<p style="border-top:2px solid ' . esc_attr( get_option( 'main_color_picker' ) ) . '; padding-top:10px;">';
      $this->outputReview .= get_post_meta($Pid, 'review_text', true ) . '</p></div>';
      if(get_post_meta($Pid, 'review_video', true )){
        $this->outputReview .= '<div class="se-col-7 se-wc-txt se-speaker-review-video">';
        $this->outputReview .= '<iframe width="100%" height="100%" src="https://media10.simplex.tv/content/'.get_post_meta($Pid, 'review_video', true ).'/index.html?embed=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe>';
        $this->outputReview .= '</div>';
      }
      $this->outputReview .= '</div>';
      $reviewIMG = get_field('review_galerie', $Pid );
      if($reviewIMG){
        $this->outputReview .= '<div class="se-gallery-container">';
        for ($c=0; $c < count($reviewIMG); $c++) {
          $reviewIMGurl = $reviewIMG[$c]['url'];
          $ce = $c+1;
          $this->outputReview .= '<div counter="'. $ce .'" imgsrc="'.$reviewIMGurl.'" class="se-gallery-pic image-settings" style="background-image:url('.$reviewIMGurl.');">';
          $this->outputReview .= '</div>';
        }
        $this->outputReview .= '</div>';
      }

      $this->outputReview .= '</div></div>';
      return $this->outputReview;
    }
  }

}
