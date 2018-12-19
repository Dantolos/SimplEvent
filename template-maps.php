<?php
/*
* Template Name: Map Template
*/
get_header();
?>
<div class="se-strip">
  <div class="se-content">
    <div class="se-col-12">
      <h1><?php echo the_title(); ?></h1>
      <p><?php echo the_content(); ?></p>
    </div>
  </div>
</div>
<div class="se-strip" style="padding:0;">
      <p><?php echo do_shortcode('[mapsvg id="371"]') ?></p>
</div>



<?php
get_footer();
