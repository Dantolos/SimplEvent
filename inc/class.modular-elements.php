<?php

$dlicon = new DownloadIcon;
$Clink = new LinkIcon;


class ModularElements {

  public $Element;
  public $data;
  public $Clink;

  //theme colors
  protected $seMC;
  protected $seSC;
  protected $seWC;

  public function __construct(){
    $this->Clink = new LinkIcon;
    $this->seMC = esc_attr( get_option( 'main_color_picker' ) ) ;
    $this->seSC = esc_attr( get_option( 'second_color_picker' ) );
    $this->seWC = esc_attr( get_option( 'light_color_picker' ) );
  }


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

    $this->Element .= $this->Clink->getLinkIcon($data['link']['url'], $data['link']['title'], $data['link']['target']);
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

  protected function boxElement($data) {
    $bordercolor = '';
    $borderCSS = '';
    $borderradius = '';
    $boxstyle = '';


    switch ($data['boxstyle']) {
      case 'style1':
        $bordercolor = $this->seWC;
        $boxstyle = 'se-sc-bg se-wc-txt';
        break;
      case 'style2':
        $bordercolor = $this->seSC;
        $boxstyle = 'se-wc-bg se-sc-txt';
        break;
      default:
        $bordercolor = $this->seWC;
        $boxstyle = 'se-sc-bg se-wc-txt';
        break;
    }

    if($data['border']) {
      foreach ($data['border'] as $borderPos) {
        $borderCSS .= 'border-' . $borderPos . ':4px solid ' . $this->seMC . ';';
      }
    }
    if($data['borderradius']) {
      $borderradius .= 'border-radius: ' . $data['borderradius'] . 'px;';
    }

    $linkCSS = '';
    if($data['verlinkung']) {
         $this->Element .= '<a href="' . $data['verlinkung']['url'] . '" target="' . $data['verlinkung']['target'] . '">';
         $linkCSS = 'se-element-box-link';
    }

    $this->Element .= '<div class="' . $boxstyle . ' se-element-box ' . $linkCSS . '" style="' . $borderCSS . ' ' . $borderradius . '">';
    if($data["bild"]){
      $this->Element .= '<div class="image-settings" style="background-image:url(' . $data['bild'] . '); width:calc (100% + 40px); min-height:' . $data['bild_hohe'] . 'px; margin: -20px -40px 20px -40px;"></div>';
    }
    if($data["titel"]){
      $this->Element .= '<h3 style="border-bottom: 1px solid ' . $bordercolor . '; margin: 0 0 20px 0; padding: 0 0 20px 0;">';
      $this->Element .= $data["titel"];
      $this->Element .= '</h3>';
    }
    $this->Element .= $data["inhalt"];
    if($data['verlinkung']) {
      $this->Element .= '<div style="position:absolute; right:40px; margin-bottom:20px;">';
      $this->Element .= $this->Clink->getLinkIcon($data['verlinkung']['url'], $data['verlinkung']['title'], $data['verlinkung']['target']);
      $this->Element .= '</div>';
    }
    $this->Element .= '</div>';

    if($data['verlinkung']) {
       $this->Element .= '</a>';
    }

  }

  protected function programmElement($data){
    $programm = new Programm;
    $this->Element .= $programm->castProgramm($data);
  }

  //create $OutPut
  public function getModularElement( $Type ) {
    $this->Element = '';
    if ($Type) {
      foreach($Type as $element){
        $padding = $element['style']['padding'];
        $stretch = 'auto';
        if(isset($element['stretch'] )){
          $stretch = $element['stretch'] ? '100%' : 'fit-content';
        }
        
        $paddingR = (wp_is_mobile()) ? 0 : $padding['padding-right'];
        $paddingL = (wp_is_mobile()) ? 0 : $padding['padding-left'];
        $this->Element .= '<div class="se-mod-ele-wrapper" style="padding:'.$padding['padding-top'].'% '.$paddingR.'% '.$padding['padding-bottom'].'% '.$paddingL.'%; height:'.$stretch.';">';
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
          case 'box':
            $this->boxElement($element);
            break;
          case 'programm':
            $this->programmElement($element);
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
