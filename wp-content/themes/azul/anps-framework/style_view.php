<?php include_once 'classes/Style.php'; 
/* Save form */
if(isset($_GET['save_style']))
    $style->save();

/* get all fonts */
$fonts = $style->all_fonts(); 
?>
<div class="content">
    <form action="themes.php?page=theme_options&save_style" method="post">
        <div class="content-top">
            <input type="submit" value="<?php _e("Save all changes", "azul"); ?>">
            <div class="clear"></div>
        </div>
        <div class="content-inner">
            <h3><?php _e("Font family", "azul"); ?></h3>
            <div class="input">
                <label for="font_type_1">Font type 1</label>                    
                <select name="font_type_1" id="font_type_1">
                    <?php foreach($fonts as $name=>$value) : ?>
                    <optgroup label="<?php echo $name; ?>">
                    <?php foreach ($value as $font) : 
                            $selected = '';
                            if ($font['value'] == get_option('font_type_1', 'Arial, Helvetica, sans-serif'))
                                $selected = 'selected="selected"';                                
                            ?>
                            <option value="<?php echo $font['value']."|".$name; ?>" <?php echo $selected; ?>><?php echo $font['name']; ?></option>
                    <?php endforeach; ?>
                    </optgroup>  
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input">
                <label for="font_type_2"><?php _e("Font type 2", "azul"); ?></label>
                <select name="font_type_2" id="font_type_2">
                    <?php foreach($fonts as $name=>$value) : ?>
                    <optgroup label="<?php echo $name; ?>">
                    <?php foreach ($value as $font) :
                            $selected = '';
                            if ($font['value'] == get_option('font_type_2', 'Arial, Helvetica, sans-serif'))
                                $selected = 'selected="selected"';
    
                            ?>
                            <option value="<?php echo $font['value']."|".$name; ?>" <?php echo $selected; ?>><?php echo $font['name']; ?></option>
                    <?php endforeach; ?>
                    </optgroup>  
                    <?php endforeach; ?>
                </select>
            </div>
            <br /><hr /><br />
            <h3>Heading sizes</h3>
            <div class="input">
                <label for="heading1"><?php _e("Heading 1", "azul"); ?></label>
                <input style="width: 40px; text-align: center" type="text" name="heading1" value="<?php echo get_option('heading1', '30'); ?>" id="heading1" />&nbsp; px
            </div>
            <div class="input">
                <label for="heading2"><?php _e("Heading 2", "azul"); ?></label>
                <input style="width: 40px; text-align: center" type="text" name="heading2" value="<?php echo get_option('heading2', '24'); ?>" id="heading2" />&nbsp; px
            </div>
            <div class="input">
                <label for="heading3"><?php _e("Heading 3", "azul"); ?></label>
                <input style="width: 40px; text-align: center" type="text" name="heading3" value="<?php echo get_option('heading3', '20'); ?>" id="heading3" />&nbsp; px
            </div>
            <div class="input">
                <label for="heading4"><?php _e("Heading 4", "azul"); ?></label>
                <input style="width: 40px; text-align: center" type="text" name="heading4" value="<?php echo get_option('heading4', '14'); ?>" id="heading4" />&nbsp; px
            </div>
            <div class="input">
                <label for="heading5"><?php _e("Heading 5", "azul"); ?></label>
                <input style="width: 40px; text-align: center" type="text" name="heading5" value="<?php echo get_option('heading5', '12'); ?>" id="heading5" />&nbsp; px
            </div>
            <br /><hr /><br />
            <h3><?php _e("Predefined color Scheme", "azul"); ?></h3>
            <p><?php _e("Selecting one of this schemes will import the predefined colors below, which you can then edit as you like.", "azul"); ?></p>
            <br /><br />
            <select name="predefined_colors" id="predefined_colors">
                <option></option>
                <option value="default">Default</option>
                <option value="orange">Orange</option>
                <option value="blue">Blue</option>
                <option value="red">Red</option>
                <option value="grey">Grey</option>
                <option value="violet">Violet</option>
                <option value="brown">Brown</option>
                <option value="yellow">Yellow</option>
                <option value="pink">Pink</option>
                <option value="light_green">Light green</option>
            </select>
            <br /><br /><br /><hr />
            <h3><?php _e("Main theme colors", "azul"); ?></h3>
            <div class="input">
                <label for="primary_color"><?php _e("Primary color", "azul"); ?></label>
                <input data-value="<?php echo get_option('primary_color', '#69b200'); ?>" readonly style="background: <?php echo get_option('primary_color', '#69b200'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="primary_color" value="<?php echo get_option('primary_color', '#69b200'); ?>" id="primary_color" />
            </div>
            <div class="input">
                <label for="secondary_color"><?php _e("Secondary color", "azul"); ?></label>
                <input data-value="<?php echo get_option('secondary_color', '#ecf3e3'); ?>" readonly style="background: <?php echo get_option('secondary_color', '#ecf3e3'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="secondary_color" value="<?php echo get_option('secondary_color', '#ecf3e3'); ?>" id="secondary_color" />
            </div>
            <div class="input">
                <label for="content_background_color"><?php _e("Content Background color", "azul"); ?></label>
                <input data-value="<?php echo get_option('content_background_color', '#fff'); ?>" readonly style="background: <?php echo get_option('content_background_color', '#fff'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="content_background_color" value="<?php echo get_option('content_background_color', '#fff'); ?>" id="content_background_color" />
            </div>            
            <div class="input">
                <label for="text_color"><?php _e("Text color", "azul"); ?></label>
                <input data-value="<?php echo get_option('text_color', '#727272'); ?>" readonly style="background: <?php echo get_option('text_color', '#727272'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="text_color" value="<?php echo get_option('text_color', '#727272'); ?>" id="text_color" />
            </div>
            <div class="input">
                <label for="headings_color"><?php _e("Headings color", "azul"); ?></label>
                <input data-value="<?php echo get_option('headings_color', '#000'); ?>" readonly style="background: <?php echo get_option('headings_color', '#000'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="headings_color" value="<?php echo get_option('headings_color', '#000'); ?>" id="headings_color" />
            </div>
            <br /><hr /><br />
            <h3>Footer colors</h3>
            <div class="input">
                <label for="primary_color"><?php _e("Copyright background color", "azul"); ?></label>
                <input data-value="<?php echo get_option('copyright_back_color', '#5c9b00'); ?>" readonly style="background: <?php echo get_option('copyright_back_color', '#5c9b00'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="copyright_back_color" value="<?php echo get_option('copyright_back_color', '#5c9b00'); ?>" id="text_color" />
            </div>
            <div class="input">
                <label for="primary_color"><?php _e("Footer text color", "azul"); ?></label>
                <input data-value="<?php echo get_option('copyright_text_color', '#d7e4cb'); ?>" readonly style="background: <?php echo get_option('copyright_text_color', '#d7e4cb'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="copyright_text_color" value="<?php echo get_option('copyright_text_color', '#d7e4cb'); ?>" id="text_color" />
            </div>
            <br /><hr /><br />
            <h3><?php _e("Main navigation colors", "azul"); ?></h3>
            <div class="input">
                <label for="menu_text_color"><?php _e("Text color", "azul"); ?></label>
                <input data-value="<?php echo get_option('menu_text_color', '#000'); ?>" readonly style="background: <?php echo get_option('menu_text_color', '#000'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="menu_text_color" value="<?php echo get_option('menu_text_color', '#000'); ?>" id="text_color" />
            </div>
            <div class="input">
                <label for="menu_text_color_hover"><?php _e("Text color hover", "azul"); ?></label>
                <input data-value="<?php echo get_option('menu_text_color_hover', '#fff'); ?>" readonly style="background: <?php echo get_option('menu_text_color_hover', '#fff'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="menu_text_color_hover" value="<?php echo get_option('menu_text_color_hover', '#fff'); ?>" id="text_color" />
            </div>
            <div class="input">
                <label for="menu_hover_back"><?php _e("Menu hover background color", "azul"); ?></label>
                <p style="margin-top: -20px; margin-bottom: 20px"><?php _e("This color is also used for pricing tables price background color.", "azul"); ?></p>
                <input data-value="<?php echo get_option('menu_hover_back', '#2a2a2a'); ?>" readonly style="background: <?php echo get_option('menu_hover_back', '#2a2a2a'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="menu_hover_back" value="<?php echo get_option('menu_hover_back', '#2a2a2a'); ?>" id="menu_hover_back" />
            </div>
            <div class="input">
                <label for="submenu_divider_color"><?php _e("Submenu divider color", "azul"); ?></label>
                <input data-value="<?php echo get_option('submenu_divider_color', '#414141'); ?>" readonly style="background: <?php echo get_option('submenu_divider_color', '#414141'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="submenu_divider_color" value="<?php echo get_option('submenu_divider_color', '#414141'); ?>" id="submenu_divider_color" />
            </div>
            <br /><hr /><br />
            <h3><?php _e("Recent / Popular / Comments box", "azul"); ?></h3>
            <div class="input">
                <label for="widget_recent_popular_comments_box_hover"><?php _e("Hover background color", "azul"); ?></label>
                <input data-value="<?php echo get_option('widget_recent_popular_comments_box_hover', '#7cd200'); ?>" readonly style="background: <?php echo get_option('widget_recent_popular_comments_box_hover', '#7cd200'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="widget_recent_popular_comments_box_hover" value="<?php echo get_option('widget_recent_popular_comments_box_hover', '#7cd200'); ?>" id="widget_recent_popular_comments_box_hover" />
            </div>
            <br /><hr /><br />
            <h3><?php _e("Form styles", "azul"); ?></h3>
            <div class="input">
                <label for="input_fields_background_color"><?php _e("Input fields background color", "azul"); ?></label>
                <input data-value="<?php echo get_option('input_fields_background_color', '#ededed'); ?>" readonly style="background: <?php echo get_option('input_fields_background_color', '#ededed'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="input_fields_background_color" value="<?php echo get_option('input_fields_background_color', '#ededed'); ?>" id="input_fields_background_color" />
            </div>
            <br /><hr /><br />
            <h3><?php _e("Button styles", "azul"); ?></h3>
            <br /><br />
            <div class="input">
                <label for="button_style_2_font_color"><?php _e("Button style 2 text color", "azul"); ?></label>
                <input data-value="<?php echo get_option('button_style_2_font_color', '#fff'); ?>" readonly style="background: <?php echo get_option('button_style_2_font_color', '#fff'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="button_style_2_font_color" value="<?php echo get_option('button_style_2_font_color', '#fff'); ?>" id="button_style_2_font_color" />
            </div>     
            <div class="input">
                <label for="button_style_2_background_color"><?php _e("Button style 2 background color", "azul"); ?></label>
                <input data-value="<?php echo get_option('button_style_2_background_color', '#414141'); ?>" readonly style="background: <?php echo get_option('button_style_2_background_color', '#414141'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="button_style_2_background_color" value="<?php echo get_option('button_style_2_background_color', '#414141'); ?>" id="button_style_2_background_color" />
            </div>             
            <br /><br />
            <div class="input">
                <label for="button_style_3_font_color"><?php _e("Button style 3 text color", "azul"); ?></label>
                <input data-value="<?php echo get_option('button_style_3_font_color', '#666'); ?>" readonly style="background: <?php echo get_option('button_style_3_font_color', '#666'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="button_style_3_font_color" value="<?php echo get_option('button_style_3_font_color', '#666'); ?>" id="button_style_3_font_color" />
            </div>
            <div class="input">
                <label for="button_style_3_background_color"><?php _e("Button style 3 background color", "azul"); ?></label>
                <input data-value="<?php echo get_option('button_style_3_background_color', '#dadada'); ?>" readonly style="background: <?php echo get_option('button_style_3_background_color', '#dadada'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="button_style_3_background_color" value="<?php echo get_option('button_style_3_background_color', '#dadada'); ?>" id="button_style_3_background_color" />
            </div>
            <br/><br/><br/><br/><br/>
        </div>
        <div class="content-top" style="border-style: solid none">
            <input type="submit" value="<?php _e("Save all changes", "azul"); ?>">
            <div class="clear"></div>
        </div>
    </form>
    <div class="clear"></div>    
</div>