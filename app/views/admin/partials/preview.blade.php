<div class="modal-header">
    <h4 class="modal-title"><span class="glyphicon glyphicon-star"></span> {{ trans('admin_pages.preview_template') }}</h4>
</div>
<div class="modal-body">
    <iframe src="@{{getIframeSrc()}}" style="width: 100%; height: 100%" frameborder="0"></iframe>
</div>
<div class="modal-footer">
    <a ng-href="@{{getIframeSrc()}}" class="btn btn-default" target="_blank">{{ trans('admin_pages.enlarge') }}</a>
    <button type="button" class="btn btn-primary" ng-click="ok()">{{ trans('admin_default.ok') }}</button>
</div>