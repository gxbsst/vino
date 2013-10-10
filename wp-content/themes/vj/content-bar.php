
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
              <li>
                <a href="<?php the_permalink(); ?>"  class="img-outer">
                  <?php if(!(get_field('cover'))): ?>
                   <img src="/images/no-pic.jpg"  width="150" height="124"/>
                   <?php else: ?>
                    <img src="<?php the_field('cover'); ?>" width="150" height="124" >
                   <?php endif; ?>
                </a>
                <div class="text-outer" title="Rated 4 out of 5">
                  <h3>
                    <a href="<?php the_permalink(); ?> ">
                      <?php echo the_title(); ?> 
                    </a>
                  </h4>
                  <p class="author">作者: <?php echo get_the_author(); ?><?php // the_field('tasting_date');?></p>
                  <p><strong>地址:</strong> <?php the_field('bar_address'); ?></p>
                  <p><strong>营业时间:</strong> <?php the_field('bar_bu_time'); ?></p>
                  <p><strong>电话: </strong><?php the_field('bar_tel'); ?></p>
                  <p><strong>交通:</strong> <?php the_field('bar_traffic'); ?></p>
                </div>

                <!-- <div class="post-date">


                    <p><?php tagsAndAuthor(); ?>
                    <span><?php echo get_the_date('j F Y'); ?></span> 
                     &nbsp;/&nbsp; 
                    <a href="<?php echo the_permalink(); ?>#comments">
                    <?php echo $post->comment_count; ?> <?php echo __('comments', 'azul'); ?>
                    </a>
                </div> -->

                <div class="margin-bottom clear"></div>
              </li>
            </ul>
            <div class="clear"></div>
            
            </article>

    <?php
    if ($counter == $number_of_columns) {
        echo "<div class='clearfix'></div>";
    }
    ?>
<?php endif; ?>
