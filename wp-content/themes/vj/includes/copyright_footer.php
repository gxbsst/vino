<div id="copyright-footer">
    <div id="copyright-footer-wrapper" class="container">   

        <div id="copyright-footer-left"> 
                <?php 
                    global $options_data; 
                    global $social_data; 
                    unset($social_data['email'], $social_data['google_analytics']);               
                    echo $options_data['copyright']; 
                ?>
        </div>

     <!--    <div id="copyright-footer-right">
            <span><?php _e("socialise", "azul"); ?> - </span>
                        
                        <?php 
                        if($social_data!='') :
                            foreach($social_data as $key=>$item) : 
                                if($item!='') : ?>
                            <a href="<?php echo $item; ?>" class="<?php echo $key;?>"></a>
                            <?php endif;
                            endforeach; 
                        endif;?>
        </div>  
 -->
    </div>  
</div>

