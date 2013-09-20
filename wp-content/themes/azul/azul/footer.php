</div>
    <footer id="site-footer">
        <div id="footer-inner-wrapper">

            <div class="container">

                <?php get_sidebar( 'footer' ); ?>

            </div>

        </div>
        
    </footer>

    <!-- START Copyright footer -->
    <?php
    global $options_data;
    if ($options_data['copyright_on'] == 'on')
        get_template_part("includes/copyright_footer");
    ?>
    <!-- END Copyright footer -->
    
</div>
    <?php global $page_data; ?>
    <?php wp_enqueue_script( "google_maps_api", "http://maps.google.com/maps/api/js?sensor=false"); ?>
    <?php if ( ! is_404() && ! is_search() && $page_data['portfolio_page'] == get_the_ID()): ?>
        <?php wp_enqueue_script( "isotope_theme_files", get_template_directory_uri()  . "/js/isotope_theme_files.js" ); ?>
    <?php endif; ?>
    <?php wp_enqueue_script( "functions", get_template_directory_uri()  . "/js/functions.js", '', '', true ); ?>
    <?php wp_enqueue_script( "tweet", get_template_directory_uri()  . "/js/jquery.tweet.js", '', '', true ); ?>
    <?php wp_enqueue_script( "easing2", get_template_directory_uri()  . "/js/easing.js", '', '', true ); ?>
    <?php wp_enqueue_script( "cookie", get_template_directory_uri()  . "/js/jquery.cookie.js", '', '', true ); ?>
    <?php wp_enqueue_script( "active_scripts", get_template_directory_uri()  . "/js/active_scripts.js", '', '', true ); ?>
    <?php if( ! is_404() && ! is_search() ): ?>
        <?php echo '<input id="site_url" type="text" class="none" value="' . get_site_url() . '">'; ?>
    <?php endif; ?>
    
    <?php echo '<input id="twitter_site_url" type="text" style="display: none" value="' . get_template_directory_uri() . '">'; ?>

    <!-- Site Notice -->

    <?php
        global $shop_data;
    ?>

    <?php if(!isset($_COOKIE["azul-notification-closed"]) || $shop_data["notification_changes"] != $_COOKIE["azul-notification-closed"]): ?>

        <?php if( isset($shop_data["notice-active"]) && $shop_data["notice-active"] == "on" ): ?>

            <div id="notice-lightbox" class="site-notice" style="display: none">

                <?php echo do_shortcode($shop_data["notice"]); ?>

            </div>

        <?php endif; ?>
    
    <?php endif; ?>

    <input id="notification_changes" type="hidden" value="<?php echo $shop_data["notification_changes"]; ?>" />
    <input id="site-path" type="hidden" value="<?php echo get_template_directory_uri(); ?>" />

<?php wp_footer(); ?>
</body>
</html>