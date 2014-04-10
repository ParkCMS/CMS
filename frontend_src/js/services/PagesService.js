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
    };

    this.updatePage = function (page) {
        return $http.post(serviceBackend + '/update', {
            page: page
        });
    };

    this.deletePage = function (page) {
        return $http({
            method: 'delete',
            url: serviceBackend + '/delete',
            params: {page: page.id}
        });
    };
}]);