jQuery(document).ready(function( $ ) {  
    var currentlyClickedElement = '';
  	
    $('.color-pick-color').bind("click", function(){ 
        currentlyClickedElement = this;
    });
  	
    $('.color-pick-color').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).css("background","#"+hex);
            $(el).attr("data-value", "#"+hex);
            $(el).parent().children(".color-pick").val("#"+hex);
            $(el).ColorPickerHide();
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor($(this).attr("data-value"));
        },
        onChange: function (hsb, hex, rgb) {
            $(currentlyClickedElement).css("background","#"+hex);
            $(currentlyClickedElement).attr("data-value", "#"+hex);
            $(currentlyClickedElement).parent().children(".color-pick").val("#"+hex);
        }
    })
    .bind('keyup', function(){
        $(this).ColorPickerSetColor(this.value);
    });
	 
 
    $('.color-pick').bind('keyup', function(){
        $(this).parent().children(".color-pick-color").css("background", $(this).val());
    });
    
    // 17 - var default = new Array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

    var default_val = new Array("#1abc9c", "#daf1ed", "#fff", "#727272", "#000", "#17a186", "#daf1ed", "#000", "#fff", "#2a2a2a", "#414141", "#16a085", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var orange = new Array("#fbac14", "#ffe7b9", "#fff", "#727272", "#000", "#e99b05", "#ffe7b9", "#000", "#fff", "#2a2a2a", "#414141", "#f9aa12", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var blue = new Array("#0074ce", "#ceeaff", "#fff", "#727272", "#000", "#0064b1", "#ceeaff", "#000", "#fff", "#2a2a2a", "#414141", "#1b83d4", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var red = new Array("#d82020", "#ffdfdf", "#fff", "#727272", "#000", "#bc1616", "#ffdfdf", "#000", "#fff", "#2a2a2a", "#414141", "#d82626", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var grey = new Array("#606060", "#d3d3d3", "#fff", "#727272", "#000", "#4d4d4d", "#d3d3d3", "#000", "#fff", "#2a2a2a", "#414141", "#363636", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var violet = new Array("#bd71bd", "#e7c9e7", "#fff", "#727272", "#000", "#a259a2", "#e7c9e7", "#000", "#fff", "#2a2a2a", "#414141", "#d76ad7", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var brown = new Array("#b7804b", "#ebd3bc", "#fff", "#727272", "#000", "#9a6533", "#ebd3bc", "#000", "#fff", "#2a2a2a", "#414141", "#ad6b2b", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var yellow = new Array("#dec600", "#fff9c6", "#fff", "#727272", "#000", "#c8b300", "#fff9c6", "#000", "#fff", "#2a2a2a", "#414141", "#ffe400", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var pink = new Array("#f484bb", "#f8d7e7", "#fff", "#727272", "#000", "#ff67b2", "#f8d7e7", "#000", "#fff", "#2a2a2a", "#414141", "#e84b98", "#ededed", "#fff", "#414141", "#666", "#dadada");
    var light_green = new Array("#a7cd33", "#e9f0d3", "#fff", "#727272", "#000", "#9ac122", "#e9f0d3", "#000", "#fff", "#2a2a2a", "#414141", "#afdf1b", "#ededed", "#fff", "#414141", "#666", "#dadada");

    $("#predefined_colors").bind("change", function(){
    	
        var table;
    	
        switch( $(this).val() ) {
            case "default" :
                table = default_val;
                break;
            case "orange" :
                table = orange;
                break;
            case "blue" :
                table = blue;
                break;
            case "red" :
                table = red;
                break;
            case "grey" :
                table = grey;
                break;
            case "violet" :
                table = violet;
                break;
            case "brown" :
                table = brown;
                break;
            case "yellow" :
                table = yellow;
                break;
            case "pink" :
                table = pink;
                break;
            case "light_green" :
                table = light_green;
                break;
        }
    	
        $(".color-pick").each(function(index){
            $(".color-pick").eq(index).val(table[index]);
            $(".color-pick").eq(index).parent().children(".color-pick-color").css("background", table[index]);
            $(".color-pick").eq(index).parent().children(".color-pick-color").attr("data-value", table[index]);
        });
    });


    $(".input-type").change(function(){
        if($(this).val() == "dropdown") {
            $(this).parent().parent().children(".validation").hide();
            $(this).parent().parent().children(".label-place-val").children("label").html("Values");
        }
        else {
            $(this).parent().parent().children(".validation").show();
            $(this).parent().parent().children(".label-place-val").children("label").html("Placeholder");
        }

    });
});