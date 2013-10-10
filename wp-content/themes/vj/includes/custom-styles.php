<?php 
    header("Content-type: text/css; charset: UTF-8"); 
    require_once('../../../../wp-load.php');
?>
<?php 
function getExtCustomFonts($font) {
    $dir = get_template_directory().'/fonts'; 
        if ($handle = opendir($dir)) { 
            $arr = array();
            // Get all files and store it to array
            while(false !== ($entry = readdir($handle))) {
                $explode_font=explode('.',$entry);
                if(strtolower($font)==strtolower($explode_font[0]))
                    $arr[] = $entry;
            }          
            closedir($handle); 
            // Remove . and ..
            unset($arr['.'], $arr['..']); 
            return $arr;
        }
}

$fonts = "Museo_Slab_500";
$type = 1;

$fonts2 = "Arial, Helvetica, sans-serif";
$type2 = 0;

switch(get_option('font_source_1')) {
    case('System fonts') :
        $fonts = urldecode(get_option('font_type_1'));
        $type = 0;
        break;
    case('Custom fonts') :
        //$fonts = get_template_directory_uri()."/fonts/".getExtCustomFonts(get_option('font_type_1'));
        $fonts = get_option('font_type_1');
        $type = 1;
        break;
    case('Google fonts') :
        $fonts = get_option('font_type_1');
        $type = 2;
        break;
}

switch(get_option('font_source_2')) {
    case('System fonts') :
        $fonts2 = urldecode(get_option('font_type_2'));
        $type2 = 0;
        break;
    case('Custom fonts') :
        $fonts2 = get_option('font_type_2');
        $type2 = 1;
        break;
    case('Google fonts') :
        $fonts2 = get_option('font_type_2');
        $type2 = 2;
        break;
}

?>
<?php if($type==1) : ?>

	@font-face {
		font-family: '<?php echo $fonts ?>';
		src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $fonts; ?>.eot');
		src: <?php foreach(getExtCustomFonts($fonts) as $item) : ?> 
                    <?php $explode_item = explode(".", $item);                     
                    if($explode_item[1]=='eot') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.eot?#iefix') format('embedded-opentype'),
                    <?php endif; 
                    if($explode_item[1]=='woff') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.woff') format('woff'),
                    <?php endif; 
                    if($explode_item[1]=='ttf') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.ttf') format('truetype');
                <?php endif; 
                endforeach; ?>
	}

<?php endif; ?>
<?php if($type2==1) : ?>

	@font-face {
		font-family: '<?php echo $fonts2 ?>';
		src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $fonts2; ?>.eot');
		src: <?php foreach(getExtCustomFonts($fonts2) as $item) : ?> 
                    <?php $explode_item = explode(".", $item);                     
                    if($explode_item[1]=='eot') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.eot?#iefix') format('embedded-opentype'),
                    <?php endif; 
                    if($explode_item[1]=='woff') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.woff') format('woff'),
                    <?php endif; 
                    if($explode_item[1]=='ttf') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.ttf') format('truetype');
                <?php endif; 
                endforeach; ?>
	}

<?php endif; ?>

<?php

    /* Main theme colors */

    $content_background_color = get_option('content_background_color', '#fff');
    $primary_color = get_option('primary_color', '#1abc9c');
    $secondary_color = get_option('secondary_color', '#daf1ed');
    $headings_color = get_option('headings_color', '#000');
    $main_font_color = get_option('text_color', '#727272');

