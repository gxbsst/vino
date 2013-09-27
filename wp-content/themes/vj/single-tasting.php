<?php get_header(); ?>

<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span9">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <img src="<?php the_field('tasting_image'); ?>" ><br/>
          <?php the_title(); ?><br/>
          <?php the_author(); ?><br/>
          <p><?php the_field('tasting_address'); ?></p>
          <?php the_field("tasting_date");?>
      <?php endwhile; else: ?>
          <p>Sorry, no posts matched your criteria.</p>
      <?php endif; ?> 
      <?php comments_template('', true); ?>
    <!-- end section-content -->
		</section>
		<aside class="sidebar span3 clearfix">
			<?php get_template_part( 'sidebar'); ?>
		</aside> 
   <!-- end row-fluid -->
	</div>
 <!-- end site-content -->
</div>

<?php get_footer(); ?>
