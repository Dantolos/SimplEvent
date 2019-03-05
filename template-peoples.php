<?php
/*
* Template Name: Peoples Template
*/

get_header(); ?>


<!--Award Main Content-->
<div class="se-strip" style="padding-bottom:00px;">
  <div class="se-content">
    <div class="se-col-12">
      <h1><?php echo the_title(); ?></h1>
      <p><?php echo the_content(); ?></p>
    </div>
  </div>
</div>

<div class="se-strip" style="padding-top:00px;">
  <div class="se-content">
    <?php


    $PplTaxID = get_field('group');
    $Pplargs = array(
      'post_type' => 'people', 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array(
        array(
          'taxonomy' => 'Gruppe', 'field' => 'term_id', 'terms' => $PplTaxID,
        ),
      ),
    );
    $Ppl = new WP_Query($Pplargs);

    if (get_field('titel')) {
      $term = get_term_by('id', $PplTaxID[0], 'Gruppe');

      echo '<h3 style="margin-bottom:50px;">'.$term->name.'</h3>';
    }

    $cPpl = 1;
    if ( $Ppl->have_posts() ) : while ( $Ppl->have_posts() ) : $Ppl->the_post();
      ?>
        <div class="se-col-3 se-people-container">
          <div class="se-people-portrait-wrapper" style="position:relative; width: 100%;">
            <div class="se-people-portrait-img image-settings" style="background-image:url(<?php echo the_field('foto'); ?>);"></div>
          </div>
          <h4 class="se-mc-txt"><?php echo the_title(); ?></h3>
          <p><?php
          echo the_field('funktion');
          if(get_field('firma')){
            echo ', ';
            echo the_field('firma');
          }?>
          </p>
          <div class="se-people-stroke" style="border-top:2px solid <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>;"></div>

          <div class="se-people-socialmedia-wrapper clearfix">
            <?php
            $SMicon = new SocialMedia();
            $social = get_field('speaker_social_media');
            $i = 0;
            while( $i < count($social) ){
              $smType = $social[$i]['speaker_social_media_typ'];
              $icon = $SMicon->getSMicon($smType, '#b6b6b6', '20px');

              echo '<a href="' . $social[$i]['speaker_social_media_link'] . '"  target="_blank" class="se-sm-icon" style="margin:0;">';
              echo '<div class="se-sm-icon-anim" style="margin:2px 2px 0 2px; ">'.$icon.'</div>';
              echo '</a>';
              $i++;
            }
            ?>
          </div>
        </div>
        <?php
        if ( $cPpl%4 == 0 ) { ?>
          </div>
          <div class="se-content">
        <?php }

        $cPpl++;
      endwhile; endif; ?>

  </div>
</div>

<?php
//mobile footer PLACEHOLDER
if( wp_is_mobile() ) { echo '<div class="se-mobile-footer-placeholder"></div>'; }

get_footer(); ?>
