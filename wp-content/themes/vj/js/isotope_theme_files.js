jQuery(function($){
	var $container = $('#isotope-container');
	$container.isotope({
	  	itemSelector : '.isotope-item',
		layoutMode : 'fitRows'
	}, function(){
            $container.isotope({ filter: ".page-1" });
            $('.portfolio li.four-column').css("display", "block");
            $('.portfolio li.three-column').css("display", "block");
            $('.portfolio li.two-column').css("display", "block");
        });
        
        $(window).smartresize(function(){
            
            var selector = $("#filters .selected-filter").attr('data-filter');
            if ( selector != '*' ) {
                selector = "." + selector;
            }
            selector += ".page-" + currentPortfolioPage;
            $container.isotope({
                filter: selector
            });
        });
        var currentPortfolioPage = 1;
        var maxPerPage = $("#max_per_page").val();
        
        $('#filters a').click(function(){
            currentPortfolioPage = 1;
            var selector = $(this).attr('data-filter');
            var allResults = 0;
            
            if ( selector != '*' ) {
                
                var currentPage = 1;
                var counter = 1;
                
                allResults = $('.portfolio li.' + selector).length;
                
                $('.portfolio li.' + selector).each(function(index){
                   $('.portfolio li.' + selector).eq(index).removeClass("page-1 page-2 page-3 page-4 page-5 page-6 page-7 page-8 page-9 page-10 page-11 page-12 page-13 page-14 page-15 page-16 page-17 page-18 page-19 page-20 page-21 page-22 page-23 page-24 page-25 page-26 page-27 page-28 page-29 page-30");
                   $('.portfolio li.' + selector).eq(index).addClass("page-" + currentPage);
                   
                   if( counter++ ==  maxPerPage ) {
                       currentPage++;
                       counter = 1;
                   }
                });
                
                selector = "." + selector;
            } else {
                
                var currentPage = 1;
                var counter = 1;
                
                allResults = $('.portfolio li').length;
                
                $('.portfolio li').each(function(index){
                   $('.portfolio li').eq(index).removeClass("page-1 page-2 page-3 page-4 page-5 page-6 page-7 page-8 page-9 page-10 page-11 page-12 page-13 page-14 page-15 page-16 page-17 page-18 page-19 page-20 page-21 page-22 page-23 page-24 page-25 page-26 page-27 page-28 page-29 page-30");
                   $('.portfolio li').eq(index).addClass("page-" + currentPage);
                   
                   if( counter++ ==  maxPerPage ) {
                       currentPage++;
                       counter = 1;
                   }
                });
                
            }
            
            
            
            
          
            var newLinks = "";
            
            allResults = Math.ceil(allResults/maxPerPage);
                        
            for ( var i = 1; i <= allResults; i++ ) {
                if( i != 1 ) {
                    newLinks += '<li><a class="page-numbers pagination-value">' + i + '</a></li>'
                } else {
                    newLinks += '<li><a class="current pagination-value page-numbers">' + i + '</a></li>'
                }
            }
            
            $('.pagination-data').html('<ul class="page-numbers"><li><a class="previous">←</a></li>' + newLinks + '<li><a class="nxt">→</a></li></ul>');
            
            makeLinksClickable();
            
            selector += ".page-" + currentPortfolioPage;
            
            $('#filters a').removeClass("selected-filter");
            $(this).addClass("selected-filter");
            $container.isotope({ filter: selector });
                    return false;
        });
        
        makeLinksClickable();
        
        function makeLinksClickable() {

            $(".jquery-pagination a.page-numbers").bind("click", function(){
            
                currentPortfolioPage = $(this).html();

                $(".jquery-pagination a").removeClass("current");
                $(this).addClass("current");
                
                var currentSelector = $(".selected-filter").attr('data-filter');
                if ( currentSelector != '*' ) {
                        currentSelector = "." + currentSelector;
                } else {
                    currentSelector = "*";
                }

                $container.isotope({ filter: currentSelector + ".page-" + currentPortfolioPage });
                
            });


        
            $(".jquery-pagination .nxt").bind("click", function() {

                if( parseInt(currentPortfolioPage) + 2 < $(".jquery-pagination li").length ) {
                    $(".jquery-pagination li").eq( (parseInt(currentPortfolioPage)+1) ).children("a").click();
                }

            });
            
            $(".jquery-pagination .previous").bind("click", function(){
                    
                    if( parseInt(currentPortfolioPage) - 2 != -1 ) {
                        $(".jquery-pagination li").eq( parseInt(currentPortfolioPage) - 1 ).children("a").click();
                    }
                    
            });
        }
});
