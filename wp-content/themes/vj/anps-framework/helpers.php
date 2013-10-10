<?php

function setRTL() {

    global $wp_locale, $wp_styles;

    if( get_option('rtl', '') && get_option('rtl', '') == "on" ) {
        $direction = "rtl";
    } else {
        $direction = "ltr";
    }

    $wp_locale->text_direction = $direction;        
    $wp_styles->text_direction = $direction;
}

add_action('wp_loaded', 'setRTL');

function is_boxed( $out ) {

    global $options_data;   
    $theme_classes = "";
    $theme_style = "";

    if(isset($options_data['boxed']) && $options_data['boxed']=='on') {
        $theme_classes .= " boxed";

        if(isset($options_data['pattern']) && $options_data['pattern'] != '' && $options_data['pattern'] != '0') {
            $theme_classes .= " pattern-" . $options_data['pattern'];
        }

        if(isset($options_data['pattern']) && isset($options_data['custom_pattern']) && $options_data['pattern'] == '0' && ($options_data['type'] == "tilled" || $options_data['type'] == "stretched")) {
            $theme_style = ' style="background: url(' . $options_data['custom_pattern'] . ')"';

            if(isset($options_data['type']) && $options_data['type'] == "stretched") {
                $theme_classes .= " pattern-0";
            }
        } elseif(isset($options_data['pattern']) && isset($options_data['custom_pattern']) && $options_data['pattern'] == '0' && ($options_data['type'] == "custom color")) {
            $theme_style = ' style="background: ' . $options_data['bg_color'] . '"';
        }
    }

    if( $out == "style" ) {
        return $theme_style;
    } else {
        return $theme_classes;
    }
}

function is_responsive()  {
    global $options_data;   
    $responsive = "";
    if (isset($options_data['responsive'])) $responsive = $options_data['responsive'];

    if ( $responsive == "on" ): ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php endif;
    
}

function theme_after_styles() {

    wp_enqueue_script( "modernizr", get_template_directory_uri()  . "/js/modernizr.js" );

    if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
    
    get_template_part("includes/google_analytics");
    get_template_part("includes/shortcut_icon");
    wp_enqueue_style("custom_styles", get_template_directory_uri()  . "/includes/custom-styles.php");
    ?>

    <!--[if IE 8]>
        <?php echo "<link href='" . ( get_template_directory_uri() . '/css/iefix.css' ) . "' rel='stylesheet' type='text/css' >"; ?>
    <![endif]--> 

    <?php  
}

/* Return site logo */
function get_logo() { 
    global $media_data;
    if (isset($media_data['logo']) && $media_data['logo'] != "") : ?>
        <a id="logo" href="<?php echo esc_url(home_url("/")); ?>"><img alt="Site logo"  src="<?php echo $media_data['logo']; ?>"></a>
    <?php else: ?>
        <a id="logo" href="<?php echo esc_url(home_url("/")); ?>">
            <img width="150px" src="<?php echo (get_template_directory_uri() . '/images/logo.png'); ?>" alt="">
        </a>        
    <?php endif;
}


function theme_styles() {	   
    global $options_data;
    
    if ( get_option('font_source_1') && get_option('font_source_1')=='Google fonts') {
        wp_enqueue_style( "font_type_1",  'http://fonts.googleapis.com/css?family=' . urlencode(get_option('font_type_1', 'Open Sans')) . ':400italic,400,600,700,300&subset=latin,latin-ext');
    }
        
    if ( get_option('font_source_2') && get_option('font_source_2')=='Google fonts') {
        wp_enqueue_style( "font_type_2",  'http://fonts.googleapis.com/css?family=' . urlencode(get_option('font_type_2', 'Open Sans')) . ':400italic,400,600,700,300&subset=latin,latin-ext');
    }

    wp_enqueue_style( "theme_custom_style", get_stylesheet_directory_uri() . "/includes/custom-styles.php" );
    wp_enqueue_style( "theme_main_style", get_bloginfo( 'stylesheet_url' ) );
    wp_enqueue_style( "custom", get_template_directory_uri() . '/custom.css' );
    wp_enqueue_style( "lightbox", get_template_directory_uri() . '/css/lightbox.css' );

    /* Add Theme WooCommerce StyleSheet */
    wp_enqueue_style( "azul_woo_style", get_template_directory_uri() . '/anps-framework/woocommerce/style.css' );

    $responsive = "";
    if (isset($options_data['responsive'])) $responsive = $options_data['responsive'];

    if (($responsive == "on" && !isset($_COOKIE['responsive_on_demand'])) || ($responsive == "on" && $_COOKIE['responsive_on_demand'] != 'on' )) {

    }

    wp_register_style('bra_photostream', get_stylesheet_directory_uri() . "/anps-framework/photostream/bra_photostream_widget.css");
    wp_enqueue_style('bra_photostream');
}

