<?php
/*
  ==================
  SimplEvent: ADMIN PAGE
  ==================
*/

ini_set('display_errors', 'On');
error_reporting(E_ALL);

function SimplEvent_add_admin_page() {

  //Generate Simplevent Page
  add_menu_page( 'SimplEvent Theme Options', 'SimplEvent', 'manage_options', 'aagi_simplevent', 'simplevent_theme_create_page', get_template_directory_uri() . '/img/simplevent-icon.svg', 110 );

  //Generate SimplEvent Sub Pages
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Theme Options', 'General', 'manage_options', 'aagi_simplevent', 'simplevent_theme_create_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Header Options', 'Header', 'manage_options', 'simplevent_header', 'simplevent_theme_header_page' );
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Sidebar Options', 'Sidebar', 'manage_options', 'simplevent_sidebar', 'simplevent_theme_sidebar_page' );
  //activieren custom settings
  add_action( 'admin_init', 'simplevent_custom_settings' );
}
add_action( 'admin_menu', 'SimplEvent_add_admin_page');

//save settings and seessions
function simplevent_custom_settings() {
  //----------------------------------GENERAL ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-settings-group', 'event_logo' );
  register_setting( 'simplevent-settings-group', 'twitter_link' );
  register_setting( 'simplevent-settings-group', 'youtube_link' );
  register_setting( 'simplevent-settings-group', 'facebook_link' );

  register_setting( 'simplevent-settings-group', 'main_color_picker' );
  register_setting( 'simplevent-settings-group', 'second_color_picker' );
  register_setting( 'simplevent-settings-group', 'light_color_picker' );

  //****SECTIONS
  add_settings_section( 'simplevent-general-options', 'General Options', 'simplevent_general_options', 'aagi_simplevent');
  add_settings_section( 'simplevent-color-options', 'Colors', 'simplevent_color_options', 'aagi_simplevent');

  //****fields
  add_settings_field( 'event_logo', 'Logo', 'simplevent_event_logo', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'twitter-link', 'Twitter', 'simplevent_twitter_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'youtube-link', 'Youtube', 'simplevent_youtube_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'facebook-link', 'Facebook', 'simplevent_facebook_link', 'aagi_simplevent', 'simplevent-general-options' );

  add_settings_field( 'main-color-picker', 'Main Color', 'simplevent_main_color_picker', 'aagi_simplevent', 'simplevent-color-options' );
  add_settings_field( 'second-color-picker', 'Second Color', 'simplevent_second_color_picker', 'aagi_simplevent', 'simplevent-color-options' );
  add_settings_field( 'light-color-picker', 'Light Color', 'simplevent_light_color_picker', 'aagi_simplevent', 'simplevent-color-options' );

  //----------------------------------Header ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-header-group', 'slider_header' );

  //****Section
  add_settings_section( 'simplevent-header-options', 'Header', 'simplevent_header_options', 'simplevent_header');

  //****Fields
  add_settings_field( 'header-slider', 'HeaderSlider', 'simplevent_header_slider', 'simplevent_header', 'simplevent-header-options' );

  //----------------------------------SIDEBAR ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-sidebar-group', 'google_maps' );

  //****Section
  add_settings_section( 'simplevent-sidebar-options', 'Sidebar', 'simplevent_sidebar_options', 'simplevent_sidebar');

  //****Fields
  add_settings_field( 'google-maps', 'GoogleMaps', 'simplevent_google_maps', 'simplevent_sidebar', 'simplevent-sidebar-options' );
}

function simplevent_general_options() {
  echo 'Allgemeine Anpassungen | Logo – Social Media';
}

function simplevent_color_options() {
  echo 'Farben anpassen';
}

function simplevent_header_options() {
  echo 'Slider für die Startseite generieren';
}

function simplevent_sidebar_options() {
  echo 'Sidebar anpassen';
}


//---------------------------------------------OUTPUTS------------------------------------//

//----------------------------------GENERAL ---------------------------------------//
//social media
function simplevent_event_logo() {
  $logo = esc_attr( get_option( 'event_logo' ) );
  echo '<input type="button" value="Upload Event Logo" class="button button-secondary" id="upload-button"/><input type="hidden" id="event-logo" name="event_logo" value="' .$logo. '"/>';
}
function simplevent_twitter_link() {
  $twitter = esc_attr( get_option( 'twitter_link' ) );
  echo '<input type="text" name="twitter_link" value="' .$twitter. '" placeholder="twitter link" />';
}
function simplevent_youtube_link() {
  $youtube = esc_attr( get_option( 'youtube_link' ) );
  echo '<input type="text" name="youtube_link" value="' .$youtube. '" placeholder="youtube link" />';
}
function simplevent_facebook_link() {
  $facebook = esc_attr( get_option( 'facebook_link' ) );
  echo '<input type="text" name="facebook_link" value="' .$facebook. '" placeholder="facebook link" />';
}

//Colors output
function simplevent_main_color_picker() {
  $maincolor = get_option( 'main_color_picker' );
  echo '<input class="se-color-picker" type="text" name="main_color_picker" value="' .$maincolor. '" data-default-color="#effeff" />';
}
function simplevent_second_color_picker() {
  $secondcolor = get_option( 'second_color_picker' );
  echo '<input class="se-color-picker" type="text" name="second_color_picker" value="' .$secondcolor. '" data-default-color="#282828" />';
}
function simplevent_light_color_picker() {
  $lightcolor = get_option( 'light_color_picker' );
  echo '<input class="se-color-picker" type="text" name="light_color_picker" value="' .$lightcolor. '" data-default-color="#dedede" />';
}

//----------------------------------HEADER ---------------------------------------//

function simplevent_header_slider() {
  $slider = esc_attr( get_option( 'slider_header' ) );
  echo '<input type="text" name="google_maps" value="' .$slider. '" placeholder="google maps" />';
}

//----------------------------------SIDEBAR ---------------------------------------//

function simplevent_google_maps() {
  $gmaps = esc_attr( get_option( 'google_maps' ) );
  echo '<input type="text" name="google_maps" value="' .$gmaps. '" placeholder="google maps" />';
}

//---------------------------------------------TEMPLATES------------------------------------//
function simplevent_theme_create_page() {
  require_once( get_template_directory() . '/inc/templates/simplevent-admin.php' );
}

function simplevent_theme_header_page(){
  require_once( get_template_directory() . '/inc/templates/simplevent-header.php' );
}

function simplevent_theme_sidebar_page() {
  require_once( get_template_directory() . '/inc/templates/simplevent-sidebar.php' );
}
