<?php

class Modular extends ModularElements {
  public $column;

  public function getLayout( $Strip ) {

      //strip Settings
      $BGTextStyle = $Strip["strip_settings"]["style"];
      switch ($BGTextStyle) {
        case 'light':
          $BGcolor = '';
          break;
        case 'dark':
          $BGcolor = 'se-wc-txt';
          break;
        default:
          $BGcolor = '';
          break;
      }
      $BGstyle = '';
      $BGimg = '';
      if($Strip["strip_settings"]["tansparent"]){

      } else {
        if($Strip["strip_settings"]["background_image"]) {
          $BGimg = $Strip["strip_settings"]["background_image"];
        } else {
          $BGstyle = ( $Strip["strip_settings"]["background_color"] ) ? 'background-color:'.$Strip["strip_settings"]["background_color"].';': 'none';
        }
      }



      $OutPut = '<div class="se-strip ' . $BGcolor . ' image-settings" style="background-image:url('.$BGimg.'); '.$BGstyle.'">';

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
          $colPadding = '8px';
          foreach($layoutName as $col){

            //CSS
            if ((array)$ColEle[$colCount]['style']) {
              $colPadding = $ColEle[$colCount]['style']['padding'];
              $colPaddingR = (wp_is_mobile()) ? 0 : $colPadding['padding-right'];
              $colPaddingL = (wp_is_mobile()) ? 0 : $colPadding['padding-left'];
              $colPadding = $colPadding['padding-top'] . '% ' . $colPaddingR . '% ' . $colPadding['padding-bottom'] . '% ' . $colPaddingL . '%';
              unset($ColEle[$colCount]['style']);
            }

            $OutPut .= '<div class="se-col-' . $col . '" style="padding:'. $colPadding .';">';

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
