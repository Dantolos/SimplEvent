

      <div id="particles-js"></div>
      <script src="<?php echo get_template_directory_uri(); ?>/js/se-particles.js"></script>
    </body>
    <?php wp_footer() ?>

    <div class="se-footer-container se-sc-bg se-wc-txt">
      <div class="se-footer-copyright">
        &#9400; Swiss Innovation Forum | 2018
      </div>

      <div class="se-footer-nav">
        Impressum | AGB | <span class="se-mc-txt">zur Anmeldung</span>
      </div>

      <div class="se-footer-sm" style="color:#757575;">
        Follow us |
        <?php
        $SMicon = new SocialMedia();
        $MainSocial = array(
          'twitter' => esc_attr( get_option( 'twitter_link' ) ),
          'in' => esc_attr( get_option( 'linkedin_link' ) ),
          'fb' => esc_attr( get_option( 'facebook_link' ) ),
          'yt' => esc_attr( get_option( 'youtube_link' ) ),
          'insta' => esc_attr( get_option( 'insta_link' ) )
        );
        if($MainSocial){
          foreach ($MainSocial as $SMName => $SMLink) {
            if($SMLink) {
              $icon = $SMicon->getSMicon($SMName, '#fff', '16px');
              echo '<a href="'.$SMLink.'" class="" target="_blank" style="padding:1px 5px; float:right; ">';
              echo '<div class="se-sm-icon-anim">'.$icon;
              echo '</div></a>';
            }
          }
        }
        ?>
      </div>
    </div>

</html>
