<?php
/*
* Template Name: Programm Template
*/

get_header(); ?>

<!--Programm Main Content-->
<div class="se-strip" style="padding-bottom:0;">
  <div class="se-content">
    <div class="se-col-12">
      <h1><?php echo the_title(); ?></h1>
      <p><?php echo the_content(); ?></p>
    </div>
  </div>
</div>

<!--Programm Raster-->
<div class="se-strip clearfix" style="padding-top:0;">
  <div class="se-content">
    <div class="se-col-12 se-programmtabelle" >
      <?php 
      if( have_rows('programmraster') ):
        while ( have_rows('programmraster') ) : the_row();
          //Programmtitel
          if( get_row_layout() == 'titelzeile' ) {
          ?>
            <div class="se-programm-titelzeile se-sc-bg se-wc-txt se-programm-row se-programm-line">
              <?php
              $titelText = '';
              if(get_sub_field('programmpunkt_zeit')){
                $titelText = the_sub_field('programmpunkt_zeit');
                echo ' | ';
              }
              echo the_sub_field('titel'); ?>
            </div>
          <?php
          //Programmpunkt
          } elseif( get_row_layout() == 'programmpunkt' ) {
            $programmLink = get_sub_field('programmpunkt_verlinkung');
            if( $programmLink ) { ?> <a href="<?php echo $programmLink ?>"> <?php }
            ?>
              <div class="se-programm-programmpunkt se-wc-bg se-programm-row se-programm-line">

                <div class="se-programm-zeit">
                  <?php echo the_sub_field('programmpunkt_zeit'); ?>
                </div>
                <div class="se-programm-titel">
                  <?php echo the_sub_field('programmpunkt_titel');
                  echo '</br>';
                  ?>
                  <?php echo the_sub_field('programmpunkt_subtext'); ?>
                </div>

                <?php if( $programmLink ) { ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/img/link-arrow-black.svg" height="20px"/>
                <?php } ?>

              </div>
            <?php
            if( $programmLink ) { ?> </a> <?php }
          //Programm Tag
          } elseif( get_row_layout() == 'programm-tag' ) { ?>
            <div class="se-programm-programmpunkt se-programm-line" style="margin-bottom:15px;">
              <h5>
                <?php echo the_sub_field('tag'); ?><br>
              </h5>
              <p style="font-weight:200;"><?php echo the_sub_field('datum'); ?></p>
              
            </div>
            <?php
          //Placeholder
          } elseif( get_row_layout() == 'placeholder' ) { ?>
              <div class="se-programm-programmpunkt se-programm-line" style="height:<?php echo the_sub_field('hieght'); ?>px;">

              </div>
            <?php
          }
        endwhile; endif; ?>
    </div>

    <!-- MODERATION -->
    <div class="se-col-12 se-programm-moderation">
      <?php
      if( have_rows('moderation') ):
        ?>
          <h3><b><?php echo __('Moderation', 'SimplEvent'); ?></b></h3>
        <?php
        while ( have_rows('moderation') ) : the_row();
          $moderator = get_sub_field('moderator');
          ?>
          <div class="se-programm-moderator-container clearfix">
            <div class="se-programm-moderator-bild image-settings" style="background-image:url('<?php echo $moderator['foto']; ?>');"></div>
            <div class="se-programm-moderator-text">
              <h4><b><?php echo $moderator['name']; ?></b></h4>
              <p><?php echo $moderator['funktion']; ?></p>
            </div>
          </div>

        <?php
      endwhile; endif; ?>

    </div>
  </div>
</div>


<?php
//mobile footer PLACEHOLDER
if( wp_is_mobile() ) { echo '<div class="se-mobile-footer-placeholder"></div>'; }

get_footer(); ?>
