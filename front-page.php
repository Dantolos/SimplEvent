<?php
get_header();
$dlicon = new DownloadIcon;
//QUERY der Slides
$slider = array( 'post_type' => 'slider' );
$sliderQuery = new WP_Query( $slider );

$slideArray = array();

if ( $sliderQuery -> have_posts() ) :
    while ( $sliderQuery->have_posts() ) : $sliderQuery->the_post();

      if( have_rows('slider') ):
          while ( have_rows('slider') ) : the_row();

              $image = get_sub_field('slider_bild');
              $zitat = get_sub_field('zitat');

              $referent = get_sub_field('referentenbezeichnung');
              if ( $referent ) {
                $referentname = $referent['referent'];
                $referentfunktion = $referent['funktion'];
              }

              $button = get_sub_field('verlinkung');
              if ( $button ) {
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
                'buttontext' => $buttontext);
              array_push($slideArray, $slider);

          endwhile;
      endif;

  endwhile;
endif;

?>

<!--Header-Slider-->
<div id="slider" class="se-slider-header-container image-settings" style="background-image:url('<?php echo $slideArray[0]['image'] ?>');">
  <div class="se-slider-header-text-container">
    <p class="se-slider-header-zitat"><strong>&laquo;</strong><?php echo $slideArray[0]['zitat']; ?><strong>&raquo;</strong></p>
    <p id="slidename" style="margin-top:20px;"><strong><?php echo $slideArray[0]['name']; ?></strong></p>
    <p id="slidefunktion"><?php echo $slideArray[0]['funktion']; ?></p>
    <a id="slidebutton" href="<?php echo $buttonlink; ?>">
      <div class="se-mc-bg mc-button se-wc-txt" style="margin-left:-15px;">
        <?php echo $buttontext; ?>
      </div>
    </a>
  </div>
</div>

<!--CONTENT-->
<!--strip 1-->
<?php
$sif13 = new WP_Query( array( 'p' => 32 ) );

if ( $sif13 -> have_posts() ) :
	while ( $sif13->have_posts() ) : $sif13->the_post();
	?>
    <div class="se-strip clearfix">
      <div class="se-content">
        <div class="se-col-4" >
          <img src="<?php echo the_post_thumbnail_url(); ?>" alt="SIF Broschuere" width="80%" style="margin:auto;">
        </div>
        <div class="se-col-8" >
          <?php echo the_content();
          $dlfileLink = 'http://wpsif.e-towers.ch/wp-content/uploads/2018/11/SIF_18_Ticket-undHotelkontingent.pdf';
          echo $dlicon->DownloadLink('Beispiel-File', $dlfileLink);
          echo $dlicon->DownloadLink('Beispxfgsdfgsfg', $dlfileLink);
          ?>

        </div>
      </div>
    </div>

  <?php
  endwhile;
endif;
?>

<!--strip 2-->
<div class="se-strip clearfix se-sc-bg">
  <div class="se-content">
    <div class="se-col-12 se-wc-txt" >
      <h1>NEWS</h1>
      <script type="text/javascript" id="wb-7Yr4d57e8f0cba005dZp" src="https://app.newsroom.co/embed.js?newsroom=sif2016&embed_id=wb-7Yr4d57e8f0cba005dZp"></script>
    </div>
  </div>
</div>


<script>
  jQuery(function(){
    //SLIDER
    //conf
    var width = '100vw';
    var animationSpeed = 1000;

    var slideCounter = 0;
    var pause = 6000;

    var currentSlide = 1;

    var sliderContainer = jQuery('#slider');
    var slidesTC = jQuery('.se-slider-header-text-container');
    var slideZitat = jQuery('.se-slider-header-zitat');
    var slideName = jQuery('#slidename');
    var slideFunktion = jQuery('#slidefunktion');
    var slideButton = jQuery('#slidebutton');

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
            jQuery(this).css({'background-image': 'url(' + bildSRC + ')', 'background-size': 'cover'})
            .animate({'opacity': 1, 'margin-right': 0}, 200);
        });

        setTimeout(function() {
            slidesTC.css({'right': '-500', 'opacity': '0'}).animate({'right': '20vw', 'opacity': '1' },700);
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
