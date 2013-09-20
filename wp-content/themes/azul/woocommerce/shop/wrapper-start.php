<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$meta = get_post_meta(get_option('woocommerce_shop_page_id'));

$num_of_sidebars = 0;
$left_sidebar = 0;
if (isset($meta['sbg_selected_sidebar']) && !is_product()) {
    $left_sidebar = $meta['sbg_selected_sidebar'];
    if($left_sidebar[0] != "0") {
        $num_of_sidebars++;   
    }
}

$right_sidebar = 0;
if (isset($meta['sbg_selected_sidebar_replacement']) && !is_product()) {
    $right_sidebar = $meta['sbg_selected_sidebar_replacement'];
    if($right_sidebar[0] != "0") {
        $num_of_sidebars++;   
    }
}

?>

<div id="site-content" class="container" role="main">

	<?php do_action( 'woocommerce_archive_description' ); ?>


<div class="row-fluid page">

<?php if ($left_sidebar[0] != "0"): ?>
        <aside class="sidebar span<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?> clearfix">
            <ul>
                <?php dynamic_sidebar($left_sidebar[0]); ?>
            </ul>
        </aside>   
<?php endif; ?>

<?php

$template = get_option('template');

switch( $template ) {
	case 'twentyeleven' :
		echo '<div id="primary"><div id="content" role="main">';
		break;
	case 'twentytwelve' :
		echo '<div id="primary" class="site-content"><div id="content" role="main">';
		break;
	case 'twentythirteen' :
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	default : ?>
		<section id="section-content" class="clearfix <?php if($num_of_sidebars == 1) { echo "span9"; } else if($num_of_sidebars == 2) { echo "span6"; } ?>">
		<?php 
		break;
}
?>