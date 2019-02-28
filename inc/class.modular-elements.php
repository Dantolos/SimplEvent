<?php

$dlicon = new DownloadIcon;
$Clink = new LinkIcon;

class ModularElements {


  public $Element;
  public $data;
  //create Elements
  protected function titelElement($data) {
    $this->Element .= '<h2>'. $data['titel'] .'</h2>';
  }

  protected function textElement($data) {
    $this->Element .= '<p>'. $data['text'] .'</p>';
  }

  protected function wysiwygElement($data) {
    $this->Element .= $data['wysiwyg'];
  }

  protected function downloadElement($data) {
    $dlicon = new DownloadIcon;
    $this->Element .= $dlicon->DownloadLink($data['download_text'], $data['download']);
  }

  protected function linkElement($data) {
    $Clink = new LinkIcon;
    $this->Element .= $Clink->getLinkIcon($data['link']['url'], $data['link']['title'], $data['link']['target']);
  }

  protected function buttonElement($data) {
    $this->Element .= '<a href="'. $data["button"]["url"] .'" target="'. $data["button"]["target"] .'">';
    $this->Element .= '<div class="mc-button-neg se-mc-txt button-border" style="margin:0; ">';
    $this->Element .= $data["button"]["title"];
    $this->Element .= '</div></a>';
  }

  protected function bildElement($data) {
    $this->Element .= '<img src="'. $data['bild'] .'" width="100%" height="auto"/>';
  }

  protected function videoElement($data) {
    $this->Element .= $data['video'];
  }



  //create $OutPut
  public function getModularElement( $Type ) {
    $this->Element = '';
    if ($Type) {
      foreach($Type as $element){
        $padding = $element['style']['padding'];
        $this->Element .= '<div class="se-mod-ele-wrapper" style="padding:'.$padding['padding-top'].'% '.$padding['padding-right'].'% '.$padding['padding-bottom'].'% '.$padding['padding-left'].'%;">';
        $curType = $element["acf_fc_layout"];

        switch ($curType) {
          case 'css':
            break;
          case 'titel':
            $this->titelElement($element);
            break;
          case 'text':
            $this->textElement($element);
            break;
          case 'wysiwyg':
            $this->wysiwygElement($element);
            break;
          case 'download':
            $this->downloadElement($element);
            break;
          case 'link':
            $this->linkElement($element);
            break;
          case 'button':
            $this->buttonElement($element);
            break;
          case 'bild':
            $this->bildElement($element);
            break;
          case 'video':
            $this->videoElement($element);
            break;

          default:
            // code...
            break;
        }
        $this->Element .= '</div>';
      }  
    }


    $this->Element .= '<div style="width:100%; margin-bottom:20px;"></div>';
    return $this->Element;
  }



}