?>

	/* Main text font size */

	h1 {
		font-size: <?php echo get_option('heading1', '30'); ?>px;
	}

	h2 {
		font-size: <?php echo get_option('heading2', '24'); ?>px;
	}

	h3, .statement-box h2, .upsells h2, .related h2 {
		font-size: <?php echo get_option('heading3', '20'); ?>px;
	}

	h4 {
		font-size: <?php echo get_option('heading4', '14'); ?>px;
	}

	h5 {
		font-size: <?php echo get_option('heading5', '12'); ?>px;
	}
        
    body {
        font-family: <?php echo $fonts2 ?> !important;
    }

	h1, h2, h3, h4, h5, #site-footer .widget-title, blockquote, .btn, #site-nav, .pricing-table-price, .pricing-table-title, 
    .cart_list-wrapper .empty,
    .price_slider_amount,
    .price_slider_amount button,
    .anps-wishlist span,
    .anps-compare span,
    .woo-register-form p,
    #site-nav .megamenu li,
    .order-info,
    .language-switcher-lans a {
		font-family: <?php echo $fonts ?> !important;
		font-weight: 300 !important;
	}

	#site-nav {
		font-size: 13px !important;
	}


    
    /* Headings Color (#000) */

    h1, h2, h3, h4, h5, 
    .breadcrumbs .breadcrumbs-divider, .breadcrumbs a,
    .error-404 h1 {
        color: <?php echo $headings_color; ?>
    }   



    /* Main Font Color (#727272) */

    body {
        color: <?php echo $main_font_color; ?>; 
    }
    

    /* Main Background Color (#fff) */

    #wp-calendar, #wp-calendar th, #wp-calendar td, #wp-calendar caption {
        border-color: <?php echo $content_background_color; ?>;
    }

    #site-wrapper,
    #site-footer #footer-inner-wrapper:after,
    .pagination ul > li > a, .pagination ul > li > span {
        background: <?php echo $content_background_color; ?>;
    }



    /* Main Color (#69b200) */

    #site-wrapper:before,
    #site-nav li .sub-menu .has-sub-menu > a:before, 
    #site-nav li.current-menu-item > a,
    .comments .comment-meta,
    .post .post-title h1, .post .post-date,
    #site-footer,
    #site-footer #footer-inner-wrapper:before,
    #copyright-footer #copyright-footer-wrapper:after,
    .icons-shortcode:before,
    .icons-shortcode .icons-shortcode-left,
    .accordion-group .accordion-heading:after,
    .nav-tabs li a,
    .nav-tabs .active a:before,
    .progress-bar .progres-bar-progress,
    blockquote em,
    .quotebox:before,
    .person h3, .person div,
    .single-post2 .single-post2-content,
    #site-footer #wp-calendar a:hover,
    #wp-calendar caption,
    .pricing-table .pricing-table-column .pricing-table-title,
    .btn, .btn:hover,
    .widget-container .menu > .current_page_item, .widget .menu > .current_page_item,
    .widget-container .menu > .current-menu-parent, .widget .menu > .current-menu-parent,
    #infinite-handle span {
        background: <?php echo $primary_color; ?>;
    }

    a:hover,
    h1 a, h2 a, h3 a, h4 a, h5 a,
    h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover,
    #site-nav li .sub-menu li.current-menu-item > a, #site-nav li .sub-menu a:hover,
    .comments .comment-reply-link,
    #cancel-comment-reply-link,
    .post .post-meta,
    .post .post-meta a,
    .pagination li .current,
    .portfolio-filter .selected-filter,
    .breadcrumbs,
    .icons-shortcode h3,
    blockquote strong,
    #site-footer #wp-calendar a,
    .AnpsMostPopular .date,
    .sidebar .widget_anpsquotes .quotes span,
    .sidebar .widget_categories a:hover, .sidebar .widget_recent_entries a:hover, .sidebar .widget_recent_comments a:hover, .sidebar .widget_archive a:hover, .sidebar .widget_meta a:hover,
    .sidebar .widget_categories li, .sidebar .widget_recent_entries li, .sidebar .widget_recent_comments li, .sidebar .widget_archive li, .sidebar .widget_meta li,
    .tweet a,
    .widget-container ul.menu li li.current-menu-item a, .widget ul.menu li li.current-menu-item a,
    .widget-container ul.menu > li.current-menu-item ul li a:hover, .widget ul.menu > li.current-menu-item ul li a:hover,
    .widget-container ul.menu > li.current-menu-parent ul li a:hover, .widget ul.menu > li.current-menu-parent ul li a:hover,
    .error-404 h1,
    #lang_sel_list.lang_sel_list_vertical a,
    .anps-wishlist span,
    .anps-compare span,
    .language-switcher-lans a:hover {
        color: <?php echo $primary_color; ?>;
    }

    #searchform input[type="submit"], #searchform-header input[type="submit"] {
        background:  url(../images/icons/search_icon.png) center center no-repeat;
        background-color: <?php echo $primary_color; ?>;
    }

    #site-footer #wp-calendar, #site-footer #wp-calendar th, #site-footer #wp-calendar td, #site-footer #wp-calendar caption {
        border-color: <?php echo $primary_color; ?>;
    }

    .sidebar .textwidget:before {
        background: url(../images/icons/widget_text.png) no-repeat center;
        background-color: <?php echo $primary_color; ?>;
    }
    
    .sidebar .tweet:before {
        background: url(../images/icons/widget_twitter.png) no-repeat center;
        background-color: <?php echo $primary_color; ?>;
    }

    .sidebar .widget_anpsquotes .quotes:before {
        background: url(../images/icons/widget_quote.png) no-repeat center;
        background-color: <?php echo $primary_color; ?>;  
    }

    .gallery-hover {
        background: url(../images/icons/search_icon.png) no-repeat center;
        background-color: <?php echo $primary_color; ?>;
    }

    .widget-container ul.menu li.current_page_item ul, .widget ul.menu li.current_page_item ul,
    .widget-container ul.menu li.current-menu-parent ul, .widget ul.menu li.current-menu-parent ul {
        border: 5px solid <?php echo $primary_color; ?>;
        border-style: none none none solid;
    }   

    .widget-container ul.menu li.current_page_item ul li, .widget ul.menu li.current_page_item ul li,
    .widget-container ul.menu li.current-menu-parent ul li, .widget ul.menu li.current-menu-parent ul li {
        padding: 0 0 0 5px;
    }

    /* Secondary Color (#ecf3e3) */

    .comments .comment,
    .share-this,
    .post .post-meta,
    .portfolio-filter,
    .accordion-group,
    .nav-tabs .active a,
    .nav-tabs .active a:hover,
    
    .progress-bar,
    .quotebox,
    .person p,
    .icons-shortcode,
    .logo-box,
    .portfolio-single.row-fluid .side-content,
    #site-footer #wp-calendar caption,
    #wp-calendar tr,
    #site-footer #wp-calendar a,
    .nav-tabs li.active a,
    .sidebar .quotes, .sidebar .textwidget, .sidebar .tweet,
    .pricing-table .pricing-table-column .pricing-table-row,
    .pricing-table .pricing-table-column .pricing-table-footer,
    .widget-container .menu, .widget .menu,
    .widget-container .menu li, .widget .menu li,
    .widget-container .menu li.current_page_item li, .widget .menu li.current_page_item li,
    #lang_sel_list.lang_sel_list_vertical a  {
        background: <?php echo $secondary_color; ?>;
    }


    /* Primary and Secondary Color (Pricing tables) */

    .pricing-columns-5 .exposed {
        box-shadow: 0 0 0 15px <?php echo $primary_color; ?>, 0 0 0 30px <?php echo $secondary_color; ?>;
    }

    .pricing-columns-4 .exposed {
        box-shadow: 0 0 0 20px <?php echo $primary_color; ?>, 0 0 0 40px <?php echo $secondary_color; ?>;
    }

    .pricing-columns-3 .exposed {
        box-shadow: 0 0 0 30px <?php echo $primary_color; ?>, 0 0 0 60px <?php echo $secondary_color; ?>;
    }

    .pricing-columns-2 .exposed {
        box-shadow: 0 0 0 18px <?php echo $primary_color; ?>, 0 0 0 36px <?php echo $secondary_color; ?>;
    }

    @media (max-width: 979px) and (min-width: 768px) { 
    .article_list_widget .text-outer {
        width: 100%;
    }

        .pricing-columns-5 .exposed {
            box-shadow: 0 0 0 10px <?php echo $primary_color; ?>, 
                        0 0 0 20px <?php echo $secondary_color; ?>; 
        }
        .pricing-columns-4 .exposed {
            box-shadow: 0 0 0 16px <?php echo $primary_color; ?>, 
                        0 0 0 32px <?php echo $secondary_color; ?>;
        }
        .pricing-columns-3 .exposed {
            box-shadow: 0 0 0 20px <?php echo $primary_color; ?>, 
                        0 0 0 40px <?php echo $secondary_color; ?>; 
        }
    }

    @media (max-width: 767px) {
      

        .article_list_widget .text-outer {
            width: 100%;
        }

        .pricing-columns-2 .pricing-table-column.exposed, .pricing-columns-3 .pricing-table-column.exposed, .pricing-columns-4 .pricing-table-column.exposed, .pricing-columns-5 .pricing-table-column.exposed {
            box-shadow: 0 0 0 12px <?php echo $primary_color; ?>, 
                        0 0 0 24px <?php echo $secondary_color; ?>; 
        }
    }

    /* Copyright Background Color (#5c9b00) */

    #copyright-footer,
    #copyright-footer #copyright-footer-wrapper:before {
        background: <?php echo get_option('copyright_back_color', '#17a186'); ?>;
    }



    /* Copyright Font Color (#d7e4cb) */

    #copyright-footer, #site-footer, #site-footer a {
        color: <?php echo get_option('copyright_text_color', '#daf1ed'); ?>;
    }

    

    /* Menu colors */

    #site-nav a {
        color: <?php echo get_option('menu_text_color', '#000'); ?>;
    }

    #site-nav li:hover a {
        color: <?php echo get_option('menu_text_color_hover', '#fff'); ?>;
    }    

    #site-nav li .sub-menu, #site-nav li:hover a, .pricing-table .pricing-table-column .pricing-table-price, #site-nav li .sub-menu li.current-menu-item a, #site-nav li .sub-menu a:hover,
    .language-switcher-lans {
        background: <?php echo get_option('menu_hover_back', '#16a085'); ?>;
    }

    #site-nav li .sub-menu a,
    .language-switcher .language-switcher-lans a {
        border-color: <?php echo get_option('submenu_divider_color', '#414141'); ?>;
    }

    /* Buttons Styles */


    .btn-style2, .btn-style2:hover {
        background: <?php echo get_option('button_style_2_background_color', '#414141'); ?>;
        color: <?php echo get_option('button_style_2_font_color', '#fff'); ?>;
    }

    .btn-style3, .btn-style3:hover {
        background: <?php echo get_option('button_style_3_background_color', '#dadada'); ?>;
        color: <?php echo get_option('button_style_3_font_color', '#666'); ?>;
    }


    /* Form Styles */

    #searchform input[type="text"],
    .contact-form input[type="text"], #commentform input[type="text"], .contact-form textarea, #commentform textarea, .contact-form select, #commentform select {
        background: <?php echo get_option('input_fields_background_color', '#ededed'); ?>;
    }

    .contact-form .captcha input[type="text"] {
        background: #fff !important;
   }

   .nav-tabs li a:hover {
        background: <?php echo get_option('widget_recent_popular_comments_box_hover', '#7cd200'); ?>;
    }

    
    /* End of Non WooCommerce */


    /* WooCommerce Styles */

    .product,
    .shop_table.cart .headings,
    .cart-collaterals .cart_totals_inner,
    .woo-login-form, 
    .register-popup, 
    .lost_reset_password,
    .woo-register-form .register-button-wrapper,
    #customer_details input[type="text"].input-text:focus,
    #customer_details input[type="password"].input-text:focus,
    #customer_details input[type="email"]:focus,
    #customer_details textarea:focus,
    #order_review .shop_table thead,
    .payment_methods,
    .woocommerce-checkout .login input[type="text"].input-text:focus, 
    .woocommerce-checkout .checkout_coupon input[type="text"].input-text:focus,
    .woocommerce-checkout .login input[type="password"].input-text:focus, 
    .woocommerce-checkout .checkout_coupon input[type="password"].input-text:focus,
    .thankyou-text p,
    .order-status li,
    .cart .quantity .plus, 
    .cart .quantity .minus, 
    .cart .quantity input.qty, 
    .cart #content .quantity .plus, 
    .cart #content .quantity .cart .minus, 
    .cart #content .quantity input.qty,
    .shop-filters,
    .single-product-price,
    .product .price-rating,
    .product .product-hover,
    .my_account_orders thead,
    .change-password input[type="password"].input-text:focus,
    .variations input,
    .variations select,
    .change-address input[type="text"].input-text:focus,
    .change-address select:focus,
    .order_details thead th,
    .wishlist_table thead th,
    .product-categories,
    .sidebar .widget_price_filter .price_slider_wrapper 
    {
        background: <?php echo $secondary_color; ?>;
    }

    .order-status li a:after {
        border-left: 21px solid <?php echo $secondary_color; ?>;
    }

    .product h3,
    .product-share,
    .cart-collaterals .cart_totals_inner .total,
    .coupon,
    .woo-login-form h2, 
    .register-popup h2, 
    .lost_reset_password h2,
    .woo-register-form,
    .bacs_details,
    .order-status li:hover,
    .onsale,
    .summary h1,
    .product-categories .current-cat,
    .widget_price_filter .ui-slider .ui-slider-handle {
        background: <?php echo $primary_color; ?>;
    }

    .woo-cart > a,
    .header-wishlist {
        background-color:<?php echo $primary_color; ?>;
    }

    .order-status li:hover a:after {
        border-left: 21px solid <?php echo $primary_color; ?>;
    }

    .woo-login-form input[type="text"],
    .woo-login-form input[type="password"],
    .woo-login-form input[type="email"],
    .register-popup input[type="text"],
    .register-popup input[type="password"],
    .register-popup input[type="email"],
    .lost_reset_password input[type="text"],
    .lost_reset_password input[type="password"],
    .lost_reset_password input[type="email"],
    #customer_details .form-row > input[type="text"], 
    #customer_details input[type="password"], 
    #customer_details input[type="email"], 
    #customer_details textarea,
    .woocommerce-checkout .login input[type="text"].input-text, 
    .woocommerce-checkout .checkout_coupon input[type="text"].input-text,
    .woocommerce-checkout .login input[type="password"].input-text, 
    .woocommerce-checkout .checkout_coupon input[type="password"].input-text,
    .change-password input[type="password"].input-text,
    .change-address input[type="text"].input-text,
    .change-address select {
        border: 1px solid <?php echo $primary_color; ?>;
    }

    .price ins,
    .price .amount,
    .price_slider_amount,
    .price_slider_amount button,
    .order-status li a.current,
    .cart .quantity .plus, 
    .cart .quantity .minus, 
    .cart .quantity input.qty, 
    .cart #content .quantity .plus, 
    .cart #content .quantity .cart .minus, 
    .cart #content .quantity input.qty,
    .single-product-price .price,
    .single-product-price .reviews,
    .star-rating span:before,
    #site-nav .megamenu .no-link > a,
    .variations input,
    .variations select {
        color: <?php echo $primary_color; ?>
    }

    .price del,
    .price del .amount,
    .price del:hover {
        color: #A9A9A9;
    }

    .logo-box-row .logo:hover {
        background: rgba(0, 0, 0, .05);
    }

    mark {
        background: <?php echo $primary_color; ?> !important;
        color: #fff;
        display: inline-block !important;
        padding: 3px 7px;
    }

    .quantity input.plus,
    .quantity input.minus {
        transition: background .1s linear;
    }

    .quantity input.minus:hover,
    .quantity input.plus:hover {
        background: <?php echo $primary_color; ?>;
        color: #fff;
    }




     #custome 

    .comment .comments-content {
        width: 580px;
    }
    
    .comments article.comment {
        border: 1px solid #e5e5e5;
        background-color: #FFF;
    }
