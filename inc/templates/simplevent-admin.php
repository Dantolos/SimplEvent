<img src="<?php echo get_template_directory_uri() . '/img/simplevent-icon.svg'; ?>" alt="" height="80px" style="border-bottom: 2px solid #6b6b6b;margin-top:30px; margin-bottom:10px; width:97.5%;" >
<h2></h2>
<style>
  /*--COLOR--*/
  .se-mc-bg { background-color: <?php echo esc_attr( get_option( 'main_color_picker' ) ) ; ?>; } /*maincolor*/
  .se-mc-txt { color: <?php echo esc_attr( get_option( 'main_color_picker' ) ); ?>; }
  .se-sc-bg { background-color: <?php echo esc_attr( get_option( 'second_color_picker' ) ); ?>; } /*dark*/
  .se-sc-txt { color: <?php echo esc_attr( get_option( 'second_color_picker' ) ); ?>; }
  .se-wc-bg { background-color: <?php echo esc_attr( get_option( 'light_color_picker' ) ); ?>; } /*light*/
  .se-wc-txt { color: <?php echo esc_attr( get_option( 'light_color_picker' ) ); ?>; }
</style>

<?php settings_errors(); ?>
<form action="options.php" method="post" class="simplevent-general-form se-sc-bg">
  <?php settings_fields( 'simplevent-settings-group' ); ?>
  <?php do_settings_sections('aagi_simplevent'); ?>
  <?php submit_button(); ?>
</form>

<!--VORSCHAU-->
<div class="simplevent_option_preview">

    <div class="se-navbar-container se-sc-bg clearfix">
      <div class="se-header-logo">
        <img src="<?php echo esc_attr( get_option( 'event_logo' ) ); ?>" alt="home-logo" title="<?php bloginfo('name'); ?>" />
      </div>
      <div class="se-more-events-section">
        <div class="se-more-events-button se-wc-txt">
          <img src="<?php echo get_template_directory_uri(); ?>/img/icon-plus.svg" alt="more" title="show more Events"/>
          <span style="">more Events</span>
        </div>
      </div>

      <div class="se-wc-txt se-navbar-mainmenu">
        <span class="se-navbar-mainmenu-item"><a>SEITE</a></span>

        <div class="se_navbar_anmeldebutton se-mc-bg">
          Jetzt anmelden
        </div>
        <div class="se_navbar_infobutton">
          <img src="<?php echo get_template_directory_uri(); ?>/img/icon-info.svg" alt="more" title="show more Events" height="100%"/>
        </div>

      </div>

</div>
