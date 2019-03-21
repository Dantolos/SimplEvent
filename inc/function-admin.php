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
  add_submenu_page( 'aagi_simplevent', 'SimplEvent Footer Options', 'Footer', 'manage_options', 'simplevent_footer', 'simplevent_theme_footer_page' );

  //activieren custom settings
  add_action( 'admin_init', 'simplevent_custom_settings' );
}
add_action( 'admin_menu', 'SimplEvent_add_admin_page');

//save settings and seessions
function simplevent_custom_settings() {
  //----------------------------------GENERAL ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-settings-group', 'event_logo' );
  register_setting( 'simplevent-settings-group', 'event_icon' );
  register_setting( 'simplevent-settings-group', 'twitter_link' );
  register_setting( 'simplevent-settings-group', 'youtube_link' );
  register_setting( 'simplevent-settings-group', 'facebook_link' );
  register_setting( 'simplevent-settings-group', 'linkedin_link' );
  register_setting( 'simplevent-settings-group', 'insta_link' );

  register_setting( 'simplevent-settings-group', 'main_color_picker' );
  register_setting( 'simplevent-settings-group', 'second_color_picker' );
  register_setting( 'simplevent-settings-group', 'light_color_picker' );

  register_setting( 'simplevent-settings-group', 'bg_img' );

  //****SECTIONS
  add_settings_section( 'simplevent-general-options', 'General Options', 'simplevent_general_options', 'aagi_simplevent');
  add_settings_section( 'simplevent-color-options', 'Colors', 'simplevent_color_options', 'aagi_simplevent');
  add_settings_section( 'simplevent-bg', 'Background', 'simplevent_bg', 'aagi_simplevent');


  //****fields
  add_settings_field( 'event_logo', 'Logo', 'simplevent_event_logo', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'event_icon', 'Icon', 'simplevent_event_icon', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'twitter-link', 'Twitter', 'simplevent_twitter_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'youtube-link', 'Youtube', 'simplevent_youtube_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'facebook-link', 'Facebook', 'simplevent_facebook_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'linkedin-link', 'LinkedIn', 'simplevent_linkedin_link', 'aagi_simplevent', 'simplevent-general-options' );
  add_settings_field( 'insta-link', 'Instagramm', 'simplevent_insta_link', 'aagi_simplevent', 'simplevent-general-options' );

  add_settings_field( 'main-color-picker', 'Main Color', 'simplevent_main_color_picker', 'aagi_simplevent', 'simplevent-color-options' );
  add_settings_field( 'second-color-picker', 'Second Color', 'simplevent_second_color_picker', 'aagi_simplevent', 'simplevent-color-options' );
  add_settings_field( 'light-color-picker', 'Light Color', 'simplevent_light_color_picker', 'aagi_simplevent', 'simplevent-color-options' );

  add_settings_field( 'background-image', 'Hintergrundbild', 'simplevent_bg_img', 'aagi_simplevent', 'simplevent-bg' );


  //----------------------------------Header ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-header-group', 'se_anmeldung' );
  register_setting( 'simplevent-header-group', 'se_anmeldelink' );

  //****Section
  add_settings_section( 'simplevent-header-options', 'Header', 'simplevent_header_options', 'simplevent_header');

  //****Fields
  add_settings_field( 'se-anmeldung', 'Anmeldung Aktiv', 'simplevent_se_anmeldung', 'simplevent_header', 'simplevent-header-options' );
  add_settings_field( 'se-anmeldelink', 'Anmeldung Link', 'simplevent_se_anmeldelink', 'simplevent_header', 'simplevent-header-options' );

  //----------------------------------SIDEBAR ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-sidebar-group', 'google_maps' );
  register_setting( 'simplevent-sidebar-group', 'location' );
  register_setting( 'simplevent-sidebar-group', 'address' );

  register_setting( 'simplevent-sidebar-group', 'date' );
  register_setting( 'simplevent-sidebar-group', 'time' );

  register_setting( 'simplevent-sidebar-group', 'participants' );

  register_setting( 'simplevent-sidebar-group', 'language' );
  register_setting( 'simplevent-sidebar-group', 'translation' );

  register_setting( 'simplevent-sidebar-group', 'price' );

  //****Section
  add_settings_section( 'simplevent-sidebar-options', 'Sidebar', 'simplevent_sidebar_options', 'simplevent_sidebar');

  //****Fields
  add_settings_field( 'google-maps', 'GoogleMaps', 'simplevent_google_maps', 'simplevent_sidebar', 'simplevent-sidebar-options' );

  add_settings_field( 'location', 'Location', 'simplevent_location', 'simplevent_sidebar', 'simplevent-sidebar-options' );
  add_settings_field( 'address', 'Address', 'simplevent_address', 'simplevent_sidebar', 'simplevent-sidebar-options' );

  add_settings_field( 'date', 'Datum', 'simplevent_date', 'simplevent_sidebar', 'simplevent-sidebar-options' );
  add_settings_field( 'time', 'Zeiten', 'simplevent_time', 'simplevent_sidebar', 'simplevent-sidebar-options' );

  add_settings_field( 'participants', 'Teilnehmer', 'simplevent_participants', 'simplevent_sidebar', 'simplevent-sidebar-options' );

  add_settings_field( 'language', 'Hauptsprache', 'simplevent_language', 'simplevent_sidebar', 'simplevent-sidebar-options' );
  add_settings_field( 'translation', 'Uebersetungen', 'simplevent_translation', 'simplevent_sidebar', 'simplevent-sidebar-options' );

  add_settings_field( 'price', 'Preis', 'simplevent_price', 'simplevent_sidebar', 'simplevent-sidebar-options' );

  //----------------------------------FOOTER ---------------------------------------//
  //****Settings
  register_setting( 'simplevent-footer-group', 'se_c_text' );

  //****Section
  add_settings_section( 'simplevent-footer-options', 'Footer', 'simplevent_footer_options', 'simplevent_footer');

  //****Fields
  add_settings_field( 'ctext', 'Copyright Text', 'simplevent_se_c_text', 'simplevent_footer', 'simplevent-footer-options' );
}

function simplevent_general_options() {
  echo 'Allgemeine Anpassungen | Logo – Social Media';
}
function simplevent_color_options() {
  echo 'Farben anpassen';
}
function simplevent_bg() {
  echo 'Das Hindergrundbild wechseln';
}

function simplevent_header_options() {
  echo 'Slider für die Startseite generieren';
}

function simplevent_sidebar_options() {
  echo 'Sidebar anpassen';
}

function simplevent_footer_options() {
  echo 'Slider für die Startseite generieren';
}

//---------------------------------------------OUTPUTS------------------------------------//

//----------------------------------GENERAL ---------------------------------------//
//social media
function simplevent_event_logo() {
  $logo = esc_attr( get_option( 'event_logo' ) );
  echo '<input type="button" value="Logo" class="button button-secondary upload-button" data-target="event-logo"/><input type="" id="event-logo" name="event_logo" value="' .$logo. '"/>';
}
function simplevent_event_icon() {
  $icon = esc_attr( get_option( 'event_icon' ) );
  echo '<input type="button" value="Icon" class="button button-secondary upload-button" data-target="event-icon"/><input type="" id="event-icon" name="event_icon" value="' .$icon. '"/>';
}
function simplevent_twitter_link() {
  $twitter = esc_attr( get_option( 'twitter_link' ) );
  echo '<input type="text" name="twitter_link" value="' .$twitter. '" placeholder="URL" />';
}
function simplevent_youtube_link() {
  $youtube = esc_attr( get_option( 'youtube_link' ) );
  echo '<input type="text" name="youtube_link" value="' .$youtube. '" placeholder="URL" />';
}
function simplevent_facebook_link() {
  $facebook = esc_attr( get_option( 'facebook_link' ) );
  echo '<input type="text" name="facebook_link" value="' .$facebook. '" placeholder="URL" />';
}
function simplevent_linkedin_link() {
  $linkedin = esc_attr( get_option( 'linkedin_link' ) );
  echo '<input type="text" name="linkedin_link" value="' .$linkedin. '" placeholder="URL" />';
}
function simplevent_insta_link() {
  $insta = esc_attr( get_option( 'insta_link' ) );
  echo '<input type="text" name="insta_link" value="' .$insta. '" placeholder="URL" />';
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

//BG
function simplevent_bg_img() {
  $bg = esc_attr( get_option( 'bg_img' ) );
  echo '<input type="button" value="Bg" class="button button-secondary upload-button" data-target="bg-img"/><input type="" id="bg-img" name="bg_img" value="' .$bg. '"/>';
}
//----------------------------------HEADER ---------------------------------------//

function simplevent_se_anmeldung() {
  $seanmeldung = esc_attr( get_option( 'se_anmeldung' ) );
  if($seanmeldung == 'on'){
    $seanmeldung = 'checked';
  }
  echo '<input type="checkbox" name="se_anmeldung" ' .$seanmeldung. '/>';
}
function simplevent_se_anmeldelink() {
  $anmeldelink = get_option( 'se_anmeldelink' );
  echo '<input type="text" name="se_anmeldelink" value="' .$anmeldelink. '" placeholder="URL"/>';
}

//----------------------------------SIDEBAR ---------------------------------------//

function simplevent_google_maps() {
  $gmaps = esc_attr( get_option( 'google_maps' ) );
  echo '<input type="text" name="google_maps" value="' .$gmaps. '" placeholder="google maps" />';
}
function simplevent_location() {
  $location = esc_attr( get_option( 'location' ) );
  echo '<input type="text" name="location" value="' .$location. '" placeholder="ort" />';
}
function simplevent_address() {
  $address =  get_option( 'address' );
  echo '<textarea rows="2" name="address" placeholder="address">' .$address. '</textarea>';
}
function simplevent_date() {
  $date = esc_attr( get_option( 'date' ) );
  echo '<input type="text" name="date" value="' .$date. '" placeholder="date" />';
}
function simplevent_time() {
  $time =  get_option( 'time' );
  echo '<textarea rows="2" name="time" placeholder="time">' .$time. '</textarea>';
}
function simplevent_participants() {
  $participants =  get_option( 'participants' );
  echo '<textarea rows="2" name="participants" placeholder="participants">' .$participants. '</textarea>';
}
function simplevent_language() {
  $language = esc_attr( get_option( 'language' ) );
  echo '<input type="text" name="language" value="' .$language. '" placeholder="language" />';
}
function simplevent_translation() {
  $translation =  get_option( 'translation' );
  echo '<textarea rows="2" name="translation" placeholder="translation">' .$translation. '</textarea>';
}
function simplevent_price() {
  $price = esc_attr( get_option( 'price' ) );
  echo '<input type="text" name="price" value="' .$price. '" placeholder="Preis" />';
}

//----------------------------------FOOTER ---------------------------------------//

function simplevent_se_c_text() {
  $se_c_text = get_option( 'se_c_text' );
  echo '<input type="text" name="se_c_text" value="' .$se_c_text. '" placeholder="Swiss Economic Forum | 2017"/>';
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

function simplevent_theme_footer_page(){
  require_once( get_template_directory() . '/inc/templates/simplevent-footer.php' );
}
