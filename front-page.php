<?php
get_header();

$Modular = new Modular;
$seButton = new seButton;
$seLink = new LinkIcon;
$curPageID = get_option( 'page_on_front' );


//QUERY der Slides
$slider = array( 'post_type' => 'slider' );
$sliderQuery = new WP_Query( $slider );

$slideArray = array();

if ( $sliderQuery -> have_posts() ) :
    while ( $sliderQuery->have_posts() ) : $sliderQuery->the_post();

      if( have_rows('slider') ):
          while ( have_rows('slider') ) : the_row();
              $type = get_row_layout();

              $image = get_sub_field('slider_bild');
              $layer = '';
              if(get_sub_field('layer')){
                $layer = get_sub_field('layer');
              }
              $zitat = '';
              if(get_sub_field('zitat')) {
                $zitat = get_sub_field('zitat');
              }


              $referent = get_sub_field('referentenbezeichnung');
              $referentname = $referent ? $referent['referent'] : 'empty';
              $referentfunktion = $referent ? $referent['funktion'] : 'empty';
              $referentcolor = $referent ? $referent['textfarbe'] : 'empty';


              $button = get_sub_field('verlinkung');
              $buttonOO = '';
              $buttonlink = '';
              $buttontext = '';
              if ( $button['button'] ) {
                $buttonOO = $button['button'];
                $buttonlink = $button['buttonlink'];
                $buttontext = $button['buttontext'];
              }

              $slider = array(
                'type' => $type,
                'image' => $image,
                'layer' => $layer,
                'zitat' => $zitat,
                'name' => $referentname,
                'funktion' => $referentfunktion,
                'button' => $buttonOO,
                'buttonlink' => $buttonlink,
                'buttontext' => $buttontext,
                'color' => $referentcolor,

                'datum' => get_sub_field('datum'),
                'logo' => get_sub_field('logo'),
                'titel' => get_sub_field('titel'),
                'logosize' => get_sub_field('logosize'),
                'textcolor' => get_sub_field('textfarbe')
              );
              array_push($slideArray, $slider);

          endwhile;
      endif;

  endwhile;
endif;

?>

