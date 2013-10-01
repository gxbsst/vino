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

<div id="site-content" class="container data-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8">
			<?php $page = get_page(); ?>
      <h2><?php echo get_the_title($page); ?></h2>
			<?php 
				$args = array(
					'post_type' => 'data',
					'posts_per_page' => 12,
					'orderby' => 'date'
					);
				$the_query = new WP_Query($args);
			?>
			

      <div class="row">
        <?php 
        global $counter;
        $counter = 0;
        $first = true;
        if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
        ?>
          <article class="span3 single-post2" style="height: 200px;">
            <img src="<?php the_field('img');?>" width="150" / >
          <div class="single-post2-content" style="top: 151px; height: 168px;">
            <h4>
              <a href="<?php the_permalink(); ?> ">
                <?php echo get_the_title(); ?> 
              </a>
            </h4>
            <p><?php echo get_the_excerpt(); ?></p>
            <span class="single-post2-more">
              <a href="<?php echo the_field('data'); ?>"> 下载</a>
              <a class="single-post2-open" href="<?php the_permalink(); ?>"></a>
            </span>
          </div>
        </article>
        <?php wp_reset_query(); ?>

        <?php
          endwhile; else: 
        ?>
        暂时没有文章。
        <?php endif; ?>
      </div>

      <?php
              get_template_part('includes/pagination');
      
      ?>

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