/* Breadcrumbs */ 
function the_breadcrumb() {

    global $page_data;
    $return_val = "";

    if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_woocommerce() ) {
        ob_start();
        woocommerce_breadcrumb();
        $return_val = ob_get_contents();
        ob_get_clean();
    } else {

        $divider = '<span class="breadcrumbs-divider">/</span>';

        $return_val .= '<a href="' . home_url() .'">' . __("Home", "azul") . '</a>' . $divider;

        if (get_post_type() == "portfolio") {
            $parent = get_page($page_data['portfolio_page']);
            if ($parent) {
                $return_val .= '<a href="' . get_permalink($parent->ID) . '">' . $parent->post_title . '</a>';
            }
        }
        if (is_home() && !is_front_page()) {
            $return_val .= get_the_title(get_option('page_for_posts'));
        } else {
            if (is_category() || is_single()) {
                //the_category('title_li=');
                if (is_single()) {
                    if (get_post_type() != "portfolio") {
                        $return_val .= '<a href="' . get_permalink(get_option('page_for_posts')) . '">' . get_the_title(get_option('page_for_posts')) . '</a>';
                    }
                    $return_val .= $divider;
                    $return_val .= get_the_title();
                }
            } elseif (is_page()) {
                $return_val .= get_the_title();
            } elseif (is_archive()) {
                if (single_tag_title('', false) != "") {
                    
                } else {
                    $return_val .= "Archives for " . get_the_date('F') . ' ' . get_the_date('Y');
                }
            } else {
                if (get_search_query() != "") {
                    //printf(__('Search Results for: %s', 'azul'), '' . get_search_query() . '');
                } else {
                    $page = get_page($page_data['error_page']);
                    $return_val .= $page->post_title;
                }
            }
        }
        if (single_cat_title("", false) != "") {
            $return_val .= single_cat_title("", false);
        }

    }

    return $return_val;

}

/* Tags and author */
function tagsAndAuthor() {
    ?>

        <div class="tags-author">
        作者: <?php echo get_the_author(); ?>

    <?php
    $posttags = get_the_tags();
    if ($posttags) {
        echo " &nbsp;|&nbsp; ";
        echo __('Taged as', 'azul') . " - ";
        $first_tag = true;
        foreach ($posttags as $tag) {

            if ( ! $first_tag) {
                echo ', ';
            }

            echo '<a href="' . esc_url(home_url('/')) . 'tag/' . $tag->slug . '/">';
            echo $tag->name;
            echo '</a>';

            $first_tag = false;

        }
    }
    ?>
        </div>
    <?php
}

/* Current page url */
function curPageURL() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"])) $pageURL .= "s";

    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") 
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    else 
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    
    return $pageURL;
}

error_reporting(0);

/* Gravatar */
add_filter('avatar_defaults', 'newgravatar');
function newgravatar($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/images/azul_default_avatar.jpg';
    $avatar_defaults[$myavatar] = "Anps default avatar";
    return $avatar_defaults;
}

/* Get post thumbnail src */
function get_the_post_thumbnail_src($img) {
    return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}   

