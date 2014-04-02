<form {{ $attributes }}>
    @foreach ($fields as $field)
        {{ $field->render() }}
    @endforeach
</form>