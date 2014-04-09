<div class="form-group">
    @if ($label)
        <label for="form-{{ $name }}">{{ $label }}</label>
    @endif
    <select class="form-control col-xs-11" ng-model="change.{{ $name }}" ng-init="change.{{ $name }}={{ $value }}" {{ $attributes }}>
        @foreach($values as $key => $val)
            <option value="{{ $key }}">{{ $val }}</option>
        @endforeach
    </select>
    <button type="button" class="btn btn-primary col-xs-1" call-action="changeWorkshop" load-params="{'id': change.{{ $name }} }">OK</button>
</div>