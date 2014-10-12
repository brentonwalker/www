var site = function() {
	this.navLi = jQuery('#access li').children('ul').hide().end();
	this.init();
};

site.prototype = {
 	
 	init : function() {
 		this.setMenu();
 	},
 	
 	// Enables the slidedown menu, and adds support for IE6
 	
 	setMenu : function() {
 	
 	jQuery.each(this.navLi, function() {
 		if ( jQuery(this).children('ul')[0] ) {
 			jQuery(this)
 				.append('<span />')
 				.children('span')
 					.addClass('hasChildren')
 		}
 	});
 	
 		this.navLi.hover(function() {
 			// mouseover
			jQuery(this).find('> ul').stop(true, true).slideDown();
 		}, function() {
 			// mouseout
 			jQuery(this).find('> ul').stop(true, true).hide(); 		
		});
 		
 	}
 
}


new site();