<?php

	global $shop_data;

	/* Disable woocommerce default css */

	define("WOOCOMMERCE_USE_CSS", false );

	/* Support for WooCommerce */

	add_theme_support("woocommerce");

	/* Change number or products per row */

	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 3;
		}
	}

	/* Remove the Short description content area */

	function remove_short_description() {
		remove_meta_box( 'postexcerpt', 'product', 'normal');
	}

	add_action('add_meta_boxes', 'remove_short_description', 999);

	add_filter('loop_shop_columns', 'loop_columns', 999);

	/* Change the number of Related Products */

	function woocommerce_output_related_products() {
		woocommerce_related_products(4,4);
	}

	/* Change number of Upsell Products */

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );
	 
	if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
		function woocommerce_output_upsells() {
		    woocommerce_upsell_display( 4,4 );
		}
	}

	/* WPML */

	function icl_post_languages() {
	  $languages = icl_get_languages('skip_missing=1');
	  if(1 < count($languages)){
	    echo __('This post is also available in:', "azul");
	    foreach($languages as $l){
	      if(!$l['active']) $langs[] = '<a href="'.$l['url'].'">'.$l['translated_name'].'</a>';
	    }
	    echo join(', ', $langs);
	  }
	}

	/* Login, Register / My Account */

	function woo_user() {
		echo '<div class="woo-user">';
		if ( is_user_logged_in() ): ?>
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My account','azul'); ?>">
                <?php _e("My account", "azul"); ?>
            </a>
		<?php else: ?>
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','azul'); ?>">
                <?php _e("Login / Register", "azul"); ?>
            </a>
        <?php endif;
        echo '</div>';
	}

	/* Mini cart */

    add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

    function woocommerce_header_add_to_cart_fragment($fragments) { 
	    global $woocommerce;
	    ob_start();
	    ?>
	    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'azul'); ?>"><?php echo woocommerce_price($woocommerce->cart->subtotal); ?></a>
	    <?php //$woocommerce->mfunc_wrapper( 'woocommerce_mini_cart()', 'woocommerce_mini_cart', '');
	    woocommerce_mini_cart();
	    $fragments['a.cart-contents'] = ob_get_clean();
	    return $fragments;
    }

	function woo_mini_cart() {
		global $woocommerce;
        echo '<div class="woo-cart">';
        $cart = woocommerce_header_add_to_cart_fragment(""); 
        echo $cart ["a.cart-contents"];
        echo '</div>';
	}

    add_action('woo_nav_after', 'wootique_cart_button', 10);
    
    function wootique_cart_button() { 
    	global $woocommerce;
        echo current(woocommerce_header_add_to_cart_fragment());
    }

    /* Register Widget Area for Filter */

    register_sidebar(array(
        'name' => __('Filter', 'azul'),
        'id' => 'filter-widget-area',
        'description' => __('Filter widget area', 'azul'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 style="display: none" class="widget-title">',
        'after_title' => '</h3>',
    ));

    /* Products Per Page */

    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $shop_data['shop_per_page'] . ';' ), 20 );

    /* Remove Breadcrumbs */

	remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

	/* Load PrettyPhoto on Non-WooCommerce Pages */

    add_action( 'wp_enqueue_scripts', 'lightbox' );
        function lightbox() {
        global $woocommerce;
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        {
        wp_enqueue_script( 'prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
        wp_enqueue_script( 'prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
        wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );
        }
    }

    /* Order Status Bar */

    function order_status( $status ) {
    	global $woocommerce;
		$myaccount_url = get_permalink(get_option( 'woocommerce_myaccount_page_id' ));
		$cart_url = $woocommerce->cart->get_cart_url();
		$checkout_url = $woocommerce->cart->get_checkout_url();
		$payment_page = get_permalink( woocommerce_get_page_id( 'pay' ) );

		?>
			<ul class="order-status">
				<li class="first"><a <?php if( $status == "myaccout" ) { echo 'class="current"'; } ?> href="<?php echo $myaccount_url; ?>"><?php echo _e("Sign in", "azul"); ?></a></li>
				<li><a <?php if( $status == "cart" ) { echo 'class="current"'; } ?> href="<?php echo $cart_url; ?>"><?php echo _e("Cart", "azul"); ?></a></li>
				<li><a <?php if( $status == "checkout" ) { echo 'class="current"'; } ?> href="<?php echo $checkout_url; ?>"><?php echo _e("Checkout", "azul"); ?></a></li>
				<li class="last"><a <?php if( $status == "thankyou" ) { echo 'class="current"'; } ?> href="<?php echo $payment_page; ?>"><?php echo _e("Order Complete", "azul"); ?></a></li>
			</ul>
		<?php
    }

    /* My Account Sidebar */

    function myaccount_sidebar($page) { ?>

			<div class="span3 sidebar">

				<h3><?php _e("My Account", "azul"); ?></h3>

				<ul class="myaccount-menu">
					<li class="widget-container widget_nav_menu">
						<div class="menu-main-menu-container">
							<ul class="menu">
								<li class="menu-item<?php if($page == "myaccount"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>"><?php _e("My Orders", "azul"); ?></a></li>
								<li class="menu-item<?php if($page == "wishlist"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ); ?>"><?php _e("My Wishlist", "azul"); ?></a></li>
								<li class="menu-item<?php if($page == "address"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo add_query_arg("subpage", "address", get_permalink( get_option( 'woocommerce_myaccount_page_id' ))); ?>"><?php _e("Address Book", "azul"); ?></a></li>
								<li class="menu-item<?php if($page == "change_password"){ echo " current-menu-item page_item current_page_item current_page_parent"; } ?>"><a href="<?php echo get_permalink( woocommerce_get_page_id( 'change_password' )); ?>"><?php _e("Change Password", "azul"); ?></a></li>
							</ul>
						</div>				
					</li>
				</ul>

			</div>
		<?php
    }

    /* MegaMenu */

	class description_walker extends Walker_Nav_Menu
	{
	    function start_el(&$output, $item, $depth, $args) {

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

	        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	        
	    }
	}

	/* Check if WishList and Copare plugins are active */

	function check_yith_woocommerce_wishlist() {
		if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): ?>
			<div class="anps-wishlist">
				<?php echo do_shortcode("[yith_wcwl_add_to_wishlist]"); ?> <span><?php _e("Wishlist", "azul"); ?></span>
			</div>
		<?php endif; 
	}

	function check_yith_woocommerce_compare() {
		if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): ?>
			<div class="anps-compare">
				<?php echo do_shortcode("[yith_compare_button]"); ?> <span><?php _e("Compare", "azul"); ?></span>
			</div>
		<?php endif; 
	}

?>