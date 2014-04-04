<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <textarea {{ $attributes }} ng-model="form.{{ $name }}" ng-init="form.{{ $name }}='{{ $value }}'" name="{{ $name }}">{{ $value }}</textarea>
</div>