<!--Header-Slider-->
<?php
if( empty( get_option( 'se_livestream' ) ) ) {  //check ob live event
  if($sliderQuery) {

  ?>
  <div id="slider" class="se-slider-header-container image-settings se-slider-mobile-align-left" style="background-image:url('<?php  echo $slideArray[0]['image']; ?>');">


      <div id="sliderlayer" class="image-settings" style="background-image:url(<?php if(!empty( $slideArray[0]['layer'] )) { echo $slideArray[0]['layer']; } ?>); height:100%; width:100%; background-size:160%; background-position:50% 0;"> </div>

      <?php
      $typeOrder;
      switch ( $slideArray[0]['type'] ) {
        case 'zitat':
          $typeOrder = array( 'block', 'none' );
          break;
        case 'titel':
          $typeOrder = array( 'none', 'block' );
          break;
        default:
          $typeOrder = array( 'none', 'block' );
          break;
      }

      $displayer = $slideArray[0]['zitat'] ? 'block' : 'none'; //if zitat in zitat
      ?>

      <!-- zitat -->
      <div id="se-slider-type-zitat" class="se-slider-header-text-container" style="display:<?php echo $typeOrder[0]; ?>;">

        <div class="se-slider-type-zitat">

          <div class="se-slider-header-zitat" style="display:<?php echo $typeOrder[$typeDisplayer]; ?>;">
            <p class="" style="display:<?php echo $displayer; ?>;"><strong>&laquo;</strong><?php echo $slideArray[0]['zitat']; ?><strong>&raquo;</strong></p>
          </div>

          <p id="slidename" style="margin-top:20px; color:<?php echo $slideArray[0]['color']; ?>;"><strong><?php echo $slideArray[0]['name']; ?></strong></p>
          <p id="slidefunktion" style="color:<?php echo $slideArray[0]['color']; ?>; font-weight: 300;"><?php echo $slideArray[0]['funktion']; ?></p>

          <?php if($slideArray[0]['button']){ ?>
            <a id="slidebutton" href="<?php echo $slideArray[0]['buttonlink']; ?>">
              <div class="se-mc-bg mc-button se-wc-txt">
                <?php echo $slideArray[0]['buttontext']; ?>
              </div>
            </a>
          <?php } ?>

        </div>
      </div>
      <!-- zitat END-->

      <!-- titel -->
      <div id="se-slider-type-titel" class="" style="display:<?php echo $typeOrder[1]; ?>; color: <?php echo $slideArray[0]['textcolor']; ?>;">
        <div id="sliderLogo" style="padding:0 <?php echo $slideArray[0]['logosize']; ?>%;">
          <img src="<?php echo $slideArray[0]['logo']; ?>" alt="" width="auto" height="auto">
        </div>
        <h2 id="sliderTitel"><?php echo $slideArray[0]['titel']; ?></h2>
        <h4 id="sliderDatum"><?php echo $slideArray[0]['datum']; ?></h4>
        <?php if($slideArray[0]['button']){ ?>
          <a id="slidebutton" href="<?php echo $slideArray[0]['buttonlink']; ?>">
            <div class="se-mc-bg mc-button se-wc-txt">
              <?php echo $slideArray[0]['buttontext']; ?>
            </div>
          </a>
        <?php } ?>
      </div>
      <!-- titel END-->

  </div>
<?php
  }
} else { //live version mit livestream
?>
  <!-- Livestream Frame -->
  <div id="" class="se-slider-header-container se-slider-mobile-align-left se-slider-stream-frame">
    <?php echo get_option( 'se_iframe' );?>
  </div>

  <!-- Next Programm -->
  <div class="se-sc-bg se-programm-next">
    <div class="se-content">

      <div class="se-col-12 se-wc-txt">
        <div class="" style="margin-top:20px; ">
          <?php
          $slug = 'programm';
          $programmPage = get_page_by_path( $slug );

          $now = new DateTime();
          $now = $now->setTimezone(new DateTimeZone('Europe/Zurich'));
          if( have_rows('programmraster', $programmPage->ID ) ):
            while ( have_rows('programmraster', $programmPage->ID ) ) : the_row();
              if( get_row_layout() == 'programmpunkt' ) {
                if( get_sub_field('programmpunkt_zeit') ) {
                  $programmZeit = substr(get_sub_field('programmpunkt_zeit'), 0, 5);

                  if( str_replace( ':', '', $now->format('H:i') ) < str_replace('.', '', $programmZeit) ) {
                    ?>

                      <h6 style="border-bottom: solid 1px #fff; margin-bottom:10px; padding-bottom:5px;">
                        <span style="opacity:.6;"><?php echo __('Nächster Programmpunkt', 'SimplEvent') ?></span>
                        <span style="float: right;"><b><?php echo the_sub_field('programmpunkt_zeit'); ?></b></span>
                      </h6>

                      <?php
                      $programmLink = get_sub_field('programmpunkt_verlinkung');
                      if( $programmLink ) {
                        echo '<a href="' . $programmLink . '">';
                      } ?>

                        <h4><b><?php echo the_sub_field('programmpunkt_titel'); ?></b></h4>
                        <H6><?php echo the_sub_field('programmpunkt_subtext'); ?></H6>

                      <?php
                      if( $programmLink ) { echo '</a>'; }

                      echo '<div class="se-programm-next-btn">';
                      echo $seLink->getLinkIcon('www.google.ch', 'zum Programm');
                      echo '</div>';

                    break;
                  }
                }
              }
          endwhile; endif;
          ?>
        </div>
      </div>

    </div>
  </div>
  <!-- Next Programm END-->

<?php
}


//CONTENT

if( get_field('strip', $curPageID)  ) {
  $Strips = get_field('strip', $curPageID);
  foreach ($Strips as $Strip) {

    if($Strip["strip_settings"]['public']) {
      echo $Modular->getLayout( $Strip );
    }
  }
}
?>

<!-- NEWS -->
<?php if( get_field('newsroom_teaser', $curPageID) ) {?>
  <div class="se-strip">
    <div class="se-content">
      <div class="se-col-12">
        <h1>NEWS</h1>
        <?php echo get_field('newsroom_teaser', $curPageID); ?>
      </div>
    </div>
  </div>
<?php } ?>

