<div class="row">
    <div class="col-md-12">
	    <tabset>
			<tab heading="Page Browser"><page-browser class="page-browser"></page-browser></tab>
			<tab class="slide" ng-repeat="editor in tabs.editors track by unique" active="editor.active">
				<tab-heading>
					<a ng-click="editorClose($index, $event)"><i class="glyphicon glyphicon-remove"></i></a>
					Edit @{{ editor.identifier }} (@{{ editor.type }})
				</tab-heading>
				@{{ editor.identifier }}
			</tab>
	    </tabset>
    </div>
</div>