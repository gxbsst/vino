<?php get_header(); ?>
<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8 single-content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <h2><?php the_title(); ?></h2>
      <p> <?php the_author(); ?></p>
      <p><strong>地址:</strong> <?php the_field('bar_address'); ?></p>
      <p><strong>营业时间:</strong> <?php the_field('bar_bu_time'); ?></p>
      <p><strong>电话: </strong><?php the_field('bar_tel'); ?></p>
      <p><strong>交通:</strong> <?php the_field('bar_traffic'); ?></p>
      <p><img src="<?php the_field('cover'); ?>" ></p>

      <?php the_field('description'); ?>

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
