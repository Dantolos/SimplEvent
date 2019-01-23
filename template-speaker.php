<?php
/*
* Template Name: Speaker Template
*/

get_header();

$Clink = new LinkIcon;
$Loader = new loadingAnimation;

/*QUERY*/
$speaker_args = array(
  'post_type' => 'speakers',
  'orderby' => 'menu_order',
  'order'     => 'ASC',
  'tax_query' => array(
    array(
      'taxonomy' => 'Jahre',
      'field'    => 'term_id',
      'terms'    => array(5),
    ),
  ),
);
$speaker = new WP_Query( $speaker_args );

$speakerArr = array();

if ( $speaker->have_posts() ) : while ( $speaker->have_posts() ) : $speaker->the_post();
  $postID = get_the_ID();
  $name = get_the_title();
  $funktion = get_post_meta($postID, 'speaker_funktion', true );
  $firma = get_post_meta($postID, 'speaker_firma', true );
  $zeit = get_post_meta($postID, 'speaker_zeit', true );
  $kategorie = get_post_meta($postID, 'speaker_kategorie', true );
  $webseite = get_post_meta($postID, 'speaker_webseite', true );

  $sprache = get_post_meta($postID, 'speaker_sprache', true );
  $social = array();
  if( have_rows('speaker_social_media') ) :
    while ( have_rows('speaker_social_media') ) : the_row();

      $typ = get_sub_field('speaker_social_media_typ');
      $link = get_sub_field('speaker_social_media_link');
      $social[$typ] = $link;
    endwhile;
  endif;
  $socialArr = get_field('speaker_social_media');
  $bild = get_field('speaker_bild');
  $cv = get_post_meta($postID, 'speaker_cv', true );

  $newArray = array(
    'ID' => $postID,
    'name' => $name,
    'funktion' => $funktion,
    'firma' => $firma,
    'zeit' => $zeit,
    'kategorie' => $kategorie,
    'webseite' => $webseite,
    'sprache' => $sprache,
    'social' => $social,
    'socialArr' => $socialArr,
    'bild' => $bild,
    'cv' => $cv
  );

  $speakerArr[] = $newArray;


endwhile; endif;

// echo '<pre style="margin: 150px 0 0 20px;"';
// echo var_dump($speakerArr);
// echo '</pre>';
?>


<div class="se-speaker-slider-container">
<?php
  $speakerCount = count($speakerArr);
  for ($i=0; $i < $speakerCount; $i++) { ?>
    <div data-id="<?php echo $speakerArr[$i]['ID']; ?>" class="se-speaker-bild image-settings" nr="<?php echo $i; ?>" style="background-image:url('<?php echo $speakerArr[$i]['bild'] ?>');">
      <div class="se-sc-bg se se-speaker-bild-overlay">

      </div>
    </div>
  <?php } ?>
</div>



<div class="se-strip">
    <?php echo $Loader->getLoader(); ?>
    <div class="se-speaker-content-container se-content">
      <div class="se-col-8">
        <h1><?php echo $speakerArr[1]['name'] ?></h1>
        <p><?php echo $speakerArr[1]['funktion'] ?></p>
        <p><?php echo $speakerArr[1]['cv'] ?></p>
        <?php echo $Clink->getLinkIcon('google.ch', 'Link Text', '_blank'); ?>
      </div>
      <div class="se-col-4 se-sc-bg se-wc-txt" style="display:table; min-height:300px;">
        <div class="se-infobox se-speaker-content-container-infobox">
          <p style="margin-top:-40px;"><?php echo $speakerArr[1]['kategorie'] ?></p>
          <h2><?php echo $speakerArr[1]['zeit'] ?></h2>
          <?php echo $Clink->getLinkIcon($speakerArr[1]['webseite']['url'], 'PROGRAMM'); ?>

        <div class="se_speaker_social-media">
          <?php
          $i = 0;
          while( $i < count($speakerArr[1]['socialArr']) ){
            switch ($speakerArr[1]['socialArr'][$i]['speaker_social_media_typ']){
              case 'fb':
                $icon = 'icon_facebook.svg';
                break;
              case 'yt':
                $icon = 'icon_youtube.svg';
                break;
              case 'insta':
                $icon = 'icon_insta.svg';
                break;
              case 'in':
                $icon = 'icon_linkedin.svg';
                break;
              case 'twitter':
                $icon = 'icon_twitter.svg';
                break;
            } $i++; ?>

            <a href="<?php echo $speakerArr[1]['socialArr'][$i]['speaker_social_media_link']; ?>" target="_blank" class="se-sm-icon">
              <img src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $icon; ?>" height="25px" style="margin:4px 8px 0 0;">
            </a>

            <?php  }

            $webseite = $speakerArr[1]['webseite'];
            if($webseite){ ?>
              <a href="<?php $webseite; ?>" target="_blank" style="position:absolute; right:0; margin:0;">
                <div class="mc-button-neg se-mc-txt" style="margin:0; border: solid 2px <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>; float:right;">
                  <?php echo __( 'WEBSEITE', 'SimplEvent' ); ?>
                </div>
              </a>

            <?php } ?>
          </div>
        </div>
      </div>
    </div>
