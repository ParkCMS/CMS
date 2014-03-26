<div class="info" ng-if="file">
    <h3>File: @{{ file.filename }}</h3>
    
    <div class="row" ng-if="file.type.indexOf('image') === 0">
        <img ng-src="@{{file.url}}">
    </div>

    <div class="row">
        <div class="btn-group">
            <button type="button" class="btn btn-default">Download</button>
            <button type="button" class="btn btn-default">Delete</button>
            <button type="button" class="btn btn-default">Move</button>
        </div>
    </div>
</div>