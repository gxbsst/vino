
<?php dynamic_sidebar($right_sidebar[0]); ?>
	
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-0-1" data-toggle="tab">周排行</a></li>
		<li><a href="#tab-0-2" data-toggle="tab">月排行</a></li>
	</ul>
	<div class="tab-content">
		<div id="tab-0-1" class="tab-pane fade in active">
			<?php if (function_exists('wpp_get_mostpopular')) wpp_get_mostpopular("range=all&order_by=comments&post_type=post,page,video,tasting,bar"); ?>
		</div>
		<div id="tab-0-2" class="tab-pane fade in">
			<?php  if (function_exists('wpp_get_mostpopular')) wpp_get_mostpopular("range=monthly&order_by=comments&post_type=post,page,video,tasting,bar"); ?>
		</div>
	</div>
	
	<?php dynamic_sidebar('right_sidebar'); ?>
	<?php if (is_front_page()): ?>
	<h2> 最新视频 </h2>
	<?php 
	$args = array(
	    'post_type' => 'video',
	    'posts_per_page' => 3,
	    'orderby' => 'date'
	    );
	$the_query = new WP_Query($args);
	?>
	
	<ul class="list list-square">
		<?php if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
		<li><?php echo get_the_title(); ?></li>
		<?php
		  endwhile; else: 
		?>
		NO.....
		<?php endif; ?>
	</ul>
	<div class="clear"></div>
	<?php 
		$args = array(
			'post_type' => 'data',
			'posts_per_page' => 3,
			'orderby' => 'date'
			);
		$the_query = new WP_Query($args);	
	?>
	<div class="sidebar row clearfix">
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
  <?php endif; ?>
	


	


