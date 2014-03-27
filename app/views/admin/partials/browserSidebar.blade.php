<div class="info" ng-if="file">
    <h3>File: @{{ file.filename }}</h3>

    <div class="row" ng-if="file.type.indexOf('image') === 0">
        <div class="col-md-12" style="text-align: center">
            <img ng-src="@{{file.url}}" style="width: 80%; margin: auto;">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <div class="btn-group" style="margin: auto;">
                <a ng-href="@{{ file.url }}" type="button" class="btn btn-default">Download</a>
                <button type="button" class="btn btn-default">Delete</button>
                <button type="button" class="btn btn-default">Move</button>
            </div>
        </div>
    </div>
</div>