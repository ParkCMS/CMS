parkAdmin.controller('pagesController',['$scope', '$modal', 'BASE_URL', function($scope, $modal, BASE_URL) {
	$scope.tabs = {};
	$scope.tabs.editors = [];
	$scope.status = {};
	$scope.status.browserActive = true;
	$scope.status.browserLoading = false;

	$scope.browserSource = BASE_URL + '?admin=1';

	$scope.navigateTo = function(url) {
		$scope.browserSource = BASE_URL + '/' + url + '?admin=1';
		$scope.$broadcast('browser-relocate', $scope.browserSource);
		$scope.status.browserActive = true;
	}

	$scope.$on('add-editor', function(ev, data) {
		if (data.identifier.indexOf('global-') === 0) {
			data.unique = data.lang + '-' + data.type + '-' + data.identifier;
			data.global = true;
		} else {
			data.unique = data.lang + '-' + data.route + '-' + data.type + '-' + data.identifier;
			data.global = false;
		}
		var apply = null;
		
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

	$scope.$on('browser-load-start', function(ev) {
		$scope.status.browserLoading = true;
		ev.preventDefault();
	});

	$scope.$on('browser-load-finish', function(ev) {
		$scope.status.browserLoading = false;
		ev.preventDefault();
	});
}]);