<?php
/* Get all widgets */
function get_all_widgets() {
    $dir = get_template_directory() . '/anps-framework/widgets';
    if ($handle = opendir($dir)) {
        $arr = array();
        // Get all files and store it to array
        while (false !== ($entry = readdir($handle))) {
            $arr[] = $entry;
        }
        closedir($handle); 
      
        /* Remove widgets, ., .. */
        unset($arr[remove_widget('widgets.php', $arr)], $arr[remove_widget('.', $arr)], $arr[remove_widget('..', $arr)]);

        return $arr;
    }
}

/* Remove widget function */
function remove_widget($name, $arr) {
    return array_search($name, $arr);
}

/* Include all widgets */ 
foreach(get_all_widgets() as $item) {
    include_once get_template_directory() . '/anps-framework/widgets/'.$item;
} 

/** Register sidebars by running azul_widgets_init() on the widgets_init hook. */
add_action('widgets_init', 'anps_widgets_init');
function anps_widgets_init() {
    // Area 1, located at the top of the sidebar.
    register_sidebar(array(
        'name' => __('Sidebar', 'azul'),
        'id' => 'primary-widget-area',
        'description' => __('The primary widget area', 'azul'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Secondary Sidebar', 'azul'),
        'id' => 'secondary-widget-area',
        'description' => __('Secondary widget area', 'azul'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Area 3, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('First Footer Column', 'azul'),
        'id' => 'first-footer-widget-area',
        'description' => __('The first footer widget area', 'azul'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Area 4, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Second Footer Column', 'azul'),
        'id' => 'second-footer-widget-area',
        'description' => __('The second footer widget area', 'azul'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Area 5, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Third Footer Column', 'azul'),
        'id' => 'third-footer-widget-area',
        'description' => __('The third footer widget area', 'azul'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Area 6, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Fourth Footer Column', 'azul'),
        'id' => 'fourth-footer-widget-area',
        'description' => __('The fourth footer widget area', 'azul'),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

















