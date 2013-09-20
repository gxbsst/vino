<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

global $shop_data;

if( is_shop() || is_product_category() || is_product_tag() ) {

	switch( $shop_data['shop_pagination'] ) {
		case '2 column': $woocommerce_loop['columns'] = 2; break;
		case '3 column': $woocommerce_loop['columns'] = 3; break;
		case '4 column': $woocommerce_loop['columns'] = 4; break;
	}
 
}

switch( $woocommerce_loop['columns'] ) {
	case 2: $classes[] = "span6"; break;
	case 3: $classes[] = "span4"; break;
	case 4: $classes[] = "span3"; break;
}

?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<h3 title="<?php the_title(); ?>"><?php the_title(); ?></h3>

		<span class="price-rating">
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</span>

	</a>

	<div class="product-hover <?php if( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { echo "with-plugs"; } ?>">
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		
		<div class="anps-compare-wish-wrap">
			<?php check_yith_woocommerce_wishlist(); ?>
			<?php check_yith_woocommerce_compare(); ?>
		</div>

	</div>

</li>