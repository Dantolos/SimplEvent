<?php
/*
* Template Name: Colada Template
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
  <div class="se-content">
    <div class="se-col-12">
      <?php
      if (! isset($_GET['pin'])) {
        ?>
        <form id="pinForm" class="" action="" method="get">
          <input type="text" name="pin" value="">
          <input type="submit" value="Go">
        </form>
        <?php
      } else {
        $pinEx = $_GET['pin'];
        if($pinEx[0] === 'P') {
          ?>
          <iframe src=" https://www.colada.biz/events/?eid=DE5AD553-A420-2C1C-11FFD898406CF5E1" width="100%" height="800px"></iframe>
          <?php
        } else {
          ?>
          <iframe src="https://www.colada.biz/events/?eid=DE5AD553-A420-2C1C-11FFD898406CF5E1&allowstep=1&step=2" width="100%" height="800px"></iframe>
          <?php
        }
      }
      ?>
    </div>
  </div>
</div>

<?php
get_footer();
