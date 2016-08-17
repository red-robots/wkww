/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	/*
	*
	*	Current Page Active
	*
	------------------------------------*/
	$("[href]").each(function() {
    if (this.href == window.location.href) {
        $(this).addClass("active");
        }
	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	/*
	*
	*	Isotope with Images Loaded
	*
	------------------------------------*/
	var $container = $('#container').imagesLoaded( function() {
  	$container.isotope({
    // options
	 itemSelector: '.item',
		  masonry: {
			gutter: 15
			}
 		 });
	});

	/*
	*
	*	Smooth Scroll to Anchor
	*
	------------------------------------*/
	 /*$('a').click(function(){
	    $('html, body').animate({
	        scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
	    }, 500);
	    return false;
	});*/

	/*
	*
	*	Nice Page Scroll
	*
	------------------------------------*/
	/*
	$(function(){	
		$("html").niceScroll();
	});
	*/
	
	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();
	
	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

	/*
	 * Maintain porportion for boxes size 4x3
	 */
	$(window).on('ready resize',function(){
		$('.size-4-3').each(function(){	
			var $this = $(this);
			$this.css({
				"height": Number($this.width())*3/4+"px"
			});
		});
	});
	
	/*
	 * Maintain porportion for boxes size 4x2.8
	 */
	$(window).on('ready resize',function(){
		$('.size-4-2-5').each(function(){	
			var $this = $(this);
			$this.css({
				"height": Number($this.width())*2.5/4+"px"
			});
		});
	});
	/*--------------------------------------------
	 * Custom slider for homepage
	 ------------------------------------------*/
	function init_slider(){
		var $container = $('#primary-home .gallery.wrapper');//get container for slides
		var $slides = $container.css({	//set container properties and get slides
			"position":"relative",
			"overflow":"hidden"
		}).find(".slides .slide");
		if($slides.length<1){ //if no slides don't don anything else
			return;
		}
		$slides.eq(0).css({ //set first slide to active and in view
			"position":"absolute",
			"width":"100%",
			"height":"100%",
			"top": 0,
			"left": 0,
		}).addClass("active");
		if($slides.length<2){ //if no more slides do nothing else, just show first slide
			return;
		}
		for(var i=1;i<$slides.length;i++){//for each slide after the first
			var $this = $slides.eq(i); //get slide as $this
			$this.css({					//set css properties for slide
				"position":"absolute",
				"width":"100%",
				"height":"100%",
				"top":0,
				"left": 0,
				"display":"none",
			});
		}
		var timeout;//timeout with outer scope for when slides need to stop moving with clear timeout
		function slide(){//recursive function to move slides
			timeout = setTimeout(function(){ //set timeout
				var $active_slide = $slides.filter(".active").removeClass("active").fadeOut();//fade active slide out
				//if last slide move to the first, otherwise get sibling slide
				var $next_slide = $active_slide.index() !== $slides.length-1 ? $active_slide.next() : $slides.eq(0);
				$next_slide.addClass("active").fadeIn();//fade next slide in
				slide();//call self recursively
			},6000);
		}
		slide();
	}
	init_slider();//call function to init slider
	
	
	/*
	 *
	 * Custom gallery thumbnail switcher
	 *
	 */	
	$('.gallery .thumbnail.wrapper .thumbnail').on('click',function(){ //on thumbnail click
		$('.gallery .thumbnail.wrapper .thumbnail').filter(".active").removeClass("active");
		var url = $(this).addClass("active").find('img').attr('data-full-url'); //get url from data attribute
		$('.gallery .featured-image img').attr('src',url); //send url to featured image
	});
	
});// END #####################################    END
