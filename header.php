<!DOCTYPE html>

<html>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,700">
  <link rel="shortcut icon" href="favicon.ico" type="img/x-icon" />

<?php //import Files
  function theme_add_files() {
    //plugins
  	wp_enqueue_script( 'moveit-js', get_template_directory_uri() . '/js/moveit.js' );
    wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js' );

  	wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style.css' );
  	wp_enqueue_script( 'script-js', get_template_directory_uri() . '/js/script.js', array('jquery')  );

  }
  add_action( 'wp_enqueue_scripts', 'theme_add_files' );

  wp_head();

?>

  <!-- Google Tag Manager -->
  <!-- TODO -->

</head>

<style>
  /*--COLOR--*/
  .se-mc-bg { background-color: <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>; } /*maincolor*/
  .se-mc-txt { color: <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>; }
  .se-sc-bg { background-color: <?php echo esc_attr( get_option( 'second_color_picker' ) ); ?>; } /*dark*/
  .se-sc-txt { color: <?php echo esc_attr( get_option( 'second_color_picker' ) ); ?>; }
  .se-wc-bg { background-color: <?php echo esc_attr( get_option( 'light_color_picker' ) ); ?>; } /*light*/
  .se-wc-txt { color: <?php echo esc_attr( get_option( 'light_color_picker' ) ); ?>; }
</style>

<header>
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
      <div class="se-more-events-button se-wc-txt">
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

        foreach ($menu as $m){ ?>
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



    <div class="se-more-events-container">
      <iframe src="http://www.nzz-konferenzen.ch/iframe/iframe-basic/" width="100%" height="100%"></iframe>
    </div>

</header>
<div class="header-placeholder" style="height:120px;width:100vw;">

</div>

<div class="se-info-sidebar se-sc-bg">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2692.2673328665496!2d7.596948616013694!3d47.56258679900988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4791b9b9f44ce80f%3A0x549e8c49a2c2cdc1!2sCongress+Center+Basel!5e0!3m2!1sde!2sch!4v1530023396628" width="100%" height="300" frameborder="0" style="border:0;margin-top:80px;" allowfullscreen></iframe>
</div>

<body>
                                                                                                                                                                                                       
