parkAdmin.controller('pagesController',['$scope', '$modal', function($scope, $modal, browser) {
	$scope.tabs = {};
	$scope.tabs.editors = [];
	$scope.$on('add-editor', function(ev, data) {
		data.unique = data.lang + '-' + data.route + '-' + data.type + '-' + data.identifier;
		var apply = null;
		// TODO: select already opened tab
		angular.forEach($scope.tabs.editors, function(editor, key) {
			if (editor.unique == data.unique) {
				apply = editor.key;
			}
        });
		if (apply === null) {
			$scope.$apply(function() {
            	var i = $scope.tabs.editors.push(data);
            	$scope.tabs.editors[i-1].active = true;
        	});
		} else {
			$scope.$apply(function() {
				console.log(apply);
				$scope.tabs.editors[apply].active = true;
			});
		}
	});

	$scope.editorClose = function(index, event) {
		$scope.tabs.editors.splice(index, 1);
		event.preventDefault();
	};
}]);