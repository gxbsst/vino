<?php get_header(); ?>
<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8">
			<?php $cat = get_the_category( ); ?>
			<h2><?php echo $cat[0]->cat_name; ?></h2>
			<?php 
			$args = array(
				'post_type' => array('tasting', 'bar'),
				'posts_per_page' => 7,
				'orderby' => 'date'
				);
			$the_query = new WP_Query($args);
			?>
			<?php 
			if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
			<ul class="article_list_widget ">
				<?php if('tasting' == get_post_type()): #品酒心得?>
				<li>
					<a href="<?php the_permalink(); ?>"  class="img-outer">
						<?php if(!(get_field('tasting_image'))): ?>
						<img src="/images/no-pic.jpg"  width="150" height="124"/>
					<?php else: ?>
					<img src="<?php the_field('tasting_image'); ?>" width="150" height="124" >
				<?php endif; ?>

			</a>
			<div class="text-outer" title="Rated 4 out of 5">
				<h3>
					<a href="<?php the_permalink(); ?> ">
						<?php echo get_the_title(); ?> 
					</a>
				</h4>
				<p class="author">作者: <?php echo get_the_author(); ?><?php // the_field('tasting_date');?></p>
				<p class="address"><?php the_field('tasting_address'); ?></p>

				<blockquote>
					<p class="quotetex">
						<?php echo wp_trim_words( get_the_excerpt(), $num_words = 48, $more = null ); ?>
					</p>
				</blockquote>
			</div>
		<?php elseif('bar' == get_post_type()):# 酒吧 ?>
		<li>
			<a href="<?php the_permalink(); ?>"  class="img-outer">
				<?php if(!(get_field('cover'))): ?>
				<img src="/images/no-pic.jpg"  width="150" height="124"/>
			<?php else: ?>
			<img src="<?php the_field('cover'); ?>" width="150"  height="124">
		<?php endif; ?>

	</a>
	<div class="text-outer" title="Rated 4 out of 5">
		<h3>
			<a href="<?php the_permalink(); ?> ">
				<?php echo get_the_title(); ?> 
			</a>
		</h4>
		<p><strong>地址:</strong> <?php the_field('bar_address'); ?></p>
		<p><strong>营业时间:</strong> <?php the_field('bar_bu_time'); ?></p>
		<p><strong>电话: </strong><?php the_field('bar_tel'); ?></p>
		<p><strong>交通:</strong> <?php the_field('bar_traffic'); ?></p>
	</div>
	<div class="margin-bottom clear"></div>
</li>
<?php endif; ?>
<div class="margin-bottom clear"></div>
</li>
</ul>
<?php 
get_template_part('includes/pagination');
?>
<?php
endwhile; else: 
?>
NO.....
<?php endif; ?>
</section>
<aside class="sidebar span4 clearfix">
	<?php get_template_part( 'sidebar'); ?>
</aside> 
</div>
</div>
<?php get_footer(); ?>
