<?php include_once 'classes/Contact.php';
if (isset($_GET['save_contact']))
    $contact->save_data();

?>

<form action="themes.php?page=theme_options&sub_page=contact_form&save_contact" method="post">

    <div class="content-top"><input type="submit" value="<?php _e("Save all changes", "azul"); ?>" /><div class="clear"></div></div>

    <div class="content-inner">

        <h3><?php _e("Contact form", "azul"); ?></h3>
        <p><?php _e("Add fields to your contact form and then call the contact field via shortcodes.", "azul"); ?></p>

<?php if(!$contact->get_data()) : ?>
        <div class="form_fields_wrapper">
            <div class="form_fields" id="form_fields_1">
                <!-- LABEL -->
                <div class="input" style="display: none">
                    <label for="label_1">Label</label>
                    <input type="text" name="label_1" />
                </div>
                <!-- END LABEL -->
                <!-- INPUT TYPE -->
                <div class="input">
                    <label for="input_type_1">Input type</label>
                    <select class="contact-change" name="input_type_1">
                        <?php foreach ($contact->contact_options() as $key => $value) : ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option> 
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- END INPUT TYPE -->
                <!-- REQUIRED -->
                <div class="input" id="required">
                    <label for="is_required_1">Required</label> 
                    <input type="checkbox" name="is_required_1" />
                </div>
                <!-- END REQUIRED -->
                <div class="clear"></div>
                <!-- PLACEHOLDER -->
                <div class="input">
                    <label for="placeholder_1">Placeholder</label>
                    <input type="text" name="placeholder_1" />
                </div>
                <!-- END PLACEHOLDER -->
                <!-- VALIDATION -->
                <div class="input validation contact-validation">
                    <label for="validation_1">Validation</label>
                    <select name="validation_1">
                        <?php foreach ($contact->validation_options() as $key => $value) : ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option> 
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- END VALIDATION -->
                <!-- TEXTAREA -->
                        <div class="input label-place-val contact-textarea" style="display: none">
                            <label for="textarea_1">Textarea</label>
                            <textarea name="textarea_1" id="textarea_1"></textarea>
                        </div>
                        <!-- END TEXTAREA -->
                        <!-- PUBLIC KEY -->
                        <div class="input label-place-val contact-public" style="display: none">
                            <label for="public_key_1">Public key</label>
                            <input type="text" name="public_key_1" />
                        </div>
                        <!-- END PUBLIC KEY -->
                        <!-- PRIVATE KEY -->
                        <div class="input label-place-val contact-private" style="display: none">
                            <label for="private_key_1">Private key</label>
                            <input type="text" name="private_key_1" />
                        </div>
                        <!-- END PRIVATE KEY -->
                <div class="remove-add"><input type="button" class="remove" value="-"><input class="add" type="button" value="+"></div>
            </div>    
    </div>
<?php else : ?>
            <div class="form_fields_wrapper">

                <?php $i = 0;
                      foreach ($contact->get_data() as $data) : $i++; 
                ?>

                    <div class="form_fields" id="form_fields_<?php echo $i; ?>">                        
                        <!-- LABEL -->
                        <div class="input" style="display: none"  <?php if($data['input_type']=='captcha') echo 'style="display: none"' ?>>
                            <label for="label_<?php echo $i; ?>">Label</label>
                            <input type="text" name="label_<?php echo $i; ?>" value="<?php echo $data['label']; ?>"/>
                        </div>
                        <!-- END LABEL -->
                        <!-- INPUT TYPE -->
                        <div class="input">
                            <label class="left_label" for="input_type_<?php echo $i; ?>">Input type</label>
                            <select class="input-type small_input" name="input_type_<?php echo $i; ?>">
                                <?php                                  
                                foreach ($contact->contact_options() as $key => $value) :                                
                                    if ($data['input_type'] == $key) 
                                        $selected = 'selected="selected"';
                                    else
                                        $selected = '';
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option> 
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- END INPUT TYPE -->
                        <!-- REQUIRED -->
                        <div class="input contact-required" <?php if($data['input_type']=='captcha') echo 'style="display: none"'; ?>>
                            <?php
                            if ( !isset($data['is_required']))
                                $checked = '';
                            elseif ($data['is_required'] == 'on')
                                $checked = 'checked';
                            else
                                $checked = '';
                            ?>
                            <label class="left_label" for="is_required_<?php echo $i; ?>">Required</label> 
                            <input class="small_input" type="checkbox" name="is_required_<?php echo $i; ?>" <?php echo $checked; ?>/>
                        </div>
                        <!-- END REQUIRED -->
                        <!-- PLACEHOLDER -->
                        <div class="input label-place-val contact-placeholder" <?php if($data['input_type']=='captcha' || $data['input_type']=='dropdown' || $data['input_type']=='checkbox' || $data['input_type']=='radio') echo 'style="display: none"'; ?>>
                            <label for="placeholder_<?php echo $i; ?>">Placeholder</label>
                            <input type="text" name="placeholder_<?php echo $i; ?>" value="<?php echo $data['placeholder']; ?>" />
                        </div>
                        <!-- END PLACEHOLDER -->
                        <!-- VALIDATION -->
                        <div class="input validation contact-validation" <?php if($data['input_type']=='captcha' || $data['input_type']=='dropdown' || $data['input_type']=='checkbox' || $data['input_type']=='radio') echo 'style="display: none"'; ?>>
                            <label class="left_label" for="validation_<?php echo $i; ?>">Validation</label>
                            <select class="small_input" name="validation_<?php echo $i; ?>">
                                <?php foreach ($contact->validation_options() as $key => $value) :
                                    if ($data['validation'] == $key) 
                                        $selected = 'selected="selected"';
                                    else 
                                        $selected = '';                                  
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option> 
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- END VALIDATION -->
                        <!-- TEXTAREA -->
                        <div class="input label-place-val contact-textarea" <?php if($data['input_type']=='captcha' || $data['input_type']=='textarea' || $data['input_type']=='text') echo 'style="display: none"'; ?>>
                            <label for="textarea_<?php echo $i; ?>">Textarea</label>
                            <textarea name="textarea_<?php echo $i; ?>" id="textarea_<?php echo $i; ?>"><?php echo $data['textarea']; ?></textarea>
                        </div>
                        <!-- END TEXTAREA -->
                        <!-- PUBLIC KEY -->
                        <div class="input label-place-val contact-public" <?php if($data['input_type']!='captcha') echo 'style="display: none"'; ?>>
                            <label for="public_key_<?php echo $i; ?>">Public key</label>
                            <input type="text" name="public_key_<?php echo $i; ?>" value="<?php echo $data['public_key']; ?>" />
                        </div>
                        <!-- END PUBLIC KEY -->
                        <!-- PRIVATE KEY -->
                        <div class="input label-place-val contact-private" <?php if($data['input_type']!='captcha') echo 'style="display: none"'; ?>>
                            <label for="private_key_<?php echo $i; ?>">Private key</label>
                            <input type="text" name="private_key_<?php echo $i; ?>" value="<?php echo $data['private_key']; ?>" />
                        </div>
                        <!-- END PRIVATE KEY -->
                        <div class="remove-add"><input type="button" class="remove" value="-"><input class="add" type="button" value="+"></div>

                    </div>

    <?php endforeach; ?>

            </div>

<?php endif; ?>

    </div>
    <div class="content-top" style="border-style: solid none; margin-top: 50px">
        <input type="submit" value="<?php _e("Save all changes", "azul"); ?>">
        <div class="clear"></div>
    </div>
</form>