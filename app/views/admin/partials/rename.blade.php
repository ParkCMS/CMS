<div class="modal-header">
    <h4 class="modal-title"><span class="glyphicon glyphicon-star"></span> Rename file <code>@{{ file.src }}</code></h4>
</div>
<div class="modal-body">
    <ng-form name="nameDialog" novalidate role="form">
        <div class="form-group input-group-lg">
            <label class="control-label" for="course">New Name:</label>
            <input type="text" class="form-control" name="destPath" id="destPath" ng-model="file.dest" ng-keyup="hitEnter($event)" required>
            <span class="help-block">Insert the new file name</span>
        </div>
    </ng-form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
    <button type="button" class="btn btn-primary" ng-click="save()">Save</button>
</div>