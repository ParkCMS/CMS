<form action="">
    @foreach ($fields as $field)
        {{ $field->render() }}
    @endforeach
</form>