parkAdmin.service("EditorService", ['$http', 'BASE_URL', function($http, BASE_URL) {
    var serviceBackend = BASE_URL + '/admin/programs/editor/';

    this.loadAction = function(type, identifier, page, action) {
        return $http.get(serviceBackend, {
            params: {
                'type': type,
                'identifier': identifier,
                'page': page,
                'action': action
            }
        });
    };

    this.isGlobalIdentifier = function(identifier) {
        return identifier.indexOf('global-') === 0;
        // if (data.identifier.indexOf('global-') === 0) {
        //     data.unique = data.lang + '-' + data.type + '-' + data.identifier;
        //     data.global = true;
        // } else {
        //     data.unique = data.lang + '-' + data.route + '-' + data.type + '-' + data.identifier;
        //     data.global = false;
        // }
    }
}]);