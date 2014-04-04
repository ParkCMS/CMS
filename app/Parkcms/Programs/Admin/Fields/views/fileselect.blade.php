<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <input disabled="disabled" type="text" name="{{ $name }}" ng-model="data.{{ $name }}" class="form-control" />
                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary" ng-model="{{$name}}_toggle" ng-init="{{$name}}_toggle=1" btn-checkbox btn-checkbox-true="0" btn-checkbox-false="1">
                    Select File
                </button>
                </span>
            </div><!-- /input-group -->
        </div>
    </div>
</div>
<file-browser enable-drag-drop="false" toggle="{{$name}}_toggle" ng-model="data.{{ $name }}" ng-init="data.{{ $name }}=''"></file-browser>