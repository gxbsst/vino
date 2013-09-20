<?php 
	header("Content-type: text/css; charset: UTF-8"); 
	require_once('../../../../wp-load.php');
?>
<style>

	/* Main text font size */

	h1 {
		font-size: <?php echo get_option('heading1', '30'); ?>px;
	}

	h2 {
		font-size: <?php echo get_option('heading2', '24'); ?>px;
	}

	h3, .statement-box h2 {
		font-size: <?php echo get_option('heading3', '20'); ?>px;
	}

	h4 {
		font-size: <?php echo get_option('heading4', '14'); ?>px;
	}

	h5 {
		font-size: <?php echo get_option('heading5', '12'); ?>px;
	}

</style>