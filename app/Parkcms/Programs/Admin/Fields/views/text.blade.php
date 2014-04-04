<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" {{ $attributes }} ng-model="form.{{ $name }}" ng-init="form.{{ $name }}='{{ $value }}'" value="{{ $value }}" name="{{ $name }}" />
</div>