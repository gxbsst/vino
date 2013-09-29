<?php get_header(); ?>
<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
           <h2><?php the_title(); ?></h2>
           <p><img src="<?php the_field('cover'); ?>" ></p>
           <?php the_excerpt();?>
            <?php the_content();?>
          <a href="<?php echo the_field('data'); ?>"> 下载</a>
      <?php endwhile; else: ?>
          <p>Sorry, no posts matched your criteria.</p>
      <?php endif; ?> 
      <?php comments_template('', true); ?>
    <!-- end section-content -->
		</section>
		<aside class="sidebar span4 clearfix">
			<?php get_template_part( 'sidebar'); ?>
		</aside> 
   <!-- end row-fluid -->
	</div>
 <!-- end site-content -->
</div>

<?php get_footer(); ?>