</div>


<?php
//review bereich

$isPublic = get_post_meta($speakerArr[1]['ID'], 'review_public', true );
if ($isPublic){ ?>

  <div class="se-strip se-speaker-review se-sc-bg">
    <div class="se-content">
      <div class="se-col-12 se-wc-txt">
        <h4 style="font-weight: 700; margin-bottom:30px;"><?php echo get_post_meta($speakerArr[1]['ID'], 'review_titel', true ); ?></h4>
      </div>
      <div class="se-col-5 se-wc-txt">
        <p style="border-top:2px solid <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>; padding-top:10px;">
          <?php echo get_post_meta($speakerArr[1]['ID'], 'review_text', true ); ?>
        </p>
      </div>
      <div class="se-col-7 se-wc-txt">
        <iframe width="100%" height="100%" src="https://media10.simplex.tv/content/73/4595/101725/index.html?embed=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe>
      </div>
    </div>
    <?php $images = get_field('review_galerie', $speakerArr[1]['ID'] );?>

    <div id="prevGallery" class="prevGallery">    </div>
    <div id="nextGallery" class="nextGallery">    </div>
    <div class="se-gallery-container">

        <?php for ($i=0; $i < count($images) ; $i++) { ?>
          <div counter="<?php echo $i + 1; ?>" class="se-gallery-pic image-settings" style="background-image:url(<?php echo $images[$i]['url']; ?>);">

          </div>
        <?php } ?>
    </div>

  </div>

<?php } else {

} ?>


<script type="text/javascript">
jQuery(document).ready(function($){

  var speakerBild = $('.se-speaker-bild');
  var speakerCount = '<?php echo json_encode($speakerCount); ?>';
  var currentSpeaker = $('.se-speaker-bild[nr="1"]');

  speakerBild.each(function(){
    var nrI = $(this).attr('nr');
    var offset = 12.5 * nrI;
    if (nrI == 2 ) { //mainbild
      $(this).css({ 'left': 30 + 'vw' });

    } else if (nrI > 2 ){ //alle danach
      offset = offset + 5
      $(this).css({'left': offset + 'vw'});
    } else { //0
      $(this).css({'left': offset + 'vw'});
      if ( nrI == 1 ){ //aktiver Referent
        $(this).css({'width': 17.5 + 'vw', 'height': '33vh' }).find('.se-speaker-bild-overlay').css({ 'opacity': '0'});
      }
    }

  });
    var SELoader = $('.se-loader');

  //on click animationen
  speakerBild.on('click', function(){

    var page = $(this).data('id');
    var ajaxurl = $('header').data('url');
    $('.se-speaker-content-container').empty();
    SELoader.css({'display': 'block'});
    $('#speakerName').html(page);
    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        id : page,
        action : 'se_speaker_load'
      },

      error : function( response ){
        $('.se-speaker-content-container').append(response)
      },
      success : function( response ){
        $('.se-speaker-content-container').empty(); //sicherheits leeren ( falls zu schnell gedrueckt wurde)
        $('.se-speaker-content-container').animate({'margin-top': '-100px'}, 200)
        SELoader.css({'display': 'none'});
        $('.se-speaker-content-container').append(response).css({'opacity': '0'}).animate({'margin-top': '0', 'opacity': '1'});
      }
    });


    var nrA = $(this).attr('nr');
    var nrDiv = nrA - 1; //diverenz

    speakerBild.each(function(){
      var nrThis = $(this).attr('nr');
      var newNr = parseInt(nrThis) - parseInt(nrDiv);


      if ( newNr < 0 ) { //reset nr
        newNr = parseInt(speakerCount) + parseInt(newNr);
        $(this).attr('nr', newNr);
      } else if ( newNr > (parseInt(speakerCount) - 1) ) {
        newNr = parseInt(newNr) - parseInt(speakerCount);
        $(this).attr('nr', newNr);
      } else {
        $(this).attr('nr', newNr);
      }

      var offsetSize = newNr * 12.5;

      if (newNr == 0 ){
        $(this).animate({'left': offsetSize + 'vw'});
      } else if ( newNr == 1 ){ //aktiver Referent
        speakerBild.animate({'width': 12.5 + 'vw', 'height': '30vh'}, 100).find('.se-speaker-bild-overlay').css({ 'opacity': '0.8'});
        $(this).animate({'left': offsetSize + 'vw', 'width': 17.5 + 'vw', 'height': '33vh', 'opacity': '1' }, 500)
        .find('.se-speaker-bild-overlay').animate({ 'opacity': '0'});
      } else if ( newNr == 2) { //aktiver Referent
        $(this).animate({'left': 30 + 'vw'});
        console.log(newNr);
      } else {
        offsetSize = offsetSize + 5
        $(this).animate({'left': offsetSize + 'vw'});
      }

    });

    //$('.se-speaker-content-container').empty();
    //$('.se-speaker-content-container').append('<h1>asdf</h1>');
    currentSpeaker = jQuery(this);

  });

});
</script>

<?php
get_footer(); ?>
