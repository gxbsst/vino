jQuery(function($) {

    /* Style line space */

    $("p").each(function(index){
        if ( $("p").eq(index).html() == "&nbsp;" ) {
            $("p").eq(index).addClass("line-space");
        }
    });

    /* Size for hover efect (single-post2 posts, Portfolio views) */

    $(".single-post2").each(function(index) {
        $(".single-post2").eq(index).height( $(".single-post2").eq(index).find("img").height() + 43);
        $(".single-post2").eq(index).find(".single-post2-content").css({
            "top": $(".single-post2").eq(index).find("img").height() + 2,
            "height": $(".single-post2").eq(index).find("img").height() + 19
        });
    });

    $(window).resize(function() {

        $(".single-post2").each(function(index) {
            $(".single-post2").eq(index).height( $(".single-post2").eq(index).find("img").height() + 43);
            $(".single-post2").eq(index).find(".single-post2-content").css({
                "top": $(".single-post2").eq(index).find("img").height() + 2,
                "height": $(".single-post2").eq(index).find("img").height() + 19
            });
        });

    });

    $(".post .wp-post-image, .single-post2 img").load(function(){
        $(".single-post2").each(function(index) {
            $(".single-post2").eq(index).height( $(".single-post2").eq(index).find("img").height() + 43);
            $(".single-post2").eq(index).find(".single-post2-content").css({
                "top": $(".single-post2").eq(index).find("img").height() + 2,
                "height": $(".single-post2").eq(index).find("img").height() + 19
            });
        });
    });

    /* On menu reponsive menu change  */

    $(".mobile-menu").bind("change", function(){
        window.location = $('.mobile-menu :selected').val();
    });    

    /* Show / Animate Elements */

    $('.progress-bar').waypoint({
      handler: function() {
        $(this).children(".progres-bar-progress").width($(this).children(".progres-bar-progress").attr("data-width"));
      },
      offset: '85%'
    });

    $('.opened').waypoint({
      handler: function() {
        if( !$(this).hasClass("has-finished") ) {
            $(this).children(".accordion-group").eq(0).children(".accordion-heading").addClass("accordion-opened");
            $(this).children(".accordion-group").eq(0).children(".accordion-body").collapse();
            $(this).addClass("has-finished");
        }
      },
      offset: '85%'
    });

    /* Navigation */

    var navSize = 0;

    $("#menu-main-menu > li").each(function(index) {
        navSize += $("#menu-main-menu > li").eq(index).width();
    });

    if( navSize > 900 ) {
        $("#site-nav .menu-header").addClass("nav-full");
    }

    /* Comments */

    $(".form-buttons .btn").bind("click", function(){
        if( $(this).attr("data-name") == "reset") {
            $("#commentform textarea").val("");
        } else {
            $("#submit").click();
        }
    });

    /* Carosel */

    $(".carousel-control").html("");

    /* Primary Navigation (add sub-menu class) */

    $(".sub-menu li").each(function(index){
        if( $(".sub-menu li").eq(index).children(".sub-menu").length == 1) {
            $(".sub-menu li").eq(index).addClass("has-sub-menu");
        }
    });

    /* Sticky navigation */

    function stickyMenu() {

        if( $(".container").width() <= 678) {

            if($("#logo").parent().attr("id") != "logo-and-search") {
                $("#logo").appendTo("#logo-and-search");
                $("#site-nav").appendTo("#site-header");
                $(".mobile-menu").appendTo("#site-header");
            }
        }

        else if( $(".container").width() <= 724) {

            if( $(window).scrollTop() > 29 ) {
                if ( $('.sticky-menu').is(':hidden') ) {
                    $(".sticky-menu").show();
                    $("#logo").appendTo("#logo-and-search");
                    $(".mobile-menu").appendTo("#site-header");   
                    $("#logo, .mobile-menu").appendTo(".sticky-menu");
                }
            } else {
                if ( $('.sticky-menu').is(':visible') ) {
                    $(".sticky-menu").hide();
                    $("#logo").appendTo("#logo-and-search");
                    $(".mobile-menu").appendTo("#site-header");  
                }             
            }

        }
        else {

            if($(window).scrollTop() > 29) {
                if ( $('.sticky-menu').is(':hidden') ) {
                    $(".sticky-menu").show();
                    $("#logo, #site-nav").appendTo(".sticky-menu");
                }
            } else {
                if ( $('.sticky-menu').is(':visible') ) {
                    $(".sticky-menu").hide();
                    $("#logo").appendTo("#logo-and-search");
                    $("#site-nav").appendTo("#site-header");
                }
            }

        }

    }

    $(window).scroll(function(e) {
        stickyMenu();
    });

    $(window).resize(function(e) {
        stickyMenu();
    });

    /* Accordion (change minus/plus simbol) */

    $(".accordion-heading").click(function(){
    	if(!$(this).hasClass("accordion-opened")) {
    		$(this).addClass("accordion-opened");
    	} else {
    		$(this).removeClass("accordion-opened");
    	}
    });

    /* Quotes widget */

    $(".quotes article").fadeOut(100, function() {
        $(".quotes article.quote-selected").fadeIn(400);        
    });


    setInterval(function(){

        $(".widget_anpsquotes").each(function(index) {

            var el = $(".widget_anpsquotes").eq(index).children(".quotes").children("article.quote-selected");
            var el_index = $(".widget_anpsquotes").eq(index).children(".quotes").children("article.quote-selected").index();

            if( el_index > $(".widget_anpsquotes").eq(index).children(".quotes").children("article.quote-selected").length ) {
                el_index = 0;
            } else {
                el_index += 1;
            }

            $(".widget_anpsquotes").eq(index).children(".quotes").height($(".widget_anpsquotes").eq(index).children(".quotes").children("article").eq(el_index).height()+20);

            el.fadeOut(400, function() {
                $(".widget_anpsquotes").eq(index).children(".quotes").children("article").eq(el_index).fadeIn(400);
            });
        
            $(".widget_anpsquotes").eq(index).children(".quotes").children("article").removeClass("quote-selected");
            $(".widget_anpsquotes").eq(index).children(".quotes").children("article").eq(el_index).addClass("quote-selected");

        });

    }, 7000);
    

    /* Search form (open on click) */

    $('#site-header #searchform-header input[type="submit"]').click(function() {
        if( $('#site-header #searchform-header input[type="text"]').width() == 0 ) {
            $('#site-header #searchform-header input[type="text"]').css({
                width: "180px",
                padding: "7px 14px"
            });

            return false;
        }
    });
    
    /* Search form - remove submit button value */

    $('.widget_search input[type="submit"]').val("");

    /* Search form - add placeholder */

    $('.widget_search input[type="text"]').attr("placeholder", $('#site-header input[type="text"]').attr("placeholder"));

    /* WooSlider custom changes */

    $(".slide-content p, .slide-content h3").addClass("woo-content");
    $(".slide-content").each(function(index){
        $(".slide-content").eq(index).children().eq(0).removeClass("woo-content").addClass("woo-image");
        $(".slide-content").eq(index).children("p.woo-content, h3.woo-content").wrapAll('<div class="woo-content" />');
        $(".slide-content").eq(index).children(".woo-content").children("p, h3").removeClass("woo-content");
    });

    $(".woo-content").wrap("<div class='woo-content-wrapper' />")
    $(".wooslider ").append("<div class='woo-box' />");

    /* Contact form - reset */

    $("#reset-form").click(function() {

        $(".contact-form textarea, .contact-form input[type='text']").each(function(index) {
            $(".contact-form textarea, .contact-form input[type='text']").eq(index).val("");
        });

        $(".contact-form input[type='checkbox'], .contact-form input[type='radio']").each(function(index) {
            $(".contact-form input[type='checkbox'], .contact-form input[type='radio']").eq(index).attr('checked', false);
        });

        $(".contact-form select").each(function(index) {
            $(".contact-form select").eq(index).val($(".contact-form select").eq(index).val(".contact-form select option:first"));
        });

        $(".contact-form .alert").remove(); 

    });

    function validateCaptcha()
    {
        challengeField = $("input#recaptcha_challenge_field").val();
        responseField = $("input#recaptcha_response_field").val();

        var html = $.ajax({
            type: "POST",
            url: "http://astudio.si/preview/azul/wp-content/themes/azul/includes/validate_captcha.php",
            data: "form=signup&amp;recaptcha_challenge_field=" + challengeField + "&amp;recaptcha_response_field=" + responseField,
            async: false
            }).responseText;

        console.log( html );
        if(html == "success") {
            return true;
        } else {
            return false;
        }
    }

    /* Contact form - validation, captcha, reset button, etc. */

    function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{1,4})?$/;
        if( !emailReg.test( email ) ) {
            return false;
        } else {
            return true;
        }
    }

    function validateContactNumber(number) {
        var numberReg = /^((\+)?[1-9]{1,3})?([-\s\.])?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}$/;
        if( !numberReg.test( number ) ) {
            return false;
        } else {
            return true;
        }
    }

    function validateTextOnly(text) {
        var textReg = /^[A-z]+$/;
        if( !textReg.test( text ) ) {
            return false;
        } else {
            return true;
        }            
    }

    function validateNumberOnly(number) {
        var numberReg = /^[0-9]+$/;
        if( !numberReg.test( number ) ) {
            return false;
        } else {
            return true;
        }            
    }
    
    $("#send-form").click(function() {
        $(".contact-form").submit();
    });

    $("form.contact-form").submit(function(){
        
        $(".contact-form .alert").remove(); 
         
        var form = $(this);
        
        var is_all_cool = true;
        
        form.children(".form-element-wrap").each(function(index){
            
            var child = form.children(".form-element-wrap").eq(index).children("input, textarea");

            if( child.attr("data-required") == "required" && ( child.val() == "" || child.val() == child.attr("data-placeholder")) ) {
                is_all_cool = false;
                child.addClass("error");
                child.parent().children(".error-text").remove();
                child.after('<div class="alert alert-error"><div class="alert-desc">This item is required.</div></div>');
            } else {
                child.removeClass("error");
                child.parent().children(".alert-error").remove();
            }
            
            if( child.attr("data-validation") == "phone" && child.val() != "" && child.val() != child.attr("data-placeholder") ) {
                if( ! validateContactNumber(child.val()) ) {
                    is_all_cool = false;
                    child.addClass("error");
                    child.after('<div class="alert alert-error"><div class="alert-desc">Please enter a valid phone number.</div></div>');
                } else {
                    child.removeClass("error");
                    child.parent().children(".alert-error").remove();
                }
            }
            
            if( child.attr("data-validation") == "email" && child.val() != ""  && child.val() != child.attr("data-placeholder") ) {
                if( ! validateEmail(child.val()) ) {
                    is_all_cool = false;
                    child.addClass("error");
                    child.after('<div class="alert alert-error"><div class="alert-desc">Please enter a valid e-mail.</div></div>');
                } else {
                    child.removeClass("error");
                    child.parent().children(".alert-error").remove();
                }
            }
            

            if( child.attr("data-validation") == "text_only" && child.val() != ""  && child.val() != child.attr("data-placeholder") ) {
                if( ! validateTextOnly(child.val()) ) {
                    is_all_cool = false;
                    child.addClass("error");
                    child.after('<div class="alert alert-error"><div class="alert-desc">Please enter only characters.</div></div>');
                } else {
                    child.removeClass("error");
                    child.parent().children(".alert-error").remove();
                }
            }

            if( child.attr("data-validation") == "number" && child.val() != ""  && child.val() != child.attr("data-placeholder") ) {
                if( ! validateNumberOnly(child.val()) ) {
                    is_all_cool = false;
                    child.addClass("error");
                    child.after('<div class="alert alert-error"><div class="alert-desc">Please enter only numbers.</div></div>');
                } else {
                    child.removeClass("error");
                    child.parent().children(".alert-error").remove();
                }
            }
        });
    
        if( $("#recaptcha_area").length > 0 ) {
            if(!validateCaptcha()) {
                is_all_cool = false;
                Recaptcha.reload();
            }
        }
        
        if ( is_all_cool ) {

            form.children(".form-element-wrap").children("input, textarea").removeClass("error");;
            
            $.fn.serializeObject = function()
            {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
            };

            var form_data = $(this).serializeObject();
            $.ajax({
                type: "POST",
                url: $("#site_url").val() + '/wp-admin/admin-ajax.php',
                data: {
                    action: 'MailFunction',
                    form_data: form_data
               },

                success: function(msg) {

                    form.append('<div style="margin: 80px 0 0 0" class="alert alert-success"><div class="alert-desc">' + form.attr('data-sucess') + '</div></div>');

                    $("#contact-form-success").bind("click", function(){

                        $(this).parent().slideUp(300, function(){

                            $(this).remove();

                        }); 

                    });

                 }

            });
        }
        
        return false;
    });

    /* Show site */

    $("#site-wrapper").css("visibility", "visible");

    /* IE8 fixes */

    if ( $.browser.msie && $.browser.version == "8.0" ) {
        $(".pricing-table-column:last-child").css("margin", "0");
        $('.row-fluid [class*="span"]:last-child').css("margin-right", "0");
    }

    if( ! Modernizr.placeholder ) {

        function placeholder_func() {
            $('input[type="text"]').each(function(index){
                if ( $(this).attr("placeholder") ) {
                    $('input[type="text"]').eq(index).val($('input[type="text"]').eq(index).attr("placeholder"));
                    $('input[type="text"]').eq(index).css("color", "#a9a9a9");
                }
            });

            $('textarea').each(function(index){

                $('textarea').eq(index).val($('textarea').eq(index).attr("placeholder"));

                $('textarea').eq(index).css("color", "#a9a9a9");

            });
        }

        $("#reset-form").click(function() {
            placeholder_func();
        });

        placeholder_func();

        $('input[type="text"], textarea').bind("focus", function(){

            if( $(this).val() == $(this).attr("placeholder") ) {

                $(this).val("");

                $(this).css("color", "#727272");

            }

        });

        

        $('input[type="text"], textarea').bind("blur", function(){

            if( $(this).val() == "" ) {

                $(this).css("color", "#a9a9a9");

                $(this).val($(this).attr("placeholder"))

            }

        }); 
    }


    /* WooCommerce */

    $("#singleProductGallery").carousel('pause');

    $(".products .product").hover( 
        function() {
            $(this).siblings().addClass("faded");

            var el = $(this).find(".price-rating > .price");
            el.css("margin-left", "-" + (el.width()/2) + "px");
        },
        function() {
            $(this).siblings().removeClass("faded");
            $(this).find(".price-rating > .price").css("margin-left", "16px");
        }     
    );

    /* Remove cart issue when adding products  */
    $(".add_to_cart_button").click(function() {
        $(".cart_list-outer").remove();  
    });  

    $(".shipping-calculator-form").show();
    $(".single-product .accordion-toggle").on("click", function(e) {
        var el = $(this).parents('.accordion-group').siblings();
        el.children('.accordion-opened').removeClass('accordion-opened');
        var ell = el.children('.accordion-body');
        ell.each(function(index) {
            if (ell.eq(index).hasClass('in')) {
                ell.eq(index).collapse('hide');
                ell.eq(index).removeClass('in');
            }
        });

    });

    /* Remove Pagination Next / Previous */

    $(".woocommerce-pagination li a").filter(".next, .prev").parent().addClass("no");

    /* Click event for WishList */

    $(".anps-compare span").on("click", function(){
        $(this).parent().children(".yith-wcwl-add-to-wishlist").find("a").click();
    });

    /* Update Cart */

    $('.btn[name="update_cart"]').on("click", function(){
        $('form[name="cart-form"]').submit();
    });

    /* Register Form (using PrettyPhoto) */

    $(".open-register-form").on("click", function() {
        $.prettyPhoto.open("#register-popup");
    });

    /* Notice */

    if( $("#notice-lightbox").length > 0 ) {
        $.prettyPhoto.open("#notice-lightbox");
        $.cookie( 'azul-notification-closed', $("#notification_changes").val() );

        console.log($("#notification_changes").val());
    }

    /* MegaMenu size */    

    $(".megamenu > .sub-menu").each(function(index) {

        var el = $(".megamenu > .sub-menu").eq(index);

        var megaEl = el.children("li");
        var megaWide = el.children("li.wide");

        el.width( ((202 * megaEl.length) + (megaWide.length * 40) ) );

    });

    /* Fix Possible Product Hover Issue */

    $(".product").on("mouseenter", function(){

        $(this).children(".product-hover").attr("style", "");

        if( $(this).children(".product-hover").children(".btn").height() > 16) {
            if( $(this).children(".product-hover").hasClass("with-plugs") ) {

                if( $(this).width() < 200 ) {
                    $(this).children(".product-hover").css({
                        height: "113px",
                        bottom: "-139px"
                    });
                } else {
                    $(this).children(".product-hover").css({
                        height: "88px",
                        bottom: "-114px"
                    });
                }

            } else {
                $(this).children(".product-hover").css({
                    height: "45px",
                    bottom : "-71px"
                });
            }
        }
    });

    $(".product").on("mouseleave", function(){
        if( $(this).children(".product-hover").children(".btn").height() > 16) {
            $(this).children(".product-hover").attr("style", "");
        }
    });

    /* Adding action for Copare and Wishlist spans */

    $(".anps-compare span").on("click", function() {
        $(this).siblings(".compare-button").children(".compare").click();
    });

    $(".anps-wishlist span").on("click", function() {
        $(this).siblings(".yith-wcwl-add-to-wishlist").find(".add_to_wishlist").click();
    });

    /* Cart Page Buttons */

    $(".cart-update").on("click", function(){
        $("input[name='update_cart']").click();
    });

    $(".cart-checkout").on("click", function(){
        $("input[name='proceed']").click();
    });

    $(".cart-apply-coupon").on("click", function(){
        $("input[name='coupon_code']").val($(".coupon-code").val());
        $("input[name='apply_coupon']").click();
    });

    /* WishList Header Ajax */

    function wishListAjax() {
        $.ajax({
          url: $("#site-path").val() + "/anps-framework/wishlist_ajax.php"
        }).done(function( msg ) {
           $(".header-wishlist").html(msg);
        });
    }

    $(".wishlist_table .remove, .add_to_wishlist").on("click", function(){
        setTimeout(function(){ wishListAjax() }, 100);
    });

});