<?php
/*
* Template Name: Map Template
*/
get_header();
?>

<div class="se-strip se-map-container">
  <?php echo the_content(); ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
  var MapContainer = $('.se-map-container');

  FitMapContainer();
  MapContainer.on('resize', function() {
    FitMapContainer();
  });

  function FitMapContainer(){
    let mapHeight = $(window).innerHeight() - $('.se-navbar-container').innerHeight();
    MapContainer.css({'height': mapHeight });
    console.log(mapHeight);
  }

});
</script>
<?php
get_footer();
