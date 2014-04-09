<div class="row pages">
    <div class="col-md-12">
	    <tabset>
			<tab active="status.browserActive">
				<tab-heading>
					<img ng-if="status.browserLoading" style="margin-top: 2px; margin-left: 5px;" class="pull-right" src="{{ url('admin_assets/img/ajax-loader.gif') }}" alt="Loading..." />
					<span>{{ trans('admin_pages.page_browser') }}</span>
				</tab-heading>
				<page-browser class="page-browser" src="browserSource"></page-browser>
			</tab>
			<tab>
				<tab-heading>
					{{ trans('admin_pages.page_manager') }}
				</tab-heading>
				<page-manager on-navigate="navigateTo(page)"></page-manager>
			</tab>
			<tab class="slide" ng-repeat="editor in tabs.editors track by editor.unique" active="editor.active">
				<tab-heading>
					<a ng-click="editorClose($index, $event)"><i class="glyphicon glyphicon-remove"></i></a>
					{{ trans('admin_pages.edit') }} @{{ editor.lang }}<span ng-if="!editor.global">-@{{ editor.route }}</span>/<strong>@{{ editor.identifier }}</strong> (@{{ editor.type }})
				</tab-heading>
				<editor data="editor"></editor>
			</tab>
	    </tabset>
    </div>
</div>