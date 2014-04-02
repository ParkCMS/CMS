<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <textarea {{ $attributes }} name="{{ $name }}">{{ $value }}</textarea>
</div>