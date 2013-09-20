<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ob_start(); ?>

	<?php echo '[accordion opened="false"]'; ?>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<?php echo '[accordion_item title="' . apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) . '"]'; ?>
				<?php echo call_user_func( $tab['callback'], $key, $tab ) ?>
			<?php echo '[/accordion_item]'; ?>

		<?php endforeach; ?>

	<?php echo '[/accordion]'; ?>

<?php echo do_shortcode(ob_get_clean()); endif; ?>