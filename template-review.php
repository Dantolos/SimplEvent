<?php
/*
* Template Name: Review Template
*/

get_header();

$Olink = new LinkIcon;
$rCount = 0;


//Button Medien in Variable
function createMediaBtn($rC) {
  $mainColorSVG = esc_attr( get_option( 'main_color_picker' ) );
  $RevMediaButton = '<div class="se-review-col" style="text-align:center;">';
  $RevMediaButton .= '<div class="button-border se-review-button se-review-medien-button" mid="' . $rC . '"  mopen="N">';
  $RevMediaButton .= '<a>';
  $RevMediaButton .= '<svg version="1.1" id="Fotos" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="50%" y="50%"
	 viewBox="0 0 453.541 311.809" enable-background="new 0 0 453.541 311.809" xml:space="preserve" height="70px">';


  $RevMediaButton .= '<style type="text/css"> .icon-in{fill:'. esc_attr( get_option( 'main_color_picker' ) ) .' !important;} </style>';
  $RevMediaButton .= '
      <path fill="'. $mainColorSVG .'" d="M306.331,274H149.169c-4.78,0-8.669-3.89-8.669-8.67V47.169c0-4.78,3.889-8.669,8.669-8.669h157.162
			c4.78,0,8.669,3.889,8.669,8.669v218.161C315,270.111,311.111,274,306.331,274z M149.169,44.5c-1.472,0-2.669,1.197-2.669,2.669
			v218.161c0,1.473,1.197,2.67,2.669,2.67h157.162c1.472,0,2.669-1.197,2.669-2.67V47.169c0-1.472-1.197-2.669-2.669-2.669H149.169z
			"/>

  		<rect class="icon-in" x="155.5" y="91.561" fill="'. $mainColorSVG .'" width="144.25" height="6"/>

  		<rect class="icon-in" x="155.5" y="112.811" fill="'. $mainColorSVG .'" width="144.25" height="6"/>

  		<rect class="icon-in" x="155.5" y="134.062" fill="'. $mainColorSVG .'" width="144.25" height="6"/>

  		<rect class="icon-in" x="155.5" y="155.311" fill="'. $mainColorSVG .'" width="144.25" height="6"/>

  		<rect class="icon-in" x="155.5" y="176.561" fill="'. $mainColorSVG .'" width="144.25" height="6"/>

  		<rect class="icon-in" x="155.5" y="197.811" fill="'. $mainColorSVG .'" width="144.25" height="6"/>

  		<rect class="icon-in" x="155.5" y="219.061" fill="'. $mainColorSVG .'" width="144.25" height="6"/>

  		<rect class="icon-in" x="155.5" y="240.311" fill="'. $mainColorSVG .'" width="78.25" height="6"/>

  		<path fill="'. $mainColorSVG .'" d="M300.089,79.321H155.16V61.349h144.928V79.321z M161.16,73.321h132.928v-5.972H161.16V73.321z"/>
      ';
  $RevMediaButton .= '</svg></a></div>';
  $RevMediaButton .= '<h5>' . __('MEDIEN', 'SimplEvent') . '</h5>';
  $RevMediaButton .= '<h6>'. __('Medienmitteungen und Verlagsbeilagen', 'SimplEvent') . '</h6>';
  $RevMediaButton .= '</div>';

  echo $RevMediaButton;

}

