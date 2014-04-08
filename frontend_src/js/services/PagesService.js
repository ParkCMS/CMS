parkAdmin.service("PagesService", ['$http', 'BASE_URL', function($http, BASE_URL) {
    var serviceBackend = BASE_URL + '/admin/pages';

    this.getPageTree = function () {
        return $http.get(serviceBackend + '/tree');
    };

    this.getTemplates = function () {
        return $http.get(serviceBackend + '/templates');
    };

    this.createPage = function (page, position, relativeId) {
        return $http.post(serviceBackend + '/create', {
            page: page,
            position: position,
            relativeId: relativeId
        });
    }
}]);