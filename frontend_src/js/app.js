var parkAdmin = angular.module('parkAdmin', ['ngRoute','ui.bootstrap']);

parkAdmin.config(['$routeProvider', '$httpProvider', function($routeProvider, $httpProvider) {
    $routeProvider.when('/', {
        controller: 'overviewController',
        templateUrl: 'admin/partials/dashboard'
    })
    .when('/files', {
        controller: 'filesController',
        templateUrl: 'admin/partials/files'
    })
    .otherwise({redirectTo: '/'});
    
    $httpProvider.interceptors.push(['$q', '$rootScope', '$location', 'UserService', 'TempStorage', function($q, $rootScope, $location, User, store) {
        return {
            'request': function(config) {
                $rootScope.$broadcast('loading-started');
                return config || $q.when(config);
            },

            'response': function(response) {
                $rootScope.$broadcast('loading-complete');
                return response || $q.when(response);
            },

            'responseError': function(rejection) {
                var status = rejection.status;
                $rootScope.$broadcast('loading-complete');
                if (status == 401) {
                    User.reset();
                    $rootScope.$broadcast('auth-error');
                    store.set('preLoginRoute', $location.path());
                    $location.path("/login");
                    return;
                }
                return $q.reject(rejection);
            }
        };
    }]);
}]);