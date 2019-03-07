$( window ).load(function() {
  $('#filter li:first-child a').click();
});

(function($) { "use strict";
	$("body").fitVids();
	$('.flexslider').flexslider({
		animation: "slide",
		autoplay: true
	});


	//Home Text Rotator
	$('.flippy ul').flippy({
	    interval: 4,
	    speed: 500,
	    stop: false,
	    distance: "100px"
	});

	//Scroll Top
	$('.back-top').click(function() { $('body,html').animate({scrollTop: 0}, 500);  return false; });	

	 // Add class for columns : 10, 11, 12 skeleton.  
   $('.rows').find('div').each(function(i, ojb) {
        if ( $(this).hasClass('one columns2') ) {
            $(this).removeClass('one columns2').addClass('twelve columns');
        }

        if ( $(this).hasClass('one columns1') ) {
            $(this).removeClass('one columns1').addClass('eleven columns');
        }

        if ( $(this).hasClass('one columns0') ) {
            $(this).removeClass('one columns0').addClass('ten columns');
        }
    });	

    $('.column, .columns').parents('.twelve.columns').removeClass('columns');

	//Home fit screen			
	$(function(){"use strict";
		$('#home').css({'height':($(window).height())+'px'});
		$(window).resize(function(){
		$('#home').css({'height':($(window).height())+'px'});
		});
	});

	//Scrolling			
	$(document).ready(
	function() {  
		$("html").niceScroll();
		}
	);
		
	//Navigation	
	$('ul.slimmenu').on('click',function(){"use strict";	
		var width = $(window).width(); 
		if ((width <= 800)){ 
			$(this).slideToggle(); 
		}	
	});				
	$('ul.slimmenu').slimmenu({
	    resizeWidth: '800',
	    collapserTitle: '',
	    easingEffect:'easeInOutQuint',
	    animSpeed:'medium',
	    indentChildren: true,
	    childrenIndenter: '&raquo;'
	});	
	
	/* Scroll Too */	
	$(window).load(function(){"use strict";		
		/* Page Scroll to id fn call */
		$("a[href^='#']").mPageScroll2id({
			highlightSelector:"ul.slimmenu li a",
			offset: 75,
			scrollSpeed:1000,
			scrollEasing: "easeInOutCubic"
		});		
		/* demo functions */
		$("a[rel='next']").click(function(e){
			e.preventDefault();
			var to=$(this).parent().parent("section").next().attr("id");
			$.mPageScroll2id("scrollTo",to);
		});		
	});	

	//Portfolio filter 
	var $container = $('.portfolio-wrap');
	var $filter = $('#filter');
	// Initialize isotope 
	$container.isotope({
	    filter: '*',
	    layoutMode: 'fitRows',
	    animationOptions: {
	        duration: 750,
	        easing: 'linear'
	    }
	});
	// Filter items when filter link is clicked
	$filter.find('a').click(function () {
	    var selector = $(this).attr('data-filter');
	    $filter.find('a').removeClass('current');
	    $(this).addClass('current');
	    $container.isotope({
	        filter: selector,
	        animationOptions: {
	            animationDuration: 750,
	            easing: 'linear',
	            queue: false,
	        }
	    });
	    return false;
	});

	// Portfolio Isotope	
	var container = $('.portfolio-wrap');	
	function splitColumns() { 
		var winWidth = $(window).width(), 
			columnNumb = 1;
		
		
		if (winWidth > 1024) {
			columnNumb = 4;
		} else if (winWidth > 900) {
			columnNumb = 2;
		} else if (winWidth > 479) {
			columnNumb = 2;
		} else if (winWidth < 479) {
			columnNumb = 1;
		}
		
		return columnNumb;
	}		

	function setColumns() { 
		var winWidth = $(window).width(), 
			columnNumb = splitColumns(), 
			postWidth = Math.floor(winWidth / columnNumb);
		
		container.find('.portfolio-box').each(function () { 
			$(this).css( { 
				width : postWidth + 'px' 
			});
		});
	}		

	function setProjects() { 
		setColumns();
		container.isotope('reLayout');
	}		

	container.imagesLoaded(function () { 
		setColumns();
	});


	$(window).bind('resize', function () { 
		setProjects();			
	});
		
	//Tooltip

	$(document).ready(function() {
		$(".tipped").tipper();
	});	

	//Parallax effects 
	$(document).ready(function(){
		$('.parallax').parallax("50%", 0.4);
		$('.parallax2').parallax("50%", 0.4);
		$('.parallax1').parallax("50%", 0.4);
		$('.parallax-blog').parallax("50%", 0.5);
	});
  
 
		// Portfolio Ajax
    $(window).load(function() {'use strict';		  
	  	var loader = $('.expander-wrap');
		if(typeof loader.html() == 'undefined'){
			$('<div class="expander-wrap"><div id="expander-wrap" class="container clearfix relative"><p class="cls-btn"><a class="close">X</a></p><div/></div></div>').css({opacity:0}).hide().insertAfter('.portfolio');
			loader = $('.expander-wrap');
		}
		$('.expander').on('click', function(e){
			e.preventDefault();
			e.stopPropagation();
			var url = $(this).attr('href');
			loader.slideUp(function(){
				$('.page-overlay').show();
				$.get(url, function(data){
					var portfolioContainer = $('.portfolio');
					var topPosition = portfolioContainer.offset().top;
					var bottomPosition = topPosition + portfolioContainer.height();
					$('html,body').delay(600).animate({ scrollTop: bottomPosition - -10}, 800);
					var container = $('#expander-wrap>div', loader);
					
					container.html(data);
					$(".video").fitVids();
					$('.project').flexslider({
				        animation: "fade",
						selector: ".project-slides .slide",
						controlNav: false,
						directionNav: true ,
						slideshowSpeed: 5000,  
				    });
					loader.slideDown(function(){
						$('.page-overlay').hide();
						if(typeof keepVideoRatio == 'function'){
							keepVideoRatio('.video > iframe');
						}
					}).delay(1000).animate({opacity:1}, 200);
				});
			});
		});
			
		$('.close', loader).on('click', function(){
			loader.delay(300).slideUp(function(){
				var container = $('#expander-wrap>div', loader);
				container.html('');
				$(this).css({opacity:0});				
			});
			var portfolioContainer = $('.portfolio');
				var topPosition = portfolioContainer.offset().top;
				$('html,body').delay(0).animate({ scrollTop: topPosition - 70}, 500);
		});
	});
  

	$(document).ready(function() {
		$(".fancybox-effects-d").fancybox({
			padding: 0,
			openEffect : 'elastic',
			openSpeed  : 150,
			closeEffect : 'elastic',
			closeSpeed  : 150,
			closeClick : true
		});	
		$(".fancybox-media").fancybox({
			padding: 0,
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: true,
			openEffect	: 'elastic',
			closeEffect	: 'elastic'
		});
	});
 
 	//Counter 	
    jQuery(document).ready(function( $ ) {
        $('.counter').counterUp({
            delay: 100,
            time: 2000
        });
    });	
 
 })(jQuery); 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 





	