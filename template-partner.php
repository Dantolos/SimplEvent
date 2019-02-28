<?php
/*
* Template Name: Partner Template
*/
get_header();

$Loader = new loadingAnimation;


/*QUERY*/
$main_partner_args = array(
  'post_type' => 'partner', 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array(
    array(
      'taxonomy' => 'Kategorie', 'field' => 'term_id', 'terms' => array(6),
    ),
  ),
);
$main_partner = new WP_Query($main_partner_args);

$taxonomy = 'Kategorie';
$terms = get_terms($taxonomy); // Get all terms of a taxonomy

?>

<!--Partner Main Content-->
<div class="se-strip">
  <div class="se-content">
    <div class="se-col-12">
      <h1 id="test"><?php echo the_title(); ?></h1>
      <p><?php echo the_content(); ?></p>
    </div>
  </div>
</div>


<!--Main Partner-->
<div class="se-strip se-partner-strip" style="padding-top: 0px;" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
  <div class="se-content" style="position:relative;">

    <div class="se-partner-kategorie" style="border-bottom: solid 2px <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>; margin-bottom:10px;">
      <h3>Main-Partner</h3>
    </div>
    <div class="se-partner-dropdown">
      <div class="se-partner-dropdown-button">
        <svg version="1.1" id="se_burger_menu" x="0px" y="0px" viewBox="0 0 17.5 10.5" style="enable-background:new 0 0 17.5 10.5;" xml:space="preserve">
          <g>
          	<line LID="0" class="se_BMstroke" x1="0" y1="1" x2="17.5" y2="1"/>
          	<line LID="1" class="se_BMstroke" x1="0" y1="5.2" x2="17.5" y2="5.2"/>
          	<line LID="2" class="se_BMstroke" x1="0" y1="9.5" x2="17.5" y2="9.5"/>
            <line LID="3" class="se_BMstroke" x1="0" y1="5.2" x2="17.5" y2="5.2"/>
          </g>
        </svg>
      </div>
      <?php if ( $terms && !is_wp_error( $terms ) ) : ?>
        <ul style="display:none;">
          <?php foreach ( $terms as $term ) { ?>
            <li data-cat="<?php echo $term->term_id; ?>" data-name="<?php echo $term->name; ?>" style="border-right: 0px solid <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>;"><?php echo $term->name; ?></li>
          <?php } ?>
        </ul>
      <?php endif; ?>
    </div>


    <div class="se-partner-content">

    </div>

    <?php echo $Loader->getLoader(); ?>

    <div class="se-partner-logo-containter">
      <?php  if ( $main_partner->have_posts() ) : while ( $main_partner->have_posts() ) : $main_partner->the_post();
        $Logo = $bild = get_field('partner-logo'); ?>

          <div data-id="<?php echo get_the_ID(); ?>" class="se-col-3 se-partner-logo" style="position:relative;">
            <div class="se-partner-logo-inner" style=" height:95%; width:95%; margin: auto; position:absolute; margin:2.5%; background-color:rgba(222, 222, 222, 0.5);">

              <div class="" style="margin:15%;height:70%; width:70%; background-image:url('<?php echo $Logo; ?>'); background-size: contain;background-repeat: no-repeat;
              background-position: center center;">

              </div>

            </div>

          </div>

      <?php  endwhile; endif;  ?>
    </div>

  </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){

  var LBclass = new LightBox;

  var seMC = $('header').attr('semc');

  var partnerLogo = $('.se-partner-logo');
  var partnercontent = $('.se-partner-content');
  var ajaxurl = $('.se-partner-strip').data('url');
  var SELoader = $('.se-loader');

  function partnerFrame(sp) {
      console.log('jOne');
      $('body').find('.se-lb-wrapper').remove();
      var pID = sp.data('id');

      LBclass.seOpenLB();

      $.ajax({
        url : ajaxurl,
        type : 'post',
        data : {
          id : pID,
          action : 'se_partner_load'
        },

        error : function( response ){
          console.log(response);
        },
        success : function( response ){
          LBclass.seLoadLB(response);
          $('.se-loader').css({'display': 'none'});

        }
      });

  }


  $( document ).ajaxComplete(function(){
    $('.closer').on('click', function(){
      $('body').find('.se-lb-wrapper').remove();
    });

  });

    partnerLogo.on('click', function(){
      partnerFrame($(this));
    });




  //kategorie dropdown
  var partnerDDbutton = $('.se-partner-dropdown-button');
  var catLI = $('.se-partner-dropdown').find('li');
  var dDTL = new TimelineMax({paused:true})
  var toggled = false;
  TweenLite.set(catLI, {y: '30px',autoAlpha: '0'});
  dDTL.staggerTo(catLI, 0.3, {y: '0px', autoAlpha: '1', ease:Power1.easeOut}, 0.05);
  partnerDDbutton.on('click', function(){
    if( toggled == false ){
      $('.se-partner-dropdown').find('ul').css({'display': 'block'});
      dDTL.play();
      toggled = true;
    } else {
      dDTL.reverse();
      $('.se-partner-dropdown').find('ul').fadeOut();
      toggled = false;
    }
  });

  //kategoriewechsel
  var kategorieTrigger = $('.se-partner-dropdown').find('li');
  var logoContainer = $('.se-partner-logo-containter');
  var kategorieTitel = $('.se-partner-kategorie');
  kategorieTrigger.on('click', function(){
    var kID = $(this).data('cat');
    var kName = $(this).data('name');

    $('.se-partner-dropdown').find('li').css({'border-width': '0px'});
    $(this).css({'border-width': '4px'});
    partnercontent.empty();
    SELoader.css({'margin-top': '0'}).fadeIn();
    logoContainer.empty();
    dDTL.reverse();
    toggled = false;
    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        cid : kID,
        action : 'se_partner_cat_load'
      },

      error : function( response ){
        console.log(response);
      },
      success : function( response ){
        logoContainer.empty();
        logoContainer.append(response);
        var pLogo = $('.se-partner-logo');
        pLogo.css({'height': (pLogo.width() / 10 * 9) });
        SELoader.animate({ 'margin-top': '-200px'}, 200).fadeOut();
        TweenMax.staggerFrom(pLogo, 0.5, {y: '30px', autoAlpha: '0', ease:Power1.easeOut}, 0.1);
        kategorieTitel.empty().append('<h3>' + kName + '</h3>');


      }
    }).done(function(){
      partnerLogo = $('.se-partner-logo');
      partnerLogo.on('click', function(){ partnerFrame($(this));});
    });
  });


});
</script>


<?php
get_footer();
