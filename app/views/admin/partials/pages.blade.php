<div class="row">
    <div class="col-md-12">
	    <tabset>
			<tab>
				<tab-heading>
					<img ng-if="status.browserLoading" style="margin-top: 2px; margin-left: 5px;" class="pull-right" src="{{ url('admin_assets/img/ajax-loader.gif') }}" alt="Loading..." />
					<span>Page Browser</span>
				</tab-heading>
				<page-browser class="page-browser" src="{{ url() }}?admin=1"></page-browser>
			</tab>
			<tab class="slide" ng-repeat="editor in tabs.editors track by editor.unique" active="editor.active">
				<tab-heading>
					<a ng-click="editorClose($index, $event)"><i class="glyphicon glyphicon-remove"></i></a>
					Edit @{{ editor.lang }}<span ng-if="!editor.global">-@{{ editor.route }}</span>/@{{ editor.identifier }} (@{{ editor.type }})
				</tab-heading>
				<editor data="editor"></editor>
			</tab>
	    </tabset>
    </div>
</div>