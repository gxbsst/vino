<?php get_header(); ?>

<div id="site-content" class="container" role="main">
    <div class="row-fluid page">

        <?php if ( have_posts() ) : ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="blog-main clearfix">
                    
                    <header>
                        <h2 class="article-text-only"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-date-comments2">
                            <?php echo get_the_date('M d Y'); ?>,
                            <a href="<?php echo the_permalink(); ?>#comments">
                                <?php echo $post->comment_count; ?> <?php echo __('comments', 'azul'); ?>
                            </a>
                            
                        </div>
                    </header>
                    
                    <div class="blog-more-content">
                        <?php the_excerpt(); ?>
                    </div>
                        
                    <div class="clearfix"><?php tagsAndAuthor(); ?></div>
                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <div id="post-0" class="post no-results not-found">
                <h2 class="post-title"><?php _e( 'Nothing Found', 'azul' ); ?></h2>
                <div class="post-text sidebar">
                    <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'azul' ); ?></p>
                    <form role="search" method="get" id="searchform" action="http://astudio.si/preview/azul/">
                        <div><label class="screen-reader-text" for="s">Search for:</label>
                        <input type="text" value="" name="s" id="s" placeholder="Search">
                        <input type="submit" id="searchsubmit" value="">
                        </div>
                    </form>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>
    
<?php get_footer(); ?>
