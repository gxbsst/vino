<?php 

add_theme_support('menus');

  // add_theme_support( 'infinite-scroll', array(
  //       'type'       => 'click',
  //       'footer_widgets' => true,
  //       'container'  => 'section-content',
  //       'footer'     => 'site-footer',
  //   ) );

if(!is_admin()) {
    include_once get_template_directory().'/anps-framework/classes/Options.php'; 
    include_once get_template_directory().'/anps-framework/classes/Contact.php'; 
    $page_data = $options->get_page_setup_data();
    $options_data = $options->get_page_data(); 
    $media_data = $options->get_media(); 
    $social_data = $options->get_social(); 
    $contact_data = $contact->get_data();
    $shop_data = $options->get_shop_setup_data();
}

/* Include helper.php */
include_once get_template_directory().'/anps-framework/helpers.php';

if (!isset($content_width))
    $content_width = 967;

add_filter('widget_text', 'do_shortcode');

/* Widgets */
include_once 'anps-framework/widgets/widgets.php';

/* Shortcodes */
include_once 'anps-framework/shortcodes.php';
if (is_admin()) {
    include_once 'shortcodes/shortcodes_init.php';
}

/* On setup theme */
add_action('after_setup_theme', 'register_custom_fonts');
function register_custom_fonts() {
    $fonts_installed = get_option('fonts_intalled');
    
    if($fonts_installed==1)
        return;
    
    /* Get custom font */
    include_once get_template_directory().'/anps-framework/classes/Style.php';
    $fonts = $style->get_custom_fonts();

    /* Update custom font */
    foreach($fonts as $name=>$value) { 
        $arr_save[] = array('value'=>$value, 'name'=>$name);
    }
    update_option('anps_custom_fonts', $arr_save);
    update_option('fonts_intalled', 1);
}
/* On switch theme */
/*add_action('switch_theme', 'on_switch_theme_function');
function on_switch_theme_function() {
}*/

/* Portfolio */
include_once 'anps-framework/portfolio.php';
add_action('init', 'portfolio');
function portfolio() {
    new Portfolio();
}

/* Portfolio metaboxes */
include_once 'anps-framework/metaboxes.php';

/* Testimonials */
include_once 'anps-framework/testimonial.php';
add_action('init', 'testimonial');
function testimonial() {
    new Testimonial();
}
 
//install paralax slider
include_once 'anps-framework/install_plugins.php';

add_editor_style('css/editor-style.php');

/* Admin bar theme options menu */
include_once 'anps-framework/classes/adminBar.php';

/* PHP header() NO ERRORS */
if (is_admin())
    add_action('init', 'do_output_buffer');

function do_output_buffer() {
        ob_start();
}

remove_action( 'admin_notices', 'woothemes_updater_notice' );

/* Infinite scroll 08.07.2013 */

function azul_infinite_scroll_init() {

    add_theme_support( 'infinite-scroll', array(
        'type'       => 'click',
        'footer_widgets' => true,
        'container'  => 'section-content',
        'footer'     => 'site-footer',
    ) );

}

add_action( 'init', 'azul_infinite_scroll_init' );

/* WooCommerce */

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    include_once 'anps-framework/woocommerce/functions.php';
}