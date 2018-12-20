<?php
/*
* Template Name: Session Template
*/

get_header();

$Clink = new LinkIcon;

//Query
$sessions_args = array(
  'post_type' => 'sessions',
  'orderby' => 'menu_order',
  'order'     => 'ASC',
  'tax_query' => array(
    array(
      'taxonomy' => 'Jahr',
      'field'    => 'term_id',
      'terms'    => array(4),
    ),
  ),
);
$sessions = new WP_Query( $sessions_args );
?>

<!--Session Main Content-->
<div class="se-strip">
  <div class="se-content">
    <div class="se-col-8">
      <h1><?php echo the_title(); ?></h1>
      <p><?php echo the_content(); ?></p>
    </div>
    <div class="se-col-4 se-sc-bg se-wc-txt" style="display: table;">
      <div class="se-infobox">
        <p><?php echo __( 'Parallelprogramm', 'SimplEvent' ); ?></p>
        <h2><?php the_field('session_zeit'); ?></h2>
        <?php
          $link = get_field('session_linkurl');
          echo $Clink->getLinkIcon($link, 'PROGRAMM'); ?>
      </div>
    </div>
  </div>
</div>

<!--Separate Sessions-->
<?php
$sessionCount = 0;
if ( $sessions->have_posts() ) : while ( $sessions->have_posts() ) : $sessions->the_post();

  if (($sessionCount%2) == 0 ) { //dark strips
  ?>
    <div class="se-strip-session se-sc-bg">
      <div class="se-picture-session image-settings" style="background-image:url('<?php echo get_field('session_bild');?>')">
      </div>
      <div class="se-content-session-l se-wc-txt se-session-txt">
        <p style="border-left: solid 1px <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>;">BS <?php echo $sessionCount + 1; ?></p>
        <h3><?php echo the_title(); ?></h3>
        <p><?php echo get_field('session_text'); ?></p>
        <?php
        if( have_rows('referenten') ):
          while ( have_rows('referenten') ) : the_row(); ?>
            <div class="se-session-referent">
              <span class="se-mc-txt"><?php echo the_sub_field('session_referent_name'); ?></span><br />
              <span><?php echo the_sub_field('session_referent_funktion'); ?></span>
            </div>
            <?php
          endwhile;
        endif;
        ?>
      </div>
    </div>
  <?php
  } else { //light strips
  ?>
    <div class="se-strip-session clearfix ">
      <div class="se-content-session-r se-sc-txt se-session-txt">
        <p style="border-left: solid 1px <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>;">BS <?php echo $sessionCount + 1; ?></p>
        <h3><?php echo the_title(); ?></h3>
        <p><?php echo get_field('session_text'); ?></p>
        <?php
        if( have_rows('referenten') ):
          while ( have_rows('referenten') ) : the_row(); ?>
            <div class="se-session-referent">
              <span class="se-mc-txt"><?php echo the_sub_field('session_referent_name'); ?></span><br />
              <span><?php echo the_sub_field('session_referent_funktion'); ?></span>
            </div>
            <?php
          endwhile;
        endif;
        ?>
      </div>
      <div class="se-picture-session image-settings" style="background-image:url('<?php echo get_field('session_bild');?>')">
      </div>
    </div>
<?php
  }
$sessionCount++;
endwhile; endif;


get_footer(); ?>
