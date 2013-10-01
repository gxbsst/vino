<?php
/*
Template Name: Home Video
*/
?>

<?php get_header(); ?>

<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8">
			<?php $page = get_page(); ?>
			<h2><?php echo get_the_title($page); ?></h2>
			<?php 
				$args = array(
					'post_type' => 'video',
					'posts_per_page' => 6,
					'orderby' => 'rand'
					);
				$the_query = new WP_Query($args);
			?>
			<?php 
        global $counter;
        $counter = 0;
        $first = true;

				if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
      <h2>
        <a href="<?php the_permalink(); ?> ">
        <?php the_title(); ?>
        </a>
      </h2>
      <?php the_field('video'); ?>
      <?php
      get_template_part('includes/pagination');
      ?>

      <?php wp_reset_query(); ?>

			<?php
			  endwhile; else: 
			?>
				暂时没有文章。
			<?php endif; ?>
    <!-- end section-content -->
		</section>
		<aside class="sidebar span4 clearfix">
			<?php get_template_part( 'sidebar'); ?>
		</aside> 
   <!-- end row-fluid -->
	</div>
 <!-- end site-content -->
</div>

<?php get_footer();?>
