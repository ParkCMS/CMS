var parkAdmin = angular.module('parkAdmin', ['ngRoute', 'ngAnimate','ui.bootstrap', 'dialogs', 'flow', 'ngDragDrop']);

parkAdmin.config(['$routeProvider', '$httpProvider', 'flowFactoryProvider', function($routeProvider, $httpProvider, flowFactoryProvider) {

    $routeProvider.when('/', {
        controller: 'overviewController',
        templateUrl: 'admin/partials/dashboard'
    })
    .when('/pages', {
        controller: 'pagesController',
        templateUrl: 'admin/partials/pages'
    })
    .when('/files', {
        controller: 'filesController',
        templateUrl: 'admin/partials/files'
    })
    .otherwise({redirectTo: '/'});

    $httpProvider.interceptors.push(['$q', '$rootScope', '$location', 'UserService', 'TempStorage', 'BASE_URL', function($q, $rootScope, $location, User, store, BASE_URL) {
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
                    window.location.href = BASE_URL + "/login";
                    return;
                }
                return $q.reject(rejection);
            }
        };
    }]);

    flowFactoryProvider.defaults = {
        testChunks: false
    };
}]);

parkAdmin.run(['$http', function($http) {
  $http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}]);