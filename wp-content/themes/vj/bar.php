<?php
/*
Template Name: Home Bar
*/
?>

<?php get_header(); ?>

<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span9">
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
        global $counter;
        $counter = 0;
        $first = true;

				if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
      <?php get_template_part( 'content-bar', get_post_format() ); ?>
      <?php
      echo '<div class="clearfix"></div>';

      if ($the_query->found_posts == 0) {
          if ($counter == 0) {
            echo "have no post.....";
          }
      } else {

      $jetpack_active_modules = get_option('jetpack_active_modules');
      if ( class_exists( 'Jetpack', false ) && $jetpack_active_modules && in_array( 'infinite-scroll', $jetpack_active_modules ) ) {
      } else {
          if (single_tag_title('', false) == "" && get_template_part('includes/pagination') != "") {
              get_template_part('includes/pagination');
          }   
      }

      }
      ?>

      <?php wp_reset_query(); ?>

			<?php
			  endwhile; else: 
			?>
				NO.....
			<?php endif; ?>
    <!-- end section-content -->
		</section>
		<aside class="sidebar span3 clearfix">
			<?php get_template_part( 'sidebar'); ?>
		</aside> 
   <!-- end row-fluid -->
	</div>
 <!-- end site-content -->
</div>

<?php get_footer();?>
