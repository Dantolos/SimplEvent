<?php


class LinkIcon {

  public $LinkIcon;


  public $LinkArrow = '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                	 width="16px" height="16px" viewBox="0 0 40 39" enable-background="new 0 0 40 39" xml:space="preserve">
                <g>
                	<path fill="#dedede" d="M35.051,0H4.799C2.87,0,0,1.35,0,4.871v29.33C0,36.131,1.278,39,4.799,39h30.252
                		C36.98,39,40,37.723,40,34.201V4.871C40,2.941,38.572,0,35.051,0z M37,34.201C37,35.485,35.775,36,35.038,36H4.799
                		C3.511,36,3,34.921,3,34.201V4.871C3,3.583,4.08,3,4.799,3h30.252C36.34,3,37,4.151,37,4.871V34.201z"/>
                	<path class="se-arrow" fill="dedede" d="M30.105,18.204L11.357,7.249c-0.764-0.448-1.743-0.19-2.188,0.574C8.724,8.585,8.98,9.565,9.744,10.01
                		l16.333,9.545L9.819,29.446c-0.755,0.459-0.995,1.443-0.536,2.197c0.302,0.496,0.829,0.769,1.369,0.769
                		c0.284,0,0.57-0.074,0.83-0.232l18.146-11.039c0.426-0.09,0.815-0.345,1.053-0.749C31.125,19.628,30.868,18.649,30.105,18.204z"/>
                  <path class="se-arrow-n" fill="dedede" d="M30.105,18.204L11.357,7.249c-0.764-0.448-1.743-0.19-2.188,0.574C8.724,8.585,8.98,9.565,9.744,10.01
                		l16.333,9.545L9.819,29.446c-0.755,0.459-0.995,1.443-0.536,2.197c0.302,0.496,0.829,0.769,1.369,0.769
                		c0.284,0,0.57-0.074,0.83-0.232l18.146-11.039c0.426-0.09,0.815-0.345,1.053-0.749C31.125,19.628,30.868,18.649,30.105,18.204z"/>
                </g>
                </svg>';


  public function getLinkIcon($LinkURL, $LinkText, $Target = '_self' ) {
    $this->LinkIcon = '<a href="'.$LinkURL.'" target="'.$Target.'" title="'.$LinkText.'"><div class="se-link clearfix">';
		$this->LinkIcon .= $this->LinkArrow.'<p class="se-link-text se-mc-txt">'.$LinkText.'</p></div></a>';
    return $this->LinkIcon;
  }

}
