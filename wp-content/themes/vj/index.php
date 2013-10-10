<?php
/*
Template Name: index
*/

?>
<?php get_header(); ?>

<div id="site-content" class="container home-container" role="main">
	<div class="row-fluid page">
		<section id="section-content" class="clearfix span8">

			<?php
			global $query_string;

			$query_args = explode("&", $query_string);
			$search_query = array();

			foreach($query_args as $key => $string) {
				$query_split = explode("=", $string);
				$search_query[$query_split[0]] = urldecode($query_split[1]);
			} // foreach

			$the_query = new WP_Query($search_query);
			if (have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
		
						<ul class="article_list_widget ">
			        <?php if('tasting' == get_post_type()): #品酒心得?>
							<li>
								<a href="<?php the_permalink(); ?>"  class="img-outer">
									<img src="<?php the_field('tasting_image'); ?>" width="150" height="124" >
								</a>
								<div class="text-outer" title="Rated 4 out of 5">
									<h3>
										<a href="<?php the_permalink(); ?> ">
											<?php echo get_the_title(); ?> 
										</a>
									</h4>
									<p><?php echo get_the_author(); ?>(<?php the_field('tasting_date');?>)</p>
									<p><?php the_field('tasting_address'); ?></p>
									<blockquote>
										<p class="quotetex">
										
										<?php echo get_the_excerpt(); ?>
										
									</p>
								</blockquote>
								</div>
			          <?php elseif('bar' == get_post_type()):# 酒吧 ?>
			            <li>
			              <a href="<?php the_permalink(); ?>"  class="img-outer">
			                <img src="<?php the_field('cover'); ?>" width="150" height="124" >
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

			          <?php else: ?>
						<li>
						
						  <div class="text-outer" title="Rated 4 out of 5">
						    <h3>
						      <a href="<?php the_permalink(); ?> ">
						        <?php echo get_the_title(); ?> 
						      </a>
						    </h3>
						
						  </div>
						  <div class="margin-bottom clear"></div>
						</li>


			          <?php endif; ?>
								<div class="margin-bottom clear"></div>
							</li>
						</ul>
			      <?php 
			         get_template_part('includes/pagination');
			      ?>
			


			<?php
			  endwhile; else: 
			?>
			 亲， 没有找到你想要的哦...
			<?php endif; ?>


		</section>
		<aside class="sidebar span4 clearfix">
			<?php get_template_part( 'sidebar'); ?>
		</aside> 
		<!-- end row-fluid -->
	</div>
	<!-- end site-content -->
</div>

<?php get_footer(); ?>