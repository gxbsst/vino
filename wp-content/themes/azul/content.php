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
                //echo '<div class="row">';
                $counter = 0;
                $first = false;
            }
            ?>
        <?php endif; ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix " . $blog_post_class); ?>>
            <?php $check_if_text_only = true; ?>
            <?php if (strpos(get_post_field('post_content', get_the_ID()), "[vimeo]") > -1): ?>
            <?php
            $check_if_text_only = false;
            $content = get_post_field('post_content', get_the_ID());
            $start = strpos($content, "[vimeo]");
            $end = strpos($content, "[/vimeo]");

            echo "<div class='video-outer'>" . do_shortcode(substr($content, $start, $end - $start + 8)) . "</div>";
            ?>
                        <?php elseif (strpos(get_post_field('post_content', get_the_ID()), "[youtube]") > -1): ?>
        <?php
        $check_if_text_only = false;
        $content = get_post_field('post_content', get_the_ID());
        $start = strpos($content, "[youtube]");
        $end = strpos($content, "[/youtube]");

        echo "<div class='video-outer'>" . do_shortcode(substr($content, $start, $end - $start + 10)) . "</div>";
        ?>
            <?php elseif (get_the_post_thumbnail($post->ID, $blog_class) == ""): ?>

                <?php else: ?>
                    <?php $wp_image_class = explode(' ', $blog_class); ?>
            <a href="<?php the_permalink(); ?>">
                    <?php echo get_the_post_thumbnail($post->ID, $wp_image_class[0]); ?>
            </a>
                <?php endif; ?>
            
            <div class="post-inner">
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
                <?php if(get_option("rss_use_excerpt") == "0"): ?>
                    <?php the_content(); ?>
                <?php else: ?>                    
                    <?php the_excerpt(); ?>
                <?php endif; ?>
            </div>

            <a class="btn btn-medium btn-style1" href="<?php the_permalink(); ?>">
                <?php _e("Read more", "azul"); ?>
            </a>
        </div>

    </article>

    <?php
    if ($counter == $number_of_columns) {
        echo "<div class='clearfix'></div>";
    }
    ?>
<?php endif; ?>