<?php

/*
  ==================
  SimplEvent: ENQUEUE FUNCTIONS
  ==================
*/

function se_load_admin_scripts( $hook ){

  if ( 'toplevel_page_aagi_simplevent' != $hook && 'simplevent_page_simplevent_header' != $hook && 'simplevent_page_simplevent_sidebar' != $hook && 'simplevent_page_simplevent_footer' != $hook){ //checken damit nur auf entsprechenden Seiten eingefügt wird
    return;
  }

  wp_register_style('se_admin', get_template_directory_uri() . '/css/simplevent.admin.css', array(), '1.0.0', 'all' );
  wp_register_style('se_acf_admin', get_template_directory_uri() . '/css/acf.admin.css', array(), '1.0.0', 'all' );
  wp_enqueue_style('se_admin');


  wp_enqueue_media(); //import media uploader

  wp_register_script( 'se_admin-script', get_template_directory_uri() . '/js/simplevent.admin.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'se_admin-script' );

  // Add the color picker css file
  wp_enqueue_style( 'wp-color-picker' );

  // Include our custom jQuery file with WordPress Color Picker dependency
  wp_enqueue_script( 'se-color-picker', get_template_directory_uri() . '/js/colorpicker-script.js', array( 'jquery', 'wp-color-picker' ), false, true  );

}
add_action('admin_enqueue_scripts', 'se_load_admin_scripts'); //only print in WP Backend
