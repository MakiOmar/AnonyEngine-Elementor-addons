	let i=2;

	
jQuery(document).ready(function($){
   var outerRad = $('.holderCircle').outerWidth();
   $('.holderCircle').css('height',outerRad);
   
   var innerRad = $('.contentCircle').outerWidth();
   $('.contentCircle').css('height',innerRad);
   
		var radius = 200;
		var fields = $('.itemDot');
		var container = $('.dotCircle');
		var width = container.width();
        radius = width/2.5;
 
		var height = container.height();
		var angle = 0, step = (2*Math.PI) / fields.length;
		fields.each(function() {
			var x = Math.round(width/2 + radius * Math.cos(angle) - $(this).width()/2);
			var y = Math.round(height/2 + radius * Math.sin(angle) - $(this).height()/2);
			if(window.console) {
				
			}
			
			$(this).css({
				left: x + 'px',
				top: y + 'px'
			});
			angle += step;
		});
		
		var activeBg = $('.itemDot.active img').attr('src');
			
		$('.contentCircle').css('background', 'url("' + activeBg+ '") no-repeat');
			
		$('.itemDot').click(function(){
			
			var dataTab= $(this).data("tab");
			//var typeUrl = $(this).find('.type-url').val();
			$('.itemDot').removeClass('active');
			$(this).addClass('active');
			$('.CirItem').removeClass('active');
			$( '.CirItem'+ dataTab).addClass('active');
			
			
			$('.dataItem').removeClass('active');
			$( '.dataItem'+ dataTab).addClass('active');
			
			var activeBg = $('.itemDot.active img').attr('src');
			
			$('.contentCircle').css('background', 'url("' + activeBg+ '") no-repeat');
			
			i=dataTab;
			
			$('.dotCircle').css({
				"transform":"rotate("+(360-(i-1)*36)+"deg)",
				"transition":"2s"
			});
			$('.itemDot').css({
				"transform":"rotate("+((i-1)*36)+"deg)",
				"transition":"1s"
			});
			/*setTimeout(function(){
			    window.location=typeUrl;
			},500);
			*/
		});
		
		setInterval(function(){
			var dataTab= $('.itemDot.active').data("tab");
			if(dataTab>fields.length||i>fields.length){
			dataTab=1;
			i=1;
			}
			$('.itemDot').removeClass('active');
			$('[data-tab="'+i+'"]').addClass('active');
			$('.CirItem').removeClass('active');
			$( '.CirItem'+i).addClass('active');
			
			$('.dataItem').removeClass('active');
			$( '.dataItem'+i).addClass('active');
			
			var activeBg = $('.itemDot.active img').attr('src');
			
			$('.contentCircle').css('background', 'url("' + activeBg+ '") no-repeat');
			
			i++;
			
			
			$('.dotCircle').css({
				"transform":"rotate("+(360-(i-2)*36)+"deg)",
				"transition":"2s"
			});
			$('.itemDot').css({
				"transform":"rotate("+((i-2)*36)+"deg)",
				"transition":"1s"
			});
			
			}, 5000);
		
	});



