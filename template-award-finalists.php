<?php
/*
* Template Name: Award Template
*/

get_header();

/*QUERY*/
$main_partner_args = array(
  'post_type' => 'partner', 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array(
    array(
      'taxonomy' => 'Kategorie', 'field' => 'term_id', 'terms' => array(6),
    ),

  ),
);
$main_partner = new WP_Query($main_partner_args);


?>

<!--Award Main Content-->
<div class="se-strip" style="padding-bottom:50px;" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
  <div class="se-content">
    <div class="se-col-12">
      <h1><?php echo the_title(); ?></h1>
      <p><?php echo the_content(); ?></p>
    </div>
  </div>
</div>


<!--Main Award-->
<div class="se-strip se-partner-strip" style="padding-top: 0px;" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
  <div class="se-content" style="position:relative;">

    <!--Main Award Content-->
    <?php
    $taxArgs = array('taxonomy' => 'Jahrgang', 'order' => 'DSC',); //ordnung umkehren ASC/DSC
    $terms = get_terms($taxArgs);

    if ( $terms && !is_wp_error( $terms ) ) :
      foreach ( $terms as $term ) {
        $award_args = array(
          'post_type' => 'award', 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array(
            array(
              'taxonomy' => 'Jahrgang', 'field' => 'term_id', 'terms' => $term->term_id,
            ),
          ),
        );
        $awards = new WP_Query($award_args);
        ?>
        <div class="se-award-jahr-container">
          <div class="se-partner-kategorie" style="border-bottom: solid 2px <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>; margin-bottom:10px;">
            <h3><?php echo $term->name; ?></h3>
          </div>

          <?php
           if ( $awards->have_posts() ) : while ( $awards->have_posts() ) : $awards->the_post();
            $cat_icon = 'icon_cat_1.svg';
            $awardID = get_the_ID();
            $categories = get_the_terms($awardID, 'Awardkategorie' );
            if ($categories) {
              $categorie = $categories[0]->slug;
            } else {
              $categorie = 'default';
            }

            switch ($categorie) {
              case 'inventors':
                $cat_icon = 'icon_cat_1.svg';
                break;
              case 'start-ups':
                $cat_icon = 'icon_cat_2.svg';
                break;
              case 'innovation-leaders':
                $cat_icon = 'icon_cat_3.svg';
                break;
              default:
                $cat_icon = 'icon_cat_1.svg';
                break;
            }

            $winner = get_field('award_gewinner');
            if ($winner) {
           ?>

            <div class="se-award-box-container se-sc-bg image-settings " style="background-image:url('<?php echo get_field('gewinner_bild'); ?>');">

              <div class="se-award-info-container se-sc-bg se-wc-txt">
                <p><?php echo get_field('award_text'); ?></p>
                <a href="<?php echo get_field('award_webseite'); ?>" target="_blank" style="float:left;">
                  <div class="se-award-button mc-button-neg se-mc-txt" style="margin:0; margin-left: 48px; border: solid 2px <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>; float:left;">
                    <?php echo __( 'WEBSEITE', 'SimplEvent' ); ?>
                  </div>
                </a>
                <?php $awardVideo = get_field('award_video');
                  if ($awardVideo) { ?>
                    <div data-id="<?php echo get_the_ID(); ?>" class="se-award-button mc-button-neg-icon se-mc-txt se-award-video" style="margin:0; margin-left: 10px; border: solid 2px <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>; float:right; right:10%;">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/play-button.svg" alt="" height="20px">
                    </div>
                  <?php }
                ?>

              </div>

              <div class="se-award-bar se-sc-bg se-wc-txt">
                <img src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $cat_icon; ?>" alt="" height="40px">
                <h4><?php echo the_title(); ?></h4>
              </div>

            </div>
          <?php } endwhile; endif;  ?>
        </div>
        <?php
      }
    endif; ?>



  </div>
</div>

    <!--Award Lightbox-->

<script type="text/javascript">
jQuery(document).ready(function($){

  //lightbox
  var ajaxurl = $('.se-partner-strip').data('url');
  var awardPlayTrigger = $('.se-award-video');
  var lightboxContainer = $('.se-award-lightbox-container');
  var lightboxCloser = $('.se-award-lightbox-container');

  var seLoaderDIV = '<div class="se-loader"><svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="125.812px" height="125.812px" viewBox="0 0 125.812 125.812" enable-background="new 0 0 125.812 125.812" xml:space="preserve"><circle class="load-d1" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="13.666" cy="63.24" r="8.282"/> <circle class="load-d2" fill="#FFFFFF" stroke="#dedede"stroke-width="1" stroke-miterlimit="10" cx="46.42" cy="63.24" r="8.282"/><circle class="load-d3" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="79.173" cy="63.24" r="8.282"/><circle class="load-d4" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="111.928" cy="63.24" r="8.282"/></svg></div> ';

  awardPlayTrigger.on('click', function(){
    var kID = $(this).data('id');


    $('body').append('<div class="se-award-lightbox-container"></div>');
    $('.se-award-lightbox-container').animate({'opacity': '1'});
    $('.se-award-lightbox-container').append(seLoaderDIV);
    $('.se-loader').addClass('se-loader-center');
    $('.se-loader').css({'margin-top': '0'}).fadeIn();
    seLoaderAnim($('.se-loader'));
    tlLoader.play();
    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        cid : kID,
        action : 'se_award_video_load'
      },

      error : function( response ){
        console.log(response);
      },
      success : function( response ){
        $('.se-award-lightbox-container').append(response);
        console.log(response);
        $('.se-loader').css({'margin-top': '40vh'})
      }
    });
  });

  function seLoaderAnim(e){
  var dots = e.find('#Ebene_1 circle');
      tlLoader = new TimelineMax({repeat:-1});

  tlLoader
    .staggerTo(dots, 0.3, {y: '-6px', fill: '#dedede', stroke: '#dedede',  scale: 1.2, ease:Power1.easeIn}, 0.2)
    .staggerTo(dots, 0.3, {y: '0px', fill: '#fff', stroke: '#dedede',   scale: 1, ease:Power1.easeOut}, 0.2, "-=0.5");
  }


  $( document ).ajaxComplete(function(){
    var lightboxCloser = jQuery('.se-award-lightbox-container');
    $('.closer').on('click', function(){
      console.log('asdfasdf');
      $('body').find('.se-award-lightbox-container').remove();
    });
  });

  $('.se-award-lightbox-container').on('click', function(){
    //console.log('hallasdfsa');
    $('body').find('.se-award-lightbox-container').remove();
  });


});
</script>


<?php
get_footer(); ?>
