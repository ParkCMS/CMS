parkAdmin.controller('loginViewController', 
	['$rootScope', '$modal', '$http', '$location', 'BASE_URL', 'UserService', 'TempStorage', function($rootScope, $modal, $http, $location, BASE_URL, User, store) {
	var openModal = function() {
		$modal.open({
			templateUrl: 'loginform',
			controller: 'loginController',
			backdrop: 'static'
		});
	}

	$http.get(BASE_URL + '/auth/check').success(function(data, status, headers, config) {
		if (data.login) {
			if (!User.isLoggedIn) {
				// console.log(data.user);
				User.isLoggedIn = true;
				User.username = data.user.username;
				User.group = data.user.group;
				if (!store.isset('preLoginRoute')) {
					$location.path('/');
				}
				$rootScope.$broadcast('login-action');
			}
		} else {
			openModal();
		}
	}).error(function(data, status, headers, config) {
		openModal();
	});
}]);

parkAdmin.controller('loginController', ['$scope', '$rootScope', '$modalInstance', '$http', 'UserService', 'BASE_URL', function($scope, $rootScope, $modalInstance, $http, User, BASE_URL) {
	$scope.credentials = {
		username: '',
		password: ''
	};

	$scope.login = function() {
		$http.post(BASE_URL + '/login', {
			name: $scope.credentials.username,
			password: $scope.credentials.password
		}).success(function(data, status, headers, config) {
			if (status == 200) {
				User.isLoggedIn = true;
				User.username = data.username;
				User.group = data.group;
				$rootScope.$broadcast('login-action');
				$modalInstance.close(User);
			} else {
				User.isLoggedIn = false;
				User.username = '';
				$scope.credentials.username = '';
				$scope.credentials.password = '';
				if (data.type === 'WRONG_CRED') {
					$scope.credentials.username = data.name;
				}
			}
		}).error(function(data, status, headers, config) {
			User.isLoggedIn = false;
			User.username = '';
			$scope.credentials.username = '';
			$scope.credentials.password = '';
			if (data.type === 'WRONG_CRED') {
				$scope.credentials.username = data.name;
			}
		});
	};
}]);