function get_menu() {

    global $options_data;
    if(isset($options_data['sticky_menu']) && $options_data['sticky_menu'] == "on"): ?>
        <div class="sticky-menu container"></div>
    <?php endif; ?>

    <nav id="site-nav" role="navigation">
        <?php
            $locations = get_theme_mod('nav_menu_locations');
            wp_nav_menu( array(
             'container' => false,
             'menu_class' => 'nav',
             'echo' => true,
             'before' => '',
             'after' => '',
             'link_before' => '',
             'link_after' => '',
             'depth' => 0,
             // 'walker' => new description_walker(),
             'menu'=>$locations['primary']
             ));
        ?>
    </nav>

    <?php

    get_mobile_menu();
}

/* On responsive show mobile menu */
function get_mobile_menu() {
    $locations = get_theme_mod('nav_menu_locations');
    $menu_items = wp_get_nav_menu_items($locations['primary']);
    ?>
    <select class="mobile-menu">
        <option value="Navigation">Navigation</option>
        <?php $previuos_id = 0;
        $previuos_valid = true;
        foreach ($menu_items as $item) :
            echo "<option value='" . $item->url . "'>";
            if ($item->menu_item_parent != 0) {
                if ($previuos_id == $item->menu_item_parent) {
                    if ($previuos_valid) {
                        echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - ";
                        $previuos_id = $item->menu_item_parent;
                    } else {
                        echo " &nbsp;&nbsp; - ";
                        $previuos_id = $item->ID;
                    }
                } else {
                    echo " &nbsp;&nbsp;  - ";
                    $previuos_id = $item->ID;
                }
            }
            if ($item->menu_item_parent != 0) {
                $previuos_valid = true;
            } else {
                $previuos_valid = false;
            }
            echo $item->title;
            echo "</option>";
        endforeach; ?>
    </select><?php
}

function get_logo_and_search() { ?>
    <div id="logo-and-search">
    
        <?php

            if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

                    if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

                    global $wpdb, $yith_wcwl, $woocommerce;
                    $wishlist = "";
                    if( isset( $_GET['user_id'] ) && !empty( $_GET['user_id'] ) ) {
                        $user_id = $_GET['user_id'];
                    } elseif( is_user_logged_in() ) {
                        $user_id = get_current_user_id();
                    }

                    if( is_user_logged_in() )
                    { $wishlist = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s" . $limit_sql, $user_id ), ARRAY_A ); }

                    /* WishList */
                    echo '<a class="header-wishlist" href="' . get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) . '">' . count($wishlist) . '</a>';

                }

                global $shop_data;


                if( ! isset($shop_data["hide_cart"]) && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
                    woo_mini_cart();
                } elseif( isset($shop_data["hide_cart"]) && $shop_data["hide_cart"] != "on" && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                    woo_mini_cart();
                }

            }
        ?>

        <form role="search" method="get" id="searchform-header" action="<?php echo home_url( '/' ); ?>">
            <input type="text" placeholder="<?php _e("Search", "azul"); ?>" value="" name="s" id="s-top" />
            <input type="submit" value="">
        </form>

        <?php

            /* Login, register / My account links */
            // woo_user();

            // if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            //     /* WPML Language Selector */
            //     if (function_exists('icl_get_languages')) {
              
            //         echo '<div class="language-switcher">';

            //         $languages = icl_get_languages('skip_missing=1');
            //         if(1 < count($languages)){
            //         echo '<span>' . __('Language ', 'azul') . '</span>';

            //         echo '<div class="language-switcher-lans">';

            //             foreach($languages as $l){
            //               if(!$l['active']) $langs[] = '<a href="'.$l['url'].'">'.$l['translated_name'].'</a>';
            //             }
            //             echo join('', $langs);
            //             }

            //         echo '</div>';
            //         echo '</div>';

            //     }
            // }

        ?>

        <?php get_logo(); ?>
        
    </div>  
<?php }

