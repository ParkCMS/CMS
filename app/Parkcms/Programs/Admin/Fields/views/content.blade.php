<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <textarea class="{{ $class }}" name="{{ $name }}">{{ $value }}</textarea>
</div>