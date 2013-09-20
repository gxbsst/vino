<?php get_header(); ?>

<?php

    function getVideos ($shortcode_start, $shortcode_end, $shortcode_content, $offset1, $offset2) {

        $offset = 0;
        $videos = array();

        while(true) {
            $start = strpos($shortcode_content, $shortcode_start, $offset);
            $end = strpos($shortcode_content, $shortcode_end, $start);
            $offset = $end;

            if ( ! $start ) {
                break;
            }

            array_push($videos, substr($shortcode_content, $start + $offset1, $end - $start - $offset2));
        }

        return $videos;
    }

?>

<?php if (get_post_type() == "portfolio") : ?>

	<div id="site-content" class="container" role="main">
		
		<?php

			global $page_data;

        	$page = get_page($page_data["portfolio_page"]);

        	if(do_shortcode($page->post_content) != "") {
        		echo '<div class="row-fluid page pre-page"><div class="clearfix">' . do_shortcode($page->post_content) . '</div></div>';
        	}

        	wp_reset_query();
        ?>

		<?php
            $attachments = get_posts( array(
                    'post_type' => 'attachment',
                    'posts_per_page' => -1,
                    'post_parent' =>get_the_ID(),
                    'orderby' => 'id',
                    'order' => 'ASC',
                    'exclude' => get_post_thumbnail_id()
            ));

            $youtube_videos = getVideos("[youtube]", "[/youtube]", get_the_content(), 9, 9);
            $vimeo_videos = getVideos("[vimeo]", "[/vimeo]", get_the_content(), 7, 7);

            if ( $attachments ):
                $count_att = 0;
			?>

				<div id="portfolio-single" class="carousel slide">
	                <ol class="carousel-indicators">
	                	<li data-target="#portfolio-single" data-slide-to="0"></li>
	                	<?php $i=1; foreach ( $attachments as $attachment ): ?>
							<li data-target="#portfolio-single" data-slide-to="<?php echo $i++; ?>"></li>
	                	<?php endforeach; ?>
				        <?php foreach ( $youtube_videos as $video ): ?>
				        	<li data-target="#portfolio-single" data-slide-to="<?php echo $i++; ?>"></li>
				        <?php endforeach; ?>
				        <?php foreach ( $vimeo_videos as $video ): ?>
				        	<li data-target="#portfolio-single" data-slide-to="<?php echo $i++; ?>"></li>
				        <?php endforeach; ?>
	                </ol>
	                <div class="carousel-inner">
	                	<div class="item active">
							<?php echo get_the_post_thumbnail($post->ID, "portfolio"); ?>
	                	</div>
	                	<?php 
			                foreach ( $attachments as $attachment ) {
			                	?>
			                	<div class="item">
				                    <?php
				                    	echo wp_get_attachment_image( $attachment->ID, "portfolio", false, false);
				                    ?>
			                	</div>
			                    <?php
			                }
		                ?>
						
				        <?php foreach ( $youtube_videos as $video ): ?>
					        <div class="item">
					            <div class="video-wrapper"><iframe src="http://www.youtube.com/embed/<?php echo $video; ?>?wmode=transparent" frameborder="0" wmode="Opaque"></iframe></div>
					        </div>
				        <?php endforeach; ?>

				        <?php foreach ( $vimeo_videos as $video ): ?>
					        <div class="item">
					            <div class="video-wrapper"><iframe src="http://player.vimeo.com/video/<?php echo $video; ?>" frameborder="0" width="560" height="315" wmode="Opaque"></iframe></div>
					        </div>
				        <?php endforeach; ?>

	                </div>
	                <a class="left carousel-control" href="#portfolio-single" data-slide="prev">&#8249;</a>
	                <a class="right carousel-control" href="#portfolio-single" data-slide="next">&#8250;</a>
	            </div>
			<?php elseif( get_the_post_thumbnail($post->ID, "portfolio") != "" ): ?>

				<div id="portfolio-single" class="carousel slide">
					<div class="carousel-inner">
	                	<div class="item active">
	
						    <?php
			                	echo get_the_post_thumbnail($post->ID, "portfolio");
			                ?>
			            </div>
			        </div>
			    </div>

	        <?php endif; ?>

			<div class="post row-fluid portfolio-single clearfix">
				
				<?php
					$meta = get_post_meta(get_the_ID());
				?>

				<?php if( isset($meta) && isset($meta["portfolio_side_content"]) && $meta["portfolio_side_content"][0] != "" ): ?>
					<div class="span5 side-content-wrapper">
						<div class="post-title">
		                    <h1><?php _e("Project details", "azul"); ?></h1>
		                </div>
		                <div class="side-content">
							<?php echo do_shortcode($meta["portfolio_side_content"][0]); ?>
						</div>
					</div>
					<div class="span7 main-content">					
				<?php endif; ?>

	            <header class="clearfix">
	                <a class="post-title" href="<?php echo the_permalink(); ?>">
	                    <h1><?php the_title(); ?></h1>
	                </a>
	                <div class="post-meta">
	                    <?php
	                        $meta_not_first = false;

	                        if (get_the_terms($post->ID, 'portfolio_category')) {
	                            foreach (get_the_terms($post->ID, 'portfolio_category') as $cat) {
	                                if($meta_not_first) {
	                                     echo ", ";
	                                }
	                                echo strtolower(str_replace(" ", "-", $cat->name));
	                                $meta_not_first = true;
	                            }
	                        }
	                    ?>
	                </div>
	            </header>

	            <div class="post-content">
	            	<?php the_content(); ?>
	            </div>

	            <?php if( isset($meta) && isset($meta["portfolio_side_content"]) && $meta["portfolio_side_content"][0] != "" ): ?>
					</div>
	            <?php endif; ?>
            </div>
			
			<?php if( get_the_terms($post->ID, 'portfolio_category') ): ?>

				<?php
					$categories = "";
					$counter = 0;

	                foreach (get_the_terms($post->ID, 'portfolio_category') as $cat) {
	                	if($counter++ != 0) $categories .= ", ";
	                	$categories .= $cat->name;
	                }
				?>

				<div class="portfolio-single-recent">
					<h3><?php _e("Related projects", "azul"); ?></h3>

		            <?php echo do_shortcode('[projects categories="' . $categories . '"]4[/projects]'); ?>
	            </div>

        	<?php endif; ?>
		
	</div>