/* Set wide or boxed view */
function body_class_and_style($class_or_style) {
    global $options_data;

    $body_class = "";
    $body_set_class = "";
    $body_style = "";

    if ($options_data['boxed'] == 'on') {
        $body_class = "boxed";
        $body_set_class .= "body-boxed";
        if ($options_data['pattern']) {
            $body_set_class .= " patern-" . $options_data['pattern'];
        } else {
            if ($options_data['type'] == "stretched") {
                $body_style = ' style="background: url(' . $options_data['custom_pattern'] . ') center center fixed;background-size: cover;     -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"';
            } else {
                $body_style = ' style="background: url(' . $options_data['custom_pattern'] . ')"';
            }
        }
    }

    if ($class_or_style == "style") {
        return $body_style;
    } else {
        return $body_set_class;
    }
}

add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}

/* Post gallery */
add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));
    
    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }
    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $margin_calc = ($columns-1)*2;
    $itemwidth = (100-$margin_calc) / $columns;

    $float = is_rtl() ? 'right' : 'left';
    $margin = 0;
    /*
    switch($columns) {
        case 1: $size = "full"; break;
        case 2: $size = "portfolio-thumbnail-2-column"; $itemwidth = 460; $margin = 20; break;
        case 3: $size = "portfolio-thumbnail-2-column"; $itemwidth = 300; $margin = 20; break;
        case 4: $size = "portfolio-thumbnail-3-column"; $itemwidth = 220; $margin = 20; break;
        case 5: $size = "portfolio-thumbnail-3-column"; $itemwidth = 172; $margin = 20; break;
        case 6: $size = "portfolio-thumbnail-3-column"; $itemwidth = 140; $margin = 20; break;
        case 7: $size = "portfolio-thumbnail-3-column"; $itemwidth = 117; $margin = 20; break;
        case 8: $size = "portfolio-thumbnail-3-column"; $itemwidth = 100; $margin = 20; break;
        case 9: $size = "portfolio-thumbnail-3-column"; $itemwidth = 86; $margin = 20; break;
    }
*/
    $selector = "gallery-{$instance}";
    ?>
        <!--[if IE 8]>
            <?php $size = "portfolio-thumbnail-2-column"; ?>
        <![endif]--> 
    <?php 
    $output = '';
    $output .= "

        <!--[if IE 8]>
            <style scoped>
                .gallery-{$columns}-columns .gallery-item {
                    width: {$itemwidth}%; 
                }
            </script>
        <![endif]-->
        <style scoped>
            .gallery-{$columns}-columns .gallery-item {
                padding: 0;
                line-height: 0;
            }
            .gallery-{$columns}-columns .gallery-item {
                float: {$float};
                margin-top: 5px;
                margin-right: 2%;
                text-align: center;
                width: {$itemwidth}%; 
            }
            .gallery-{$columns}-columns .gallery-item:nth-of-type({$columns}n) {
                margin-right: 0;
            }
                
            .gallery-{$columns}-columns .gallery-item img {
                width: 100%;  
                height: auto;   
            }
            .gallery-{$columns}-columns .gallery-caption {
                margin-left: 0;
            }
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->
        <div id='$selector' class='gallery gallery-{$columns}-columns galleryid-{$id}'>";
 
    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link_big = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image_src($id, 'full', false) : wp_get_attachment_image_src($id, 'full', false);
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image_src($id, 'full', false) : wp_get_attachment_image_src($id, 'full', false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                <a data-rel='lightbox[gal]' title='" . wptexturize($attachment->post_excerpt) . "' href='" . $link_big[0] . "'>
                    <img alt='Gallery image' src='$link[0]' />
                    <div class='gallery-hover'></div>
                </a>
            </{$icontag}>";
        $output .= "<dd></dd></{$itemtag}>";

    }
    $output .= "
            <br style='clear: both;' />
        </div>\n";

    return $output;
}

//get post_type    
function get_current_post_type() {
    if (is_admin()) {
        global $post, $typenow, $current_screen;

        //we have a post so we can just get the post type from that
        if ($post && $post->post_type)
            return $post->post_type;

        //check the global $typenow - set in admin.php
        elseif ($typenow)
            return $typenow;

        //check the global $current_screen object - set in sceen.php
        elseif ($current_screen && $current_screen->post_type)
            return $current_screen->post_type;

        //lastly check the post_type querystring
        elseif (isset($_REQUEST['post_type']))
            return sanitize_key($_REQUEST['post_type']);

        elseif (isset($_REQUEST['post']))
            return get_post_type($_REQUEST['post']);

        //we do not know the post type!
        return null;
    }
}

