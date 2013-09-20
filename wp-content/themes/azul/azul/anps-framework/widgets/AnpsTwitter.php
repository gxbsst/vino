<?php
class AnpsTwitter extends WP_Widget {
    
    protected $data;
    
    public function __construct() {
        parent::__construct(
                'AnpsTwitter',
		'Anps -  Twitter', 
		array( 'description' => __( 'Displays your Twitter feed', 'azul' ), ) 
	);
        $this->data = get_option("anps_social_info"); 
    }
    
    function form($instance) {  
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

            $title = $instance['title'];
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

    Your Twitter account: <strong> <?php echo str_replace("http://twitter.com/","",str_replace("https://twitter.com/","",$this->data['twitter'])); ?> </strong>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    function widget($args, $instance) { 
        extract($args, EXTR_SKIP);
        $title = $instance['title'];
        echo $before_widget;

        if (!empty($title))
        echo $before_title . $title . $after_title;

        $root = get_stylesheet_directory_uri() . "/js/";
        wp_enqueue_script("AnpsTwitter", $root . "jquery.anps-twitter.js", array('jquery'));
        ?>
        <span class="none" id="anps-twitter-acc" data-acc="<?php echo str_replace("http://twitter.com/","",str_replace("https://twitter.com/","",$this->data['twitter'])); ?>"></span>
            <script type='text/javascript'>
                /*jQuery(function($){
                    $(".tweet").tweet({
                        username: "<?php echo str_replace("http://twitter.com/","",str_replace("https://twitter.com/","",$this->data['twitter'])); ?>",
                        template: "{user}{join} {text}{time}", 
                        join_text: "auto",
                        avatar_size: 0,
                        count: 2,
                        auto_join_text_default: " ", 
                        auto_join_text_ed: " ",
                        auto_join_text_ing: " ",
                        auto_join_text_reply: " ",
                        auto_join_text_url: "",
                        loading_text: "loading tweets..."
                    });

                });*/
            </script>        

            <div class="tweet"></div>

        <?php

            echo $after_widget;
        }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("AnpsTwitter");') );