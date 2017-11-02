jQuery(document).ready(function($) {

	$(".modal-signup-trigger").fancybox({
		padding 	: 0,
		margin 		: 0,
		openEffect  : 'none',
		closeEffect : 'none',
		helpers 	: {
	        overlay : {
	            css : {
	                'background' : 'rgba(0,0,0,0.9)',
	            }
	        }
	    },
	    beforeShow: function(){
		 $(this).addClass("newClass");
		}
	});

});