<?php
include_once 'classes/Options.php';

$social_data = $options->get_social();
if (isset($_GET['save_social']))
  $options->save_social(); 
?>
<form action="themes.php?page=theme_options&sub_page=options_social_accounts&save_social" method="post">   
    <div class="content-top"><input type="submit" value="<?php _e("Save all changes", "azul"); ?>" /><div class="clear"></div></div>
    <div class="content-inner">
        <!-- Social accounts data -->
        <h3><?php _e("Social accounts:", "azul"); ?></h3>

        <p><?php _e("Here you can set up all of your social accounts, which will appear in the footer of the page. You do not need to include all of them.", "azul"); ?></p>
        <!-- Email -->
        <div class="input">
            <label for="email"><?php _e("Email", "azul"); ?></label>
            <input type="text" name="email" value="<?php echo $social_data['email']; ?>" />
        </div>
        <!-- Google analytics -->
        <div class="input">
            <label for="google_analytics">Google analytics</label>
            <input type="text" name="google_analytics" value="<?php echo $social_data['google_analytics']; ?>" />
        </div>
        <!-- Facebook -->
        <div class="input">
            <label for="facebook">Facebook</label>
            <input type="text" name="facebook" value="<?php echo $social_data['facebook']; ?>" />
        </div>
        <!-- Google+ --> 
        <div class="input">
            <label for="google+">Google</label>
            <input type="text" name="google_plus" value="<?php echo $social_data['google_plus']; ?>" />
        </div>
        <!-- Twitter -->
        <div class="input">
            <label for="twitter">Twitter</label>
            <input type="text" name="twitter" value="<?php echo $social_data['twitter']; ?>" />
        </div>
        <!-- LinkedIn -->
        <div class="input">
            <label for="linkedin">LinkedIn</label>
            <input type="text" name="linkedin" value="<?php echo $social_data['linkedin']; ?>" />
        </div>
        <!-- Vimeo -->
        <div class="input">
            <label for="vimeo">Vimeo</label>
            <input type="text" name="vimeo" value="<?php echo $social_data['vimeo']; ?>" />
        </div>
        <!-- Youtube -->
        <div class="input">
            <label for="youtube">Youtube</label>
            <input type="text" name="youtube" value="<?php echo $social_data['youtube']; ?>" />
        </div>
        <!-- Flickr -->
        <div class="input">
            <label for="flickr">Flickr</label>
            <input type="text" name="flickr" value="<?php echo $social_data['flickr']; ?>" />
        </div>
        <!-- Instagram -->
        <div class="input">
            <label for="instagram">Instagram</label>
            <input type="text" name="instagram" value="<?php echo $social_data['instagram']; ?>" />
        </div>
        <!-- END Social accounts data -->
    </div>

    <div class="content-top" style="border-style: solid none; margin-top: 70px">
        <input type="submit" value="<?php _e("Save all changes", "azul"); ?>">
        <div class="clear"></div>
    </div>
</form>