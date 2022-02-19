;(function($) {
	"use strict";
	
	
	var animatedIconList = function($scop, $){
		var prevOffset;
		
		$(".animated-icon-list-item").each(function(){
			var current = $(this);
			
			if (current.prev().length) { 
		
				prevOffset = current.prev().position().top;
				
				console.log(prevOffset);
				current.css('top', prevOffset + 50 + 'px');
			
			}
		});
		
		
	}
	
	
	$( window ).on( 'elementor/frontend/init', () => {

	   elementorFrontend.hooks.addAction( 'frontend/element_ready/repeater.default', animatedIconList );
	   elementorFrontend.hooks.addAction( 'frontend/element_ready/animated-icon-list.default', animatedIconList );
	} );

	

})(jQuery);