<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="text" {{ $attributes }} ng-model="data.{{ $name }}" ng-init="data.{{ $name }}='{{ $value }}'" value="{{ $value }}" name="{{ $name }}" />
</div>