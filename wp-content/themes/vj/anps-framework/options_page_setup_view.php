<?php
include_once 'classes/Options.php';

$page_data = $options->get_page_setup_data();
if (isset($_GET['save_page_setup']))
  $options->save_page_setup();
?>
<form action="themes.php?page=theme_options&sub_page=options_page_setup&save_page_setup" method="post">   
    <div class="content-top"><input type="submit" value="<?php _e("Save all changes", "azul"); ?>" /><div class="clear"></div></div>
    <div class="content-inner">
        <!-- Page setup -->
        <h3><?php _e("Page setup:", "azul"); ?></h3>
        <!-- Error page -->
        <div class="input">
            <label for="error_page"><?php _e("404 error page", "azul"); ?></label>
            <select name="error_page">
                <option value="0">*** Select ***</option>
                <?php
                $pages = get_pages();
                foreach ($pages as $item) :
                    if ($page_data['error_page'] == $item->ID)
                        $selected = 'selected="selected"';
                    else
                        $selected = '';
                    ?>
                    <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Front page -->
        <div class="input">
            <label for="front_page"><?php _e("Front page", "azul"); ?></label>
            <select name="front_page">
                <option value="0">*** Select ***</option>
                <?php $pages = get_pages();
                foreach ($pages as $item) :
                    if (get_option('page_on_front') == $item->ID) 
                        $selected = 'selected="selected"';
                    else 
                        $selected = '';
                    ?>
                    <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <hr/>
        <!-- Blog page -->
        <div class="input">
            <label for="blog_page"><?php _e("Blog page", "azul"); ?></label>
            <select name="blog_page">
                <option value="0">*** Select ***</option>
                <?php foreach ($pages as $item) :
                    if ($page_data['blog_page'] == $item->ID) 
                        $selected = 'selected="selected"';
                    else
                        $selected = '';
                    ?>
                    <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 
                <?php endforeach; ?>
            </select> 
        </div>
        <!-- Blog layout -->
        <div class="input"> 
            <label for="blog_type"><?php _e("Blog layout", "azul"); ?></label>
            <?php $pag_type = array('Sidebar layout', 'Full view', '1 column', '2 column', '3 column', '4 column'); ?>
            <select name="blog_type">
                <?php foreach ($pag_type as $item) :
                    if ($page_data['blog_type'] == $item) 
                        $selected = 'selected="selected"';
                    else 
                        $selected = '';
                    ?>
                    <option value="<?php echo $item; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <hr>
        <!-- Portfolio page -->
        <div class="input">
            <label for="portfolio_page"><?php _e("Portfolio page", "azul"); ?></label>
            <select name="portfolio_page">
                <option value="0">*** Select ***</option>
                <?php foreach ($pages as $item) :
                    if ($page_data['portfolio_page'] == $item->ID) 
                        $selected = 'selected="selected"';
                    else 
                        $selected = '';
                    ?>
                    <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Portfolio number of columns -->
        <div class="input"> 
            <label for="pagination_type"><?php _e("Number of columns", "azul"); ?></label>
            <?php $pag_type = array('1 column', '2 column', '3 column', '4 column'); ?>
            <select name="pagination_type">
                <?php
                foreach ($pag_type as $item) :
                    if ($page_data['pagination_type'] == $item) 
                        $selected = 'selected="selected"';
                    else 
                        $selected = '';
                    ?>
                    <option value="<?php echo $item; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Filter pagination -->
        <?php isset($page_data['filter_pag']) && $page_data['filter_pag'] == 'on' ? $checked = 'checked' : $checked = ''; ?>
        <div class="input"> 
            <label for="filter_pag"><?php _e("Filter", "azul"); ?></label>
            <input style="margin-left: 74px;" type="checkbox" name="filter_pag" <?php echo $checked; ?> />
        </div>
        <!-- Limit items -->
        <div class="input"> <?php if (!isset($page_data['limit_items'])) $page_data['limit_items'] = ''; ?>
            <label for="limit_items"><?php _e("Limit items", "azul"); ?></label>
            <input type="text" name="limit_items" value="<?php echo $page_data['limit_items']; ?>"/>
        </div>
        <!-- END Page setup -->
    </div>

    <div class="content-top" style="border-style: solid none; margin-top: 70px">
        <input type="submit" value="<?php _e("Save all changes", "azul"); ?>">
        <div class="clear"></div>
    </div>
</form>