<?php
get_header();

$Modular = new Modular;
$curPageID = get_option( 'page_on_front' );


//QUERY der Slides
$slider = array( 'post_type' => 'slider' );
$sliderQuery = new WP_Query( $slider );

$slideArray = array();

if ( $sliderQuery -> have_posts() ) :
    while ( $sliderQuery->have_posts() ) : $sliderQuery->the_post();

      if( have_rows('slider') ):
          while ( have_rows('slider') ) : the_row();

              $image = get_sub_field('slider_bild');
              $zitat = '';
              if(get_sub_field('zitat')) {
                $zitat = get_sub_field('zitat');
              }

              $referent = get_sub_field('referentenbezeichnung');
              if ( $referent ) {
                $referentname = $referent['referent'];
                $referentfunktion = $referent['funktion'];
                $referentcolor = $referent['textfarbe'];
              }

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
                'image' => $image,
                'zitat' => $zitat,
                'name' => $referentname,
                'funktion' => $referentfunktion,
                'button' => $buttonOO,
                'buttonlink' => $buttonlink,
                'buttontext' => $buttontext,
                'color' => $referentcolor
              );
              array_push($slideArray, $slider);

          endwhile;
      endif;

  endwhile;
endif;

?>

<!--Header-Slider-->
<?php if($sliderQuery) { ?>
<div id="slider" class="se-slider-header-container image-settings" style="background-image:url('<?php echo $slideArray[0]['image'] ?>');">
  <div class="se-slider-header-text-container">
    <?php $displayer = ($slideArray[0]['zitat']) ? 'inline' : 'none'; ?>
    <p class="se-slider-header-zitat" style="display:<?php echo $displayer; ?>;"><strong>&laquo;</strong><?php echo $slideArray[0]['zitat']; ?><strong>&raquo;</strong></p>

    <p id="slidename" style="margin-top:20px; color:<?php echo $slideArray[0]['color']; ?>;"><strong><?php echo $slideArray[0]['name']; ?></strong></p>
    <p id="slidefunktion" style="color:<?php echo $slideArray[0]['color']; ?>;"><?php echo $slideArray[0]['funktion']; ?></p>
    <a id="slidebutton" href="<?php echo $buttonlink; ?>">
      <div class="se-mc-bg mc-button se-wc-txt" style="margin-left:-15px;">
        <?php echo $buttontext; ?>
      </div>
    </a>
  </div>
</div>
<?php }

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
<div class="se-strip">
  <div class="se-content">
    <div class="se-col-12">
      <h1>NEWS</h1>
      <div data-embed-container data-newsroom-token="1k44kbgxwusdi" data-embed-id="nt-0kSx5c46c46eb0091zIJ7" ></div>
      <script type="text/javascript" src="https://data.newsroom.co/lib/storyshaker-embed/js/storyshaker-embed.js"></script>
    </div>
  </div>
</div>

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

    var sliderContainer = $('#slider');
    var slidesTC = $('.se-slider-header-text-container');
    var slideZitat = $('.se-slider-header-zitat');
    var slideName = $('#slidename');
    var slideFunktion = $('#slidefunktion');
    var slideButton = $('#slidebutton');
    var slideTextColor = [slideName, slideFunktion];

    var SlideArray = <?php echo json_encode($slideArray); ?>;

    var interval
    function startSlider() {

      interval = setInterval(function() {
        slideCounter++;

        slidesTC.animate({'right': '100vw' }, function() {
            slideZitat.empty();
            slideName.empty();
            slideFunktion.empty();
            slideButton.empty();
        });

        var bildSRC = SlideArray[currentSlide]['image'];
        sliderContainer.animate({'opacity': 0, 'margin-right': '-50'}, function() {
            $(this).css({'background-image': 'url(' + bildSRC + ')', 'background-size': 'cover'})
            .animate({'opacity': 1, 'margin-right': 0}, 200);
        });

        setTimeout(function() {
            var offsetRight = (!isMobile) ? '20vw' : '5vw';
            var displayer = (SlideArray[currentSlide]['zitat']) ? 'inline' : 'none';
            slidesTC.css({'right': '-500', 'opacity': '0'}).animate({'right': offsetRight, 'opacity': '1' },700);
            slideZitat.css({'display': displayer})
            slideName.css({'color': SlideArray[currentSlide]['color']});
            slideFunktion.css({'color': SlideArray[currentSlide]['color']});
            slideZitat.append('<strong>&laquo;</strong>'+SlideArray[currentSlide]['zitat']+'<strong>&raquo;</strong>');
            slideName.append('<strong>'+SlideArray[currentSlide]['name']+'</strong>');
            slideFunktion.append('<strong>'+SlideArray[currentSlide]['funktion']+'</strong>');
            if ( SlideArray[currentSlide]['button'] === true ) {
              slideButton.attr('href', SlideArray[currentSlide]['buttonlink']);
              slideButton.append('<div class="se-mc-bg mc-button se-wc-txt" style="margin-left:-15px;">'+SlideArray[currentSlide]['buttontext']+'</div>');
            }
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
    startSlider();
    slidesTC.on('mouseenter', stopSlider).on('mouseleave', startSlider);

  });
</script>

<?php get_footer(); ?>