/* hide sidebar generator on testimonials and portfolio */
if (get_current_post_type() != 'testimonials' && get_current_post_type() != 'portfolio') {
    //add sidebar generator
    include_once 'sidebar_generator.php';
}

/* Admin/backend styles */
add_action('admin_head', 'backend_styles');
function backend_styles() {
    echo '<style type="text/css">
        .mceListBoxMenu {
            height: auto !important;
        }

        .wp_themeSkin .mceListBoxMenu {
            overflow: visible;
            overflow-x: visible;
        }
    </style>';
}

add_action('admin_head', 'show_hidden_customfields');
function show_hidden_customfields() {
    echo "<input type='hidden' value='" . get_template_directory_uri() . "' id='hidden_url'/>";
}

/* Image sizes */
add_theme_support('post-thumbnails');
update_option('thumbnail_size_w', 275);
update_option('thumbnail_size_h', 135);

add_image_size('small-thumbnail', 48, 48, true);
add_image_size('blog-one-sidebar', 695, 322, true);
add_image_size('blog-no-sidebar', 495, 337, true);
add_image_size('blog-two-column', 450, 337, true);

add_image_size('portfolio', 958, 552, true);
add_image_size('portfolio-thumbnail', 117, 117, true);
add_image_size('portfolio-thumbnail-3-column', 300, 220, true);
add_image_size('portfolio-thumbnail-2-column', 460, 320, true);
add_image_size('portfolio-thumbnail-4-column', 220, 164, true);
add_image_size('portfolio-first-responsive', 290, 200, true);

if (!function_exists('anps_admin_header_style')) :
    /*
     * Styles the header image displayed on the Appearance > Header admin panel.
     * Referenced via add_custom_image_header() in azul_setup().
     */
    function anps_admin_header_style() {
        ?>
        <style type="text/css">
            /* Shows the same border as on front end */
            #headimg {
                border-bottom: 1px solid #000;
                border-top: 4px solid #000;
            }
        </style>
        <?php
    }
endif;

/* Filter wp title */
add_filter('wp_title', 'anps_filter_wp_title', 10, 2);
function anps_filter_wp_title($title, $separator) {
    // Don't affect wp_title() calls in feeds.
    if (is_feed())
        return $title;

    // The $paged global variable contains the page number of a listing of posts.
    // The $page global variable contains the page number of a single post that is paged.
    // We'll display whichever one applies, if we're not looking at the first page.
    global $paged, $page;

    if (is_search()) {
        // If we're a search, let's start over:
        $title = sprintf(__('Search results for %s', 'azul'), '"' . get_search_query() . '"');
        // Add a page number if we're on page 2 or more:
        if ($paged >= 2)
            $title .= " $separator " . sprintf(__('Page %s', 'azul'), $paged);
        // Add the site name to the end:
        $title .= " $separator " . get_bloginfo('name', 'display');
        // We're done. Let's send the new title back to wp_title():
        return $title;
    }
    // Otherwise, let's start by adding the site name to the end:
    $title .= get_bloginfo('name', 'display');
    // If we have a site description and we're on the home/front page, add the description:
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title .= " $separator " . $site_description;
    
    // Add a page number if necessary:
    if ($paged >= 2 || $page >= 2)
        $title .= " $separator " . sprintf(__('Page %s', 'azul'), max($paged, $page));

    // Return the new title to wp_title():
    return $title;
}

/* Page menu show home */
add_filter('wp_page_menu_args', 'anps_page_menu_args');
function anps_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}

/* Sets the post excerpt length to 40 characters. */
add_filter('excerpt_length', 'anps_excerpt_length');
function anps_excerpt_length($length) {
    return 40;
}

/* Returns a "Continue Reading" link for excerpts */
function anps_continue_reading_link() {
    return ' <a href="' . get_permalink() . '">' . __('Continue reading <span class="meta-nav">&rarr;</span>', 'azul') . '</a>';
}

/* Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and azul_continue_reading_link(). */
add_filter('excerpt_more', 'anps_auto_excerpt_more');
function anps_auto_excerpt_more($more) {
    return ' &hellip;' . anps_continue_reading_link();
}

/* Adds a pretty "Continue Reading" link to custom post excerpts. */
add_filter('get_the_excerpt', 'anps_custom_excerpt_more');
function anps_custom_excerpt_more($output) {
    if (has_excerpt() && !is_attachment()) {
        $output .= anps_continue_reading_link();
    }
    return $output;
}

/* Remove inline styles printed when the gallery shortcode is used. */
add_filter('gallery_style', 'anps_remove_gallery_css');
function anps_remove_gallery_css($css) {
    return preg_replace("#<style type='text/css'>(.*?)</style>#s", '', $css);
}

/* WIDGET: Remove recent comments sytle */
add_action('widgets_init', 'anps_remove_recent_comments_style');
function anps_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

/* Prints HTML with meta information for the current post—date/time and author. */
if (!function_exists('azul_posted_on')) :    
    function azul_posted_on() {
        printf(__('<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'azul'), 'meta-prep meta-prep-author', sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>', get_permalink(), esc_attr(get_the_time()), get_the_date()
                ), sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', get_author_posts_url(get_the_author_meta('ID')), sprintf(esc_attr__('View all posts by %s', 'azul'), get_the_author()), get_the_author()
                )
        );
    }
endif;

/* Prints HTML with meta information for the current post (category, tags and permalink).*/
if (!function_exists('azul_posted_in')) :   
    function azul_posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list('', ', ');
        if ($tag_list) {
            $posted_in = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'azul');
        } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
            $posted_in = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'azul');
        } else {
            $posted_in = __('Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'azul');
        }
        // Prints the string, replacing the placeholders.
        printf($posted_in, get_the_category_list(', '), $tag_list, get_permalink(), the_title_attribute('echo=0'));
    }
endif;

/* After setup theme */
add_action('after_setup_theme', 'anps_setup');
if (!function_exists('anps_setup')):

    function anps_setup() {

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // This theme uses post thumbnails
        add_theme_support('post-thumbnails');

        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Make theme available for translation
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain('azul', get_template_directory() . '/languages');

        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if (is_readable($locale_file))
            require_once( $locale_file );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Navigation', 'azul'),
        ));

        // This theme allows users to set a custom background
        //add_custom_background();
        // Your changeable header business starts here
        define('HEADER_TEXTCOLOR', '');
        // No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
        define('HEADER_IMAGE', '%s/images/headers/path.jpg');

        // The height and width of your custom header. You can hook into the theme's own filters to change these values.
        // Add a filter to azul_header_image_width and azul_header_image_height to change these values.
        define('HEADER_IMAGE_WIDTH', apply_filters('azul_header_image_width', 190));
        define('HEADER_IMAGE_HEIGHT', apply_filters('azul_header_image_height', 54));

        // We'll be using post thumbnails for custom header images on posts and pages.
        // We want them to be 940 pixels wide by 198 pixels tall.
        // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
        set_post_thumbnail_size(HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true);

        // Don't support text inside the header image.
        define('NO_HEADER_TEXT', true);

        // Add a way for the custom header to be styled in the admin panel that controls
        // custom headers. See azul_admin_header_style(), below.
        //add_custom_image_header( '', 'azul_admin_header_style' );
        // ... and thus ends the changeable header business.
        // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
        register_default_headers(array(
            'berries' => array(
                'url' => '%s/images/headers/logo.png',
                'thumbnail_url' => '%s/images/headers/logo.png',
                /* translators: header image description */
                'description' => __('Azul default logo', 'azul')
            )
        ));

        if (!isset($_GET['stylesheet']))
            $_GET['stylesheet'] = '';

        $theme = wp_get_theme($_GET['stylesheet']);

        if (!isset($_GET['activated']))
            $_GET['activated'] = '';

        if ($_GET['activated'] == 'true' && $theme->get_template() == 'azul132') {
            
            $arr = array(
                    0=>array('label'=>'e-mail', 'input_type'=>'text', 'is_required'=>'on', 'placeholder'=>'email', 'validation'=>'email'),
                    1=>array('label'=>'subject', 'input_type'=>'text', 'is_required'=>'on', 'placeholder'=>'subject', 'validation'=>'none'),
                    2=>array('label'=>'contact number', 'input_type'=>'text', 'is_required'=>'', 'placeholder'=>'contact number', 'validation'=>'phone'),
                    3=>array('label'=>'lorem ipsum', 'input_type'=>'text', 'is_required'=>'', 'placeholder'=>'lorem ipsum', 'validation'=>'none'),
                    4=>array('label'=>'message', 'input_type'=>'textarea', 'is_required'=>'on', 'placeholder'=>'评论内容', 'validation'=>'none'),
                );
            update_option('anps_contact', $arr);
        } 
    }

