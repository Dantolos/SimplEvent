<?php
/*
* Template Name: Modular Template
*/
get_header();

$Modular = new Modular;

if( have_rows('strip') ):

    $Strips = get_field('strip');

    foreach ($Strips as $Strip) {
      if($Strip["strip_settings"]['public']) {
        echo $Modular->getLayout( $Strip );
      }
    }

endif;


get_footer();
