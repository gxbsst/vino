<?php dynamic_sidebar($right_sidebar[0]); ?>
	
	<?php dynamic_sidebar('right_sidebar'); ?>
	
	<?php 
	$args = array(
	    'category_name' => 'share',
	    'posts_per_page' => 5,
	    'orderby' => 'rand'
	    );
	$the_query = new WP_Query($args);
	?>
	<h2> 资料分享 </h2>
	<?php if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
	<div class="span-data">
	<a target="_blank" href="<?php echo the_permalink(); ?>" class="icons-shortcode">
	    <span class="icons-shortcode-left">
	        <img alt="icon-image" class="icons-shortcode-img" src="http://astudio.si/preview/juicy/wp-content/uploads/2013/04/briefcase.png">
	    </span>
	    <div class="icons-shortcode-right">
	        <h3><?php echo get_the_title(); ?></h3>
	    </div>
	</a>
	</div>
	<div class="clear"></div>
	<?php
	  endwhile; else: 
	?>
		NO.....
	<?php endif; ?>

