parkAdmin.service("UsersService", ['$http', 'BASE_URL', function($http, BASE_URL) {
    var serviceBackend = BASE_URL + '/admin/users';

    this.getUsers = function() {
        return $http.get(serviceBackend + '/get');
    };

    this.create = function(user) {
        return $http.post(serviceBackend + '/create', user);
    };

    this.update = function(user) {
        return $http.post(serviceBackend + '/update', user);
    };
}]);