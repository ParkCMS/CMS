<div class="browser-container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="back($event)"><span class="glyphicon glyphicon-arrow-left"></span></button>
                        <button type="button" class="btn btn-default" ng-click="forward($event)"><span class="glyphicon glyphicon-arrow-right"></span></button>
                        <button type="button" class="btn btn-default" ng-click="refresh($event)"><span class="glyphicon glyphicon-refresh"></span></button>
                    </div>
                    <input type="text" class="form-control" ng-model="browserUrl" disabled>
                </div>
            </div>
        </div>
    </div>
    <iframe frameborder="0" style="width: 100%"></iframe>
</div>