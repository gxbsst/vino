<?php get_header(); ?>

<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8 single-content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

          <h2><?php the_title(); ?></h2>

          <p><strong>作者: </strong><?php the_author(); ?></p>

          <?php $date = DateTime::createFromFormat('Ymd', get_field('tasting_date')); ?>
         
          <p><strong>时间: </strong> <?php echo $date->format('Y年m月d日'); ?></p>
          <p><strong>地址:</strong><?php the_field('tasting_address'); ?>  </p>

          <p><img src="<?php  the_field('tasting_image'); ?>" ></p>
          
     
          <?php the_content(); ?>
          
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
