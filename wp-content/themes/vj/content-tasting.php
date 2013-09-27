
<?php global $blog_class, $blog_post_class, $counter, $number_of_columns; ?>

<?php $post = get_post(get_the_ID()); ?>
    <?php $post_category = get_the_category(get_the_ID()); ?>
    <?php $proceed = true; ?>
    <?php if (isset($post_category[0]->category_parent) && $post_category[0]->category_parent != 0): ?>
        <?php $category_parent = get_the_category_by_ID($post_category[0]->category_parent); ?>
        <?php
        if ($category_parent == "Portfolio") {
            $proceed = false;
        }
        ?>
    <?php endif; ?>

    <?php if ($proceed): ?>
        <?php if ($blog_class == "blog-two-column" || $blog_class == "blog-three-column" || $blog_class == "blog-four-column"): ?>
            <?php
            if ($counter == $number_of_columns || $first) {
                $counter = 0;
                $first = false;
            }
            ?>
        <?php endif; ?>

         <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix " . $blog_post_class); ?>>
            <?php $check_if_text_only = true; ?>
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
						<p><?php echo get_the_author(); ?>(<?php the_field('tasting_date');?>)</p>
						<p><?php the_field('tasting_address'); ?></p>
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
            
            </article>

    <?php
    if ($counter == $number_of_columns) {
        echo "<div class='clearfix'></div>";
    }
    ?>
<?php endif; ?>
