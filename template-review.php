<?php
/*
* Template Name: Review Template
*/

get_header();

$Olink = new LinkIcon;
$rCount = 0;
if( have_rows('reviews') ) {
  while ( have_rows('reviews') ) : the_row();
    $thumb = get_sub_field('thumb');
    $jahr = get_sub_field('jahr');
    $jahr = $jahr[0]->name;
    $refLink = home_url() . '/speaker/?j=' . $jahr;
  ?>

    <div class="se-strip se-review-strip" style="padding: 0; position:relative;" rid="<?php echo $rCount; ?>" >
      <div class="se-review-bg image-settings" style="background-image:url(<?php echo $thumb['url']; ?>);">

      </div>
      <div class="se-sc-bg se-wc-txt se-review-content" style="border-left:2px solid <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>;">
        <div class="se-review-content-title" style="position:relative;" rid="<?php echo $rCount; ?>" copen="N">
          <h5><?php echo get_sub_field('motto'); ?></h5>
          <p class="se-mc-txt" style="margin-bottom:40px;"><?php echo get_sub_field('ort'); ?>, <?php echo get_sub_field('datum'); ?></p>
          <?php echo $Olink->LinkArrow; ?>
        </div>
        <div class="se-review-content-inner clearfix" style="display:none;" rid="<?php echo $rCount; ?>">

          <p><?php echo get_sub_field('zusammenfassung'); ?></p>
          <div class="se-review-col" style="text-align:center;">
            <div class="button-border se-review-button">
              <svg version="1.1" id="Fotos" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="50%" y="50%"
                 viewBox="0 0 148.7 148.7" style="enable-background:new 0 0 148.7 148.7;" xml:space="preserve">
              <style type="text/css">
                .icon-in{fill:#C3B940;}
              </style>
              <g>
                <g>
                  <path class="icon-in" d="M74.4,98.1c-13.2,0-24-10.8-24-24c0-13.2,10.8-24,24-24s24,10.8,24,24C98.4,87.4,87.6,98.1,74.4,98.1z
                     M74.4,52.8C62.6,52.8,53,62.4,53,74.1c0,11.8,9.6,21.3,21.3,21.3s21.3-9.6,21.3-21.3C95.7,62.4,86.1,52.8,74.4,52.8z"/>
                </g>
                <g>
                  <path class="icon-in" d="M118.6,107.5H30.1c-7.2,0-9.1-5.9-9.1-9.1V49.6c0-7.2,5.9-9.1,9.1-9.1h88.6c7.2,0,9.1,5.9,9.1,9.1v48.8
                    C127.7,105.6,121.8,107.5,118.6,107.5z M30.1,43.3c-0.7,0-6.4,0.2-6.4,6.4v48.8c0,0.6,0.2,6.4,6.4,6.4h88.6c0.6,0,6.4-0.2,6.4-6.4
                    V49.6c0-0.6-0.2-6.4-6.4-6.4H30.1z"/>
                </g>
              </g>
              </svg>
            </div>
            <h5>FOTOS</h5>
            <h6>Impressionen rund um die Bühne</h6>
          </div>
          <div class="se-review-col" style="text-align:center;">
            <a href="<?php echo $refLink; ?>">
              <div class="button-border se-review-button">

                <svg version="1.1" id="Referenten" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="50%" y="50%"
                   viewBox="0 0 148.7 148.7" style="enable-background:new 0 0 148.7 148.7;" xml:space="preserve">
                <style type="text/css">
                  .icon-in{fill:#C3B940;}
                </style>
                <g>
                  <path class="icon-in" d="M91.4,72.9H88c9.2-4.6,15.6-14.2,15.6-25.1c0-15.5-12.6-28.1-28.1-28.1S47.3,32.2,47.3,47.7
                    c0,11,6.3,20.5,15.6,25.1h-5.6c-0.2,0-21.9,0.3-21.9,21.9v34.1h2.7V94.8c0-18.9,18.4-19.2,19.2-19.2h34.1
                    c18.9,0,19.2,18.4,19.2,19.2v34.1h2.7V94.8C113.3,94.6,113,72.9,91.4,72.9z M50,47.7c0-14,11.4-25.4,25.4-25.4
                    c14,0,25.4,11.4,25.4,25.4c0,12.8-9.5,23.4-21.7,25.1h-7.4C59.5,71.1,50,60.5,50,47.7z"/>
                </g>
                </svg>
              </div>
            </a>
            <h5>REFERENTEN</h5>
            <h6>Schauen Sie alle nochmals alle Referate in Ruhe durch</h6>
          </div>
          <div class="se-review-medien-container" style="display:none;">
            <?php
            $mm = get_sub_field('medienmitteilungen');
            if( $mm ) {
              echo '<div class="se-review-medien-head "><h6>MEDIENMITTEILUNG</h6></div>';
              foreach ( $mm as $row ){
                echo '<a href="' . $row['mm'] . '" target="_blank"><div class=" se-wc-txt se-review-medien-row se-review-media-bar">';
                echo '<h6>' . $row["mm_text"] . '</h6></div></a>';
              }
            }
            $vb = get_sub_field('verlagsbeilage');
            if( $vb ) {
              echo '<div class="se-review-medien-head"><h6>VERLAGSBEILAGE</h6></div>';
              foreach ( $vb as $e ){
                echo '<a href="' . $e['vb'] . '" target="_blank"><div class=" se-wc-txt se-review-medien-row se-review-media-bar">';
                echo '<h6>' . $e['vb_text'] . '</h6></div></a>';
              }
            }
            ?>
          </div>
          <div class="se-review-medien-line" style="border-top:2px solid <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>;">

          <h6 class="se-review-medien-button" mopen="N" mid="<?php echo $rCount; ?>" style="text-align:center;  " class="se-mc-txt">MEDIEN</h6>

          </div>

        </div>

      </div>
    </div>


  <?php
  $rCount++;
  endwhile;
}?>

<script type="text/javascript">
jQuery(document).ready(function($){

  var OIcon = $('.se-review-content-title svg');
  TweenMax.set(OIcon, {rotation:-90});

  var TitelBar = $('.se-review-content-title');


  TitelBar.on('click', function(){
    let cCount = $(this).attr('copen');

    var tOIcon = $(this).find('svg');
    var rID = $(this).attr('rid');

    if(cCount === 'N'){
      TweenMax.to(tOIcon, 0.5, {delay:.25, rotationY:'-180'});
      $('.se-review-content-inner[rid="'+rID+'"]').slideDown();
      $(this).attr('copen', 'Y');
    } else {
      TweenMax.to(tOIcon, 0.5, {delay:.25, rotationY:'+=180'});
      $('.se-review-content-inner[rid="'+rID+'"]').slideUp();
      $(this).attr('copen', 'N');
    }
  });


  var seMC = $('header').attr('semc');
  $('.se-review-strip').find('path').css({'fill': seMC });

  $('.se-review-button').hover(function(){
    TweenMax.to($(this), 0.2, {'border-radius': '10px', y: '-3px', ease:Power1.easeInOut});
  }, function(){
    TweenMax.to($(this), 0.4, {'border-radius': '20px', y: '0px', ease:Power1.easeInOut});
  });


  var mediaBtn = $('.se-review-medien-button');
  var mediaBars = $('.se-review-media-bar');
  TweenMax.set(mediaBars, {autoAlpha: 0, y: '20px'})
  mediaBtn.on('click', function(){
    let mID = $(this).attr('mid');
    let tMedia = $('.se-review-strip[rid="'+mID+'"]').find('.se-review-medien-container');
    let tMediaBars = $('.se-review-strip[rid="'+mID+'"]').find('.se-review-media-bar');
    if($(this).attr('mopen') === "N"){

      tMedia.show();
      TweenMax.staggerTo(tMediaBars, 0.5, {autoAlpha: 1, y: '0px',  ease:Power1.easeInOut }, 0.1);

      $(this).attr('mopen', 'Y');
    } else {
      TweenMax.staggerTo(tMediaBars, 0.5, {autoAlpha: 0,  y: '20px',  ease:Power1.easeInOut }, -0.1);
      tMedia.fadeOut();
      $(this).attr('mopen', 'N');
    }

  });

});
</script>

<?php
get_footer(); ?>
