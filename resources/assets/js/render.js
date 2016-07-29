(function ($) { 
	"use strict";

	$.fn.renderTemplate = function(options){
		var that = $(this);
		var options = $.extend({
			path 		: $(this).attr('data-path'),
			after 		: null,
			before 		: null,
			replace 	: true, 
		}, options);	

		$.ajax({
			url: options.path,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			if(data.status == 'success')
			{	
				if(options.replace){
					that.html(data.data);
				}else{
					that.append(data.data);
				}		
			}
			if($.isFunction(options.after)) { options.after(data); }
		})
		.fail(function() {
			console.log("error");
		});		
	}
	
})(jQuery);