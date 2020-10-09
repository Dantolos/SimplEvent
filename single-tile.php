<?php

get_header();
$rCount = 0;
$mainColorSVG = esc_attr( get_option( 'main_color_picker' ) );
?>
<style>
.se-header-title-placeholder{ height:0 !important; }
</style>

<!--HEADER-->
<div class="se-strip image-settings" style="background-image:url(<?php echo get_field('bild'); ?>); min-height:300px;">
    <div class="se-tile-page-header">
        <div class="se-mc-bg se-wc-txt">
            <h5><?php echo get_field('tile_slug'); ?></h5>
        </div>
    </div>
</div>

<!--CONTENT-->
<div class="se-strip" style="">
    <div class="se-content">

        <!--TEXT-->
        <div class="se-col-8 se-tile-page-content">
            <h2><?php echo get_field('tile_titel'); ?></h2>
            <p><?php echo get_field('tile_text'); ?></p>
            
            <?php if(false) { if( get_field('tile_facts_anmeldung') ) { ?>
                <a href="<?php echo get_field('tile_facts_anmeldung'); ?>" target="_blank">
                    <div class="mc-button-neg se-mc-txt button-border" style="margin:20; ">
                        <?php echo __('Jetzt Anmelden', 'SimplEvent'); ?>
                    </div>
                </a>
            <?php } } ?> 

            <!-- REFERENTEN -->
            <?php
            if( get_field('tile_speaker') )
            {
              foreach(get_field('tile_speaker') as $tileSpeaker )
              {
                echo '<div class="tile-speaker-container" style="display:flex; flex-wrap: wrap; margin-top:50px;">';
                echo '<div class="tile-speaker-image image-settings " style="background-image:url(' . $tileSpeaker['tile_speaker_bild'] . ');"></div>';
                echo '<div class="tile-speaker-container" style="width:60%; margin-left:5%;">';
                echo '<h2>' . $tileSpeaker['tile_speaker_name'] . '</h2>';
                echo '<p class="se-mc-txt">' . $tileSpeaker['tile_speaker_funktion'] . '</p>';
                echo '<p>' . $tileSpeaker['tile_speaker_cv'] . '</p>';
                echo '</div>';
                echo '</div>';
              }
            }
            ?>
            
        </div>

        <!--FACTS-->
        <div class="se-col-4 se-sc-bg se-wc-txt se-tile-page-facts-box">
            <h3 class="se-mc-txt">FACTS</h3>
            <table class="se-tile-page-facts-table">

                <?php 
                //FACT LIST
                if( have_rows('tile_facts') ):
                    while( have_rows('tile_facts') ): the_row();
                        
                        $factKeys = array_keys( get_row('tile_facts_datum') );
                        $frLabels = array( 
                          'Date', 'Heure', 'Lieu', 'Participants', 'Coût', 'Inscription'
                        );
     
                        foreach ($factKeys as $key => $fact) {
                          if( get_sub_field($fact) ) {
                            if(get_field('sprache') == 'fr')
                            {
                              $label = $frLabels[$key];
                            } else {
                              $label = get_sub_field_object($fact)['label'];
                            }
                              
                            
                              echo '<tr><td>' . $label . '</td>';
                              echo '<td style="line-break: auto;">' . get_sub_field($fact) . '</td></tr>';
                          }   
                        }

                    endwhile;
                endif;
                ?>
                
            </table>
        </div>

    </div>

</div>

<!--REVIEW-->
<?php 
    $video = get_field('tile_review_video'); 
    $colNR = ($video) ? 6 : 12;
    if(get_field('tile_review_aktive')){
?>
<div class="se-strip image-settings se-sc-bg se-wc-txt" style="margin-top:50px;">

    <div class="se-content se-tile-page-review" style="margin-bottom:50px;">
        <?php if( $video ) { ?>
            <div class="se-col-<?php echo $colNR; ?> se-wc-txt se-speaker-review-video" style="padding-right:20px;">
                <iframe width="100%" height="100%" src="<?php echo $video; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php } ?> 
        <div class="se-col-<?php echo $colNR; ?>">
            <h4><span class="se-mc-txt">REVIEW | </span><?php echo get_field('tile_review_titel'); ?></h4>
            <p><?php echo get_field('tile_review_text'); ?></p>
        </div>
    </div>

    <?php 
    if( get_field('tile_review_galerie') ) { ?>
      
        <div class="button-border se-review-button se-review-gallery-btn" style="text-align:center; width:10%; margin-left:45%;" pagid="<?php echo get_the_ID(); ?>" galid="<?php echo $rCount; ?>">
            <svg version="1.1" id="Fotos" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="50%" y="50%"
                viewBox="0 0 148.7 148.7" style="enable-background:new 0 0 148.7 148.7;" xml:space="preserve">
                <g>
                    <g>
                    <path class="icon-in" fill="<?php echo $mainColorSVG; ?>" d="M74.4,98.1c-13.2,0-24-10.8-24-24c0-13.2,10.8-24,24-24s24,10.8,24,24C98.4,87.4,87.6,98.1,74.4,98.1z
                        M74.4,52.8C62.6,52.8,53,62.4,53,74.1c0,11.8,9.6,21.3,21.3,21.3s21.3-9.6,21.3-21.3C95.7,62.4,86.1,52.8,74.4,52.8z"/>
                    </g>
                    <g>
                    <path class="icon-in" fill="<?php echo $mainColorSVG; ?>" d="M118.6,107.5H30.1c-7.2,0-9.1-5.9-9.1-9.1V49.6c0-7.2,5.9-9.1,9.1-9.1h88.6c7.2,0,9.1,5.9,9.1,9.1v48.8
                        C127.7,105.6,121.8,107.5,118.6,107.5z M30.1,43.3c-0.7,0-6.4,0.2-6.4,6.4v48.8c0,0.6,0.2,6.4,6.4,6.4h88.6c0.6,0,6.4-0.2,6.4-6.4
                        V49.6c0-0.6-0.2-6.4-6.4-6.4H30.1z"/>
                    </g>
                </g>
            </svg>
        </div>
        <h5 style="text-align:center;"><?php echo __('FOTOS', 'SimplEvent'); ?></h5>
    <?php } ?>

</div>
<?php } ?>


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
        fieldname : 'tile_review_galerie',
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

    $('.closer').parent().on('click', '.closer', function(){
      $('.se-lb-wrapper').remove();
    });

    $('.se-review-gallery').parent().on('click', '.se-review-gallery', function(){
      $('.se-review-gallery-img').remove();
      var actSRC = $(this).attr('imgsrc');
      var appendation = '<div class="se-review-gallery-img image-settings" style="background-image:url('+actSRC+');"></div>';
      $('body').append(appendation);

      TweenMax.from($('.se-review-gallery-img'), 0.3, { autoAlpha: 0, scale: 0.8, ease:Power1.easeOut} );
    });

    $('.se-review-gallery-img').parent().on('click', '.se-review-gallery-img', function(){
      TweenMax.to($('.se-review-gallery-img'), 0.3, { autoAlpha: 0, scale: 0.8, ease:Power1.easeOut} );
    });

  });


});
</script>


<?php
get_footer();