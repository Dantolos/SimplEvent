<?php

class Programm {

     public $result = '';

     public function castProgramm( $programmElement )
     {
          $this->result .= '<div class="se-col-12 se-programmtabelle">';

          foreach( $programmElement as $pP )
          {
               switch ($pP['acf_fc_layout']) {

                    case 'titelzeile':
                         $this->result .= '<div class="se-programm-titelzeile se-sc-bg se-wc-txt se-programm-row se-programm-line">';
                         $titelText = '';
                         if($pP['programmpunkt_zeit']){
                              $titelText = the_sub_field('programmpunkt_zeit');
                              $this->result .= ' | ';
                         }
                         $this->result .= $pP['titel']; 
                         $this->result .= '</div>';
                         
                         break;

                    case 'programmpunkt':
                         if( $pP['programmpunkt_verlinkung'] ) {  $this->result .= '<a href="'. $pP['programmpunkt_verlinkung'] . '">';  }
                              $this->result .= '<div class="se-programm-programmpunkt se-wc-bg se-programm-row se-programm-line">';
                                   $this->result .= '<div class="se-programm-zeit">';
                                   $this->result .= $pP['programmpunkt_zeit'];
                                   $this->result .= '</div>';

                                   $this->result .= '<div class="se-programm-titel">';
                                   $this->result .= $pP['programmpunkt_titel'];
                                   $this->result .= '</br>';
                                   $this->result .= $pP['programmpunkt_subtext'];
                                   $this->result .= '</div>';

                                   if( $pP['programmpunkt_verlinkung'] ) {  $this->result .= ' <img src="' . get_template_directory_uri(). '/img/link-arrow-black.svg" height="20px"/>';  }
                              $this->result .= '</div>';
                         if( $pP['programmpunkt_verlinkung'] ) {  $this->result .= '</a>';  }
                         break;

                    case 'programm-tag':
                         $this->result .= '<div class="se-programm-programmpunkt se-programm-line" style="margin-bottom:15px;">';
                              $this->result .= '<h5>';
                              $this->result .= $pP['tag'] . '<br>';
                              $this->result .= '</h5>';
                              $this->result .= '<p style="font-weight:200;">' . $pP['datum'] . '</p>';
                        
                         break;

                    case 'placeholder':
                         $this->result .= '<div class="se-programm-programmpunkt se-programm-line" style="height:' . $pP['hieght'] . 'px;">';
                         $this->result .= '</div>';
                         break;
                         
                    default:
                         # code...
                         break;
               }
          }

          $this->result .= '</div>';
          return $this->result;
     }


}
