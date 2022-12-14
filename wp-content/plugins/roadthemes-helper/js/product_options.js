/* Product Options Js */
function testislider(x){
	var owlslider = jQuery(".has-thumb .testimonials .testimonials-list.owl-carousel");
	owlslider.trigger( 'to.owl.carousel', x );
}
(function($) {
	"use strict";
	jQuery(document).ready(function(){
		jQuery('.roadthemes-products.roadthemes-slider').each(function(){ 
			var items_1500up    = parseInt(jQuery(this).attr('data-1500up'));
			var items_1200_1499 = parseInt(jQuery(this).attr('data-1200-1499'));
			var items_992_1199  = parseInt(jQuery(this).attr('data-992-1199'));
			var items_768_991   = parseInt(jQuery(this).attr('data-768-991'));
			var items_640_767   = parseInt(jQuery(this).attr('data-640-767'));
			var items_480_639   = parseInt(jQuery(this).attr('data-480-639'));
			var items_375_479     = parseInt(jQuery(this).attr('data-375-479'));
			var items_0_374     = parseInt(jQuery(this).attr('data-0-374'));
			var navigation      = true; 
			if (parseInt(jQuery(this).attr('data-navigation'))!==1)  {navigation = false} ;
			var pagination      = false; 
			if (parseInt(jQuery(this).attr('data-pagination'))==1)  {pagination = true} ;
			var item_margin     = parseInt(jQuery(this).attr('data-margin'));
			var auto            = false; 
			if (parseInt(jQuery(this).attr('data-auto'))==1)  {auto = true} ;
			var loop            = false; 
			if (parseInt(jQuery(this).attr('data-loop'))==1)  {loop = true} ;
			var speed           = parseInt(jQuery(this).attr('data-speed'));
			jQuery(this).find('.shop-products').addClass('owl-carousel owl-theme').owlCarousel({ 
				nav            : navigation, 
				dots           : pagination,
				margin         : item_margin,
				loop           : loop,
				autoplay       : auto,
				smartSpeed     : speed,
				navText        : [ecolife_nav_text.pre,ecolife_nav_text.next],
				addClassActive : false,
				responsiveClass: true,
				responsive     : {
					0: {
						items: items_0_374,
					},
					375: {
						items: items_375_479,
					},
					480: {
						items: items_480_639,
					},
					640: {
						items: items_640_767,
					},
					768: { 
						items: items_768_991,
					},
					992: { 
						items: items_992_1199,
					},
					1200: { 
						items: items_1200_1499,
					},
					1500: {
						items: items_1500up,
					},
				},
			});
		});
		// equal height of item products
		if(jQuery(window).width() > 374){
			jQuery('.roadthemes-slider.roadthemes-products').each(function(){
				var maxHeight = 0;
				jQuery(this).find('.item-col').each(function(){
					if (jQuery(this).outerHeight() > maxHeight) { 
						maxHeight = jQuery(this).height(); 
					};
				});
				jQuery(this).find('.item-col').css('min-height', maxHeight);
				jQuery(this).find('.item-col .product-wrapper').css('min-height', maxHeight);
			});
		}
		// add class firstActiveItem and lastActiveItem in owl carousel
		jQuery('.roadthemes-slider').each(function(){
			var total = jQuery(this).find('.owl-stage .owl-item.active').length;
			jQuery(this).find('.owl-stage .owl-item.active').each(function(index){
	            if (index === 0) {
	                jQuery(this).addClass('firstActiveItem');
	            }
	            if (index === total - 1) {
	                jQuery(this).addClass('lastActiveItem');
	            }
	        });
	        jQuery(this).on('translated.owl.carousel', function(event) {
	        	jQuery(this).find('.owl-stage .owl-item').removeClass('firstActiveItem lastActiveItem');
    			jQuery(this).find('.owl-stage .owl-item.active').each(function(index){
    	            if (index === 0) {
    	                jQuery(this).addClass('firstActiveItem');
    	            }
    	            if (index === total - 1) {
    	                jQuery(this).addClass('lastActiveItem');
    	            }
    	        });
	        });
		});
		jQuery('.testimonial_r').each(function(){ 
			var items_1201up    = parseInt(jQuery(this).attr('data-1201up'));
			var items_993_1200  = parseInt(jQuery(this).attr('data-993-1200'));
			var items_769_992   = parseInt(jQuery(this).attr('data-769-992'));
			var items_641_768   = parseInt(jQuery(this).attr('data-641-768'));
			var items_360_640   = parseInt(jQuery(this).attr('data-360-640'));
			var items_0_359     = parseInt(jQuery(this).attr('data-0-359'));
			var navigation      = true; 
			if (parseInt(jQuery(this).attr('data-navigation'))!==1)  {navigation = false} ;
			var pagination      = false; 
			if (parseInt(jQuery(this).attr('data-pagination'))==1)  {pagination = true} ;
			var item_margin     = parseInt(jQuery(this).attr('data-margin'));
			var auto            = false; 
			if (parseInt(jQuery(this).attr('data-auto'))==1)  {auto = true} ;
			var loop            = false; 
			if (parseInt(jQuery(this).attr('data-loop'))==1)  {loop = true} ;
			var speed           = parseInt(jQuery(this).attr('data-speed'));
			var owljt           = jQuery(this).find('.testimonials-list').addClass('owl-carousel owl-theme').owlCarousel({ 
				nav            : navigation, 
				dots           : pagination,
				margin         : item_margin,
				loop           : loop,
				autoplay       : auto,
				smartSpeed     : speed,
				addClassActive : false,
				responsiveClass: true,
				responsive     : {
					0: {
						items: items_0_359,
					},
					360: {
						items: items_360_640,
					},
					641: {
						items: items_641_768,
					},
					769: { 
						items: items_769_992,
					},
					993: { 
						items: items_993_1200,
					}, 
					1201: {
						items: items_1201up,
					}
				},
				onTranslated: function(){
					var x = jQuery( ".testimonial_r.has-thumb  .owl-dots .owl-dot" ).index( jQuery( ".testimonial_r.has-thumb .owl-dots .active" ));
					var testithumb = ".testithumb"+x;
					jQuery(".testimonial_r.has-thumb .thumbnail li").removeClass('active');
					jQuery(testithumb).addClass('active');
				}
			});
		});
		jQuery('.testimonial_r.has-thumb .thumbnail').addClass('owl-carousel owl-theme').owlCarousel({ 
			nav            : true, 
			dots           : false,
			margin         : 20,
			loop           : false,
			autoplay       : false,
			smartSpeed     : 1000,
			addClassActive : false,
			responsiveClass: true,
			responsive     : {
				0: {
					items: 3,
				},
				360: {
					items: 3,
				},
				641: {
					items: 3,
				},
				769: { 
					items: 3,
				},
				993: { 
					items: 3,
				}, 
				1201: {
					items: 3,
				}
			}
		});
	});
})(jQuery);