if( have_rows('reviews') ) {
  while ( have_rows('reviews') ) : the_row();
    $thumb = get_sub_field('thumb');
    $jahr = get_sub_field('jahr');
    $jahr = ($jahr) ? $jahr[0]->name : false;
    $refLink = home_url() . '/speaker/?j=' . $jahr;

  ?>

    <div class="se-strip se-review-strip" style="padding: 0; position:relative;" rid="<?php echo $rCount; ?>" >
      <?php
        if( get_sub_field('report') ){
          echo '<div class="se-review-bg"><iframe width="100%" height="100%" src="' . get_sub_field('report') . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
        } else {
          echo '<div class="se-review-bg image-settings" style="background-image:url( ' . $thumb['url'] . ' );"></div>';
        }
      ?>

      <div class="se-wc-bg se-sc-txt se-review-content" style="border-left:2px solid <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>;">
        <div class="se-review-content-title" style="position:relative;" rid="<?php echo $rCount; ?>" copen="N">
          <h5><?php echo get_sub_field('motto'); ?></h5>
          <p class="se-mc-txt" style="margin-bottom:40px;"><?php echo get_sub_field('ort'); ?>, <?php echo get_sub_field('datum'); ?></p>
          <?php echo $Olink->LinkArrow; ?>
        </div>
        <div class="se-review-content-inner clearfix" style="display:none;" rid="<?php echo $rCount; ?>">

          <p><?php echo get_sub_field('zusammenfassung'); ?></p>


          <!-- Speakers -->
          <?php if($jahr) { ?>
            <div class="se-review-col" style="text-align: center;">
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
              <h5><?php echo __('REFERENTEN', 'SimplEvent'); ?></h5>
              <h6><?php echo __('Schauen Sie isch alle Referate nochmals in Ruhe an', 'SimplEvent') ?></h6>
            </div>
          <?php } ?>

          <!-- Medien -->
          <?php
          if (!wp_is_mobile() && get_sub_field('medienmitteilungen') ) {
            createMediaBtn($rCount);
          }
          ?>


          <!-- Fotos -->

          <?php

          if( get_sub_field('gallery') ) { ?>
            <div class="se-review-col" style="text-align:center;">
              <div class="button-border se-review-button se-review-gallery-btn" pagid="<?php echo get_the_ID(); ?>" galid="<?php echo $rCount; ?>">
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
              <h5><?php echo __('FOTOS', 'SimplEvent'); ?></h5>
              <h6><?php __('Impressionen rund um die Bühne', 'SimplEvent')  ?></h6>
            </div>
          <?php } ?>


          <!-- Medien -->
          <?php
          if (wp_is_mobile() && get_sub_field('medienmitteilungen')) {
            createMediaBtn($rCount);
          }
          ?>


          <!-- Inhalt Medien -->

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

  //mobile detect
  var isMobile = false; //initiate as false
  // device detection
  if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
      isMobile = true;
  }

  var OIcon = $('.se-review-content-title svg');
  TweenMax.set(OIcon, {rotation:-90});

  var TitelBar = $('.se-review-content-title');


  TitelBar.on('mouseenter', function(){
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
  TweenMax.set(mediaBars, {autoAlpha: 0, y: '20px'});
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

  //gallery LightBox
  var LBclass = new LightBox;
  var ReviewGalleryBtn = $('.se-review-gallery-btn');

  ReviewGalleryBtn.on('click', function(){
    $('.se-lb-wrapper').remove();
    var cont = $(this).attr('galid');
    var page = $(this).attr('pagid');
    var ajaxurl = $('header').data('url');

    LBclass.seOpenLB();

    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        gaid : cont,
        paid : page,
        fieldname : 'reviews',
        action : 'se_review_gallery_load'
      },

      error : function( response ){
        $('.se-speaker-content-container').append(response)
      },
      success : function( response ){

        $('.se-loader').remove();
        LBclass.seLoadLB(response);

        if(!isMobile){
          $('.se-lb-frame').css({
            'background-color': 'unset',
            'width': '90vw',
            'height': '90vh',
            'margin-top': '-45vh',
            'margin-left': '-45vw',
            'box-shadow': 'unset'
          });
        }else{
          $('.se-lb-frame').css({
            'background-color': 'unset',
            'width': '90vw',
            'height': '70vh',
            'margin-top': '-35vh',
            'margin-left': '-45vw',
            'box-shadow': 'unset'
          });
        }

      }
    });

    $('.closer').live('click', function(){
      $('.se-lb-wrapper').remove();
    });

    $('.se-review-gallery').live('click', function(){
      $('.se-review-gallery-img').remove();
      var actSRC = $(this).attr('imgsrc');
      var appendation = '<div class="se-review-gallery-img image-settings" style="background-image:url('+actSRC+');"></div>';
      $('body').append(appendation);

      TweenMax.from($('.se-review-gallery-img'), 0.3, { autoAlpha: 0, scale: 0.8, ease:Power1.easeOut} );
    });

    $('.se-review-gallery-img').live('click', function(){
      TweenMax.to($('.se-review-gallery-img'), 0.3, { autoAlpha: 0, scale: 0.8, ease:Power1.easeOut} );
    });

  });


});
</script>

<?php
get_footer(); ?>
