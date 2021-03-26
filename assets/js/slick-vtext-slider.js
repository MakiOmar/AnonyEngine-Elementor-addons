;(function($) {
	"use strict";
	
	
	var slickVtext = function($scop, $){

		var $_this = $scop.find('.anoshc-slick-vtext');
		
		$_this.slick({
		  vertical: true,
		  autoplay: false,
		  autoplaySpeed: 3000,
		  speed: 300,
		  arrows: false,
		});
	}
	
	
	$( window ).on( 'elementor/frontend/init', () => {

	   elementorFrontend.hooks.addAction( 'frontend/element_ready/repeater.default', slickVtext );
	   elementorFrontend.hooks.addAction( 'frontend/element_ready/vertical-text-slider.default', slickVtext );
	} );

	

})(jQuery);