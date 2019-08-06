<?php
/*
* Template Name: Speaker Template
*/

get_header();
$Speaker = new SpeakerClass;

$Clink = new LinkIcon;
$Loader = new loadingAnimation;

//asdf
/*QUERY*/
$JahrID;
$programm = true;
$PageID = get_the_ID();
if (! isset($_GET['j'])) {
  $JahrID = get_field('jahr', $PageID );
} else {
  $JahrID = get_term_by('name', $_GET['j'], 'Jahre');
  $JahrID = $JahrID->term_id;
  $CurrJahr = get_field('jahr', $PageID );

  if( is_object($CurrJahr) ) {
    $programm = $_GET['j'] == $CurrJahr->name ? true : false;
  } else {
    $programm = false;
  }
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
  $startID = (count($speakerArr) > 1) ? $speakerArr[1]['ID'] : $speakerArr[0]['ID'];
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


if(count($speakerArr) > 0){
?>

  <div class="se-speaker-slider-wrapper" programm="<?php echo $programm ? 1 : 0 ; ?>" page="<?php echo $PageID; ?>">
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
  </div>

  <div class="se-strip" style="padding-bottom: 80px;">
      <?php echo $Loader->getLoader(); ?>

      <div class="se-speaker-content-container se-content">
          <?php echo $Speaker->getSpeaker( $startID, $programm, $PageID ); ?>
      </div>
  </div>

  <div class="se-speaker-review-container">
    <?php

    if(get_post_meta($startID, 'review_jahr', true )) {
      echo $Speaker->getSpeakerReview($startID);
    } else {
      echo '<div style="width:100%; height:150px;"></div>';
    }?>
  </div>

  <?php
} else  {
  echo '<h1 style="margin:40vh 20vw;">Keine Speaker in dem Augsewählten Jahr gefunden</h1>';
}
?>


<script type="text/javascript">
jQuery(document).ready(function($){

  //mobile detect
  var isMobile = false; //initiate as false
  // device detection
  if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
      isMobile = true;
  }

  var speakerBild = $('.se-speaker-bild');
  var speakerCount = '<?php echo json_encode($speakerCount); ?>';
  var currentSpeaker = $('.se-speaker-bild[nr="1"]');

  var justOne = ( speakerBild.length == 1 ) ? parseInt(-1) : parseInt(0);

  speakerBild.each(function(){

    var nrI = $(this).attr('nr');
    var offset = 12.5 * nrI;
    if (nrI == (2 + justOne) ) { //mainbild
      $(this).css({ 'left': 30 + 'vw' });
    } else if ( nrI > (2 + justOne) ){ //alle danach
      offset = offset + 5
      $(this).css({'left': offset + 'vw'});
    } else { //0
      $(this).css({'left': offset + 'vw'});
      if ( nrI == (1 + justOne) ){ //aktiver Referent
        $(this).css({'width': 17.5 + 'vw', 'height': '33vh' }).find('.se-speaker-bild-overlay').css({ 'opacity': '0'});
        if(justOne == -1){
          $(this).css({'margin-left': '12.5vw'});
        }
      }
    }

  });
  var SELoader = $('.se-loader');
  var prg = $('.se-speaker-slider-wrapper').attr('programm');
  var pID = $('.se-speaker-slider-wrapper').attr('page');

  var SpeakerContainer = $('.se-speaker-content-container');
  var ReviewContainer = $('.se-speaker-review-container');

  //on click animationen
  speakerBild.on('click', function(){
    changeSpeaker($(this));
  });


  //swipe navigation for mobile
  if(isMobile) {
    var SpeakerSwipecontainer = document.getElementsByClassName('se-speaker-slider-container');
    var SpeakerSwipe = new Hammer(SpeakerSwipecontainer[0]);
    SpeakerSwipe.on('swipe', function(et){
      console.log(et.direction);
      let currNr;
      if( et.direction == 2 ) {
        currNr = parseInt(currentSpeaker.attr('nr')) + 1;
      } else {
        currNr = parseInt(currentSpeaker.attr('nr')) - 1;
      }

      let nextSpeaker = $('.se-speaker-bild[nr="' + currNr + '"]');

      changeSpeaker( nextSpeaker, et.direction )
    });
  }

  function changeSpeaker( speaker, swipe = false ){
    var page = speaker.data('id');

    var ajaxurl = $('header').data('url');
    SpeakerContainer.empty();


    TweenMax.set(SpeakerContainer,  { autoAlpha: 0, y: '-50px' })
    TweenMax.set(ReviewContainer,  { autoAlpha: 0, y: '-50px' });

    SELoader.css({'display': 'block'});
    $('#speakerName').html(page);
    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        id : page,
        programm : prg,
        pageid : pID,
        action : 'se_speaker_load'
      },

      error : function( response ){
        SpeakerContainer.append(response)
      },
      success : function( response ){
         //sicherheits leeren ( falls zu schnell gedrueckt wurde
        SpeakerContainer.empty();
        ReviewContainer.empty();
        //$('.').empty();
        //laden neuer inhalt
        //speaker
        SELoader.css({'display': 'none'});
        TweenMax.to( SpeakerContainer, 1, { autoAlpha: 1, y: 0, ease: Expo.easeInOut });

        SpeakerContainer.append(response['speaker']);
        let infoBox = SpeakerContainer.find('.se-infobox').parent();
        TweenMax.from( infoBox, 1, { autoAlpha: 0, y: '-50', ease: Expo.easeInOut })
        //review
        ReviewContainer.append(response['review']);
        TweenMax.to( ReviewContainer, .5, { autoAlpha: 1, y: 0, ease: Expo.easeInOut });
        ReviewChilds = ReviewContainer.find('div');

        TweenMax.from( ReviewChilds, .5, { autoAlpha: 0, y: '-50', ease: Expo.easeInOut }, 0.1);
      }
    });

    var nrA;
    if(!swipe) {
      nrA = speaker.attr('nr');
    } else {
      if( swipe === 2 ) {
        nrA = parseInt(currentSpeaker.attr('nr')) + 1;
      } else if ( swipe === 4 ) {
        nrA = parseInt(currentSpeaker.attr('nr')) - 1;
      }
    }



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
      } else if ( newNr == 1 ) { //aktiver Referent
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
    currentSpeaker = speaker;
  }

});
</script>

<?php
get_footer(); ?>
