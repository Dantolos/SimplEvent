<?php

class seButton {

  public $Button;

  public function getButton( $text, $link, $target ) {
    $this->Button = '<a href="'. $link .'" target="'. $target .'">';
    $this->Button .= '<div class="mc-button-neg se-mc-txt button-border" style="margin:0; ">';
    $this->Button .= $text;
    $this->Button .= '</div></a>';
    return $this->Button;
  }

}
