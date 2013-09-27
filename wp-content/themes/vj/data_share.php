<?php
/*
Template Name: Home Data Share
*/

?>
<?php 
global $page_data; 
$meta = get_post_meta(get_the_ID());
?>


<?php get_header(); ?>

                <?php 
                if ($page_data['portfolio_page'] == get_the_ID()):
                ?>
<?php

    $page = get_page($page_data["portfolio_page"]);
var_dump($page);
?>
<?php endif; ?>

<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span9">
			<h2>资料分享</h2>
			<?php 
				$args = array(
					'post_type' => 'data',
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
          <a href="<?php the_permalink();?>" ><?php the_title();?></a>
          <img src="<?php the_field('img');?>" width="150" / >
          <?php the_excerpt();?>
          <a href="<?php echo the_field('data'); ?>"> 下载</a>
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
