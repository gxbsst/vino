<?php 

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

    /* MegaMenu */

    class description_walker extends Walker_Nav_Menu
    {
        function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {

            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="'. esc_attr( $class_names ) . '"';

            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

            $description = do_shortcode($description);

            $append = "";
            $prepend = "";

            if($depth == 0)
            {
                $description = $append = $prepend = "";
            }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= '</a>';
            $item_output .= $description.$args->link_after;
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth = 0, $args, $args, $current_object_id = 0 );
            
        }
    }