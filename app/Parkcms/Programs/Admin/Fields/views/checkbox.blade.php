<div class="checkbox">
    @if ($label)
        <label for="form-{{ $name }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" id="form-{{ $name }}" {{ $attributes }} ng-model="form.{{ $name }}" value="1" name="{{ $name }}" @if($value) checked="checked" @endif />
</div>