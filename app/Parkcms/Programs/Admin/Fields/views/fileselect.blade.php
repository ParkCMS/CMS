<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" title="Enable file" ng-model="form.{{ $name }}_enable" ng-init="form.{{ $name }}_enable = '{{ $value }}' != ''" ng-change="{{ $name }}_toggle = !form.{{ $name }}_enable; form.{{ $name }} =''">
                </span>
                <input disabled="disabled" type="text" name="{{ $name }}" ng-model="form.{{ $name }}" class="form-control" />
                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary" ng-model="{{$name}}_toggle" ng-init="{{$name}}_toggle=1" btn-checkbox btn-checkbox-true="0" btn-checkbox-false="1" ng-click="form.{{ $name }}_enable = (!form.{{ $name }}_enable) ? true : form.{{ $name }}_enable">
                    Select File
                </button>
                </span>
            </div>
        </div>
    </div>
</div>
<file-browser select-files="{{ ($select === 'files' || $select === 'both') ? 'true' : 'false' }}" select-directories="{{ ($select === 'directories' || $select === 'both') ? 'true' : 'false' }}" enable-drag-drop="false" toggle="{{$name}}_toggle" ng-model="form.{{ $name }}" ng-init="form.{{ $name }}='{{ $value }}'"></file-browser>