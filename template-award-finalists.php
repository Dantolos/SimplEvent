<?php
/*
* Template Name: Award Template
*/

get_header();

$Loader = new loadingAnimation;
echo $Loader->getLoader();
?>

<!--Award Main Content-->
<div class="se-strip" style="padding-bottom:50px;" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
  <div class="se-content">
    <div class="se-col-12">
      <h1><?php echo the_title(); ?></h1>
      <p><?php echo the_content(); ?></p>
    </div>
  </div>
</div>


<!--Award-->
<div class="se-strip se-partner-strip" style="padding-top: 0px;" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
  <div class="se-content" style="position:relative;  overflow: visible;">

    <!--Titlebar-->
    <div class="se-partner-kategorie" style="border-bottom: solid 2px <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>; margin-bottom:10px;">
      <h3>
        <?php
        $taxonomy = 'Jahrgang';
        $args = array(
          'taxonomy' => $taxonomy,
          'orderby' => 'slug',
          'order' => 'ASC',
          'hide_empty' => false,
          'hierarchical' => false,
          'parent' => 0,
          'meta_query' => [[
            'key' => 'wm-cat-prod-order',
            'type' => 'NUMERIC',
          ]],
        );
        $terms = get_terms($taxonomy);
        $currYear = end($terms);
        echo __('Finalisten', 'SimplEvent') . ' ' . $currYear->name;
        ?>
      </h3>

      <?php
      $categories = get_terms(array('taxonomy' => 'Awardkategorie', 'orderby' => 'term_order'));

      //dont show selection if less then 2 categories (trend radar)
      if(count($categories) > 1) {
      ?>
      <form class="se-award-categories" action="index.html" method="post" jahr="<?php echo $currYear->name; ?>">
        <label class="se-form-container"><?php echo __('alle', 'SimplEvent') ?>
          <input class="se-curr-categorie-radio" type="radio" name="categorie" value="all" checked="checked">
          <span class="checkmark"></span>
        </label>

        <?php
          foreach ($categories as $categorie) {
            echo '<label class="se-form-container">';
            echo '<input class="se-curr-categorie-radio" type="radio" name="categorie" value="'.$categorie->slug.'">' . $categorie->name;
            echo '<span class="checkmark"></span>';
            echo '</label>';

          }
        ?>
      </form>
      <?php } ?>

    </div>


    <!--current Award Content-->
    <div id="se-current-award-wrapper" style="margin-bottom:150px;">
    <?php
      $CurrCandidate = new AwardClass;
      echo $CurrCandidate->getCandidate( $currYear->name, 'all', false ); //getCandidate( jahr(int), kategorie(string), gewinner(bool) )

    ?>
    </div>

    <!--former winners-->
    <div id="formerWinners" class="se-partner-kategorie" style="position:relative; border-bottom: solid 2px <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>; margin-bottom:10px;">
      <h3>
        <?php
        end($terms);
        $formerYear = prev($terms);
        echo $formerYear->name;
        ?>
      </h3>
      <form class="se-former-award-winner" action="index.html" method="post">
        <label class="se-form-container"><?php echo __('Finalisten anzeigen', 'SimplEvent') ?>
          <input class="se-former-finalists" type="checkbox" name="categorie" value="all">
          <span class="checkmark"></span>
        </label>
        <label class="se-form-container">

          <div class="se-partner-dropdown" style="top:-20px;" jahr="<?php echo $currYear->name; ?>">
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

        </label>
      </form>

    </div>

    <!--former Award Content-->
    <div id="se-former-award-wrapper">
      <?php
      $lastYear = intval($formerYear->name);
      $lastCandidate = new AwardClass;
      echo $lastCandidate->getCandidate( $lastYear, 'all', true ); //getCandidate( jahr(int), kategorie(string), gewinner(bool) )
      ?>
    </div>

  </div>
</div>



<script type="text/javascript">
  jQuery(document).ready(function($){
    var ajaxurl = $('header').data('url');
    var seLoader = $('.se-loader');

    var currCatRadio = $('.se-curr-categorie-radio');
    var currCandCon = $('#se-current-award-wrapper');

    currCatRadio.on('click', function() {
      var cat = $(this).attr('value');
      var year = $('.se-award-categories').attr('jahr');
      console.log(year);
      currCandCon.empty();
      currCandCon.append(seLoader);
      seLoader.css({'display': 'block', 'height': '0px'});

      $.ajax({
        url : ajaxurl,
        type : 'post',
        data : {
          cate : cat,
          jahr : year,
          action : 'se_curr_award'
        },

        error : function( response ){
          console.log('ajax error');
        },
        success : function( response ){
          currCandCon.empty();
          currCandCon.append(response);

          cantidateFadeIn( currCandCon.find('.se-candidate-container') );
        }
      });

    });

    //kategorie dropdown
    var partnerDDbutton = $('.se-partner-dropdown-button');
    var catLI = $('.se-partner-dropdown').find('li');
    var dDTL = new TimelineMax({paused:true});
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

    //former loader
    var formFinalist = $('.se-former-finalists');
    var JahrTrigger = $('.se-partner-dropdown').find('li');

    formFinalist.on('click', function() {
      loadFormer();
    });

    JahrTrigger.on('click', function() {
      let selectY = $(this).attr('data-name');
      $('.se-partner-dropdown').attr( 'jahr', selectY );
      loadFormer();
    });

    //load Formers
    var formerCantCon = $('#se-former-award-wrapper');

    function loadFormer() {

        var Ckecked = formFinalist.attr('checked') ? false : true;
        var Jahrgang = $('.se-partner-dropdown').attr('jahr');

        $('.se-partner-dropdown').find('li').css({'border-width': '0px'});
        $(this).css({'border-width': '4px'});

        formerCantCon.empty();
        formerCantCon.append(seLoader);

        $('#formerWinners').find('h3').empty().append(Jahrgang);

        seLoader.css({'display': 'block', 'height': '0px'});

        $('.se-partner-dropdown').find('ul').fadeOut();
        dDTL.reverse();
        toggled = false;

        $.ajax({
          url : ajaxurl,
          type : 'post',
          data : {
            finalists : Ckecked,
            jahr : Jahrgang,
            action : 'se_former_award'
          },

          error : function( response ){
            console.log('ajax error');
          },
          success : function( response ){
            $('.se-partner-dropdown').find('ul').fadeOut();
            formerCantCon.empty();
            formerCantCon.append(response);

            cantidateFadeIn( formerCantCon.find('.se-candidate-container') );
          }
        });


    }


    //load in Animation
    function cantidateFadeIn(cand) {
      TweenMax.staggerFrom(cand, 0.4, {autoAlpha: 0, y: 20, ease:Power1.easeOut}, 0.1);
    }

  });
</script>


<?php
get_footer(); ?>
