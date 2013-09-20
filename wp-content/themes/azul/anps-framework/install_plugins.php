<?php

require_once  get_template_directory() . '/anps-framework/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'azul_register_required_plugins');

function azul_register_required_plugins() {

    $plugins = array(
        array(
            'name' => 'WooSlider', 
            'slug' => 'wooslider', 
            'source' => 'http://astudio.si/preview/plugins/wooslider.zip', 
            'required' => false,
            'version' => '',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '',
        ),
        array(
            'name' => 'revslider', 
            'slug' => 'revslider', 
            'source' => 'http://astudio.si/preview/plugins/revslider.zip', 
            'required' => false,
            'version' => '',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '',
        ),
        array(
            'name' => 'envato-wordpress-toolkit-master', 
            'slug' => 'envato-wordpress-toolkit-master', 
            'source' => 'http://astudio.si/preview/plugins/envato-wordpress-toolkit-master.zip', 
            'required' => false,
            'version' => '',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '',
        ),
        array(
            'name' => 'woocommerce', 
            'slug' => 'woocommerce', 
            'source' => 'http://astudio.si/preview/plugins/woocommerce.zip', 
            'required' => true,
            'version' => '',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '',
        ),
        array(
            'name' => 'yith-woocommerce-compare', 
            'slug' => 'yith-woocommerce-compare', 
            'source' => 'http://astudio.si/preview/plugins/yith-woocommerce-compare.zip', 
            'required' => false,
            'version' => '',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '',
        ),
        array(
            'name' => 'yith-woocommerce-wishlist', 
            'slug' => 'yith-woocommerce-wishlist', 
            'source' => 'http://astudio.si/preview/plugins/yith-woocommerce-wishlist.zip', 
            'required' => false,
            'version' => '',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '',
        )
    );

    $config = array(
        'domain' => "azul", 
        'default_path' => '', 
        'parent_menu_slug' => 'themes.php', 
        'parent_url_slug' => 'themes.php', 
        'menu' => 'install-required-plugins', 
        'has_notices' => true, 
        'is_automatic' => true,
        'message' => '', 
        'strings' => array(
            'page_title' => __('Install Required Plugins', "azul"),
            'menu_title' => __('Install Plugins', "azul"),
            'installing' => __('Installing Plugin: %s', "azul"), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', "azul"),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
            'return' => __('Return to Required Plugins Installer', "azul"),
            'plugin_activated' => __('Plugin activated successfully.', "azul"),
            'complete' => __('All plugins installed and activated successfully. %s', "azul"), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa($plugins, $config);
}