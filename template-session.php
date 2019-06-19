<?php
/*
* Template Name: Session Template
*/

get_header();

$Clink = new LinkIcon;
$Csession = new SessionsClass;
$Loader = new loadingAnimation;

$slotarray = get_field('slots');
$firstSlot = array_shift($slotarray);

?>

<!--Session Main Content-->
<div class="se-strip" id="touch-test" >
  <div class="se-content" style="margin-bottom:50px;">
    <div class="se-col-8" style="padding-right: 5%;">
      <h1><?php echo the_title(); ?></h1>
      <p><?php echo the_content(); ?></p>
    </div>
    <div class="se-col-4 se-sc-bg se-wc-txt" style="display: table;">
      <div class="se-infobox" style="position:relative;">
        <p><?php echo __( 'Parallelprogramm', 'SimplEvent' ); ?></p>
        <div class="se-infobox-session-dropdown-menu">
          <h2><?php the_field('session_zeit'); ?></h2>

          <?php if(count(get_field('slots')) > 1) {?>
          <div class="se-infobox-session-selector">
            <p id="selected-slot-item" slot="<?php echo $slot; ?>"><?php echo $firstSlot; ?></p>
            <svg version="1.1" id="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            	 width="50px" height="16px" viewBox="0 0 40 39" enable-background="new 0 0 40 39" xml:space="preserve">
              <g>
              	<path class="se-arrow" fill="#fff" d="M30.105,18.204L11.357,7.249c-0.764-0.448-1.743-0.19-2.188,0.574C8.724,8.585,8.98,9.565,9.744,10.01
              		l16.333,9.545L9.819,29.446c-0.755,0.459-0.995,1.443-0.536,2.197c0.302,0.496,0.829,0.769,1.369,0.769
              		c0.284,0,0.57-0.074,0.83-0.232l18.146-11.039c0.426-0.09,0.815-0.345,1.053-0.749C31.125,19.628,30.868,18.649,30.105,18.204z"/>
              </g>
            </svg>
          </div>
          <div class="se-infobox-session-dropdown" style="position:absolute;">
            <?php foreach ($slotarray as $slot): ?>
                <div class="se-infobox-session-dropdown-item" slot="<?php echo $slot; ?>"> <p><?php echo $slot; ?></p></div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php
        }

        switch (ICL_LANGUAGE_CODE) {
          case 'de':
            $programmLink = get_site_url() . '/de/programm';
            $programmText = 'Programm';
            break;
          case 'en':
            $programmLink = get_site_url() . '/en/program';
            $programmText = 'Program';
            break;
          default:
            $programmLink = get_site_url() . '/programm';
            break;
        }
        echo $Clink->getLinkIcon($programmLink, $programmText); ?>
      </div>
    </div>
  </div>
</div>

<!--Separate Sessions-->
<?php echo $Loader->getLoader(); ?>
<div id="se-session-wrapper" jahr="<?php echo get_field('jahr'); ?>">
  <?php echo $Csession->getSlot(get_field('jahr'), $firstSlot ); ?>
</div>


<script type="text/javascript">
  jQuery(document).ready(function($){
    var ajaxurl = $('header').data('url');
    //dropdown
    TweenMax.set($('#dropdown-arrow'), {rotation:90, scaleY:1.3});
    $('.se-infobox-session-dropdown').css({'width': $('.se-infobox-session-selector').innerWidth()});

    let DDtrigger = $('.se-infobox-session-selector');
    let DDitems = $('.se-infobox-session-dropdown-item');

    function slotItemToggle() {
      DDitems.slideToggle();
    }

    DDtrigger.on('click', function(){
      slotItemToggle();
    });

    DDitems.on('click', function(){
      var page = $(this).attr('slot');
      var jahr = $('#se-session-wrapper').attr('jahr');
      var xTxt = $(this).find('p').text();
      var yTxt = $('#selected-slot-item').text();
      $(this).find('p').html(yTxt);
      $(this).attr('slot', yTxt);
      $('#selected-slot-item').html(xTxt);

      $('#se-session-wrapper').empty();
      $('.se-loader').css({'display': 'block', 'height': '0px'});

      slotItemToggle();

      $.ajax({
        url : ajaxurl,
        type : 'post',
        data : {
          slot : page,
          year : jahr,
          action : 'se_session_slots'
        },

        error : function( response ){
          console.log('ajax error');
        },
        success : function( response ){
          $('.se-loader').css({'display': 'none'});
          $('#se-session-wrapper').append(response)
          $('html, body').animate({
              scrollTop: $('#se-session-wrapper').offset().top
          }, 1000);
          refEle = $('.se-session-referent');
          console.log(refEle);
        }
      });
    });


    //SPEAKER Sessions
    var LBclass = new LightBox;
    var LBtrigger = $('.se-session-referent');

    let refEle = $('.se-session-referent');

    function seSessionSpeaker(sp) {


      $('body').find('.se-lb-wrapper').remove();
      let page = sp.attr('pid');
      let rcount = sp.attr('rcount');
      console.log(page);
      LBclass.seOpenLB();
      $('.se-lb-con').empty();

      $.ajax({
        url : ajaxurl,
        type : 'post',
        data : {
          sid : page,
          rc : rcount,
          action : 'se_session_load'
        },

        error : function( r ){
          console.log('ajax error');
        },
        success : function( r ){
          console.log( r );
          LBclass.seLoadLB( r );
          $('.se-loader').css({'display': 'none'});
        }
      });
    }


    $('.closer').live('click', function(){
      $('.se-lb-wrapper').remove();
    });


    refEle.live('click', function(){
      seSessionSpeaker($(this));
    });

  });
</script>
<?php

get_footer(); ?>
