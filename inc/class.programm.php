<?php

class Programm {

     public $result = '';

     public function castProgramm( $programmElement )
     {
          $this->result .= '<pre style="color:green;">';
          $this->result .= var_dump($programmElement);
          $this->result .= '</pre>';


          return $this->result;
     }


}
