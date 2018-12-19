<?php
/*
* Template Name: Modular Template
*/
get_header();
?>
<div class="se-strip">
  <div class="se-content">
    <div class="se-col-12">
      <h1><?php echo the_title(); ?></h1>

    </div>
  </div>
</div>

<?php

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
