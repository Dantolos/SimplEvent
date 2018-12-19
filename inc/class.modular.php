<?php

class Modular extends ModularElements {
  public $column;

  public function getLayout( $Strip ) {

      //strip Settings
      $BGstyle = $Strip["strip_settings"]["style"];
      switch ($BGstyle) {
        case 'light':
          $BGcolor = 'se-weiss';
          break;
        case 'dark':
          $BGcolor = 'se-sc-bg se-wc-txt';
          break;
        default:
          $BGcolor = 'se-wc-bg se-wc-txt';
          break;
      }

      //BACKGROUND IMAGE
      $BGimg = '';
      if($Strip["strip_settings"]["background_image"]) {
        $BGimg = $Strip["strip_settings"]["background_image"];
      }

      $OutPut = '<div class="se-strip ' . $BGcolor . ' image-settings" style="background-image:url('.$BGimg.');">';

      //Create Column + Element
      if($Strip['row']) {
        foreach ($Strip['row'] as $Row) {

          $OutPut .= '<div class="se-content">';

          $layoutName = $Row["acf_fc_layout"];
          $layoutName = str_replace('content-', '', $layoutName);
          $layoutName = explode('-', $layoutName);
          array_shift($Row);

          $ColEle = array();

          foreach($Row as $Col) {
            array_push($ColEle, $Col);
          }
          $colCount = 0;
          foreach($layoutName as $col){
            $OutPut .= '<div class="se-col-' . $col . '">';

            //Create Element -> class.modular-elements.php
            foreach ((array)$ColEle[$colCount] as $Ele) {
                $OutPut .= $this->getModularElement( $Ele );
            }
            $colCount++;
            $OutPut .= '</div>';
          }
          $OutPut .= '</div>';
        }
      }
      $OutPut .= '</div>';

    return $OutPut;
  }

}