<script>
  jQuery(function($){
    //SLIDER
    //mobile detect
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
        isMobile = true;
    }
    //conf
    var width = '100vw';
    var animationSpeed = 1000;

    var slideCounter = 0;
    var pause = 6000;

    var currentSlide = 1;

    var TitelSlide = $('#se-slider-type-titel');
    var ZitatSlide = $('#se-slider-type-zitat');

    var sliderContainer = $('#slider');
    var sliderLayer = $('#sliderlayer');
    var slidesTC = $('.se-slider-header-text-container');
    var slideZitat = $('.se-slider-header-zitat');
    var slideName = $('#slidename');
    var slideFunktion = $('#slidefunktion');
    var slideButton = $('#slidebutton');
    var slideTextColor = [slideName, slideFunktion];

    var sliderLogo = $('#sliderLogo');
    var sliderTitel = $('#sliderTitel');
    var sliderDatum = $('#sliderDatum');

    var SlideArray = <?php echo json_encode($slideArray); ?>;

    var interval;
    function startSlider() {

      interval = setInterval(function() {
        slideCounter++;

        ZitatSlide.fadeOut();
        TitelSlide.fadeOut();
        sliderLayer.fadeOut();
        slidesTC.animate({ }, function() {
            slideZitat.fadeOut();

            setTimeout(function(){
              slideZitat.empty();
              slideName.empty();
              slideFunktion.empty();
              slideButton.empty();

              sliderLogo.find('img').attr('src', '');
              sliderLogo.hide();
              sliderTitel.empty();
              sliderDatum.empty();
            }, 500);
        });

        var bildSRC = SlideArray[currentSlide]['image'];
        sliderContainer.animate({'opacity': 0, 'margin-right': '-50'}, function() {
            $(this).css({'background-image': 'url(' + bildSRC + ')', 'background-size': 'cover'})
            .animate({'opacity': 1, 'margin-right': 0}, 200);
        });

        setTimeout(function() {
            var offsetRight = (!isMobile) ? '20vw' : '5vw';
            var displayer = (SlideArray[currentSlide]['zitat']) ? 'block' : 'none';
            var typeDisplayer;
            switch (SlideArray[currentSlide]['type']) {
              case 'zitat':
                typeDisplayer = ['block', 'none'];
                break;
              case 'titel':
                typeDisplayer = ['none', 'block'];
                break;
              default:
            }
            ZitatSlide.css({'display': typeDisplayer[0]});
            TitelSlide.css({'display': typeDisplayer[1], 'color': SlideArray[currentSlide]['textcolor']});


            //Zitat
            slidesTC.css({'right': '-500', 'opacity': '0'}).animate({'right': offsetRight, 'opacity': '1' }, 700);
            //layer
            sliderLayer.css({'display': 'displayer', 'background-image': 'url('+SlideArray[currentSlide]['layer']+')'});
            sliderLayer.fadeIn();
            slideZitat.css({'display': displayer});
            slideName.css({'color': SlideArray[currentSlide]['color']});
            slideFunktion.css({'color': SlideArray[currentSlide]['color']});
            slideZitat.append('<p><strong>&laquo;</strong>' + SlideArray[currentSlide]['zitat'] + '<strong>&raquo;</strong></p>');
            slideName.append('<strong>' + SlideArray[currentSlide]['name'] + '</strong>');
            slideFunktion.append(SlideArray[currentSlide]['funktion']);
            if ( SlideArray[currentSlide]['button'] === true ) {
              slideButton.attr('href', SlideArray[currentSlide]['buttonlink']);
              slideButton.append('<div class="se-mc-bg mc-button se-wc-txt">' + SlideArray[currentSlide]['buttontext'] + '</div>');
            }

            let logosize = '0 ' + SlideArray[currentSlide]['logosize'] + '%';
            sliderLogo.css({'padding': logosize });
            sliderLogo.find('img').attr('src', SlideArray[currentSlide]['logo']);
            sliderLogo.fadeIn();
            sliderTitel.append(SlideArray[currentSlide]['titel']);
            sliderDatum.append(SlideArray[currentSlide]['datum']);


            currentSlide++;
            if (currentSlide === SlideArray.length) {
              currentSlide = 0;
            }
        }, 800);

      }, pause);
    }

    function stopSlider() {
        clearInterval(interval);
    }
    if(SlideArray.length > 1) {
      startSlider();
    }

    slidesTC.on('mouseenter', stopSlider).on('mouseleave', startSlider);

    //parallax
    var $el = $('#slider');
    var $layer = $('#sliderlayer');
    var $titel = $('#se-slider-type-titel');
    var $zitat = $('#se-slider-type-zitat');
    var screenHeight = parseInt( $(window).height() ) / 100 * 20;
    $(window).on('scroll', function () {
        var scroll = $(document).scrollTop();
        if(!isMobile) {
          $el.css({ 'background-position':'center '+(+.4*scroll)+'px' });
        } else {
          $el.css({ 'background-position':'20% '+(+.4*scroll)+'px' });
        }


        $layer.css({ 'background-position':'50% '+(+.3*scroll)+'px' });
         $zitat.css({ 'bottom': screenHeight+(-.2*scroll)+'px' });
         $titel.css({ 'bottom': screenHeight+(-.2*scroll)+'px' });
    });

  });
</script>

<?php get_footer(); ?>
