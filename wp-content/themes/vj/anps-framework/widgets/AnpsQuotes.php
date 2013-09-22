<?php

class AnpsQuotes extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'AnpsQuotes', 'Anps -  Quotes', array('description' => __('Display a number of quotes from posts', 'azul'),)
        );
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'anps_number_fields' => '', 'anps_category_id' => ''));
        $title = $instance['title'];
        $anps_number_fields = $instance['anps_number_fields'];
        $anps_category_id = $instance['anps_category_id'];
        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('anps_number_fields'); ?>">Number of posts to show:</label>
            <input id="<?php echo $this->get_field_id('anps_number_fields'); ?>" name="<?php echo $this->get_field_name('anps_number_fields'); ?>" value="<?php echo esc_attr($anps_number_fields); ?>" type="text" value="5" size="3"></p>



        <p><label for="<?php echo $this->get_field_id('anps_category_id'); ?>">Category name:</label>
        <?php
        $cats = get_terms('testimonial_category', 'orderby=none&hide_empty');
        echo '<select name="' . $this->get_field_name('anps_category_id') . '" id="' . $this->get_field_id('anps_category_id') . '">';
        foreach ($cats as $cat) {
            ?>
            <option <?php if ($anps_category_id == $cat->term_id) {
                echo 'selected="selected"';
            } ?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
        <?php
        }
        echo "</select>";
        ?>
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['anps_number_fields'] = $new_instance['anps_number_fields'];
        $instance['anps_category_id'] = $new_instance['anps_category_id'];
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        global $wpdb;
        $anps_number_fields = $instance['anps_number_fields'];
        $anps_category_id = $instance['anps_category_id'];

        $new_query = new WP_Query();
        $paged = '';
        $new_query->query('cat=' . $anps_category_id . '&paged=' . $paged . '&posts_per_page=' . 1 . '&order="DESC"');

        echo $before_widget;
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);


        if (!empty($title))
            echo $before_title . $title . $after_title;;
        ?>

        <div class="quotes">
            <?php
            $i = 0;
            $count = $anps_number_fields;
            $new_query->query('post_type=testimonials&paged=' . $paged . '&posts_per_page=' . $count . '&order="DESC"');
            while ($new_query->have_posts()) : $new_query->the_post();
                ?>
                <article <?php if ($i++ == 0) {
                echo 'class="quote-selected"';
            } ?> >
                    <?php the_content(); ?>
                    <span><?php the_title(); ?></span>
                </article>         
        <?php endwhile;
        ?>
        </div>
        <?php
        echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'return register_widget("AnpsQuotes");'));