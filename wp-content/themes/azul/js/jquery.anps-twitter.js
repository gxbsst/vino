jQuery(function($) {

    $(".tweet").tweet({
        username: $("#anps-twitter-acc").attr("data-acc"),
        template: "{user}{join} {text}{time}", 
        join_text: "auto",
        avatar_size: 0,
        count: 2,
        auto_join_text_default: " ", 
        auto_join_text_ed: " ",
        auto_join_text_ing: " ",
        auto_join_text_reply: " ",
        auto_join_text_url: "",
        loading_text: "loading tweets..."
    });

});