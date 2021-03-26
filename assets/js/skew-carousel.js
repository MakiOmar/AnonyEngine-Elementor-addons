;(function($) {
	"use strict";
	
	
	var skewCarousel = function($scop, $){
		
		$(".image").width($("#slider").width()/3.3);
		$(".item-img-1").addClass("item-img-loaded")

		var loaded = true;

		function reset(){
			$(".image").width($("#slider").width()/3.3);
			$(".image").attr("data-click",0);

			$(".image").find(".item-img-2").css({
				opacity:0
			});

			$(".image").find(".item-img-1").css({
				opacity:1
			});
			
			$(".image").find(".image-text").css({
				opacity:0
			});
			
			$(".image:first-child").mouseover();
		}

		reset();

		$(window).resize(function(){
			reset();
		})

		$(".item-img-1, .item-img-2").each(function(){
			var src = $(this).attr("data-src")
			$(this).css({
				background:`url(${src}) no-repeat`,
			})
		})

		$(".image").mouseover(function(){
			
			if ($(window).width() > 980) {

				$(this).find(".item-img-1").css({
					opacity:0
				})

				$(this).find(".item-img-2").css({
					opacity:1,
				});
				
				$('.image').find(".image-text").css({
					opacity:0
				});

				$(this).find(".image-text").css({
					opacity:1
				});

				$(".image").width($("#slider").width()/4);
				$(".image").css({'z-index' : '0'});
				
				$(this).css({'z-index' : '999'});
				$(this).width($("#slider").width()/2)
			}
		})

		$(".image").mouseout(function(){
			if ($(window).width() > 980) {
				$(this).find(".item-img-2").css({
					opacity:0
				});

				$(this).find(".item-img-1").css({
					opacity:1
				});
				
				$(this).find(".image-text").css({
					opacity:0
				});

				$(".image").width($("#slider").width()/3.3);
				$(this).css({"z-index":0});
				
				reset();
				
//				$(".image:first-child").mouseover();
			}
		});

		/*$(".image:last-child").mouseover(function(event){
			if ($(window).width() > 980) {
				$(this).find(".item-img-1").css({
					opacity:0
				});
		 
				$(this).find(".item-img-2").css({
					opacity:1
				});

				$(".image").width($("#slider").not($(this)).width()/5);
				$(".image").css({"z-index":"-999px"});
				
				$(this).css({"z-index":"999px"});
				$(this).width($("#slider").width()/1.5);
			}
		});
*/
		$(".image").click(function(event){
			event.stopPropagation();
			if ($(window).width() > 980) {
				window.open($(".image").attr("data-href") || "/");
			}

			if ($(window).width() <= 980) {
				if ($(this).attr("data-click") == 0) {

					$(".image").attr("data-click",0)

					$(this).attr("data-click",1)

					$(".image").find(".item-img-2").css({
						opacity:0
					});

					$(".image").find(".item-img-1").css({
						opacity:1
					});

					$(this).find(".item-img-1").css({
						opacity:0
					});

					$(this).find(".item-img-2").css({
						opacity:1
					});

					$(this).find(".image-text").css({
						opacity:1
					});

					if ($(event.currentTarget).hasClass("image-first")) {
						$(".image").width($("#slider").width()/4)
						$(this).width($("#slider").width()/1.3)
					}
					else{
						$(".image").width($("#slider").width()/4)
						$(this).width($("#slider").width()/2)
					}

				}
				else{
					window.open($(".image").attr("data-href") || "/");
					$(this).attr("data-click",0);
				}
			}
		});

		// note to remove
		$(".image:first-child").mouseover();

		$(window).click(function(){
			reset();
		});
		
	}
	
	
	$( window ).on( 'elementor/frontend/init', () => {

	   elementorFrontend.hooks.addAction( 'frontend/element_ready/repeater.default', skewCarousel );
	   elementorFrontend.hooks.addAction( 'frontend/element_ready/skew-carousel.default', skewCarousel );
	} );

	

})(jQuery);
