
jQuery(function($) {

    $('[data-toggle=menu-toggle]').click(function(event) {
        var menu = $(this).next();
        menu.slideToggle();
    });

    $('[data-toggle=tooltip]').tooltip();

})
