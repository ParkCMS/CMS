<div class="form-group">
    @if ($label)
        <label for="form-{{ $name }}">{{ $label }}</label>
    @endif
    @if($type == 'number')
        <input type="{{ $type }}" id="form-{{ $name }}" {{ $attributes }} ng-model="form.{{ $name }}" value="{{ $value }}" name="{{ $name }}" />
    @else
        <input type="{{ $type }}" id="form-{{ $name }}" {{ $attributes }} ng-model="form.{{ $name }}" value="{{ $value }}" name="{{ $name }}" />
    @endif
</div>