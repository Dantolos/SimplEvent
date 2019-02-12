<?php
/*
* Template Name: Speaker Template
*/

get_header();
$Speaker = new SpeakerClass;

$Clink = new LinkIcon;
$Loader = new loadingAnimation;


/*QUERY*/
$JahrID;
if (! isset($_GET['j'])) {
  $JahrID = get_field('jahr');
} else {
  $JahrID = get_term_by('name', $_GET['j'], 'Jahre');
  $JahrID = $JahrID->term_id;

}


$speaker_args = array(
  'post_type' => 'speakers',
  'orderby' => 'menu_order',
  'order'     => 'ASC',
  'tax_query' => array(
    array(
      'taxonomy' => 'Jahre',
      'field'    => 'term_id',
      'terms'    => $JahrID,
    ),
  ),
);
$speaker = new WP_Query( $speaker_args );

$speakerArr = array();

if ( $speaker->have_posts() ) : while ( $speaker->have_posts() ) : $speaker->the_post();
  $postID = get_the_ID();
  $bild = get_field('speaker_bild');

  $newArray = array(
    'ID' => $postID,
    'name' => get_post($postID)->post_name,
    'bild' => $bild,
  );

  $speakerArr[] = $newArray;

endwhile; endif;

$startID;
$startBild;

//GEt DIREKT SPECIFITC SPEAKER
if (! isset($_GET['r'])) {
  $startID = $speakerArr[1]['ID'];
  $startBild = 1;
} else {
  $direktSpeaker = $_GET["r"];
  $bSCount = 0;
  foreach ($speakerArr as $singleSpeaker) {
    if ($direktSpeaker === $singleSpeaker['name']) {
      $startID = $singleSpeaker['ID'];

      unset($speakerArr[$bSCount]);
      $singleSpeaker = [$singleSpeaker];
      array_insert($speakerArr, 1, $singleSpeaker);
      $startBild = $bSCount;

    }
    $bSCount++;
  }
}



if(count($speakerArr) > 1){
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
          <?php echo $Speaker->getSpeaker($startID); ?>
      </div>
  </div>

  <div class="se-speaker-review-container">
    <?php
    if(get_post_meta($startID, 'review_public', true )) {
      echo $Speaker->getSpeakerReview($startID);
    } ?>
  </div>

  <?php
} else  {
  echo '<h1 style="margin:40vh 20vw;">Keine Speaker in dem Augsewählten Jahr gefunden</h1>';
}

?>


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
         //sicherheits leeren ( falls zu schnell gedrueckt wurde
        $('.se-speaker-content-container').empty();
        $('.se-speaker-review-container').empty();

        console.log(response['speaker']);
        // var obj = JSON.parse(response);
        // console.log(obj);


        //laden neuer inhalt
        $('.se-speaker-content-container').animate({'margin-top': '-100px'}, 200)
        SELoader.css({'display': 'none'});
        $('.se-speaker-content-container').append(response['speaker']).css({'opacity': '0'}).animate({'margin-top': '0', 'opacity': '1'});
        $('.se-speaker-review-container').append(response['review']);
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
