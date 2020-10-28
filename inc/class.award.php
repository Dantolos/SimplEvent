<?php


class AwardClass {

  public $outputCandidate;
  public $kategorie;
  public $candIDs = array();

  public function getCandidate($Jahr, $Kategorie, $Gewinner = false) {
    intval($Jahr);
    if($Kategorie != 'all'){
      $this->kategorie = array( 'taxonomy' => 'Awardkategorie', 'field' => 'slug', 'terms' => $Kategorie );
    } else {
      $this->kategorie = '';
    }
    $candQuery_args = array(
      'post_type' => 'award', 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(
        array( 'taxonomy' => 'Jahrgang', 'field' => 'slug', 'terms' => $Jahr ),
        $this->kategorie
      ),
    );

    $candPreQuery = new WP_Query($candQuery_args);

    foreach ($candPreQuery->posts as $post) {
      if( $Gewinner === false ) {
        array_push($this->candIDs, $post->ID);
      } elseif ( get_field('award_gewinner', $post->ID ) && $Gewinner === true  ) {
        array_push($this->candIDs, $post->ID);
      }
    }

    foreach ($this->candIDs as $candID) {
      $winner = get_field('award_gewinner', $candID) ? __('Gewinner', 'SimplEvent') : __('Finalist', 'SimplEvent');
      $kategorie = get_the_terms( $candID, 'Awardkategorie' );

      $this->outputCandidate .= '<div class="se-candidate-container">';
      $this->outputCandidate .= '<div class="se-candidate-img image-settings" style="background-image:url(' . get_field('finalist_bild', $candID) . ');">';
      if(get_field('award_logo', $candID)){
        $this->outputCandidate .= '<div class="se-candidate-logo-container" style="background-image:url(' . get_field('award_logo', $candID) . ');"></div>';
      }
      $this->outputCandidate .= '</div>';
      $this->outputCandidate .= '<div class="se-candidate-content">';

      $this->outputCandidate .= '<div class="hide-scroll" style="max-height:210px; overflow-y:scroll; padding:10px 0;">';
      $this->outputCandidate .= '<h4><b>' . $winner . '</b> | ' . $kategorie[0]->name . '</h4>';
      $this->outputCandidate .= '<h3><b>' . get_the_title($candID) . '</b></h3>';
      $this->outputCandidate .= '<p>' . get_field('award_text', $candID) . '</p>';
      $this->outputCandidate .= '</div>';
      if( get_field('award_webseite', $candID )){
        $this->outputCandidate .= '<a href="' . get_field('award_webseite', $candID) . '" target="_blank" style="position:absolute; right:20px; bottom:25px;">';
        $this->outputCandidate .= '<div class="mc-button-neg se-mc-txt" style="margin:0px; border: solid 2px' . esc_attr( get_option( 'main_color_picker' ) ) . '; ">';
        $this->outputCandidate .= __( 'WEBSEITE', 'SimplEvent' );
        $this->outputCandidate .= '</div>';
        $this->outputCandidate .= '</a>';
      }
      $this->outputCandidate .= '</div>';
      $this->outputCandidate .= '</div>';
    }

    return $this->outputCandidate;

  }

}
