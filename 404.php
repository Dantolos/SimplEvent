<?php

get_header();?>
<style>

</style>

<div class="se-404-container" style="z-index:5000;">
  <img src="<?php echo get_template_directory_uri(); ?>/img/404.svg" alt="" width="50%" style="margin-bottom:30px; opacity:.2;">
  <h4><b  class="se-mc-txt">404</b> Ooops! Diese Seite existiert nicht.</h4>
  <h6>Bitte teilen Sie uns mit, falls diese Seite öfters bei Ihnen auftritt. Die Angabe, über welchen Link sie hier gelandet sind, wird uns bei der Fehlersuche helfen.</h6>
  <a href="#"><h6 class="se-mc-txt">><b>Report your Bug</b></h6></a>
    <a href="<?php echo home_url(); ?>" >
      <div class="mc-button-neg se-mc-txt" style="border: solid 2px <?php  esc_attr( get_option( 'main_color_picker' ) )?>;">
        <?php echo __('zurück zur Startseite', 'SimplEvent'); ?>
      </div>
    </a>
</div>

<?php

get_footer(); ?>
