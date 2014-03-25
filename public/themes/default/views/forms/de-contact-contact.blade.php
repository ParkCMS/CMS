
<form action="{{ $action }}" method="{{ $method }}" id="{{ $form->identifier }}">
    
    <input type="email" name="email" value="asdf@asdf" />

    <input type="submit" value="Abschicken" />
</form>
<script type="text/javascript">

$(function() {
    $('#{{ $form->identifier }}').submit(function(event) {
        
        event.preventDefault();
        
        var $form = $( this );
        var url = $form.attr( "action" );

        $.post(url, $form.serialize(), function(data) {
            alert('jeah');
            console.log(data);
        }, "json").fail(function(data) {
            var json = $.parseJSON(data.responseText);
            alert(json.message);
        });
    });
});

</script>
