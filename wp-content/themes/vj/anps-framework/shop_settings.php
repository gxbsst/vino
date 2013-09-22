<?php
include_once 'classes/Options.php';

$page_data = $options->get_shop_setup_data();
if (isset($_GET['save_shop_setup']))
  $options->save_shop_setup();
?>
<form action="themes.php?page=theme_options&sub_page=shop_settings&save_shop_setup" method="post">   
    <div class="content-top"><input type="submit" value="<?php _e("Save all changes", "azul"); ?>" /><div class="clear"></div></div>
    <div class="content-inner">
        <!-- Page setup -->
        <h3><?php _e("Shop setup:", "azul"); ?></h3>

        <!-- Shop number of columns -->
        <div class="input"> 
            <label for="shop_pagination"><?php _e("Number of columns", "azul"); ?></label>
            <?php $pag_type = array('2 column', '3 column', '4 column'); ?>
            <select name="shop_pagination">
                <?php
                foreach ($pag_type as $item) :
                    if ($page_data['shop_pagination'] == $item) 
                        $selected = 'selected="selected"';
                    else 
                        $selected = '';
                    ?>
                    <option value="<?php echo $item; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Shop number of products -->
        <div class="input"> <?php if (!isset($page_data['shop_per_page'])) $page_data['shop_per_page'] = ''; ?>
            <label for="shop_per_page"><?php _e("Products per page", "azul"); ?></label>
            <input type="text" name="shop_per_page" value="<?php echo $page_data['shop_per_page']; ?>"/>
        </div>

        <!-- Sale type -->
        <?php isset($page_data['sale_type']) && $page_data['sale_type'] == 'on' ? $checked = 'checked' : $checked = ''; ?>
        <div class="input"> 
            <label for="sale_type"><?php _e("Show percentages instead of text for the Sale stickers", "azul"); ?></label>
            <input style="margin-left: 74px;" type="checkbox" name="sale_type" <?php echo $checked; ?> />
        </div>

        <!-- Show related products -->
        <?php isset($page_data['related_show']) && $page_data['related_show'] == 'on' ? $checked = 'checked' : $checked = ''; ?>
        <div class="input"> 
            <label for="related_show"><?php _e("Show related products on single product pages", "azul"); ?></label>
            <input style="margin-left: 74px;" type="checkbox" name="related_show" <?php echo $checked; ?> />
        </div>

        <!-- Hide cart in header -->
        <?php isset($page_data['hide_cart']) && $page_data['hide_cart'] == 'on' ? $checked = 'checked' : $checked = ''; ?>
        <div class="input"> 
            <label for="hide_cart"><?php _e("Hide cart in header", "azul"); ?></label>
            <input style="margin-left: 74px;" type="checkbox" name="hide_cart" <?php echo $checked; ?> />
        </div>

        <hr>

        <!-- Notifications -->
        <h3><?php _e("Site Notice", "azul"); ?></h3>

        <input name="notification_changes" type="hidden" value="<?php echo $page_data['notification_changes']; ?>" />

        <div class="input">

            <label for="notice-active"><?php _e("Active", "azul"); ?></label>
            <input style="margin-left: 74px;" type="checkbox" name="notice-active" <?php if ( $page_data['notice-active'] && $page_data['notice-active'] == "on" ) { echo "checked"; } ?> />

        </div>

        <br><br>

        <div class="input">

            <label for="notice" style="margin-top: 0px"><?php _e("Content", "azul"); ?></label>

            <div class="tiny"><?php wp_editor( $page_data['notice'], "notice", array( 'tinymce' => false ) ); ?></div>

        </div>

        <hr />
        <!-- END Page setup -->
    </div>

    <div class="content-top" style="border-style: solid none; margin-top: 70px">
        <input type="submit" value="<?php _e("Save all changes", "azul"); ?>">
        <div class="clear"></div>
    </div>
</form>