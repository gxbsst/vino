<?php
/*
Template Name: home
*/
?>
<?php get_header(); ?>

<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span9">
			<?php putRevSlider("defalt","homepage") ?>
			<h2 class="title">每周推荐</h2>
			
			<?php 
				$args = array(
					'category_name' => 'recommendation',
					'posts_per_page' => 4,
					'orderby' => 'rand'
					);
				$the_query = new WP_Query($args);
			?>
			<?php 
				if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
			<div class="row-fluid">
				<?php for ($i=0; $i < 3; $i++):?>
				<article class="span3 single-post2" style="height: 192px;">
					<?php if (has_post_thumbnail( $post->ID )) : ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
					<img src="<?php echo $image[0]; ?>" />
					<?php endif; ?>

					<div class="single-post2-content" style="top: 151px; height: 168px;">
						<h4>
							<a href="<?php the_permalink(); ?> ">
								<?php echo get_the_title(); ?> 
							</a>
						</h4>
						<p><?php echo get_the_excerpt(); ?></p>
						<span class="single-post2-more">
							<a class="single-post2-open" href="<?php the_permalink(); ?>"></a>
						</span>
					</div>
				</article>
			<?php endfor; ?>
			</div>
			
			<div class="clear"></div>
			
			<?php
			  endwhile; else: 
			?>
				NO.....
			<?php endif; ?>

			
			<div class="ad">
			  <img src="<?php echo get_bloginfo('template_directory');?>/images/ad.png" alt="" />
			</div>
			
			<h2>品酒心得</h2>
			<?php 
				$args = array(
					'post_type' => 'tasting',
					'posts_per_page' => 3,
					'orderby' => 'rand'
					);
				$the_query = new WP_Query($args);
			?>
			<?php 
				if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
			<ul class="article_list_widget ">
				<?php for ($i=0; $i < 3; $i++):?>
				<li>
					<a href="<?php the_permalink(); ?>"  class="img-outer">
						<img src="<?php the_field('tasting_image'); ?>" width="150" >
					</a>
					<div class="text-outer" title="Rated 4 out of 5">
						<h3>
							<a href="<?php the_permalink(); ?> ">
								<?php echo get_the_title(); ?> 
							</a>
						</h4>
						<p><?php echo get_the_author(); ?>(<?php the_field('tasting_date');?>)</p>
						<p><?php the_field('tasting_address'); ?></p>
						<blockquote>
							<p class="quotetex">
							
							<?php echo get_the_excerpt(); ?>
							
						</p>
					</blockquote>
					</div>
					<div class="margin-bottom clear"></div>
				</li>
			<?php endfor; ?>
			</ul>
			<div class="clear"></div>
			
			<?php
			  endwhile; else: 
			?>
				NO.....
			<?php endif; ?>


			

			<h2>酒吧</h2>

			<?php 
				$args = array(
					'post_type' => 'bar',
					'posts_per_page' => 3,
					'orderby' => 'rand'
					);
				$the_query = new WP_Query($args);
			?>
			<?php 
				if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
			<ul class="article_list_widget ">
				<?php for ($i=0; $i < 3; $i++):?>
				<li>
					<a href="<?php the_permalink(); ?>"  class="img-outer">
						<img src="<?php the_field('cover'); ?>" width="150" >
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
			<?php endfor; ?>
			</ul>
			<div class="clear"></div>
			
			<?php
			  endwhile; else: 
			?>
				NO.....
			<?php endif; ?>
		</section>

		<aside class="sidebar span3 clearfix">
			<?php get_template_part( 'sidebar'); ?>
		</aside> 

	</div>
</div>


<?php get_footer(); ?>
