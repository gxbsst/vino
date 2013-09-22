<?php

class AnpsMostPopular extends WP_Widget {

    function AnpsMostPopular() {        
        $widget_ops = array('classname' => 'AnpsMostPopular', 'description' => 'Shows a box with most popular posts, most recent posts and comments.');
        $this->WP_Widget('AnpsMostPopular', 'Azul Recent/Popular/Comments box', $widget_ops);
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'anps_number_fields' => '', 'anps_recent_title' => ''));
        $title = $instance['title'];
        $anps_number_fields = $instance['anps_number_fields'];
        $anps_recent_title = $instance['anps_recent_title'];
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title for popular posts: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('anps_recent_title'); ?>">Title for recent posts: </label>
            <input class="widefat" id="<?php echo $this->get_field_id('anps_recent_title'); ?>" name="<?php echo $this->get_field_name('anps_recent_title'); ?>" type="text" value="<?php echo esc_attr($anps_recent_title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('anps_number_fields'); ?>">Number of posts/comments to show:</label>
            <input id="<?php echo $this->get_field_id('anps_number_fields'); ?>" name="<?php echo $this->get_field_name('anps_number_fields'); ?>" value="<?php echo esc_attr($anps_number_fields); ?>" type="text" value="5" size="3"></p>

        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['anps_number_fields'] = $new_instance['anps_number_fields'];
        $instance['anps_recent_title'] = $new_instance['anps_recent_title'];
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        $anps_number_fields = $instance['anps_number_fields'];
        $anps_recent_title = $instance['anps_recent_title'];

        echo $before_widget;

        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

        /* Popular posts */

        $tab1 = "";

        $paged = '';
        $new_query = new WP_Query();
        $new_query->query('paged=' . $paged . '&posts_per_page=' . $anps_number_fields . '&numberposts=' . $anps_number_fields . '&orderby=comment_count&order="DESC"');

        //The Loop
        while ($new_query->have_posts()) : $new_query->the_post();

            $tab1 .= '<a class="post" href="' . get_permalink(get_the_ID()) . '" title="' . get_the_title() . '">
                <div class="image">' . get_the_post_thumbnail(get_the_ID(), "small-thumbnail") . '</div>
                <p>' . get_the_title() . '</p>
                <div class="date">' . get_the_date('M d, Y') . '</div>
            </a>';

        endwhile;  



        /* Popular posts */

        $tab2 = "";

        $paged = '';
        $new_query = new WP_Query();
        $new_query->query('paged=' . $paged . '&posts_per_page=' . $anps_number_fields . '&numberposts=' . $anps_number_fields . '&orderby=id&order="DESC"');

        //The Loop
        while ($new_query->have_posts()) : $new_query->the_post();

            $tab2 .= '<a class="post" href="' . get_permalink(get_the_ID()) . '" title="' . get_the_title() . '">
                <div class="image">' . get_the_post_thumbnail(get_the_ID(), "small-thumbnail") . '</div>
                <p>' . get_the_title() . '</p>
                <div class="date">' . get_the_date('M d, Y') . '</div>
            </a>';

        endwhile;  


        $tab3 = "";

        $args = array(
            'number'=>$anps_number_fields,
            'status' => 'approve',
            'orderby' => 'comment_date_gmt',
            'order' => 'DESC',
        );

        $comments = get_comments($args);

        foreach ($comments as $comment) :
            $tab3 .= '<a class="post" href="' . get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID . '" >
                        <div class="image clearfix">' . get_avatar($comment->user_id) . '</div>
                        <p>' . strip_tags($comment->comment_author) . " says:</p>" .
            '<div class="comment-content">' . $comment->comment_content . '</div>' .
            '</a>';
        endforeach;

        ?>
        <?php echo do_shortcode('
        [tabs tab1="' . $title . '" tab2="' . $anps_recent_title . '" tab3="..."]
            [tab]' . $tab1 . '[/tab]
            [tab]' . $tab2 . '[/tab]
            [tab]' . $tab3 . '[/tab]
        [/tabs]');
        }

}
add_action('widgets_init', create_function('', 'return register_widget("AnpsMostPopular");'));