parkAdmin.service("FileBrowser", ['$http', 'BASE_URL', function($http, BASE_URL) {
    var serviceBackend = BASE_URL + '/admin/files/';

    this.getFilesInFolder = function(folder) {
        return $http.get(serviceBackend + 'list/', {
            params: {
                'path': folder
            }
        });
    }
}]);