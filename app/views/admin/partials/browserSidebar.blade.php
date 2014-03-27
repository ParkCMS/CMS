<div class="info" ng-if="file">
    <h3>File: @{{ file.filename }}</h3>

    <div class="row" ng-if="file.type.indexOf('image') === 0">
        <div class="col-md-12" style="text-align: center">
            <img ng-src="@{{file.url}}" style="max-width: 80%; margin: auto;">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <div class="btn-group" style="margin: auto;">
                <a ng-href="@{{ file.url }}" type="button" class="btn btn-default">{{ trans('admin_default.download_action') }}</a>
                <button type="button" class="btn btn-default">{{ trans('admin_default.delete_action') }}</button>
                <button type="button" class="btn btn-default">{{ trans('admin_default.move_action') }}</button>
            </div>
        </div>
    </div>
</div>