<?php else: ?>

<div id="site-content" class="container" role="main">

    <?php
        global $page_data;

		$meta = get_post_meta(get_the_ID());

		$num_of_sidebars = 0;
		$left_sidebar = 0;
		if (isset($meta['sbg_selected_sidebar'])) {
		    $left_sidebar = $meta['sbg_selected_sidebar'];
		    if($left_sidebar[0] != "0") {
		        $num_of_sidebars++;   
		    }
		}

		$right_sidebar = 0;
		if (isset($meta['sbg_selected_sidebar_replacement'])) {
		    $right_sidebar = $meta['sbg_selected_sidebar_replacement'];
		    if($right_sidebar[0] != "0") {
		        $num_of_sidebars++;   
		    }
		}

        $page = get_page($page_data["blog_page"]);
        if( do_shortcode($page->post_content) != "" ) {
        	echo '<div class="row-fluid page pre-page"><div class="clearfix">' . do_shortcode($page->post_content) . '</div></div>';
   	 	}
    ?>

	<?php
		$blog_class = "blog-full-view";
	?>
	<div class="row-fluid page pre-page">
		
	    <?php if ($left_sidebar[0] != "0"): ?>
	            <aside class="sidebar span<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?> clearfix">
	            	<ul>
	            		<?php dynamic_sidebar($left_sidebar[0]); ?>
					</ul>
	            </aside>   
	    <?php endif; ?>

		<section class="<?php if($num_of_sidebars == 1) { echo "span9"; } else if($num_of_sidebars == 2) { echo "span6"; } ?>">
	        <?php while (have_posts()) : the_post(); ?>


				<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix "); ?>>
	                <?php $check_if_text_only = true; ?>
	                    <?php if (get_the_post_thumbnail($post->ID, $blog_class) == ""): ?>

	                        <?php else: ?>
	                            <?php $wp_image_class = explode(' ', $blog_class); ?>
	                    <a href="<?php the_permalink(); ?>">
	                            <?php echo get_the_post_thumbnail($post->ID, $wp_image_class[0]); ?>
	                    </a>
	                        <?php endif; ?>

	                    <header class="clearfix">
	                        <a class="post-title" href="<?php echo the_permalink(); ?>">
	                            <h1><?php the_title(); ?></h1>
	                        </a>
	                        <div class="post-meta">
	                            <?php tagsAndAuthor(); ?>
	                        </div>
	                        <div class="post-date">
	                            <span><?php echo get_the_date('j F Y'); ?></span> &nbsp;/&nbsp; <a href="<?php echo the_permalink(); ?>#comments"><?php echo $post->comment_count; ?> <?php echo __('comments', 'azul'); ?></a>
	                        </div>
	                    </header>

	            <?php if ($blog_class == 'blog-no-sidebar'): ?>
	                <?php tagsAndAuthor(); ?>
	            <?php endif; ?>
	                    <div class="post-content">
	                            <?php the_content(); ?>
	                    </div>

	            </article>

				<!-- ShareThis elements -->

                <div class="share-this">

                    <span class='st_facebook_hcount' displayText='Facebook'></span>
                    <span class='st_twitter_hcount' displayText='Tweet'></span>
                    <span class='st_pinterest_hcount' displayText='Pinterest'></span>
                    <span class='st_sharethis_hcount' displayText='ShareThis'></span>

                </div>

                <!-- ShareThis Scripts -->

                <script type="text/javascript">var switchTo5x=false;</script>
                <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
                <script type="text/javascript">stLight.options({publisher: "ur-79f4387c-3a8c-7231-9a0c-f92b327ca6c4", doNotHash: false, doNotCopy: true, hashAddressBar: false});</script>

	            <?php comments_template('', true); ?>

				</section>
		
        <?php endwhile; // end of the loop. ?>

        <?php if (isset($right_sidebar[0]) && $right_sidebar[0] != "0"): ?>
            <aside class="sidebar span<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?> clearfix">
            	<ul>
            		<?php dynamic_sidebar($right_sidebar[0]); ?>
            	</ul>	
            </aside>   
        <?php endif; ?>

</div></div><!-- #site-content -->

<?php endif; ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>