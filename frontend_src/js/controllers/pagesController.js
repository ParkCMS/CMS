parkAdmin.controller('pagesController',['$scope', '$modal', function($scope, $modal, browser) {
	$scope.tabs = {};
	$scope.tabs.editors = [];
	$scope.$on('add-editor', function(ev, data) {
		if (data.identifier.indexOf('global-') === 0) {
			data.unique = data.lang + '-' + data.type + '-' + data.identifier;
			data.global = true;
		} else {
			data.unique = data.lang + '-' + data.route + '-' + data.type + '-' + data.identifier;
			data.global = false;
		}
		var apply = null;
		// TODO: select already opened tab
		for (var i = 0; i < $scope.tabs.editors.length; i++) {
			if ($scope.tabs.editors[i].unique === data.unique) {
				apply = i;
			}
		};
		if (apply === null) {
			$scope.$apply(function() {
            	var i = $scope.tabs.editors.push(data);
            	$scope.tabs.editors[i-1].active = true;
        	});
		} else {
			$scope.$apply(function() {
				$scope.tabs.editors[apply].active = true;
			});
		}
	});

	$scope.$on('close-editor', function(ev, data) {
		var index = null;
		for (var i = 0; i < $scope.tabs.editors.length; i++) {
			if ($scope.tabs.editors[i].unique === data) {
				index = i;
				break;
			}
		}
		if (index !== null) {
			$scope.editorClose(index, ev);
		}
	});

	$scope.editorClose = function(index, event) {
		$scope.tabs.editors.splice(index, 1);

		if (typeof event !== 'undefined') {
            event.preventDefault();
        }
	};
}]);