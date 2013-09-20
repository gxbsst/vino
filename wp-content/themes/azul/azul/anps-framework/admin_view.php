<?php 
/* Include styles and scripts */
if (is_admin()) {
    wp_enqueue_style( "admin-style", get_template_directory_uri() . '/anps-framework/css/admin-style.css' ); 
    if(!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style" || $_GET['sub_page'] == "options")
        wp_enqueue_style( "colorpicker", get_template_directory_uri() . '/anps-framework/css/colorpicker.css' ); 
    wp_enqueue_script( "jquery_google", "//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" );
    if (isset($_GET['sub_page']) && ($_GET['sub_page'] == "options" || $_GET['sub_page'] == "options_page"))
        wp_enqueue_script( "pattern", get_template_directory_uri() . "/anps-framework/js/pattern.js" );
    if(!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style" || $_GET['sub_page'] == "options") { 
        wp_enqueue_script( "colorpicker_theme", get_template_directory_uri() . "/anps-framework/js/colorpicker.js" ); 
        wp_enqueue_script( "colorpicker_custom", get_template_directory_uri() . "/anps-framework/js/colorpicker_custom.js" ); 
    }
    if (isset($_GET['sub_page']) && $_GET['sub_page'] == "contact_form") 
        wp_enqueue_script( "contact", get_template_directory_uri() . "/anps-framework/js/contact.js" ); 
    wp_enqueue_script( "theme-options", get_template_directory_uri() . "/anps-framework/js/theme-options.js" ); 
}
?> 
<div class="envoo-admin">
    <ul class="envoo-admin-menu">
        <li><h2><?php _e("Theme Options", "azul"); ?></h2></li>
        <li>
            <a class="has-submenu" <?php if (!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style" || $_GET['sub_page'] == "theme_style_google_font" || $_GET['sub_page'] == "theme_style_custom_font") echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=theme_style"><?php _e("Style Settings", "azul"); ?></a>
            <ul class="envoo-admin-submenu">
                <li><a <?php if (!isset($_GET['sub_page']) || $_GET['sub_page'] == "theme_style") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style"><?php _e("Theme Style", "azul"); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_google_font") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_google_font"><?php _e("Update google fonts", "azul"); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_custom_font") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_custom_font"><?php _e("Upload custom fonts", "azul"); ?></a></li>
            </ul>
        </li>
        <li>
            <a class="has-submenu" <?php if (isset($_GET['sub_page']) && ( $_GET['sub_page'] == "options" || $_GET['sub_page'] == "options_page_setup" || $_GET['sub_page'] == "options_social_accounts" || $_GET['sub_page'] == "options_media" )) echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=options"><?php _e("General Settings", "azul"); ?></a>
            <ul class="envoo-admin-submenu">
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options"><?php _e("Page layout", "azul"); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_page_setup") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_page_setup"><?php _e("Page setup", "azul"); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_social_accounts") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_social_accounts"><?php _e("Social accounts", "azul"); ?></a></li>
                <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_media") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_media"><?php _e("Media", "azul"); ?></a></li>
            </ul>
        </li>
        <li>
            <a class="has-submenu" <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "shop_settings") echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=shop_settings"><?php _e("Shop Settings", "azul"); ?></a>
        </li>
        <li>
            <a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "contact_form") 
                        echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=contact_form"><?php _e("Contact Form", "azul"); ?></a>
        </li>
        <li>
            <a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "dummy_content") 
                        echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=dummy_content"><?php _e("Dummy Content", "azul"); ?></a>
        </li>
    </ul>
    <div class="envoo-admin-content">
        <?php
        if(!isset($_GET['sub_page']))
            $_GET['sub_page']='';
      
        switch($_GET['sub_page']) {
            case 'options': include_once 'options_page_view.php'; break;
            case 'options_page': include_once 'options_page_view.php'; break;
            case 'options_page_setup': include_once 'options_page_setup_view.php'; break;
            case 'options_social_accounts': include_once 'options_social_accounts_view.php'; break;
            case 'options_media': include_once 'options_media_view.php'; break;
            case 'contact_form': include_once 'contact_view.php'; break;
            case 'dummy_content': include_once 'dummy_view.php'; break;
            case 'theme_style_google_font': include_once 'update_google_font_view.php'; break;
            case 'theme_style_custom_font': include_once 'update_custom_font_view.php'; break;
            case 'shop_settings': include_once 'shop_settings.php'; break;
            default: include_once 'style_view.php';
        }

        ?>
    </div>
</div> 