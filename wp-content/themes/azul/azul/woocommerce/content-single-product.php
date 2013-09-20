<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<?php 
	$shop_id = get_option('woocommerce_shop_page_id');
	$page = get_post($shop_id);
	echo do_shortcode($page->post_content);

	/* Sidebars */

	$meta = get_post_meta(get_the_ID());

	$num_of_sidebars = 0;
	$left_sidebar = 0;
	if (isset($meta['sbg_selected_sidebar'])) {
	    $left_sidebar = $meta['sbg_selected_sidebar'];
	    if($left_sidebar[0] != "0") {
	        $num_of_sidebars++;   
	    }
	}

	$right_sidebar = 0;
	if (isset($meta['sbg_selected_sidebar_replacement'])) {
	    $right_sidebar = $meta['sbg_selected_sidebar_replacement'];
	    if($right_sidebar[0] != "0") {
	        $num_of_sidebars++;   
	    }
	}

	$is_sidebar = "";

	if( $num_of_sidebars > 0 ) {
		$is_sidebar = 'class="blog-one-sidebar span9"';
	}

?>

<div class="row-fluid">

		<?php if ($left_sidebar[0] != "0"): ?>
		        <aside class="sidebar span<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?> clearfix">
		            <ul>
		                <?php dynamic_sidebar($left_sidebar[0]); ?>
		            </ul>
		        </aside>   
		<?php endif; ?>

<section <?php echo $is_sidebar; ?>>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(""); ?>>

	<div class="row-fluid">

		<div class="span5">

			<?php
				/**
				 * woocommerce_show_product_images hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>

		</div>

		<div class="summary entry-summary span7">

			<?php
				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>

		</div><!-- .summary -->
	
	</div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>


</section>
<?php if (isset($right_sidebar[0]) && $right_sidebar[0] != "0" && $num_of_sidebars!=2): ?>
    <aside class="sidebar span<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?> clearfix">
        <ul>
            <?php dynamic_sidebar($right_sidebar[0]); ?>
        </ul>
    </aside>   
<?php endif; ?>

</div>