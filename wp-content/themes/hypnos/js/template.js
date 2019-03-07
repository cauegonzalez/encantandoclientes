(function($) {

	"use strict";

	//Navigation

	$('ul.slimmenu').on('click',function(){
		var width = $(window).width();
		if ((width <= 800)){
			$(this).slideToggle();}
	});

	$('ul.slimmenu').slimmenu(
	{
		resizeWidth: '800',
		collapserTitle: '',
		easingEffect: null,
		animSpeed:'medium',
		indentChildren: true,
		// childrenIndenter: '&raquo;'
	});

	//Header Same height

	function headerSameHeight() {
		var logoHeight;
		var menuHeight;
		var biggerHeight;
		$('#blog').css('padding-top', '');
		logoHeight = $('#menu-wrap .logo img').outerHeight(true);
		if ( $('#menu-wrap .slimmenu').css('display') != 'none' ){
			menuHeight = $('#menu-wrap .slimmenu').outerHeight(true)
		} else {
			menuHeight = $('#menu-wrap .menu-collapser').outerHeight(true)
		};
		// console.log(logoHeight);
		// console.log(menuHeight);
		if ( logoHeight > menuHeight ){
			$('#menu-wrap .menu-holder').css('height', logoHeight);
			var headerHeight = $('#menu-wrap').outerHeight();
			$('#blog').css('padding-top', headerHeight+13);

		} else {
			$('#menu-wrap .logo-holder').css('height', menuHeight);
			var headerHeight = $('#menu-wrap').outerHeight();
			$('#blog').css('padding-top', headerHeight+13);

		}
	}

	headerSameHeight();

	$(window).load(function () {
		headerSameHeight();
	});

	$(window).resize(function(){
		headerSameHeight();
	});

	//Featured work

	$(window).load(function(){
		$( '.ff_film_roll_container' ).each(function(index){
			var new_id = 'ff_film_roll_container--'+index;

			$(this).attr('id', new_id);

			new FilmRoll({
				container: '#'+new_id,
				interval: 3000
			});
		});
		$(window).resize();
	});

	//Team

	$('.team article').flipcarousel({
		pagination : false,
		loader : true,
		itemsperpage: 4,
		randomizer: 0.7
	});


	//Counter

    jQuery(document).ready(function( $ ) {
        $('.counter').counterUp({
            delay: 100,
            time: 2000
        });
    });


	//Parallax

	// $(document).ready(function(){
	$(window).load(function(){
		// $('.parallax-home').parallax("50%", 0.4); NOT NEEDED PROBABLY
		$('.parallax-1').each(function(){
			var speed = $(this).attr('data-parallax-speed');
			if( '' === speed ){
				return;
			}
			speed = speed ? speed : 0.4;
			$(this).parallax("50%", 1 * speed);
		});
	});


	//Clients Carousel

	$(document).ready(function() {

	  var sync1 = $("#sync1");
	  var sync2 = $("#sync2");

	  sync1.owlCarousel({
		singleItem : true,
		slideSpeed : 1000,
		navigation: false,
		pagination:false,
		afterAction : syncPosition,
		responsiveRefreshRate : 200
	  });


	  sync2.owlCarousel({
		items : 7,
		itemsDesktop      : [1199,7],
		itemsDesktopSmall     : [979,5],
		itemsTablet       : [768,2],
		itemsMobile       : [479,2],
		pagination:false,
		responsiveRefreshRate : 100,
		afterInit : function(el){
		  el.find(".owl-item").eq(0).addClass("synced");
		}
	  });

	  function syncPosition(el){
		var current = this.currentItem;
		$("#sync2")
		  .find(".owl-item")
		  .removeClass("synced")
		  .eq(current)
		  .addClass("synced")
		if($("#sync2").data("owlCarousel") !== undefined){
		  center(current)
		}
	  }

	  $("#sync2").on("click", ".owl-item", function(e){
		e.preventDefault();
		var number = $(this).data("owlItem");
		sync1.trigger("owl.goTo",number);
	  });

	  function center(number){
		var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
		var num = number;
		var found = false;
		for(var i in sync2visible){
		  if(num === sync2visible[i]){
			var found = true;
		  }
		}

		if(found===false){
		  if(num>sync2visible[sync2visible.length-1]){
			sync2.trigger("owl.goTo", num - sync2visible.length+2)
		  }else{
			if(num - 1 === -1){
			  num = 0;
			}
			sync2.trigger("owl.goTo", num);
		  }
		} else if(num === sync2visible[sync2visible.length-1]){
		  sync2.trigger("owl.goTo", sync2visible[1])
		} else if(num === sync2visible[0]){
		  sync2.trigger("owl.goTo", num-1)
		}

	  }

	});



	$('.portfolio-wrap').each(function(){

		var $container = $(this);
		// var $filter = $('#filter');
		var $filter = $container.prev().prev().find('#filter');

		//Portfolio filter

		$(window).load(function () {
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
		});


		// Portfolio Isotope

		jQuery(document).ready(function($){

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

				$container.find('.portfolio-box').each(function () {
					$(this).css( {
						width : postWidth + 'px'
					});
				});
			}

			function setProjects() {
				setColumns();
				$container.isotope('reLayout');
			}

			$container.imagesLoaded(function () {
				setColumns();
			});


			$(window).bind('resize', function () {
				setProjects();
			});

		});

	});





	//Responsive video

	$(".video-container").fitVids();

	//Twitter Carousel

	$(document).ready(function() {

	  var sync1 = $("#sync3");
	  var sync2 = $("#sync4");

	  sync1.owlCarousel({
		singleItem : true,
		slideSpeed : 1000,
		navigation: false,
		pagination:false,
		afterAction : syncPosition,
		responsiveRefreshRate : 200
	  });


	  sync2.owlCarousel({
		items : 4,
		itemsDesktop      : [1199,4],
		itemsDesktopSmall     : [979,4],
		itemsTablet       : [768,2],
		itemsMobile       : [479,2],
		pagination:false,
		responsiveRefreshRate : 100,
		afterInit : function(el){
		  el.find(".owl-item").eq(0).addClass("synced");
		}
	  });

	  function syncPosition(el){
		var current = this.currentItem;
		$("#sync4")
		  .find(".owl-item")
		  .removeClass("synced")
		  .eq(current)
		  .addClass("synced")
		if($("#sync4").data("owlCarousel") !== undefined){
		  center(current)
		}
	  }

	  $("#sync4").on("click", ".owl-item", function(e){
		e.preventDefault();
		var number = $(this).data("owlItem");
		sync1.trigger("owl.goTo",number);
	  });

	  function center(number){
		var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
		var num = number;
		var found = false;
		for(var i in sync2visible){
		  if(num === sync2visible[i]){
			var found = true;
		  }
		}

		if(found===false){
		  if(num>sync2visible[sync2visible.length-1]){
			sync2.trigger("owl.goTo", num - sync2visible.length+2)
		  }else{
			if(num - 1 === -1){
			  num = 0;
			}
			sync2.trigger("owl.goTo", num);
		  }
		} else if(num === sync2visible[sync2visible.length-1]){
		  sync2.trigger("owl.goTo", sync2visible[1])
		} else if(num === sync2visible[0]){
		  sync2.trigger("owl.goTo", num-1)
		}

	  }

	});


	//Tooltip

	$(document).ready(function() {
		$(".tipped").tipper();
	});


	//Google map




	 // Portfolio Ajax

	$('.section-portfolio').each( function(index){
		var this_section = '.section-portfolio--'+index;
		var $this_section = $(this);

		$(window).load(function() {
			'use strict';
			var loader = $this_section.find('.expander-wrap');
			if(typeof loader.html() == 'undefined'){
				$('<div class="expander-wrap"><div id="expander-wrap" class="container clearfix relative"><p class="cls-btn"><a class="close">X</a></p><div/></div></div>').css({opacity:0}).hide().insertAfter(this_section+' .portfolio');
				loader = $this_section.find('.expander-wrap');
			}
			$this_section.find('.expander').on('click', function(e){
				e.preventDefault();
				e.stopPropagation();
				var url = $(this).attr('href');


				var data = {};
				data.portfolioPostId = $(this).attr('href');
				var portfolioContainer = $this_section;


                if( loader.css('display') == 'none' ) {

                }
				//loader.slideUp(function(){



				//});




                var switchPortfolio = function() {

                    frslib.ajax.frameworkRequest( 'portfolio-get-ajax', null, data, function( response ){

						var topPosition = portfolioContainer.offset().top;
						var bottomPosition = topPosition + portfolioContainer.height();


						$('html,body').delay(100).animate({ scrollTop: topPosition + 180}, 800);
						var container = $( $this_section.find('#expander-wrap>div'), loader);

						container.html(response);
						$this_section.find('.project-wrap-slider').flexslider({
							animation: "fade",
							selector: ".slider-project-ajax .slide",
							controlNav: false,
							directionNav: true ,
							slideshowSpeed: 5000,
						});


						loader.slideDown(function(){
							if(typeof keepVideoRatio == 'function'){
								keepVideoRatio('.video-container > iframe');
							}
						}).delay(1000).animate({opacity:1}, 200);

                        loader.find('.close').animate({opacity:1}, 200);
					});

					return false;

                };

                switchPortfolio();


                return false;
			});

			$('.close').on('click', function(){
				var $closer = $(this);
				var loader = $closer.parents('.section-portfolio').find('.portfolio');
				loader.delay(300).slideUp(function(){
					var container = $closer.parents('.section-portfolio').find('#expander-wrap>div');
					container.html('');
					loader.html('');
					$closer.css({opacity:0});

                    loader.css('display', 'none');
				});
				var topPosition = loader.offset().top;
				$('html,body').delay(0).animate({ scrollTop: topPosition - 70}, 500);
			});

		});
		});


//##############################################################################
//# MOVED FROM footer.php
//##############################################################################

	"use strict";

	$(document).ready(function(){
		$(".button-map").click(function(){
			$("#google_map").slideToggle(300,function(){
				google.maps.event.trigger(n,"resize"),n.setCenter(e)
			});
			$(this).toggleClass("close-map show-map");
		});
	});

	if( $('body').hasClass('royal_loader') ){
		Royal_Preloader.config({
			mode:           'text', // 'number', "text" or "logo"
			text:           $('body').attr('data-royal-loader-text'),
			timeout:        0,
			showInfo:       true,
			opacity:        1,
			background:     ['#FFFFFF']
		});
	}


	//Home fit screen
	$('#home').css({'height':($(window).height())+'px'});
	$(window).resize(function(){
		$('#home').css({'height':($(window).height())+'px'});
	});

	$(window).load(function(){
		/* Page Scroll to id fn call */
		$("ul.slimmenu li a,a[href='#top'],a[data-gal='m_PageScroll2id']").mPageScroll2id({
			highlightSelector:"ul.slimmenu li a",
			offset: 65,
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

	//Slider

	$(document).ready(function(){
		$('.slider-blog-wrap').bxSlider({
			adaptiveHeight: true,
			touchEnabled: true,
			pager: false,
			controls: true,
			auto: false,
			slideMargin: 1
		});
	});


	//Responsive video

	$(".container").fitVids();

	window.scrollReveal = new scrollReveal({
		viewportFactor: 0,
		mobile: false,
		tablet: false
	});


	if( 0 < $('.big-image').size() ){
		var elements = document.querySelectorAll( '.big-image' );
		Intense( elements );
	}


})(jQuery);













