<div class="row">
    <div class="col-md-12">
	    <tabset>
			<tab heading="Page Browser"><page-browser class="page-browser"></page-browser></tab>
			<tab class="slide" ng-repeat="editor in tabs.editors track by editor.unique" active="editor.active">
				<tab-heading>
					<a ng-click="editorClose($index, $event)"><i class="glyphicon glyphicon-remove"></i></a>
					Edit <span ng-if="!editor.global">@{{ editor.route }}/</span>@{{ editor.identifier }} (@{{ editor.type }})
				</tab-heading>
				<editor data="editor"></editor>
			</tab>
	    </tabset>
    </div>
</div>