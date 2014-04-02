<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="text" {{ $attributes }} value="{{ $value }}" name="{{ $name }}" />
</div>