<?php

class loadingAnimation {

  protected $LoaderDots = '<div class="se-loader">
            <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
               width="125.812px" height="125.812px" viewBox="0 0 125.812 125.812" enable-background="new 0 0 125.812 125.812"
               xml:space="preserve">
              <circle class="load-d1" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="13.666" cy="63.24" r="8.282"/>
              <circle class="load-d2" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="46.42" cy="63.24" r="8.282"/>
              <circle class="load-d3" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="79.173" cy="63.24" r="8.282"/>
              <circle class="load-d4" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="111.928" cy="63.24" r="8.282"/>
            </svg>
          </div>';
  public $OutPut;


  public function getLoader() {
    return $this->LoaderDots;
  }

}
