parkAdmin.directive('checkAuth', ['$rootScope', '$location', 'UserService', 'TempStorage', function($root, $location, User, store) {
	return {
		link: function (scope, elem, attrs, ctrl) {
			$root.$on('$routeChangeStart', function(event, next, curr) {
				if (typeof next.$$route.redirectTo === "undefined") {
					if (!User.isLoggedIn) {
						if (!(typeof next.$$route.originalPath === "undefined")) {
							store.set('preLoginRoute', next.$$route.originalPath);
						} else {
							store.set('preLoginRoute', '/');
						}
						
						$location.path('/login');
					}
				}
			});

			$root.$on('login-action', function(e) {
				if(store.isset('preLoginRoute')) {
					var p = store.getAndDelete('preLoginRoute');
					$location.path(p);
				}
			});
		}
	};
}])