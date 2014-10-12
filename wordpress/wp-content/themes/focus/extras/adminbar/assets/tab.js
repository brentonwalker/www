jQuery(function($){
    var link = $('<a></a>')
        .addClass('nav-tab')
        .html(siteoriginAdminTab.text)
        .attr('href', siteoriginAdminTab.url);

    $('.nav-tab-wrapper' ).append(link);

    if($('#typeselector' ).val() == 'author' && $('#s' ).val() == 'gpriday'){
        $('.nav-tab-wrapper a' ).removeClass('nav-tab-active');
        link.addClass('nav-tab-active');
        
        // hide the parts of the UI that aren't required
        $('.subsubsub, .tablenav.top.themes' ).hide();
    }
});