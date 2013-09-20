<?php
    global $page_data;

    $page = get_page($page_data["portfolio_page"]);
    if($page->post_content != ""){
        echo '<div class="row-fluid page pre-page"><div class="clearfix">' . do_shortcode($page->post_content) . '</div></div>';
    }
?>

<?php

$meta = get_post_meta(get_the_ID());

$left_sidebar = 0;
if (isset($meta['sbg_selected_sidebar']))
    $left_sidebar = $meta['sbg_selected_sidebar'];

$right_sidebar = 0;
if (isset($meta['sbg_selected_sidebar_replacement']))
    $right_sidebar = $meta['sbg_selected_sidebar_replacement'];

$max_per_pages = $page_data["limit_items"];
$filter_status = false;
if(isset($page_data["filter_pag"])){
    $filter_status = $page_data["filter_pag"];
}
$number_of_columns = $page_data["pagination_type"];

if(isset($_GET['type'])) {
    $number_of_columns = str_replace("-", " ", $_GET['type']);
}

switch ($number_of_columns) {
    case "1 column": $number_of_columns = "one-column";
        break;
    case "2 column": $number_of_columns = "two-column";
        break;
    case "3 column": $number_of_columns = "three-column";
        break;
    case "4 column": $number_of_columns = "four-column";
        break;
}

if (function_exists('is_plugin_active') && is_plugin_active('colorpicker/colorpicker.php')) {
    switch ($_GET['type']) {
        case "2-column": $number_of_columns = "two-column";
            break;
        case "3-column": $number_of_columns = "three-column";
            break;
        case "4-column": $number_of_columns = "four-column";
            break;
    }
}

$args = array(
    'post_type' => 'portfolio',
    'orderby' => 'id',
    'order' => 'DESC',
    'numberposts' => -1,
);

$thumbnail_args = array(
    'alt' => "",
    'title' => "",
);

$current_number = 0;
$current_class = 1;
$oposite_side = 1;

$portfolio_class = "full";
$portfolio_posts = get_posts($args);

$counter = 0;
?>

<input class="none" id="max_per_page" type="text" value="<?php echo $max_per_pages; ?>" >

<?php
$parent = get_page_by_title('portfolio');

if (isset($parent->ID) && $parent->ID == get_the_ID()):

    $myterms = get_terms('portfolio_category', 'orderby=none&hide_empty');
    if ($portfolio_posts):
        if ($filter_status):
            ?>
            <div class="box portfolio-filter">

                <ul id="filters" class="clearfix" data-option-key="filter">   

                    <li><a href="#filter" class="selected-filter" data-filter="*">All</a></li>

                    <?php
                    $filters = get_terms('portfolio_category', 'orderby=none&hide_empty');

                    foreach ($filters as $filter) {
                        echo '<li> <span class="filter-divider">/</span> <a href="#filter" data-filter="' . strtolower(str_replace(" ", "-", $filter->name)) . '">' . $filter->name . '</a></li>';
                    }
                    ?>

                </ul>

            </div>
        <?php endif; ?>

        <div class="main-wrapper portfolio-wrapper" <?php
        if (!$filter_status) {
            echo 'style="margin-top: -60px"';
        }
        ?>>
            <ul class="portfolio clearfix" id="isotope-container">

                <?php foreach ($portfolio_posts as $post) : setup_postdata($post); ?>

                    <?php
                    global $more;
                    if ($current_number++ == $max_per_pages) {
                        $current_number = 1;
                        $current_class++;
                    }
                    ?>

                    <li class="isotope-item post <?php echo ' page-' . $current_class . ' ' . $number_of_columns; ?> clearfix <?php
            if (get_the_terms($post->ID, 'portfolio_category')) {
                foreach (get_the_terms($post->ID, 'portfolio_category') as $cat) {
                    echo strtolower(str_replace(" ", "-", $cat->name)) . " ";
                }
            }
                    ?>">
                    
                    <?php if(isset($number_of_columns) && ($number_of_columns == "two-column" || $number_of_columns == "three-column" || $number_of_columns == "four-column")): ?>

                        <article class="single-post2">
                            <?php 
                                $number_of_chars = 50;
                            ?>

                            <?php echo get_the_post_thumbnail($post->ID, 'full');  ?>
                            
                            <div class="single-post2-content">
                                <h4><?php the_title(); ?></h4>
                                <p><?php echo mb_substr(strip_tags(get_the_content('')), 0, $number_of_chars) ; ?>...</p>
                                <span class="single-post2-more">
                                    <a class="single-post2-lightbox" data-rel="lightbox" href="<?php echo get_the_post_thumbnail_src(get_the_post_thumbnail($post->ID, 'full')); ?>"></a> 
                                    <a class="single-post2-open" href="<?php echo get_permalink(); ?>"></a>                     
                                </span>
                            </div>
                        </article>
                    
                    <?php else: ?>

                        <article class="single-post2">

                        <?php $counter++; ?>

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
                            <?php elseif (get_the_post_thumbnail($post->ID, $portfolio_class) == ""): ?>

                                <?php else: ?>
                                    <?php $wp_image_class = explode(' ', $portfolio_class); ?>
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

                    <?php if ($portfolio_class == 'blog-no-sidebar'): ?>
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
                    endif;

                    if ($counter == $number_of_columns) {
                        echo "<div class='clearfix'></div>";
                    }
                ?>

                    </li>
                        <?php endforeach; ?>
            </ul> 
        </div>

        <div class="main-wrapper">

            <div class="pagination box jquery-pagination clearfix">     

                <div data-post-number="<?php echo $wp_query->found_posts; ?>" data-max-pages="<?php echo $max_per_pages; ?>" class="pagination-data">
                
                <ul class="page-numbers">
                    <li><a class="previous">&#8592;</a></li>
                    
                    <?php
                        if ($portfolio_posts) {
                            $number_of_pages = ceil(count($portfolio_posts) / $max_per_pages);
                        }
                        for ($i = 1; $i <= $number_of_pages; $i++) {
                            $selected = '';
                            if ($i == 1) {
                                $selected = 'current';
                            }
                            echo '<li><a class="page-numbers ' . $selected . ' pagination-value">' . $i . '</a></li>';
                        }
                    ?>
                    <li><a class="nxt">&#8594;</a></li>
                </ul>
                </div>
                <?php wp_reset_query(); ?>
            </div>
        </div>
        <?php
    else:
        echo "<h4 style='margin: 10px 0 30px 0'>" . __("No Portfolio posts found!", "azul") . "</h4>";
    endif;    
endif;