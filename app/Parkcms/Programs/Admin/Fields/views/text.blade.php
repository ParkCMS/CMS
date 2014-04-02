<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="text" {{{ (!$disabled) ?: 'disabled="disabled"' }}} value="{{ $value }}" class="{{ $class }}" name="{{ $name }}" />
</div>