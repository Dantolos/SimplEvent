<!DOCTYPE html>
<html>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="shortcut icon" href="favicon.ico" type="img/x-icon" />

<?php //import Files
  function theme_add_files() {
    //plugins
  	wp_enqueue_script( 'moveit-js', get_template_directory_uri() . '/js/moveit.js' );
    wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js' );

  	wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style.css' );
  	wp_enqueue_script( 'script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), true );

    wp_enqueue_script( 'lightbox-js', get_template_directory_uri() . '/js/class.lightbox.js', array('jquery'), true );

    //JS Translations
    $translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
    wp_localize_script( 'script-js', 'seDIR', $translation_array );
    wp_localize_script( 'lightbox-js', 'seDIR', $translation_array );

    //load initiative informations JS
    wp_enqueue_script( 'iniviative-js', get_template_directory_uri() . '/js/initiative.js', array('jquery'), true );
  }
  add_action( 'wp_enqueue_scripts', 'theme_add_files' );

  wp_head();

  //classes
  require_once('inc/class.download.php');
  require_once('inc/class.link.php');
  require_once('inc/class.loading.php');
  require_once('inc/class.lightbox.php');

  //modular classes
  require_once('inc/class.modular-elements.php');
  require_once('inc/class.modular.php');



  //colors
  $seMC = esc_attr( get_option( 'main_color_picker' ) ) ;
  $seSC = esc_attr( get_option( 'second_color_picker' ) );
  $seWC = esc_attr( get_option( 'light_color_picker' ) );

  //Language
  $curLang = apply_filters( 'wpml_current_language', NULL );
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

  .button-border { border: solid 2px <?php echo $seMC; ?>; }
</style>

<header semc="<?php echo $seMC; ?>" sesc="<?php echo $seSC; ?>" sewc="<?php echo $seWC; ?>" curlang="<?php echo $curLang ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">


  <div class="se-navbar-container clearfix">
    <div class="se-header-logo">
      <a href="<?php $url = home_url(); echo esc_url( $url ); ?>">
        <img src="<?php echo esc_attr( get_option( 'event_logo' ) ); ?>" alt="home-logo" title="<?php bloginfo('name'); ?>" />
      </a>
    </div>
    <div class="se-header-icon" style="display:none;">
      <a href="<?php $url = home_url(); echo esc_url( $url ); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/img/sif-icon-pos.svg" />
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

        $array_menu = wp_get_nav_menu_items(3);
        $menu = array();
        foreach ($array_menu as $m) {
            if (empty($m->menu_item_parent)) {
                $menu[$m->ID] = array();
                $menu[$m->ID]['ID']      =   $m->ID;
                $menu[$m->ID]['title']       =   $m->title;
                $menu[$m->ID]['url']         =   $m->url;
                $menu[$m->ID]['children']    =   array();
            }
        }
        $submenu = array();
        foreach ($array_menu as $m) {
            if ($m->menu_item_parent) {
                $submenu[$m->ID] = array();
                $submenu[$m->ID]['ID']       =   $m->ID;
                $submenu[$m->ID]['title']    =   $m->title;
                $submenu[$m->ID]['url']  =   $m->url;
                $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
            }
        }

        //echo '<pre>'; var_dump($menu); echo '</pre>';

        foreach ($menu as $m){?>
          <a href="<?php if( $m['url'] == '#'){ echo 'javascript:;'; } else { echo $m['url']; } ?>" class="aagi-w-txt se-navelement" nav="<?php echo $m['ID']; ?>">
            <span class="se-navbar-mainmenu-item"><?php echo $m['title']; ?></span>
          </a>
        <?php } ?>
      </div>

      <div class="nav-layer se-mc-bg">

      </div>

      <div class="se_navbar_anmeldebutton se-mc-bg se-wc-txt">
        Jetzt anmelden
      </div>
      <div class="se_navbar_infobutton">
        <img src="<?php echo get_template_directory_uri(); ?>/img/icon-info.svg" alt="more" title="show more Events" height="100%"/>
      </div>

    </div>

    <!--Submenu-->
    <?php
    foreach ($menu as $m){
      //echo '<pre>'; var_dump($m['children']); echo '</pre>';
      $smArr = $m['children'];
      if ($smArr) { ?>
        <div subnav="<?php echo $m['ID']; ?>" class="se-subnav-container se-mc-bg se-wc-txt"> <?php

        foreach($smArr as $sm){ ?>
          <a href="<?php echo $sm['url']; ?>" class="aagi-w-txt"  id="<?php echo $sm['ID']; ?>">
            <span class="se-navbar-sub-item"><?php echo $sm['title']; ?></span>
          </a>
        <?php } ?>
      </div>
      <?php } } ?>



    <div class="se-more-events-container se-sc-bg se-wc-txt clearfix">
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

</header>
<div class="header-placeholder" style="height:120px;width:100vw;">

</div>

<div class="se-info-sidebar se-sc-bg">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2692.2673328665496!2d7.596948616013694!3d47.56258679900988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4791b9b9f44ce80f%3A0x549e8c49a2c2cdc1!2sCongress+Center+Basel!5e0!3m2!1sde!2sch!4v1530023396628" width="100%" height="300" frameborder="0" style="border:0;margin-top:80px;" allowfullscreen></iframe>
</div>

<body>                                                                                                                                                                                                
