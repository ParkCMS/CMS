parkAdmin.service("PagesService", ['$http', 'BASE_URL', function($http, BASE_URL) {
    var serviceBackend = BASE_URL + '/admin/pages';

    this.getPageTree = function () {
        return $http.get(serviceBackend + '/tree');
    };
}]);