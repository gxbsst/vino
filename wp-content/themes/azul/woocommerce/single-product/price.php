<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="single-product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p>

	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

	<?php if( get_comments_number( $post->ID ) ): ?>
		<p class="reviews">
			<?php echo get_comments_number( $post->ID ) . " " . ( get_comments_number( $post->ID ) > 1 ? __("Reviews", "woocommerce") : __("Review", "woocommerce") ); ?>
		</p>
	<?php endif; ?>

	<?php woocommerce_template_loop_rating(); ?>
</div>