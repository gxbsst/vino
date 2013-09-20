<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $shop_data;

$text = __( 'Sale!', 'woocommerce' );

preg_match_all('!\d+!', strip_tags($product->get_price_html()), $prices);

$sale = 0;

if( isset($prices[0][1]) ) {
	$sale = intval($prices[0][1]);
}

$regular = intval($prices[0][0]);
?>
<?php if ($product->is_on_sale()) : ?>

	<?php if( $shop_data['sale_type'] == "on"):
		$text = "-" . round(100-($sale / $regular)*100, 0) . "%";
	endif; ?>

	<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'. $text .'</span>', $post, $product); ?>

<?php endif; ?>