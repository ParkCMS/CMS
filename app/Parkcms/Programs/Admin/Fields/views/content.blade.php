<div class="form-group">
    @if ($label)
        <label for="form-{{ $name }}">{{ $label }}</label>
    @endif
    <textarea id="form-{{ $name }}" {{ $attributes }} ng-model="form.{{ $name }}" ng-init="form.{{ $name }}='{{ $value }}'" name="{{ $name }}">{{ $value }}</textarea>
</div>