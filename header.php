<!DOCTYPE html>
<html>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php if(esc_attr( get_option( 'se_googlefont_link' ) )) {
    echo get_option( 'se_googlefont_link' );
  } else { ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <?php }  ?>
  <link rel="shortcut icon" href="/favicon.ico" />

<?php //import Files
  function theme_add_files() {
    //plugins
  	wp_enqueue_script( 'moveit-js', get_template_directory_uri() . '/js/moveit.js' );
    wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js' );

  	wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style.css', '', '1.0.20' );
    wp_enqueue_style( 'print-style-css', get_template_directory_uri() . '/css/print.css', '', '1.0.01' );

    /* LOAD JS */
  	wp_enqueue_script( 'script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.4', true );
    $JsIncList = array(
      array('restapi-js', 'restapi.js'),
    );
    foreach ($JsIncList as $JsInc) 
    {
          wp_enqueue_script( $JsInc[0], get_template_directory_uri() . '/js/inc/' . $JsInc[1], array('jquery'), '1.0.7', false );
    }

    //Externan Plugins
    wp_enqueue_script( 'particles', 'https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js', true );
    wp_enqueue_script( 'hammer-js', 'https://hammerjs.github.io/dist/hammer.js', true );

    if ( wp_is_mobile() ) {
    	wp_enqueue_style( 'mobile-style-css', get_template_directory_uri() . '/css/mobile.style.css', '', '1.0.03' );
      wp_enqueue_script( 'mobile-script-js', get_template_directory_uri() . '/js/mobile.script.js', array('jquery'), '1.0.1', true );
    } else {
    	/* Include/display resources targeted to laptops/desktops here */
    }

    wp_enqueue_script( 'lightbox-js', get_template_directory_uri() . '/js/class.lightbox.js', array('jquery'), true );

    //JS Translations
    $translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
    wp_localize_script( 'script-js', 'seDIR', $translation_array );
    wp_localize_script( 'lightbox-js', 'seDIR', $translation_array );

    //load initiative informations JS
    if(! isset($_GET['seembed'])) { 
      wp_enqueue_script( 'iniviative-js', get_template_directory_uri() . '/js/initiative.js', array('jquery'), true );
    } else {
      wp_enqueue_style( 'embed-style-css', get_template_directory_uri() . '/css/embed.style.css' );
    }

    /*------------------------------Send Global Variables---------------------------*/
    $language;
    if( defined(ICL_LANGUAGE_CODE) )
    {
      $language = ICL_LANGUAGE_CODE;
    } else { 
      $language = 'de';
    };
    $wnm_custom = array( 'templateUrl' => get_template_directory_uri(), 'lang' => $language );
    $scriptToAdGlobal = array('script-js', 'restapi-js',  );
    foreach( $scriptToAdGlobal as $script ){
         wp_localize_script( $script, 'globalURL', $wnm_custom );
    }
  }
  add_action( 'wp_enqueue_scripts', 'theme_add_files' );

  wp_head();

  //classes
  require_once('inc/class.download.php');
  require_once('inc/class.link.php');
  require_once('inc/class.loading.php');
  require_once('inc/class.lightbox.php');
  require_once('inc/class.socialmedia.php');

  require_once('inc/class.speaker.php');
  require_once('inc/class.sessions.php');
  require_once('inc/class.award.php');
  require_once('inc/class.tiles.php');
  require_once('inc/class.programm.php');

  require_once('inc/elements/class.button.php');

  //modular classes
  require_once('inc/class.modular-elements.php');
  require_once('inc/class.modular.php');


  //colors
  $seMC = esc_attr( get_option( 'main_color_picker' ) );
  $seSC = esc_attr( get_option( 'second_color_picker' ) );
  $seWC = esc_attr( get_option( 'light_color_picker' ) );

  //Language
  $curLang = apply_filters( 'wpml_current_language', NULL );

  $MoEvLoader = new loadingAnimation;
?>

  <!-- Google Tag Manager -->
  <!-- TODO -->

</head>

