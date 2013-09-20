<?php get_header(); ?>
<div id="site-content" class="container" role="main">
    <div class="row-fluid page">
	    
	    <?php		
			$page = get_page( $page_data['error_page'] );
		 		
			echo do_shortcode(str_replace("&nbsp;", "<p><br /></p>", $page->post_content));
	    ?>
	    
    </div>
</div>
<?php get_footer(); ?>