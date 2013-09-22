<?php

/*
 Plugin Name: Tasting Post Type
Plugin URI: http://weixuhong.com
Description: About Tasting
Version: 1.0
Author: Weston(Weixuhong@gmail.com)
Author URI: http://weixuhong.com
 */

class VJ_Tasting_Post_Type {
    public function __construct(){
         $this->register_post_type();
         $this->taxonomies(); 
         $this->metaboxes();
    }

    public function register_post_type(){
        $args = array(
            'labels' => array(
                'name' => '品酒心得',
                'singular_name' => '品酒心得',
                'add_new' => '添加',
                'add_new_item' => '添加新的品酒心得',
                'edit_item' => '编辑',
                'new_item' => '新的品酒心得',
                'view_item' => '浏览',
                'search_item' => '搜索品酒心得',
                'not_found' => '没有品酒心得',
                'not_found_in_trash' => '....no tasting found in trash'
            ),
            'query_var'=> 'tastings',
            'rewrite' => array(
                'slug' => 'tastings/',
            ),
            'public' => true,
            'menu_position' => 3,
            'menu_icon' => admin_url() . 'images/media-button-image.gif',
            'supports' => array(
                'title',
                'thumbnail',
                'excerpt',
                'editor'
//                'custom-fields'
            ),
        );
        register_post_type('vj_tasting', $args);
    }

    public function taxonomies(){
        $taxonomies = array();
        $taxonomies['type'] = array(
            'hierarchical' => true,
            'query_var' => 'tasting_type',
            'rewrite' => array(
                'slug' => 'tastings/type'
            ),
            'labels' => array(
                'name' => '类型',
                'singular_name' => '类型',
                'edit_item' => '编辑',
                'update_item' => '更新',
                'add_new_item' => '添加',
                'new_item_name' => '新的类型',
                'all_items' => '全部类型',
                'search_item' => '搜索类型',
                'popular_items' => 'popular Items',
                'separate_items_with_comments' => 'Separate with commas',
                'add_or_remove_items' => '删除一个类型',
                'choose_from_most_used' => '选择最常用的'
            )
        );

        $taxonomies['address'] = array(
            'hierarchical' => true,
            'query_var' => 'tasting_address',
            'rewrite' => array(
                'slug' => 'tastings/address'
            ),
            'labels' => array(
                'name' => '地址',
                'singular_name' => '地址',
                'edit_item' => '编辑',
                'update_item' => '更新',
                'add_new_item' => '添加',
                'new_item_name' => '新的地址',
                'all_items' => '全部地址',
                'search_item' => '搜索地址',
                'popular_items' => 'popular Items',
                'separate_items_with_comments' => 'Separate with commas',
                'add_or_remove_items' => '删除一个地址',
                'choose_from_most_used' => '选择最常用的'
            )
        );

        $this->register_all_taxonomies($taxonomies);
    }
    public function register_all_taxonomies($taxonomies)
    {
        foreach ($taxonomies as $name => $arr) {
          register_taxonomy($name, array('vj_tasting'), $arr); 
        }
        
    }

    public function metaboxes()
    {
        add_action('add_meta_boxes', function(){
            // css id, 'title', callback function, page, priority,  callback fun arguments
            add_meta_box('vj_tasting_date', '品酒时间', 'tasting_date', 'vj_tasting');
        });

        function tasting_date($post)
        {
            $date = get_post_meta($post->ID, 'vj_tasting_date', true);
            ?>
            <p>
                <label for="vj_tasting_date">品酒时间：</label>
                <input type="text" class="widefat" name="vj_tasting_date" id="vj_tasting_date" value="<?php echo esc_attr($date); ?>" />
            </p>
            <?php
        }
        add_action('save_post', function($id){
            if (isset($_POST['vj_tasting_date'])) {
                update_post_meta(
                    $id,
                    'vj_tasting_date',
                    strip_tags($_POST['vj_tasting_date'])
                );
            }
        });
    }
}

add_action('init', function(){
    new VJ_Tasting_Post_Type();
    include dirname(__FILE__) . '/tasting-post-type-shortcode.php';

});