<?php
/*
Template Name: home
*/
?>
<?php get_header(); ?>

<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8">
			<?php putRevSlider("defalt","homepage") ?>
			<!--
			<h2 class="title">每周推荐</h2>
			
			<?php 
				$args = array(
					#'category_name' => 'recommendation',
          'post_type' => array('tasting', 'bar'),
					'posts_per_page' => 2,
					'orderby' => 'date'
					);
				$the_query = new WP_Query($args);
			?>

    <div class="row">
			<?php 
				if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
        <div class="span4">
            <article class="person">
                <header>
                <?php# if (has_post_thumbnail( $post->ID )) : ?>
                <?php# $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                <a href="<?php the_permalink(); ?> ">
                <?php if("bar" == get_post_type()):  ?>
                         <img src="<?php the_field('cover'); ?>" />
                <?php elseif('tasting' == get_post_type()): ?>
                         <img src="<?php the_field('tasting_image'); ?>" />
                <?php endif;?>
                </a>
                <?php# endif; ?>
                </header>
                <h3><?php the_author(); ?> /
                    <em><?php echo get_the_title(); ?></em>
                </h3>
                 <?php the_excerpt(); ?>
            </article>
        </div>

			<?php
			  endwhile; else: 
			?>
				NO.....
			<?php endif; ?>

    </div>
			<div class="clear"></div>
			
			<div class="ad">
			  <img src="<?php echo get_bloginfo('template_directory');?>/images/ad.png" alt="" />
			</div>
		-->
			<?php $page = get_page( TASTINT_PAGE_ID ); ?>
			<h2><?php echo $page->post_title; ?> <span class="more"> <a href="<?php echo get_permalink( $page->ID ); ?>">MORE >></a> </span></h2>
			<?php 
				$args = array(
					'post_type' => 'tasting',
					'posts_per_page' => 3,
					'orderby' => 'date'
					);
				$the_query = new WP_Query($args);
			?>
			<?php 
				if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
			<ul class="article_list_widget ">
				<?php for ($i=0; $i < 3; $i++):?>
				<li>
					<a href="<?php the_permalink(); ?>"  class="img-outer">
						<img src="<?php the_field('tasting_image'); ?>" width="150" >
					</a>
					<div class="text-outer" title="Rated 4 out of 5">
						<h3>
							<a href="<?php the_permalink(); ?> ">
								<?php echo get_the_title(); ?> 
							</a>
						</h4>
						
						<p class="author">By <?php echo get_the_author(); ?>(<?php the_field('tasting_date');?>)</p>
						<p class="address"><?php the_field('tasting_address'); ?></p>
						<blockquote>
							<p class="quotetex">
							
							<?php echo get_the_excerpt(); ?>
							
						</p>
					</blockquote>
					</div>
					<div class="margin-bottom clear"></div>
				</li>
			<?php endfor; ?>
			</ul>
			<div class="clear"></div>
			
			<?php
			  endwhile; else: 
			?>
				NO.....
			<?php endif; ?>


			

			<?php $page = get_page( BAR_PAGE_ID ); ?>
			<h2><?php echo $page->post_title; ?> <span class="more"> <a href="<?php echo get_permalink( $page->ID ); ?>">MORE >></a> </span></h2>

			<?php 
				$args = array(
					'post_type' => 'bar',
					'posts_per_page' => 3,
					'orderby' => 'date'
					);
				$the_query = new WP_Query($args);
			?>
			<?php 
				if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
			<ul class="article_list_widget ">
				<?php for ($i=0; $i < 3; $i++):?>
				<li>
					<a href="<?php the_permalink(); ?>"  class="img-outer">
						<img src="<?php the_field('cover'); ?>" width="150" >
					</a>
					<div class="text-outer" title="Rated 4 out of 5">
						<h3>
							<a href="<?php the_permalink(); ?> ">
								<?php echo get_the_title(); ?> 
							</a>
						</h4>
						<p><strong>地址:</strong> <?php the_field('bar_address'); ?></p>
						<p><strong>营业时间:</strong> <?php the_field('bar_bu_time'); ?></p>
						<p><strong>电话: </strong><?php the_field('bar_tel'); ?></p>
						<p><strong>交通:</strong> <?php the_field('bar_traffic'); ?></p>
					</div>
					<div class="margin-bottom clear"></div>
				</li>
			<?php endfor; ?>
			</ul>
			<div class="clear"></div>
			
			<?php
			  endwhile; else: 
			?>
				NO.....
			<?php endif; ?>
		</section>

		<aside class="sidebar span4">
			<?php get_template_part( 'sidebar'); ?>
		</aside> 

	</div>
</div>


<?php get_footer(); ?>
