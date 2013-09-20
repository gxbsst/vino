<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="images">

	<?php
		$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
		$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
		$attachment_count   = count( $product->get_gallery_attachment_ids() );
	?>

	<div id="singleProductGallery" class="carousel slide">

	  <ol class="carousel-indicators">
	    <li data-target="#singleProductGallery" data-slide-to="0" class="active"></li>
	    <?php for($i=1;$i<=$attachment_count;$i++): ?>
	    	<li data-target="#singleProductGallery" data-slide-to="<?php echo $i; ?>"></li>
	    <?php endfor; ?>
	  </ol>

	  <!-- Carousel items -->

	  <div class="carousel-inner">
	    <div class="active item"><a title="<?php echo $image_title; ?>" rel="prettyPhoto[product-gallery]" href="<?php echo $image_link; ?>"><?php echo $image; ?></a></div>
	    <?php do_action( 'woocommerce_product_thumbnails' ); ?>
	  </div>

	  <!-- Carousel nav -->
	  <a class="carousel-control left" href="#singleProductGallery" data-slide="prev">&lsaquo;</a>
	  <a class="carousel-control right" href="#singleProductGallery" data-slide="next">&rsaquo;</a>
	</div>

</div>

<?php do_action('woocommerce_share'); // Sharing plugins can hook into here ?>

<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo $product->get_sku(); ?></span>.</span>
	<?php endif; ?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $size, 'woocommerce' ) . ' ', '.</span>' );
	?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'woocommerce' ) . ' ', '.</span>' );
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>

<div class="product-share clearfix">
	<span><?php _e("Share", "azul"); ?></span>
	<ul>
	    <li><a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php echo nl2br(strip_tags(get_the_content())); ?>" class="product-share-email"></a></li>
	    <li><a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink( $post->ID ); ?>" target="_blank" class="product-share-facebook"></a></li>
	    <li><a href="https://twitter.com/share?url=<?php echo get_permalink( $post->ID ); ?>" target="_blank" class="product-share-twitter"></a></li>   
	    <li><a href="//pinterest.com/pin/create/button/?url=<?php echo get_permalink( $post->ID ); ?>&amp;media=<?php echo $image_link; ?>&amp;description=<?php the_title(); ?>" target="_blank" class="product-share-pinterest"></a></li>
	</ul>  
</div>