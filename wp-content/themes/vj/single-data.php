<?php get_header(); ?>
<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span9">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                  <img src="<?php the_field('cover'); ?>" >
          <?php the_title(); ?><br/>
          <?php the_content();?><br />
          <?php the_excerpt();?>
          <a href="<?php echo the_field('data'); ?>"> 下载</a>
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
