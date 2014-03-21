<?php get_header(); ?>
<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		

		<section id="section-content" class="clearfix span8">
			<?php $cat = get_query_var('cat'); ?>
			<?php $cat_name = get_category($cat)->name; ?>
			<h2><?php echo $cat_name; ?></h2>
			<?php 
			$page = get_query_var( 'page' );
			$args = array(
				"cat" => $cat,
				'posts_per_page' => 6,
				'orderby' => 'date',
				'paged' => $page
				);
			// var_dump($args);
			$the_query = new WP_Query($args);
			?>

			<?php 
			global $counter;
			$counter = 0;
			$first = true;

			if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
			<h2>
				<a href="<?php the_permalink(); ?> ">
					<?php the_title(); ?>
				</a>
			</h2>
			<?php the_content(); ?>


			<?php wp_reset_query(); ?>
			<?php
			endwhile; else: 
			?>
			暂时没有文章。
		<?php endif; ?>
		<?php
		get_template_part('includes/pagination');
		?>
	</section>
	<aside class="sidebar span4 clearfix">
		<?php get_template_part( 'sidebar'); ?>
	</aside> 
</div>
</div>
<?php get_footer(); ?>