endif;

/* theme options init */
add_action('admin_init', 'theme_options_init');
function theme_options_init() {
    register_setting('sample_options', 'sample_theme_options');
}

/* If user is admin, he will see theme options */
add_action('admin_menu', 'theme_options_add_page');
function theme_options_add_page() {
    global $current_user; 
    if($current_user->user_level==10) {
        add_theme_page('Theme Options', 'Theme Options', 'read', 'theme_options', 'theme_options_do_page');
    }
}
function theme_options_do_page() {
    include_once "admin_view.php";
}

/* Wp_mail */
function MailFunction(){
    $to = $_POST['form_data']['envoo-admin-mail'];    //your e-mail to which the message will be sent
    $from = $_POST['form_data']['envoo-admin-mail'];        //e-mail address from which the e-mail will be sent

    $subject_contact_us = 'Someone has sent you a message!';   //subject of the e-mail for the form on contact-us.html
    $subject_follow_us = 'I want to follow you';       //subject of the e-mail for the form on follow-us.html

    $message = '';
    $message .= '<table cellpadding="0" cellspacing="0">';
    foreach ($_POST['form_data'] as $postname => $post) {

        if ($postname != 'envoo-admin-mail' && $postname != "recaptcha_challenge_field" && $postname != "recaptcha_response_field") {

            $message .= "<tr><td style='padding: 5px 20px 5px 5px'><strong>" . urldecode($postname) . ":</strong>" . "</td><td style='padding: 5px; color: #444'>" . $post . "</td></tr>";
        }
    }

    $message .= '</table>';

    $headers = 'From: ' . $from . "\r\n" .
            'Reply-To: info@yourdomain.com' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    wp_mail($to, $subject_contact_us, $message, $headers);

}
add_action('wp_ajax_nopriv_MailFunction', 'MailFunction');
add_action( 'wp_ajax_MailFunction', 'MailFunction' ); 

/* Comments */
function anps_comment($comment, $args, $depth) {

    $email = $comment->comment_author_email;
    $user_id = -1;

    if (email_exists($email))
        $user_id = email_exists($email);

    $GLOBALS['comment'] = $comment;
    ?>
                                
    <div class="clearfix">
        <article <?php comment_class("clearfix"); ?> id="comment-<?php comment_ID(); ?>">

            <header>
                <h4><?php comment_author(); ?></h4>
            </header>

            <div class="comment-meta">
                <?php echo  get_comment_date("Y年m月d日");?>
            </div>

            <div class="avatar-wrapper"><?php echo get_avatar($comment, $size = '48'); ?></div>
            
            <div class="comments-content clearfix">
                <?php comment_text() ?>
                <?php echo comment_reply_link(array_merge(array('reply_text' => '回复'), array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div>
        </article>
    </div>
<?php }

/* Remove Excerpt text */

function sbt_auto_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'sbt_auto_excerpt_more', 20 );

function sbt_custom_excerpt_more( $output ) {
    return preg_replace('/<a[^>]+>Continue reading.*?<\/a>/i','',$output);
}
add_filter( 'get_the_excerpt', 'sbt_custom_excerpt_more', 20 );