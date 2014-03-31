
jQuery(function($) {
    $('body').on('submit', 'form[data-async]', function(event) {
        var $form = $(this);
        var $target = $($form.data('target'));
        
        $target.modal('show');
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            
            success: function(data, status) {
                $target.find('.modal-content').html(data);
                $('[data-toogle="tooltip"]').tooltip();
            }
        });
        
        event.preventDefault();
    });

    $('body').on('click', 'a[data-async]', function(event) {
        var $a = $(this);
        var $target = $($a.data('target'));
        
        $target.modal('show');
        $.get($a.attr('href'),function(data, status) {
            $target.find('.modal-content').html(data);
        });
        
        event.preventDefault();
    });
});
