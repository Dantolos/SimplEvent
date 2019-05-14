<?php

class SessionsClass {
  public $output;
  public $slot;
  public function getSlot($ID, $slots) {
    $sessions_args = array(
      'post_type' => 'sessions', 'orderby' => 'menu_order', 'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => 'Jahr', 'field' => 'term_id', 'terms' => $ID,
        ),
      ),
    );
    $sessions = new WP_Query( $sessions_args );
    $sessionCount = 0;
    $this->slot = $slots;
    if ( $sessions->have_posts() ) : while ( $sessions->have_posts() ) : $sessions->the_post();

      $curslot = get_field('slots');
      $tt = $curslot[0] . ' = '. $this->slot;

      if($this->slot == $curslot[0]){
        $sessionDir;
        if (($sessionCount%2) == 0 || wp_is_mobile() ) {
          $sessionDir = array(
            'dir' => 'l',
            'class' => 'se-content-session-l'
          );
        } else {
          $sessionDir = array(
            'dir' => 'r',
            'class' => 'se-content-session-r'
          );
        }
        $this->output .= '<div class="se-strip-session se-sc-bg">';
        if ($sessionDir['dir'] == 'l' ) {
          $this->output .= '<div class="se-picture-session image-settings" style="background-image:url(' . get_field('session_bild') . ')"></div>';
        }
        $this->output .= '<div class="' . $sessionDir['class'] . ' se-wc-txt se-session-txt">';
        $this->output .= '<p style="border-left: solid 1px '. esc_attr( get_option( 'main_color_picker' ) ) .'">' . ($sessionCount + 1);
        $this->output .= '</p>';

        $lang;
        switch ( get_field('sprache') ) {
          case 'de': $lang = __('Deutsch', 'SimplEvent'); break;
          case 'en': $lang = __('Englisch', 'SimplEvent'); break;
          case 'it': $lang = __('Italienisch', 'SimplEvent'); break;
          case 'fr': $lang = __('Französisch', 'SimplEvent'); break;
          default: $lang = __('Deutsch', 'SimplEvent'); break;
        }

        $this->output .= '<h3>'. get_the_title() . '</h3>';
        $this->output .= '<p class="se-session-sprache">' . __('Sprache', 'SimplEvent') . ': ' . $lang . '</p>';

        $this->output .= '<p>'. get_field('session_text') .'</p>';

        $rCount = 0;
        if( have_rows('referenten') ):
          while ( have_rows('referenten') ) : the_row();
            $this->output .= '<div class="se-session-referent" pid="' . get_the_ID() . '" rcount="' . $rCount . '">';
            $this->output .= '<span class="se-mc-txt">' . get_sub_field('session_referent_name') . '</span><br />';
            $this->output .= '<span>' . get_sub_field('session_referent_funktion') . '</span>';
            $this->output .= '</div>';
            $rCount++;
          endwhile;
        endif;
        $this->output .= '</div>';
        if ($sessionDir['dir'] == 'r' ) {
          $this->output .= '<div class="se-picture-session image-settings" style="background-image:url(' . get_field('session_bild') . ')"></div>';
        }
        $this->output .= '</div>';
        $sessionCount++;
      }
    endwhile; endif;
    return $this->output;
  }

}