<style>
  /*--COLOR--*/
  .se-weiss { background-color: #fff; }
  .se-mc-bg { background-color: <?php echo $seMC; ?>; } /*maincolor*/
  .se-mc-txt { color: <?php echo $seMC; ?>; }
  .se-sc-bg { background-color: <?php echo $seSC; ?>; } /*dark*/
  .se-sc-txt { color: <?php echo $seSC; ?>; }
  .se-wc-bg { background-color: <?php echo $seWC; ?>; } /*light*/
  .se-wc-txt { color: <?php echo $seWC; ?>; }

  .button-border { border: solid 2px <?php echo $seMC; ?> !important; }
 </style>


<?php if(esc_attr( get_option( 'se_googlefont_link' ) )) : ?>
  <style>
  html, body, div, span, applet, object, iframe,
  h1, h2, h3, h4, h5, h6, p, blockquote, pre,
  a, abbr, acronym, address, big, cite, code,
  del, dfn, em, font, img, ins, kbd, q, s, samp,
  small, strike, strong, sub, sup, tt, var,
  dl, dt, dd, ol, ul, li,
  fieldset, form, label, legend,
  table, caption, tbody, tfoot, thead, tr, th, td { 
    <?php echo get_option( 'se_font_css' );  ?>
  }
  </style>
<?php endif; ?>

<?php if(! isset($_GET['seembed'])) { ?>

<header semc="<?php echo $seMC; ?>" sesc="<?php echo $seSC; ?>" sewc="<?php echo $seWC; ?>" curlang="<?php echo $curLang ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">


  <div class="se-navbar-container clearfix">
    <div class="se-header-logo">
      <a href="<?php $url = home_url(); echo esc_url( $url ); ?>">
        <img src="<?php echo esc_attr( get_option( 'event_logo' ) ); ?>" alt="Home" title="<?php bloginfo('name'); ?>" />
      </a>
    </div>
    <div class="se-header-icon" style="display:none;">
      <a href="<?php $url = home_url(); echo esc_url( $url ); ?>">
        <img src="<?php echo esc_attr( get_option( 'event_icon' ) ); ?>" alt="Home" title="<?php bloginfo('name'); ?>" />
      </a>
    </div>
    <div class="se-more-events-section">
      <div class="se-more-events-button se-sc-txt" id="more-events-button">
        <img src="<?php echo get_template_directory_uri(); ?>/img/icon-plus.svg" alt="more" title="show more Events"/>
        <span style="">more Events</span>
      </div>
    </div>

    <div class="se-sc-txt se-navbar-mainmenu">
      <div class="se-main-navi">
      <?php

        $current_menu = 'main-menu';

        $array_menu = wp_get_nav_menu_items('Hauptmenu');
        $menu = array();
        if ($array_menu) {
          foreach ($array_menu as $m) {
              if (empty($m->menu_item_parent)) {
                  $menu[$m->ID] = array();
                  $menu[$m->ID]['ID']       =   $m->ID;
                  $menu[$m->ID]['title']    =   $m->title;
                  $menu[$m->ID]['url']      =   $m->url;
                  $menu[$m->ID]['children'] =   array();
              }
          }
          $submenu = array();
          foreach ($array_menu as $m) {
              if ($m->menu_item_parent) {
                  $submenu[$m->ID] = array();
                  $submenu[$m->ID]['ID']    =   $m->ID;
                  $submenu[$m->ID]['title'] =   $m->title;  
                  $submenu[$m->ID]['url']   =   $m->url;
                  $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
              }
          }
        }

        if (! wp_is_mobile() ) {
          foreach ($menu as $m) {
            $subURL;
            if( $m['url'] == '#'){
              $firstSub = reset($m['children']);
              $subURL = $firstSub['url'];
            } else {
              $subURL = $m['url'];
            } ?>

            <a href="<?php echo $subURL ?>" class="aagi-w-txt se-navelement" nav="<?php echo $m['ID']; ?>" activem="<?php echo $firstSub['ID'] ?>">
              <span class="se-navbar-mainmenu-item"><?php echo $m['title']; ?></span>
            </a>
          <?php }
        }
        ?>
      </div>



      <div class="nav-layer se-mc-bg"></div>
      <div class="curr-nav-layer se-mc-bg" style="display:none;"></div>

      <?php
      $regBtnText = esc_attr( get_option( 'se_anmeldetext' ));

      if (! wp_is_mobile() ) {
        $seanmeldung = esc_attr( get_option( 'se_anmeldung' ) );
        if( $seanmeldung == 'on') { ?>
          <a href="<?php echo esc_attr( get_option( 'se_anmeldelink' ) ) ; ?>" target="_blank" style="padding:0;">
            <div class="se_navbar_anmeldebutton se-mc-bg se-wc-txt">
                <?php

                echo __($regBtnText, 'SimplEvent');
                 ?>
            </div>
          </a>
        <?php }

        //sidebat button
        if( get_option( 'sb_active' ) ) {
        ?>
        <div class="se_navbar_infobutton">
          <img src="<?php echo get_template_directory_uri(); ?>/img/icon-info.svg" alt="more" title="show more Events" height="100%"/>
        </div>
      <?php }
      } ?>
    </div>

    <div class="se-navbar-language clearfix">

      <?php
      $SMicon = new SocialMedia();
      $MainSocial = array(
        'twitter' => esc_attr( get_option( 'twitter_link' ) ),
        'in' => esc_attr( get_option( 'linkedin_link' ) ),
        'fb' => esc_attr( get_option( 'facebook_link' ) ),
        'yt' => esc_attr( get_option( 'youtube_link' ) ),
        'insta' => esc_attr( get_option( 'insta_link' ) )
      );
      if($MainSocial) {
        foreach ($MainSocial as $SMName => $SMLink) {
          if($SMLink) {
            $icon = $SMicon->getSMicon($SMName, '#b7b7b7', '16px');
            echo '<a href="'.$SMLink.'" class="" target="_blank" style="padding:0 3px; float:right;">';
            echo '<div class="se-sm-icon-anim" style=" margin:3px 1px 0 0;"/>'.$icon;
            echo '</div></a>';
          }
        }
      }
      echo '<div style="float:right;">';
      do_action('wpml_add_language_selector');
      echo '</div>';
      ?>

    </div>




    <!-- MoreEvent Container -->
    <div class="se-more-events-container se-sc-bg se-wc-txt clearfix" id="se-more-events">
      <div class="se-arrow-pre-event se-arrow-event">
        <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        	 width="60px" height="60px" viewBox="0 0 40 39" enable-background="new 0 0 40 39" xml:space="preserve">
        <g>
        	<path class="se-arrow" fill="<?php echo $seWC; ?>" d="M30.105,18.204L11.357,7.249c-0.764-0.448-1.743-0.19-2.188,0.574C8.724,8.585,8.98,9.565,9.744,10.01
        		l16.333,9.545L9.819,29.446c-0.755,0.459-0.995,1.443-0.536,2.197c0.302,0.496,0.829,0.769,1.369,0.769
        		c0.284,0,0.57-0.074,0.83-0.232l18.146-11.039c0.426-0.09,0.815-0.345,1.053-0.749C31.125,19.628,30.868,18.649,30.105,18.204z"/>
        </g>
        </svg>
      </div>
      <!-- more Events Content -->
      <div class="se-more-event-content" id="se-more-event-content">
        <?php //echo $MoEvLoader->getLoader(); ?>
      </div>
      <!-- more Events Content END -->
      <div class="se-arrow-next-event se-arrow-event">
        <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
           width="60px" height="60px" viewBox="0 0 40 39" enable-background="new 0 0 40 39" xml:space="preserve">
        <g>
          <path class="se-arrow" fill="<?php echo $seWC; ?>" d="M30.105,18.204L11.357,7.249c-0.764-0.448-1.743-0.19-2.188,0.574C8.724,8.585,8.98,9.565,9.744,10.01
            l16.333,9.545L9.819,29.446c-0.755,0.459-0.995,1.443-0.536,2.197c0.302,0.496,0.829,0.769,1.369,0.769
            c0.284,0,0.57-0.074,0.83-0.232l18.146-11.039c0.426-0.09,0.815-0.345,1.053-0.749C31.125,19.628,30.868,18.649,30.105,18.204z"/>
        </g>
        </svg>
      </div>
    </div>
    <!-- MoreEvent Container -->

    <!-- mobile navigation -->
    <?php if ( wp_is_mobile() ) {
      ?>
        <div class="se-navbar-mainmenu-mobile-burger" style="border: solid 2px <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>;">

            <svg version="1.1" id="se_burger_menu" x="0px" y="0px" viewBox="0 0 17.5 10.5" style="enable-background:new 0 0 17.5 10.5;" xml:space="preserve">
              <style media="screen">#se_burger_menu {stroke:<?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>;} </style>
              <g>
              	<line LID="0" class="se_BMstroke" x1="0" y1="1" x2="17.5" y2="1"/>
              	<line LID="1" class="se_BMstroke" x1="0" y1="5.2" x2="17.5" y2="5.2"/>
              	<line LID="2" class="se_BMstroke" x1="0" y1="9.5" x2="17.5" y2="9.5"/>
                <line LID="3" class="se_BMstroke" x1="0" y1="5.2" x2="17.5" y2="5.2"/>
              </g>
            </svg>

        </div>

        <!-- mobile more event -->
        <svg version="1.1" id="moEv-mobile-trigger" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
           viewBox="0 0 180.536 331.337" style="enable-background:new 0 0 180.536 331.337;" xml:space="preserve">
          <path style="fill:#3B3B3A;" d="M175.612,206.977c-13.376-25.143-32.032-38.487-10.92-98.564h0c3.356-8.83,5.202-18.405,5.202-28.413
            c0-44.183-35.817-80-80-80s-80,35.817-80,80c0,12.79,3.017,24.87,8.354,35.592c17.176,54.009-0.498,67.277-13.323,91.385
            c0,0-4.925,22.028-4.925,34.092c0,49.854,40.414,90.268,90.268,90.268c49.854,0,90.268-40.414,90.268-90.268
            C180.536,229.005,175.612,206.977,175.612,206.977z"/>
          <g>
            <line style="fill:none;stroke:#FFFFFF;stroke-width:8;stroke-miterlimit:10;" x1="124.663" y1="73.813" x2="55.873" y2="73.813"/>
            <line id="moEv-mobile-trigger-line" style="fill:none;stroke:#FFFFFF;stroke-width:8;stroke-miterlimit:10;" x1="90.268" y1="108.208" x2="90.268" y2="39.418"/>
          </g>
        </svg>

        <div class="se-navbar-mainmenu-mobile" style="background-color:#fff; z-index: 6000;">

          <div class="se-navbar-mainmenu-home-icon">
            <a href="<?php $url = home_url(); echo esc_url( $url ); ?>">
              <img src="<?php echo esc_attr( get_option( 'event_icon' ) ); ?>" alt="Home" title="<?php bloginfo('name'); ?>" />
            </a>
          </div>

          <div class="se-navbar-mainmenu-mobile-container" style="opacity:0;">
          <?php
            foreach ($menu as $m){?>
              <a href="<?php if( $m['url'] == '#'){ echo 'javascript:;'; } else { echo $m['url']; } ?>" class="" nav="<?php echo $m['ID']; ?>">
                <p class="se-navbar-mainmenu-mobile-item"><?php echo $m['title']; ?></p>
              </a>
              <?php
              $smArr = $m['children'];
              if ($smArr) { ?>
                <div subnav="<?php echo $m['ID']; ?>" class="se-subnav-mobile-container se-mc-bg se-wc-txt"> <?php

                foreach($smArr as $sm){ ?>
                  <a href="<?php echo $sm['url']; ?>" class="aagi-w-txt"  id="<?php echo $sm['ID']; ?>">
                    <p class="se-navbar-sub-mobile-item"><?php echo $sm['title']; ?></p>
                  </a>
                <?php } ?>

              </div>
              <?php }
            }
            $array_mfootermenu = wp_get_nav_menu_items('Footermenu');
            if($array_mfootermenu) {
              $cf = 1;
              foreach ($array_mfootermenu as $mfootermenu) {  ?>

                <a href="<?php echo $mfootermenu->url; ?>" class="" >
                  <p class="se-navbar-footermenu-mobile-item se-wc-txt"><?php echo $mfootermenu->title; ?></p>
                </a>
                <?php
                $cf++;
              }
            }
          ?>
          </div>


        </div>


        <div class="se-navbar-mainmenu-mobile-style-layer" style="z-index: 5900; background-color:<?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>; border:20px <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?> solid;"></div>

        <?php if( get_option('sb_active') ) { ?>
          <div id="se-info-sidebar-container" class="se-sidebar-mobile-btn se-sc-bg">
            <svg version="1.1" class="se-info-sidebar-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            	 width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
            <g>
            	<g>
            		<path fill="#fff" d="M9.271,5.837C9.099,5.665,9.013,5.439,9.013,5.158s0.086-0.507,0.257-0.679
            			C9.442,4.308,9.668,4.223,9.95,4.223c0.28,0,0.506,0.085,0.678,0.257s0.257,0.398,0.257,0.679S10.8,5.665,10.628,5.837
            			C10.456,6.008,10.23,6.094,9.95,6.094C9.668,6.094,9.442,6.008,9.271,5.837z M10.573,15.392H9.325v-7.8h1.248V15.392z"/>
            	</g>
            	<g>
            		<path fill="#fff" d="M10,19.931c-5.475,0-9.93-4.455-9.93-9.93C0.07,4.525,4.525,0.07,10,0.07c5.476,0,9.931,4.455,9.931,9.931
            			C19.931,15.476,15.476,19.931,10,19.931z M10,0.937c-4.997,0-9.062,4.066-9.062,9.064c0,4.997,4.065,9.062,9.062,9.062
            			c4.998,0,9.063-4.065,9.063-9.062C19.063,5.003,14.998,0.937,10,0.937z"/>
            	</g>
            </g>
            </svg>
          </div>
        <?php }
    } ?>
    <!--Submenu-->


</header>
<?php
if(!wp_is_mobile()){
  foreach ($menu as $m){

    //echo '<pre>'; var_dump(); echo '</pre>';
    $smArr = $m['children'];
    if ($smArr) { ?>
      <div subnav="<?php echo $m['ID']; ?>" class="se-subnav-container se-sc-txt" style="opacity:0; width: 100vw;"> <?php

      foreach(array_reverse($smArr) as $sm){ ?>
        <a href="<?php echo $sm['url']; ?>" class="aagi-w-txt"  id="<?php echo $sm['ID']; ?>" parent="<?php echo $m['ID']; ?>">
          <span class="se-navbar-sub-item"><?php echo $sm['title']; ?></span>
        </a>
      <?php } ?>
    </div>
<?php } } }?>


<div class="header-placeholder" style="height:120px;width:100vw;">

</div>

<?php if( wp_is_mobile() && get_option( 'sb_active' ) ) { ?>
  <div style="position:fixed; left:0; bottom:0;z-index:9000; ">
    <svg version="1.1" class="se-info-sidebar-btn" style="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
    <g>
      <g>
        <path fill="#fff" d="M9.271,5.837C9.099,5.665,9.013,5.439,9.013,5.158s0.086-0.507,0.257-0.679
          C9.442,4.308,9.668,4.223,9.95,4.223c0.28,0,0.506,0.085,0.678,0.257s0.257,0.398,0.257,0.679S10.8,5.665,10.628,5.837
          C10.456,6.008,10.23,6.094,9.95,6.094C9.668,6.094,9.442,6.008,9.271,5.837z M10.573,15.392H9.325v-7.8h1.248V15.392z"/>
      </g>
      <g>
        <path fill="#fff" d="M10,19.931c-5.475,0-9.93-4.455-9.93-9.93C0.07,4.525,4.525,0.07,10,0.07c5.476,0,9.931,4.455,9.931,9.931
          C19.931,15.476,15.476,19.931,10,19.931z M10,0.937c-4.997,0-9.062,4.066-9.062,9.064c0,4.997,4.065,9.062,9.062,9.062
          c4.998,0,9.063-4.065,9.063-9.062C19.063,5.003,14.998,0.937,10,0.937z"/>
      </g>
    </g>
    </svg>
  </div>
<?php } ?>

<?php if(! wp_is_mobile() && get_option( 'sb_active' ) ) { ?>
<div class="se-info-sidebar-trigger se-sc-bg">
  <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="20px" height="20px" viewBox="0 0 40 39" enable-background="new 0 0 40 39" xml:space="preserve">
  <g>
    <path class="se-arrow" fill="<?php echo $seWC; ?>" d="M30.105,18.204L11.357,7.249c-0.764-0.448-1.743-0.19-2.188,0.574C8.724,8.585,8.98,9.565,9.744,10.01
      l16.333,9.545L9.819,29.446c-0.755,0.459-0.995,1.443-0.536,2.197c0.302,0.496,0.829,0.769,1.369,0.769
      c0.284,0,0.57-0.074,0.83-0.232l18.146-11.039c0.426-0.09,0.815-0.345,1.053-0.749C31.125,19.628,30.868,18.649,30.105,18.204z"/>
  </g>
  </svg>
</div>
<?php } ?>

<div class="se-info-sidebar se-sc-bg se-wc-txt" style="display:none;">
  <?php
  $stringTranslationArr = array(
    'location' => esc_attr( get_option( 'location' )),
    'address' => esc_attr( get_option( 'address' )),
    'date' => esc_attr( get_option( 'date' )),
    'time' => esc_attr( get_option( 'time' )),
    'participants' => esc_attr( get_option( 'participants' )),
    'language' => esc_attr( get_option( 'language' )),
    'translation' => esc_attr( get_option( 'translation' )),
    'price' => esc_attr( get_option( 'price' ))
  );
   ?>
  <iframe src="<?php echo esc_attr( get_option( 'google_maps' )); ?>" width="100%" height="20%" frameborder="0" style="border:0;" allowfullscreen></iframe>
  <div class="se-info-sidebar-content clearfix" >
    <div class="se-info-sidebar-icon" style="border-top: 2px solid <?php echo $seWC; ?>;">
      <img src="<?php echo get_template_directory_uri(); ?>/img/icon-ort.svg" alt="">
    </div>
    <div class="se-info-sidebar-text">
      <p><strong><?php echo __( $stringTranslationArr['location'], 'SimplEvent' ); ?></strong></p>
      <pre><?php echo __( $stringTranslationArr['address'], 'SimplEvent' ); ?></pre>
    </div>

    <div class="se-info-sidebar-icon" style="border-top: 2px solid <?php echo $seWC; ?>;">
      <img src="<?php echo get_template_directory_uri(); ?>/img/icon-datum.svg" alt="">
    </div>
    <div class="se-info-sidebar-text">
      <p><strong><?php echo __( $stringTranslationArr['date'], 'SimplEvent' ); ?></strong></p>
      <pre><?php echo __( $stringTranslationArr['time'], 'SimplEvent' ); ?></pre>
    </div>

    <div class="se-info-sidebar-icon" style="border-top: 2px solid <?php echo $seWC; ?>;">
      <img src="<?php echo get_template_directory_uri(); ?>/img/icon-participation.svg" alt="">
    </div>
    <div class="se-info-sidebar-text">
      <p><strong><?php echo __( 'Teilnehmende', 'SimplEvent' ); ?></strong></p>
      <p><?php echo __( $stringTranslationArr['participants'], 'SimplEvent' ); ?></p>
    </div>

    <div class="se-info-sidebar-icon" style="border-top: 2px solid <?php echo $seWC; ?>;">
      <img src="<?php echo get_template_directory_uri(); ?>/img/icon_language.svg" alt="">
    </div>
    <div class="se-info-sidebar-text">
      <p><strong><?php echo __( $stringTranslationArr['language'], 'SimplEvent' );?></strong></p>
      <p><?php echo __( $stringTranslationArr['translation'], 'SimplEvent' ); ?></p>
    </div>

    <?php
    if( $stringTranslationArr['price'] ) { ?>
      <div class="se-info-sidebar-icon" style="border-top: 2px solid <?php echo $seWC; ?>;">
        <img src="<?php echo get_template_directory_uri(); ?>/img/icon-price.svg" alt="">
      </div>
      <div class="se-info-sidebar-text">
        <p><strong><?php echo __( 'Preis', 'SimplEvent' ); ?></strong></p>
        <p><?php echo __( $stringTranslationArr['price'], 'SimplEvent' ); ?></p>
      </div>
    <?php
    }

    $seanmeldung = esc_attr( get_option( 'se_anmeldung' ));
    if( $seanmeldung == 'on') { ?>
      <a href="<?php echo esc_attr( get_option( 'se_anmeldelink' )); ?>" target="_blank">
        <div class="se_navbar_anmeldebutton se-mc-bg se-wc-txt" style="position: relative; left: 20%;">
          <?php echo __($regBtnText, 'SimplEvent'); ?>
        </div>
      </a>
    <?php } ?>

  </div>
</div>

<?php } else {
  //embed special content
} ?>

<body>
    
  <style>
    /*-------ATTENTION-------*/
    .se-attention-button { position: fixed; top:0;  border-radius:0 0 5px 5px ; z-index:99999; padding: 5px 20px; left:0; right:0; margin: auto; padding:5px; overflow-x: hidden; }
    .se-attention-button h4 { margin-left:10px; cursor:pointer; }
    .se-attention-button-closer svg { height:20px; position:absolute; right:8px; top:9px; }

    .se-attention-container { position:fixed; top:0; left:0; height:100vh; width:100vw; background-color:rgba(0,0,0,0.8);z-index:100000; }
    .se-attention-frame { background-color:white; position:absolute; top:0; bottom:0; left:0; right:0; border-radius:5px; margin:auto; width:50vw; height:50vh; padding:20px; overflow-y:scroll;}
    .se-attention-frame-closer svg { position:absolute; top:10px; right:10px; z-index: 100005; height:20px; cursor: pointer;}
    .se-attention-frame p {margin-bottom:20px;}

    /*-------ATTENTION-------*/
    @media only screen and (max-width: 1024px) {
      .se-attention-frame {  width:90vw; height:80vh; }
    }
  </style>

  <?php
    $attentionAcitavtion = esc_attr( get_option( 'se_attention' ) );
    $displayAttenionContiainer = (is_front_page() && $attentionAcitavtion) ? 'block' : 'none'; ?>
  <div id="attention" style="display:<?php echo $displayAttenionContiainer; ?>;">
    <?php
      $attentionDisplay = 'none';
      
      if( isset($_GET['attention']) ) {
        $attentionDisplay = ($_GET['attention'] == '1') ? 'block' : 'none'; 
      } 
    ?>
  </div>

  <div id="se-site-loader" style="opacity: 0;">

  <?php
  if( !wp_is_mobile() ) {
    if( !is_front_page() && !is_page_template( 'template-modular.php' )
      && !is_page_template( 'template-review.php' )
      && !is_page_template( 'template-speaker.php' )
      && !is_page_template( 'template-maps.php' ) ) {
        echo '<div class="se-header-title-placeholder"></div>';
    }
  }

  ?>

<!-- ATTENTION -->
  <script>	
    var getLangCode = '<?php echo ICL_LANGUAGE_CODE; ?>';
    var attentionDisplay = '<?php echo $attentionDisplay; ?>';
    var AttentionCloser = jQuery('.se-attention-button-closer');
    var AttentionButton = jQuery('.se-attention-button');
    var Attention = jQuery('.se-attention-container');
    var AttentionFrameCloser = jQuery('.se-attention-frame-closer').find('svg');

    loadAttention();
    var attentionContainer = document.getElementById("attention");
    function loadAttention(){
      console.log('asdfasd');
      var ourRequest = new XMLHttpRequest();
      ourRequest.open('GET','https://www.nzz-konferenzen.ch/wp-json/wp/v2/posts?406');
      ourRequest.onload = function() {
        if (ourRequest.status >= 200 && ourRequest.status < 400) {
          var data = JSON.parse(ourRequest.responseText);
          console.log(data);
          createAttention(data);

        } else {
          console.log("We connected to the server, but it returned an error.");
        }

        AttentionCloser = jQuery('.se-attention-button-closer');
        AttentionButton = jQuery('.se-attention-button');
        Attention = jQuery('.se-attention-container');
        AttentionFrameCloser = jQuery('.se-attention-frame-closer').find('svg');

        jQuery('.se-attention-button-closer').on('click', function(){
          jQuery(this).parent().fadeOut();
          jQuery('.se-attention-container').fadeOut();
        });

        jQuery('.se-attention-button').find('h4').on('click', function(){
          jQuery('.se-attention-container').fadeIn();

        });

        jQuery('.se-attention-frame-closer').on('click', function(){
          jQuery('.se-attention-container').fadeOut();
          jQuery('.se-attention-button').fadeOut();
        });
      };

      ourRequest.onerror = function() {
        console.log("Connection error");
      };

      ourRequest.send();
    }

    function createAttention(d) {
      var resultHTMLString = '';
      var rowCount = 0;
        
      let atbuttontext;
      let attitle;
      let attext;
      let atdownload;
      
      if(getLangCode) {
        switch (getLangCode) {
        case 'de':
          atbuttontext = d[0].acf.de.buttontext;
          attitle = d[0].acf.de.title;
          attext = d[0].acf.de.text;
          atdownload = d[0].acf.de.download;
          break;
        case 'en':
          atbuttontext = d[0].acf.en.buttontext;
          attitle = d[0].acf.en.title;
          attext = d[0].acf.en.text;
          atdownload = d[0].acf.en.download;
          break;
        case 'fr':
          atbuttontext = d[0].acf.fr.buttontext;
          attitle = d[0].acf.fr.title;
          attext = d[0].acf.fr.text;
          atdownload = d[0].acf.fr.download;
          break;
        default:
          atbuttontext = d[0].acf.de.buttontext;
          attitle = d[0].acf.de.title;
          attext = d[0].acf.de.text;
          atdownload = d[0].acf.de.download;
          break;
        }
      } else {
        atbuttontext = d[0].acf.de.buttontext;
        attitle = d[0].acf.de.title;
        attext = d[0].acf.de.text;
        atdownload = d[0].acf.de.download;
      }
      

      //BUTTON
      resultHTMLString = '<div class="se-attention-button se-mc-bg se-wc-txt">';
      resultHTMLString += '<h4><b>' + atbuttontext + '</b></h4>';
      resultHTMLString += '<div class="se-attention-button-closer">';
      resultHTMLString += '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"';
      resultHTMLString += 'viewBox="0 0 44.91 44.91" style="enable-background:new 0 0 44.91 44.91; color:white;" xml:space="preserve">';
      resultHTMLString += '<style>.cleser-cross{fill:white;}</style>';
      resultHTMLString += '<path class="cleser-cross" d="M22.45,0C10.05,0,0,10.05,0,22.45s10.05,22.45,22.45,22.45s22.45-10.05,22.45-22.45S34.85,0,22.45,0z M37.28,31.99';
      resultHTMLString += 'c0.27,0.27,0.27,0.7,0,0.96l-4.33,4.33c-0.27,0.27-0.7,0.27-0.96,0l-9.53-9.53l-9.53,9.53c-0.27,0.27-0.7,0.27-0.96,0l-4.33-4.33';
      resultHTMLString += 'c-0.27-0.27-0.27-0.7,0-0.96l9.53-9.53l-9.53-9.53c-0.27-0.27-0.27-0.7,0-0.96l4.33-4.33c0.27-0.27,0.7-0.27,0.96,0l9.53,9.53';
      resultHTMLString += 'l9.53-9.53c0.27-0.27,0.7-0.27,0.96,0l4.33,4.33c0.27,0.27,0.27,0.7,0,0.96l-9.53,9.53L37.28,31.99z"/>';
      resultHTMLString += '</svg>';
      resultHTMLString += '</div>';
      resultHTMLString += '</div>';

      
      //POPUP
      resultHTMLString += '<div class="se-attention-container" style="display:' + attentionDisplay + ';">';
      resultHTMLString += '<div class="se-attention-frame">';
      resultHTMLString += '<h1>' + attitle + '</h1>';
      resultHTMLString += '<p>' + attext + '</p>';
      if(atdownload)
      {
        resultHTMLString += '<a href="' + atdownload + '" target="_blank"><b class="se-mc-txt" style="font-size:2em;">FAQ</b></a>';
      }
      resultHTMLString += '<div class="se-attention-frame-closer">';
      resultHTMLString += '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"';
      resultHTMLString += 'viewBox="0 0 44.91 44.91" style="enable-background:new 0 0 44.91 44.91; color:white;" xml:space="preserve">';
      resultHTMLString += '<style>.closer-cross{fill:black;}</style>';
      resultHTMLString += '<path class="closer-cross" d="M22.45,0C10.05,0,0,10.05,0,22.45s10.05,22.45,22.45,22.45s22.45-10.05,22.45-22.45S34.85,0,22.45,0z M37.28,31.99';
      resultHTMLString += 'c0.27,0.27,0.27,0.7,0,0.96l-4.33,4.33c-0.27,0.27-0.7,0.27-0.96,0l-9.53-9.53l-9.53,9.53c-0.27,0.27-0.7,0.27-0.96,0l-4.33-4.33';
      resultHTMLString += 'c-0.27-0.27-0.27-0.7,0-0.96l9.53-9.53l-9.53-9.53c-0.27-0.27-0.27-0.7,0-0.96l4.33-4.33c0.27-0.27,0.7-0.27,0.96,0l9.53,9.53';
      resultHTMLString += 'l9.53-9.53c0.27-0.27,0.7-0.27,0.96,0l4.33,4.33c0.27,0.27,0.27,0.7,0,0.96l-9.53,9.53L37.28,31.99z"/>';
      resultHTMLString += '</svg>';
      resultHTMLString += '</div>';
      resultHTMLString += '</div>';
      resultHTMLString += '</div>';


      attentionContainer.innerHTML = resultHTMLString;
    
    }

    //----------------------------------------------------
    //----attention-----------------------------------------
    //----------------------------------------------------
    
    jQuery(window).bind("load", function(){
      
      AttentionCloser.on('click', function(){
        $(this).parent().fadeOut();
        Attention.fadeOut();
      });
    
      AttentionButton.find('h4').on('click', function(){
        Attention.fadeIn();
        
      });
    
      AttentionFrameCloser.on('click', function(){
        Attention.fadeOut();
        AttentionButton.fadeOut();
      });
    
      if(Attention) {
        
      }
    });
  </script>