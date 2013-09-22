<div id="site-content" class="container" role="main">

    <?php
        global $page_data;

        $page = get_page($page_data["blog_page"]);

        if($page_data["blog_page"] && $page->post_content != ""){
            echo '<div class="row-fluid page pre-page"><div class="clearfix">' . do_shortcode($page->post_content) . '</div></div>';
        }
    ?>

    <div class="row-fluid page">

    <?php

        $blog_layout = $page_data["blog_type"];

        $blog_type_get = "";
        if(isset($_GET['type'])) {
            switch($_GET['type']) {
                case "sidebar-left": $blog_layout = "Sidebar layout"; break;
                case "one-column": $blog_layout = "1 column"; break;
                case "two-column": $blog_layout = "2 column"; break;
                case "three-column": $blog_layout = "3 column"; break;
                case "four-column": $blog_layout = "4 column"; break;
            }
        }

        if (is_home() || single_cat_title("", false != "") || get_search_query() != "" || isset($year)) 
            $id = get_option("page_for_posts");
        else 
            $id = $post->ID;

        $meta = get_post_meta($id);

        $left_sidebar = "0";
        $right_sidebar = "0";

        if( isset($meta) && isset($meta['sbg_selected_sidebar']) && (!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type'] != "sidebar-right") ) ) {
            $left_sidebar = $meta['sbg_selected_sidebar'];
        }

        if( isset($meta) && isset($meta['sbg_selected_sidebar_replacement']) && (!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type'] != "sidebar-left") )  ) {
            $right_sidebar = $meta['sbg_selected_sidebar_replacement'];
        }

        $sidebar_layout = 0;

        if ($left_sidebar[0] != "0" && $right_sidebar[0] != "0") 
            $sidebar_layout = 4;
        else if ($left_sidebar[0] != "0" || $right_sidebar[0] != "0") 
            $sidebar_layout = 1;

        ?>
        <?php if ($left_sidebar[0] != "0" && $blog_layout == "Sidebar layout"): ?>
            <?php if (function_exists('is_plugin_active') && is_plugin_active('colorpicker/colorpicker.php')) : ?>

                <?php if (!$_GET['type'] || $_GET['type'] == "sidebar-left" || $_GET['type'] == "sidebar-both"): ?>
                    <?php if ($_GET['type'] == "sidebar-both"): ?>
                        <aside class="sidebar span3 clearfix"><ul style="margin: 0; padding: 0"><?php dynamic_sidebar($left_sidebar[0]); ?></ul></aside>
                    <?php else: ?>
                        <aside class="sidebar span3 clearfix"><ul style="margin: 0; padding: 0"><?php dynamic_sidebar($left_sidebar[0]); ?></ul></aside>   
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if ($sidebar_layout == 4): ?>
                    <aside class="sidebar span3 clearfix"><ul style="margin: 0; padding: 0"><?php dynamic_sidebar($left_sidebar[0]); ?></ul></aside>
                <?php else: ?>
                    <aside class="sidebar span3 clearfix"><ul style="margin: 0; padding: 0"><?php dynamic_sidebar($left_sidebar[0]); ?></ul></aside>   
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php
        $posts_page_id = get_option('page_for_posts');
        $site_link = home_url() . '/' . get_page_uri($posts_page_id);

        if (is_month()) {
            $site_link = home_url();
        }

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $new_query = new WP_Query();

        if (isset($_GET['s'])) {
            $search = $_GET['s'];
        } else {
            $search = "";
        }

        $cat = "Posts";

        if (single_cat_title('', false) != "") {

            $cat = single_cat_title('', false);

            $site_link = home_url();
        }
        $month = get_the_date('m');
        $year = get_the_date('Y');
        $day = get_the_date('d');
        if ($search != "") {
            $new_query->query('s="' . $search . '&post_type=post&posts_per_page=-1');
        } elseif (get_cat_id(single_cat_title("", false)) != "") {
            $new_query->query('cat=' . get_cat_id(single_cat_title("", false)) . '&paged=' . $paged . '&post_type=post&posts_per_page=-1');
        } elseif (is_tag()) {
            $new_query->query('paged=' . $paged . '&tag=' . get_query_var('tag') . '');
        } elseif (is_archive()) {
            $new_query->query('paged=' . $paged . '&year=' . $year . '&monthnum=' . $month . '&day=' . $day . '&post_type=post&posts_per_page=-1');
        } else {
            $new_query->query('paged=' . $paged . '&post_type=post');
        }

        global $blog_class;
        $blog_class = "";

        $select = 0;

        if ($blog_layout == "Sidebar layout") {
            $select = $sidebar_layout;
        }

        if ($blog_layout == "1 column") {
            $select = 5;
        }

        if ($blog_layout == "2 column") {
            $select = 3;
        }

        if ($blog_layout == "3 column") {
            $select = 6;
        }

        if ($blog_layout == "4 column") {
            $select = 7;
        }

        global $number_of_columns;
        $number_of_columns = 0;

        global $blog_post_class;
        $blog_post_class = "";

        if (function_exists('is_plugin_active') && is_plugin_active('colorpicker/colorpicker.php')) {
            switch ($_GET['type']) {

                case "full-view": $blog_class = "blog-full-view";
                    break;
                case 1: $blog_class = "blog-one-sidebar span9";
                    break;
                case 2: $blog_class = "blog-no-sidebar span9";
                    break;
                case "two-column": $blog_class = "blog-two-column";
                    $number_of_columns = 2;
                    break;
                case "sidebar-both": $blog_class = "blog-two-sidebar";
                    break;
                case "three-column": $blog_class = "blog-three-column";
                    $number_of_columns = 3;
                    break;
                case "four-column": $blog_class = "blog-four-column";
                    $number_of_columns = 4;
                    break;
                default: $blog_class = "blog-one-sidebar";
                    break;
            }
        } else {
            switch ($select) {

                case 0: $blog_class = "blog-full-view span12";
                    break;
                case 1: $blog_class = "blog-one-sidebar span9";
                    break;
                case 2: $blog_class = "blog-no-sidebar span12";
                    break;
                case 3: $blog_class = "blog-two-column span12";
                    $number_of_columns = 2;
                    $blog_post_class = "span6";
                    break;
                case 5: $blog_class = "blog-one-column span12";
                    $number_of_columns = 1;
                    break;
                case 4: $blog_class = "blog-two-sidebar span6";
                    break;
                case 6: $blog_class = "blog-three-column span12";
                    $number_of_columns = 3;
                    $blog_post_class = "span4";
                    break;
                case 7: $blog_class = "blog-four-column span12";
                    $number_of_columns = 4;
                    $blog_post_class = "span3";
                    break;
            }
        }
        if ($left_sidebar[0] && $blog_class == "blog-one-sidebar") {
            $blog_class .= " blog-left";
        }
        if ($right_sidebar[0] && $blog_class == "blog-one-sidebar" || ( function_exists('is_plugin_active') && is_plugin_active('colorpicker/colorpicker.php') && $_GET["type"] == "sidebar-right" )) {
            $blog_class .= " blog-right";
        }
        echo '<section id="section-content" class="clearfix ' . $blog_class . '">';

        global $counter;
        $counter = 0;
        $first = true;

        while ($new_query->have_posts()) : $new_query->the_post(); ?>

            <?php get_template_part( 'content', get_post_format() ); ?>
            <?php $counter++; ?>

        <?php endwhile; ?>

        <?php
        echo '<div class="clearfix"></div>';

        if ($new_query->found_posts == 0) {
            if ($counter == 0) {
                echo "<h2>";
                _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'azul');
                echo "</h2>";
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

        echo '</section>';
        ?>

        <?php wp_reset_query(); ?>
        <?php if ($right_sidebar[0] != "0" && $blog_layout == "Sidebar layout"): ?>
            <?php if (function_exists('is_plugin_active') && is_plugin_active('colorpicker/colorpicker.php')) : ?>
                <?php if ($_GET['type'] == "sidebar-right" || $_GET['type'] == "sidebar-both"): ?>

                    <?php if ($_GET['type'] == "sidebar-both"): ?>
                        <aside class="sidebar span3 clearfix"><ul style="margin: 0; padding: 0"><?php dynamic_sidebar($right_sidebar[0]); ?></ul></aside>
                    <?php else: ?>
                        <aside class="sidebar span3 clearfix"><ul style="margin: 0; padding: 0"><?php dynamic_sidebar($right_sidebar[0]); ?></ul></aside>   
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <?php if ($sidebar_layout == 4): ?>
                    <aside class="sidebar span3 clearfix"><ul style="margin: 0; padding: 0"><?php dynamic_sidebar($right_sidebar[0]); ?></ul></aside>
                <?php else: ?>
                    <aside class="sidebar span3 clearfix"><ul style="margin: 0; padding: 0"><?php dynamic_sidebar($right_sidebar[0]); ?></ul></aside>   
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>